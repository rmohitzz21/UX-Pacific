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
        $data = json_decode(file_get_contents('php://input'), true);
        if (!$data) {
            apiError('Invalid JSON data.', 400);
        }

        $sql = "INSERT INTO ecosystem (partner_name, details, website_url, logo_url, is_visible, sort_order) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $params = [
            trim($data['partner_name'] ?? ''),
            $data['details'] ?? null,
            $data['website_url'] ?? null,
            $data['logo_url'] ?? null,
            (int)($data['is_visible'] ?? 1),
            (int)($data['sort_order'] ?? 0)
        ];
        
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
            $id = $pdo->lastInsertId();
            
            $stmt = $pdo->prepare("SELECT * FROM ecosystem WHERE id = ?");
            $stmt->execute([$id]);
            
            apiSuccess(['success' => true, 'ecosystem' => $stmt->fetch(PDO::FETCH_ASSOC)], 201);
        } catch (PDOException $e) {
            apiError('Failed to create ecosystem partner.', 500, $e);
        }
        break;

    case 'PUT':
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $data['id'] ?? null;
        if (!$id) {
            apiError('Ecosystem partner ID is required.', 400);
        }

        $fields = ['partner_name', 'details', 'website_url', 'logo_url', 'is_visible', 'sort_order'];
        $updates = [];
        $params = [];
        
        foreach ($fields as $field) {
            if (isset($data[$field])) {
                $updates[] = "$field = ?";
                $params[] = $data[$field];
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
