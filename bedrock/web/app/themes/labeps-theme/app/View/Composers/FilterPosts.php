<?php

declare(strict_types=1);

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
        'archive-events',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */

    public function with(): array
    {
        $queriedObject = get_queried_object();
        $cpt = $queriedObject instanceof \WP_Post_Type ? $queriedObject->name : null;

        return [
            'taxonomies' => $this->taxonomies($cpt),
            'cpt' => $cpt,
        ];
    }

    protected function taxonomies($cpt = null): array
    {
        if (!$cpt) {
            return [];
        }

        $taxonomies = get_object_taxonomies($cpt, 'objects');
        $data = [];

        foreach ($taxonomies as $taxonomy) {
            $terms = get_terms(['taxonomy' => $taxonomy->name, 'hide_empty' => true]);

            $data[$taxonomy->name] = [
                'hierarchical' => $taxonomy->hierarchical,
                'terms' => $terms,
            ];
        }

        return $data;
    }
}
