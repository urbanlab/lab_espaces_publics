import {SelectControl, PanelBody, RangeControl} from '@wordpress/components';
import {__} from '@wordpress/i18n';
import PropTypes from 'prop-types';

const InspectorControlsPanel = ({
  contentType,
  setAttributes,
  columns,
  availableCategories,
  categories,
}) => (
  <PanelBody title={__('Settings', 'text-domain')}>
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
);

InspectorControlsPanel.propTypes = {
  contentType: PropTypes.string.isRequired,
  setAttributes: PropTypes.func.isRequired,
  columns: PropTypes.number.isRequired,
  availableCategories: PropTypes.arrayOf(
    PropTypes.shape({
      label: PropTypes.string.isRequired,
      value: PropTypes.number.isRequired,
    }),
  ).isRequired,
  categories: PropTypes.arrayOf(PropTypes.number).isRequired,
};

export default InspectorControlsPanel;
