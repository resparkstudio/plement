/**
 * Front-end JavaScript
 *
 * The JavaScript code you place here will be processed by esbuild. The output
 * file will be created at `../theme/js/script.min.js` and enqueued in
 * `../theme/functions.php`.
 *
 * For esbuild documentation, please see:
 * https://esbuild.github.io/
 */
import Swiper from 'swiper';
import { Pagination } from 'swiper/modules';

let resizeTimeout;

function initSwiper() {
	new Swiper('.services-list', {
		modules: [Pagination],
		slidesPerView: 1,
		pagination: {
			el: '.swiper-pagination',
			bulletActiveClass: 'swiper-pagination-bullet-active',
			bulletClass: 'swiper-pagination-bullet',
		},
	});

	new Swiper('.packages-list', {
		modules: [Pagination],
		slidesPerView: 1,
		pagination: {
			el: '.swiper-pagination',
			bulletActiveClass: 'swiper-pagination-bullet-active',
			bulletClass: 'swiper-pagination-bullet',
		},
	});

	new Swiper('.standalone-list', {
		modules: [Pagination],
		slidesPerView: 1,
		pagination: {
			el: '.swiper-pagination',
			bulletActiveClass: 'swiper-pagination-bullet-active',
			bulletClass: 'swiper-pagination-bullet',
		},
	});

	new Swiper('.testimonials-swiper', {
		modules: [Pagination],
		slidesPerView: 1,
		pagination: {
			el: '.swiper-pagination',
			bulletActiveClass: 'swiper-pagination-bullet-active',
			bulletClass: 'swiper-pagination-bullet',
		},
	});
}
function debounce(func, wait) {
	return function executedFunction(...args) {
		const later = () => {
			clearTimeout(resizeTimeout);
			func(...args);
		};
		clearTimeout(resizeTimeout);
		resizeTimeout = setTimeout(later, wait);
	};
}

initSwiper();

window.addEventListener('resize', debounce(initSwiper, 200));

//on .pricing-button click take the value and add &a2={value} to .calendly-inline-widget data-url
document.querySelectorAll('.pricing-button').forEach((button) => {
	button.addEventListener('click', (e) => {
		const value = e.target.value;
		document
			.querySelector('.calendly-inline-widget')
			.setAttribute(
				'data-url',
				`https://calendly.com/tomasatplement/intro-call?text_color=272727&primary_color=ed5623&a2=${value}`
			);
	});
});
