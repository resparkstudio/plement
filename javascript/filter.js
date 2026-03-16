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

const industryFilter = document.querySelectorAll('.industry-filter');
const platformFilter = document.querySelectorAll('.platform-filter');

industryFilter.forEach((filter) => {
	filter.addEventListener('click', () => {
		page = 0;
		const industryValue = filter.getAttribute('data-value');
		const currentPlatform = getParamValue('platform');

		filterBlogs(industryValue, currentPlatform);
	});
});

platformFilter.forEach((filter) => {
	filter.addEventListener('click', () => {
		page = 0;
		const platformValue = filter.getAttribute('data-value');
		const currentIndustry = getParamValue('industry');

		filterBlogs(currentIndustry, platformValue);
	});
});

const blogsLoadMoreBtn = document.getElementById('blogs-load-more');
let blogOffset = blogsLoadMoreBtn
	? parseInt(blogsLoadMoreBtn.dataset.offset || '0', 10)
	: 0;
let currentBlogIndustry = getParamValue('industry') || '';
let currentBlogPlatform = getParamValue('platform') || '';

const updateBlogLoadMore = (hasMore, nextOffset) => {
	if (!blogsLoadMoreBtn) return;
	blogOffset = nextOffset;
	blogsLoadMoreBtn.dataset.offset = nextOffset;
	if (hasMore) {
		blogsLoadMoreBtn.classList.remove('hidden');
	} else {
		blogsLoadMoreBtn.classList.add('hidden');
	}
};

const filterBlogs = (industry, platform) => {
	const results = document.getElementById('blogs-results');

	currentBlogIndustry = industry !== 'all' ? industry || '' : '';
	currentBlogPlatform = platform !== 'all' ? platform || '' : '';

	if (industry) setQueryParams('industry', industry);
	if (platform) setQueryParams('platform', platform);

	const fetchBlogs = async () => {
		results.style.opacity = '0.5';
		if (blogsLoadMoreBtn) blogsLoadMoreBtn.classList.add('hidden');

		try {
			const response = await fetch('/wp-admin/admin-ajax.php?action=plmt_filter_blogs', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json',
				},
				body: JSON.stringify({
					industry: currentBlogIndustry,
					platform: currentBlogPlatform,
				}),
			});

			const data = await response.json();

			if (data.success && data.data.html !== undefined) {
				results.innerHTML = data.data.html;
				updateBlogLoadMore(data.data.has_more, data.data.next_offset);
			}
		} catch (error) {
			console.error('Blog filter AJAX error:', error);
		} finally {
			results.style.opacity = '1';
		}
	};

	fetchBlogs();
};

if (blogsLoadMoreBtn) {
	blogsLoadMoreBtn.addEventListener('click', async () => {
		blogsLoadMoreBtn.disabled = true;
		const results = document.getElementById('blogs-results');

		try {
			const response = await fetch('/wp-admin/admin-ajax.php?action=plmt_load_more_blogs', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json',
				},
				body: JSON.stringify({
					industry: currentBlogIndustry,
					platform: currentBlogPlatform,
					offset: blogOffset,
				}),
			});

			const data = await response.json();

			if (data.success && data.data.html !== undefined) {
				results.insertAdjacentHTML('beforeend', data.data.html);
				updateBlogLoadMore(data.data.has_more, data.data.next_offset);
			}
		} catch (error) {
			console.error('Blog load more AJAX error:', error);
		} finally {
			blogsLoadMoreBtn.disabled = false;
		}
	});
}

document.addEventListener('DOMContentLoaded', function () {
	const industrySelect = document.getElementById('blog-industry');
	const platformSelect = document.getElementById('blog-platform');
	const results = document.getElementById('blogs-results');

	if (!industrySelect || !platformSelect || !results) return;

	const fetchBlogs = async () => {
		results.style.opacity = '0.5';

		try {
			const response = await fetch('/wp-admin/admin-ajax.php?action=plmt_filter_blogs', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json',
				},
				body: JSON.stringify({
					industry: industrySelect.value,
					platform: platformSelect.value,
				}),
			});

			const data = await response.json();

			if (data.success && data.data.html !== undefined) {
				results.innerHTML = data.data.html;
			}
		} catch (error) {
			console.error('Blog filter AJAX error:', error);
		} finally {
			results.style.opacity = '1';
		}
	};

	industrySelect.addEventListener('change', fetchBlogs);
	platformSelect.addEventListener('change', fetchBlogs);
});