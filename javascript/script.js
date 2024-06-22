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
	});

	new Swiper('.packages-list', {
		modules: [Pagination],
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

initSwiper();
initStandalone();

window.addEventListener('resize', debounce(initStandalone, 200));

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

processNumberAnimation();
processLineAnimation();

document.querySelectorAll('.pricing-button').forEach((button) => {
	button.addEventListener('click', (e) => {
		const value = e.target.value;

		//check if the div already has the widget
		if (document.getElementById('calendlyDiv').hasChildNodes()) {
			document.getElementById('calendlyDiv').innerHTML = '';
		}

		Calendly.initInlineWidget({
			url: `https://calendly.com/tomasatplement/intro-call?text_color=272727&primary_color=ed5623&a2=${value}`,
			parentElement: document.getElementById('calendlyDiv'),
			prefill: {},
			utm: {},
		});
	});
});

document.querySelectorAll('.standalone-button').forEach((button) => {
	button.addEventListener('click', (e) => {
		const value = e.target.value;

		//check if the div already has the widget
		if (document.getElementById('calendlyDiv').hasChildNodes()) {
			document.getElementById('calendlyDiv').innerHTML = '';
		}

		Calendly.initInlineWidget({
			url: `https://calendly.com/tomasatplement/intro-call?text_color=272727&primary_color=ed5623&a1=${value}`,
			parentElement: document.getElementById('calendlyDiv'),
			prefill: {},
			utm: {},
		});
	});
});

const handleContactFormTransition = function () {
	var inputs = document.querySelectorAll('.wpcf7-form-control-wrap');
	console.log(inputs);
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

handleContactFormTransition();
