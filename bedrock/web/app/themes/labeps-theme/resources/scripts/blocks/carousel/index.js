import {registerBlockType} from '@wordpress/blocks';
import edit from './edit';
import save from './save';
import './style.scss';
import './editor.scss';
import 'slick-carousel';
import 'slick-carousel/slick/slick.css';
import 'slick-carousel/slick/slick-theme.css';

registerBlockType('theme/carousel', {
  edit,
  save,
});

document.addEventListener('DOMContentLoaded', function () {
  const carousels = document.querySelectorAll('.carousel');
  carousels.forEach((carousel) => {
    jQuery(carousel).slick({
      dots: true,
      arrows: true,
      infinite: true,
      speed: 300,
      slidesToShow: 1,
      adaptiveHeight: true,
      prevArrow: '<button type="button" class="slick-prev">Previous</button>',
      nextArrow: '<button type="button" class="slick-next">Next</button>',
    });
  });
});
