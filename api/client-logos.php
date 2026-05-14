<?php
/**
 * Public read-only JSON: visible client logos (same data as admin Client logos & admin/api/projects GET bundle).
 * Safe for same-origin fetch from the marketing site; no admin session required.
 */
declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/cms_repository.php';

header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: public, max-age=120');

echo json_encode(get_visible_client_logos(), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
