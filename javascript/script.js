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

import { gsap } from 'gsap';

import { ScrollTrigger } from 'gsap/ScrollTrigger';
import SplitType from 'split-type';

import './filter';
import initSwiper from './swiper';

gsap.registerPlugin(ScrollTrigger);

document.querySelectorAll('.pricing-button').forEach((button) => {
  button.addEventListener('click', (e) => {
    const value = e.target.value;

    const filloutDiv = document.querySelector('.pricing-fillout');

    if (filloutDiv) {
      filloutDiv.dataset.source = `Package ${value}`;
    }
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
    const yOffset = -120;
    const y =
      element.getBoundingClientRect().top + window.pageYOffset + yOffset;
    window.scrollTo({ top: y, behavior: 'smooth' });
  }
};

const scrollToLinks = document.querySelectorAll('.scroll-to');

const addClickListener = (item) => {
  item.addEventListener('click', (e) => {
    e.preventDefault();
    const href = e.target.getAttribute('href');
    if (!href) return;
    const hash = href.split('#')[1];
    smoothScrollToElementById(hash);
  });
};

if (scrollToLinks) {
  scrollToLinks.forEach(addClickListener);
}

const refreshScrollTrigger = () => {
  ScrollTrigger.refresh();
};

const handleButtonsWithScrollTriggerRefresh = () => {
  const buttons = document.querySelectorAll('.refreshScrollTrigger');

  if (!buttons || buttons.length === 0) return;

  buttons.forEach((button) => {
    button.addEventListener('click', () =>
      setTimeout(refreshScrollTrigger, 1000),
    );
  });
};

const arrow =
  '<div class="z-1 flex justify-center items-center relative overflow-hidden "><div class="justify-center items-center w-[1.125rem] h-[1.125rem] transition-transform duration-300 absolute translate-x-[-100%] translate-y-[100%] group-hover:translate-x-0 group-hover:translate-y-0"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--ic" width="100%" height="100%" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="currentColor" d="M6 6v2h8.59L5 17.59L6.41 19L16 9.41V18h2V6z"></path></svg></div><div class="justify-center items-center w-[1.125rem] h-[1.125rem] transition-transform duration-300 group-hover:translate-x-[100%] group-hover:translate-y-[-100%]"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--ic" width="100%" height="100%" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="currentColor" d="M6 6v2h8.59L5 17.59L6.41 19L16 9.41V18h2V6z"></path></svg></div></div>';

const addArrow = () => {
  const richContent = document.querySelectorAll('.rich-content');
  if (!richContent || richContent.length === 0) return;

  richContent.forEach((element) => {
    const aTags = element.querySelectorAll('a');
    if (!aTags || aTags.length === 0) return;

    aTags.forEach((a) => {
      const span = document.createElement('span');
      span.innerHTML = a.innerHTML;
      a.innerHTML = '';
      a.appendChild(span);
      span.insertAdjacentHTML('beforeend', arrow);
      a.classList.add('group', 'inline-block');
      span.classList.add('flex', 'items-center');
    });
  });
};

const handleTextSplit = () => {
  const elements = document.querySelectorAll('.split-text');
  if (!elements || elements.length === 0) return;

  elements.forEach((element) => {
    new SplitType(element, {
      types: 'words',
    });
  });
};

function preventFormValidationOnUpload() {
  // Find all CF7 file inputs
  const fileInputs = document.querySelectorAll('.wpcf7-drag-n-drop-file');

  fileInputs.forEach(function (input) {
    input.addEventListener('change', function (e) {
      e.stopImmediatePropagation();
    });
  });
}

document.addEventListener('DOMContentLoaded', function () {
  initSwiper();
  handleContactFormTransition();
  handleButtonsWithScrollTriggerRefresh();
  addArrow();
  handleTextSplit();
  preventFormValidationOnUpload();
});
