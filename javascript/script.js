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
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import Swiper from 'swiper';
import { Pagination } from 'swiper/modules';

let servicesList;
let resizeTimeout;

function initSwiper() {
	if (window.innerWidth <= 768) {
		servicesList = new Swiper('.services-list', {
			modules: [Pagination],
			slidesPerView: 1,
			pagination: {
				el: '.swiper-pagination',
				bulletActiveClass: 'swiper-pagination-bullet-active',
				bulletClass: 'swiper-pagination-bullet',
			},
		});
	} else {
		if (servicesList) {
			servicesList.destroy(true, true);
			servicesList = null;
		}
	}
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
