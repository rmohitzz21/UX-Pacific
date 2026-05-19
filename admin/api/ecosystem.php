<?php
/**
 * Admin API - Ecosystem Partners CRUD
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
function uxp_ecosystem_shape_row(array $row): array
{
    if (!empty($row['logo_url'])) {
        $row['logo_url'] = uxp_normalize_stored_media_url((string) $row['logo_url']);
    }

    return $row;
}

/**
 * @return array<string, mixed>
 */
function uxp_ecosystem_payload(array $data): array
{
    return [
        'partner_name' => apiRequiredString($data, 'partner_name', 'Partner name', 150),
        'details' => apiOptionalString($data, 'details', 5000),
        'website_url' => apiOptionalHttpUrl(apiOptionalString($data, 'website_url', 500), 'Website URL'),
        'logo_url' => apiStoredMediaUrl(apiOptionalString($data, 'logo_url', 500), 'Logo image'),
        'is_visible' => apiBooleanInt($data['is_visible'] ?? 1, 1),
        'sort_order' => apiIntInRange($data['sort_order'] ?? 0, 0, 0, 100000),
    ];
}

switch ($method) {
    case 'GET':
        try {
            $stmt = $pdo->query("SELECT * FROM ecosystem ORDER BY sort_order ASC, created_at DESC");
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $ecosystem = array_map(
                static fn (array $r): array => uxp_ecosystem_shape_row($r),
                $rows
            );
            apiSuccess($ecosystem);
        } catch (PDOException $e) {
            apiError('Failed to fetch ecosystem partners.', 500, $e);
        }
        break;

    case 'POST':
        $data = apiJsonBody();
        $payload = uxp_ecosystem_payload($data);

        $sql = "INSERT INTO ecosystem (partner_name, details, website_url, logo_url, is_visible, sort_order) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $params = [
            $payload['partner_name'],
            $payload['details'],
            $payload['website_url'],
            $payload['logo_url'],
            $payload['is_visible'],
            $payload['sort_order'],
        ];
        
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
            $id = $pdo->lastInsertId();
            
            $stmt = $pdo->prepare("SELECT * FROM ecosystem WHERE id = ?");
            $stmt->execute([$id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$row) {
                apiError('Ecosystem partner not found after create.', 500);
            }
            
            apiSuccess(['success' => true, 'ecosystem' => uxp_ecosystem_shape_row($row)], 201);
        } catch (PDOException $e) {
            apiError('Failed to create ecosystem partner.', 500, $e);
        }
        break;

    case 'PUT':
        $data = apiJsonBody();
        $id = $data['id'] ?? null;
        if (!$id) {
            apiError('Ecosystem partner ID is required.', 400);
        }

        $fields = ['partner_name', 'details', 'website_url', 'logo_url', 'is_visible', 'sort_order'];
        $updates = [];
        $params = [];
        
        foreach ($fields as $field) {
            if (array_key_exists($field, $data)) {
                $updates[] = "$field = ?";
                if ($field === 'partner_name') {
                    $params[] = apiRequiredString($data, $field, 'Partner name', 150);
                } elseif ($field === 'details') {
                    $params[] = apiOptionalString($data, $field, 5000);
                } elseif ($field === 'website_url') {
                    $params[] = apiOptionalHttpUrl(apiOptionalString($data, $field, 500), 'Website URL');
                } elseif ($field === 'logo_url') {
                    $params[] = apiStoredMediaUrl(apiOptionalString($data, $field, 500), 'Logo image');
                } elseif ($field === 'is_visible') {
                    $params[] = apiBooleanInt($data[$field], 1);
                } else {
                    $params[] = apiIntInRange($data[$field], 0, 0, 100000);
                }
            }
        }
        
        if (empty($updates)) {
            apiError('No fields to update.', 400);
        }
        
        $params[] = (int)$id;
        $sql = "UPDATE ecosystem SET " . implode(', ', $updates) . " WHERE id = ?";
        
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
            
            $stmt = $pdo->prepare("SELECT * FROM ecosystem WHERE id = ?");
            $stmt->execute([(int)$id]);
            $updated = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if (!$updated) {
                apiError('Ecosystem partner not found.', 404);
            }

            apiSuccess(['success' => true, 'ecosystem' => uxp_ecosystem_shape_row($updated)]);
        } catch (PDOException $e) {
            apiError('Failed to update ecosystem partner.', 500, $e);
        }
        break;

    case 'DELETE':
        $data = json_decode(file_get_contents('php://input'), true);
        $data = is_array($data) ? $data : [];
        $id = $data['id'] ?? $_GET['id'] ?? null;
        if (!$id) {
            apiError('Ecosystem partner ID is required.', 400);
        }
        
        try {
            $stmt = $pdo->prepare("DELETE FROM ecosystem WHERE id = ?");
            $stmt->execute([(int)$id]);
            apiSuccess(['success' => true]);
        } catch (PDOException $e) {
            apiError('Failed to delete ecosystem partner.', 500, $e);
        }
        break;

    default:
        apiError('Method not allowed.', 405);
        break;
}
