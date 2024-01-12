<?php

namespace App;

class Ajax
{
    public function __construct()
    {
        add_action('wp_ajax_custom_filter_posts', [$this, 'customFilterPosts']);
        add_action('wp_ajax_nopriv_custom_filter_posts', [$this, 'customFilterPosts']);
    }

    public function customFilterPosts()
    {
        // Security check - verify nonce if used
        check_ajax_referer('allow_all_nonce', 'nonce');

        // Get taxonomy and post type from AJAX request
        $taxonomy = sanitize_text_field($_POST['taxonomy']);
        $postType = sanitize_text_field($_POST['postType']);

        // Your custom query logic here
        $args = [
            'post_type' => $postType,
            'tax_query' => [
                [
                    'taxonomy' => $taxonomy,
                    'field'    => 'slug',  //
                    'terms'    => sanitize_text_field($_POST['term']),
                ],
            ],
        ];

        $query = new \WP_Query($args);

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                // Output your post content or use get_template_part to load template parts
            }
            wp_reset_postdata();
        } else {
            // Output message for no posts found
            echo 'No posts found.';
        }

        wp_die(); // Terminate AJAX script execution
    }
}

new Ajax();
