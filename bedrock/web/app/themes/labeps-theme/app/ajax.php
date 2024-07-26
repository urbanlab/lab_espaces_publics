<?php

namespace App;

class AjaxHandler {
    public function __construct() {
        add_action('wp_ajax_filter_posts', [$this, 'handle']);
        add_action('wp_ajax_nopriv_filter_posts', [$this, 'handle']);
    }

    public function handle() {
        check_ajax_referer('filter_posts_nonce', 'nonce');
        $contentType = $_POST['content_type'] ?? 'post';
        $tax_query = $this->build_tax_query($_POST);
        $paged = isset($_POST['page_number']) ? intval($_POST['page_number']) : 1;


        $args = [
            'post_type'      => $contentType,
            'posts_per_page' => 12,
            'tax_query'      => $tax_query,
            'paged'          => $paged,
            'post_status'    => 'publish',
        ];

                // Log query args
                error_log('WP_Query Args: ' . print_r($args, true));

        $query = new \WP_Query($args);

        if (!$query->have_posts()) {
            wp_send_json_error('Aucun post trouvé.');
            wp_die();
        }

        $html = view('partials.ajax-response', ['query' => $query])->render();

        // Collect location data for map
        $locations = [];
        while ($query->have_posts()) {
            $query->the_post();
            $latitude = get_post_meta(get_the_ID(), '_latitude', true);
            $longitude = get_post_meta(get_the_ID(), '_longitude', true);
            if ($latitude && $longitude) {
                $locations[] = [
                    'title' => get_the_title(),
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                    'description' => get_the_content(),
                ];
            }
        }

        ob_start();
        $pagination = the_posts_pagination([
            'mid_size'  => 2,
            'prev_text' => __('Retour', 'textdomain'),
            'next_text' => __('Suivant', 'textdomain'),
        ]);
        $pagination = ob_get_clean();

        wp_reset_postdata();
        wp_send_json_success([
            'html' => $html,
            'pagination' => $pagination,
            'locations' => $locations,
        ]);

        wp_die();
    }

    private function build_tax_query($requestData) {
        $conditions = [];
        foreach ($requestData as $key => $value) {
            if (in_array($key, ['action', 'nonce', 'content_type', 'page_number']) || empty($value)) {
                continue;
            }

            if (taxonomy_exists($key)) {
                $conditions[] = [
                    'taxonomy' => sanitize_key($key),
                    'field'    => 'slug',
                    'terms'    => is_array($value) ? array_map('sanitize_text_field', $value) : sanitize_text_field($value),
                ];
            }
        }

                // Log tax conditions
                error_log('Tax Conditions: ' . print_r($conditions, true));

        $tax_query = !empty($conditions) ? ['relation' => 'OR', ...$conditions] : $conditions;

        return $tax_query;
    }
}

new AjaxHandler();