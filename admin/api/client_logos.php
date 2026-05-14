<?php
/**
 * Admin API - Client Logos CRUD
 * 
 * Security: Admin authentication required, no database error disclosure
 */
declare(strict_types=1);

require_once __DIR__ . '/../includes/auth.php';
require_once dirname(__DIR__, 2) . '/includes/paths.php';

requireAdminAuth('api');

require_once __DIR__ . '/../includes/api_helpers.php';
require_once __DIR__ . '/db.php';

adminRequireValidCsrfForMutation();

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];

/**
 * @param array<string, mixed> $row
 * @return array<string, mixed>
 */
function uxp_client_logo_shape_row(array $row): array
{
    if (!empty($row['logo_url'])) {
        $row['logo_url'] = uxp_normalize_stored_media_url((string) $row['logo_url']);
    }

    return $row;
}

switch ($method) {
    case 'GET':
        try {
            $stmt = $pdo->query('SELECT * FROM client_logos ORDER BY sort_order ASC, id ASC');
            $rows = $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
            $rows = array_map(
                static fn (array $r): array => uxp_client_logo_shape_row($r),
                $rows
            );
            apiSuccess($rows);
        } catch (PDOException $e) {
            apiError('Failed to fetch client logos.', 500, $e);
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        if (!$data) {
            apiError('Invalid JSON data.', 400);
        }
        
        $name = trim((string)($data['name'] ?? ''));
        $logoUrl = trim((string)($data['logo_url'] ?? ''));
        
        if ($name === '' || $logoUrl === '') {
            apiError('Client name and logo image are required.', 400);
        }
        
        $website = trim((string)($data['website_url'] ?? ''));
        $website = $website === '' ? null : $website;
        
        $sql = 'INSERT INTO client_logos (name, logo_url, website_url, sort_order, is_visible) VALUES (?, ?, ?, ?, ?)';
        $params = [
            $name,
            $logoUrl,
            $website,
            (int)($data['sort_order'] ?? 0),
            (int)($data['is_visible'] ?? 1),
        ];
        
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
            $id = (int)$pdo->lastInsertId();
            
            $stmt = $pdo->prepare('SELECT * FROM client_logos WHERE id = ?');
            $stmt->execute([$id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$row) {
                apiError('Client logo not found after create.', 500);
            }

            apiSuccess(['success' => true, 'client_logo' => uxp_client_logo_shape_row($row)], 201);
        } catch (PDOException $e) {
            apiError('Failed to create client logo.', 500, $e);
        }
        break;

    case 'PUT':
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $data['id'] ?? null;
        if (!$id) {
            apiError('Client logo ID is required.', 400);
        }
        
        $fields = ['name', 'logo_url', 'website_url', 'sort_order', 'is_visible'];
        $updates = [];
        $params = [];
        
        foreach ($fields as $field) {
            if (array_key_exists($field, $data)) {
                $updates[] = "$field = ?";
                if ($field === 'website_url') {
                    $v = trim((string)$data[$field]);
                    $params[] = $v === '' ? null : $v;
                } elseif ($field === 'sort_order' || $field === 'is_visible') {
                    $params[] = (int)$data[$field];
                } else {
                    $params[] = $data[$field];
                }
            }
        }
        
        if ($updates === []) {
            apiError('No fields to update.', 400);
        }
        
        $params[] = (int)$id;
        $sql = 'UPDATE client_logos SET ' . implode(', ', $updates) . ' WHERE id = ?';
        
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
            
            $stmt = $pdo->prepare('SELECT * FROM client_logos WHERE id = ?');
            $stmt->execute([(int)$id]);
            $updated = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if (!$updated) {
                apiError('Client logo not found.', 404);
            }

            apiSuccess(['success' => true, 'client_logo' => uxp_client_logo_shape_row($updated)]);
        } catch (PDOException $e) {
            apiError('Failed to update client logo.', 500, $e);
        }
        break;

    case 'DELETE':
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $data['id'] ?? $_GET['id'] ?? null;
        if (!$id) {
            apiError('Client logo ID is required.', 400);
        }
        
        try {
            $stmt = $pdo->prepare('DELETE FROM client_logos WHERE id = ?');
            $stmt->execute([(int)$id]);
            apiSuccess(['success' => true]);
        } catch (PDOException $e) {
            apiError('Failed to delete client logo.', 500, $e);
        }
        break;

    default:
        apiError('Method not allowed.', 405);
        break;
}
