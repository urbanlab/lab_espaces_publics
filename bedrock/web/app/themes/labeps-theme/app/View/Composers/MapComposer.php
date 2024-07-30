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
            'projects' => $this->projects(),
            'statuts' => $this->statuts(),
        ];
    }

    public function projects()
    {
        $projects = [];
        $args = [
            'post_type' => 'projects',
            'posts_per_page' => -1,
        ];

        $query = new WP_Query($args);

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $communes = get_the_terms(get_the_ID(), 'commune');
                $defis = get_the_terms(get_the_ID(), 'defis');
                
                $commune_names = !is_wp_error($communes) && !empty($communes) ? wp_list_pluck($communes, 'name') : [];
                $defi_names = !is_wp_error($defis) && !empty($defis) ? wp_list_pluck($defis, 'name') : [];
                
                if (!empty($communes) && !is_wp_error($communes)) {
                    $commune = $communes[0];
                    $latitude = get_term_meta($commune->term_id, 'latitude', true);
                    $longitude = get_term_meta($commune->term_id, 'longitude', true);

                    if ($latitude && $longitude) {
                        $projects[] = [
                            'title' => get_the_title(),
                            'latitude' => $latitude,
                            'longitude' => $longitude,
                            'commune' => implode(', ', $commune_names),
                            'defi' => implode(', ', $defi_names),
                            'excerpt' => get_the_excerpt(),
                            'link' => get_permalink(),
                            'button' => view('components.button', [
                                'attributes' => new \Illuminate\View\ComponentAttributeBag(['href' => get_permalink()]),
                                'class' => 'btn-primary',
                                'icon' => 'fas fa-info-circle',
                                'text' => 'En savoir plus'
                            ])->render(),
                            'simple_popup' => '<b>' . get_the_title() . '</b>',
                            'detailed_popup' => '
                                <h4>' . get_the_title() . '</h4>
                                <p class="my-2">' . implode(', ', $commune_names) . '</p>
                                <p class="text-primary my-1">' . implode(', ', $defi_names) . '</p>
                                <p class="mb-4">' . get_the_excerpt() . '</p>
                                <a href=' . get_permalink(). '>' . view('components.button', [
                                    'attributes' => new \Illuminate\View\ComponentAttributeBag(['onclick' => 'location.href=' . get_permalink(), 'type'=>"button", 'class'=>'text-white bg-secondary rounded-md p-2']),
                                    'class' => 'btn-primary',
                                    'icon' => 'fas fa-info-circle',
                                    'text' => 'En savoir plus'
                                ])->render()
                        ];
                    }
                }
            }
            wp_reset_postdata();
        } else {
            error_log('No posts found for post type "projects".');
        }

        error_log('Projects: ' . print_r($projects, true));

        return $projects;
    }

    public function statuts()
    {
        $terms = get_terms(['taxonomy' => 'statuts', 'hide_empty' => false]);
        $statuts = [];

        if (!is_wp_error($terms) && !empty($terms)) {
            foreach ($terms as $term) {
                $color = get_term_meta($term->term_id, 'color', true);
                if (!$color) {
                    $color = '#000000'; // Default color
                }
                $statuts[] = [
                    'name' => $term->name,
                    'color' => $color,
                ];
            }
        }

        return $statuts;
    }
}