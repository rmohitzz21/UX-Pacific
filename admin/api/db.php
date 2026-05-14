<?php
/**
 * Admin API Database Bootstrap
 *
 * Same connection as the public site: includes/database.php → uxp_db().
 */
declare(strict_types=1);

require_once dirname(__DIR__, 2) . '/includes/database.php';

$pdo = uxp_db();

if (!$pdo instanceof PDO) {
    error_log('DB connection failed (admin API).');
    header('Content-Type: application/json');
    http_response_code(500);
    echo json_encode(['error' => 'Database connection failed. Check DB_* in .env (see .env.example).']);
    exit;
}
