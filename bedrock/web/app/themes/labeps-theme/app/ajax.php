<?php

namespace App;

use App\View\Composers\MapComposer;

class AjaxHandler {
    public function __construct() {
        add_action('wp_ajax_filter_posts', [$this, 'handle']);
        add_action('wp_ajax_nopriv_filter_posts', [$this, 'handle']);
    }

    public function handle() {
        check_ajax_referer('filter_posts_nonce', 'nonce');

        $filters = $_POST;
        unset($filters['action'], $filters['nonce'], $filters['page_number'], $filters['content_type']);

        $mapComposer = new MapComposer();
        $projects = $mapComposer->projects($filters);

        error_log('Projects data: ' . print_r($projects, true));

        if (empty($projects)) {
            wp_send_json_error('Aucun post trouvé.');
            wp_die();
        }

        // Conserver la logique de pagination et de filtrage existante
        $contentType = sanitize_text_field($_POST['content_type'] ?? 'post');
        $tax_query = $this->build_tax_query($_POST);
        $paged = isset($_POST['page_number']) ? intval($_POST['page_number']) : 1;

        $args = [
            'post_type'      => $contentType,
            'posts_per_page' => 12,
            'tax_query'      => $tax_query,
            'paged'          => $paged,
            'post_status'    => 'publish',
        ];

        $query = new \WP_Query($args);

        error_log('Query Args: ' . print_r($args, true));
        error_log('Query Results: ' . print_r($query->posts, true));

        if (!$query->have_posts()) {
            wp_send_json_error('Aucun post trouvé.');
            wp_die();
        }

        $html = view('partials.ajax-response', ['query' => $query])->render();

        ob_start();
        the_posts_pagination([
            'mid_size'  => 2,
            'prev_text' => __('Retour', 'textdomain'),
            'next_text' => __('Suivant', 'textdomain'),
        ]);
        $pagination = ob_get_clean();

        wp_reset_postdata();
        wp_send_json_success([
            'html' => $html,
            'pagination' => $pagination,
            'projects' => $projects,
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

        return !empty($conditions) ? ['relation' => 'OR', ...$conditions] : $conditions;
    }
}

new AjaxHandler();