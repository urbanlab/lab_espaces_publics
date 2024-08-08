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

        $contentType = sanitize_text_field($_POST['content_type'] ?? 'post');
        $tax_query = $this->build_tax_query($_POST);
        $page_number = isset($_POST['page_number']) ? intval($_POST['page_number']) : 1;

        $args = [
            'post_type'      => $contentType,
            'posts_per_page' => 12,
            'tax_query'      => $tax_query,
            'paged'          => $page_number,
            'post_status'    => 'publish',
        ];

        $query = new \WP_Query($args);

        if (!$query->have_posts()) {
            wp_send_json_error(['html' => 'Aucun post trouvé.', 'projects' => [], 'pagination' => '']);
            wp_die();
        }

        $html = view('partials.ajax-response', ['query' => $query])->render();

        ob_start();
        $pagination = paginate_links([
            'mid_size'  => 2,
            'prev_text' => __('&laquo; Retour', 'textdomain'),
            'next_text' => __('Suivant &raquo;', 'textdomain'),
        ]);
        $pagination = ob_get_clean();

        wp_reset_postdata();

        $response = [
            'html' => $html,
            'pagination' => $pagination,
        ];

        // Si le type de contenu est "projects", récupérer les données pour la carte
        if ($contentType === 'projects') {
            $mapComposer = new MapComposer();
            $response['projects'] = $mapComposer->projects($_POST, false); // Le second paramètre false indique que nous ne voulons pas les filtres
        }

        wp_send_json_success($response);

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
                    'hide_empty'=> true,
                ];
            }
        }

        return !empty($conditions) ? ['relation' => 'OR', ...$conditions] : $conditions;
    }
}

new AjaxHandler();