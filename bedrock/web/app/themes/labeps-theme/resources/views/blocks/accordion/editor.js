import {registerBlockType} from '@wordpress/blocks';

registerBlockType('my-custom-block/my-custom-block', {
  title: 'My Custom Block',
  icon: 'smiley',
  category: 'common',
  edit: function () {
    // Block editor content for editing
    return <div>Hello, this is my custom block!</div>;
  },
  save: function () {
    // Saved content for the front end
    return <div>Hello, this is my custom block!</div>;
  },
});
