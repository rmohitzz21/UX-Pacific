<?php
/**
 * Production Guard
 *
 * Include at the top of scripts that must NEVER run on production by accident
 * (setup_db.php, seed_db.php, test_*.php).
 *
 * Allowed when:
 * - Apache/nginx sets UXP_ALLOW_MAINTENANCE=true, OR
 * - The request is treated as local dev by the same rules as includes/database_config.php
 *   (localhost / 127.0.0.1 / ::1 / UXP_LOCAL_HOSTS / UXP_FORCE_LOCAL; blocked by UXP_FORCE_PRODUCTION).
 */
declare(strict_types=1);

require_once dirname(__DIR__, 2) . '/includes/database_config.php';
uxp_boot_database_config();

$allowMaintenance = getenv('UXP_ALLOW_MAINTENANCE');
if ($allowMaintenance === false) {
    $allowMaintenance = $_ENV['UXP_ALLOW_MAINTENANCE'] ?? $_SERVER['UXP_ALLOW_MAINTENANCE'] ?? '';
}

$allowed = ($allowMaintenance === 'true' || uxp_is_local_dev_request());

if (!$allowed) {
    header('Content-Type: application/json');
    http_response_code(403);
    echo json_encode([
        'error' => 'This endpoint is disabled in production.',
        'hint' => 'Local dev: use http://localhost/… or set UXP_LOCAL_HOSTS. Or set UXP_ALLOW_MAINTENANCE=true (server config only, never on public production).',
    ]);
    exit;
}
