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

        $query = new \WP_Query($args);

        if (!$query->have_posts()) {
            wp_send_json_error('Aucun post trouvé.');
            wp_die();
        }

        $html = view('partials.ajax-response', ['query' => $query])->render();

        ob_start();
        $pagination = the_posts_pagination(array(
            'mid_size'  => 2,
            'prev_text' => __('Retour', 'textdomain'),
            'next_text' => __('Suivant', 'textdomain'),
        ));

        $pagination = ob_get_clean();


        wp_reset_postdata();
        wp_send_json_success(['html' => $html, 'pagination' => $pagination]);

        wp_die();
    }


    private function build_tax_query($requestData) {
        $conditions = [];
        foreach ($requestData as $key => $value) {
            if (in_array($key, ['action', 'nonce', 'content_type']) || empty($value)) {
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

        $tax_query = !empty($conditions) ? ['relation' => 'OR', ...$conditions] : $conditions;

        return $tax_query;
    }
}
