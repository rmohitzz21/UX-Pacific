<?php
/**
 * TEMPORARY read-only database / environment diagnostic (JSON).
 *
 * DELETE this file or set APP_DEBUG=false after fixing production.
 *
 * Access: APP_DEBUG=true (or 1) in .env, OR an authenticated admin session.
 * Never exposes DB_PASS, raw PDO messages, or full credentials.
 */
declare(strict_types=1);

require_once dirname(__DIR__, 2) . '/includes/database_config.php';
uxp_boot_database_config();

require_once dirname(__DIR__) . '/includes/auth.php';

$truthy = static function (string $v): bool {
    $v = strtolower(trim($v));

    return in_array($v, ['1', 'true', 'yes', 'on'], true);
};

$appDebug = $truthy(uxp_env_raw('APP_DEBUG'));

if (!$appDebug && !adminIsAuthenticated()) {
    header('Content-Type: application/json; charset=utf-8');
    http_response_code(403);
    echo json_encode([
        'error' => 'Forbidden',
        'hint' => 'Set APP_DEBUG=true in .env temporarily, log in as admin, then reload; disable APP_DEBUG and delete this file after use.',
    ], JSON_UNESCAPED_SLASHES);

    exit;
}

header('Content-Type: application/json; charset=utf-8');

/**
 * @return array{user:string, host:string}
 */
$parseMysqlCurrentUser = static function (string $currentUser): array {
    $currentUser = trim($currentUser);
    if ($currentUser === '') {
        return ['user' => '', 'host' => ''];
    }
    $parts = explode('@', $currentUser, 2);

    return ['user' => $parts[0] ?? '', 'host' => $parts[1] ?? ''];
};

$maskDbUser = static function (string $u): string {
    if ($u === '') {
        return '(empty)';
    }
    if (strlen($u) <= 3) {
        return '***';
    }

    return substr($u, 0, 3) . str_repeat('*', min(8, strlen($u) - 3));
};

$maskCurrentUser = static function (string $cu) use ($maskDbUser): string {
    $cu = trim($cu);
    if ($cu === '') {
        return '(none)';
    }
    $parts = explode('@', $cu, 2);
    $u = $parts[0] ?? '';
    $h = $parts[1] ?? '';
    if ($h === '') {
        return $maskDbUser($u);
    }

    return $maskDbUser($u) . '@' . $h;
};

/** @param list<string> $allowedTables */
$safeIdent = static function (string $table, array $allowedTables): ?string {
    if (!in_array($table, $allowedTables, true)) {
        return null;
    }

    return str_replace('`', '``', $table);
};

/** @return array<string, list<string>> */
$tableImportantColumns = static function (): array {
    return [
        'admin_users' => ['id', 'email', 'password_hash', 'role', 'is_active'],
        'projects' => ['id', 'title', 'slug', 'status', 'is_featured', 'filter_group', 'thumbnail_url', 'sort_order'],
        'services' => ['id', 'title', 'slug', 'status', 'sort_order', 'icon_name'],
        'contacts' => ['id', 'name', 'email', 'message', 'status', 'submitted_at'],
        'testimonials' => ['id', 'client_name', 'quote', 'is_visible', 'sort_order', 'photo_url'],
        'client_logos' => ['id', 'name', 'logo_url', 'is_visible', 'sort_order'],
        'faqs' => ['id', 'question', 'answer', 'is_visible', 'sort_order'],
        'ecosystem' => ['id', 'partner_name', 'logo_url', 'is_visible', 'sort_order', 'website_url'],
        'login_attempts' => ['id', 'email', 'ip_address', 'success', 'attempted_at'],
        'form_submission_attempts' => ['id', 'ip_address', 'attempted_at'],
        'form_submissions' => ['id', 'form_type', 'email', 'message', 'created_at'],
        'page_seo' => ['route_key', 'page_title', 'meta_description'],
        'seo_meta' => ['page_key', 'meta_title', 'meta_description'],
        'site_settings' => ['setting_key', 'setting_value'],
        'home_settings' => ['setting_key', 'setting_value'],
        'team_members' => ['id', 'name', 'is_visible'],
        'geo_landing_pages' => ['country_slug', 'is_published'],
    ];
};

$allowedTableNames = static function () use ($tableImportantColumns): array {
    return array_keys($tableImportantColumns());
};

