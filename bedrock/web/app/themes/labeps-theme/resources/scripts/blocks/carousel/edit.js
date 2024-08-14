import {useEffect} from '@wordpress/element';
import {
  SelectControl,
  PanelBody,
  RangeControl,
  Button,
} from '@wordpress/components';
import {
  useBlockProps,
  InspectorControls,
  MediaUpload,
} from '@wordpress/block-editor';
import apiFetch from '@wordpress/api-fetch';
import PropTypes from 'prop-types';
import './editor.scss';

const Edit = ({
  attributes: {
    images = [],
    columns = 1,
    contentType = 'images',
    postSelections = [],
  } = {},
  setAttributes,
}) => {
  const blockProps = useBlockProps();

  useEffect(() => {
    if (contentType && contentType !== 'images') {
      apiFetch({path: `/wp/v2/${contentType}?_embed&context=edit`})
        .then((data) => {
          const postsWithImages = data.map((post) => {
            const featuredImage =
              post._embedded &&
              post._embedded['wp:featuredmedia'] &&
              post._embedded['wp:featuredmedia'][0]
                ? post._embedded['wp:featuredmedia'][0].source_url
                : null;

            return {...post, featured_media_src_url: featuredImage};
          });

          setAttributes({postSelections: postsWithImages});
        })
        .catch((error) => console.error('Error fetching posts:', error));
    } else {
      setAttributes({postSelections: []});
    }
  }, [contentType]);

  const onSelectImages = (newImages) => {
    setAttributes({
      images: newImages.map((img) => ({url: img.url, alt: img.alt})),
    });
  };

  const removeImage = (index) => {
    const newImages = images.filter((_, i) => i !== index);
    setAttributes({images: newImages});
  };

  return (
    <div {...blockProps}>
      <InspectorControls>
        <PanelBody title="Settings">
          {/* Content Type SelectControl */}
          <SelectControl
            label="Content Type"
            value={contentType}
            options={[
              {label: 'Images', value: 'images'},
              {label: 'Posts', value: 'posts'},
              {label: 'Inspiration', value: 'inspirations'},
              {label: 'Projets', value: 'projects'},
              {label: 'Boite à outil', value: 'ressources'},
            ]}
            onChange={(value) => setAttributes({contentType: value})}
          />

          <RangeControl
            label="Columns"
            value={columns}
            onChange={(value) => setAttributes({columns: value})}
            min={1}
            max={5}
          />
        </PanelBody>
      </InspectorControls>

      {contentType === 'images' && (
        <div className="image-container">
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
                    Supprimer
                  </Button>
                </div>
              ))}
            </div>
          )}
        </div>
      )}

      {contentType !== 'images' && postSelections.length > 0 && (
        <div
          className="post-thumbnail-container"
          style={{gridTemplateColumns: `repeat(${columns}, 1fr)`}}>
          {postSelections.map((post, index) => (
            <div key={index} className="post-thumbnail-item">
              {post.featured_media_src_url ? (
                <img
                  src={post.featured_media_src_url}
                  alt={post.title ? post.title.rendered : 'No title'}
                  className="post-thumbnail-image"
                />
              ) : (
                <div>No Image Available</div>
              )}
              <h4 className="post-thumbnail-title">{post.title.rendered}</h4>
            </div>
          ))}
        </div>
      )}

      {contentType !== 'images' && postSelections.length === 0 && (
        <p>No content available</p>
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
    contentType: PropTypes.string.isRequired,
    postSelections: PropTypes.arrayOf(
      PropTypes.shape({
        id: PropTypes.number.isRequired,
        title: PropTypes.shape({
          rendered: PropTypes.string.isRequired,
        }),
        featured_media_src_url: PropTypes.string,
      }),
    ).isRequired,
  }).isRequired,
  setAttributes: PropTypes.func.isRequired,
};

export default Edit;
