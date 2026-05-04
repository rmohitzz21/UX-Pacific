<?php
// Auto-detect environment: local XAMPP vs live server
$host = $_SERVER['HTTP_HOST'] ?? '';
if ($host === 'localhost' || $host === '127.0.0.1' || str_starts_with($host, 'localhost:')) {
    define('BASE_URL', '/UX_Pacific');
} else {
    define('BASE_URL', '');
}




// Default SEO values (fallbacks)
$pageTitle    = $pageTitle ?? 'UX Pacific';
$pageDesc     = $pageDesc ?? 'UX Pacific is a UI UX design agency delivering modern digital experiences for startups and businesses.';
$metaRobots   = $metaRobots ?? 'index, follow';
$canonicalUrl = $canonicalUrl ?? '';

// Open Graph defaults
$ogTitle = $ogTitle ?? $pageTitle;
$ogDesc  = $ogDesc ?? $pageDesc;
$ogUrl   = $ogUrl ?? $canonicalUrl;

// Favicon default
$favicon = $favicon ?? 'img/Final.png';

?>