$dotenvPath = uxp_dotenv_loaded_path();
$candidates = uxp_dotenv_candidate_paths();
$cfg = uxp_db_credentials();

$out = [
    'environment_mode' => uxp_is_local_dev_request() ? 'local' : 'production',
    'uxp_force_production' => $truthy(uxp_env_raw('UXP_FORCE_PRODUCTION')),
    'uxp_force_local' => $truthy(uxp_env_raw('UXP_FORCE_LOCAL')),
    'http_host' => (string) ($_SERVER['HTTP_HOST'] ?? ''),
    'server_name' => (string) ($_SERVER['SERVER_NAME'] ?? ''),
    'app_root' => uxp_app_root(),
    'dotenv_candidates_checked' => $candidates,
    'dotenv_loaded_path' => $dotenvPath,
    'dotenv_found' => $dotenvPath !== null,
    'dotenv_readable' => $dotenvPath !== null && is_readable($dotenvPath),
    'pdo_extension' => extension_loaded('pdo'),
    'pdo_mysql_extension' => extension_loaded('pdo_mysql'),
    'db_host_effective' => null,
    'db_port' => null,
    'db_name' => null,
    'db_user_masked' => null,
    'db_pass_present' => false,
    'db_pass_contains_hash' => false,
    'db_charset' => 'utf8mb4',
    'db_connection' => 'not_attempted',
    'db_error_code' => null,
    'failure' => null,
    'current_database' => null,
    'current_user' => null,
    'tables' => [],
    'row_counts' => [],
    'visibility_counts' => [],
];

