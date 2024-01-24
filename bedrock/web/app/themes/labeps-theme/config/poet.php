<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Post Types
    |--------------------------------------------------------------------------
    |
    | Here you may specify the post types to be registered by Poet using the
    | Extended CPTs library. <https://github.com/johnbillion/extended-cpts>
    |
    */

    'post' => [
        'ressources' => [
            'enter_title_here' => 'Ajouter le titre de votre ressource',
            'menu_icon' => 'dashicons-book-alt',
            'supports' => ['title', 'editor', 'author', 'excerpt', 'thumbnail'],
            'show_in_rest' => true,
            'has_archive' => true,
            'show_in_feed' => false,
            'public' => true,
            'menu_position' => 5,
            'admin_cols' => [
                'featured_image' => [
                    'title'          => 'Image',
                    'featured_image' => 'thumbnail'
                ],
                'types' => [
                    'taxonomy' => 'types'
                ],
                'published' => array(
                    'title'       => 'Published',
                    'meta_key'    => 'published_date',
                    'date_format' => 'd/m/Y'
                ),
            ],
            'archive' => [
                'posts_per_page' => 10,
            ],
            'labels' => [
                'singular' => 'Boite à outils',
                'plural'   => 'Boite à outils',
                'slug'     => 'ressources',
            ],
        ],
        'inspirations' => [
            'enter_title_here' => 'Ajoutez votre titre',
            'menu_icon'    => 'dashicons-cover-image',
            'supports' => ['title', 'editor', 'author', 'excerpt', 'thumbnail'],
            'show_in_rest' => true,
            'has_archive' => true,
            'show_in_feed' => false,
            'public' => true,
            'menu_position' => 5,
            'admin_cols' => [
                'featured_image' => [
                    'title'          => 'Image',
                    'featured_image' => 'thumbnail',
                    'width'          => 80,
                    'height'         => 80,
                ],
                'published' => [
                    'title'       => 'Publiée',
                    'meta_key'    => 'published_date',
                    'date_format' => 'd/m/Y'
                ],
                'inspirations-mots-clés' => [
                    'taxonomy' => 'inspirations-mots-clés',
                    'title'    => 'Mots-clés',
                    'link'     => 'edit',
                ],
                'defis' => [
                    'taxonomy' => 'defis',
                    'title'    => 'Défis',
                    'link'     => 'edit',
                ],
                'localisation' => [
                    'taxonomy' => 'localisation',
                    'title'    => 'Localisation',
                    'link'     => 'edit',
                ],
            ],
            'archive' => [
                'posts_per_page' => 10,
            ],
            'labels' => [
                'singular' => 'Inspiration',
                'plural'   => 'Inspirations',
                'slug'     => 'inspirations',
            ],
        ],
        'projects' => [
            'enter_title_here' => 'Ajouter un projet',
            'menu_icon'    => 'dashicons-buddicons-topics',
            'supports' => ['title', 'editor', 'author', 'excerpt', 'thumbnail'],
            'show_in_rest' => true,
            'has_archive' => true,
            'show_in_feed' => false,
            'public' => true,
            'menu_position' => 6,
            'admin_cols' => [
                'featured_image' => [
                    'title'          => 'Image',
                    'featured_image' => 'thumbnail',
                    'width'          => 80,
                    'height'         => 80,
                ],
                'published' => [
                    'title'       => 'Publiée',
                    'meta_key'    => 'published_date',
                    'date_format' => 'd/m/Y'
                ],
                'projects-mots-clés' => [
                    'taxonomy' => 'projects-mots-clés',
                    'title'    => 'Mots-clés',
                    'link'     => 'edit',
                ],
                'defis' => [
                    'taxonomy' => 'defis',
                    'title'    => 'Défis',
                    'link'     => 'edit',
                ],
                'localisation' => [
                    'taxonomy' => 'localisation',
                    'title'    => 'Localisation',
                    'link'     => 'edit',
                ],
            ],
            'archive' => [
                'posts_per_page' => 10,
            ],
            'labels' => [
                'singular' => 'Projet pilote',
                'plural'   => 'Projets pilotes',
                'slug'     => 'projets-pilotes',
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Taxonomies
    |--------------------------------------------------------------------------
    |
    | Here you may specify the taxonomies to be registered by Poet using the
    | Extended CPTs library. <https://github.com/johnbillion/extended-cpts>
    |
    */

    'taxonomy' => [
        'types' => [
            'links' => ['ressources'],
            'meta_box' => 'radio',
            'dashboard_glance' => true,
            'show_in_rest' => true,
            'admin_cols' => [
                'updated' => array(
                    'title'       => 'Updated',
                    'meta_key'    => 'updated_date',
                    'date_format' => 'd/m/Y'
                ),
            ],
            'labels' => [
                'singular' => 'Type',
                'plural' => 'Types',
                'url' => 'ressource-types',
            ],
        ],
        'defis' => [
            'links' => ['inspirations', 'projects'],
            'meta_box' => 'radio',
            'dashboard_glance' => true,
            'show_in_rest' => true,
            'admin_cols' => [
                'updated' => array(
                    'title'       => 'Updated',
                    'meta_key'    => 'updated_date',
                    'date_format' => 'd/m/Y'
                ),
            ],
            'labels' => [
                'singular' => 'Défi',
                'plural' => 'Défis',
                'url' => 'defis-lab',
            ],
        ],
        'localisation' => [
            'links' => ['inspirations', 'projects'],
            'dashboard_glance' => true,
            'show_in_rest' => true,
            'hierarchical' => true,
			'has_archive' => true,
            'admin_cols' => [
                'updated' => array(
                    'title'       => 'Updated',
                    'meta_key'    => 'updated_date',
                    'date_format' => 'd/m/Y'
                ),
            ],
            'labels' => [
                'singular' => 'Localisation',
                'plural' => 'Localisations',
                'url' => 'localisation-lab',
            ],
        ],
        'projects-mots-clés' => [
            'links' => ['projects'],
            'meta_box' => 'radio',
            'dashboard_glance' => true,
            'show_in_rest' => true,
            'hierarchical' => true,
			'has_archive' => true,
            'admin_cols' => [
                'updated' => array(
                    'title'       => 'Updated',
                    'meta_key'    => 'updated_date',
                    'date_format' => 'd/m/Y'
                ),
            ],
            'labels' => [
                'singular' => 'Mot Clé',
                'plural' => 'Mot Clés',
                'url' => 'projects-mots-clés',
            ],
        ],
        'inspirations-mots-clés' => [
            'links' => ['inspirations'],
            'meta_box' => 'radio',
            'dashboard_glance' => true,
            'show_in_rest' => true,
            'admin_cols' => [
                'updated' => array(
                    'title'       => 'Updated',
                    'meta_key'    => 'updated_date',
                    'date_format' => 'd/m/Y'
                ),
            ],
            'labels' => [
                'singular' => 'Mot Clé',
                'plural' => 'Mot Clés',
                'url' => 'inspirations-mots-clés',
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Blocks
    |--------------------------------------------------------------------------
    |
    | Here you may specify the block types to be registered by Poet and
    | rendered using Blade.
    |
    | Blocks are registered using the `namespace/label` defined when
    | registering the block with the editor. If no namespace is provided,
    | the current theme text domain will be used instead.
    |
    | Given the block `sage/accordion`, your block view would be located at:
    |   ↪ `views/blocks/accordion.blade.php`
    |
    | Block views have the following variables available:
    |   ↪ $data    – An object containing the block data.
    |   ↪ $content – A string containing the InnerBlocks content.
    |                Returns `null` when empty.
    |
    */

    'block' => [
        'sage/accordion' => [
            'attributes' => [
                'title' => [
                    'default' => 'Lorem ipsum',
                    'type' => 'string',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Block Categories
    |--------------------------------------------------------------------------
    |
    | Here you may specify block categories to be registered by Poet for use
    | in the editor.
    |
    */

    // 'block_category' => [
    //     'cta' => [
    //         'title' => 'Call to Action',
    //         'icon' => 'star-filled',
    //     ],
    // ],

    /*
    |--------------------------------------------------------------------------
    | Block Patterns
    |--------------------------------------------------------------------------
    |
    | Here you may specify block patterns to be registered by Poet for use
    | in the editor.
    |
    | Patterns are registered using the `namespace/label` defined when
    | registering the block with the editor. If no namespace is provided,
    | the current theme text domain will be used instead.
    |
    | Given the pattern `sage/hero`, your pattern content would be located at:
    |   ↪ `views/block-patterns/hero.blade.php`
    |
    | See: https://developer.wordpress.org/reference/functions/register_block_pattern/
    */

    // 'block_pattern' => [
    //     'sage/hero' => [
    //         'title' => 'Page Hero',
    //         'description' => 'Draw attention to the main focus of the page, and highlight key CTAs',
    //         'categories' => ['all'],
    //     ],
    // ],

    /*
    |--------------------------------------------------------------------------
    | Block Pattern Categories
    |--------------------------------------------------------------------------
    |
    | Here you may specify block pattern categories to be registered by Poet for
    | use in the editor.
    |
    */

    // 'block_pattern_category' => [
    //     'all' => [
    //         'label' => 'All Patterns',
    //     ],
    // ],

    /*
    |--------------------------------------------------------------------------
    | Editor Palette
    |--------------------------------------------------------------------------
    |
    | Here you may specify the color palette registered in the Gutenberg
    | editor.
    |
    | A color palette can be passed as an array or by passing the filename of
    | a JSON file containing the palette.
    |
    | If a color is passed a value directly, the slug will automatically be
    | converted to Title Case and used as the color name.
    |
    | If the palette is explicitly set to `true` – Poet will attempt to
    | register the palette using the default `palette.json` filename generated
    | by <https://github.com/roots/palette-webpack-plugin>
    |
    */

    'palette' => [
        // 'red' => '#ff0000',
        // 'blue' => '#0000ff',
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Menu
    |--------------------------------------------------------------------------
    |
    | Here you may specify admin menu item page slugs you would like moved to
    | the Tools menu in an attempt to clean up unwanted core/plugin bloat.
    |
    | Alternatively, you may also explicitly pass `false` to any menu item to
    | remove it entirely.
    |
    */

    'admin_menu' => [
        // 'gutenberg',
    ],

];
