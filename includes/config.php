<?php
require_once __DIR__ . '/paths.php';

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
$favicon = $favicon ?? 'img/fav.png';

?>