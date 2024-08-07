<?php

/**
 * Theme setup.
 */

namespace App;

use function Roots\bundle;
use App\Providers\CityFieldsServiceProvider;


/**
 * Register the theme assets.
 *
 * @return void
 */
add_action('wp_enqueue_scripts', function () {
    bundle('app')->enqueue();
}, 100);

/**
 * Register the theme assets with the block editor.
 *
 * @return void
 */
add_action('enqueue_block_editor_assets', function () {
    bundle('editor')->enqueue();
}, 100);


/**
 * Register ajax.
 *
 * @return void
 */

 add_action('wp_enqueue_scripts', function () {
    bundle('app')->enqueue()->localize('labeps', [
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('filter_posts_nonce'),
        'ajax_action' => 'filter_posts',
    ]);
}, 100);

/**
 * Register Leaflet.
 *
 * @return void
 */
add_action('wp_enqueue_scripts', function () {
    // Enqueue the Leaflet CSS and JS files
    wp_enqueue_style('leaflet-css', 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.css', [], null);
    wp_enqueue_script('leaflet-js', 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.js', [], null, true);

    // bundle('app')->enqueue();
    // wp_enqueue_script('map-leaflet', get_template_directory_uri() . '/assets/scripts/map-leaflet.js', array('leaflet-js'), null, true);
    // wp_enqueue_script('ajax', get_template_directory_uri() . '/assets/scripts/ajax.js', array('map-leaflet'), null, true);
  });

/**
 * Register the initial theme setup.
 *
 * @return void
 */
add_action('after_setup_theme', function () {
    /**
     * Enable features from the Soil plugin if activated.
     *
     * @link https://roots.io/plugins/soil/
     */
    add_theme_support('soil', [
        'clean-up',
        'nav-walker',
        'nice-search',
        'relative-urls',
    ]);

    /**
     * Disable full-site editing support.
     *
     * @link https://wptavern.com/gutenberg-10-5-embeds-pdfs-adds-verse-block-color-options-and-introduces-new-patterns
     */
    remove_theme_support('block-templates');

    /** 
     * * Make theme available for translation.
     * Translations can be filed in the /resources/lang/ directory.
    */ 
    load_theme_textdomain('labeps-theme', get_template_directory() . '/resources/lang');

    /**
     * Register the navigation menus.
     *
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'labeps-theme'),
    ]);

    /**
     * Disable the default block patterns.
     *
     * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#disabling-the-default-block-patterns
     */
    remove_theme_support('core-block-patterns');

    /**
     * Enable plugins to manage the document title.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Enable post thumbnail support.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    /**
     * Enable responsive embed support.
     *
     * @link https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-support/#responsive-embedded-content
     */
    add_theme_support('responsive-embeds');

    /**
     * Enable HTML5 markup support.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', [
        'caption',
        'comment-form',
        'comment-list',
        'gallery',
        'search-form',
        'script',
        'style',
    ]);

    /**
     * Enable selective refresh for widgets in customizer.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#customize-selective-refresh-widgets
     */
    add_theme_support('customize-selective-refresh-widgets');

    /**
     * mail CF7
     *
     * @return void
     */
    require_once __DIR__ . '/mail-custom.php';

     // Register service providers.
     app()->register(CityFieldsServiceProvider::class);

     // Register theme setup.
     add_theme_support('title-tag');
     add_theme_support('post-thumbnails');
     add_theme_support('customize-selective-refresh-widgets');
     add_theme_support('html5', ['comment-list', 'comment-form', 'search-form', 'gallery', 'caption']);
     add_theme_support('custom-logo', [
         'height' => 100,
         'width' => 400,
         'flex-height' => true,
         'flex-width' => true,
     ]);

}, 20);

/**
 * Register the theme sidebars.
 *
 * @return void
 */
add_action('widgets_init', function () {
    $config = [
        'before_widget' => '<section class="widget %1$s %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ];

    register_sidebar([
        'name'          => __('Primary Sidebar', 'labeps-theme'),
        'id'            => 'primary-sidebar',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ] + $config);

    register_sidebar([
        'name' => __('Footer', 'labeps-theme'),
        'id' => 'sidebar-footer',
    ] + $config);
});

/**
 * Register custom logo
 *
 * @return void
 */
add_theme_support('custom-logo', [
    'height' => 50,
    'width' => 130,
    'flex-width' => true,
]);

add_action('after_setup_theme', function () {
    new \App\AjaxHandler();
});



// add_action('wp_enqueue_scripts', function () {
//     bundle('app')->enqueue();

//     // Prepare the data to pass to the script
//     $locations = (new \App\View\Composers\MapComposer)->locations();
//     $script_data = [
//         'locations' => $locations,
//     ];

//     // Add inline script to pass the data
//     wp_add_inline_script('app', 'const locations = ' . json_encode($script_data['locations']) . ';', 'before');
// }, 100);

// add_action('template_redirect', function () {
//     if (is_page('phpinfo')) {
//         (new \App\Http\Controllers\PhpInfoController)->index();
//     }
// });
