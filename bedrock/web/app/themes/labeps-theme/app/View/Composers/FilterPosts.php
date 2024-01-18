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
        return [
            'taxonomy_terms' => $this->getTaxonomyTerms(), // Pass the taxonomy name here
        ];
    }

    protected function getTaxonomyTerms()
    {
        $post_type = get_post_type(); // Get the current post type

        if (!$post_type) {
            return [];
        }

        $taxonomies = get_object_taxonomies($post_type);

        $terms = [];

        foreach ($taxonomies as $taxonomy) {
            $terms[$taxonomy] = get_terms(['taxonomy' => $taxonomy, 'hide_empty' => false]);
        }

        return $terms;
    }
}
