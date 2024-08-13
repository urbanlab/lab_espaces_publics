import {registerBlockType} from '@wordpress/blocks';
import Edit from './edit';
import save from './save';
import {initializeSwiper} from './swiper-init';
import {SWIPER_DEFAULT_OPTIONS} from './swiper-config';

registerBlockType('labeps-theme/carousel', {
  title: 'Carousel',
  edit: Edit,
  save,
});

document.addEventListener('DOMContentLoaded', () => {
  const carousels = document.querySelectorAll('.swiper-container');
  carousels.forEach((carousel) => {
    initializeSwiper(carousel, {
      slidesPerView:
        carousel.getAttribute('data-columns') ||
        SWIPER_DEFAULT_OPTIONS.slidesPerView,
      autoplay: SWIPER_DEFAULT_OPTIONS.autoplay,
    });
  });
});
