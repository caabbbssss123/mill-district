import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

if (!window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
	const mm = gsap.matchMedia();

	mm.add('(min-width: 783px)', () => {
		gsap.utils.toArray('.image-banner').forEach((banner) => {
			const image = banner.querySelector('.image-banner__image');

			if (!image) {
				return;
			}

			gsap.fromTo(
				image,
				{
					yPercent: -20,
				},
				{
					yPercent: 20,
					ease: 'none',
					scrollTrigger: {
						trigger: banner,
						start: 'top bottom',
						end: 'bottom top',
						scrub: 1,
						invalidateOnRefresh: true,
					},
				}
			);
		});
	});
}
