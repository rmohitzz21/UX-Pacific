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
        $data = json_decode(file_get_contents('php://input'), true);
        if (!$data || empty(trim($data['question'] ?? '')) || empty(trim($data['answer'] ?? ''))) {
            apiError('Question and answer are required.', 400);
        }

        $sql = "INSERT INTO faqs (question, answer, category, is_visible, sort_order) VALUES (?, ?, ?, ?, ?)";
        $params = [
            trim($data['question']),
            trim($data['answer']),
            $data['category'] ?? 'General',
            (int)($data['is_visible'] ?? 1),
            (int)($data['sort_order'] ?? 0)
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
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $data['id'] ?? null;
        if (!$id) {
            apiError('FAQ ID is required.', 400);
        }

        $fields = ['question', 'answer', 'category', 'is_visible', 'sort_order'];
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
