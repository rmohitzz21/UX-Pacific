<?php
/**
 * Admin API - Dashboard Statistics
 *
 * Security: Admin authentication required, no database error disclosure.
 * Tolerates missing tables or older contacts schemas (no hard 500).
 */
declare(strict_types=1);

require_once __DIR__ . '/../includes/auth.php';
requireAdminAuth('api');

require_once __DIR__ . '/../includes/api_helpers.php';
require_once __DIR__ . '/db.php';

adminRequireValidCsrfForMutation();

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    apiError('Method not allowed.', 405);
}

/**
 * @return array{0: bool, 1: bool}
 */
function dashboard_contacts_has_columns(PDO $pdo): array
{
    static $cache = null;
    if ($cache !== null) {
        return $cache;
    }
    $hasIndustry = false;
    $hasServiceInterest = false;
    try {
        $st = $pdo->prepare('SHOW COLUMNS FROM contacts LIKE ?');
        $st->execute(['industry']);
        $hasIndustry = (bool) $st->fetch(PDO::FETCH_ASSOC);
        $st->execute(['service_interest']);
        $hasServiceInterest = (bool) $st->fetch(PDO::FETCH_ASSOC);
    } catch (Throwable) {
        $hasIndustry = false;
        $hasServiceInterest = false;
    }
    $cache = [$hasIndustry, $hasServiceInterest];

    return $cache;
}

function dashboard_contacts_timestamp_order(PDO $pdo): string
{
    $allowed = ['submitted_at', 'created_at', 'id'];
    try {
        $st = $pdo->prepare('SHOW COLUMNS FROM contacts LIKE ?');
        foreach ($allowed as $col) {
            $st->execute([$col]);
            if ($st->fetch(PDO::FETCH_ASSOC)) {
                return $col;
            }
        }
    } catch (Throwable) {
        // ignore
    }

    return 'id';
}

function dashboard_table_exists(PDO $pdo, string $table): bool
{
    try {
        $st = $pdo->prepare(
            'SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = DATABASE() AND table_name = ?'
        );
        $st->execute([$table]);

        return (int) $st->fetchColumn() > 0;
    } catch (Throwable) {
        try {
            $pdo->query('SELECT 1 FROM `' . str_replace('`', '', $table) . '` LIMIT 1');

            return true;
        } catch (Throwable) {
            return false;
        }
    }
}

try {
    $stats = [
        'published_projects' => 0,
        'draft_projects' => 0,
        'total_contacts' => 0,
        'unread_contacts' => 0,
    ];
    $recentContacts = [];

    if (dashboard_table_exists($pdo, 'projects')) {
        $stmt = $pdo->query("SELECT COUNT(*) FROM projects WHERE status = 'published'");
        $stats['published_projects'] = (int) ($stmt ? $stmt->fetchColumn() : 0);
        $stmt = $pdo->query("SELECT COUNT(*) FROM projects WHERE status = 'draft'");
        $stats['draft_projects'] = (int) ($stmt ? $stmt->fetchColumn() : 0);
    }

    if (dashboard_table_exists($pdo, 'contacts')) {
        [$hasIndustry, $hasServiceInterest] = dashboard_contacts_has_columns($pdo);
        $orderCol = dashboard_contacts_timestamp_order($pdo);

        $stmt = $pdo->query('SELECT COUNT(*) FROM contacts');
        $stats['total_contacts'] = (int) ($stmt ? $stmt->fetchColumn() : 0);

        $stmt = $pdo->query("SELECT COUNT(*) FROM contacts WHERE status = 'new'");
        $stats['unread_contacts'] = (int) ($stmt ? $stmt->fetchColumn() : 0);

        $select = ['id', 'name', 'email', 'status'];
        if ($hasIndustry) {
            $select[] = 'industry';
        } else {
            $select[] = 'NULL AS industry';
        }
        if ($hasServiceInterest) {
            $select[] = 'service_interest';
        } else {
            $select[] = 'NULL AS service_interest';
        }
        $select[] = $orderCol . ' AS submitted_at';

        $sql = 'SELECT ' . implode(', ', $select) . ' FROM contacts ORDER BY ' . $orderCol . ' DESC LIMIT 5';
        $stmt = $pdo->query($sql);
        $recentContacts = $stmt ? ($stmt->fetchAll(PDO::FETCH_ASSOC) ?: []) : [];
    }

    apiSuccess([
        'stats' => $stats,
        'recent_contacts' => $recentContacts,
    ]);
} catch (Throwable $e) {
    apiError('Failed to load dashboard data.', 500, $e);
}
