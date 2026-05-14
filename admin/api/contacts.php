<?php
/**
 * Admin API - Contacts CRUD
 * 
 * Security: Admin authentication required, no database error disclosure
 */
declare(strict_types=1);

require_once __DIR__ . '/../includes/auth.php';
requireAdminAuth('api');

require_once __DIR__ . '/../includes/api_helpers.php';
require_once __DIR__ . '/db.php';

adminRequireValidCsrfForMutation();

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];

function contactsHasColumn(PDO $pdo, string $column): bool {
    static $cache = [];
    if (array_key_exists($column, $cache)) {
        return $cache[$column];
    }
    try {
        $stmt = $pdo->prepare("SHOW COLUMNS FROM contacts LIKE ?");
        $stmt->execute([$column]);
        $cache[$column] = (bool) $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (Throwable) {
        $cache[$column] = false;
    }
    return $cache[$column];
}

/** Allowed ORDER BY columns only (never user-controlled). */
function contactsOrderColumn(PDO $pdo): string
{
    $allowed = ['submitted_at', 'created_at', 'id'];
    foreach ($allowed as $col) {
        if (contactsHasColumn($pdo, $col)) {
            return $col;
        }
    }

    return 'id';
}

switch ($method) {
    case 'GET':
        try {
            $orderCol = contactsOrderColumn($pdo);
            $stmt = $pdo->query('SELECT * FROM contacts ORDER BY `' . str_replace('`', '', $orderCol) . '` DESC');
            $contacts = $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
            apiSuccess($contacts);
        } catch (PDOException $e) {
            apiError('Failed to fetch contacts.', 500, $e);
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        if (!$data && !empty($_POST)) {
            $data = $_POST;
        }
        
        if (!$data) {
            apiError('Invalid data provided.', 400);
        }

        $columns = ['name', 'email', 'phone'];
        $params = [
            trim($data['name'] ?? ''),
            trim($data['email'] ?? ''),
            $data['phone'] ?? null
        ];

        $interest = $data['service_interest'] ?? ($data['industry'] ?? null);
        if (contactsHasColumn($pdo, 'industry')) {
            $columns[] = 'industry';
            $params[] = $interest;
        }
        if (contactsHasColumn($pdo, 'service_interest')) {
            $columns[] = 'service_interest';
            $params[] = $interest;
        }

        $columns = array_merge($columns, ['message', 'ip_address', 'user_agent']);
        $params = array_merge($params, [
            $data['message'] ?? '',
            $_SERVER['REMOTE_ADDR'] ?? null,
            substr($_SERVER['HTTP_USER_AGENT'] ?? '', 0, 500)
        ]);

        $placeholders = implode(', ', array_fill(0, count($columns), '?'));
        $sql = "INSERT INTO contacts (" . implode(', ', $columns) . ") VALUES ($placeholders)";
        
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
            $id = $pdo->lastInsertId();
            
            $stmt = $pdo->prepare("SELECT * FROM contacts WHERE id = ?");
            $stmt->execute([$id]);
            
            apiSuccess(['success' => true, 'contact' => $stmt->fetch(PDO::FETCH_ASSOC)], 201);
        } catch (PDOException $e) {
            apiError('Failed to save contact.', 500, $e);
        }
        break;

    case 'PUT':
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $data['id'] ?? null;
        if (!$id) {
            apiError('Contact ID is required.', 400);
        }

        $fields = ['status', 'admin_note'];
        $updates = [];
        $params = [];
        
        foreach ($fields as $field) {
            if (isset($data[$field])) {
                $updates[] = "$field = ?";
                $params[] = $data[$field];
            }
        }
        
        if (isset($data['status']) && $data['status'] === 'replied') {
            $updates[] = "replied_at = CURRENT_TIMESTAMP";
        }
        
        if (empty($updates)) {
            apiError('No fields to update.', 400);
        }
        
        $params[] = (int)$id;
        $sql = "UPDATE contacts SET " . implode(', ', $updates) . " WHERE id = ?";
        
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
            
            $stmt = $pdo->prepare("SELECT * FROM contacts WHERE id = ?");
            $stmt->execute([(int)$id]);
            $updatedContact = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if (!$updatedContact) {
                apiError('Contact not found.', 404);
            }
            
            apiSuccess(['success' => true, 'contact' => $updatedContact]);
        } catch (PDOException $e) {
            apiError('Failed to update contact.', 500, $e);
        }
        break;

    case 'DELETE':
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $data['id'] ?? $_GET['id'] ?? null;
        if (!$id) {
            apiError('Contact ID is required.', 400);
        }
        
        try {
            $stmt = $pdo->prepare("DELETE FROM contacts WHERE id = ?");
            $stmt->execute([(int)$id]);
            apiSuccess(['success' => true]);
        } catch (PDOException $e) {
            apiError('Failed to delete contact.', 500, $e);
        }
        break;

    default:
        apiError('Method not allowed.', 405);
        break;
}
