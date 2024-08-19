import {useBlockProps} from '@wordpress/block-editor';
import PropTypes from 'prop-types';
import './style.scss';

export default function save({
  attributes: {
    images = [],
    columns = 1,
    contentType = 'images',
    postSelections = [],
  } = {},
}) {
  const blockProps = useBlockProps.save();
  return (
    <div {...blockProps} className="swiper-container" data-columns={columns}>
      <div className="swiper-wrapper">
        {contentType === 'images' &&
          images.map((img, index) => (
            <div key={index} className="swiper-slide">
              <div className="card-images-container">
                <img src={img.url} alt={img.alt} />
                <p
                  className="image-caption"
                  dangerouslySetInnerHTML={{__html: img.caption}}
                />
              </div>
            </div>
          ))}

        {contentType !== 'images' &&
          postSelections.map((post, index) => (
            <div key={index} className="swiper-slide">
              <div className="card-post-container">
                <figure className="custom-post-image">
                  {post.featured_media_src_url ? (
                    <img
                      src={post.featured_media_src_url}
                      alt={post.title.rendered || 'No title'}
                    />
                  ) : (
                    <div className="custom-no-image">
                      <span>No Image Available</span>
                    </div>
                  )}
                </figure>
                <div className="custom-post-content">
                  <h2 className="custom-post-title">{post.title.rendered}</h2>
                  <p
                    className="custom-post-excerpt"
                    dangerouslySetInnerHTML={{
                      __html: post.excerpt.rendered,
                    }}></p>
                </div>
              </div>
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
    contentType: PropTypes.string.isRequired,
    postSelections: PropTypes.arrayOf(
      PropTypes.shape({
        title: PropTypes.shape({
          rendered: PropTypes.string.isRequired,
        }),
        excerpt: PropTypes.shape({
          rendered: PropTypes.string.isRequired,
        }),
        featured_media_src_url: PropTypes.string,
      }),
    ).isRequired,
  }).isRequired,
};
