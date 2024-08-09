import {useBlockProps} from '@wordpress/block-editor';
import PropTypes from 'prop-types';
import './style.scss';

export default function save({attributes}) {
  const {images, columns = 1} = attributes;
  const blockProps = useBlockProps.save();

  return (
    <div {...blockProps} className="swiper-container" data-columns={columns}>
      <div className="swiper-wrapper">
        {images.map((img, index) => (
          <div key={index} className="swiper-slide">
            <img src={img.url} alt={img.alt} />
          </div>
        ))}
      </div>
      <div className="swiper-pagination"></div>
      <div className="swiper-button-next"></div>
      <div className="swiper-button-prev"></div>
    </div>
  );
}

save.propTypes = {
  attributes: PropTypes.shape({
    images: PropTypes.arrayOf(
      PropTypes.shape({
        url: PropTypes.string.isRequired,
        alt: PropTypes.string.isRequired,
      }),
    ).isRequired,
    columns: PropTypes.number.isRequired,
  }).isRequired,
};
