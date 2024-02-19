<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class FilterPosts extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var string[]
     */
    protected static $views = [
        'archive-ressources',
        'archive-inspirations',
        'archive-projects',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */

     public function with()
{
    $queriedObject = get_queried_object();
    $cpt = $queriedObject instanceof \WP_Post_Type ? $queriedObject->name : null;

    return [
        'taxonomies' => $this->taxonomies($cpt),
        'cpt' => $cpt,
    ];
}

protected function taxonomies($cpt = null)
{
    // Si aucun CPT n'est fourni, retourner un tableau vide ou une valeur par défaut
    if (!$cpt) {
        return [];
    }

    $taxonomies = get_object_taxonomies($cpt, 'objects');
    $data = [];

    foreach ($taxonomies as $taxonomy) {
        $terms = get_terms(['taxonomy' => $taxonomy->name, 'hide_empty' => false]);
        $data[$taxonomy->name] = [
            'hierarchical' => $taxonomy->hierarchical,
            'terms' => $terms,
        ];
    }

    return $data;
    }
}