<?php

namespace App;

function normalize_url($url) {
    $parsed_url = parse_url($url);
    $path = $parsed_url['path'] ?? '';
    $path = trim($path, '/'); 
    
    return $path;
}
