<?php

declare(strict_types=1);

/**
 * Single database configuration entry point.
 *
 * Loads the project `.env` (default: same directory as `index.php`, via `uxp_app_root()`),
 * or the file path from `UXP_ENV_FILE` / `$_SERVER['UXP_ENV_FILE']` when set (Apache SetEnv).
 * No `includes/db.local.php`, no `includes/db_credentials.php` — put all values in `.env`.
 *
 * Local vs live (one `.env`):
 * - Local dev when HTTP_HOST / SERVER_NAME is localhost, 127.0.0.1, ::1, [::1], or UXP_LOCAL_HOSTS.
 * - Then non-empty DB_*_LOCAL keys override DB_* for that request only.
 * - UXP_FORCE_LOCAL=1 / UXP_FORCE_PRODUCTION=1 override detection (e.g. CLI).
 *
 * Connections: `includes/database.php` (`uxp_db()`, `getDB()`) and admin code include this file
 * and call `uxp_db_credentials()` — one code path, no overrides from extra PHP files.
 *
 * Optional: Apache `SetEnv UXP_ENV_FILE /full/path/to/.env` if `.env` cannot sit next to `index.php`.
 */

/** Project root (directory that contains `index.php` and `.env`). */
function uxp_app_root(): string
{
    return dirname(__DIR__);
}

/**
 * @return list<string>
 */
function uxp_dotenv_candidate_paths(): array
{
    $paths = [];
    foreach (['UXP_ENV_FILE'] as $k) {
        $v = getenv($k);
        if ($v !== false && trim($v) !== '') {
            $paths[] = trim($v);
        }
        if (isset($_SERVER[$k]) && trim((string) $_SERVER[$k]) !== '') {
            $paths[] = trim((string) $_SERVER[$k]);
        }
    }
    $paths[] = uxp_app_root() . DIRECTORY_SEPARATOR . '.env';

    return array_values(array_unique($paths));
}

/**
 * Parse a .env value safely:
 * - DB_PASS="abc#123" keeps the #.
 * - DB_PASS=abc # comment strips the comment.
 * - DB_PASS=abc#123 is accepted for backwards compatibility, but diagnostics warn to quote it.
 *
 * @return array{value:string, quoted:bool, quote:string, contains_hash:bool, unquoted_hash:bool}
 */
function uxp_parse_dotenv_value(string $raw): array
{
    $raw = trim($raw);
    $quoted = false;
    $quote = '';
    $value = '';

    if ($raw !== '' && ($raw[0] === '"' || $raw[0] === "'")) {
        $quoted = true;
        $quote = $raw[0];
        $escaped = false;
        $len = strlen($raw);

        for ($i = 1; $i < $len; $i++) {
            $ch = $raw[$i];
            if ($escaped) {
                $value .= ($ch === $quote || $ch === '\\') ? $ch : '\\' . $ch;
                $escaped = false;
                continue;
            }
            if ($ch === '\\') {
                $escaped = true;
                continue;
            }
            if ($ch === $quote) {
                break;
            }
            $value .= $ch;
        }
        if ($escaped) {
            $value .= '\\';
        }
    } else {
        $len = strlen($raw);
        $end = $len;
        for ($i = 0; $i < $len; $i++) {
            if ($raw[$i] === '#' && ($i === 0 || ctype_space($raw[$i - 1]))) {
                $end = $i;
                break;
            }
        }
        $value = trim(substr($raw, 0, $end));
    }

    $containsHash = strpos($value, '#') !== false;

    return [
        'value' => $value,
        'quoted' => $quoted,
        'quote' => $quote,
        'contains_hash' => $containsHash,
        'unquoted_hash' => !$quoted && $containsHash,
    ];
}

function uxp_load_dotenv(string $path): void
{
    static $loaded = [];
    if (isset($loaded[$path])) {
        return;
    }
    $loaded[$path] = true;
    if (!is_readable($path)) {
        return;
    }
    $lines = file($path, FILE_IGNORE_NEW_LINES);
    if ($lines === false) {
        return;
    }
    foreach ($lines as $line) {
        $line = trim((string) preg_replace('/^\xEF\xBB\xBF/', '', $line));
        if ($line === '' || (isset($line[0]) && ($line[0] === '#' || $line[0] === ';'))) {
            continue;
        }
        if (strpos($line, '=') === false) {
            continue;
        }
        [$name, $value] = explode('=', $line, 2);
        $name = trim(str_replace("\xEF\xBB\xBF", '', $name));
        if ($name === '' || !preg_match('/^[A-Za-z_][A-Za-z0-9_]*$/', $name)) {
            continue;
        }
        $parsed = uxp_parse_dotenv_value($value);
        $_ENV[$name] = $parsed['value'];
        $GLOBALS['UXP_DOTENV_VALUE_META'][$name] = [
            'quoted' => $parsed['quoted'],
            'quote' => $parsed['quote'],
            'contains_hash' => $parsed['contains_hash'],
            'unquoted_hash' => $parsed['unquoted_hash'],
            'length' => strlen($parsed['value']),
        ];
        putenv($name . '=' . $parsed['value']);
    }
}

