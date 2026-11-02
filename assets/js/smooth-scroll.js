import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import { ScrollSmoother } from 'gsap/ScrollSmoother';

gsap.registerPlugin(ScrollTrigger, ScrollSmoother);

const wrapper = document.getElementById('smooth-wrapper');
const content = document.getElementById('smooth-content');

if (wrapper && content) {
	document.querySelectorAll('.card-grid__popup').forEach((popup) => {
		document.body.appendChild(popup);
	});

	const desktopQuery = window.matchMedia('(min-width: 783px)');
	const reduceMotionQuery = window.matchMedia('(prefers-reduced-motion: reduce)');

	let smoother = null;
	let scrollLocked = document.body.classList.contains('popup-open') || document.body.classList.contains('menu-open');

	const fitAdminBar = () => {
		const adminBar = document.getElementById('wpadminbar');

		if (!adminBar) {
			content.style.paddingBottom = '';
			document.documentElement.style.removeProperty('margin-top');
			return;
		}

		const height = adminBar.offsetHeight;

		// ScrollSmoother measures against the full window. The admin bar shortens
		// the visible area by the same amount, so the footer would stay clipped
		// without this extra distance. The bar's html margin would then add empty scroll.
		wrapper.style.top = `${height}px`;
		wrapper.style.bottom = 'auto';
		wrapper.style.height = `calc(100% - ${height}px)`;
		content.style.paddingBottom = `${height}px`;
		document.documentElement.style.setProperty('margin-top', '0', 'important');
	};

	const clearSmoothScroll = () => {
		wrapper.style.top = '';
		wrapper.style.bottom = '';
		wrapper.style.height = '';
		content.style.paddingBottom = '';
		document.documentElement.style.removeProperty('margin-top');
		document.body.classList.remove('has-smooth-scroll');
	};

	const enableSmoothScroll = () => {
		if (smoother || !desktopQuery.matches || reduceMotionQuery.matches) {
			return;
		}

		fitAdminBar();

		smoother = ScrollSmoother.create({
			wrapper,
			content,
			smooth: 1,
			smoothTouch: 0.1,
			effects: true,
		});

		document.body.classList.add('has-smooth-scroll');
		fitAdminBar();

		if (scrollLocked) {
			smoother.paused(true);
		}

		ScrollTrigger.addEventListener('refreshInit', fitAdminBar);
	};

	const disableSmoothScroll = () => {
		ScrollTrigger.removeEventListener('refreshInit', fitAdminBar);

		if (smoother) {
			smoother.kill();
			smoother = null;
		}

		clearSmoothScroll();
	};

	const classObserver = new MutationObserver(() => {
		const isLocked = document.body.classList.contains('popup-open') || document.body.classList.contains('menu-open');

		if (isLocked === scrollLocked) {
			return;
		}

		scrollLocked = isLocked;

		if (smoother) {
			smoother.paused(isLocked);
		}
	});

	classObserver.observe(document.body, {
		attributes: true,
		attributeFilter: ['class'],
	});

	desktopQuery.addEventListener('change', () => {
		if (desktopQuery.matches) {
			enableSmoothScroll();
		} else {
			disableSmoothScroll();
		}
	});

	reduceMotionQuery.addEventListener('change', () => {
		if (reduceMotionQuery.matches) {
			disableSmoothScroll();
		} else {
			enableSmoothScroll();
		}
	});

	enableSmoothScroll();
}
