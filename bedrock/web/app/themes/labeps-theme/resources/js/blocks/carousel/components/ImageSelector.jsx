import {MediaUpload} from '@wordpress/block-editor';
import {Button} from '@wordpress/components';
import {__} from '@wordpress/i18n';
import PropTypes from 'prop-types';
// import '../editor.css';

const ImageSelector = ({images, onSelectImages, removeImage}) => (
  <div className="image-container">
    <MediaUpload
      onSelect={onSelectImages}
      allowedTypes={['image']}
      multiple
      gallery
      render={({open}) => (
        <Button onClick={open} variant="primary">
          {images.length === 0
            ? __('Select Images', 'text-domain')
            : __('Add More Images', 'text-domain')}
        </Button>
      )}
    />
    <div className="image-preview-wrapper">
      {images.map((img, index) => (
        <div key={index} className="image-preview-item">
          <img src={img.url} alt={img.alt} className="image-preview" />
          <Button
            onClick={() => removeImage(index)}
            variant="secondary"
            isDestructive>
            {__('Remove', 'text-domain')}
          </Button>
        </div>
      ))}
    </div>
  </div>
);

ImageSelector.propTypes = {
  images: PropTypes.arrayOf(
    PropTypes.shape({
      url: PropTypes.string.isRequired,
      alt: PropTypes.string.isRequired,
    }),
  ).isRequired,
  onSelectImages: PropTypes.func.isRequired,
  removeImage: PropTypes.func.isRequired,
};

export default ImageSelector;
