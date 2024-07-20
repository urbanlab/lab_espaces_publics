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
  $('.carousel').slick({
    dots: true,
    arrows: true,
    infinite: true,
    speed: 300,
    slidesToShow: 1,
    adaptiveHeight: false,
  });
});
