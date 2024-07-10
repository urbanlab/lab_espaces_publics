import {registerBlockType} from '@wordpress/blocks';
import {
  useBlockProps,
  MediaUpload,
  MediaUploadCheck,
} from '@wordpress/block-editor';
import {Button} from '@wordpress/components';
import {__} from '@wordpress/i18n';
import 'slick-carousel';
import 'slick-carousel/slick/slick.css';
import 'slick-carousel/slick/slick-theme.css';

registerBlockType('theme/carousel', {
  title: __('Carousel', 'theme'),
  icon: 'images-alt2',
  category: 'widgets',
  attributes: {
    images: {
      type: 'array',
      default: [],
    },
  },
  edit: ({attributes, setAttributes}) => {
    const blockProps = useBlockProps();

    const onSelectImages = (newImages) => {
      setAttributes({
        images: newImages.map((image) => ({url: image.url, alt: image.alt})),
      });
    };

    return (
      <div {...blockProps}>
        <MediaUploadCheck>
          <MediaUpload
            onSelect={onSelectImages}
            allowedTypes={['image']}
            multiple
            gallery
            render={({open}) => (
              <Button onClick={open}>{__('Upload Images', 'theme')}</Button>
            )}
          />
        </MediaUploadCheck>
        <div className="carousel">
          {attributes.images.map((image, index) => (
            <img key={index} src={image.url} alt={image.alt} />
          ))}
        </div>
      </div>
    );
  },
  save: ({attributes}) => {
    const blockProps = useBlockProps.save();

    return (
      <div {...blockProps} className="carousel">
        {attributes.images.map((image, index) => (
          <div key={index}>
            <img src={image.url} alt={image.alt} />
          </div>
        ))}
      </div>
    );
  },
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
    });
  });
});
