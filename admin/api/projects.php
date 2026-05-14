<?php
/**
 * Admin API - Projects CRUD
 *
 * Security: Admin authentication required, no database error disclosure.
 * Tolerates legacy ENUM/column definitions (sanitizes filter_group, status, slug, link_label).
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
 * @param array<string, mixed> $p
 * @return array<string, mixed>
 */
function uxp_shape_project_api_row(array $p): array
{
    $tags = $p['tags'] ?? null;
    if (is_string($tags) && $tags !== '') {
        $dec = json_decode($tags, true);
        $p['tags'] = is_array($dec) ? $dec : [];
    } else {
        $p['tags'] = is_array($tags) ? $tags : [];
    }
    $p['is_featured'] = (bool) ($p['is_featured'] ?? false);
    if (!empty($p['thumbnail_url'])) {
        $p['thumbnail_url'] = uxp_normalize_stored_media_url((string) $p['thumbnail_url']);
    }

    return $p;
}

/**
 * @param array<string, mixed> $row
 * @return array<string, mixed>
 */
function uxp_shape_client_logo_api_row(array $row): array
{
    if (!empty($row['logo_url'])) {
        $row['logo_url'] = uxp_normalize_stored_media_url((string) $row['logo_url']);
    }

    return $row;
}

/**
 * Parse ENUM('a','b') from SHOW COLUMNS Type string.
 *
 * @return list<string>
 */
function uxp_parse_mysql_enum_values(string $type): array
{
    if (!preg_match_all("/'((?:[^'\\\\]|\\\\.)*)'/", $type, $m)) {
        return [];
    }

    return array_map(static fn ($v) => str_replace("\\'", "'", $v), $m[1]);
}

/**
 * @return list<string>
 */
function uxp_projects_enum_values(PDO $pdo, string $field, array $fallback): array
{
    static $cache = [];
    $key = $field;
    if (isset($cache[$key])) {
        return $cache[$key];
    }
    try {
        $st = $pdo->prepare('SHOW COLUMNS FROM projects WHERE Field = ?');
        $st->execute([$field]);
        $row = $st->fetch(PDO::FETCH_ASSOC);
        if ($row && !empty($row['Type'])) {
            $vals = uxp_parse_mysql_enum_values((string) $row['Type']);
            if ($vals !== []) {
                return $cache[$key] = $vals;
            }
        }
    } catch (Throwable) {
        // ignore
    }

    return $cache[$key] = $fallback;
}

function uxp_projects_sanitize_filter_group(PDO $pdo, mixed $value): string
{
    $allowed = uxp_projects_enum_values($pdo, 'filter_group', ['all', 'selected_work', 'case_studies', 'articles']);
    $v = strtolower(trim((string) $value));
    if (in_array($v, $allowed, true)) {
        return $v;
    }

    return in_array('all', $allowed, true) ? 'all' : $allowed[0];
}

function uxp_projects_sanitize_status(PDO $pdo, mixed $value): string
{
    $allowed = uxp_projects_enum_values($pdo, 'status', ['published', 'draft', 'archived']);
    $v = strtolower(trim((string) $value));
    if (in_array($v, $allowed, true)) {
        return $v;
    }

    return in_array('draft', $allowed, true) ? 'draft' : $allowed[0];
}

function uxp_projects_sanitize_link_label(mixed $value): string
{
    $s = trim((string) $value);
    if ($s === '') {
        return 'View Details';
    }
    if (function_exists('mb_substr')) {
        return mb_substr($s, 0, 50, 'UTF-8');
    }

    return substr($s, 0, 50);
}

function uxp_projects_unique_slug(PDO $pdo, string $slug, ?int $ignoreId = null): string
{
    $slug = strtolower(trim($slug));
    if ($slug === '') {
        $slug = 'project';
    }
    $base = $slug;
    $n = 2;
    while (true) {
        if ($ignoreId === null) {
            $st = $pdo->prepare('SELECT id FROM projects WHERE slug = ? LIMIT 1');
            $st->execute([$slug]);
        } else {
            $st = $pdo->prepare('SELECT id FROM projects WHERE slug = ? AND id != ? LIMIT 1');
            $st->execute([$slug, $ignoreId]);
        }
        if (!$st->fetch()) {
            return $slug;
        }
        $slug = $base . '-' . $n;
        $n++;
        if ($n > 500) {
            return $base . '-' . bin2hex(random_bytes(4));
        }
    }
}

/**
 * @param mixed $tags
 */
