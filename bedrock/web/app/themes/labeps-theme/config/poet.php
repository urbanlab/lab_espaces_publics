<?php

use App\View\Composers\CustomTaxonomyField;

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
            'hierarchical' => false,
            'has_archive' => true,
            'show_in_feed' => false,
            'public' => true,
            'show_in_nav_menus' => true,
            'menu_position' => 5,
            'order' => 'ASC',
            'admin_cols' => [
                'featured_image' => [
                    'title'          => 'Image',
                    'featured_image' => 'thumbnail'
                ],
                'types' => [
                    'taxonomy' => 'types',
                    'title'    => 'Types',
                    'link'     => 'edit',
                ],
                'motscles' => [
                    'taxonomy' => 'motscles',
                    'title'    => 'Mots clés',
                    'link'     => 'edit',
                    'meta_box' => 'radio',
                ],
                'published' => array(
                    'title'       => 'Published',
                    'meta_key'    => 'published_date',
                    'date_format' => 'd/m/Y'
                ),
            ],
            'archive' => [
                'posts_per_page' => 12,
            ],
            'labels' => [
                'singular' => 'Boite à outils',
                'plural'   => 'Boite à outils',
                'slug'     => 'ressources',
            ],
        ],
        'inspirations' => [
            'enter_title_here' => 'Ajoutez votre inspiration',
            'menu_icon'    => 'dashicons-cover-image',
            'supports' => ['title', 'editor', 'author', 'excerpt', 'thumbnail'],
            'show_in_rest' => true,
            'has_archive' => true,
            'hierarchical' => false,
            'show_in_feed' => false,
            'public' => true,
            'show_in_nav_menus' => true,
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
                'motscles' => [
                    'taxonomy' => 'motscles',
                    'title'    => 'Mots clés',
                    'link'     => 'edit',
                ],
                'defis' => [
                    'taxonomy' => 'defis',
                    'title'    => 'Défis',
                    'link'     => 'edit',
                ],
                'localisation' => [
                    'taxonomy' => 'localisation-inspiration',
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
                'search_items' => 'Rechercher une inspiration',
                'all_items' => 'Toutes les inspirations',
                'parent_item' => 'Inspiration parente',
                'parent_item_colon' => 'Inspiration parente:',
                'edit_item' => 'Editer inspiration',
                'update_item' => 'Mettre à jour inspiration',
                'add_new_item' => 'Ajouter une inspiration', 
                'new_item_name' => 'Nouveau nom inspiration',
                'menu_name' => 'Inspirations',
            ],
        ],
        'projects' => [
            'enter_title_here' => 'Ajouter un projet',
            'menu_icon'    => 'dashicons-buddicons-topics',
            'supports' => ['title', 'editor', 'author', 'excerpt', 'thumbnail', 'custom-fields'],
            'show_in_rest' => true,
            'has_archive' => true,
            'hierarchical' => false,
            'show_in_feed' => false,
            'public' => true,
            'show_in_nav_menus' => true,
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
                'motscles' => [
                    'taxonomy' => 'motscles',
                    'title'    => 'Mots clés',
                    'link'     => 'edit',
                ],
                'defis' => [
                    'taxonomy' => 'defis',
                    'title'    => 'Défis',
                    'link'     => 'edit',
                ],
                'commune' => [
                    'taxonomy' => 'commune',
                    'title'    => 'Commune',
                    'link'     => 'edit',
                ],
            ],

            'admin_filters' => [
			'genre' => [
				'taxonomy' => 'commune',
			]
            ],
            'archive' => [
                'posts_per_page' => 10,
            ],
            'labels' => [
                'singular' => 'Projet pilote',
                'plural'   => 'Projets pilotes',
                'slug'     => 'projets-pilotes',
                'search_items' => 'Rechercher projet pilote',
                'all_items' => 'Tous les projets pilotes',
                'parent_item' => 'Projet pilote parent',
                'parent_item_colon' => 'Projet pilote parent:',
                'edit_item' => 'Editer projet pilote',
                'update_item' => 'Mettre à jour le projet pilote',
                'add_new_item' => 'Ajouter un projet pilote', 
                'new_item_name' => 'Nouveau nom du projet pilote',
                'menu_name' => 'Projet pilote',
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
        'defis' => [
            'links' => ['inspirations', 'projects', 'post', 'ressources'],
            'meta_box' => 'dropdown',
            'dashboard_glance' => true,
            'show_in_rest' => true,
            'hierarchical' => true,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'defis'),
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
                'search_items' => 'Rechercher défi',
                'all_items' => 'Tous les défis',
                'parent_item' => 'Défi parent',
                'parent_item_colon' => 'Défi parent:',
                'edit_item' => 'Editer défi',
                'update_item' => 'Mettre à jour le défi',
                'add_new_item' => 'Ajouter un défi', 
                'new_item_name' => 'Nouveau nom du défi',
                'menu_name' => 'Défis',
            ],
        ],
        'motscles' => [
            'links' => ['inspirations', 'ressources', 'projects'],
            'meta_box_cb' => true,
            'dashboard_glance' => true,
            'show_in_rest' => true,
            'hierarchical' => true,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'motscles'),
            'admin_cols' => [
                'updated' => array(
                'title' => 'Updated',
                'meta_key' => 'updated_date',
                'date_format' => 'd/m/Y',
                ),
            ],
            'labels' => [
                'singular' => 'Mot clé',
                'plural' => 'Mots clés',
                'url' => 'mots-cles',
                'search_items' => 'Rechercher mot clé',
                'all_items' => 'Tous les mots clés',
                'parent_item' => 'Mot clé Parent',
                'parent_item_colon' => 'Mot clé parent:',
                'edit_item' => 'Editer mot clé',
                'update_item' => 'Mettre à jour le mot clé',
                'add_new_item' => 'Ajouter un mot clé',
                'new_item_name' => 'Nouveau nom du mot clé',
                'menu_name' => 'Mots clés',
            ],
        ],
        'ctm' => [
            'links' => ['projects'],
            'meta_box' => 'radio',
            'dashboard_glance' => true,
            'show_in_rest' => true,
            'hierarchical' => true,
			'has_archive' => true,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'motscles'),
            'admin_cols' => [
                'updated' => array(
                    'title'       => 'Updated',
                    'meta_key'    => 'updated_date',
                    'date_format' => 'd/m/Y'
                ),
            ],
            'labels' => [
                'singular' => 'Conférence territorial des maires',
                'plural' => 'CTM',
                'url' => 'ctm-lab',
                'search_items' => 'Rechercher la CTM',
                'all_items' => 'Toutes les CTM',
                'edit_item' => 'Editer la CTM',
                'update_item' => 'Mettre à jour la CTM',
                'add_new_item' => 'Ajouter une CTM', 
                'new_item_name' => 'Nouveau nom de la CTM',
                'menu_name' => 'Conférence territorial des maires',
            ],
        ],
        'commune' => [
            'links' => ['projects'],
            'meta_box' => 'radio',
            'dashboard_glance' => true,
            'show_in_rest' => true,
            'hierarchical' => true,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'motscles'),
            'admin_cols' => [
                'updated' => [
                    'title'       => 'Updated',
                    'meta_key'    => 'updated_date',
                    'date_format' => 'd/m/Y',
                ],
            ],
            'labels' => [
                'singular' => 'Commune',
                'plural' => 'Communes',
                'url' => 'commune-lab',
                'search_items' => 'Rechercher commune',
                'all_items' => 'Toutes les communes',
                'edit_item' => 'Editer la commune',
                'update_item' => 'Mettre à jour commune',
                'add_new_item' => 'Ajouter une commune',
                'new_item_name' => 'Nouveau nom de commune',
                'menu_name' => 'Commune',
            ],
        ],
        'statuts' => [
            'links' => ['projects'],
            'dashboard_glance' => true,
            'show_in_rest' => false,
            'hierarchical' => true,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'statuts'),
            'admin_cols' => [
                'updated' => array(
                    'title'       => 'Updated',
                    'meta_key'    => 'updated_date',
                    'date_format' => 'd/m/Y'
                ),
            ],
            'labels' => [
                'singular' => 'statut',
                'plural' => 'Statuts',
                'url' => 'statuts',
                'search_items' => 'Rechercher le statut',
                'all_items' => 'Tous les statuts',
                'edit_item' => 'Editer le statut',
                'update_item' => 'Mettre à jour le statut',
                'add_new_item' => 'Ajouter un statut', 
                'new_item_name' => 'Nouveau nom du statut',
                'menu_name' => 'Statuts',
            ],
        ],
        'localisation-inspiration' => [
            'links' => ['inspirations'],
            'dashboard_glance' => true,
            'show_in_rest' => true,
			'has_archive' => true,
            'hierarchical' => true,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'localisation-inspiration'),
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
                'url' => 'localisations-lab',
                'search_items' => 'Rechercher localisation',
                'all_items' => 'Toutes les localisations',
                'parent_item' => 'Localisation Parente',
                'parent_item_colon' => 'Localisation Parente:',
                'edit_item' => 'Editer localisation',
                'update_item' => 'Mettre à jour localisation',
                'add_new_item' => 'Ajouter une localisation', 
                'new_item_name' => 'Nouveau nom de localisation',
                'menu_name' => 'Localisations',
            ],
        ],
        'types' => [
            'links' => ['ressources'],
            'meta_box' => 'radio',
            'dashboard_glance' => true,
            'show_in_rest' => true,
            'hierarchical' => true,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'types'),
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
                'search_items' => 'Rechercher type',
                'all_items' => 'Tous les types',
                'parent_item' => 'Type parent',
                'parent_item_colon' => 'Type parent:',
                'edit_item' => 'Editer type',
                'update_item' => 'Mettre à jour le type',
                'add_new_item' => 'Ajouter un type', 
                'new_item_name' => 'Nouveau nom du type',
                'menu_name' => 'Types',
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
        'hero' => [
            'attributes' => [
                'title' => [
                    'default' => 'Lorem ipsum',
                    'type' => 'string',
                ],
            ],
        ],
        'accordion' => [
            'attributes' => [
                'title' => [
                    'default' => 'Lorem ipsum',
                    'type' => 'string',
                ],
            ],
        ]
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

    'block_category' => [
        'labeps-theme',
    ],

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
    //     'labeps-theme/hero' => [
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
        'gutenberg',
    ],

];
