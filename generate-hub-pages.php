<?php
/**
 * generate-hub-pages.php
 *
 * 1. Reads all 5,135 ui-ux-design-agency-in-*.php files
 * 2. Groups them by country (parsed from $pageTitle)
 * 3. Generates country-level hub pages that list all child locations
 * 4. Generates state-level hub pages for countries with many regions
 *
 * CLI:  php generate-hub-pages.php [--force] [--country=australia]
 * Web:  https://www.uxpacific.com/generate-hub-pages.php?key=uxp_hub_2026[&force=1][&country=australia]
 */

const HUB_KEY  = 'uxp_hub_2026';
const BASE_URL = 'https://www.uxpacific.com';

// ── Auth ─────────────────────────────────────────────────────────────────────
$isCli = PHP_SAPI === 'cli';
if (!$isCli) {
    if (empty($_GET['key']) || $_GET['key'] !== HUB_KEY) {
        http_response_code(403); exit('403 Forbidden');
    }
    header('Content-Type: text/plain; charset=utf-8');
}

// ── Args ─────────────────────────────────────────────────────────────────────
$force         = $isCli ? in_array('--force', $argv) : !empty($_GET['force']);
$filterCountry = '';
if ($isCli) {
    foreach ($argv as $arg) {
        if (strpos($arg, '--country=') === 0) {
            $filterCountry = strtolower(trim(substr($arg, 10)));
        }
    }
} elseif (!empty($_GET['country'])) {
    $filterCountry = strtolower(trim($_GET['country']));
}

$rootDir = __DIR__;
$start   = microtime(true);

echo "UX Pacific — Hub Page Generator\n";
echo str_repeat('─', 44) . "\n\n";

// ── Helpers ───────────────────────────────────────────────────────────────────

function readTitle(string $path): string {
    $fh = @fopen($path, 'r'); if (!$fh) return '';
    $n  = 0;
    while (($line = fgets($fh)) !== false && $n++ < 60) {
        if (preg_match("/\\\$pageTitle\s*=\s*'(.+?)'\s*;/", $line, $m)) {
            fclose($fh); return trim($m[1]);
        }
    }
    fclose($fh); return '';
}

function toSlug(string $name): string {
    $s = strtolower(trim($name));
    $s = preg_replace('/[^a-z0-9]+/', '-', $s);
    return trim($s, '-');
}

function fmtName(string $slug): string {
    return ucwords(str_replace('-', ' ', $slug));
}

// ── Step 1: Parse all location files and group by country ────────────────────
echo "Scanning location pages…\n";
$locFiles = glob($rootDir . '/ui-ux-design-agency-in-*.php');
sort($locFiles);

// Map: country_slug → [ ['name' => 'Aargau', 'basename' => 'ui-ux…', 'title' => '…'], … ]
$byCountry = [];
$skipped   = 0;

foreach ($locFiles as $fp) {
    $base  = basename($fp, '.php');
    $slug  = substr($base, strlen('ui-ux-design-agency-in-'));
    $title = readTitle($fp);

    // Extract location from title: "UI UX Design Agency in X | UX Pacific"
    if (!preg_match('/\bin\s+(.+?)\s*\|/i', $title, $m)) { $skipped++; continue; }
    $locName = trim($m[1]);

    // Split on last comma to get city/state + country
    $comma = strrpos($locName, ',');
    if ($comma !== false) {
        $regionName  = trim(substr($locName, 0, $comma));
        $countryName = trim(substr($locName, $comma + 1));
    } else {
        // No comma → this IS a country-level page; mark as hub candidate
        $regionName  = $locName;
        $countryName = $locName;
    }

    $countrySlug = toSlug($countryName);

    if ($filterCountry && $countrySlug !== $filterCountry) continue;

    if (!isset($byCountry[$countrySlug])) {
        $byCountry[$countrySlug] = ['name' => $countryName, 'children' => []];
    }
    // Skip adding a country page to its own children
    if (strtolower($regionName) !== strtolower($countryName)) {
        $byCountry[$countrySlug]['children'][] = [
            'name'     => $regionName,
            'basename' => $base,
            'url'      => '/' . $base,
        ];
    }
}

