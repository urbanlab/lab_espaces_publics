<?php

namespace App;

add_action( 'init', function() {

    # CPT Ressources
	register_extended_post_type( 'ressources', [

        'show_in_feed' => false,
        'menu_icon'    => 'dashicons-pressthis',

        # Add some custom columns to the admin screen:
        'admin_cols' => [
            'featured_image' => [
                'title'          => 'Image',
                'featured_image' => 'thumbnail'
            ],
			'course_dept' => [
                'taxonomy' => 'type'
			],
			'ressource-types' => [
				'taxonomy' => 'ressource-types'
		    ]
		],

        # Add some custom archive page:
		'archive' => [
			'posts_per_page' => 10,
		],

	], [

		'singular' => 'Ressource',
		'plural'   => 'Ressources',
		'slug'     => 'ressources',

	] );

	register_extended_taxonomy( 'ressource-types', 'ressources', array(

		'dashboard_glance' => true,

		'admin_cols' => array(
				'updated' => array(
						'title'       => 'Updated',
						'meta_key'    => 'updated_date',
						'date_format' => 'd/m/Y'
				),
		),

    ), array(

            'singular' => 'Type',
            'plural'   => 'Types',
            'slug'     => 'Ressource-types'

    ) );

    # CPT Inspiration
    register_extended_post_type( 'inspirations', [

        'show_in_feed' => false,
        'menu_icon'    => 'dashicons-cover-image',

        # Add some custom columns to the admin screen:
        'admin_cols' => [
            'featured_image' => [
                'title'          => 'Image',
                'featured_image' => 'thumbnail'
            ],
			'course_dept' => [
                'taxonomy' => 'defis',
                'taxonomy' => 'localisation',
                'taxonomy' => 'mots-clés'
			],
			'inspirations' => [
				'taxonomy' => 'inspiration-types'
		    ]
		],

        # Add some custom archive page:
		'archive' => [
			'posts_per_page' => 10,
		],

	], [

		'singular' => 'Inspiration',
		'plural'   => 'Inspirations',
		'slug'     => 'inspirations',

	] );

	register_extended_taxonomy( 'inspiration-types', 'inspirations', array(

		'dashboard_glance' => true,

		'admin_cols' => array(
				'updated' => array(
						'title'       => 'Updated',
						'meta_key'    => 'updated_date',
						'date_format' => 'd/m/Y'
				),
		),

    ), array(

            'singular' => 'Défi',
            'plural'   => 'Défis',
            'slug'     => 'inspiration-défis'

    ) );

});