const bindAccordion = (root) => {
	if (root.dataset.bound === 'true') {
		return;
	}

	root.dataset.bound = 'true';

	root.querySelectorAll('.faqs-accordion__question').forEach((button) => {
		button.addEventListener('click', () => {
			const item = button.closest('.faqs-accordion__item');

			if (!item) {
				return;
			}

			const answer = item.querySelector('.faqs-accordion__answer');
			const open = item.classList.toggle('is-open');

			button.setAttribute('aria-expanded', open ? 'true' : 'false');

			if (answer) {
				answer.setAttribute('aria-hidden', open ? 'false' : 'true');
			}
		});
	});
};

const initFaqsAccordions = () => {
	document.querySelectorAll('.js-faqs-accordion').forEach(bindAccordion);
};

if (document.readyState === 'loading') {
	document.addEventListener('DOMContentLoaded', initFaqsAccordions);
} else {
	initFaqsAccordions();
}

if (window.acf) {
	window.acf.addAction('render_block_preview/type=faqs-accordion', initFaqsAccordions);
}