$countries = count($byCountry);
echo "  Found $countries countries with child locations.\n";
echo "  Skipped (no title): $skipped\n\n";

// ── Step 2: Generate country hub pages ───────────────────────────────────────

function buildHubPage(
    string $countrySlug,
    string $countryName,
    array  $children,
    string $today
): string {

    $pageSlug    = 'ui-ux-design-agency-in-' . $countrySlug;
    $canonical   = BASE_URL . '/' . $pageSlug;
    $pageTitle   = 'UI UX Design Agency in ' . $countryName . ' | UX Pacific';
    $pageDesc    = 'UX Pacific delivers expert UI/UX design services across ' . $countryName
                 . '. Browse our locations or book a free UX audit today.';

    // Build child listing PHP snippet
    $childrenPhp = "[\n";
    foreach ($children as $c) {
        $name     = addslashes($c['name']);
        $url      = addslashes($c['url']);
        $basename = addslashes($c['basename']);
        $childrenPhp .= "  ['name' => '$name', 'url' => '$url', 'basename' => '$basename'],\n";
    }
    $childrenPhp .= "]";

    // Child count info for meta
    $childCount = count($children);

    $content = <<<PHPEOF
<?php
require_once __DIR__ . '/includes/cms_repository.php';

\$countrySlug = '$countrySlug';

\$featuredProjects   = get_published_projects('all', true);
\$ecosystemHomeItems = get_published_ecosystem();

function home_image_url(?string \$url): string {
  \$url = trim((string) \$url);
  if (\$url === '') return uxp_normalize_stored_media_url('img/ux.webp');
  if (preg_match('#^https?://#i', \$url)) return \$url;
  return uxp_normalize_stored_media_url(\$url);
}

\$pageTitle   = '$pageTitle';
\$pageDesc    = '$pageDesc';
\$canonicalUrl = '$canonical';
\$ogTitle     = '$pageTitle';
\$ogDesc      = '$pageDesc';
\$ogUrl       = '$canonical';
\$currentPage = 'Home';

// Schema: WebPage + BreadcrumbList
\$ldJson = json_encode([
  '@context' => 'https://schema.org',
  '@graph'   => [
    ['@type' => 'WebPage',
     'url'   => '$canonical',
     'name'  => '$pageTitle',
     'inLanguage' => 'en',
    ],
    ['@type' => 'BreadcrumbList',
     'itemListElement' => [
       ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home',       'item' => BASE_URL . '/'],
       ['@type' => 'ListItem', 'position' => 2, 'name' => '$countryName', 'item' => '$canonical'],
     ],
    ],
  ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

\$geoPage = uxp_geo_page(\$countrySlug);
if (\$geoPage) {
  if (!empty(\$geoPage['page_title']))      { \$pageTitle = (string) \$geoPage['page_title']; \$ogTitle = \$pageTitle; }
  if (!empty(\$geoPage['meta_description'])) { \$pageDesc  = (string) \$geoPage['meta_description']; \$ogDesc = \$pageDesc; }
}

// Child locations in $countryName
\$hubChildren = $childrenPhp;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include 'includes/head.php'; ?>
  </head>
  <body>
    <?php include 'includes/navbar.php'; ?>

    <div class="hero-wrapper" style="position:relative;overflow:hidden">
      <canvas id="interactive-canvas" style="position:absolute;top:0;left:0;width:100%;height:100%;z-index:0;"></canvas>
      <div class="custom-cursor"></div>
      <section class="hero">
        <h1 id="heading">WE CRAFT UX THAT MAKES THEM<br /><span style="font-weight:200">STAY, ENGAGE, <span style="font-weight:800">AND</span> CONVERT.</span></h1>
        <p class="subtext">Designing Experiences, Not Just Interfaces</p><br />
        <a class="btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#auditModal" style="width:210px;height:42px;margin-top:0;padding-left:27px;">Book a UX Audit <span class="arrow"> </span></a>
        <br /><br /><br /><br /><br />
        <div class="ux-header">
          <span class="ux-badg"> </span>
          <div class="scroller"><ul class="scroller__inner"><li class="scroller__item">SIMPLE</li><li class="scroller__item">INTENTIONAL</li><li class="scroller__item">HUMAN</li><li class="scroller__item">SCALABLE</li><li class="scroller__item">SMART</li><li class="scroller__item">EMPATHETIC</li><li class="scroller__item">MEASURED</li><li class="scroller__item">IMPACTFUL</li><li class="scroller__item">ACCESSIBLE</li></ul></div>
          <span class="ux-end"> </span>
        </div>
      </section>
    </div>

    <div class="ux-content mt-5 mb-3">
      <h3 class="ux-subtitle" style="margin-top:50px">About Us <span class="ux-line"> </span></h3>
      <h2 class="ux-title">Where Strategy Meets <span class="highlight"> Stunning </span> Design</h2>
      <p class="ux-description">We're a creative UX/UI design studio passionate about building human-centered digital products that inspire, engage, and perform.</p>
      <a class="view-more" href="/about"> View More &rarr; </a><br />
    </div>

    <?php include 'includes/loc-section.php'; ?>

    <!-- ── Hub: Browse all regions in $countryName ── -->
    <?php if (!empty(\$hubChildren)): ?>
    <style>
      .hub-section{max-width:1000px;margin:0 auto;padding:0 20px 60px}
      .hub-section h2{font-size:clamp(1.2rem,2.5vw,1.7rem);font-weight:700;color:#f0eeff;margin-bottom:.5rem}
      .hub-section .hub-sub{color:rgba(200,200,220,.7);font-size:.9rem;margin-bottom:1.75rem}
      .hub-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:.85rem}
      .hub-card{display:flex;align-items:center;justify-content:space-between;background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.08);border-radius:9px;padding:.75rem 1rem;text-decoration:none;color:#d4c7ff;font-size:.875rem;font-weight:500;transition:border-color .25s,background .25s,color .25s}
      .hub-card:hover{border-color:#a78bfa;background:rgba(97,71,189,.1);color:#fff}
      .hub-card .hub-arrow{font-size:.75rem;opacity:.5;transition:opacity .25s,transform .25s}
      .hub-card:hover .hub-arrow{opacity:1;transform:translateX(3px)}
    </style>
    <div class="hub-section">
      <h2>Browse UI/UX Design Services Across $countryName</h2>
      <p class="hub-sub">We serve $childCount regions, states, and cities in $countryName. Select a location to see how UX Pacific can help your business.</p>
      <div class="hub-grid">
        <?php foreach (\$hubChildren as \$hc): ?>
        <a href="<?= htmlspecialchars(\$hc['url'], ENT_QUOTES, 'UTF-8') ?>" class="hub-card">
          <span><?= htmlspecialchars(\$hc['name'], ENT_QUOTES, 'UTF-8') ?></span>
          <span class="hub-arrow">&#8250;</span>
        </a>
        <?php endforeach; ?>
      </div>
    </div>
    <?php endif; ?>

    <?php include 'includes/footer.php'; ?>
    <?php include 'includes/scripts.php'; ?>

    <!-- UX Audit Modal -->
    <div class="modal fade" id="auditModal" tabindex="-1" aria-hidden="true" style="backdrop-filter:blur(8px);background-color:rgba(0,0,0,0.6);z-index:2200;" data-bs-backdrop="true">
      <div class="modal-dialog modal-dialog-centered" style="max-width:500px;">
        <div class="modal-content" style="background:rgba(17,17,17,0.95);border:1px solid #2e2e3e;border-radius:20px;overflow:hidden;box-shadow:0 24px 80px rgba(0,0,0,0.8);">
          <div class="modal-header border-0 pb-0 d-flex justify-content-between align-items-center" style="padding:24px 32px 0;">
            <h4 class="modal-title" style="color:#fff;font-weight:700;font-size:24px;">Book a UX Audit</h4>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" style="opacity:0.5;"></button>
          </div>
          <div class="modal-body" style="padding:24px 32px 36px;">
            <p style="color:#b2bad6;font-size:14px;margin-bottom:24px;">Fill out the details below and we will get back to you shortly.</p>
            <form id="auditForm" class="contact-form" action="send" method="post">
              <input type="hidden" name="form_type" value="ux_audit">
              <input type="text" name="company_website" id="audit_company_website" value="" tabindex="-1" autocomplete="off" aria-hidden="true" style="position:absolute;left:-10000px;top:auto;width:1px;height:1px;overflow:hidden;">
              <input type="hidden" name="form_started_at" id="audit_form_started_at" value="">
              <div class="contact-row d-flex flex-column" style="gap:16px;">
                <div class="contact-field" style="display:flex;flex-direction:column;gap:6px;"><label for="auditName" style="font-size:15px;color:#b2bad6;">Name</label><input id="auditName" name="name" type="text" placeholder="Your name" style="height:56px;width:100%;background:#151515;border:1px solid #2e2e3e;border-radius:6px;color:#eee;padding:16px 20px;font-size:1rem;outline:none;" onfocus="this.style.borderColor='#6147bd'" onblur="this.style.borderColor='#2e2e3e'"></div>
                <div class="contact-field" style="display:flex;flex-direction:column;gap:6px;"><label for="auditEmail" style="font-size:15px;color:#b2bad6;">Email</label><input id="auditEmail" name="email" type="email" placeholder="Your email address" style="height:56px;width:100%;background:#151515;border:1px solid #2e2e3e;border-radius:6px;color:#eee;padding:16px 20px;font-size:1rem;outline:none;" onfocus="this.style.borderColor='#6147bd'" onblur="this.style.borderColor='#2e2e3e'"></div>
                <div class="contact-field" style="display:flex;flex-direction:column;gap:6px;"><label for="auditUrl" style="font-size:15px;color:#b2bad6;">Website URL</label><input id="auditUrl" name="url" type="text" placeholder="https://yourwebsite.com" style="height:56px;width:100%;background:#151515;border:1px solid #2e2e3e;border-radius:6px;color:#eee;padding:16px 20px;font-size:1rem;outline:none;" onfocus="this.style.borderColor='#6147bd'" onblur="this.style.borderColor='#2e2e3e'"></div>
              </div>
              <div id="auditError" style="display:none;margin-top:12px;color:#f87171;font-size:14px;text-align:center;"></div>
              <div class="contact-submit text-center mt-4 pt-2">
                <button id="auditSubmitBtn" type="submit" style="background-color:#6147bd;border:none;padding:12px 40px;border-radius:50px;color:#fff;font-weight:500;font-size:16px;width:100%;height:50px;cursor:pointer;">Submit Request</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
PHPEOF;

    return $content;
}

// ── Step 3: Write hub files ───────────────────────────────────────────────────
$created  = 0;
$skippedE = 0; // already exists
$today    = date('Y-m-d');

foreach ($byCountry as $countrySlug => $data) {
    if (count($data['children']) < 2) continue; // skip countries with only 1 region

    $hubFile = $rootDir . '/ui-ux-design-agency-in-' . $countrySlug . '.php';

    if (file_exists($hubFile) && !$force) {
        $skippedE++;
        continue;
    }

    $php = buildHubPage($countrySlug, $data['name'], $data['children'], $today);
    file_put_contents($hubFile, $php);
    $created++;
    echo "  [NEW] ui-ux-design-agency-in-{$countrySlug}.php ({$data['name']}, " . count($data['children']) . " regions)\n";
}

// ── Summary ───────────────────────────────────────────────────────────────────
$elapsed = round(microtime(true) - $start, 1);
echo "\n" . str_repeat('═', 44) . "\n";
echo "Hub page generation complete in {$elapsed}s\n";
echo str_repeat('─', 44) . "\n";
printf("  Countries found      : %d\n", $countries);
printf("  Hub pages created    : %d\n", $created);
printf("  Skipped (exists)     : %d  (use --force to overwrite)\n", $skippedE);
echo str_repeat('─', 44) . "\n";
echo "  Next: run generate-sitemap.php to include hub pages\n";
echo str_repeat('═', 44) . "\n";
