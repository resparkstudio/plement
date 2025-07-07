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
const toolFilter = document.querySelectorAll('.tool-filter');

const filterCaseStudies = (category, tool) => {
	// Set the filters directly (no multiple selection logic)
	const updatedCategoryFilter = category || '';
	const updatedToolFilter = tool || '';

	setQueryParams('category', updatedCategoryFilter);
	setQueryParams('tool', updatedToolFilter);

	fetch('/wp-admin/admin-ajax.php', {
		method: 'POST',
		headers: {
			'Content-Type': 'application/x-www-form-urlencoded',
		},
		body: new URLSearchParams({
			action: 'filter_case_studies',
			category: category || 'all',
			tool: tool || 'all',
		}),
	}).then((response) => {
		response.json().then((response) => {
			const caseStudies = document.querySelector('.case-studies-container');
			caseStudies.innerHTML = response.html;

			// Remove active class from all category filters first
			categoryFilter.forEach((filter) => {
				filter.classList.remove('active');
			});

			// Add active class only to the selected category filter
			categoryFilter.forEach((filter) => {
				if (updatedCategoryFilter === '' && !filter.value) {
					filter.classList.add('active');
				} else if (filter.value && filter.value === updatedCategoryFilter) {
					filter.classList.add('active');
				}
			});

			// Remove active class from all tool filters first
			toolFilter.forEach((filter) => {
				filter.classList.remove('active');
			});

			// Add active class only to the selected tool filter
			toolFilter.forEach((filter) => {
				if (updatedToolFilter === '' && !filter.value) {
					filter.classList.add('active');
				} else if (filter.value && filter.value === updatedToolFilter) {
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
const loadMoreCaseStudies = (page, category, tool) => {
	fetch('/wp-admin/admin-ajax.php', {
		method: 'POST',
		headers: {
			'Content-Type': 'application/x-www-form-urlencoded',
		},
		body: new URLSearchParams({
			action: 'load_more_case_studies',
			page: page,
			category: category || 'all',
			tool: tool || 'all',
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

// Category filter event listeners
categoryFilter.forEach((filter) => {
	filter.addEventListener('click', () => {
		page = 0;
		const categoryValue = filter.getAttribute('data-value');
		const currentTool = getParamValue('tool');

		filterCaseStudies(categoryValue, currentTool);
	});
});

// Tool filter event listeners
toolFilter.forEach((filter) => {
	filter.addEventListener('click', () => {
		page = 0;
		const toolValue = filter.getAttribute('data-value');
		const currentCategory = getParamValue('category');

		filterCaseStudies(currentCategory, toolValue);
	});
});

if (loadMoreButton) {
	loadMoreButton.addEventListener('click', () => {
		page++;
		const currentCategory = getParamValue('category');
		const currentTool = getParamValue('tool');
		loadMoreCaseStudies(page, currentCategory, currentTool);
	});
}
