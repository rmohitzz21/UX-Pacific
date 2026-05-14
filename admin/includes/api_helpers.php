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
