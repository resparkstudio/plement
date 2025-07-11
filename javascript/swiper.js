import Swiper from 'swiper';
import { Pagination, Controller, Navigation } from 'swiper/modules';

function initSwiper() {
	new Swiper('.services-list', {
		modules: [Pagination],
		slidesPerView: 1,
		pagination: {
			el: '.swiper-pagination',
			bulletActiveClass: 'swiper-pagination-bullet-active',
			bulletClass: 'swiper-pagination-bullet',
		},
		autoHeight: true,
	});

	const packageSwiper = new Swiper('.packages-list', {
		modules: [Pagination, Controller],
		slidesPerView: 1.1,
		spaceBetween: 16,
		initialSlide: 2,
		autoHeight: true,
		pagination: {
			el: '.swiper-pagination',
			bulletActiveClass: 'swiper-pagination-bullet-active',
			bulletClass: 'swiper-pagination-bullet',
		},
	});

	packageSwiper.on('slideChange', function () {
		tippy.hideAll({ duration: 0 });
	});

	const packageCompareSwiper = new Swiper('.package-compare-mobile', {
		modules: [Pagination, Controller],
		slidesPerView: 1,
		initialSlide: 2,
		pagination: {
			el: '.swiper-pagination',
			bulletActiveClass: 'swiper-pagination-bullet-active',
			bulletClass: 'swiper-pagination-bullet',
		},
		autoHeight: true,
		resizeObserver: true,
	});

	packageSwiper.controller.control = packageCompareSwiper;
	packageCompareSwiper.controller.control = packageSwiper;

	new Swiper('.testimonials-swiper', {
		modules: [Navigation],
		loop: true,
		loopAdditionalSlides: 4,
		slidesPerView: 1.2,
		breakpoints: {
			768: {
				slidesPerView: 2,
			},
		},
		initialSlide: 2,
		spaceBetween: 16,
		navigation: {
			nextEl: '.custom-swiper-button-next',
			prevEl: '.custom-swiper-button-prev',
		},
	});

	new Swiper('.help-center-gallery', {
		modules: [Navigation],
		autoHeight: true,
		// slidesPerView: 'auto',
		breakpoints: {
			768: {
				slidesPerView: 1.2,
				spaceBetween: 16,
			},
			1024: {
				slidesPerView: 'auto',
				spaceBetween: 16,
			},
		},
		spaceBetween: 16,
		navigation: {
			nextEl: '.custom-swiper-button-next',
			prevEl: '.custom-swiper-button-prev',
		},
	});

	new Swiper('.other-studies-swiper', {
		modules: [Pagination, Navigation],
		autoHeight: true,
		slidesPerView: 1,
		breakpoints: {
			1024: {
				slidesPerView: 2,
			},
		},
		spaceBetween: 16,
		pagination: {
			el: '.swiper-pagination',
			bulletActiveClass: 'swiper-pagination-bullet-active',
			bulletClass: 'swiper-pagination-bullet',
		},
		navigation: {
			nextEl: '.custom-swiper-button-next',
			prevEl: '.custom-swiper-button-prev',
		},
	});

	new Swiper('.studies-category-swiper', {
		slidesPerView: 'auto',
		spaceBetween: 8,
	});
}

export default initSwiper;
