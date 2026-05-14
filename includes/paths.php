<?php

declare(strict_types=1);

/**
 * Root URL path of this application under the web server (e.g. '' or '/UX_Pacific').
 * Used so asset URLs work from both / and /admin/pages/ without 404s.
 */
if (!defined('BASE_URL')) {
    $documentRoot = isset($_SERVER['DOCUMENT_ROOT']) ? realpath($_SERVER['DOCUMENT_ROOT']) : false;
    $projectRoot = realpath(dirname(__DIR__));

    if ($documentRoot && $projectRoot) {
        $doc = rtrim(str_replace('\\', '/', $documentRoot), '/');
        $proj = rtrim(str_replace('\\', '/', $projectRoot), '/');
        $docLen = strlen($doc);
        if ($docLen > 0 && strncmp($proj, $doc, $docLen) === 0) {
            $rel = substr($proj, $docLen);
            $rel = str_replace('\\', '/', $rel);
            if ($rel === '/' || $rel === '') {
                define('BASE_URL', '');
            } else {
                define('BASE_URL', $rel);
            }
        } else {
            define('BASE_URL', '');
        }
    } else {
        define('BASE_URL', '');
    }
}

if (!function_exists('uxp_root_relative_url')) {
    /**
     * Root-relative URL (leading /), including subdirectory when installed under htdocs/Folder.
     *
     * @param string $path Path segments after BASE_URL, e.g. "uploads/file.webp"
     */
    function uxp_root_relative_url(string $path): string
    {
        $path = trim(str_replace('\\', '/', $path));
        $path = preg_replace('#^(\.\./|\./)+#', '', $path);
        $path = ltrim($path, '/');
        $base = rtrim((string) (defined('BASE_URL') ? BASE_URL : ''), '/');
        $joined = ($base === '' ? '' : $base) . '/' . $path;
        if ($joined === '' || $joined[0] !== '/') {
            return '/' . ltrim($joined, '/');
        }

        return $joined;
    }
}

if (!function_exists('uxp_normalize_stored_media_url')) {
    /**
     * Normalize paths saved in the DB (e.g. "uploads/..") for use in <img src> from any page.
     */
    function uxp_normalize_stored_media_url(?string $url): string
    {
        $url = trim((string) $url);
        if ($url === '') {
            return '';
        }
        if (preg_match('#^https?://#i', $url)) {
            return $url;
        }
        $base = rtrim((string) (defined('BASE_URL') ? BASE_URL : ''), '/');

        $path = str_replace('\\', '/', $url);
        $path = preg_replace('#^(\.\./)+#', '', $path);

        if ($path !== '' && $path[0] === '/') {
            if ($base !== '' && strpos($path, $base . '/') !== 0) {
                if (
                    strpos($path, '/uploads/') === 0
                    || strpos($path, '/img/') === 0
                    || strpos($path, '/storage/') === 0
                ) {
                    return $base . $path;
                }
            }

            return $path;
        }

        return uxp_root_relative_url($path);
    }
}

if (!function_exists('uxp_normalize_if_upload_path')) {
    /**
     * Normalize values that are upload paths; leave other strings (e.g. icon keys) unchanged.
     */
    function uxp_normalize_if_upload_path(?string $url): string
    {
        $url = trim((string) $url);
        if ($url === '') {
            return '';
        }
        if (preg_match('#^https?://#i', $url)) {
            return $url;
        }
        if (strpos($url, 'uploads/') !== false || strpos($url, '/uploads/') !== false) {
            return uxp_normalize_stored_media_url($url);
        }

        return $url;
    }
}

if (!function_exists('uxp_unlink_upload_file_if_safe')) {
    /**
     * Delete a file under project /uploads only. Skips http(s) URLs and path traversal.
     */
    function uxp_unlink_upload_file_if_safe(?string $storedUrl): void
    {
        $storedUrl = trim((string) $storedUrl);
        if ($storedUrl === '' || preg_match('#^https?://#i', $storedUrl)) {
            return;
        }

        $path = str_replace('\\', '/', $storedUrl);
        $path = preg_replace('#^(\.\./)+#', '', $path);
        $base = rtrim((string) (defined('BASE_URL') ? BASE_URL : ''), '/');
        if ($base !== '' && strncmp($path, $base . '/', strlen($base) + 1) === 0) {
            $path = substr($path, strlen($base));
        }
        $path = ltrim($path, '/');
        if (strncmp($path, 'uploads/', strlen('uploads/')) !== 0) {
            return;
        }

        $rel = substr($path, strlen('uploads/'));
        if ($rel === '' || str_contains($rel, '..')) {
            return;
        }
        foreach (explode('/', $rel) as $seg) {
            if ($seg === '' || $seg === '.' || $seg === '..') {
                return;
            }
        }

        $uploadRoot = realpath(dirname(__DIR__) . '/uploads');
        if ($uploadRoot === false) {
            return;
        }

        $full = $uploadRoot . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $rel);
        $real = realpath($full);
        if ($real === false || !is_file($real)) {
            return;
        }
        if (strncmp($real, $uploadRoot, strlen($uploadRoot)) !== 0) {
            return;
        }

        @unlink($real);
    }
}
