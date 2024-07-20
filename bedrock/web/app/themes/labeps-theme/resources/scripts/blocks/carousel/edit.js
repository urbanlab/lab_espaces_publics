import {__} from '@wordpress/i18n';
import PropTypes from 'prop-types';
import {
  useBlockProps,
  MediaUpload,
  MediaUploadCheck,
  BlockControls,
  BlockIcon,
  InspectorControls,
  MediaPlaceholder,
} from '@wordpress/block-editor';
import {
  Button,
  ToolbarGroup,
  ToolbarButton,
  PanelBody,
} from '@wordpress/components';
import {plus} from '@wordpress/icons';
import './editor.scss';

const Edit = ({attributes, setAttributes}) => {
  const {images} = attributes;
  const blockProps = useBlockProps();

  const onSelectImages = (newImages) => {
    setAttributes({
      images: newImages.map((image) => ({url: image.url, alt: image.alt})),
    });
  };

  const removeImage = (index) => {
    const newImages = images.slice();
    newImages.splice(index, 1);
    setAttributes({images: newImages});
  };

  return (
    <div {...blockProps}>
      <BlockControls>
        <ToolbarGroup>
          <MediaUploadCheck>
            <MediaUpload
              onSelect={onSelectImages}
              allowedTypes={['image']}
              multiple
              gallery
              render={({open}) => (
                <ToolbarButton
                  icon={<BlockIcon icon={plus} />}
                  label={__('Add Images', 'theme')}
                  onClick={open}
                />
              )}
            />
          </MediaUploadCheck>
        </ToolbarGroup>
      </BlockControls>
      <InspectorControls>
        <PanelBody title={__('Images', 'theme')} initialOpen={true}>
          <MediaUploadCheck>
            <MediaUpload
              onSelect={onSelectImages}
              allowedTypes={['image']}
              multiple
              gallery
              render={({open}) => (
                <Button onClick={open} variant="primary" isSecondary>
                  {__('Upload Images', 'theme')}
                </Button>
              )}
            />
          </MediaUploadCheck>
        </PanelBody>
      </InspectorControls>
      {images.length === 0 ? (
        <MediaPlaceholder
          icon="format-gallery"
          labels={{
            title: __('Carousel', 'theme'),
            instructions: __(
              'Drag images, upload new ones or select files from your library.',
              'theme',
            ),
          }}
          onSelect={onSelectImages}
          allowedTypes={['image']}
          multiple
        />
      ) : (
        <div className="carousel">
          {images.map((image, index) => (
            <div key={index} className="carousel-image">
              <img src={image.url} alt={image.alt} />
              <Button
                className="remove-image-button"
                onClick={() => removeImage(index)}
                icon="no-alt">
                {__('Supprimé', 'theme')}
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
        url: PropTypes.string,
        alt: PropTypes.string,
      }),
    ),
  }).isRequired,
  setAttributes: PropTypes.func.isRequired,
};

export default Edit;
