<?php
/**
 * Admin API - Testimonials CRUD
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
function uxp_shape_testimonial_row(array $row): array
{
    if (!empty($row['photo_url'])) {
        $row['photo_url'] = uxp_normalize_stored_media_url((string) $row['photo_url']);
    }

    return $row;
}

switch ($method) {
    case 'GET':
        try {
            $stmt = $pdo->query("SELECT * FROM testimonials ORDER BY sort_order ASC, created_at DESC");
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $testimonials = array_map(
                static fn (array $row): array => uxp_shape_testimonial_row($row),
                $rows
            );
            apiSuccess($testimonials);
        } catch (PDOException $e) {
            apiError('Failed to fetch testimonials.', 500, $e);
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        if (!$data) {
            apiError('Invalid JSON data.', 400);
        }

        $sql = "INSERT INTO testimonials (client_name, client_company, client_role, badge_label, photo_url, quote, rating, is_visible, sort_order) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $params = [
            trim($data['client_name'] ?? ''),
            $data['client_company'] ?? null,
            $data['client_role'] ?? null,
            $data['badge_label'] ?? null,
            $data['photo_url'] ?? null,
            trim($data['quote'] ?? ''),
            (int)($data['rating'] ?? 5),
            (int)($data['is_visible'] ?? 1),
            (int)($data['sort_order'] ?? 0)
        ];
        
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
            $id = $pdo->lastInsertId();
            
            $stmt = $pdo->prepare("SELECT * FROM testimonials WHERE id = ?");
            $stmt->execute([$id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$row) {
                apiError('Testimonial not found after create.', 500);
            }

            apiSuccess(['success' => true, 'testimonial' => uxp_shape_testimonial_row($row)], 201);
        } catch (PDOException $e) {
            apiError('Failed to create testimonial.', 500, $e);
        }
        break;

    case 'PUT':
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $data['id'] ?? null;
        if (!$id) {
            apiError('Testimonial ID is required.', 400);
        }

        $fields = ['client_name', 'client_company', 'client_role', 'badge_label', 'photo_url', 'quote', 'rating', 'is_visible', 'sort_order'];
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
        $sql = "UPDATE testimonials SET " . implode(', ', $updates) . " WHERE id = ?";
        
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
            
            $stmt = $pdo->prepare("SELECT * FROM testimonials WHERE id = ?");
            $stmt->execute([(int)$id]);
            $updated = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if (!$updated) {
                apiError('Testimonial not found.', 404);
            }

            apiSuccess(['success' => true, 'testimonial' => uxp_shape_testimonial_row($updated)]);
        } catch (PDOException $e) {
            apiError('Failed to update testimonial.', 500, $e);
        }
        break;

    case 'DELETE':
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $data['id'] ?? $_GET['id'] ?? null;
        if (!$id) {
            apiError('Testimonial ID is required.', 400);
        }
        
        try {
            $stmt = $pdo->prepare("DELETE FROM testimonials WHERE id = ?");
            $stmt->execute([(int)$id]);
            apiSuccess(['success' => true]);
        } catch (PDOException $e) {
            apiError('Failed to delete testimonial.', 500, $e);
        }
        break;

    default:
        apiError('Method not allowed.', 405);
        break;
}
