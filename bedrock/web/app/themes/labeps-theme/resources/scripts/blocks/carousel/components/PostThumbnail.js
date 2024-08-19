import {__} from '@wordpress/i18n';
import PropTypes from 'prop-types';

const PostThumbnail = ({post}) => (
  <div className="post-thumbnail-item">
    {post.featured_media_src_url ? (
      <img
        src={post.featured_media_src_url}
        alt={post.title ? post.title.rendered : __('No title', 'text-domain')}
        className="post-thumbnail-image"
      />
    ) : (
      <div>{__('No Image Available', 'text-domain')}</div>
    )}
    <h4 className="post-thumbnail-title">{post.title.rendered}</h4>
  </div>
);

PostThumbnail.propTypes = {
  post: PropTypes.shape({
    featured_media_src_url: PropTypes.string,
    title: PropTypes.shape({
      rendered: PropTypes.string.isRequired,
    }).isRequired,
  }).isRequired,
};

export default PostThumbnail;
