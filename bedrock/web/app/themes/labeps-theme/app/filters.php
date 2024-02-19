<?php

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
    return sprintf(' &hellip; <a href="%s">%s</a>', get_permalink(), __('En savoir plus', 'sage'));
});

add_filter('excerpt_length', function() {
    return 20;
  });

add_action('pre_get_posts', function ($query) {
    if (!is_admin() && $query->is_main_query()) {
        // Vérifiez si c'est une page d'archive (ou une condition spécifique)
        if (is_archive()) {
            $query->set('posts_per_page', 12); // Définissez le nombre de posts à 12
        }
    }
});
