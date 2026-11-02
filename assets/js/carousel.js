const GAP = 20;

const layoutFor = (width) => {
	if (width >= 993) {
		return { columns: 3, peek: 80 };
	}

	if (width >= 783) {
		return { columns: 2, peek: 60 };
	}

	return { columns: 1, peek: 40 };
};

const sizeSlides = (element) => {
	const slides = element.querySelectorAll('.swiper-slide');
	const { columns, peek } = layoutFor(element.clientWidth);
	const slideWidth = (element.clientWidth - peek - columns * GAP) / columns;

	slides.forEach((slide) => {
		slide.style.width = `${slideWidth}px`;
	});
};

const initContentCarousel = (element) => {
	if (element.swiper || typeof window.Swiper === 'undefined') {
		return;
	}

	const section = element.closest('.content-carousel');
	const pagination = section ? section.querySelector('.content-carousel__pagination') : null;

	sizeSlides(element);

	new window.Swiper(element, {
		slidesPerView: 'auto',
		spaceBetween: GAP,
		watchOverflow: true,
		grabCursor: true,
		pagination: {
			el: pagination,
			clickable: true,
		},
		on: {
			beforeResize() {
				sizeSlides(element);
			},
		},
	});
};

const initContentCarousels = () => {
	document.querySelectorAll('.js-content-carousel').forEach(initContentCarousel);
};

if (document.readyState === 'loading') {
	document.addEventListener('DOMContentLoaded', initContentCarousels);
} else {
	initContentCarousels();
}

if (window.acf) {
	window.acf.addAction('render_block_preview/type=content-carousel', initContentCarousels);
}
