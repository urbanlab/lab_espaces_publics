<?php

declare(strict_types=1);

namespace App;

use App\View\Composers\MapComposer;

class AjaxHandler
{
    public function __construct()
    {
        add_action('wp_ajax_filter_posts', [$this, 'handle']);
        add_action('wp_ajax_nopriv_filter_posts', [$this, 'handle']);
    }

    public function handle(): void
    {
        check_ajax_referer('filter_posts_nonce', 'nonce');

        $filters = $_POST;
        unset($filters['action'], $filters['nonce'], $filters['page_number'], $filters['content_type']);

        $contentType = sanitize_text_field($_POST['content_type'] ?? 'post');
        $paged = isset($_POST['paged']) ? intval($_POST['paged']) : 1;

        $tax_query = $this->build_tax_query($_POST);

        $args = [
            'post_type' => $contentType,
            'posts_per_page' => 12,
            'tax_query' => $tax_query,
            'paged' => $paged,
            'post_status' => 'publish',
        ];

        $query = new \WP_Query($args);

        if (!$query->have_posts()) {
            wp_send_json_error(['html' => 'Aucun post trouvé.', 'projects' => [], 'pagination' => '']);
            wp_die();
        }

        $html = view('partials.ajax-response', ['query' => $query])->render();

        $pagination = paginate_links([
            'total' => $query->max_num_pages,
            'current' => $paged,
            'format' => '?paged=%#%',
            'mid_size' => 2,
            'prev_text' => __('&laquo; Retour', 'textdomain'),
            'next_text' => __('Suivant &raquo;', 'textdomain'),
            'type' => 'list',
        ]);

        if ($pagination) {
            $pagination = '<nav class="pagination">' . $pagination . '</nav>';
        }

        wp_reset_postdata();

        $response = [
            'html' => $html,
            'pagination' => $pagination,
        ];

        // Si le type de contenu est "projects", récupérer les données pour la carte
        if ($contentType === 'projects') {
            $mapComposer = new MapComposer();
            $response['projects'] = $mapComposer->projects($_POST, false);
        }

        wp_send_json_success($response);

        wp_die();
    }

    private function build_tax_query($requestData): array
    {
        $conditions = [];
        foreach ($requestData as $key => $value) {
            if (in_array($key, ['action', 'nonce', 'content_type', 'paged']) || empty($value)) {
                continue;
            }

            if (taxonomy_exists($key)) {
                $conditions[] = [
                    'taxonomy' => sanitize_key($key),
                    'field' => 'slug',
                    'terms' => is_array($value) ? array_map('sanitize_text_field', $value) : sanitize_text_field($value),
                    'hide_empty' => true,
                    'relation' => 'OR'
                ];
            }
        }

        return !empty($conditions) ? ['relation' => 'AND', ...$conditions] : $conditions;
    }
}

new AjaxHandler();
