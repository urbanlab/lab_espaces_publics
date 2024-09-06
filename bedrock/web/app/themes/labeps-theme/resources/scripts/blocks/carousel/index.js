import {registerBlockType} from '@wordpress/blocks';
import Swiper from 'swiper/bundle';
import 'swiper/css/bundle';
import Edit from './edit';
import save from './save';
import {SWIPER_DEFAULT_OPTIONS} from './swiper-config';

registerBlockType('labeps-theme/carousel', {
  title: 'Carousel',
  edit: Edit,
  save,
});

document.addEventListener('DOMContentLoaded', () => {
  const carousels = document.querySelectorAll('.swiper-container');

  setTimeout(() => {
    carousels.forEach((carousel) => {
      const columns =
        carousel.getAttribute('data-columns') ||
        SWIPER_DEFAULT_OPTIONS.slidesPerView;

    new Swiper(carousel, {
      slidesPerView: columns,
      autoplay: SWIPER_DEFAULT_OPTIONS.autoplay,
      breakpoints: {
        640: {
          slidesPerView: SWIPER_DEFAULT_OPTIONS.slidesPerView,
          spaceBetween: 10,
        },
        1024: {
          slidesPerView: columns,
          spaceBetween: 15,
        },
        1440: {
          slidesPerView: columns,
          spaceBetween: 20,
        },
      },
      speed: 400,
      pagination: {
        el: SWIPER_DEFAULT_OPTIONS.paginationEl,
        clickable: true,
        dynamicBullets: true,
        dynamicMainBullets: 3,
      },
      navigation: {
        nextEl: SWIPER_DEFAULT_OPTIONS.nextEl,
        prevEl: SWIPER_DEFAULT_OPTIONS.prevEl,
      },
      centeredSlides: SWIPER_DEFAULT_OPTIONS.centeredSlides,

    });
  }, 100);
});
