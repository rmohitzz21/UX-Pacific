<?php
/**
 * Public read-only JSON: visible testimonials / reviews for the marketing site.
 * Same source as Admin → Reviews; no session required.
 */
declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/cms_repository.php';

header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: public, max-age=120');

echo json_encode(get_visible_testimonials_for_api(), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