function uxp_boot_database_config(): void
{
    static $done = false;
    if ($done) {
        return;
    }
    $done = true;
    foreach (uxp_dotenv_candidate_paths() as $path) {
        if (is_readable($path)) {
            uxp_load_dotenv($path);
            $GLOBALS['UXP_DOTENV_LOADED_PATH'] = $path;
            return;
        }
    }
    $GLOBALS['UXP_DOTENV_LOADED_PATH'] = null;
}

/** Absolute path to the first readable .env that was loaded, or null. */
function uxp_dotenv_loaded_path(): ?string
{
    uxp_boot_database_config();
    $p = $GLOBALS['UXP_DOTENV_LOADED_PATH'] ?? null;

    return is_string($p) ? $p : null;
}

/**
 * Single env key (no UXP_ alias doubling). For flags like UXP_FORCE_LOCAL.
 */
function uxp_env_raw(string $name, string $default = ''): string
{
    if (defined($name)) {
        $c = constant($name);
        if (is_string($c) || is_int($c) || is_float($c)) {
            return (string) $c;
        }
    }
    if (isset($_ENV[$name]) && $_ENV[$name] !== '') {
        return (string) $_ENV[$name];
    }
    $v = getenv($name);
    if ($v !== false && $v !== '') {
        return (string) $v;
    }

    return $default;
}

/**
 * Metadata from the loaded .env assignment, used only for masked diagnostics.
 *
 * @return array{quoted?:bool,quote?:string,contains_hash?:bool,unquoted_hash?:bool,length?:int}
 */
function uxp_dotenv_value_meta(string $name): array
{
    uxp_boot_database_config();
    $meta = $GLOBALS['UXP_DOTENV_VALUE_META'][$name] ?? [];

    return is_array($meta) ? $meta : [];
}

/**
 * True when this request should use DB_*_LOCAL overrides (typical: XAMPP + browser on localhost).
 * CLI has no HTTP_HOST; defaults to false unless UXP_FORCE_LOCAL=1.
 */
function uxp_is_local_dev_request(): bool
{
    if (uxp_env_raw('UXP_FORCE_PRODUCTION') === '1') {
        return false;
    }
    if (uxp_env_raw('UXP_FORCE_LOCAL') === '1') {
        return true;
    }

    $extras = array_filter(array_map('trim', explode(',', uxp_env_raw('UXP_LOCAL_HOSTS', ''))));
    $defaults = ['localhost', '127.0.0.1', '::1', '[::1]'];
    $allowed = array_merge($defaults, $extras);

    foreach (['HTTP_HOST', 'SERVER_NAME'] as $key) {
        $h = strtolower(trim((string) ($_SERVER[$key] ?? '')));
        if ($h === '') {
            continue;
        }
        $h = (string) preg_replace('/:\d+$/', '', $h);
        if ($h !== '' && in_array($h, $allowed, true)) {
            return true;
        }
    }

    return false;
}

/**
 * Read DB_* (or UXP_DB_*) from $_ENV / getenv.
 */
function uxp_env_db(string $key, string $default = ''): string
{
    foreach ([$key, 'UXP_' . $key] as $k) {
        if (isset($_ENV[$k]) && $_ENV[$k] !== '') {
            return (string) $_ENV[$k];
        }
        $v = getenv($k);
        if ($v !== false && $v !== '') {
            return (string) $v;
        }
    }

    return $default;
}

/**
 * @return array{host: string, port: string, database: string, username: string, password: string, charset: string}|null
 */
function uxp_db_credentials(): ?array
{
    uxp_boot_database_config();

    // Never hardcode DB name, user, or password — live cPanel values must come only from .env (see .env.example).
    $host = trim(uxp_env_db('DB_HOST', '') ?: 'localhost');
    $port = trim(uxp_env_db('DB_PORT', '') ?: '3306');
    $database = trim(uxp_env_db('DB_NAME', ''));
    $username = trim(uxp_env_db('DB_USER', ''));
    $password = (string) uxp_env_db('DB_PASS', '');
    $charset = trim(uxp_env_db('DB_CHARSET', '') ?: 'utf8mb4');

    if (uxp_is_local_dev_request()) {
        if (trim(uxp_env_db('DB_HOST_LOCAL', '')) !== '') {
            $host = trim(uxp_env_db('DB_HOST_LOCAL'));
        }
        if (trim(uxp_env_db('DB_PORT_LOCAL', '')) !== '') {
            $port = trim(uxp_env_db('DB_PORT_LOCAL'));
        }
        if (trim(uxp_env_db('DB_NAME_LOCAL', '')) !== '') {
            $database = trim(uxp_env_db('DB_NAME_LOCAL'));
        }
        if (trim(uxp_env_db('DB_USER_LOCAL', '')) !== '') {
            $username = trim(uxp_env_db('DB_USER_LOCAL'));
        }
        if (uxp_env_db('DB_PASS_LOCAL', '') !== '') {
            $password = (string) uxp_env_db('DB_PASS_LOCAL', '');
        }
    }

    if ($database === '' || $username === '') {
        return null;
    }

    return [
        'host' => $host,
        'port' => $port,
        'database' => $database,
        'username' => $username,
        'password' => $password,
        'charset' => $charset,
    ];
}
