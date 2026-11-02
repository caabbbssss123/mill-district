import gsap from 'gsap';
import { ScrollToPlugin } from 'gsap/ScrollToPlugin';
import { ScrollSmoother } from 'gsap/ScrollSmoother';

gsap.registerPlugin(ScrollToPlugin, ScrollSmoother);

const scrollTarget = (hash) => {
	if (!hash || hash === '#') {
		return null;
	}

	try {
		const byId = document.querySelector(hash);

		if (byId) {
			return byId;
		}

		return document.querySelector(`[data-scroll="${hash}"]`);
	} catch (error) {
		return null;
	}
};

const scrollToSection = (hash) => {
	const target = scrollTarget(hash);

	if (!target) {
		return false;
	}

	const smoother = ScrollSmoother.get();

	if (smoother) {
		smoother.scrollTo(target, true, 'top top');
	} else {
		gsap.to(window, {
			duration: 0.9,
			scrollTo: {
				y: target.getBoundingClientRect().top + window.scrollY,
				autoKill: true,
			},
			ease: 'power2.inOut',
		});
	}

	if (window.history && window.history.replaceState) {
		window.history.replaceState(null, '', hash);
	}

	return true;
};

document.addEventListener('click', (event) => {
	if (event.metaKey || event.ctrlKey || event.shiftKey || event.altKey || event.button !== 0) {
		return;
	}

	const anchor = event.target.closest ? event.target.closest('a[href*="#"]') : null;

	if (!anchor) {
		return;
	}

	let link;

	try {
		link = new URL(anchor.href, window.location.href);
	} catch (error) {
		return;
	}

	if (
		link.origin !== window.location.origin ||
		link.pathname !== window.location.pathname ||
		!link.hash ||
		link.hash === '#'
	) {
		return;
	}

	if (!scrollToSection(link.hash)) {
		return;
	}

	event.preventDefault();

	const header = document.querySelector('#main-header');
	const toggle = document.querySelector('.navbar-toggle');

	if (header && toggle && header.classList.contains('is-open')) {
		toggle.click();
	}
});

if (window.location.hash && scrollTarget(window.location.hash)) {
	window.addEventListener('load', () => {
		scrollToSection(window.location.hash);
	});
}