if (!is_array($cfg)) {
    $out['db_connection'] = 'failed';
    $out['failure'] = 'missing_config';
    $out['db_error_code'] = null;
    $out['hint'] = 'DB_NAME missing or .env not found/readable. Check dotenv_loaded_path and candidates.';

    echo json_encode($out, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

    exit;
}

$pass = (string) ($cfg['password'] ?? '');
$out['db_host_effective'] = (string) $cfg['host'];
$out['db_port'] = (string) ($cfg['port'] ?? '3306');
$out['db_name'] = (string) $cfg['database'];
$out['db_user_masked'] = $maskDbUser((string) $cfg['username']);
$out['db_pass_present'] = $pass !== '';
$out['db_pass_contains_hash'] = str_contains($pass, '#');
$out['db_charset'] = (string) ($cfg['charset'] ?? 'utf8mb4');

if (!extension_loaded('pdo') || !extension_loaded('pdo_mysql')) {
    $out['db_connection'] = 'failed';
    $out['failure'] = 'pdo_missing';

    echo json_encode($out, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

    exit;
}

$allowed = $allowedTableNames();
$important = $tableImportantColumns();

require_once dirname(__DIR__, 2) . '/includes/database.php';

try {
    $pdo = uxp_pdo_new($cfg);
    $out['db_connection'] = 'ok';
    $out['failure'] = null;

    try {
        $out['current_database'] = (string) ($pdo->query('SELECT DATABASE()')->fetchColumn() ?: '');
    } catch (Throwable) {
        $out['current_database'] = '(unavailable)';
    }
    try {
        $cu = (string) ($pdo->query('SELECT CURRENT_USER()')->fetchColumn() ?: '');
        $out['current_user'] = $maskCurrentUser($cu);
        $parsed = $parseMysqlCurrentUser($cu);
        $out['current_user_connection_host'] = $parsed['host'] !== '' ? $parsed['host'] : null;
    } catch (Throwable) {
        $out['current_user'] = '(unavailable)';
    }

    $tablesOut = [];
    $rowCounts = [];

    foreach ($allowed as $table) {
        $ident = $safeIdent($table, $allowed);
        if ($ident === null) {
            continue;
        }
        $optionalTables = [
            'form_submissions',
            'form_submission_attempts',
            'page_seo',
            'seo_meta',
            'site_settings',
            'home_settings',
            'team_members',
            'geo_landing_pages',
        ];
        $entry = [
            'exists' => false,
            'row_count' => null,
            'optional' => in_array($table, $optionalTables, true),
            'important_columns' => [
                'expected' => $important[$table] ?? [],
                'present' => [],
                'missing' => [],
            ],
        ];
        try {
            $pdo->query('SELECT 1 FROM `' . $ident . '` LIMIT 1');
            $entry['exists'] = true;
            $cntSt = $pdo->query('SELECT COUNT(*) AS c FROM `' . $ident . '`');
            $entry['row_count'] = $cntSt ? (int) $cntSt->fetchColumn() : null;
            $rowCounts[$table] = $entry['row_count'];

            $colNames = [];
            $show = $pdo->query('SHOW COLUMNS FROM `' . $ident . '`');
            if ($show) {
                foreach ($show->fetchAll(PDO::FETCH_ASSOC) as $colRow) {
                    if (!empty($colRow['Field'])) {
                        $colNames[] = (string) $colRow['Field'];
                    }
                }
            }
            $entry['important_columns']['present'] = $colNames;
            $expect = $important[$table] ?? [];
            foreach ($expect as $col) {
                if (!in_array($col, $colNames, true)) {
                    $entry['important_columns']['missing'][] = $col;
                }
            }
        } catch (Throwable) {
            $entry['exists'] = false;
            $entry['row_count'] = null;
        }
        $tablesOut[$table] = $entry;
    }
    $out['tables'] = $tablesOut;
    $out['row_counts'] = $rowCounts;

    $vis = [];
    $runCount = static function (PDO $pdo, string $sql): int {
        try {
            $r = $pdo->query($sql);

            return $r ? (int) $r->fetchColumn() : 0;
        } catch (Throwable) {
            return 0;
        }
    };
    if ($tablesOut['projects']['exists'] ?? false) {
        $vis['projects_total'] = $runCount($pdo, 'SELECT COUNT(*) FROM `projects`');
        $vis['projects_published'] = $runCount($pdo, "SELECT COUNT(*) FROM `projects` WHERE status = 'published'");
        $vis['projects_featured_and_published'] = $runCount(
            $pdo,
            "SELECT COUNT(*) FROM `projects` WHERE status = 'published' AND is_featured = 1"
        );
    }
    if ($tablesOut['services']['exists'] ?? false) {
        $vis['services_total'] = $runCount($pdo, 'SELECT COUNT(*) FROM `services`');
        $vis['services_published'] = $runCount($pdo, "SELECT COUNT(*) FROM `services` WHERE status = 'published'");
    }
    if ($tablesOut['testimonials']['exists'] ?? false) {
        $vis['testimonials_visible'] = $runCount($pdo, 'SELECT COUNT(*) FROM `testimonials` WHERE is_visible = 1');
    }
    if ($tablesOut['client_logos']['exists'] ?? false) {
        $vis['client_logos_visible'] = $runCount($pdo, 'SELECT COUNT(*) FROM `client_logos` WHERE is_visible = 1');
    }
    if ($tablesOut['faqs']['exists'] ?? false) {
        $vis['faqs_visible'] = $runCount($pdo, 'SELECT COUNT(*) FROM `faqs` WHERE is_visible = 1');
    }
    if ($tablesOut['ecosystem']['exists'] ?? false) {
        $vis['ecosystem_visible'] = $runCount($pdo, 'SELECT COUNT(*) FROM `ecosystem` WHERE is_visible = 1');
    }
    if ($tablesOut['admin_users']['exists'] ?? false) {
        $vis['admin_users_active'] = $runCount($pdo, 'SELECT COUNT(*) FROM `admin_users` WHERE is_active = 1');
    }
    $out['visibility_counts'] = $vis;
} catch (PDOException $e) {
    $out['db_connection'] = 'failed';
    $info = $e->errorInfo ?? [];
    $driverCode = isset($info[1]) ? (int) $info[1] : 0;
    $out['db_error_code'] = $driverCode;
    if ($driverCode === 1045) {
        $out['failure'] = 'access_denied';
    } elseif ($driverCode === 1049) {
        $out['failure'] = 'unknown_database';
    } elseif ($driverCode === 2002 || $driverCode === 2006) {
        $out['failure'] = 'connection_refused_or_timeout';
    } elseif ($driverCode === 1146) {
        $out['failure'] = 'table_missing';
    } else {
        $out['failure'] = 'unknown';
    }
    if ($out['db_pass_contains_hash']) {
        $out['hint_1045'] = 'If password contains # ensure the value is wrapped in double quotes in .env (e.g. DB_PASS="...").';
    }
}

echo json_encode($out, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
