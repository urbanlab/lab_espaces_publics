<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;
use WP_Query;

class MapComposer extends Composer
{
    protected static $views = [
        'archive-projects',
    ];

    public function with()
    {
        return [
            'locations' => $this->locations(),
        ];
    }

    public function locations()
    {
        $locations = [];
        $args = [
            'post_type' => 'commune',
            'posts_per_page' => -1,
        ];

        $query = new WP_Query($args);

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $latitude = get_post_meta(get_the_ID(), 'latitude', true);
                $longitude = get_post_meta(get_the_ID(), 'longitude', true);
                if ($latitude && $longitude) {
                    $locations[] = [
                        'title' => get_the_title(),
                        'latitude' => $latitude,
                        'longitude' => $longitude,
                        'description' => get_the_content(),
                    ];
                }
            }
            wp_reset_postdata();
        }

        return $locations;
    }
}