import {__} from '@wordpress/i18n';
import PropTypes from 'prop-types';
import {
    useBlockProps,
    RichText,
    InspectorControls,
    PanelColorSettings,
    MediaPlaceholder,
} from '@wordpress/block-editor';
import {
    PanelBody,
    SelectControl,
    TextControl,
    Card,
    CardBody,
} from '@wordpress/components';
import './editor.css';

export default function Edit({attributes, setAttributes}) {
    const {
        title = '',
        subtitle = '',
        iconUrl = '',
        tags = [],
        textColor = '',
        fontWeight = 'normal',
    } = attributes;

    const blockProps = useBlockProps();

    const onChangeTitle = (value) => setAttributes({title: value});
    const onChangeSubtitle = (value) => setAttributes({subtitle: value});
    const onSelectIcon = (media) => setAttributes({iconUrl: media.url});
    const onChangeTags = (value) =>
        setAttributes({tags: value.split(',').map((tag) => tag.trim())});
    const onChangeTextColor = (newColor) => setAttributes({textColor: newColor});
    const onChangeFontWeight = (newWeight) =>
        setAttributes({fontWeight: newWeight});

    return (
        <div {...blockProps}>
            <InspectorControls>
                <PanelBody title={__('Hero Settings', 'labeps-theme')}>
                    <TextControl
                        label={__('Tags', 'labeps-theme')}
                        value={tags.join(', ')}
                        onChange={onChangeTags}
                        help={__('Separate tags with commas.', 'labeps-theme')}
                    />
                    <SelectControl
                        label={__('Font Weight', 'labeps-theme')}
                        value={fontWeight}
                        options={[
                            {label: __('Normal', 'labeps-theme'), value: 'normal'},
                            {label: __('Bold', 'labeps-theme'), value: 'bold'},
                        ]}
                        onChange={onChangeFontWeight}
                    />
                </PanelBody>
                <PanelColorSettings
                    title={__('Color Settings', 'labeps-theme')}
                    initialOpen={true}
                    colorSettings={[
                        {
                            value: textColor,
                            onChange: onChangeTextColor,
                            label: __('Text Color', 'labeps-theme'),
                        },
                    ]}
                />
            </InspectorControls>
            <Card>
                <CardBody>
                    <MediaPlaceholder
                        onSelect={onSelectIcon}
                        allowedTypes={['image']}
                        multiple={false}
                        labels={{title: __('Select Icon', 'labeps-theme')}}
                    >
                        {iconUrl && <figure class='max-w-1/3'><img src={iconUrl} alt={__('Icon', 'labeps-theme')} /></figure>}
                    </MediaPlaceholder>
                    <RichText
                        tagName="h1"
                        value={title}
                        onChange={onChangeTitle}
                        placeholder={__('Title...', 'labeps-theme')}
                    />
                    <RichText
                        tagName="p"
                        value={subtitle}
                        onChange={onChangeSubtitle}
                        placeholder={__('Subtitle...', 'labeps-theme')}
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
                </CardBody>
            </Card>
        </div>
    );
}

Edit.propTypes = {
    attributes: PropTypes.shape({
        title: PropTypes.string,
        subtitle: PropTypes.string,
        iconUrl: PropTypes.string,
        tags: PropTypes.arrayOf(PropTypes.string),
        textColor: PropTypes.string,
        fontWeight: PropTypes.string,
    }).isRequired,
    setAttributes: PropTypes.func.isRequired,
};
