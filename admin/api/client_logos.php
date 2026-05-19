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

/**
 * @return array<string, mixed>
 */
function uxp_client_logo_payload(array $data): array
{
    return [
        'name' => apiRequiredString($data, 'name', 'Client name', 100),
        'logo_url' => apiStoredMediaUrl(apiRequiredString($data, 'logo_url', 'Logo image', 500), 'Logo image'),
        'website_url' => apiOptionalHttpUrl(apiOptionalString($data, 'website_url', 500), 'Website URL'),
        'sort_order' => apiIntInRange($data['sort_order'] ?? 0, 0, 0, 100000),
        'is_visible' => apiBooleanInt($data['is_visible'] ?? 1, 1),
    ];
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
        $data = apiJsonBody();
        $payload = uxp_client_logo_payload($data);
        
        $sql = 'INSERT INTO client_logos (name, logo_url, website_url, sort_order, is_visible) VALUES (?, ?, ?, ?, ?)';
        $params = [
            $payload['name'],
            $payload['logo_url'],
            $payload['website_url'],
            $payload['sort_order'],
            $payload['is_visible'],
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
        $data = apiJsonBody();
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
                if ($field === 'name') {
                    $params[] = apiRequiredString($data, $field, 'Client name', 100);
                } elseif ($field === 'logo_url') {
                    $params[] = apiStoredMediaUrl(apiRequiredString($data, $field, 'Logo image', 500), 'Logo image');
                } elseif ($field === 'website_url') {
                    $params[] = apiOptionalHttpUrl(apiOptionalString($data, $field, 500), 'Website URL');
                } elseif ($field === 'sort_order') {
                    $params[] = apiIntInRange($data[$field], 0, 0, 100000);
                } elseif ($field === 'is_visible') {
                    $params[] = apiBooleanInt($data[$field], 1);
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
        $data = is_array($data) ? $data : [];
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
