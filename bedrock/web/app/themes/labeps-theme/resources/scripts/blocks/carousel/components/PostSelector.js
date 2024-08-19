import {__} from '@wordpress/i18n';
import PostThumbnail from './PostThumbnail';
import PropTypes from 'prop-types';

const PostSelector = ({postSelections, columns}) => (
  <div
    className="post-thumbnail-container"
    style={{gridTemplateColumns: `repeat(${columns}, 1fr)`}}>
    {postSelections.length > 0 ? (
      postSelections.map((post, index) => (
        <PostThumbnail key={index} post={post} />
      ))
    ) : (
      <p>{__('No content available', 'text-domain')}</p>
    )}
  </div>
);

PostSelector.propTypes = {
  postSelections: PropTypes.arrayOf(
    PropTypes.shape({
      id: PropTypes.number.isRequired,
      title: PropTypes.shape({
        rendered: PropTypes.string.isRequired,
      }).isRequired,
      featured_media_src_url: PropTypes.string,
    }),
  ).isRequired,
  columns: PropTypes.number.isRequired,
};

export default PostSelector;
