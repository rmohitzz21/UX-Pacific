<?php
require_once __DIR__ . '/includes/cms_repository.php';
$countrySlug       = 'melbourne-australia';
$featuredProjects  = get_published_projects('all', true);
$ecosystemHomeItems = get_published_ecosystem();
function home_image_url(?string $url): string {
  $url = trim((string) $url);
  if ($url === '') return uxp_normalize_stored_media_url('img/ux.webp');
  if (preg_match('#^https?://#i', $url)) return $url;
  return uxp_normalize_stored_media_url($url);
}
$pageTitle    = 'UI UX Design Agency in Melbourne, Australia | UX Pacific';
$pageDesc     = 'UX Pacific delivers expert UI/UX design services in Melbourne, Australia. We create user-friendly digital experiences for businesses. We create user-friendly digital experiences for businesses.';
$canonicalUrl = 'https://www.uxpacific.com/ui-ux-design-agency-in-melbourne-australia';
$ogTitle      = $pageTitle;
$ogDesc       = $pageDesc;
$ogUrl        = $canonicalUrl;
$currentPage  = 'Home';
$geoPage = uxp_geo_page($countrySlug);
if ($geoPage) {
  if (!empty($geoPage['page_title']))       { $pageTitle = $geoPage['page_title']; $ogTitle = $pageTitle; }
  if (!empty($geoPage['meta_description'])) { $pageDesc  = $geoPage['meta_description']; $ogDesc = $pageDesc; }
}
?>
<!DOCTYPE html><html lang="en"><head><?php include 'includes/head.php'; ?></head><body>
<?php include 'includes/navbar.php'; ?>
<div class="hero-wrapper" style="position:relative;overflow:hidden"><canvas id="interactive-canvas" style="position:absolute;top:0;left:0;width:100%;height:100%;z-index:0;"></canvas><div class="custom-cursor"></div><section class="hero"><h1 id="heading">WE CRAFT UX THAT MAKES THEM<br /><span style="font-weight:200">STAY, ENGAGE, <span style="font-weight:800">AND</span> CONVERT.</span></h1><p class="subtext">Designing Experiences, Not Just Interfaces</p><br /><a class="btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#auditModal" style="width:210px;height:42px;margin-top:0;padding-left:27px;">Book a UX Audit <span class="arrow"> </span></a></section></div>
<div class="ux-content mt-5 mb-3"><h3 class="ux-subtitle" style="margin-top:50px">About Us <span class="ux-line"> </span></h3><h2 class="ux-title">Where Strategy Meets <span class="highlight"> Stunning </span> Design</h2><p class="ux-description">We're a creative UX/UI design studio passionate about building human-centered digital products.</p><a class="view-more" href="/about"> View More &rarr; </a><br /></div>
<?php include 'includes/loc-section.php'; ?>
<?php include 'includes/footer.php'; ?>
<?php include 'includes/scripts.php'; ?>
</body></html>


