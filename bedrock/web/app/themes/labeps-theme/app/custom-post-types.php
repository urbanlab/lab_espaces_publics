<?php

namespace App;

add_action( 'init', function() {

	
    # CPT Ressources
	register_extended_post_type( 'ressources', [

        'show_in_feed' => false,
        'menu_icon'    => 'dashicons-pressthis',
        'public' => true,
        'show_in_rest' => true,
        'supports' => array( 'title', 'editor','thumbnail' ),
        'menu_position' => 5, 
        'public' => true,
        'show_in_rest' => true,
        'supports' => array( 'title', 'editor','thumbnail' ),
        'menu_position' => 5, 
        # Add some custom columns to the admin screen:
        'admin_cols' => [
            'featured_image' => [
                'title'          => 'Image',
                'featured_image' => 'thumbnail'
            ],
            ],
			'ressource-types' => [
				'taxonomy' => 'ressource-types'
		    ],
			'published' => array(
				'title'       => 'Published',
				'meta_key'    => 'published_date',
				'date_format' => 'd/m/Y'
			),
		    ],
			'published' => array(
				'title'       => 'Published',
				'meta_key'    => 'published_date',
				'date_format' => 'd/m/Y'
			),
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
		'show_in_rest' => true,
		'show_in_rest' => true,
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
		'show_in_rest' => true,        
		'supports' => array( 'title', 'editor','thumbnail' ),
        'menu_position' => 5, 
		'show_in_rest' => true,        
		'supports' => array( 'title', 'editor','thumbnail' ),
        'menu_position' => 5, 
        # Add some custom columns to the admin screen:
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
			'mots-clés' => [
                'taxonomy' => 'inspiration-mots-clés',
				'title'    => 'Mots-clés',
				'link'     => 'edit',
			],
			'defis' => [
				'title'    => 'Défis',
				'taxonomy' => 'inspiration-defis',
				'link'     => 'edit',
		    ],
		],

		'archive' => [
			'posts_per_page' => 10,
                'featured_image' => 'thumbnail',
				'width'          => 80,
				'height'         => 80,
            ],
			'published' => [
				'title'       => 'Publiée',
				'meta_key'    => 'published_date',
				'date_format' => 'd/m/Y'
			],
			'mots-clés' => [
                'taxonomy' => 'inspiration-mots-clés',
				'title'    => 'Mots-clés',
				'link'     => 'edit',
			],
			'defis' => [
				'title'    => 'Défis',
				'taxonomy' => 'inspiration-defis',
				'link'     => 'edit',
		    ],
		],

		'archive' => [
			'posts_per_page' => 10,
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

	register_extended_taxonomy( 'inspiration-defis', 'inspirations', array(
	register_extended_taxonomy( 'inspiration-defis', 'inspirations', array(

		'dashboard_glance' => true,
		'show_in_rest' => true,
		'hierarchical' => true, 
		'show_in_rest' => true,
		'hierarchical' => true, 

		'admin_cols' => array(
				'updated' => array(
						'title'       => 'Updated',
						'meta_key'    => 'updated_date',
						'date_format' => 'd/m/Y'
				),
		),

    ), 	
		array(
    ), 	
		array(

				'singular' => 'Défi',
				'plural'   => 'Défis',
				'slug'     => 'inspiration-défis'
				'singular' => 'Défi',
				'plural'   => 'Défis',
				'slug'     => 'inspiration-défis'

		) 
	);

	register_extended_taxonomy( 'inspiration-localisation', 'inspirations', array(

		'dashboard_glance' => true,
		'show_in_rest' => true,
		'hierarchical' => true, 

		'admin_cols' => array(
				'updated' => array(
						'title'       => 'Updated',
						'meta_key'    => 'updated_date',
						'date_format' => 'd/m/Y'
				),
		),

    ), 	
		array(

				'singular' => 'Localisation',
				'plural'   => 'Localisations',
				'slug'     => 'inspiration-localisation'

		) 
	);

	register_extended_taxonomy( 'inspiration-mots-clés', 'inspirations', array(

		'dashboard_glance' => true,
		'show_in_rest' => true,
		'hierarchical' => true, 

		'admin_cols' => array(
				'updated' => array(
						'title'       => 'Updated',
						'meta_key'    => 'updated_date',
						'date_format' => 'd/m/Y'
				),
		),

    ), 	
		array(

				'singular' => 'Mot Clé',
				'plural'   => 'Mots Clés',
				'slug'     => 'mots-clés'

		) 
	);
		) 
	);

	register_extended_taxonomy( 'inspiration-localisation', 'inspirations', array(

		'dashboard_glance' => true,
		'show_in_rest' => true,
		'hierarchical' => true, 

		'admin_cols' => array(
				'updated' => array(
						'title'       => 'Updated',
						'meta_key'    => 'updated_date',
						'date_format' => 'd/m/Y'
				),
		),

    ), 	
		array(

				'singular' => 'Localisation',
				'plural'   => 'Localisations',
				'slug'     => 'inspiration-localisation'

		) 
	);

	register_extended_taxonomy( 'inspiration-mots-clés', 'inspirations', array(

		'dashboard_glance' => true,
		'show_in_rest' => true,
		'hierarchical' => true, 

		'admin_cols' => array(
				'updated' => array(
						'title'       => 'Updated',
						'meta_key'    => 'updated_date',
						'date_format' => 'd/m/Y'
				),
		),

    ), 	
		array(

				'singular' => 'Mot Clé',
				'plural'   => 'Mots Clés',
				'slug'     => 'mots-clés'

		) 
	);

	    # CPT Projets pilotes
		register_extended_post_type( 'projects', [

			'show_in_feed' => false,
			'menu_icon'    => 'dashicons-buddicons-topics',
			'show_in_rest' => true,        
			'supports' => array( 'title', 'editor','thumbnail' ),
			'menu_position' => 5, 
			# Add some custom columns to the admin screen:
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
				'mots-clés' => [
					'taxonomy' => 'inspiration-mots-clés',
					'title'    => 'Mots-clés',
					'link'     => 'edit',
				],
				'defis' => [
					'title'    => 'Défis',
					'taxonomy' => 'inspiration-defis',
					'link'     => 'edit',
				],
			],
	
			'archive' => [
				'posts_per_page' => 10,
			],
	
			# Add some custom archive page:
			'archive' => [
				'posts_per_page' => 10,
			],
	
		], [
	
			'singular' => 'Projet pilote',
			'plural'   => 'Projets pilotes',
			'slug'     => 'projets-pilotes',
	
		] );
	
		register_extended_taxonomy( 'projets-defis', 'projets', array(
	
			'dashboard_glance' => true,
			'show_in_rest' => true,
			'hierarchical' => true, 
	
			'admin_cols' => array(
					'updated' => array(
							'title'       => 'Updated',
							'meta_key'    => 'updated_date',
							'date_format' => 'd/m/Y'
					),
			),
	
		), 	
			array(
	
					'singular' => 'Défi',
					'plural'   => 'Défis',
					'slug'     => 'projets-défis'
	
			) 
		);

		register_extended_taxonomy( 'projets-localisation', 'projets', array(

			'dashboard_glance' => true,
			'show_in_rest' => true,
			'hierarchical' => true, 
	
			'admin_cols' => array(
					'updated' => array(
							'title'       => 'Updated',
							'meta_key'    => 'updated_date',
							'date_format' => 'd/m/Y'
					),
			),
	
		), 	
			array(
	
					'singular' => 'Localisation',
					'plural'   => 'Localisations',
					'slug'     => 'inspiration-localisation'
	
			) 
		);
	
		register_extended_taxonomy( 'projets-mots-clés', 'projets', array(
	
			'dashboard_glance' => true,
			'show_in_rest' => true,
			'hierarchical' => true, 
	
			'admin_cols' => array(
					'updated' => array(
							'title'       => 'Updated',
							'meta_key'    => 'updated_date',
							'date_format' => 'd/m/Y'
					),
			),
	
		), 	
			array(
	
					'singular' => 'Mot Clé',
					'plural'   => 'Mots Clés',
					'slug'     => 'mots-clés'
	
			) 
		);

	    # CPT Projets pilotes
		register_extended_post_type( 'projects', [

			'show_in_feed' => false,
			'menu_icon'    => 'dashicons-buddicons-topics',
			'show_in_rest' => true,        
			'supports' => array( 'title', 'editor','thumbnail' ),
			'menu_position' => 5, 
			# Add some custom columns to the admin screen:
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
				'mots-clés' => [
					'taxonomy' => 'inspiration-mots-clés',
					'title'    => 'Mots-clés',
					'link'     => 'edit',
				],
				'defis' => [
					'title'    => 'Défis',
					'taxonomy' => 'inspiration-defis',
					'link'     => 'edit',
				],
			],
	
			'archive' => [
				'posts_per_page' => 10,
			],
	
			# Add some custom archive page:
			'archive' => [
				'posts_per_page' => 10,
			],
	
		], [
	
			'singular' => 'Projet pilote',
			'plural'   => 'Projets pilotes',
			'slug'     => 'projets-pilotes',
	
		] );
	
		register_extended_taxonomy( 'projets-defis', 'projets', array(
	
			'dashboard_glance' => true,
			'show_in_rest' => true,
			'hierarchical' => true, 
	
			'admin_cols' => array(
					'updated' => array(
							'title'       => 'Updated',
							'meta_key'    => 'updated_date',
							'date_format' => 'd/m/Y'
					),
			),
	
		), 	
			array(
	
					'singular' => 'Défi',
					'plural'   => 'Défis',
					'slug'     => 'projets-défis'
	
			) 
		);

		register_extended_taxonomy( 'projets-localisation', 'projets', array(

			'dashboard_glance' => true,
			'show_in_rest' => true,
			'hierarchical' => true, 
	
			'admin_cols' => array(
					'updated' => array(
							'title'       => 'Updated',
							'meta_key'    => 'updated_date',
							'date_format' => 'd/m/Y'
					),
			),
	
		), 	
			array(
	
					'singular' => 'Localisation',
					'plural'   => 'Localisations',
					'slug'     => 'inspiration-localisation'
	
			) 
		);
	
		register_extended_taxonomy( 'projets-mots-clés', 'projets', array(
	
			'dashboard_glance' => true,
			'show_in_rest' => true,
			'hierarchical' => true, 
	
			'admin_cols' => array(
					'updated' => array(
							'title'       => 'Updated',
							'meta_key'    => 'updated_date',
							'date_format' => 'd/m/Y'
					),
			),
	
		), 	
			array(
	
					'singular' => 'Mot Clé',
					'plural'   => 'Mots Clés',
					'slug'     => 'mots-clés'
	
			) 
		);

});