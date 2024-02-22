<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PhpInfoController 
{
    public function index()
    {
        if (current_user_can('administrator')) {
            phpinfo();
            exit;
        }

        // Rediriger les non-administrateurs ou afficher un message d'erreur
        return new \WP_Error('unauthorized', 'You are not allowed to view this page', array('status' => 403));
    }
}
