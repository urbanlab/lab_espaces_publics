<?php

declare(strict_types=1);

/**
 * Theme filters.
 */

namespace App;

/**
 * Add "… Continued" to the excerpt.
 *
 * @return string
 */
add_filter('excerpt_more', function () {
    return '...';
});

add_filter('excerpt_length', function () {
    return 40;
});

remove_filter('the_excerpt', 'wpautop');

add_action('pre_get_posts', function ($query) {
    if (!is_admin() && $query->is_main_query()) {
        if (is_archive()) {
            $query->set('posts_per_page', 6);
        }

        if (is_search()) {
            $query->set('posts_per_page', 6);
        }
    }
});
