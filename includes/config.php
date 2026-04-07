<?php
// Auto-detect environment: local XAMPP vs live server
$host = $_SERVER['HTTP_HOST'] ?? '';
if ($host === 'localhost' || $host === '127.0.0.1' || str_starts_with($host, 'localhost:')) {
    define('BASE_URL', '/UX_Pacific');
} else {
    define('BASE_URL', '');
}
