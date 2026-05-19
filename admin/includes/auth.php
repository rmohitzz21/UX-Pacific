<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    $isHttps = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off');
    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'domain' => '',
        'secure' => $isHttps,
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
    session_start();
}

function adminBasePath(): string
{
    $script = (string) ($_SERVER['SCRIPT_NAME'] ?? '');
    $marker = '/admin/';
    $pos = strpos($script, $marker);
    if ($pos === false) {
        return '';
    }

    $prefix = substr($script, 0, $pos);
    return rtrim($prefix, '/');
}

function adminUrl(string $path): string
{
    return adminBasePath() . '/admin/' . ltrim($path, '/');
}

function adminAuthPdo(): PDO
{
    require_once dirname(__DIR__, 2) . '/includes/database.php';

    $pdo = uxp_db();
    if ($pdo instanceof PDO) {
        return $pdo;
    }

    $config = uxp_db_credentials();
    if (!is_array($config) || ($config['database'] ?? '') === '' || ($config['username'] ?? '') === '') {
        throw new RuntimeException('Database is not configured. Copy .env.example to .env and set DB_NAME, DB_USER, DB_PASS, DB_HOST.');
    }

    // Same request may have failed uxp_db() once; retry here so login can map PDOException (1045, etc.).
    return uxp_pdo_new($config);
}

function adminIsAuthenticated(): bool
{
    return !empty($_SESSION['admin_user']['id']);
}

function requireAdminAuth(string $context = 'page'): void
{
    if (adminIsAuthenticated()) {
        return;
    }

    if ($context === 'api') {
        header('Content-Type: application/json');
        http_response_code(401);
        echo json_encode(['error' => 'Unauthorized']);
        exit;
    }

    header('Location: ' . adminUrl('index.php'));
    exit;
}

function requireAdminRole(string $requiredRole, string $context = 'page'): void
{
    requireAdminAuth($context);
    $role = (string) ($_SESSION['admin_user']['role'] ?? '');
    if ($role === $requiredRole) {
        return;
    }

    if ($context === 'api') {
        header('Content-Type: application/json');
        http_response_code(403);
        echo json_encode(['error' => 'Forbidden']);
        exit;
    }

    http_response_code(403);
    echo 'Forbidden';
    exit;
}

function adminAttemptLogin(string $email, string $password): array
{
    $email = trim(strtolower($email));
    if ($email === '' || $password === '') {
        return ['success' => false, 'error' => 'Email and password are required.'];
    }

    $ip = adminLoginClientIp();

    try {
        $pdo = adminAuthPdo();

        $rl = adminLoginRateLimitCheck($pdo, $email, $ip);
        if ($rl['blocked']) {
            error_log('[UX Pacific admin login] rate limited (' . $rl['reason'] . ')');

            return ['success' => false, 'error' => 'Too many login attempts. Please try again later.'];
        }

        $stmt = $pdo->prepare('SELECT id, name, email, password_hash, role, is_active FROM admin_users WHERE email = ? LIMIT 1');
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if (!$user || (int) $user['is_active'] !== 1 || !password_verify($password, $user['password_hash'])) {
            adminLoginRecordFailure($pdo, $email, $ip);

            return ['success' => false, 'error' => 'Invalid email or password.'];
        }

        session_regenerate_id(true);
        $_SESSION['admin_user'] = [
            'id' => (int) $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'role' => $user['role'],
            'login_at' => time(),
        ];

        $up = $pdo->prepare('UPDATE admin_users SET last_login_at = NOW() WHERE id = ?');
        $up->execute([(int) $user['id']]);

        adminLoginClearFailures($pdo, $email, $ip);
        error_log('[UX Pacific admin login] success user_id=' . (int) $user['id']);

        return ['success' => true];
    } catch (Throwable $e) {
        // Always log for the server admin (never show raw DB messages to the browser).
        error_log('[UX Pacific admin login] ' . $e::class . ': ' . $e->getMessage());

        if ($e instanceof RuntimeException && str_contains($e->getMessage(), 'Database is not configured')) {
            return [
                'success' => false,
                'error' => 'Database is not configured. On the server, create a .env file next to index.php with DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASS (see .env.example).',
            ];
        }

        if ($e instanceof PDOException) {
            $info = $e->errorInfo ?? [];
            $driverCode = isset($info[1]) ? (int) $info[1] : 0;
            $msg = $e->getMessage();

            if ($driverCode === 1049 || str_contains($msg, 'Unknown database')) {
                return ['success' => false, 'error' => 'Unknown database: DB_NAME in .env does not match a database on this MySQL server.'];
            }
            if ($driverCode === 1045 || str_contains($msg, 'Access denied')) {
                return [
                    'success' => false,
                    'error' => 'Database rejected the user or password. In cPanel → MySQL Users, copy the exact username (often with a prefix). In .env use DB_PASS="yourpassword" if it contains # or special characters. Rotate the password if it was ever exposed.',
                ];
            }
            if ($driverCode === 2002 || str_contains($msg, 'Connection refused') || str_contains($msg, 'timed out')) {
                return ['success' => false, 'error' => 'Cannot reach MySQL. On most hosts DB_HOST should be localhost when PHP and MySQL are on the same server.'];
            }
            if ($driverCode === 1146 || str_contains($msg, "doesn't exist") || str_contains($msg, 'Base table or view not found')) {
                return ['success' => false, 'error' => 'Database tables are missing. Import database/schema_admin.sql into the database named in DB_NAME.'];
            }

            return [
                'success' => false,
                'error' => 'Database error during login. Set UXP_LOG_DB_ERRORS=1 in .env, try again, read the PHP error_log, then remove that line.',
            ];
        }

        return ['success' => false, 'error' => 'Login / database service temporarily unavailable. Check PHP error_log on the server.'];
    }
}

