<?php
/**
 * generate-sitemap.php
 *
 * Generates:
 *   sitemap.xml                (sitemap index)
 *   sitemap-core.xml           (homepage, about, services, etc.)
 *   sitemap-locations-1.xml … sitemap-locations-N.xml  (batches of 1,000)
 *
 * CLI:  php generate-sitemap.php
 * Web:  https://www.uxpacific.com/generate-sitemap.php?key=uxp_sitemap_2026
 */

// ── Config ───────────────────────────────────────────────────────────────────
const SITEMAP_KEY  = 'uxp_sitemap_2026';
const BASE_URL     = 'https://www.uxpacific.com';
const BATCH_SIZE   = 1000;

// ── Auth (web access) ────────────────────────────────────────────────────────
if (PHP_SAPI !== 'cli') {
    if (empty($_GET['key']) || $_GET['key'] !== SITEMAP_KEY) {
        http_response_code(403);
        exit('403 Forbidden');
    }
    header('Content-Type: text/plain; charset=utf-8');
}

$rootDir = __DIR__;
$today   = date('Y-m-d');
$start   = microtime(true);

require_once $rootDir . '/includes/location_pages.php';

echo "UX Pacific — Sitemap Generator\n";
echo str_repeat('─', 42) . "\n\n";

// ── Helpers ───────────────────────────────────────────────────────────────────

/** Read $pageTitle from a PHP file without loading the whole thing. */
function extractTitle(string $path): string {
    $fh = @fopen($path, 'r');
    if (!$fh) return '';
    $n = 0;
    while (($line = fgets($fh)) !== false && $n++ < 60) {
        if (preg_match("/\\\$pageTitle\s*=\s*'(.+?)'\s*;/", $line, $m)) {
            fclose($fh);
            return trim($m[1]);
        }
    }
    fclose($fh);
    return '';
}

/** Assign sitemap priority from slug keywords and title. */
function locPriority(string $slug, string $title): string {
    static $districtKw = [
        'district','municipality','governorate','prefecture',
        'borough','commune','arrondissement','parish','sub-district',
        'ward','taluk','tehsil','upazila',
    ];
    foreach ($districtKw as $kw) {
        if (strpos($slug, $kw) !== false) return '0.5';
    }
    // Extract the "in X" portion from title
    $locPart = preg_match('/\bin\s+(.+?)\s*\|/i', $title, $m) ? trim($m[1]) : '';
    // No comma → country-level page
    return (strpos($locPart, ',') === false && $locPart !== '') ? '0.8' : '0.6';
}

/** Build a <urlset> XML string from an array of URL entries. */
function buildUrlset(array $urls): string {
    $x  = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    $x .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"'
        . ' xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"'
        . ' xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9'
        . ' http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' . "\n";
    foreach ($urls as $u) {
        $x .= "  <url>\n";
        $x .= '    <loc>' . htmlspecialchars($u['loc'], ENT_XML1, 'UTF-8') . "</loc>\n";
        $x .= '    <lastmod>'    . $u['lastmod']    . "</lastmod>\n";
        $x .= '    <changefreq>' . $u['changefreq'] . "</changefreq>\n";
        $x .= '    <priority>'   . $u['priority']   . "</priority>\n";
        $x .= "  </url>\n";
    }
    $x .= '</urlset>';
    return $x;
}

// ── Core pages ────────────────────────────────────────────────────────────────
$rawCore = [
    ['path' => '/',          'pri' => '1.0', 'freq' => 'weekly'],
    ['path' => '/about',     'pri' => '0.9', 'freq' => 'monthly'],
    ['path' => '/service',   'pri' => '0.9', 'freq' => 'monthly'],
    ['path' => '/work',      'pri' => '0.8', 'freq' => 'monthly'],
    ['path' => '/contact',   'pri' => '0.8', 'freq' => 'monthly'],
    ['path' => '/faq',       'pri' => '0.7', 'freq' => 'monthly'],
    ['path' => '/site-index', 'pri' => '0.8', 'freq' => 'weekly'],
    ['path' => '/blog',      'pri' => '0.7', 'freq' => 'weekly'],
    ['path' => '/pricing',   'pri' => '0.7', 'freq' => 'monthly'],
    ['path' => '/careers',   'pri' => '0.6', 'freq' => 'monthly'],
];

