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
import { Pagination, Controller, Navigation } from 'swiper/modules';
import { gsap } from 'gsap';

import { ScrollTrigger } from 'gsap/ScrollTrigger';
import SplitType from 'split-type';

gsap.registerPlugin(ScrollTrigger);

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
		centeredSlides: true,
		spaceBetween: 16,
		initialSlide: 2,
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
		slidesPerView: 'auto',
		spaceBetween: 16,
		initialSlide: 1,
		centeredSlides: true,
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
}

const processLineAnimation = function () {
	const animatedLine = document.querySelector('.process-line');
	if (!animatedLine) return;
	const lastItem = document.querySelector('.process-item.is-last');
	const lastItemHeight = lastItem.offsetHeight;
	const animatedLineWrap = document.querySelector('.process-line-wrap');
	animatedLineWrap.style.height = `calc(100% - ${lastItemHeight}px * 0.8)`;

	gsap.set(animatedLine, { transformOrigin: 'center top' });

	const tl = gsap.timeline({
		scrollTrigger: {
			trigger: animatedLineWrap,
			start: 'top center',
			end: 'bottom center',
			scrub: 1,
		},
	});

	tl.fromTo(
		animatedLine,
		{
			scaleY: 0,
		},
		{
			scaleY: 1,
			duration: 3,
			ease: 'none',
		},
	);
};

document.querySelectorAll('.pricing-button').forEach((button) => {
	button.addEventListener('click', (e) => {
		const value = e.target.value;
		if (document.getElementById('calendlyDiv').hasChildNodes()) {
			document.getElementById('calendlyDiv').innerHTML = '';
		}

		Calendly.initInlineWidget({
			url: `https://calendly.com/plement/intro-call?hide_gdpr_banner=1&text_color=272727&primary_color=ed5623&a2=${value}`,
			parentElement: document.getElementById('calendlyDiv'),
		});
	});
});

document.querySelectorAll('.contact-button').forEach((button) => {
	button.addEventListener('click', () => {
		if (document.getElementById('calendlyDiv').hasChildNodes()) {
			document.getElementById('calendlyDiv').innerHTML = '';
		}
		Calendly.initInlineWidget({
			url: `https://calendly.com/plement/introduction-call-1?hide_gdpr_banner=1&text_color=272727&primary_color=ed5623`,
			parentElement: document.getElementById('calendlyDiv'),
		});
	});
});

document.querySelectorAll('.standalone-button').forEach((button) => {
	button.addEventListener('click', (e) => {
		const value = e.target.value;

		if (document.getElementById('calendlyDiv').hasChildNodes()) {
			document.getElementById('calendlyDiv').innerHTML = '';
		}
		const valueMap = {
			'Chat / Messaging': 1,
			'Call Center': 2,
			'Help Center': 3,
			'Customer Portal': 4,
			Timeshift: 5,
			Chatbot: 6,
			'Customer Satisfaction': 7,
		};

		const valueArray = value.split(',');

		const values = valueArray.map((item) => {
			return valueMap[item];
		});

		Calendly.initInlineWidget({
			url: `https://calendly.com/plement/introduction-call?hide_gdpr_banner=1&text_color=272727&primary_color=ed5623&a2=${values.join(',')}`,
			parentElement: document.getElementById('calendlyDiv'),
		});
	});
});

const handleContactFormTransition = function () {
	var inputs = document.querySelectorAll('.wpcf7-form-control-wrap');

	if (inputs.length > 0) {
		inputs.forEach(function (input) {
			const label = input.parentElement.querySelector('label');
			const inputField = input.querySelector('.wpcf7-form-control');

			if (!label) return;

			inputField.addEventListener('input', function () {
				if (this.value) {
					label.style.color = '#ababab';
				} else {
					label.style.color = '#000';
				}
			});

			inputField.addEventListener('focus', function () {
				label.style.color = '#ababab';
			});

			inputField.addEventListener('blur', function () {
				if (!this.value) {
					label.style.color = '#000';
				}
			});
		});
	}
};

const smoothScrollToElementById = (hash) => {
	const element = document.getElementById(hash);
	if (element) {
		element.scrollIntoView({ behavior: 'smooth' });
	}
};

const handleScrollIntoView = () => {
	const menuItems = document.querySelectorAll('.menu-item a');
	const scrollToLinks = document.querySelectorAll('.scroll-to');

	const isHomePage = window.location.pathname === '/';

	const addClickListener = (item) => {
		item.addEventListener('click', (e) => {
			e.preventDefault();
			const href = e.target.getAttribute('href');
			if (!href) return;
			const hash = href.split('#')[1];

			if (!isHomePage) {
				sessionStorage.setItem('scrollToHash', hash);
				window.location.href = '/';
			} else {
				smoothScrollToElementById(hash);
			}
		});
	};

	menuItems.forEach(addClickListener);
	scrollToLinks.forEach(addClickListener);
};

handleScrollIntoView();

if (window.location.pathname === '/') {
	window.addEventListener('load', () => {
		const hash = sessionStorage.getItem('scrollToHash');
		if (hash) {
			smoothScrollToElementById(hash);
			sessionStorage.removeItem('scrollToHash');
		}
	});
}

const getUserCountry = async () => {
	const response = await fetch('https://ipapi.co/json/');
	const data = await response.json();
	return data;
};

const handleCountry = async () => {
	const response = await getUserCountry();

	const country = response.country;

	if (country === 'US') {
		window.dispatchEvent(new CustomEvent('uscountry'));
	}
};

const refreshScrollTrigger = () => {
	ScrollTrigger.refresh();
};

const handleButtonsWithScrollTriggerRefresh = () => {
	const buttons = document.querySelectorAll('.refreshScrollTrigger');
	buttons.forEach((button) => {
		button.addEventListener('click', () =>
			setTimeout(refreshScrollTrigger, 1000),
		);
	});
};

const arrow =
	'<div class="z-1 flex justify-center items-center relative overflow-hidden "><div class="justify-center items-center w-[1.125rem] h-[1.125rem] transition-transform duration-300 absolute translate-x-[-100%] translate-y-[100%] group-hover:translate-x-0 group-hover:translate-y-0"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--ic" width="100%" height="100%" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="currentColor" d="M6 6v2h8.59L5 17.59L6.41 19L16 9.41V18h2V6z"></path></svg></div><div class="justify-center items-center w-[1.125rem] h-[1.125rem] transition-transform duration-300 group-hover:translate-x-[100%] group-hover:translate-y-[-100%]"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--ic" width="100%" height="100%" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="currentColor" d="M6 6v2h8.59L5 17.59L6.41 19L16 9.41V18h2V6z"></path></svg></div></div>';

const addArrow = () => {
	const richContent = document.querySelector('.rich-content');
	if (!richContent) return;
	const aTags = richContent.querySelectorAll('a');
	aTags.forEach((a) => {
		const span = document.createElement('span');
		span.innerHTML = a.innerHTML;
		a.innerHTML = '';
		a.appendChild(span);
		span.insertAdjacentHTML('beforeend', arrow);
		a.classList.add('group', 'inline-block');
		span.classList.add('flex', 'items-center');
	});
};

const handleTextSplit = () => {
	const elements = document.querySelectorAll('.split-text');
	if (!elements) return;

	elements.forEach((element) => {
		const split = new SplitType(element, {
			types: 'words',
		});
	});
};

initSwiper();
processLineAnimation();
handleContactFormTransition();
handleCountry();
handleButtonsWithScrollTriggerRefresh();
addArrow();
handleTextSplit();
