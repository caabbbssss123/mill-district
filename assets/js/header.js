import gsap from 'gsap';

const header = document.querySelector('#main-header');
const toggle = document.querySelector('.navbar-toggle');
const menu = document.querySelector('#main-menu');
const backdrop = document.querySelector('.menu-backdrop');

if (header && toggle && menu && backdrop) {
	const items = menu.querySelectorAll('.menu > li, .social-links > li');

	gsap.set(menu, { yPercent: -100 });
	gsap.set(items, { autoAlpha: 0 });
	gsap.set(backdrop, { autoAlpha: 0 });

	const smoothContent = document.getElementById('smooth-content');
	const smoothWrapper = document.getElementById('smooth-wrapper');

	// The page scroller is transformed, which would carry this fixed overlay
	// with the scroll. Shift it back so the blur stays on the visible screen.
	if (smoothContent && smoothWrapper) {
		gsap.ticker.add(() => {
			const shift = smoothWrapper.getBoundingClientRect().top - smoothContent.getBoundingClientRect().top;

			gsap.set(backdrop, { y: shift });
		});
	}

	const setPageScroll = (locked) => {
		document.documentElement.classList.toggle('menu-open', locked);
		document.body.classList.toggle('menu-open', locked);
	};

	const timeline = gsap.timeline({
		paused: true,
		onReverseComplete: () => {
			header.classList.remove('is-open');
			setPageScroll(false);
		},
	});

	timeline
		.to(backdrop, {
			autoAlpha: 1,
			duration: 0.45,
			ease: 'power2.out',
		}, 0)
		.to(menu, {
			yPercent: 0,
			duration: 0.6,
			ease: 'power3.out',
		}, 0)
		.to(
			items,
			{
				autoAlpha: 1,
				duration: 0.4,
				stagger: 0.1,
				ease: 'power2.out',
			},
			'>'
		);

	const openMenu = () => {
		header.classList.add('is-open');
		setPageScroll(true);
		toggle.classList.remove('collapsed');
		toggle.setAttribute('aria-expanded', 'true');
		timeline.play();
	};

	const closeMenu = () => {
		toggle.classList.add('collapsed');
		toggle.setAttribute('aria-expanded', 'false');
		timeline.reverse();
	};

	toggle.addEventListener('click', () => {
		const isClosed = timeline.reversed() || timeline.progress() === 0;

		if (isClosed) {
			openMenu();
		} else {
			closeMenu();
		}
	});

	document.addEventListener('keydown', (event) => {
		if (event.key === 'Escape' && header.classList.contains('is-open')) {
			closeMenu();
		}
	});
}