$coreUrls = [];
foreach ($rawCore as $c) {
    $file = $rootDir . rtrim($c['path'], '/') . '.php';
    // homepage check
    if ($c['path'] === '/') $file = $rootDir . '/index.php';
    if (!file_exists($file)) continue;
    $coreUrls[] = [
        'loc'        => BASE_URL . $c['path'],
        'lastmod'    => $today,
        'changefreq' => $c['freq'],
        'priority'   => $c['pri'],
    ];
}

// ── Scan location pages ───────────────────────────────────────────────────────
$locFiles = glob($rootDir . '/ui-ux-design-agency-in-*.php');
sort($locFiles);

$locUrls = [];
$priCount = ['0.8' => 0, '0.6' => 0, '0.5' => 0];

echo "Scanning " . count($locFiles) . " location pages…\n";

foreach ($locFiles as $fp) {
    $base  = basename($fp, '.php');
    $slug  = substr($base, strlen('ui-ux-design-agency-in-'));
    $title = extractTitle($fp);
    $pri   = locPriority($slug, $title);

    $locUrls[] = [
        'loc'        => BASE_URL . '/' . $base,
        'lastmod'    => $today,
        'changefreq' => 'monthly',
        'priority'   => $pri,
    ];

    if (isset($priCount[$pri])) $priCount[$pri]++;
}

// ── Write sitemap-core.xml ────────────────────────────────────────────────────
$written = [];

file_put_contents($rootDir . '/sitemap-core.xml', buildUrlset($coreUrls));
$written[] = 'sitemap-core.xml';
echo "  ✓ sitemap-core.xml — " . count($coreUrls) . " URLs\n";

// ── Write location sitemaps in batches ────────────────────────────────────────
$batches = array_chunk($locUrls, BATCH_SIZE);
foreach ($batches as $i => $batch) {
    $name = 'sitemap-locations-' . ($i + 1) . '.xml';
    file_put_contents($rootDir . '/' . $name, buildUrlset($batch));
    $written[] = $name;
    echo "  ✓ $name — " . count($batch) . " URLs\n";
}

// ── Write sitemap index ───────────────────────────────────────────────────────
$idx  = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
$idx .= '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
foreach ($written as $sf) {
    $idx .= "  <sitemap>\n";
    $idx .= '    <loc>' . BASE_URL . '/' . $sf . "</loc>\n";
    $idx .= "    <lastmod>$today</lastmod>\n";
    $idx .= "  </sitemap>\n";
}
$idx .= '</sitemapindex>';
file_put_contents($rootDir . '/sitemap.xml', $idx);

// ── Write footer location index JSON ─────────────────────────────────────────
$indexCount = uxp_write_location_pages_index($rootDir);
echo "  ✓ data/location-pages.json — $indexCount pages\n";

// ── Summary ───────────────────────────────────────────────────────────────────
$elapsed = round(microtime(true) - $start, 1);
$total   = count($coreUrls) + count($locUrls);

echo "\n" . str_repeat('═', 42) . "\n";
echo "Sitemap generation complete in {$elapsed}s\n";
echo str_repeat('─', 42) . "\n";
printf("  Total URLs            : %d\n", $total);
printf("  Core pages            : %d\n", count($coreUrls));
printf("  Location pages        : %d\n", count($locUrls));
printf("  ↳ Country (0.8)       : %d\n", $priCount['0.8']);
printf("  ↳ State/City (0.6)    : %d\n", $priCount['0.6']);
printf("  ↳ District (0.5)      : %d\n", $priCount['0.5']);
printf("  Location sitemaps     : %d\n", count($batches));
printf("  Files written         : %d\n", count($written) + 1);
echo str_repeat('─', 42) . "\n";
echo "  → Submit sitemap.xml to Google Search Console\n";
echo "  → URL: " . BASE_URL . "/sitemap.xml\n";
echo str_repeat('═', 42) . "\n";
