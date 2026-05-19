<?php
/**
 * Admin API - FAQs CRUD
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

/**
 * @return array<string, mixed>
 */
function uxp_faq_payload(array $data): array
{
    return [
        'question' => apiRequiredString($data, 'question', 'Question', 500),
        'answer' => apiRequiredString($data, 'answer', 'Answer', 5000),
        'category' => apiOptionalString($data, 'category', 100) ?? 'General',
        'is_visible' => apiBooleanInt($data['is_visible'] ?? 1, 1),
        'sort_order' => apiIntInRange($data['sort_order'] ?? 0, 0, 0, 100000),
    ];
}

switch ($method) {
    case 'GET':
        try {
            $stmt = $pdo->query("SELECT * FROM faqs ORDER BY sort_order ASC, created_at DESC");
            $faqs = $stmt->fetchAll(PDO::FETCH_ASSOC);
            apiSuccess($faqs);
        } catch (PDOException $e) {
            apiError('Failed to fetch FAQs.', 500, $e);
        }
        break;

    case 'POST':
        $data = apiJsonBody();
        $payload = uxp_faq_payload($data);

        $sql = "INSERT INTO faqs (question, answer, category, is_visible, sort_order) VALUES (?, ?, ?, ?, ?)";
        $params = [
            $payload['question'],
            $payload['answer'],
            $payload['category'],
            $payload['is_visible'],
            $payload['sort_order'],
        ];
        
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
            $id = $pdo->lastInsertId();
            
            $stmt = $pdo->prepare("SELECT * FROM faqs WHERE id = ?");
            $stmt->execute([$id]);
            
            apiSuccess(['success' => true, 'faq' => $stmt->fetch(PDO::FETCH_ASSOC)], 201);
        } catch (PDOException $e) {
            apiError('Failed to create FAQ.', 500, $e);
        }
        break;

    case 'PUT':
        $data = apiJsonBody();
        $id = $data['id'] ?? null;
        if (!$id) {
            apiError('FAQ ID is required.', 400);
        }

        $fields = ['question', 'answer', 'category', 'is_visible', 'sort_order'];
        $updates = [];
        $params = [];
        
        foreach ($fields as $field) {
            if (array_key_exists($field, $data)) {
                $updates[] = "$field = ?";
                if ($field === 'question') {
                    $params[] = apiRequiredString($data, $field, 'Question', 500);
                } elseif ($field === 'answer') {
                    $params[] = apiRequiredString($data, $field, 'Answer', 5000);
                } elseif ($field === 'category') {
                    $params[] = apiOptionalString($data, $field, 100) ?? 'General';
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
        $sql = "UPDATE faqs SET " . implode(', ', $updates) . " WHERE id = ?";
        
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
            
            $stmt = $pdo->prepare("SELECT * FROM faqs WHERE id = ?");
            $stmt->execute([(int)$id]);
            $updatedFaq = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if (!$updatedFaq) {
                apiError('FAQ not found.', 404);
            }
            
            apiSuccess(['success' => true, 'faq' => $updatedFaq]);
        } catch (PDOException $e) {
            apiError('Failed to update FAQ.', 500, $e);
        }
        break;

    case 'DELETE':
        $data = json_decode(file_get_contents('php://input'), true);
        $data = is_array($data) ? $data : [];
        $id = $data['id'] ?? $_GET['id'] ?? null;
        if (!$id) {
            apiError('FAQ ID is required.', 400);
        }
        
        try {
            $stmt = $pdo->prepare("DELETE FROM faqs WHERE id = ?");
            $stmt->execute([(int)$id]);
            apiSuccess(['success' => true]);
        } catch (PDOException $e) {
            apiError('Failed to delete FAQ.', 500, $e);
        }
        break;

    default:
        apiError('Method not allowed.', 405);
        break;
}
