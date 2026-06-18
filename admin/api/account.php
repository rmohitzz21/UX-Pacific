<?php
declare(strict_types=1);

require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/api_helpers.php';

header('Content-Type: application/json; charset=UTF-8');

$method = strtoupper((string) ($_SERVER['REQUEST_METHOD'] ?? 'GET'));

if ($method !== 'POST') {
    http_response_code(405);
    header('Allow: POST');
    echo json_encode(['error' => 'Method not allowed.']);
    exit;
}

requireAdminAuth('api');
adminRequireValidCsrfForMutation();

$body = json_decode((string) file_get_contents('php://input'), true);
if (!is_array($body)) {
    $body = $_POST;
}

$action = (string) ($body['action'] ?? '');

if ($action !== 'change_password') {
    apiError('Invalid action.', 400);
}

$userId = (int) ($_SESSION['admin_user']['id'] ?? 0);
$result = adminChangePassword(
    $userId,
    (string) ($body['current_password'] ?? ''),
    (string) ($body['new_password'] ?? ''),
    (string) ($body['confirm_password'] ?? '')
);

if (!($result['success'] ?? false)) {
    apiError($result['error'] ?? 'Password change failed.', 400);
}

apiSuccess(['success' => true, 'message' => 'Password updated successfully.']);
