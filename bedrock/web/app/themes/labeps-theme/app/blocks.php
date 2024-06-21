<?php

namespace App;

use function Roots\bundle;

/**
 * Register custom blocks assets.
 *
 * @return void
 */
add_action('enqueue_block_editor_assets', function () {
    bundle('blocks')->enqueue();
}, 100);

add_action('wp_enqueue_scripts', function () {
    bundle('blocks')->enqueue();
    // wp_enqueue_style('theme-blocks', asset('styles/blocks/index.css')->uri(), [], null);

}, 100);

/**
 * Register custom blocks.
 *
 * @return void
 */
add_action('init', function () {
    register_block_type(__DIR__ . '/../resources/scripts/blocks/carousel/block.json');
    register_block_type(__DIR__ . '/../resources/scripts/blocks/hero/block.json');
});
