import Swiper from 'swiper/bundle';
import 'swiper/css/bundle';

import {SWIPER_DEFAULT_OPTIONS} from './swiper-config';

export const initializeSwiper = (selector, options = {}) => {
  const mergedOptions = {...SWIPER_DEFAULT_OPTIONS, ...options};
  console.log('Initializing Swiper on:', selector);
  console.log('With options:', options);
  return new Swiper(selector, {
    slidesPerView: mergedOptions.slidesPerView || 1,
    spaceBetween: mergedOptions.spaceBetween,
    pagination: {
      el: mergedOptions.paginationEl,
      clickable: true,
      dynamicBullets: true,
      dynamicMainBullets: 3,
    },
    navigation: {
      nextEl: mergedOptions.nextEl || '.swiper-button-next',
      prevEl: mergedOptions.prevEl || '.swiper-button-prev',
    },
    autoplay: mergedOptions.autoplay,
    centeredSlides: mergedOptions.centeredSlides,
  });
};
