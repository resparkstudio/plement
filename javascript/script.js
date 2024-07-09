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
import { Pagination, Controller } from 'swiper/modules';
import { gsap } from 'gsap';

import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

let resizeTimeout;
let standaloneList;
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
		modules: [Pagination],
		slidesPerView: 1,
		pagination: {
			el: '.swiper-pagination',
			bulletActiveClass: 'swiper-pagination-bullet-active',
			bulletClass: 'swiper-pagination-bullet',
		},
		autoHeight: true,
	});
}

function initStandalone() {
	const standaloneWrap = document.querySelector('.standalone-wrap');
	if (window.innerWidth < 768) {
		standaloneWrap.classList.add('swiper-wrapper');

		standaloneList = new Swiper('.standalone-list', {
			modules: [Pagination],
			slidesPerView: 1.1,
			centeredSlides: true,
			spaceBetween: 16,
			pagination: {
				el: '.swiper-pagination',
				bulletActiveClass: 'swiper-pagination-bullet-active',
				bulletClass: 'swiper-pagination-bullet',
			},
			autoHeight: true,
		});
	} else {
		if (standaloneWrap) {
			standaloneWrap.classList.remove('swiper-wrapper');
		}
		if (standaloneList) {
			standaloneList.destroy();
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

window.addEventListener('resize', debounce(initStandalone, 100));

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
		}
	);
};

const processNumberAnimation = function () {
	const steps = document.querySelectorAll('.process-item');
	steps.forEach((step) => {
		const number = step.querySelector('.step-heading');
		const tl = gsap.timeline({
			scrollTrigger: {
				trigger: step,
				start: 'center center',
				toggleActions: 'play none none reverse',
			},
		});

		tl.fromTo(
			[number],
			{
				color: '#D8D8D8',
			},
			{
				color: '#ED5623',
				duration: 0.3,
				ease: 'none',
			}
		);
	});
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

const handleScrollIntoView = () => {
	const menuItems = document.querySelectorAll('.menu-item a');

	const hash = window.location.hash.substring(1);
	if (hash) {
		setTimeout(() => {
			const element = document.getElementById(hash);
			if (element) {
				element.scrollIntoView({ behavior: 'smooth' });
			}
		}, 500);
	}
};

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
			setTimeout(refreshScrollTrigger, 1000)
		);
	});
};

initSwiper();
initStandalone();
processNumberAnimation();
processLineAnimation();
handleContactFormTransition();
handleScrollIntoView();
handleCountry();
handleButtonsWithScrollTriggerRefresh();
