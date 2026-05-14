<?php

declare(strict_types=1);

require_once __DIR__ . '/database_config.php';

/**
 * One MySQL connection factory — same DSN/options for public CMS, admin API, and admin login.
 *
 * @param array{host:string,port:string,database:string,username:string,password:string,charset?:string} $cfg
 *
 * @throws PDOException on driver errors (e.g. 1045 access denied)
 */
function uxp_pdo_new(array $cfg): PDO
{
    $charset = (string) ($cfg['charset'] ?? 'utf8mb4');
    $dsn = sprintf(
        'mysql:host=%s;port=%s;dbname=%s;charset=%s',
        $cfg['host'],
        $cfg['port'],
        $cfg['database'],
        $charset
    );

    return new PDO($dsn, $cfg['username'], $cfg['password'], [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
}

/**
 * Shared PDO for CMS and optional form persistence. Returns null if not configured or connection fails.
 */
function uxp_db(): ?PDO
{
    static $pdo = null;
    static $failed = false;
    if ($pdo instanceof PDO) {
        return $pdo;
    }
    if ($failed) {
        return null;
    }

    $cfg = uxp_db_credentials();
    if ($cfg === null || ($cfg['database'] ?? '') === '') {
          $failed = true;

        return null;
    }

    try {
        $pdo = uxp_pdo_new($cfg);

        return $pdo;
    } catch (Throwable $e) {
        $failed = true;
        $pdo = null;
        if (function_exists('uxp_env_raw') && uxp_env_raw('UXP_LOG_DB_ERRORS') === '1') {
            $code = $e instanceof PDOException ? (string) $e->getCode() : (string) $e->getCode();
            $state = $e instanceof PDOException && isset($e->errorInfo[0]) ? (string) $e->errorInfo[0] : '';
            error_log('[uxp_db] PDO connection failed. code=' . $code . ' sqlstate=' . $state);
        }

        return null;
    }
}

/**
 * Same connection as uxp_db(); throws if the database is unavailable (demo-style API).
 *
 * @throws RuntimeException
 */
function getDB(): PDO
{
    $pdo = uxp_db();
    if (!$pdo instanceof PDO) {
        throw new RuntimeException('Database connection failed. Check the project root .env file (see .env.example).');
    }

    return $pdo;
}

/**
 * @param array<string, mixed> $data
 */
function uxp_form_submission_insert(array $data): bool
{
    $pdo = uxp_db();
    if (!$pdo) {
        return false;
    }
    $sql = 'INSERT INTO form_submissions (form_type, name, email, phone, website_url, industry, message, status, source_url, created_at)
            VALUES (:form_type, :name, :email, :phone, :website_url, :industry, :message, :status, :source_url, NOW())';
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'form_type' => (string) ($data['form_type'] ?? ''),
            'name' => (string) ($data['name'] ?? ''),
            'email' => (string) ($data['email'] ?? ''),
            'phone' => (string) ($data['phone'] ?? ''),
            'website_url' => (string) ($data['website_url'] ?? ''),
            'industry' => (string) ($data['industry'] ?? ''),
            'message' => (string) ($data['message'] ?? ''),
            'status' => (string) ($data['status'] ?? 'new'),
            'source_url' => (string) ($data['source_url'] ?? ''),
        ]);

        return true;
    } catch (Throwable) {
        return false;
    }
}