function uxp_projects_tags_json($tags): ?string
{
    if ($tags === null) {
        return null;
    }
    if (is_array($tags)) {
        $enc = json_encode(array_values($tags), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        return $enc === false ? '[]' : $enc;
    }
    if (is_string($tags) && trim($tags) !== '') {
        $dec = json_decode($tags, true);
        if (is_array($dec)) {
            $enc = json_encode(array_values($dec), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

            return $enc === false ? '[]' : $enc;
        }

        return json_encode([trim($tags)], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?: '[]';
    }

    return null;
}

switch ($method) {
    case 'GET':
        try {
            $stmt = $pdo->query("SELECT * FROM projects ORDER BY sort_order ASC, created_at DESC");
            $projects = $stmt ? $stmt->fetchAll() : [];

            foreach ($projects as &$p) {
                $p = uxp_shape_project_api_row($p);
            }
            unset($p);

            $clientLogos = [];
            try {
                $clStmt = $pdo->query('SELECT * FROM client_logos ORDER BY sort_order ASC, id ASC');
                if ($clStmt) {
                    $clientLogos = array_map(
                        static fn (array $row): array => uxp_shape_client_logo_api_row($row),
                        $clStmt->fetchAll() ?: []
                    );
                }
            } catch (Throwable) {
                $clientLogos = [];
            }

            apiSuccess([
                'projects' => $projects,
                'client_logos' => $clientLogos,
            ]);
        } catch (Throwable $e) {
            apiError('Failed to fetch projects.', 500, $e);
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);

        if (!is_array($data) || !isset($data['title']) || trim((string) $data['title']) === '') {
            apiError('Title is required.', 400);
        }

        $title = trim((string) $data['title']);
        $slugRaw = isset($data['slug']) ? trim((string) $data['slug']) : '';
        $slug = $slugRaw !== ''
            ? strtolower(preg_replace('/[^a-z0-9-]+/i', '-', $slugRaw))
            : strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title), '-'));
        $slug = uxp_projects_unique_slug($pdo, $slug);

        $description = trim((string) ($data['description'] ?? ''));
        $thumbnail_url = isset($data['thumbnail_url']) ? trim((string) $data['thumbnail_url']) : '';
        $thumbnail_url = $thumbnail_url === '' ? null : $thumbnail_url;

        $external_link = isset($data['external_link']) ? trim((string) $data['external_link']) : '';
        $external_link = $external_link === '' ? null : $external_link;

        $link_label = uxp_projects_sanitize_link_label($data['link_label'] ?? 'View Details');
        $tags = uxp_projects_tags_json($data['tags'] ?? null);
        $filter_group = uxp_projects_sanitize_filter_group($pdo, $data['filter_group'] ?? 'all');
        $is_featured = !empty($data['is_featured']) ? 1 : 0;
        $status = uxp_projects_sanitize_status($pdo, $data['status'] ?? 'draft');
        $sort_order = (int) ($data['sort_order'] ?? 0);

        try {
            $stmt = $pdo->prepare('INSERT INTO projects (title, slug, description, thumbnail_url, external_link, link_label, tags, filter_group, is_featured, status, sort_order) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
            $stmt->execute([$title, $slug, $description, $thumbnail_url, $external_link, $link_label, $tags, $filter_group, $is_featured, $status, $sort_order]);
            $id = $pdo->lastInsertId();

            $stmt = $pdo->prepare('SELECT * FROM projects WHERE id = ?');
            $stmt->execute([$id]);
            $newProject = $stmt->fetch();
            if (!$newProject) {
                apiError('Project not found after create.', 500);
            }
            $newProject = uxp_shape_project_api_row($newProject);

            apiSuccess(['success' => true, 'project' => $newProject], 201);
        } catch (Throwable $e) {
            if ($e instanceof PDOException) {
                $sqlState = (string) ($e->errorInfo[0] ?? '');
                $mysqlErr = (int) ($e->errorInfo[1] ?? 0);
                if ($sqlState === '23000' || $mysqlErr === 1062) {
                    apiError('Could not save: duplicate slug or constraint conflict. Try a different title or slug.', 409, $e);
                }
            }
            apiError('Failed to create project.', 500, $e);
        }
        break;

    case 'PUT':
    case 'PATCH':
        $data = json_decode(file_get_contents('php://input'), true);

        if (!is_array($data) || !isset($data['id'])) {
            apiError('Project ID is required.', 400);
        }

        $id = (int) $data['id'];

        $oldThumbnailUrl = '';
        if (array_key_exists('thumbnail_url', $data)) {
            try {
                $stOld = $pdo->prepare('SELECT thumbnail_url FROM projects WHERE id = ?');
                $stOld->execute([$id]);
                $oldThumbnailUrl = (string) ($stOld->fetchColumn() ?: '');
            } catch (Throwable) {
                $oldThumbnailUrl = '';
            }
        }

        $updates = [];
        $params = [];

        if (isset($data['title'])) {
            $updates[] = 'title = ?';
            $params[] = trim((string) $data['title']);
        }
        if (array_key_exists('slug', $data)) {
            $slugRaw = trim((string) $data['slug']);
            $slug = $slugRaw !== ''
                ? strtolower(preg_replace('/[^a-z0-9-]+/i', '-', $slugRaw))
                : null;
            if ($slug !== null && $slug !== '') {
                $slug = uxp_projects_unique_slug($pdo, $slug, $id);
                $updates[] = 'slug = ?';
                $params[] = $slug;
            }
        }
        if (array_key_exists('description', $data)) {
            $updates[] = 'description = ?';
            $params[] = trim((string) $data['description']);
        }
        if (array_key_exists('thumbnail_url', $data)) {
            $t = trim((string) $data['thumbnail_url']);
            $updates[] = 'thumbnail_url = ?';
            $params[] = $t === '' ? null : $t;
        }
        if (array_key_exists('external_link', $data)) {
            $e = trim((string) $data['external_link']);
            $updates[] = 'external_link = ?';
            $params[] = $e === '' ? null : $e;
        }
        if (array_key_exists('link_label', $data)) {
            $updates[] = 'link_label = ?';
            $params[] = uxp_projects_sanitize_link_label($data['link_label']);
        }
        if (array_key_exists('filter_group', $data)) {
            $updates[] = 'filter_group = ?';
            $params[] = uxp_projects_sanitize_filter_group($pdo, $data['filter_group']);
        }
        if (array_key_exists('status', $data)) {
            $updates[] = 'status = ?';
            $params[] = uxp_projects_sanitize_status($pdo, $data['status']);
        }
        if (array_key_exists('sort_order', $data)) {
            $updates[] = 'sort_order = ?';
            $params[] = (int) $data['sort_order'];
        }

        if (isset($data['tags'])) {
            $updates[] = 'tags = ?';
            $params[] = uxp_projects_tags_json($data['tags']);
        }
        if (isset($data['is_featured'])) {
            $updates[] = 'is_featured = ?';
            $params[] = !empty($data['is_featured']) ? 1 : 0;
        }

        if ($updates === []) {
            apiError('No fields to update.', 400);
        }

        $params[] = $id;
        $sql = 'UPDATE projects SET ' . implode(', ', $updates) . ' WHERE id = ?';

        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);

            $stmt = $pdo->prepare('SELECT * FROM projects WHERE id = ?');
            $stmt->execute([$id]);
            $updatedProject = $stmt->fetch();

            if (!$updatedProject) {
                apiError('Project not found.', 404);
            }

            $updatedProject = uxp_shape_project_api_row($updatedProject);

            if (array_key_exists('thumbnail_url', $data) && $oldThumbnailUrl !== '') {
                $newT = trim((string) ($data['thumbnail_url'] ?? ''));
                $newNorm = $newT === '' ? '' : uxp_normalize_stored_media_url($newT);
                $oldNorm = uxp_normalize_stored_media_url($oldThumbnailUrl);
                if ($newNorm !== $oldNorm) {
                    uxp_unlink_upload_file_if_safe($oldThumbnailUrl);
                }
            }

            apiSuccess(['success' => true, 'project' => $updatedProject]);
        } catch (Throwable $e) {
            if ($e instanceof PDOException) {
                $sqlState = (string) ($e->errorInfo[0] ?? '');
                $mysqlErr = (int) ($e->errorInfo[1] ?? 0);
                if ($sqlState === '23000' || $mysqlErr === 1062) {
                    apiError('Could not save: duplicate slug or constraint conflict.', 409, $e);
                }
            }
            apiError('Failed to update project.', 500, $e);
        }
        break;

    case 'DELETE':
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $data['id'] ?? $_GET['id'] ?? null;

        if (!$id) {
            apiError('Project ID is required.', 400);
        }

        try {
            $stmt = $pdo->prepare('DELETE FROM projects WHERE id = ?');
            $stmt->execute([(int) $id]);
            apiSuccess(['success' => true]);
        } catch (Throwable $e) {
            apiError('Failed to delete project.', 500, $e);
        }
        break;

    default:
        apiError('Method not allowed.', 405);
        break;
}
