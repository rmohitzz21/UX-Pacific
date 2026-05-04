<?php

declare(strict_types=1);

/**
 * Database bootstrap. Returns null when credentials are missing or connection fails.
 * Used by CMS helpers and optional form submission storage.
 */
function uxp_db(): ?PDO
{
    static $pdo = null;
    static $attempted = false;
    if ($attempted) {
        return $pdo;
    }
    $attempted = true;
    $credPath = __DIR__ . '/db_credentials.php';
    if (!is_readable($credPath)) {
        return null;
    }
    /** @var mixed $cfg */
    $cfg = require $credPath;
    if (!is_array($cfg)) {
        return null;
    }
    $host = (string) ($cfg['host'] ?? '127.0.0.1');
    $port = (string) ($cfg['port'] ?? '3306');
    $name = (string) ($cfg['database'] ?? '');
    $user = (string) ($cfg['username'] ?? '');
    $pass = (string) ($cfg['password'] ?? '');
    if ($name === '') {
        return null;
    }
    $dsn = 'mysql:host=' . $host . ';port=' . $port . ';dbname=' . $name . ';charset=utf8mb4';
    try {
        $pdo = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
    } catch (Throwable) {
        $pdo = null;
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
