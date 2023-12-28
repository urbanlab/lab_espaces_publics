<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Category extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var string[]
     */
    protected static $views = [
        'partials.category',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
        $query = new \WP_Query([
            'category_name' => 'evenements',
            'posts_per_page' => -1,
        ]);

        return [
            'category_posts' => $query->posts,
        ];
    }
}