function adminLogout(): void
{
    $_SESSION = [];

    $isHttps = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off');
    $cookieName = session_name();

    if (ini_get('session.use_cookies') && $cookieName !== '') {
        setcookie($cookieName, '', [
            'expires' => time() - 42000,
            'path' => '/',
            'domain' => '',
            'secure' => $isHttps,
            'httponly' => true,
            'samesite' => 'Lax',
        ]);
    }

    session_destroy();
}

function adminCsrfToken(): string
{
    if (empty($_SESSION['admin_csrf'])) {
        $_SESSION['admin_csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['admin_csrf'];
}

function adminValidateCsrf(?string $token): bool
{
    return is_string($token) && !empty($_SESSION['admin_csrf']) && hash_equals($_SESSION['admin_csrf'], $token);
}

/**
 * CSRF token for mutating admin API calls (header or multipart field; do not read php://input here).
 */
function adminCsrfTokenFromRequest(): string
{
    $h = $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';
    if (is_string($h) && $h !== '') {
        return trim($h);
    }
    if (!empty($_POST['csrf_token'])) {
        return trim((string) $_POST['csrf_token']);
    }

    return '';
}

/**
 * Require a valid CSRF token for POST, PUT, PATCH, DELETE. Safe for GET/HEAD (no-op).
 */
function adminRequireValidCsrfForMutation(): void
{
    $method = strtoupper((string) ($_SERVER['REQUEST_METHOD'] ?? 'GET'));
    if (!in_array($method, ['POST', 'PUT', 'PATCH', 'DELETE'], true)) {
        return;
    }

    if (!adminValidateCsrf(adminCsrfTokenFromRequest())) {
        header('Content-Type: application/json');
        http_response_code(403);
        echo json_encode(['error' => 'Invalid or missing CSRF token.']);
        exit;
    }
}

function adminLoginClientIp(): string
{
    $ip = (string) ($_SERVER['REMOTE_ADDR'] ?? '');

    return substr($ip, 0, 45);
}

/**
 * @return array{blocked: bool, reason: string}
 */
function adminLoginRateLimitCheck(PDO $pdo, string $email, string $ip): array
{
    try {
        if (mt_rand(1, 40) === 1) {
            $pdo->exec('DELETE FROM login_attempts WHERE attempted_at < DATE_SUB(NOW(), INTERVAL 30 DAY)');
        }

        $stmt = $pdo->prepare(
            'SELECT COUNT(*) FROM login_attempts WHERE success = 0 AND attempted_at >= DATE_SUB(NOW(), INTERVAL 15 MINUTE) AND email = ?'
        );
        $stmt->execute([$email]);
        if ((int) $stmt->fetchColumn() >= 5) {
            return ['blocked' => true, 'reason' => 'email'];
        }

        $stmt2 = $pdo->prepare(
            'SELECT COUNT(*) FROM login_attempts WHERE success = 0 AND attempted_at >= DATE_SUB(NOW(), INTERVAL 15 MINUTE) AND ip_address = ?'
        );
        $stmt2->execute([$ip]);
        if ((int) $stmt2->fetchColumn() >= 5) {
            return ['blocked' => true, 'reason' => 'ip'];
        }
    } catch (Throwable) {
        // If table missing or DB error, do not block login.
    }

    return ['blocked' => false, 'reason' => ''];
}

function adminLoginRecordFailure(PDO $pdo, string $email, string $ip): void
{
    try {
        $ins = $pdo->prepare('INSERT INTO login_attempts (email, ip_address, success) VALUES (?, ?, 0)');
        $ins->execute([$email, $ip]);
    } catch (Throwable) {
        // ignore
    }
}

function adminLoginClearFailures(PDO $pdo, string $email, string $ip): void
{
    try {
        $pdo->prepare('DELETE FROM login_attempts WHERE email = ? AND success = 0')->execute([$email]);
        $pdo->prepare('INSERT INTO login_attempts (email, ip_address, success) VALUES (?, ?, 1)')->execute([$email, $ip]);
    } catch (Throwable) {
        // ignore
    }
}

