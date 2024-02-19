<?php

namespace App;

add_action('wp_ajax_my_custom_filter', [AjaxHandler::class, 'handle']);
add_action('wp_ajax_nopriv_my_custom_filter', [AjaxHandler::class, 'handle']);

class AjaxHandler
{
    public static function handle() {
        // Vérifiez le nonce pour la sécurité
        check_ajax_referer('my_custom_nonce', 'nonce');

        // Logique pour traiter les données reçues et préparer la réponse
        $response = ['success' => true, 'message' => 'AJAX Processed Successfully'];

        wp_send_json($response);
    }
}