import {registerBlockType} from '@wordpress/blocks';
import {
  useBlockProps,
  MediaUpload,
  RichText,
  InspectorControls,
} from '@wordpress/block-editor';
import {Button, PanelBody, TextControl} from '@wordpress/components';
import {__} from '@wordpress/i18n';
import './style.scss';
import './editor.scss';

registerBlockType('theme/hero', {
  title: __('Hero', 'theme'),
  icon: 'megaphone',
  category: 'widgets',
  attributes: {
    title: {
      type: 'string',
      source: 'html',
      selector: 'h1',
    },
    subtitle: {
      type: 'string',
      source: 'html',
      selector: 'p',
    },
    iconUrl: {
      type: 'string',
      default: "@asset('images/picto-hero.svg')",
    },
    tags: {
      type: 'array',
      default: [],
    },
  },
  edit: ({attributes, setAttributes}) => {
    const blockProps = useBlockProps();

    const onChangeTitle = (value) => {
      setAttributes({title: value});
    };

    const onChangeSubtitle = (value) => {
      setAttributes({subtitle: value});
    };

    const onSelectIcon = (media) => {
      setAttributes({iconUrl: media.url});
    };

    const onChangeTags = (value) => {
      const tagsArray = value.split(',').map((tag) => tag.trim());
      setAttributes({tags: tagsArray});
    };

    return (
      <div {...blockProps}>
        <InspectorControls>
          <PanelBody title={__('Hero Settings', 'theme')}>
            <TextControl
              label={__('Tags', 'theme')}
              value={attributes.tags.join(', ')}
              onChange={onChangeTags}
              help={__('Separate tags with commas.', 'theme')}
            />
          </PanelBody>
        </InspectorControls>
        <MediaUpload
          onSelect={onSelectIcon}
          allowedTypes={['image']}
          render={({open}) => (
            <Button onClick={open}>{__('Select Icon', 'theme')}</Button>
          )}
        />
        {attributes.iconUrl && (
          <img src={attributes.iconUrl} alt={__('Icon', 'theme')} />
        )}
        <RichText
          tagName="h1"
          value={attributes.title}
          onChange={onChangeTitle}
          placeholder={__('Title...', 'theme')}
        />
        <RichText
          tagName="p"
          value={attributes.subtitle}
          onChange={onChangeSubtitle}
          placeholder={__('Subtitle...', 'theme')}
        />
        {attributes.tags.length > 0 && (
          <div className="tags">
            {attributes.tags.map((tag, index) => (
              <span key={index} className="tag">
                {tag}
              </span>
            ))}
          </div>
        )}
      </div>
    );
  },
  save: ({attributes}) => {
    const blockProps = useBlockProps.save();

    return (
      <section
        {...blockProps}
        className="wp-block-group container mx-auto my-10">
        <div className="actualite-hero flex">
          <figure className="wp-block-image">
            <img src={attributes.iconUrl} alt="Picto Lab" className="" />
          </figure>
          <div className="block-heading-text w-8/12 md:w-auto">
            <RichText.Content tagName="h1" value={attributes.title} />
            <RichText.Content tagName="p" value={attributes.subtitle} />
          </div>
        </div>
        {attributes.tags.length > 0 && (
          <div className="tags">
            {attributes.tags.map((tag, index) => (
              <span key={index} className="tag">
                {tag}
              </span>
            ))}
          </div>
        )}
      </section>
    );
  },
});
