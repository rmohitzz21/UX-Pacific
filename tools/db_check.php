<?php
declare(strict_types=1);

/**
 * Read-only DB connectivity check (CLI only).
 * Does not print passwords. Does not modify data.
 *
 * Usage (from project root):
 *   php tools/db_check.php
 */
if (PHP_SAPI !== 'cli') {
    http_response_code(403);
    header('Content-Type: text/plain; charset=utf-8');
    echo 'CLI only.';
    exit(1);
}

$root = dirname(__DIR__);
require_once $root . '/includes/database_config.php';
uxp_boot_database_config();

$mask = static function (string $u): string {
    if ($u === '') {
        return '(empty)';
    }
    if (strlen($u) <= 3) {
        return '***';
    }

    return substr($u, 0, 3) . str_repeat('*', min(8, strlen($u) - 3));
};

echo "UX Pacific — DB check (read-only)\n";
echo 'App root: ' . $root . "\n";
echo 'Dotenv path: ' . (uxp_dotenv_loaded_path() ?? '(none)') . "\n";
echo 'Local dev mode (would use DB_*_LOCAL): ' . (uxp_is_local_dev_request() ? 'yes' : 'no') . "\n";

$cfg = uxp_db_credentials();
if (!is_array($cfg) || ($cfg['database'] ?? '') === '' || ($cfg['username'] ?? '') === '') {
    echo "Connection: skipped (missing DB_NAME, DB_USER, or .env)\n";
    exit(1);
}

echo 'Effective DB_HOST: ' . $cfg['host'] . "\n";
echo 'Effective DB_PORT: ' . ($cfg['port'] ?? '3306') . "\n";
echo 'Effective DB_NAME: ' . $cfg['database'] . "\n";
echo 'Effective DB_USER (masked): ' . $mask((string) $cfg['username']) . "\n";
echo 'DB_PASS present: ' . (((string) ($cfg['password'] ?? '')) !== '' ? 'yes' : 'no') . "\n";
$pass = (string) ($cfg['password'] ?? '');
$passMetaKey = uxp_is_local_dev_request() && uxp_env_db('DB_PASS_LOCAL', '') !== '' ? 'DB_PASS_LOCAL' : 'DB_PASS';
$passMeta = uxp_dotenv_value_meta($passMetaKey);
echo 'DB_PASS length: ' . strlen($pass) . "\n";
echo 'DB_PASS contains #: ' . (str_contains($pass, '#') ? 'yes' : 'no') . "\n";
if (!empty($passMeta['unquoted_hash'])) {
    echo "DB_PASS warning: contains # but is not quoted in .env; use DB_PASS=\"actual#password\".\n";
}

if (!extension_loaded('pdo') || !extension_loaded('pdo_mysql')) {
    echo "Connection: failed (pdo or pdo_mysql missing)\n";
    exit(1);
}

require_once $root . '/includes/database.php';

try {
    $pdo = uxp_pdo_new($cfg);
    echo "Connection: ok\n";
    $db = (string) ($pdo->query('SELECT DATABASE()')->fetchColumn() ?: '');
    $cu = (string) ($pdo->query('SELECT CURRENT_USER()')->fetchColumn() ?: '');
    echo 'SELECT DATABASE(): ' . $db . "\n";
    $cuParts = explode('@', $cu, 2);
    $cuMasked = $mask($cuParts[0] ?? '') . (isset($cuParts[1]) ? '@' . $cuParts[1] : '');
    echo 'SELECT CURRENT_USER() (masked): ' . $cuMasked . "\n";

    $tables = ['admin_users', 'projects', 'services', 'contacts', 'testimonials', 'client_logos', 'faqs', 'ecosystem', 'login_attempts', 'form_submission_attempts'];
    echo "\nTable row counts:\n";
    foreach ($tables as $t) {
        try {
            $n = (int) $pdo->query('SELECT COUNT(*) FROM `' . str_replace('`', '``', $t) . '`')->fetchColumn();
            echo "  {$t}: {$n}\n";
        } catch (Throwable) {
            echo "  {$t}: (missing or no access)\n";
        }
    }
    exit(0);
} catch (PDOException $e) {
    $code = isset($e->errorInfo[1]) ? (int) $e->errorInfo[1] : 0;
    echo 'Connection: failed (driver code ' . $code . ")\n";
    exit(1);
}
