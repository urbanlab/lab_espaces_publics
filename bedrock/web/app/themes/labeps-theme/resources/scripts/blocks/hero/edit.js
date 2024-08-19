import {useEffect, useState} from '@wordpress/element';
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
import {__} from '@wordpress/i18n';
import './editor.scss';

const Edit = ({
  attributes: {
    images = [],
    columns = 1,
    contentType = 'images',
    postSelections = [],
    categories = [],
  } = {},
  setAttributes,
}) => {
  const blockProps = useBlockProps();
  const [availableCategories, setAvailableCategories] = useState([]);

  // Fetch categories if the contentType is 'posts'
  useEffect(() => {
    if (contentType === 'posts') {
      apiFetch({path: '/wp/v2/categories'})
        .then((data) => {
          setAvailableCategories(
            data.map((cat) => ({
              label: cat.name,
              value: cat.id,
            })),
          );
        })
        .catch((error) =>
          console.error(__('Error fetching categories:', 'text-domain'), error),
        );
    } else {
      setAvailableCategories([]);
    }
  }, [contentType]);

  // Fetch posts based on selected contentType and categories
  useEffect(() => {
    if (contentType && contentType !== 'images') {
      const categoryQuery =
        categories.length > 0 ? `&categories=${categories.join(',')}` : '';

      apiFetch({
        path: `/wp/v2/${contentType}?_embed&context=edit${categoryQuery}`,
      })
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
        .catch((error) =>
          console.error(__('Error fetching posts:', 'text-domain'), error),
        );
    } else {
      setAttributes({postSelections: []});
    }
  }, [contentType, categories]);

  const onSelectImages = (newImages) => {
    setAttributes({
      images: newImages.map((img) => ({
        url: img.url,
        alt: img.alt,
        caption: img.caption,
      })),
    });
  };

  const removeImage = (index) => {
    const newImages = images.filter((_, i) => i !== index);
    setAttributes({images: newImages});
  };

  return (
    <div {...blockProps}>
      <InspectorControls>
        <PanelBody title={__('Settings', 'text-domain')}>
          {/* Content Type SelectControl */}
          <SelectControl
            label={__('Content Type', 'text-domain')}
            value={contentType}
            options={[
              {label: __('Images', 'text-domain'), value: 'images'},
              {label: __('Posts', 'text-domain'), value: 'posts'},
              {label: __('Inspiration', 'text-domain'), value: 'inspirations'},
              {label: __('Projets', 'text-domain'), value: 'projects'},
              {label: __('Boite à outil', 'text-domain'), value: 'ressources'},
            ]}
            onChange={(value) => setAttributes({contentType: value})}
          />

          {/* Category SelectControl (only shown for posts) */}
          {contentType === 'posts' && (
            <SelectControl
              multiple
              label={__('Select Categories', 'text-domain')}
              value={categories}
              options={availableCategories}
              onChange={(selectedCategories) =>
                setAttributes({categories: selectedCategories})
              }
            />
          )}

          <RangeControl
            label={__('Columns', 'text-domain')}
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
                  {__('Select Images', 'text-domain')}
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
                    {__('Supprimer', 'text-domain')}
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
                  alt={
                    post.title
                      ? post.title.rendered
                      : __('No title', 'text-domain')
                  }
                  className="post-thumbnail-image"
                />
              ) : (
                <div>{__('No Image Available', 'text-domain')}</div>
              )}
              <h4 className="post-thumbnail-title">{post.title.rendered}</h4>
            </div>
          ))}
        </div>
      )}

      {contentType !== 'images' && postSelections.length === 0 && (
        <p>{__('No content available', 'text-domain')}</p>
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
    categories: PropTypes.arrayOf(PropTypes.number).isRequired,
  }).isRequired,
  setAttributes: PropTypes.func.isRequired,
};

export default Edit;
