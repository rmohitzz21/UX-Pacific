<?php

declare(strict_types=1);

/**
 * Public read-only JSON: all location landing pages for the footer site index.
 */
require_once dirname(__DIR__) . '/includes/location_pages.php';

header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: public, max-age=3600');

$jsonFile = dirname(__DIR__) . '/data/location-pages.json';

if (!is_file($jsonFile)) {
    try {
        uxp_write_location_pages_index(dirname(__DIR__));
    } catch (Throwable $e) {
        http_response_code(503);
        echo json_encode(['error' => 'Location index unavailable.'], JSON_UNESCAPED_UNICODE);
        exit;
    }
}

$raw = file_get_contents($jsonFile);
$pages = json_decode((string) $raw, true);
if (!is_array($pages)) {
    http_response_code(503);
    echo json_encode(['error' => 'Location index is invalid.'], JSON_UNESCAPED_UNICODE);
    exit;
}

$query = trim((string) ($_GET['q'] ?? ''));
if ($query !== '') {
    $needle = mb_strtolower($query, 'UTF-8');
    $pages = array_values(array_filter(
        $pages,
        static function (array $page) use ($needle): bool {
            $label = mb_strtolower((string) ($page['label'] ?? ''), 'UTF-8');
            $slug = mb_strtolower((string) ($page['slug'] ?? ''), 'UTF-8');
            return str_contains($label, $needle) || str_contains($slug, $needle);
        }
    ));
}

echo json_encode($pages, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
