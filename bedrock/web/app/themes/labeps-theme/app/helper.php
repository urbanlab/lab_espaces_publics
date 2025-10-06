<?php

declare(strict_types=1);

namespace App;

function normalize_url(string $url): string
{
    $parsed_url = parse_url($url);
    $path = $parsed_url['path'] ?? '';

    return trim($path, '/');
}
