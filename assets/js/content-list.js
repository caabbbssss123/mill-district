const desktopQuery = '(min-width: 993px)';

const positionList = (list) => {
	const desktop = window.matchMedia(desktopQuery).matches;

	list.querySelectorAll('.content-list__item').forEach((item) => {
		const image = item.querySelector('.content-list__image');

		if (!image) {
			return;
		}

		if (!desktop) {
			image.style.top = '';
			image.style.transform = '';
			return;
		}

		const imageHeight = image.offsetHeight;
		const listHeight = list.clientHeight;
		let top = item.offsetTop + (item.offsetHeight - imageHeight) / 2;

		if (imageHeight < listHeight) {
			top = Math.max(0, Math.min(top, listHeight - imageHeight));
		} else {
			top = 0;
		}

		image.style.transform = 'none';
		image.style.top = `${top - item.offsetTop}px`;
	});
};

const bindList = (list) => {
	const items = [...list.querySelectorAll('.content-list__item')];
	const defaultItem = list.querySelector('.content-list__item.is-active') || items[0];

	if (list.dataset.bound !== 'true') {
		list.dataset.bound = 'true';

		items.forEach((item) => {
			item.addEventListener('mouseenter', () => {
				if (!window.matchMedia(desktopQuery).matches) {
					return;
				}

				items.forEach((candidate) => {
					candidate.classList.toggle('is-active', candidate === item);
				});
			});
		});

		list.addEventListener('mouseleave', () => {
			if (!window.matchMedia(desktopQuery).matches || !defaultItem) {
				return;
			}

			items.forEach((candidate) => {
				candidate.classList.toggle('is-active', candidate === defaultItem);
			});
		});

		list.querySelectorAll('.content-list__image img').forEach((img) => {
			if (!img.complete) {
				img.addEventListener('load', () => positionList(list));
			}
		});

		if (typeof ResizeObserver !== 'undefined') {
			const observer = new ResizeObserver(() => positionList(list));
			observer.observe(list);
		}
	}

	positionList(list);
};

const initContentLists = () => {
	document.querySelectorAll('.js-content-list').forEach(bindList);
};

if (document.readyState === 'loading') {
	document.addEventListener('DOMContentLoaded', initContentLists);
} else {
	initContentLists();
}

if (window.acf) {
	window.acf.addAction('render_block_preview/type=content-list', initContentLists);
}
