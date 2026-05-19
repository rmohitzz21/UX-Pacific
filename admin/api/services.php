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

/**
 * @return array{title:string,slug:string,short_desc:string,what_it_solves:list<string>,how_we_work:list<string>,what_changes:list<string>,deliverables:list<string>,icon_name:?string,status:string,sort_order:int}
 */
function servicePayload(array $data): array
{
    $title = apiRequiredString($data, 'title', 'Title', 255);
    $shortDesc = apiRequiredString($data, 'short_desc', 'Short description', 500);
    $icon = apiOptionalString($data, 'icon_name', 500);
    if ($icon !== null && (str_contains($icon, '/') || preg_match('#^https?://#i', $icon))) {
        $icon = apiStoredMediaUrl($icon, 'Service icon');
    }

    return [
        'title' => $title,
        'slug' => apiSlug(apiTrimString($data['slug'] ?? '', 255), $title),
        'short_desc' => $shortDesc,
        'what_it_solves' => apiStringList($data['what_it_solves'] ?? []),
        'how_we_work' => apiStringList($data['how_we_work'] ?? []),
        'what_changes' => apiStringList($data['what_changes'] ?? []),
        'deliverables' => apiStringList($data['deliverables'] ?? []),
        'icon_name' => $icon,
        'status' => apiEnum($data['status'] ?? 'draft', ['published', 'draft'], 'draft'),
        'sort_order' => apiIntInRange($data['sort_order'] ?? 0, 0, 0, 100000),
    ];
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
        $data = apiJsonBody();
        $payload = servicePayload($data);

        $sql = "INSERT INTO services (title, slug, short_desc, what_it_solves, how_we_work, what_changes, deliverables, icon_name, status, sort_order) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $params = [
            $payload['title'],
            $payload['slug'],
            $payload['short_desc'],
            json_encode($payload['what_it_solves'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
            json_encode($payload['how_we_work'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
            json_encode($payload['what_changes'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
            json_encode($payload['deliverables'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
            $payload['icon_name'],
            $payload['status'],
            $payload['sort_order']
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
        $data = apiJsonBody();
        $id = $data['id'] ?? null;
        if (!$id) {
            apiError('Service ID is required.', 400);
        }

        $fields = ['title', 'slug', 'short_desc', 'icon_name', 'status', 'sort_order'];
        $updates = [];
        $params = [];
        
        foreach ($fields as $field) {
            if (array_key_exists($field, $data)) {
                $updates[] = "$field = ?";
                if ($field === 'title') {
                    $params[] = apiRequiredString($data, 'title', 'Title', 255);
                } elseif ($field === 'short_desc') {
                    $params[] = apiRequiredString($data, 'short_desc', 'Short description', 500);
                } elseif ($field === 'slug') {
                    $params[] = apiSlug(apiTrimString($data['slug'] ?? '', 255), apiTrimString($data['title'] ?? 'service', 255));
                } elseif ($field === 'icon_name') {
                    $icon = apiOptionalString($data, 'icon_name', 500);
                    if ($icon !== null && (str_contains($icon, '/') || preg_match('#^https?://#i', $icon))) {
                        $icon = apiStoredMediaUrl($icon, 'Service icon');
                    }
                    $params[] = $icon;
                } elseif ($field === 'status') {
                    $params[] = apiEnum($data['status'], ['published', 'draft'], 'draft');
                } else {
                    $params[] = apiIntInRange($data['sort_order'], 0, 0, 100000);
                }
            }
        }
        
        $arrayFields = ['what_it_solves', 'how_we_work', 'what_changes', 'deliverables'];
        foreach ($arrayFields as $field) {
            if (array_key_exists($field, $data)) {
                $updates[] = "$field = ?";
                $params[] = json_encode(apiStringList($data[$field]), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
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
        $data = is_array($data) ? $data : [];
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
