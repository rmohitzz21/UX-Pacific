<?php
declare(strict_types=1);

require_once __DIR__ . '/../includes/auth.php';

header('Content-Type: application/json; charset=UTF-8');

$method = strtoupper((string) ($_SERVER['REQUEST_METHOD'] ?? 'GET'));
$action = isset($_GET['action']) ? (string) $_GET['action'] : '';

// Logout: use admin/logout.php (form POST). This endpoint is legacy JSON only.
if ($action === 'logout') {
    if ($method !== 'POST') {
        http_response_code(405);
        header('Allow: POST');
        echo json_encode(['error' => 'Use POST to admin/logout.php to sign out.']);
        exit;
    }

    requireAdminAuth('api');
    adminRequireValidCsrfForMutation();
    adminLogout();
    echo json_encode(['success' => true, 'message' => 'Logged out.']);
    exit;
}

if (!adminIsAuthenticated()) {
    http_response_code(401);
    echo json_encode(['authenticated' => false]);
    exit;
}

echo json_encode([
    'authenticated' => true,
    'user' => $_SESSION['admin_user'],
]);
