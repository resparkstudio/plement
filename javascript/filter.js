const setQueryParams = (key, value) => {
	const url = new URL(window.location.href);
	const params = new URLSearchParams(url.search.slice(1));

	if (value === '' || value === 'all') {
		params.delete(key);
	} else {
		params.set(key, value);
	}
	window.history.pushState({}, '', `${url.pathname}?${params}`);
};

const getParamValue = (param) => {
	const url = new URL(window.location.href);
	const params = new URLSearchParams(url.search.slice(1));
	const value = params.get(param);

	return value;
};

const categoryFilter = document.querySelectorAll('.category-filter');
const filterCaseStudies = (category) => {
	//get current category filter from URL
	const currentCategory = getParamValue('category');

	//if the category is the same as the current category, remove that specific category from the URL
	let updatedFilter = category;
	if (currentCategory) {
		if (!category) {
			updatedFilter = '';
		} else if (currentCategory.includes(category)) {
			updatedFilter = currentCategory.replace(category, '');
		} else {
			updatedFilter = currentCategory + ',' + category;
		}
	}

	setQueryParams('category', updatedFilter);

	fetch('/wp-admin/admin-ajax.php', {
		method: 'POST',
		headers: {
			'Content-Type': 'application/x-www-form-urlencoded',
		},
		body: new URLSearchParams({
			action: 'filter_case_studies',
			category: updatedFilter || 'all',
		}),
	}).then((response) => {
		response.json().then((response) => {
			const caseStudies = document.querySelector('.case-studies-container');
			caseStudies.innerHTML = response.html;

			categoryFilter.forEach((filter) => {
				filter.classList.remove('active');

				const filterWithoutSeparator = updatedFilter.replace(/,/g, '');

				if (filterWithoutSeparator === '' && !filter.value) {
					filter.classList.add('active');
					setQueryParams('category', '');
					return;
				}

				if (filter.value && updatedFilter.includes(filter.value)) {
					filter.classList.add('active');
				}
			});

			const loadMoreButton = document.querySelector('.load-more-button');

			if (response.moreCount) {
				loadMoreButton.style.display = 'block';
				loadMoreButton.innerHTML = `See more (${response.moreCount})`;
			} else {
				loadMoreButton.style.display = 'none';
			}
		});
	});
};

const loadMoreButton = document.querySelector('.load-more-button');
const loadMoreCaseStudies = (page, category) => {
	fetch('/wp-admin/admin-ajax.php', {
		method: 'POST',
		headers: {
			'Content-Type': 'application/x-www-form-urlencoded',
		},
		body: new URLSearchParams({
			action: 'load_more_case_studies',
			page: page,
			category: category || 'all',
		}),
	}).then((response) => {
		response.json().then((response) => {
			const caseStudies = document.querySelector('.case-studies-container');
			caseStudies.insertAdjacentHTML('beforeend', response.html);

			if (!response.has_more_posts) {
				loadMoreButton.style.display = 'none';
			}
		});
	});
};

let page = 0;
categoryFilter.forEach((filter) => {
	filter.addEventListener('click', () => {
		page = 0;
		filterCaseStudies(filter.value);
	});
});

if (loadMoreButton) {
	loadMoreButton.addEventListener('click', () => {
		page++;
		const currentCategory = getParamValue('category');
		loadMoreCaseStudies(page, currentCategory);
	});
}
