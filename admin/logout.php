<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/auth.php';

if (!adminIsAuthenticated()) {
    header('Location: ' . adminUrl('index.php'));
    exit;
}

if (strtoupper((string) ($_SERVER['REQUEST_METHOD'] ?? 'GET')) !== 'POST') {
    http_response_code(405);
    header('Allow: POST');
    header('Content-Type: text/plain; charset=UTF-8');
    echo 'Sign out must use POST. Use the Sign out button in the admin sidebar.';
    exit;
}

if (!adminValidateCsrf($_POST['csrf_token'] ?? null)) {
    http_response_code(403);
    header('Content-Type: text/plain; charset=UTF-8');
    echo 'Security token mismatch. Refresh the page and try again.';
    exit;
}

adminLogout();

header('Cache-Control: no-store, no-cache, must-revalidate');
header('Pragma: no-cache');
header('Location: ' . adminUrl('index.php'));
exit;
