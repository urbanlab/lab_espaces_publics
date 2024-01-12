<?php

namespace App;

add_action('init', function () {

	# Taxonomy Ressources
	register_extended_taxonomy('ressource-types', 'ressources', array(

		'dashboard_glance' => true,
		'show_in_rest' => true,
		'has_archive' => true,
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

	));

	# Taxonomy Inspiration
	register_extended_taxonomy(
		'inspiration-defis',
		'inspirations',
		array(
			'dashboard_glance' => true,
			'show_in_rest' => true,
			'hierarchical' => true,
			'has_archive' => true,
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
			'slug'     => 'inspiration-défis'
		)
	);

	register_extended_taxonomy(
		'inspiration-localisation',
		'inspirations',
		array(

			'dashboard_glance' => true,
			'show_in_rest' => true,
			'hierarchical' => true,
			'has_archive' => true,
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

	register_extended_taxonomy(
		'inspiration-mots-clés',
		'inspirations',
		array(
			'dashboard_glance' => true,
			'show_in_rest' => true,
			'hierarchical' => true,
			'has_archive' => true,
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


	# Taxonomy Projets pilotes

	register_extended_taxonomy(
		'projects-defis',
		'projects',
		array(

			'dashboard_glance' => true,
			'show_in_rest' => true,
			'hierarchical' => true,
			'has_archive' => true,
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
			'slug'     => 'projects-defis'

		)
	);

	register_extended_taxonomy(
		'projects-localisation',
		'projects',
		array(

			'dashboard_glance' => true,
			'show_in_rest' => true,
			'hierarchical' => true,
			'has_archive' => true,
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
			'slug'     => 'projects-localisation'

		)
	);

	register_extended_taxonomy(
		'projects-mots-clés',
		'projects',
		array(

			'dashboard_glance' => true,
			'show_in_rest' => true,
			'hierarchical' => true,
			'has_archive' => true,
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
			'slug'     => 'projects-mots-clés'

		)
	);
});
