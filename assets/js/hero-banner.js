import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

const desktopQuery = window.matchMedia('(min-width: 783px)');
const reduceMotionQuery = window.matchMedia('(prefers-reduced-motion: reduce)');

// Viewport heights of scroll. The first stretch grows the video to the screen.
// The second keeps it there, then the page scrolls on as usual.
const EXPAND_VIEWPORTS = 1.35;
const HOLD_VIEWPORTS = 0.7;

let ctx = null;
let fitHero = null;
let building = false;

const adminBarHeight = () => {
	const adminBar = document.getElementById('wpadminbar');

	if (!adminBar) {
		return 0;
	}

	return adminBar.offsetHeight;
};

const viewportHeight = () => {
	const visible = window.innerHeight - adminBarHeight();
	const wrapper = document.getElementById('smooth-wrapper');

	if (wrapper && document.body.classList.contains('has-smooth-scroll')) {
		const wrapperHeight = wrapper.clientHeight;

		if (wrapperHeight > 0 && wrapperHeight <= visible) {
			return wrapperHeight;
		}
	}

	return visible;
};

// The smooth wrapper already starts below the admin bar. Pinning to the
// window top would tuck the video under the bar and leave that same gap
// at the bottom of the screen.
const pinStart = () => {
	const offset = adminBarHeight();

	return offset ? `top ${offset}px` : 'top top';
};

const contentOffset = (element) => {
	const content = document.getElementById('smooth-content');

	if (!content) {
		return element.getBoundingClientRect().top;
	}

	return element.getBoundingClientRect().top - content.getBoundingClientRect().top;
};

const destroy = () => {
	if (fitHero) {
		ScrollTrigger.removeEventListener('refreshInit', fitHero);
		fitHero = null;
	}

	if (ctx) {
		ctx.revert();
		ctx = null;
	}

	document.querySelectorAll('.hero-banner--cinematic').forEach((hero) => {
		hero.classList.remove('hero-banner--cinematic');
		hero.style.height = '';
	});
};

const create = (hero) => {
	const media = hero.querySelector('.hero-banner__media');
	const frame = media.querySelector('.hero-banner__video');
	const visual = frame.querySelector('iframe, .object-embed');
	const heading = hero.querySelector('.hero-banner__heading');

	if (!frame || !visual) {
		return;
	}

	const heroRect = hero.getBoundingClientRect();
	const mediaRect = media.getBoundingClientRect();
	const header = document.getElementById('main-header');
	const from = {
		top: mediaRect.top - heroRect.top,
		left: mediaRect.left - heroRect.left,
		width: mediaRect.width,
		height: mediaRect.height,
	};
	const headingTop = heading ? heading.getBoundingClientRect().top - heroRect.top : 0;
	const headerBottom = header ? header.getBoundingClientRect().bottom - heroRect.top : 0;

	if (from.width < 2 || from.height < 2) {
		return;
	}

	hero.classList.add('hero-banner--cinematic');

	fitHero = () => {
		const next = `${viewportHeight()}px`;

		if (hero.style.height !== next) {
			hero.style.height = next;
		}
	};

	fitHero();
	ScrollTrigger.addEventListener('refreshInit', fitHero);

	gsap.set(media, {
		position: 'absolute',
		top: from.top,
		left: from.left,
		width: from.width,
		height: from.height,
	});

	gsap.set(visual, {
		top: '50%',
		left: '50%',
		right: 'auto',
		bottom: 'auto',
		xPercent: -50,
		yPercent: -50,
		width: from.width,
		height: from.height,
		scale: 1,
		transformOrigin: 'center center',
	});

	const coverScale = () => {
		return Math.max(media.clientWidth / from.width, media.clientHeight / from.height);
	};

	const scrollDistance = () => viewportHeight() * (EXPAND_VIEWPORTS + HOLD_VIEWPORTS);

	const timeline = gsap.timeline({
		scrollTrigger: {
			trigger: hero,
			start: pinStart,
			end: () => `+=${scrollDistance()}`,
			pin: true,
			scrub: true,
			anticipatePin: 1,
			invalidateOnRefresh: true,
		},
	});

	if (header) {
		ScrollTrigger.create({
			trigger: hero,
			start: pinStart,
			end: () => `+=${scrollDistance()}`,
			pin: header,
			pinSpacing: false,
		});

		// Fully gone while the heading is still clear of the header.
		const clearance = 48;
		const travelToHeader = Math.max(headingTop - headerBottom, 0);
		const fadeEnd = heading
			? Math.max((travelToHeader - clearance) / from.top, 0) * EXPAND_VIEWPORTS
			: EXPAND_VIEWPORTS * 0.45;
		const fadeDuration = Math.min(EXPAND_VIEWPORTS * 0.28, Math.max(fadeEnd, EXPAND_VIEWPORTS * 0.12));

		timeline.to(header, {
			autoAlpha: 0,
			ease: 'none',
			duration: fadeDuration,
		}, Math.max(fadeEnd - fadeDuration, 0));
	}

	timeline.to(media, {
		top: 0,
		left: 0,
		width: () => hero.clientWidth,
		height: () => hero.clientHeight,
		ease: 'none',
		duration: EXPAND_VIEWPORTS,
		onUpdate: () => {
			gsap.set(visual, { scale: coverScale() });
		},
	}, 0);

	if (heading) {
		timeline.to(heading, {
			y: () => -from.top,
			ease: 'none',
			duration: EXPAND_VIEWPORTS,
		}, 0);
	}

	// Keeps the fullscreen frame in place for the rest of the pinned scroll.
	timeline.set(media, {}, EXPAND_VIEWPORTS + HOLD_VIEWPORTS);
};

const setup = () => {
	if (building) {
		return;
	}

	building = true;
	destroy();

	const finish = () => {
		building = false;
	};

	if (!desktopQuery.matches || reduceMotionQuery.matches) {
		ScrollTrigger.refresh();
		finish();
		return;
	}

	const hero = document.querySelector('.hero-banner');

	if (!hero || !hero.querySelector('.hero-banner__media') || contentOffset(hero) > 80) {
		ScrollTrigger.refresh();
		finish();
		return;
	}

	ctx = gsap.context(() => {
		create(hero);
	}, hero);

	ScrollTrigger.refresh();
	finish();
};

let resizeTimer;

const onResize = () => {
	clearTimeout(resizeTimer);
	resizeTimer = setTimeout(setup, 180);
};

desktopQuery.addEventListener('change', setup);
reduceMotionQuery.addEventListener('change', setup);
window.addEventListener('resize', onResize);

if (document.readyState === 'loading') {
	document.addEventListener('DOMContentLoaded', setup);
} else {
	setup();
}
