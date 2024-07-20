import {useBlockProps} from '@wordpress/block-editor';
import PropTypes from 'prop-types';
import './style.scss';

const Save = ({attributes}) => {
  const {images} = attributes;
  const blockProps = useBlockProps.save();

  return (
    <div {...blockProps} className="carousel-container">
      <div className="carousel">
        {images.map((image, index) => (
          <div key={index}>
            <img src={image.url} alt={image.alt} />
          </div>
        ))}
      </div>
    </div>
  );
};

Save.propTypes = {
  attributes: PropTypes.shape({
    images: PropTypes.arrayOf(
      PropTypes.shape({
        url: PropTypes.string,
        alt: PropTypes.string,
      }),
    ),
  }).isRequired,
};

export default Save;
