<?php

declare(strict_types=1);

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
        'forms.filter-posts',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with(): array
    {
        $query = new \WP_Query([
            'category_name' => 'evenements',
            'order' => 'DESC',
        ]);

        return [
            'category_posts' => $query->posts,
        ];
    }
}
