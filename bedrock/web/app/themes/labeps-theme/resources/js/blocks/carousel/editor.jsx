import {__} from '@wordpress/i18n';
import {useEffect, useState} from '@wordpress/element';
import {useBlockProps, InspectorControls} from '@wordpress/block-editor';
import apiFetch from '@wordpress/api-fetch';
import PropTypes from 'prop-types';
import ImageSelector from './components/ImageSelector';
import InspectorControlsPanel from './components/InspectorControlsPanel';
import PostSelector from './components/PostSelector';
// import './editor.css';

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

                    if (
                        JSON.stringify(postSelections) !== JSON.stringify(postsWithImages)
                    ) {
                        setAttributes({postSelections: postsWithImages});
                    }
                })
                .catch((error) =>
                    console.error(__('Error fetching posts:', 'text-domain'), error),
                );
        } else {
            if (postSelections.length > 0) {
                setAttributes({postSelections: []});
            }
        }
    }, [contentType, categories, postSelections, setAttributes]);

    const onSelectImages = (newImages) => {
        setAttributes({
            images: [
                ...images,
                ...newImages.map((img) => ({
                    url: img.url,
                    alt: img.alt,
                    caption: img.caption,
                })),
            ],
        });
    };

    const removeImage = (index) => {
        const newImages = images.filter((_, i) => i !== index);
        setAttributes({images: newImages});
    };

    return (
        <div {...blockProps}>
            <InspectorControls>
                <InspectorControlsPanel
                    contentType={contentType}
                    setAttributes={setAttributes}
                    columns={columns}
                    availableCategories={availableCategories}
                    categories={categories}
                />
            </InspectorControls>

            {contentType === 'images' ? (
                <ImageSelector
                    images={images}
                    onSelectImages={onSelectImages}
                    removeImage={removeImage}
                />
            ) : (
                <PostSelector postSelections={postSelections} columns={columns} />
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
        categories: PropTypes.arrayOf(PropTypes.number),
    }).isRequired,
    setAttributes: PropTypes.func.isRequired,
};

export default Edit;
