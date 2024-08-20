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

  carousels.forEach((carousel) => {
    const columns = carousel.getAttribute('data-columns') || 1;

    console.log(SWIPER_DEFAULT_OPTIONS.spaceBetween);

    new Swiper(carousel, {
      slidesPerView: columns,
      spaceBetween: 0,
      setWrapperSize: true,
      roundLengths: true,
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
      autoplay: SWIPER_DEFAULT_OPTIONS.autoplay,
      centeredSlides: SWIPER_DEFAULT_OPTIONS.centeredSlides,
    });
  });
});
