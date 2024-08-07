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
}, 100);



/**
 * Register custom blocks.
 *
 * @return void
 */
add_action('init', function () {
    $blocks = [
        __DIR__ . '/../resources/scripts/blocks/carousel/block.json',
        __DIR__ . '/../resources/scripts/blocks/hero/block.json',
    ];

    foreach ($blocks as $block_path) {
        if (!file_exists($block_path)) {
            error_log('Block file does not exist: ' . $block_path);
            continue;
        }

        $block_data = json_decode(file_get_contents($block_path), true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            error_log('JSON error in file: ' . $block_path);
            continue;
        }

        if (!isset($block_data['title']) || empty($block_data['title'])) {
            error_log('The block "' . $block_data['name'] . '" must have a title.');
            continue;
        }

        register_block_type($block_path);
    }
});
