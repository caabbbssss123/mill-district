import gsap from 'gsap';

const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

const parseStat = (raw) => {
	const text = String(raw).trim();
	const grouped = text.includes(',');
	const numeric = text.replace(/,/g, '');

	if (!/^-?\d+(\.\d+)?$/.test(numeric)) {
		return null;
	}

	return {
		value: Number(numeric),
		decimals: (numeric.split('.')[1] || '').length,
		grouped,
	};
};

const formatStat = (value, decimals, grouped) => {
	return value.toLocaleString('en-US', {
		minimumFractionDigits: decimals,
		maximumFractionDigits: decimals,
		useGrouping: grouped,
	});
};

const countStat = (element) => {
	if (element.dataset.counted === 'true') {
		return;
	}

	const parsed = parseStat(element.dataset.value);

	element.dataset.counted = 'true';

	if (!parsed || prefersReducedMotion) {
		return;
	}

	const state = { value: 0 };

	element.textContent = formatStat(0, parsed.decimals, parsed.grouped);

	gsap.to(state, {
		value: parsed.value,
		duration: 1.8,
		ease: 'power2.out',
		onUpdate: () => {
			element.textContent = formatStat(state.value, parsed.decimals, parsed.grouped);
		},
	});
};

const observeStats = (root) => {
	const scope = root && root.querySelectorAll ? root : document;
	const numbers = scope.querySelectorAll('.js-stat-number:not([data-observed="true"])');

	if (!numbers.length) {
		return;
	}

	if (typeof IntersectionObserver === 'undefined') {
		numbers.forEach((number) => {
			number.dataset.observed = 'true';
			countStat(number);
		});
		return;
	}

	const observer = new IntersectionObserver(
		(entries) => {
			entries.forEach((entry) => {
				if (!entry.isIntersecting) {
					return;
				}

				countStat(entry.target);
				observer.unobserve(entry.target);
			});
		},
		{ threshold: 0.4 }
	);

	numbers.forEach((number) => {
		number.dataset.observed = 'true';
		observer.observe(number);
	});
};

const initStatsColumns = () => {
	observeStats(document);
};

if (document.readyState === 'loading') {
	document.addEventListener('DOMContentLoaded', initStatsColumns);
} else {
	initStatsColumns();
}

if (window.acf) {
	window.acf.addAction('render_block_preview/type=stats-columns', initStatsColumns);
}
