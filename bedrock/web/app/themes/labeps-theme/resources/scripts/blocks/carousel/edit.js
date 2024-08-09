import {
  useBlockProps,
  MediaUpload,
  InspectorControls,
} from '@wordpress/block-editor';
import {PanelBody, Button, RangeControl} from '@wordpress/components';
import PropTypes from 'prop-types';
import './editor.scss';

const Edit = ({attributes, setAttributes}) => {
  const {images, columns} = attributes;
  const blockProps = useBlockProps();

  const onSelectImages = (newImages) => {
    setAttributes({
      images: newImages.map((img) => ({url: img.url, alt: img.alt})),
    });
  };

  const removeImage = (index) => {
    setAttributes({
      images: images.filter((_, i) => i !== index),
    });
  };

  return (
    <div {...blockProps}>
      <InspectorControls>
        <PanelBody title="Settings">
          <RangeControl
            label="Columns"
            value={columns}
            onChange={(value) => setAttributes({columns: value})}
            min={1}
            max={5}
          />
        </PanelBody>
      </InspectorControls>

      {images.length === 0 ? (
        <MediaUpload
          onSelect={onSelectImages}
          allowedTypes={['image']}
          multiple
          gallery
          render={({open}) => (
            <Button onClick={open} variant="primary">
              Select Images
            </Button>
          )}
        />
      ) : (
        <div className="image-preview-wrapper">
          {images.map((img, index) => (
            <div key={index} className="image-preview-item">
              <img src={img.url} alt={img.alt} className="image-preview" />
              <Button
                onClick={() => removeImage(index)}
                variant="secondary"
                isDestructive>
                Remove
              </Button>
            </div>
          ))}
        </div>
      )}
    </div>
  );
};

Edit.propTypes = {
  attributes: PropTypes.shape({
    images: PropTypes.arrayOf(
      PropTypes.shape({
        url: PropTypes.string.isRequired,
        alt: PropTypes.string.isRequired,
      }),
    ).isRequired,
    columns: PropTypes.number.isRequired,
  }).isRequired,
  setAttributes: PropTypes.func.isRequired,
};

export default Edit;
