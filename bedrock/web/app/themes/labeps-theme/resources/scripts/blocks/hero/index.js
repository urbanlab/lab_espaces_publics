import {registerBlockType} from '@wordpress/blocks';
import Edit from './edit';
import save from './save';

registerBlockType('labeps-theme/hero', {
  title: 'Hero',
  edit: Edit,
  save,
});
