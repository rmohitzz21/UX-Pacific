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

/**
 * @return array<string, mixed>
 */
function uxp_testimonial_payload(array $data): array
{
    return [
        'client_name' => apiRequiredString($data, 'client_name', 'Client name', 150),
        'client_company' => apiOptionalString($data, 'client_company', 150),
        'client_role' => apiOptionalString($data, 'client_role', 150),
        'badge_label' => apiOptionalString($data, 'badge_label', 120),
        'photo_url' => apiStoredMediaUrl(apiOptionalString($data, 'photo_url', 500), 'Photo'),
        'quote' => apiRequiredString($data, 'quote', 'Quote', 5000),
        'rating' => apiIntInRange($data['rating'] ?? 5, 5, 1, 5),
        'is_visible' => apiBooleanInt($data['is_visible'] ?? 1, 1),
        'sort_order' => apiIntInRange($data['sort_order'] ?? 0, 0, 0, 100000),
    ];
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
        $data = apiJsonBody();
        $payload = uxp_testimonial_payload($data);

        $sql = "INSERT INTO testimonials (client_name, client_company, client_role, badge_label, photo_url, quote, rating, is_visible, sort_order) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $params = [
            $payload['client_name'],
            $payload['client_company'],
            $payload['client_role'],
            $payload['badge_label'],
            $payload['photo_url'],
            $payload['quote'],
            $payload['rating'],
            $payload['is_visible'],
            $payload['sort_order'],
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
        $data = apiJsonBody();
        $id = $data['id'] ?? null;
        if (!$id) {
            apiError('Testimonial ID is required.', 400);
        }

        $fields = ['client_name', 'client_company', 'client_role', 'badge_label', 'photo_url', 'quote', 'rating', 'is_visible', 'sort_order'];
        $updates = [];
        $params = [];
        
        foreach ($fields as $field) {
            if (array_key_exists($field, $data)) {
                $updates[] = "$field = ?";
                if ($field === 'client_name') {
                    $params[] = apiRequiredString($data, $field, 'Client name', 150);
                } elseif ($field === 'quote') {
                    $params[] = apiRequiredString($data, $field, 'Quote', 5000);
                } elseif ($field === 'photo_url') {
                    $params[] = apiStoredMediaUrl(apiOptionalString($data, $field, 500), 'Photo');
                } elseif ($field === 'rating') {
                    $params[] = apiIntInRange($data[$field], 5, 1, 5);
                } elseif ($field === 'is_visible') {
                    $params[] = apiBooleanInt($data[$field], 1);
                } elseif ($field === 'sort_order') {
                    $params[] = apiIntInRange($data[$field], 0, 0, 100000);
                } elseif ($field === 'badge_label') {
                    $params[] = apiOptionalString($data, $field, 120);
                } else {
                    $params[] = apiOptionalString($data, $field, 150);
                }
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
        $data = is_array($data) ? $data : [];
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
