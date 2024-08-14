import {useBlockProps, RichText} from '@wordpress/block-editor';
import PropTypes from 'prop-types';
import './style.scss';

export default function Save({
  attributes: {
    title = '',
    subtitle = '',
    iconUrl = '',
    tags = [],
    textColor = '',
    fontWeight = 'normal',
  } = {},
}) {
  const blockProps = useBlockProps.save();

  return (
    <section {...blockProps} className="wp-block-group container">
      <div className="block-hero flex">
        <figure className="wp-block-image">
          <img src={iconUrl} alt="Picto Lab" />
        </figure>
        <div className="block-heading-text w-full">
          <RichText.Content tagName="h2" value={title} />
          <RichText.Content
            tagName="p"
            value={subtitle}
            style={{color: textColor, fontWeight}}
          />
          {tags.length > 0 && (
            <div className="tags">
              {tags.map((tag, index) => (
                <span key={index} className="tag">
                  {tag}
                </span>
              ))}
            </div>
          )}
        </div>
      </div>
    </section>
  );
}

Save.propTypes = {
  attributes: PropTypes.shape({
    title: PropTypes.string,
    subtitle: PropTypes.string,
    iconUrl: PropTypes.string,
    tags: PropTypes.arrayOf(PropTypes.string),
    textColor: PropTypes.string,
    fontWeight: PropTypes.string,
  }).isRequired,
};
