<?php
require_once __DIR__ . '/includes/cms_repository.php';

$countrySlug = 'malta';

$featuredProjects   = get_published_projects('all', true);
$ecosystemHomeItems = get_published_ecosystem();

function home_image_url(?string $url): string {
  $url = trim((string) $url);
  if ($url === '') return uxp_normalize_stored_media_url('img/ux.webp');
  if (preg_match('#^https?://#i', $url)) return $url;
  return uxp_normalize_stored_media_url($url);
}

$pageTitle   = 'UI UX Design Agency in Malta | UX Pacific';
$pageDesc    = 'UX Pacific delivers expert UI/UX design services across Malta. Browse our locations or book a free UX audit today.';
$canonicalUrl = 'https://www.uxpacific.com/ui-ux-design-agency-in-malta';
$ogTitle     = 'UI UX Design Agency in Malta | UX Pacific';
$ogDesc      = 'UX Pacific delivers expert UI/UX design services across Malta. Browse our locations or book a free UX audit today.';
$ogUrl       = 'https://www.uxpacific.com/ui-ux-design-agency-in-malta';
$currentPage = 'Home';

// Schema: WebPage + BreadcrumbList
$ldJson = json_encode([
  '@context' => 'https://schema.org',
  '@graph'   => [
    ['@type' => 'WebPage',
     'url'   => 'https://www.uxpacific.com/ui-ux-design-agency-in-malta',
     'name'  => 'UI UX Design Agency in Malta | UX Pacific',
     'inLanguage' => 'en',
    ],
    ['@type' => 'BreadcrumbList',
     'itemListElement' => [
       ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home',       'item' => BASE_URL . '/'],
       ['@type' => 'ListItem', 'position' => 2, 'name' => 'Malta', 'item' => 'https://www.uxpacific.com/ui-ux-design-agency-in-malta'],
     ],
    ],
  ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

$geoPage = uxp_geo_page($countrySlug);
if ($geoPage) {
  if (!empty($geoPage['page_title']))      { $pageTitle = (string) $geoPage['page_title']; $ogTitle = $pageTitle; }
  if (!empty($geoPage['meta_description'])) { $pageDesc  = (string) $geoPage['meta_description']; $ogDesc = $pageDesc; }
}

// Child locations in Malta
$hubChildren = [
  ['name' => 'Ħamrun', 'url' => '/ui-ux-design-agency-in-amrun-malta', 'basename' => 'ui-ux-design-agency-in-amrun-malta'],
  ['name' => 'Attard', 'url' => '/ui-ux-design-agency-in-attard-malta', 'basename' => 'ui-ux-design-agency-in-attard-malta'],
  ['name' => 'Balzan', 'url' => '/ui-ux-design-agency-in-balzan-malta', 'basename' => 'ui-ux-design-agency-in-balzan-malta'],
  ['name' => 'Birgu', 'url' => '/ui-ux-design-agency-in-birgu-malta', 'basename' => 'ui-ux-design-agency-in-birgu-malta'],
  ['name' => 'Birkirkara', 'url' => '/ui-ux-design-agency-in-birkirkara-malta', 'basename' => 'ui-ux-design-agency-in-birkirkara-malta'],
  ['name' => 'Birżebbuġa', 'url' => '/ui-ux-design-agency-in-birzebbuga-malta', 'basename' => 'ui-ux-design-agency-in-birzebbuga-malta'],
  ['name' => 'Cospicua', 'url' => '/ui-ux-design-agency-in-cospicua-malta', 'basename' => 'ui-ux-design-agency-in-cospicua-malta'],
  ['name' => 'Dingli', 'url' => '/ui-ux-design-agency-in-dingli-malta', 'basename' => 'ui-ux-design-agency-in-dingli-malta'],
  ['name' => 'Fgura', 'url' => '/ui-ux-design-agency-in-fgura-malta', 'basename' => 'ui-ux-design-agency-in-fgura-malta'],
  ['name' => 'Floriana', 'url' => '/ui-ux-design-agency-in-floriana-malta', 'basename' => 'ui-ux-design-agency-in-floriana-malta'],
  ['name' => 'Fontana', 'url' => '/ui-ux-design-agency-in-fontana-malta', 'basename' => 'ui-ux-design-agency-in-fontana-malta'],
  ['name' => 'Għajnsielem', 'url' => '/ui-ux-design-agency-in-g-ajnsielem-malta', 'basename' => 'ui-ux-design-agency-in-g-ajnsielem-malta'],
  ['name' => 'Għarb', 'url' => '/ui-ux-design-agency-in-g-arb-malta', 'basename' => 'ui-ux-design-agency-in-g-arb-malta'],
  ['name' => 'Għargħur', 'url' => '/ui-ux-design-agency-in-g-arg-ur-malta', 'basename' => 'ui-ux-design-agency-in-g-arg-ur-malta'],
  ['name' => 'Għasri', 'url' => '/ui-ux-design-agency-in-g-asri-malta', 'basename' => 'ui-ux-design-agency-in-g-asri-malta'],
  ['name' => 'Għaxaq', 'url' => '/ui-ux-design-agency-in-g-axaq-malta', 'basename' => 'ui-ux-design-agency-in-g-axaq-malta'],
  ['name' => 'Gudja', 'url' => '/ui-ux-design-agency-in-gudja-malta', 'basename' => 'ui-ux-design-agency-in-gudja-malta'],
  ['name' => 'Gżira', 'url' => '/ui-ux-design-agency-in-gzira-malta', 'basename' => 'ui-ux-design-agency-in-gzira-malta'],
  ['name' => 'Iklin', 'url' => '/ui-ux-design-agency-in-iklin-malta', 'basename' => 'ui-ux-design-agency-in-iklin-malta'],
  ['name' => 'Kalkara', 'url' => '/ui-ux-design-agency-in-kalkara-malta', 'basename' => 'ui-ux-design-agency-in-kalkara-malta'],
  ['name' => 'Kerċem', 'url' => '/ui-ux-design-agency-in-kercem-malta', 'basename' => 'ui-ux-design-agency-in-kercem-malta'],
  ['name' => 'Kirkop', 'url' => '/ui-ux-design-agency-in-kirkop-malta', 'basename' => 'ui-ux-design-agency-in-kirkop-malta'],
  ['name' => 'Lija', 'url' => '/ui-ux-design-agency-in-lija-malta', 'basename' => 'ui-ux-design-agency-in-lija-malta'],
  ['name' => 'Luqa', 'url' => '/ui-ux-design-agency-in-luqa-malta', 'basename' => 'ui-ux-design-agency-in-luqa-malta'],
  ['name' => 'Marsa', 'url' => '/ui-ux-design-agency-in-marsa-malta', 'basename' => 'ui-ux-design-agency-in-marsa-malta'],
  ['name' => 'Marsaskala', 'url' => '/ui-ux-design-agency-in-marsaskala-malta', 'basename' => 'ui-ux-design-agency-in-marsaskala-malta'],
  ['name' => 'Marsaxlokk', 'url' => '/ui-ux-design-agency-in-marsaxlokk-malta', 'basename' => 'ui-ux-design-agency-in-marsaxlokk-malta'],
  ['name' => 'Mdina', 'url' => '/ui-ux-design-agency-in-mdina-malta', 'basename' => 'ui-ux-design-agency-in-mdina-malta'],
  ['name' => 'Mellieħa', 'url' => '/ui-ux-design-agency-in-mellie-a-malta', 'basename' => 'ui-ux-design-agency-in-mellie-a-malta'],
  ['name' => 'Mġarr', 'url' => '/ui-ux-design-agency-in-mgarr-malta', 'basename' => 'ui-ux-design-agency-in-mgarr-malta'],
  ['name' => 'Mosta', 'url' => '/ui-ux-design-agency-in-mosta-malta', 'basename' => 'ui-ux-design-agency-in-mosta-malta'],
  ['name' => 'Mqabba', 'url' => '/ui-ux-design-agency-in-mqabba-malta', 'basename' => 'ui-ux-design-agency-in-mqabba-malta'],
  ['name' => 'Msida', 'url' => '/ui-ux-design-agency-in-msida-malta', 'basename' => 'ui-ux-design-agency-in-msida-malta'],
  ['name' => 'Mtarfa', 'url' => '/ui-ux-design-agency-in-mtarfa-malta', 'basename' => 'ui-ux-design-agency-in-mtarfa-malta'],
  ['name' => 'Munxar', 'url' => '/ui-ux-design-agency-in-munxar-malta', 'basename' => 'ui-ux-design-agency-in-munxar-malta'],
  ['name' => 'Nadur', 'url' => '/ui-ux-design-agency-in-nadur-malta', 'basename' => 'ui-ux-design-agency-in-nadur-malta'],
  ['name' => 'Naxxar', 'url' => '/ui-ux-design-agency-in-naxxar-malta', 'basename' => 'ui-ux-design-agency-in-naxxar-malta'],
  ['name' => 'Paola', 'url' => '/ui-ux-design-agency-in-paola-malta', 'basename' => 'ui-ux-design-agency-in-paola-malta'],
  ['name' => 'Pembroke', 'url' => '/ui-ux-design-agency-in-pembroke-malta', 'basename' => 'ui-ux-design-agency-in-pembroke-malta'],
  ['name' => 'Pietà', 'url' => '/ui-ux-design-agency-in-pieta-malta', 'basename' => 'ui-ux-design-agency-in-pieta-malta'],
  ['name' => 'Qala', 'url' => '/ui-ux-design-agency-in-qala-malta', 'basename' => 'ui-ux-design-agency-in-qala-malta'],
  ['name' => 'Qormi', 'url' => '/ui-ux-design-agency-in-qormi-malta', 'basename' => 'ui-ux-design-agency-in-qormi-malta'],
  ['name' => 'Qrendi', 'url' => '/ui-ux-design-agency-in-qrendi-malta', 'basename' => 'ui-ux-design-agency-in-qrendi-malta'],
  ['name' => 'Rabat', 'url' => '/ui-ux-design-agency-in-rabat-malta', 'basename' => 'ui-ux-design-agency-in-rabat-malta'],
  ['name' => 'Saint Lawrence', 'url' => '/ui-ux-design-agency-in-saint-lawrence-malta', 'basename' => 'ui-ux-design-agency-in-saint-lawrence-malta'],
  ['name' => 'San Ġwann', 'url' => '/ui-ux-design-agency-in-san-gwann-malta', 'basename' => 'ui-ux-design-agency-in-san-gwann-malta'],
  ['name' => 'Sannat', 'url' => '/ui-ux-design-agency-in-sannat-malta', 'basename' => 'ui-ux-design-agency-in-sannat-malta'],
  ['name' => 'Santa Luċija', 'url' => '/ui-ux-design-agency-in-santa-lucija-malta', 'basename' => 'ui-ux-design-agency-in-santa-lucija-malta'],
  ['name' => 'Santa Venera', 'url' => '/ui-ux-design-agency-in-santa-venera-malta', 'basename' => 'ui-ux-design-agency-in-santa-venera-malta'],
  ['name' => 'Senglea', 'url' => '/ui-ux-design-agency-in-senglea-malta', 'basename' => 'ui-ux-design-agency-in-senglea-malta'],
  ['name' => 'Siġġiewi', 'url' => '/ui-ux-design-agency-in-siggiewi-malta', 'basename' => 'ui-ux-design-agency-in-siggiewi-malta'],
  ['name' => 'Sliema', 'url' => '/ui-ux-design-agency-in-sliema-malta', 'basename' => 'ui-ux-design-agency-in-sliema-malta'],
  ['name' => 'St. Julian\\\'s', 'url' => '/ui-ux-design-agency-in-st-julians-malta', 'basename' => 'ui-ux-design-agency-in-st-julians-malta'],
  ['name' => 'St. Paul\\\'s Bay', 'url' => '/ui-ux-design-agency-in-st-pauls-bay-malta', 'basename' => 'ui-ux-design-agency-in-st-pauls-bay-malta'],
  ['name' => 'Swieqi', 'url' => '/ui-ux-design-agency-in-swieqi-malta', 'basename' => 'ui-ux-design-agency-in-swieqi-malta'],
  ['name' => 'Ta\\\' Xbiex', 'url' => '/ui-ux-design-agency-in-ta-xbiex-malta', 'basename' => 'ui-ux-design-agency-in-ta-xbiex-malta'],
  ['name' => 'Tarxien', 'url' => '/ui-ux-design-agency-in-tarxien-malta', 'basename' => 'ui-ux-design-agency-in-tarxien-malta'],
  ['name' => 'Valletta', 'url' => '/ui-ux-design-agency-in-valletta-malta', 'basename' => 'ui-ux-design-agency-in-valletta-malta'],
  ['name' => 'Victoria', 'url' => '/ui-ux-design-agency-in-victoria-malta', 'basename' => 'ui-ux-design-agency-in-victoria-malta'],
  ['name' => 'Xagħra', 'url' => '/ui-ux-design-agency-in-xag-ra-malta', 'basename' => 'ui-ux-design-agency-in-xag-ra-malta'],
  ['name' => 'Xewkija', 'url' => '/ui-ux-design-agency-in-xewkija-malta', 'basename' => 'ui-ux-design-agency-in-xewkija-malta'],
  ['name' => 'Xgħajra', 'url' => '/ui-ux-design-agency-in-xg-ajra-malta', 'basename' => 'ui-ux-design-agency-in-xg-ajra-malta'],
  ['name' => 'Żabbar', 'url' => '/ui-ux-design-agency-in-zabbar-malta', 'basename' => 'ui-ux-design-agency-in-zabbar-malta'],
  ['name' => 'Żebbuġ Gozo', 'url' => '/ui-ux-design-agency-in-zebbug-gozo-malta', 'basename' => 'ui-ux-design-agency-in-zebbug-gozo-malta'],
  ['name' => 'Żebbuġ Malta', 'url' => '/ui-ux-design-agency-in-zebbug-malta-malta', 'basename' => 'ui-ux-design-agency-in-zebbug-malta-malta'],
  ['name' => 'Żejtun', 'url' => '/ui-ux-design-agency-in-zejtun-malta', 'basename' => 'ui-ux-design-agency-in-zejtun-malta'],
  ['name' => 'Żurrieq', 'url' => '/ui-ux-design-agency-in-zurrieq-malta', 'basename' => 'ui-ux-design-agency-in-zurrieq-malta'],
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

    <!-- ── Hub: Browse all regions in Malta ── -->
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
      <h2>Browse UI/UX Design Services Across Malta</h2>
      <p class="hub-sub">We serve 67 regions, states, and cities in Malta. Select a location to see how UX Pacific can help your business.</p>
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