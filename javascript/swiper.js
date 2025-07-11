import Swiper from 'swiper';
import { Pagination, Navigation } from 'swiper/modules';

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

	new Swiper('.packages-list', {
		modules: [Pagination],
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
		slidesPerView: 1.3,
		spaceBetween: 16,
		breakpoints: {
			1024: {
				slidesPerView: 'auto',
				spaceBetween: 16,
			},
		},
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
				slidesPerView: 'auto',
			},
		},
		spaceBetween: 16,
		loop: true,
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

	new Swiper('.compare-slider', {
		modules: [Pagination],
		slidesPerView: 1.05,
		spaceBetween: 8,
		pagination: {
			el: '.swiper-pagination',
			bulletActiveClass: 'swiper-pagination-bullet-active',
			bulletClass: 'swiper-pagination-bullet',
		},
	});

	new Swiper('.filter-slider', {
		slidesPerView: 'auto',
		spaceBetween: 8,
	});
}

export default initSwiper;
