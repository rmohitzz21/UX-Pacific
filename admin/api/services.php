<?php
/**
 * Admin API - Services CRUD
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

function decodeServiceJson(array &$service): void {
    $jsonFields = ['deliverables', 'what_it_solves', 'how_we_work', 'what_changes'];
    foreach ($jsonFields as $field) {
        if (!empty($service[$field]) && is_string($service[$field])) {
            $decoded = json_decode($service[$field], true);
            $service[$field] = is_array($decoded) ? $decoded : [];
        }
    }
}

function shapeServiceIcon(array &$service): void {
    if (!empty($service['icon_name']) && is_string($service['icon_name'])) {
        $service['icon_name'] = uxp_normalize_if_upload_path($service['icon_name']);
    }
}

switch ($method) {
    case 'GET':
        try {
            if (isset($_GET['id'])) {
                $stmt = $pdo->prepare("SELECT * FROM services WHERE id = ?");
                $stmt->execute([(int)$_GET['id']]);
                $service = $stmt->fetch();
                if ($service) {
                    decodeServiceJson($service);
                    shapeServiceIcon($service);
                }
                apiSuccess($service ?: []);
            } else {
                $stmt = $pdo->query("SELECT * FROM services ORDER BY sort_order ASC, created_at DESC");
                $services = $stmt->fetchAll();
                foreach ($services as &$service) {
                    decodeServiceJson($service);
                    shapeServiceIcon($service);
                }
                apiSuccess($services);
            }
        } catch (PDOException $e) {
            apiError('Failed to fetch services.', 500, $e);
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        if (!$data) {
            apiError('Invalid JSON data.', 400);
        }

        $sql = "INSERT INTO services (title, slug, short_desc, what_it_solves, how_we_work, what_changes, deliverables, icon_name, status, sort_order) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $params = [
            trim($data['title'] ?? ''),
            trim($data['slug'] ?? ''),
            trim($data['short_desc'] ?? ''),
            isset($data['what_it_solves']) && is_array($data['what_it_solves']) ? json_encode($data['what_it_solves']) : null,
            isset($data['how_we_work']) && is_array($data['how_we_work']) ? json_encode($data['how_we_work']) : null,
            isset($data['what_changes']) && is_array($data['what_changes']) ? json_encode($data['what_changes']) : null,
            isset($data['deliverables']) && is_array($data['deliverables']) ? json_encode($data['deliverables']) : null,
            $data['icon_name'] ?? null,
            $data['status'] ?? 'draft',
            (int)($data['sort_order'] ?? 0)
        ];
        
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
            $id = $pdo->lastInsertId();
            
            $stmt = $pdo->prepare("SELECT * FROM services WHERE id = ?");
            $stmt->execute([$id]);
            $newService = $stmt->fetch();
            if (!$newService) {
                apiError('Service not found after create.', 500);
            }
            decodeServiceJson($newService);
            shapeServiceIcon($newService);

            apiSuccess(['success' => true, 'service' => $newService], 201);
        } catch (PDOException $e) {
            apiError('Failed to create service.', 500, $e);
        }
        break;

    case 'PUT':
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $data['id'] ?? null;
        if (!$id) {
            apiError('Service ID is required.', 400);
        }

        $fields = ['title', 'slug', 'short_desc', 'icon_name', 'status', 'sort_order'];
        $updates = [];
        $params = [];
        
        foreach ($fields as $field) {
            if (isset($data[$field])) {
                $updates[] = "$field = ?";
                $params[] = $data[$field];
            }
        }
        
        $arrayFields = ['what_it_solves', 'how_we_work', 'what_changes', 'deliverables'];
        foreach ($arrayFields as $field) {
            if (isset($data[$field])) {
                $updates[] = "$field = ?";
                $params[] = is_array($data[$field]) ? json_encode($data[$field]) : null;
            }
        }
        
        if (empty($updates)) {
            apiError('No fields to update.', 400);
        }
        
        $params[] = (int)$id;
        $sql = "UPDATE services SET " . implode(', ', $updates) . " WHERE id = ?";
        
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
            
            $stmt = $pdo->prepare("SELECT * FROM services WHERE id = ?");
            $stmt->execute([(int)$id]);
            $updatedService = $stmt->fetch();
            
            if (!$updatedService) {
                apiError('Service not found.', 404);
            }
            
            decodeServiceJson($updatedService);
            shapeServiceIcon($updatedService);
            apiSuccess(['success' => true, 'service' => $updatedService]);
        } catch (PDOException $e) {
            apiError('Failed to update service.', 500, $e);
        }
        break;

    case 'DELETE':
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $data['id'] ?? $_GET['id'] ?? null;
        if (!$id) {
            apiError('Service ID is required.', 400);
        }
        
        try {
            $stmt = $pdo->prepare("DELETE FROM services WHERE id = ?");
            $stmt->execute([(int)$id]);
            apiSuccess(['success' => true]);
        } catch (PDOException $e) {
            apiError('Failed to delete service.', 500, $e);
        }
        break;

    default:
        apiError('Method not allowed.', 405);
        break;
}
