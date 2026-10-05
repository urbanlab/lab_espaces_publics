<?php

declare(strict_types=1);

function readHeader(string $file): string
{
    $header = file_get_contents($file, false, null, 0, 8192);

    if (is_string($header) === false) {
        return '';
    }

    return str_replace("\r", "\n", $header);
}

function readHeaderField(string $header, string $field): string
{
    $pattern = '/^(?:[ \t]*<\?(?:php)?)?[ \t\/*#@]*' . preg_quote($field, '/') . ':(.*)$/mi';

    if (preg_match($pattern, $header, $match) !== 1) {
        return '';
    }

    return trim((string) preg_replace('/\s*(?:\*\/|\?>).*/', '', $match[1]));
}

function pluginVersion(string $pluginDirectory): string
{
    $pluginFiles = glob(rtrim($pluginDirectory, '/') . '/*.php');

    if (is_array($pluginFiles) === false) {
        return '';
    }

    sort($pluginFiles, SORT_STRING);

    foreach ($pluginFiles as $pluginFile) {
        $header = readHeader($pluginFile);

        if (readHeaderField($header, 'Plugin Name') !== '') {
            return readHeaderField($header, 'Version');
        }
    }

    return '';
}

function coreVersion(string $coreDirectory): string
{
    $versionFile = rtrim($coreDirectory, '/') . '/wp-includes/version.php';

    if (is_file($versionFile) === false) {
        return '';
    }

    $source = file_get_contents($versionFile);

    if (is_string($source) === false) {
        return '';
    }

    if (preg_match('/^\$wp_version\s*=\s*[\'"]([^\'"]+)[\'"]\s*;/m', $source, $match) !== 1) {
        return '';
    }

    return $match[1];
}

$command = $argv[1] ?? '';

switch ($command) {
    case 'plugin-version':
        echo pluginVersion($argv[2] ?? '');
        exit(0);
    case 'core-version':
        echo coreVersion($argv[2] ?? '');
        exit(0);
    case 'is-newer':
        exit(version_compare($argv[2] ?? '', $argv[3] ?? '', '>') ? 0 : 1);
    default:
        fwrite(STDERR, "Usage: sync-helper.php plugin-version|core-version <directory> | is-newer <version> <version>\n");
        exit(2);
}
