import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

// Desktop scroll entrances. Elements already on screen are left as they are.
const DESKTOP_QUERY = '(min-width: 993px) and (prefers-reduced-motion: no-preference)';
const START_LINE = 0.88;

const getScroller = () => document.getElementById('smooth-wrapper') || window;

// Elements at the end of the page can never reach "top 88%". Start those as
// soon as they enter, which is always within the scroll range.
const entranceStart = (element) => () => {
	const max = ScrollTrigger.maxScroll(getScroller());
	const scroll = window.scrollY || document.documentElement.scrollTop || 0;
	const top = element.getBoundingClientRect().top + scroll;
	const preferred = top - window.innerHeight * START_LINE;

	if (!max || preferred <= max) {
		return 'top 88%';
	}

	return 'top bottom';
};

const revealIfUnreachable = (tween, targets, props) => {
	const trigger = tween.scrollTrigger;

	if (!trigger) {
		return;
	}

	const max = ScrollTrigger.maxScroll(trigger.scroller || window);

	if (max > 0 && trigger.start > max) {
		tween.progress(1);
		clearEntrance(targets, props);
	}
};

const motions = {
	fadeIn: { opacity: 0, duration: 1.15, ease: 'power2.out' },
	fadeInUp: { opacity: 0, y: 32, duration: 1.15, ease: 'power3.out' },
	fadeInDown: { opacity: 0, y: -28, duration: 1.1, ease: 'power3.out' },
	fadeInLeft: { opacity: 0, x: -40, duration: 1.15, ease: 'power3.out' },
	fadeInRight: { opacity: 0, x: 40, duration: 1.15, ease: 'power3.out' },
	slideInLeft: { opacity: 0, x: -72, duration: 1.3, ease: 'power4.out' },
	slideInRight: { opacity: 0, x: 72, duration: 1.3, ease: 'power4.out' },
	slideInUp: { opacity: 0, y: 64, duration: 1.3, ease: 'power4.out' },
	scaleIn: { opacity: 0, scale: 0.92, duration: 1.05, ease: 'power2.out' },
};

const isBelowFold = (element) => {
	const rect = element.getBoundingClientRect();

	if (!rect.width && !rect.height) {
		return false;
	}

	return rect.top > window.innerHeight * START_LINE;
};

const delayFor = (element) => {
	if (element.classList.contains('delayLong')) {
		return 0.28;
	}

	if (element.classList.contains('delayShort')) {
		return 0.14;
	}

	return 0;
};

const clearPropsFor = (from) => {
	const props = ['opacity'];

	if ('x' in from || 'y' in from || 'scale' in from) {
		props.push('transform', 'transformOrigin');
	}

	return props.join(',');
};

const clearEntrance = (targets, props) => {
	gsap.set(targets, { clearProps: props });
};

const play = (element, fromVars) => {
	if (element.dataset.entrance === 'ready' || !isBelowFold(element)) {
		return;
	}

	element.dataset.entrance = 'ready';

	const { duration, ease, ...from } = fromVars;

	if (from.scale) {
		gsap.set(element, { transformOrigin: '50% 50%' });
	}

	const props = clearPropsFor(from);

	revealIfUnreachable(gsap.from(element, {
		...from,
		duration,
		ease,
		delay: delayFor(element),
		scrollTrigger: {
			trigger: element,
			start: entranceStart(element),
			once: true,
		},
		onComplete: () => clearEntrance(element, props),
	}), element, props);
};

const playStagger = (element) => {
	if (element.dataset.entrance === 'ready' || !isBelowFold(element)) {
		return;
	}

	const children = Array.from(element.children).filter(
		(child) => !child.classList.contains('stats-columns__break')
	);

	if (!children.length) {
		return;
	}

	element.dataset.entrance = 'ready';

	revealIfUnreachable(gsap.from(children, {
		opacity: 0,
		y: 28,
		duration: 1.05,
		ease: 'power3.out',
		stagger: 0.14,
		delay: delayFor(element),
		scrollTrigger: {
			trigger: element,
			start: entranceStart(element),
			once: true,
		},
		onComplete: () => clearEntrance(children, 'opacity,transform'),
	}), children, 'opacity,transform');
};

const bindEntrances = (root) => {
	const scope = root && root.querySelectorAll ? root : document;

	Object.keys(motions).forEach((className) => {
		scope.querySelectorAll(`.${className}`).forEach((element) => {
			play(element, motions[className]);
		});
	});

	scope.querySelectorAll('.staggerUp').forEach(playStagger);
};

const mm = gsap.matchMedia();

mm.add(DESKTOP_QUERY, (context) => {
	bindEntrances(document);

	const onPreview = () => {
		context.add(() => bindEntrances(document));
	};

	if (window.acf) {
		window.acf.addAction('render_block_preview', onPreview);
	}

	return () => {
		if (window.acf && window.acf.removeAction) {
			window.acf.removeAction('render_block_preview', onPreview);
		}

		document.querySelectorAll('[data-entrance]').forEach((element) => {
			delete element.dataset.entrance;
		});
	};
});
