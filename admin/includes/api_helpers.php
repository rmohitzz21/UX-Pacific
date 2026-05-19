<?php
/**
 * Admin API Helper Functions
 * 
 * Provides secure, consistent API response handling.
 */
declare(strict_types=1);

/**
 * Send a JSON error response without exposing internal details.
 * Logs the actual error server-side for debugging.
 * 
 * @param string $publicMessage Message safe to show to users
 * @param int $statusCode HTTP status code
 * @param Throwable|null $exception Optional exception to log (not exposed to client)
 */
function apiError(string $publicMessage, int $statusCode = 500, ?Throwable $exception = null): void
{
    if ($exception !== null) {
        error_log(sprintf(
            '[Admin API Error] %s | Exception: %s in %s:%d',
            $publicMessage,
            $exception->getMessage(),
            $exception->getFile(),
            $exception->getLine()
        ));
    }
    
    http_response_code($statusCode);
    echo json_encode(['error' => $publicMessage]);
    exit;
}

/**
 * Send a JSON success response.
 * 
 * @param array $data Data to include in response
 * @param int $statusCode HTTP status code (default 200)
 */
function apiSuccess(array $data, int $statusCode = 200): void
{
    http_response_code($statusCode);
    echo json_encode($data);
    exit;
}

/**
 * Safely handle database operations with proper error handling.
 * 
 * @param callable $operation Database operation to execute
 * @param string $errorMessage Public error message if operation fails
 * @return mixed Result of the operation
 */
function safeDbOperation(callable $operation, string $errorMessage = 'Database operation failed.')
{
    try {
        return $operation();
    } catch (PDOException $e) {
        apiError($errorMessage, 500, $e);
    }
}

/**
 * Validate that required fields exist in data array.
 * 
 * @param array $data Input data
 * @param array $required Required field names
 * @param string|null $errorMessage Custom error message
 * @return bool True if all required fields present
 */
function validateRequired(array $data, array $required, ?string $errorMessage = null): bool
{
    foreach ($required as $field) {
        if (!isset($data[$field]) || (is_string($data[$field]) && trim($data[$field]) === '')) {
            $msg = $errorMessage ?? "Required field missing: $field";
            apiError($msg, 400);
        }
    }
    return true;
}

/**
 * Decode a JSON request body as an associative array.
 *
 * @return array<string, mixed>
 */
function apiJsonBody(): array
{
    $raw = file_get_contents('php://input');
    $data = json_decode($raw === false ? '' : $raw, true);
    if (!is_array($data)) {
        apiError('Invalid JSON data.', 400);
    }

    return $data;
}

function apiTrimString(mixed $value, int $maxLength = 500): string
{
    $value = trim((string) $value);
    if ($maxLength > 0 && strlen($value) > $maxLength) {
        $value = substr($value, 0, $maxLength);
    }

    return $value;
}

function apiRequiredString(array $data, string $key, string $label, int $maxLength = 500): string
{
    $value = apiTrimString($data[$key] ?? '', $maxLength);
    if ($value === '') {
        apiError($label . ' is required.', 400);
    }

    return $value;
}

function apiOptionalString(array $data, string $key, int $maxLength = 500): ?string
{
    if (!array_key_exists($key, $data)) {
        return null;
    }
    $value = apiTrimString($data[$key], $maxLength);

    return $value === '' ? null : $value;
}

function apiBooleanInt(mixed $value, int $default = 0): int
{
    if ($value === null || $value === '') {
        return $default ? 1 : 0;
    }
    if (is_bool($value)) {
        return $value ? 1 : 0;
    }
    if (is_numeric($value)) {
        return ((int) $value) === 1 ? 1 : 0;
    }
    $v = strtolower(trim((string) $value));

    return in_array($v, ['1', 'true', 'yes', 'on'], true) ? 1 : 0;
}

function apiIntInRange(mixed $value, int $default, int $min, int $max): int
{
    $n = is_numeric($value) ? (int) $value : $default;
    if ($n < $min) {
        return $min;
    }
    if ($n > $max) {
        return $max;
    }

    return $n;
}

/**
 * @param list<string> $allowed
 */
function apiEnum(mixed $value, array $allowed, string $default): string
{
    $v = strtolower(trim((string) $value));

    return in_array($v, $allowed, true) ? $v : $default;
}

function apiSlug(string $value, string $fallback): string
{
    $source = $value !== '' ? $value : $fallback;
    $slug = strtolower(trim((string) preg_replace('/[^a-z0-9-]+/i', '-', $source), '-'));

    return $slug === '' ? 'item' : substr($slug, 0, 255);
}

function apiOptionalHttpUrl(?string $url, string $label = 'URL'): ?string
{
    $url = trim((string) $url);
    if ($url === '') {
        return null;
    }
    if (!filter_var($url, FILTER_VALIDATE_URL)) {
        apiError($label . ' must be a valid URL.', 400);
    }
    $scheme = strtolower((string) parse_url($url, PHP_URL_SCHEME));
    if (!in_array($scheme, ['http', 'https'], true)) {
        apiError($label . ' must start with http:// or https://.', 400);
    }

    return $url;
}

function apiStoredMediaUrl(?string $url, string $label = 'Image'): ?string
{
    $url = trim((string) $url);
    if ($url === '') {
        return null;
    }
    $lower = strtolower($url);
    if (str_starts_with($lower, 'javascript:') || str_starts_with($lower, 'data:') || str_starts_with($lower, 'vbscript:')) {
        apiError($label . ' path is not allowed.', 400);
    }
    if (preg_match('#^https?://#i', $url)) {
        return apiOptionalHttpUrl($url, $label);
    }
    $path = str_replace('\\', '/', $url);
    if (str_contains($path, '..')) {
        apiError($label . ' path is not allowed.', 400);
    }
    if (!preg_match('#^/?(?:[A-Za-z0-9._~%-]+/)*[A-Za-z0-9._~%-]+\.(?:jpe?g|png|gif|webp|ico)$#i', $path)) {
        apiError($label . ' must be an uploaded image path or http(s) image URL.', 400);
    }

    return $url;
}

/**
 * @return list<string>
 */
function apiStringList(mixed $value, int $maxItems = 20, int $maxLength = 180): array
{
    if (!is_array($value)) {
        return [];
    }
    $out = [];
    foreach ($value as $item) {
        $s = apiTrimString($item, $maxLength);
        if ($s !== '') {
            $out[] = $s;
        }
        if (count($out) >= $maxItems) {
            break;
        }
    }

    return $out;
}
