<?php
require_once __DIR__ . '/includes/cms_repository.php';

$countrySlug = 'morocco';

$featuredProjects   = get_published_projects('all', true);
$ecosystemHomeItems = get_published_ecosystem();

function home_image_url(?string $url): string {
  $url = trim((string) $url);
  if ($url === '') return uxp_normalize_stored_media_url('img/ux.webp');
  if (preg_match('#^https?://#i', $url)) return $url;
  return uxp_normalize_stored_media_url($url);
}

$pageTitle   = 'UI UX Design Agency in Morocco | UX Pacific';
$pageDesc    = 'UX Pacific delivers expert UI/UX design services across Morocco. Browse our locations or book a free UX audit today.';
$canonicalUrl = 'https://www.uxpacific.com/ui-ux-design-agency-in-morocco';
$ogTitle     = 'UI UX Design Agency in Morocco | UX Pacific';
$ogDesc      = 'UX Pacific delivers expert UI/UX design services across Morocco. Browse our locations or book a free UX audit today.';
$ogUrl       = 'https://www.uxpacific.com/ui-ux-design-agency-in-morocco';
$currentPage = 'Home';

// Schema: WebPage + BreadcrumbList
$ldJson = json_encode([
  '@context' => 'https://schema.org',
  '@graph'   => [
    ['@type' => 'WebPage',
     'url'   => 'https://www.uxpacific.com/ui-ux-design-agency-in-morocco',
     'name'  => 'UI UX Design Agency in Morocco | UX Pacific',
     'inLanguage' => 'en',
    ],
    ['@type' => 'BreadcrumbList',
     'itemListElement' => [
       ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home',       'item' => BASE_URL . '/'],
       ['@type' => 'ListItem', 'position' => 2, 'name' => 'Morocco', 'item' => 'https://www.uxpacific.com/ui-ux-design-agency-in-morocco'],
     ],
    ],
  ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

$geoPage = uxp_geo_page($countrySlug);
if ($geoPage) {
  if (!empty($geoPage['page_title']))      { $pageTitle = (string) $geoPage['page_title']; $ogTitle = $pageTitle; }
  if (!empty($geoPage['meta_description'])) { $pageDesc  = (string) $geoPage['meta_description']; $ogDesc = $pageDesc; }
}

// Child locations in Morocco
$hubChildren = [
  ['name' => 'Agadir-Ida-Ou-Tanane', 'url' => '/ui-ux-design-agency-in-agadir-ida-ou-tanane-morocco', 'basename' => 'ui-ux-design-agency-in-agadir-ida-ou-tanane-morocco'],
  ['name' => 'Al Haouz', 'url' => '/ui-ux-design-agency-in-al-haouz-morocco', 'basename' => 'ui-ux-design-agency-in-al-haouz-morocco'],
  ['name' => 'Al Hoceïma', 'url' => '/ui-ux-design-agency-in-al-hoceima-morocco', 'basename' => 'ui-ux-design-agency-in-al-hoceima-morocco'],
  ['name' => 'Aousserd (EH)', 'url' => '/ui-ux-design-agency-in-aousserd-eh-morocco', 'basename' => 'ui-ux-design-agency-in-aousserd-eh-morocco'],
  ['name' => 'Assa-Zag (EH-partial)', 'url' => '/ui-ux-design-agency-in-assa-zag-eh-partial-morocco', 'basename' => 'ui-ux-design-agency-in-assa-zag-eh-partial-morocco'],
  ['name' => 'Azilal', 'url' => '/ui-ux-design-agency-in-azilal-morocco', 'basename' => 'ui-ux-design-agency-in-azilal-morocco'],
  ['name' => 'Béni Mellal-Khénifra', 'url' => '/ui-ux-design-agency-in-beni-mellal-khenifra-morocco', 'basename' => 'ui-ux-design-agency-in-beni-mellal-khenifra-morocco'],
  ['name' => 'Béni Mellal', 'url' => '/ui-ux-design-agency-in-beni-mellal-morocco', 'basename' => 'ui-ux-design-agency-in-beni-mellal-morocco'],
  ['name' => 'Benslimane', 'url' => '/ui-ux-design-agency-in-benslimane-morocco', 'basename' => 'ui-ux-design-agency-in-benslimane-morocco'],
  ['name' => 'Berkane', 'url' => '/ui-ux-design-agency-in-berkane-morocco', 'basename' => 'ui-ux-design-agency-in-berkane-morocco'],
  ['name' => 'Berrechid', 'url' => '/ui-ux-design-agency-in-berrechid-morocco', 'basename' => 'ui-ux-design-agency-in-berrechid-morocco'],
  ['name' => 'Boujdour (EH)', 'url' => '/ui-ux-design-agency-in-boujdour-eh-morocco', 'basename' => 'ui-ux-design-agency-in-boujdour-eh-morocco'],
  ['name' => 'Boulemane', 'url' => '/ui-ux-design-agency-in-boulemane-morocco', 'basename' => 'ui-ux-design-agency-in-boulemane-morocco'],
  ['name' => 'Casablanca', 'url' => '/ui-ux-design-agency-in-casablanca-morocco', 'basename' => 'ui-ux-design-agency-in-casablanca-morocco'],
  ['name' => 'Casablanca-Settat', 'url' => '/ui-ux-design-agency-in-casablanca-settat-morocco', 'basename' => 'ui-ux-design-agency-in-casablanca-settat-morocco'],
  ['name' => 'Chefchaouen', 'url' => '/ui-ux-design-agency-in-chefchaouen-morocco', 'basename' => 'ui-ux-design-agency-in-chefchaouen-morocco'],
  ['name' => 'Chichaoua', 'url' => '/ui-ux-design-agency-in-chichaoua-morocco', 'basename' => 'ui-ux-design-agency-in-chichaoua-morocco'],
  ['name' => 'Chtouka-Ait Baha', 'url' => '/ui-ux-design-agency-in-chtouka-ait-baha-morocco', 'basename' => 'ui-ux-design-agency-in-chtouka-ait-baha-morocco'],
  ['name' => 'Dakhla-Oued Ed-Dahab (EH)', 'url' => '/ui-ux-design-agency-in-dakhla-oued-ed-dahab-eh-morocco', 'basename' => 'ui-ux-design-agency-in-dakhla-oued-ed-dahab-eh-morocco'],
  ['name' => 'Drâa-Tafilalet', 'url' => '/ui-ux-design-agency-in-draa-tafilalet-morocco', 'basename' => 'ui-ux-design-agency-in-draa-tafilalet-morocco'],
  ['name' => 'Driouch', 'url' => '/ui-ux-design-agency-in-driouch-morocco', 'basename' => 'ui-ux-design-agency-in-driouch-morocco'],
  ['name' => 'El Hajeb', 'url' => '/ui-ux-design-agency-in-el-hajeb-morocco', 'basename' => 'ui-ux-design-agency-in-el-hajeb-morocco'],
  ['name' => 'El Jadida', 'url' => '/ui-ux-design-agency-in-el-jadida-morocco', 'basename' => 'ui-ux-design-agency-in-el-jadida-morocco'],
  ['name' => 'El Kelâa des Sraghna', 'url' => '/ui-ux-design-agency-in-el-kelaa-des-sraghna-morocco', 'basename' => 'ui-ux-design-agency-in-el-kelaa-des-sraghna-morocco'],
  ['name' => 'Errachidia', 'url' => '/ui-ux-design-agency-in-errachidia-morocco', 'basename' => 'ui-ux-design-agency-in-errachidia-morocco'],
  ['name' => 'Es-Semara (EH-partial)', 'url' => '/ui-ux-design-agency-in-es-semara-eh-partial-morocco', 'basename' => 'ui-ux-design-agency-in-es-semara-eh-partial-morocco'],
  ['name' => 'Essaouira', 'url' => '/ui-ux-design-agency-in-essaouira-morocco', 'basename' => 'ui-ux-design-agency-in-essaouira-morocco'],
  ['name' => 'Fahs-Anjra', 'url' => '/ui-ux-design-agency-in-fahs-anjra-morocco', 'basename' => 'ui-ux-design-agency-in-fahs-anjra-morocco'],
  ['name' => 'Fès-Meknès', 'url' => '/ui-ux-design-agency-in-fes-meknes-morocco', 'basename' => 'ui-ux-design-agency-in-fes-meknes-morocco'],
  ['name' => 'Fès', 'url' => '/ui-ux-design-agency-in-fes-morocco', 'basename' => 'ui-ux-design-agency-in-fes-morocco'],
  ['name' => 'Figuig', 'url' => '/ui-ux-design-agency-in-figuig-morocco', 'basename' => 'ui-ux-design-agency-in-figuig-morocco'],
  ['name' => 'Fquih Ben Salah', 'url' => '/ui-ux-design-agency-in-fquih-ben-salah-morocco', 'basename' => 'ui-ux-design-agency-in-fquih-ben-salah-morocco'],
  ['name' => 'Guelmim', 'url' => '/ui-ux-design-agency-in-guelmim-morocco', 'basename' => 'ui-ux-design-agency-in-guelmim-morocco'],
  ['name' => 'Guelmim-Oued Noun (EH-partial)', 'url' => '/ui-ux-design-agency-in-guelmim-oued-noun-eh-partial-morocco', 'basename' => 'ui-ux-design-agency-in-guelmim-oued-noun-eh-partial-morocco'],
  ['name' => 'Guercif', 'url' => '/ui-ux-design-agency-in-guercif-morocco', 'basename' => 'ui-ux-design-agency-in-guercif-morocco'],
  ['name' => 'Ifrane', 'url' => '/ui-ux-design-agency-in-ifrane-morocco', 'basename' => 'ui-ux-design-agency-in-ifrane-morocco'],
  ['name' => 'Inezgane-Ait Melloul', 'url' => '/ui-ux-design-agency-in-inezgane-ait-melloul-morocco', 'basename' => 'ui-ux-design-agency-in-inezgane-ait-melloul-morocco'],
  ['name' => 'Jerada', 'url' => '/ui-ux-design-agency-in-jerada-morocco', 'basename' => 'ui-ux-design-agency-in-jerada-morocco'],
  ['name' => 'Kénitra', 'url' => '/ui-ux-design-agency-in-kenitra-morocco', 'basename' => 'ui-ux-design-agency-in-kenitra-morocco'],
  ['name' => 'Khémisset', 'url' => '/ui-ux-design-agency-in-khemisset-morocco', 'basename' => 'ui-ux-design-agency-in-khemisset-morocco'],
  ['name' => 'Khénifra', 'url' => '/ui-ux-design-agency-in-khenifra-morocco', 'basename' => 'ui-ux-design-agency-in-khenifra-morocco'],
  ['name' => 'Khouribga', 'url' => '/ui-ux-design-agency-in-khouribga-morocco', 'basename' => 'ui-ux-design-agency-in-khouribga-morocco'],
  ['name' => 'Laâyoune (EH)', 'url' => '/ui-ux-design-agency-in-laayoune-eh-morocco', 'basename' => 'ui-ux-design-agency-in-laayoune-eh-morocco'],
  ['name' => 'Laâyoune-Sakia El Hamra (EH-partial)', 'url' => '/ui-ux-design-agency-in-laayoune-sakia-el-hamra-eh-partial-morocco', 'basename' => 'ui-ux-design-agency-in-laayoune-sakia-el-hamra-eh-partial-morocco'],
  ['name' => 'Larache', 'url' => '/ui-ux-design-agency-in-larache-morocco', 'basename' => 'ui-ux-design-agency-in-larache-morocco'],
  ['name' => 'L\\\'Oriental', 'url' => '/ui-ux-design-agency-in-loriental-morocco', 'basename' => 'ui-ux-design-agency-in-loriental-morocco'],
  ['name' => 'M’diq-Fnideq', 'url' => '/ui-ux-design-agency-in-m-diq-fnideq-morocco', 'basename' => 'ui-ux-design-agency-in-m-diq-fnideq-morocco'],
  ['name' => 'Marrakech', 'url' => '/ui-ux-design-agency-in-marrakech-morocco', 'basename' => 'ui-ux-design-agency-in-marrakech-morocco'],
  ['name' => 'Marrakesh-Safi', 'url' => '/ui-ux-design-agency-in-marrakesh-safi-morocco', 'basename' => 'ui-ux-design-agency-in-marrakesh-safi-morocco'],
  ['name' => 'Médiouna', 'url' => '/ui-ux-design-agency-in-mediouna-morocco', 'basename' => 'ui-ux-design-agency-in-mediouna-morocco'],
  ['name' => 'Meknès', 'url' => '/ui-ux-design-agency-in-meknes-morocco', 'basename' => 'ui-ux-design-agency-in-meknes-morocco'],
  ['name' => 'Midelt', 'url' => '/ui-ux-design-agency-in-midelt-morocco', 'basename' => 'ui-ux-design-agency-in-midelt-morocco'],
  ['name' => 'Mohammadia', 'url' => '/ui-ux-design-agency-in-mohammadia-morocco', 'basename' => 'ui-ux-design-agency-in-mohammadia-morocco'],
  ['name' => 'Moulay Yacoub', 'url' => '/ui-ux-design-agency-in-moulay-yacoub-morocco', 'basename' => 'ui-ux-design-agency-in-moulay-yacoub-morocco'],
  ['name' => 'Nador', 'url' => '/ui-ux-design-agency-in-nador-morocco', 'basename' => 'ui-ux-design-agency-in-nador-morocco'],
  ['name' => 'Nouaceur', 'url' => '/ui-ux-design-agency-in-nouaceur-morocco', 'basename' => 'ui-ux-design-agency-in-nouaceur-morocco'],
  ['name' => 'Ouarzazate', 'url' => '/ui-ux-design-agency-in-ouarzazate-morocco', 'basename' => 'ui-ux-design-agency-in-ouarzazate-morocco'],
  ['name' => 'Oued Ed-Dahab (EH)', 'url' => '/ui-ux-design-agency-in-oued-ed-dahab-eh-morocco', 'basename' => 'ui-ux-design-agency-in-oued-ed-dahab-eh-morocco'],
  ['name' => 'Ouezzane', 'url' => '/ui-ux-design-agency-in-ouezzane-morocco', 'basename' => 'ui-ux-design-agency-in-ouezzane-morocco'],
  ['name' => 'Oujda-Angad', 'url' => '/ui-ux-design-agency-in-oujda-angad-morocco', 'basename' => 'ui-ux-design-agency-in-oujda-angad-morocco'],
  ['name' => 'Rabat', 'url' => '/ui-ux-design-agency-in-rabat-morocco', 'basename' => 'ui-ux-design-agency-in-rabat-morocco'],
  ['name' => 'Rabat-Salé-Kénitra', 'url' => '/ui-ux-design-agency-in-rabat-sale-kenitra-morocco', 'basename' => 'ui-ux-design-agency-in-rabat-sale-kenitra-morocco'],
  ['name' => 'Rehamna', 'url' => '/ui-ux-design-agency-in-rehamna-morocco', 'basename' => 'ui-ux-design-agency-in-rehamna-morocco'],
  ['name' => 'Safi', 'url' => '/ui-ux-design-agency-in-safi-morocco', 'basename' => 'ui-ux-design-agency-in-safi-morocco'],
  ['name' => 'Salé', 'url' => '/ui-ux-design-agency-in-sale-morocco', 'basename' => 'ui-ux-design-agency-in-sale-morocco'],
  ['name' => 'Sefrou', 'url' => '/ui-ux-design-agency-in-sefrou-morocco', 'basename' => 'ui-ux-design-agency-in-sefrou-morocco'],
  ['name' => 'Settat', 'url' => '/ui-ux-design-agency-in-settat-morocco', 'basename' => 'ui-ux-design-agency-in-settat-morocco'],
  ['name' => 'Sidi Bennour', 'url' => '/ui-ux-design-agency-in-sidi-bennour-morocco', 'basename' => 'ui-ux-design-agency-in-sidi-bennour-morocco'],
  ['name' => 'Sidi Ifni', 'url' => '/ui-ux-design-agency-in-sidi-ifni-morocco', 'basename' => 'ui-ux-design-agency-in-sidi-ifni-morocco'],
  ['name' => 'Sidi Kacem', 'url' => '/ui-ux-design-agency-in-sidi-kacem-morocco', 'basename' => 'ui-ux-design-agency-in-sidi-kacem-morocco'],
  ['name' => 'Sidi Slimane', 'url' => '/ui-ux-design-agency-in-sidi-slimane-morocco', 'basename' => 'ui-ux-design-agency-in-sidi-slimane-morocco'],
  ['name' => 'Skhirate-Témara', 'url' => '/ui-ux-design-agency-in-skhirate-temara-morocco', 'basename' => 'ui-ux-design-agency-in-skhirate-temara-morocco'],
  ['name' => 'Souss-Massa', 'url' => '/ui-ux-design-agency-in-souss-massa-morocco', 'basename' => 'ui-ux-design-agency-in-souss-massa-morocco'],
  ['name' => 'Tan-Tan (EH-partial)', 'url' => '/ui-ux-design-agency-in-tan-tan-eh-partial-morocco', 'basename' => 'ui-ux-design-agency-in-tan-tan-eh-partial-morocco'],
  ['name' => 'Tanger-Assilah', 'url' => '/ui-ux-design-agency-in-tanger-assilah-morocco', 'basename' => 'ui-ux-design-agency-in-tanger-assilah-morocco'],
  ['name' => 'Tanger-Tétouan-Al Hoceïma', 'url' => '/ui-ux-design-agency-in-tanger-tetouan-al-hoceima-morocco', 'basename' => 'ui-ux-design-agency-in-tanger-tetouan-al-hoceima-morocco'],
  ['name' => 'Taounate', 'url' => '/ui-ux-design-agency-in-taounate-morocco', 'basename' => 'ui-ux-design-agency-in-taounate-morocco'],
  ['name' => 'Taourirt', 'url' => '/ui-ux-design-agency-in-taourirt-morocco', 'basename' => 'ui-ux-design-agency-in-taourirt-morocco'],
  ['name' => 'Tarfaya (EH-partial)', 'url' => '/ui-ux-design-agency-in-tarfaya-eh-partial-morocco', 'basename' => 'ui-ux-design-agency-in-tarfaya-eh-partial-morocco'],
  ['name' => 'Taroudannt', 'url' => '/ui-ux-design-agency-in-taroudannt-morocco', 'basename' => 'ui-ux-design-agency-in-taroudannt-morocco'],
  ['name' => 'Tata', 'url' => '/ui-ux-design-agency-in-tata-morocco', 'basename' => 'ui-ux-design-agency-in-tata-morocco'],
  ['name' => 'Taza', 'url' => '/ui-ux-design-agency-in-taza-morocco', 'basename' => 'ui-ux-design-agency-in-taza-morocco'],
  ['name' => 'Tétouan', 'url' => '/ui-ux-design-agency-in-tetouan-morocco', 'basename' => 'ui-ux-design-agency-in-tetouan-morocco'],
  ['name' => 'Tinghir', 'url' => '/ui-ux-design-agency-in-tinghir-morocco', 'basename' => 'ui-ux-design-agency-in-tinghir-morocco'],
  ['name' => 'Tiznit', 'url' => '/ui-ux-design-agency-in-tiznit-morocco', 'basename' => 'ui-ux-design-agency-in-tiznit-morocco'],
  ['name' => 'Youssoufia', 'url' => '/ui-ux-design-agency-in-youssoufia-morocco', 'basename' => 'ui-ux-design-agency-in-youssoufia-morocco'],
  ['name' => 'Zagora', 'url' => '/ui-ux-design-agency-in-zagora-morocco', 'basename' => 'ui-ux-design-agency-in-zagora-morocco'],
];
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

    <!-- ── Hub: Browse all regions in Morocco ── -->
    <?php if (!empty($hubChildren)): ?>
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
      <h2>Browse UI/UX Design Services Across Morocco</h2>
      <p class="hub-sub">We serve 87 regions, states, and cities in Morocco. Select a location to see how UX Pacific can help your business.</p>
      <div class="hub-grid">
        <?php foreach ($hubChildren as $hc): ?>
        <a href="<?= htmlspecialchars($hc['url'], ENT_QUOTES, 'UTF-8') ?>" class="hub-card">
          <span><?= htmlspecialchars($hc['name'], ENT_QUOTES, 'UTF-8') ?></span>
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