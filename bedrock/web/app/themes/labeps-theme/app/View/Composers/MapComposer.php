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

    public function projects($filters = [])
    {
        $args = [
            'post_type' => 'projects',
            'posts_per_page' => -1,
            'tax_query' => !empty($filters) ? $this->build_tax_query($filters) : [],
        ];

        $query = new WP_Query($args);
        $projects = [];

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $project = $this->format_project(get_the_ID());
                if ($project) {
                    $projects[] = $project;
                }
            }
            wp_reset_postdata();
        } else {
            error_log('No posts found for post type "projects".');
        }

        return $projects;
    }

    private function format_project($post_id)
    {
        $communes = get_the_terms($post_id, 'commune');
        $defis = get_the_terms($post_id, 'defis');
        $status = get_the_terms($post_id, 'statuts');
        $commune_names = !is_wp_error($communes) && !empty($communes) ? wp_list_pluck($communes, 'name') : [];
        $defi_names = !is_wp_error($defis) && !empty($defis) ? wp_list_pluck($defis, 'name') : [];
        $status_states = !is_wp_error($status) && !empty($status) ? wp_list_pluck($status, 'name') : [];

        if (!empty($communes) && !is_wp_error($communes)) {
            $commune = $communes[0];
            $latitude = get_term_meta($commune->term_id, 'latitude', true);
            $longitude = get_term_meta($commune->term_id, 'longitude', true);

            if ($latitude && $longitude) {
                return [
                    'title' => get_the_title($post_id),
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                    'commune' => implode(', ', $commune_names),
                    'defi' => implode(', ', $defi_names),
                    'statuts' => implode(',', $status_states),
                    'excerpt' => get_the_excerpt($post_id),
                    'link' => get_permalink($post_id),
                    'button' => view('components.button', [
                        'attributes' => new \Illuminate\View\ComponentAttributeBag(['href' => get_permalink($post_id)]),
                        'class' => 'btn-primary',
                        'icon' => 'fas fa-info-circle',
                        'text' => 'En savoir plus'
                    ])->render(),
                    'simple_popup' => '<b>' . get_the_title($post_id) . '</b>',
                    'detailed_popup' => $this->create_detailed_popup($post_id, $commune_names, $defi_names)
                ];
            }
        }

        return null;
    }

    private function create_detailed_popup($post_id, $commune_names, $defi_names)
    {
        return '
            <h4>' . get_the_title($post_id) . '</h4>
            <p class="my-2">' . implode(', ', $commune_names) . '</p>
            <p class="text-primary my-1">' . implode(', ', $defi_names) . '</p>
            <p class="mb-4">' . get_the_excerpt($post_id) . '</p>
            <a href=' . get_permalink($post_id) . '>' . view('components.button', [
                'attributes' => new \Illuminate\View\ComponentAttributeBag(['onclick' => 'location.href=' . get_permalink($post_id), 'type' => "button", 'class' => 'text-white bg-secondary rounded-md p-2']),
                'class' => 'btn-primary',
                'icon' => 'fas fa-info-circle',
                'text' => 'En savoir plus'
            ])->render() . '
        ';
    }

    private function build_tax_query($filters)
    {
        $conditions = [];
        foreach ($filters as $key => $value) {
            if (taxonomy_exists($key)) {
                $conditions[] = [
                    'taxonomy' => sanitize_key($key),
                    'field'    => 'slug',
                    'terms'    => is_array($value) ? array_map('sanitize_text_field', $value) : sanitize_text_field($value),
                ];
            }
        }

        return $conditions ? ['relation' => 'AND', ...$conditions] : [];
    }

    public function statuts()
    {
        $terms = get_terms(['taxonomy' => 'statuts', 'hide_empty' => true]);
        $statuts = [];

        if (!is_wp_error($terms) && !empty($terms)) {
            foreach ($terms as $term) {
                $color = get_term_meta($term->term_id, 'color', true) ?? '#000000';
                $statuts[] = [
                    'name' => $term->name,
                    'class' => strtolower(str_replace(' ', '-', $term->name)),
                ];
            }
        }

        return $statuts;
    }
}