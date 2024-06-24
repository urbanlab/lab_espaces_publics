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

    // Enqueue Slick styles and scripts
    wp_enqueue_style('slick-carousel', asset('node_modules/slick-carousel/slick/slick.css')->uri(), [], null);
    wp_enqueue_style('slick-theme', asset('node_modules/slick-carousel/slick/slick-theme.css')->uri(), [], null);
    wp_enqueue_script('slick-carousel', asset('node_modules/slick-carousel/slick/slick.min.js')->uri(), ['jquery'], null, true);

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
