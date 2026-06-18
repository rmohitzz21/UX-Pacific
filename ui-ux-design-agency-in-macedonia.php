<?php
require_once __DIR__ . '/includes/cms_repository.php';

$countrySlug = 'macedonia';

$featuredProjects   = get_published_projects('all', true);
$ecosystemHomeItems = get_published_ecosystem();

function home_image_url(?string $url): string {
  $url = trim((string) $url);
  if ($url === '') return uxp_normalize_stored_media_url('img/ux.webp');
  if (preg_match('#^https?://#i', $url)) return $url;
  return uxp_normalize_stored_media_url($url);
}

$pageTitle   = 'UI UX Design Agency in Macedonia | UX Pacific';
$pageDesc    = 'UX Pacific delivers expert UI/UX design services across Macedonia. Browse our locations or book a free UX audit today.';
$canonicalUrl = 'https://www.uxpacific.com/ui-ux-design-agency-in-macedonia';
$ogTitle     = 'UI UX Design Agency in Macedonia | UX Pacific';
$ogDesc      = 'UX Pacific delivers expert UI/UX design services across Macedonia. Browse our locations or book a free UX audit today.';
$ogUrl       = 'https://www.uxpacific.com/ui-ux-design-agency-in-macedonia';
$currentPage = 'Home';

// Schema: WebPage + BreadcrumbList
$ldJson = json_encode([
  '@context' => 'https://schema.org',
  '@graph'   => [
    ['@type' => 'WebPage',
     'url'   => 'https://www.uxpacific.com/ui-ux-design-agency-in-macedonia',
     'name'  => 'UI UX Design Agency in Macedonia | UX Pacific',
     'inLanguage' => 'en',
    ],
    ['@type' => 'BreadcrumbList',
     'itemListElement' => [
       ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home',       'item' => BASE_URL . '/'],
       ['@type' => 'ListItem', 'position' => 2, 'name' => 'Macedonia', 'item' => 'https://www.uxpacific.com/ui-ux-design-agency-in-macedonia'],
     ],
    ],
  ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

$geoPage = uxp_geo_page($countrySlug);
if ($geoPage) {
  if (!empty($geoPage['page_title']))      { $pageTitle = (string) $geoPage['page_title']; $ogTitle = $pageTitle; }
  if (!empty($geoPage['meta_description'])) { $pageDesc  = (string) $geoPage['meta_description']; $ogDesc = $pageDesc; }
}

// Child locations in Macedonia
$hubChildren = [
  ['name' => 'Aerodrom Municipality', 'url' => '/ui-ux-design-agency-in-aerodrom-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-aerodrom-municipality-macedonia'],
  ['name' => 'Aračinovo Municipality', 'url' => '/ui-ux-design-agency-in-aracinovo-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-aracinovo-municipality-macedonia'],
  ['name' => 'Berovo Municipality', 'url' => '/ui-ux-design-agency-in-berovo-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-berovo-municipality-macedonia'],
  ['name' => 'Bitola Municipality', 'url' => '/ui-ux-design-agency-in-bitola-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-bitola-municipality-macedonia'],
  ['name' => 'Bogdanci Municipality', 'url' => '/ui-ux-design-agency-in-bogdanci-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-bogdanci-municipality-macedonia'],
  ['name' => 'Bogovinje Municipality', 'url' => '/ui-ux-design-agency-in-bogovinje-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-bogovinje-municipality-macedonia'],
  ['name' => 'Bosilovo Municipality', 'url' => '/ui-ux-design-agency-in-bosilovo-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-bosilovo-municipality-macedonia'],
  ['name' => 'Brvenica Municipality', 'url' => '/ui-ux-design-agency-in-brvenica-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-brvenica-municipality-macedonia'],
  ['name' => 'Butel Municipality', 'url' => '/ui-ux-design-agency-in-butel-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-butel-municipality-macedonia'],
  ['name' => 'Čair Municipality', 'url' => '/ui-ux-design-agency-in-cair-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-cair-municipality-macedonia'],
  ['name' => 'Čaška Municipality', 'url' => '/ui-ux-design-agency-in-caska-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-caska-municipality-macedonia'],
  ['name' => 'Centar Municipality', 'url' => '/ui-ux-design-agency-in-centar-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-centar-municipality-macedonia'],
  ['name' => 'Centar Župa Municipality', 'url' => '/ui-ux-design-agency-in-centar-zupa-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-centar-zupa-municipality-macedonia'],
  ['name' => 'Češinovo-Obleševo Municipality', 'url' => '/ui-ux-design-agency-in-cesinovo-oblesevo-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-cesinovo-oblesevo-municipality-macedonia'],
  ['name' => 'Čučer-Sandevo Municipality', 'url' => '/ui-ux-design-agency-in-cucer-sandevo-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-cucer-sandevo-municipality-macedonia'],
  ['name' => 'Debarca Municipality', 'url' => '/ui-ux-design-agency-in-debarca-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-debarca-municipality-macedonia'],
  ['name' => 'Delčevo Municipality', 'url' => '/ui-ux-design-agency-in-delcevo-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-delcevo-municipality-macedonia'],
  ['name' => 'Demir Hisar Municipality', 'url' => '/ui-ux-design-agency-in-demir-hisar-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-demir-hisar-municipality-macedonia'],
  ['name' => 'Demir Kapija Municipality', 'url' => '/ui-ux-design-agency-in-demir-kapija-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-demir-kapija-municipality-macedonia'],
  ['name' => 'Dojran Municipality', 'url' => '/ui-ux-design-agency-in-dojran-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-dojran-municipality-macedonia'],
  ['name' => 'Dolneni Municipality', 'url' => '/ui-ux-design-agency-in-dolneni-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-dolneni-municipality-macedonia'],
  ['name' => 'Drugovo Municipality', 'url' => '/ui-ux-design-agency-in-drugovo-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-drugovo-municipality-macedonia'],
  ['name' => 'Gazi Baba Municipality', 'url' => '/ui-ux-design-agency-in-gazi-baba-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-gazi-baba-municipality-macedonia'],
  ['name' => 'Gevgelija Municipality', 'url' => '/ui-ux-design-agency-in-gevgelija-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-gevgelija-municipality-macedonia'],
  ['name' => 'Gjorče Petrov Municipality', 'url' => '/ui-ux-design-agency-in-gjorce-petrov-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-gjorce-petrov-municipality-macedonia'],
  ['name' => 'Gostivar Municipality', 'url' => '/ui-ux-design-agency-in-gostivar-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-gostivar-municipality-macedonia'],
  ['name' => 'Gradsko Municipality', 'url' => '/ui-ux-design-agency-in-gradsko-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-gradsko-municipality-macedonia'],
  ['name' => 'Greater Skopje', 'url' => '/ui-ux-design-agency-in-greater-skopje-macedonia', 'basename' => 'ui-ux-design-agency-in-greater-skopje-macedonia'],
  ['name' => 'Ilinden Municipality', 'url' => '/ui-ux-design-agency-in-ilinden-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-ilinden-municipality-macedonia'],
  ['name' => 'Jegunovce Municipality', 'url' => '/ui-ux-design-agency-in-jegunovce-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-jegunovce-municipality-macedonia'],
  ['name' => 'Karbinci', 'url' => '/ui-ux-design-agency-in-karbinci-macedonia', 'basename' => 'ui-ux-design-agency-in-karbinci-macedonia'],
  ['name' => 'Karpoš Municipality', 'url' => '/ui-ux-design-agency-in-karpos-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-karpos-municipality-macedonia'],
  ['name' => 'Kavadarci Municipality', 'url' => '/ui-ux-design-agency-in-kavadarci-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-kavadarci-municipality-macedonia'],
  ['name' => 'Kičevo Municipality', 'url' => '/ui-ux-design-agency-in-kicevo-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-kicevo-municipality-macedonia'],
  ['name' => 'Kisela Voda Municipality', 'url' => '/ui-ux-design-agency-in-kisela-voda-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-kisela-voda-municipality-macedonia'],
  ['name' => 'Kočani Municipality', 'url' => '/ui-ux-design-agency-in-kocani-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-kocani-municipality-macedonia'],
  ['name' => 'Konče Municipality', 'url' => '/ui-ux-design-agency-in-konce-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-konce-municipality-macedonia'],
  ['name' => 'Kratovo Municipality', 'url' => '/ui-ux-design-agency-in-kratovo-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-kratovo-municipality-macedonia'],
  ['name' => 'Kriva Palanka Municipality', 'url' => '/ui-ux-design-agency-in-kriva-palanka-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-kriva-palanka-municipality-macedonia'],
  ['name' => 'Krivogaštani Municipality', 'url' => '/ui-ux-design-agency-in-krivogastani-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-krivogastani-municipality-macedonia'],
  ['name' => 'Kruševo Municipality', 'url' => '/ui-ux-design-agency-in-krusevo-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-krusevo-municipality-macedonia'],
  ['name' => 'Kumanovo Municipality', 'url' => '/ui-ux-design-agency-in-kumanovo-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-kumanovo-municipality-macedonia'],
  ['name' => 'Lipkovo Municipality', 'url' => '/ui-ux-design-agency-in-lipkovo-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-lipkovo-municipality-macedonia'],
  ['name' => 'Lozovo Municipality', 'url' => '/ui-ux-design-agency-in-lozovo-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-lozovo-municipality-macedonia'],
  ['name' => 'Makedonska Kamenica Municipality', 'url' => '/ui-ux-design-agency-in-makedonska-kamenica-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-makedonska-kamenica-municipality-macedonia'],
  ['name' => 'Makedonski Brod Municipality', 'url' => '/ui-ux-design-agency-in-makedonski-brod-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-makedonski-brod-municipality-macedonia'],
  ['name' => 'Mavrovo and Rostuša Municipality', 'url' => '/ui-ux-design-agency-in-mavrovo-and-rostusa-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-mavrovo-and-rostusa-municipality-macedonia'],
  ['name' => 'Mogila Municipality', 'url' => '/ui-ux-design-agency-in-mogila-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-mogila-municipality-macedonia'],
  ['name' => 'Negotino Municipality', 'url' => '/ui-ux-design-agency-in-negotino-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-negotino-municipality-macedonia'],
  ['name' => 'Novaci Municipality', 'url' => '/ui-ux-design-agency-in-novaci-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-novaci-municipality-macedonia'],
  ['name' => 'Novo Selo Municipality', 'url' => '/ui-ux-design-agency-in-novo-selo-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-novo-selo-municipality-macedonia'],
  ['name' => 'Ohrid Municipality', 'url' => '/ui-ux-design-agency-in-ohrid-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-ohrid-municipality-macedonia'],
  ['name' => 'Oslomej Municipality', 'url' => '/ui-ux-design-agency-in-oslomej-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-oslomej-municipality-macedonia'],
  ['name' => 'Pehčevo Municipality', 'url' => '/ui-ux-design-agency-in-pehcevo-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-pehcevo-municipality-macedonia'],
  ['name' => 'Petrovec Municipality', 'url' => '/ui-ux-design-agency-in-petrovec-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-petrovec-municipality-macedonia'],
  ['name' => 'Plasnica Municipality', 'url' => '/ui-ux-design-agency-in-plasnica-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-plasnica-municipality-macedonia'],
  ['name' => 'Prilep Municipality', 'url' => '/ui-ux-design-agency-in-prilep-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-prilep-municipality-macedonia'],
  ['name' => 'Probištip Municipality', 'url' => '/ui-ux-design-agency-in-probistip-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-probistip-municipality-macedonia'],
  ['name' => 'Radoviš Municipality', 'url' => '/ui-ux-design-agency-in-radovis-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-radovis-municipality-macedonia'],
  ['name' => 'Rankovce Municipality', 'url' => '/ui-ux-design-agency-in-rankovce-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-rankovce-municipality-macedonia'],
  ['name' => 'Resen Municipality', 'url' => '/ui-ux-design-agency-in-resen-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-resen-municipality-macedonia'],
  ['name' => 'Rosoman Municipality', 'url' => '/ui-ux-design-agency-in-rosoman-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-rosoman-municipality-macedonia'],
  ['name' => 'Saraj Municipality', 'url' => '/ui-ux-design-agency-in-saraj-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-saraj-municipality-macedonia'],
  ['name' => 'Sopište Municipality', 'url' => '/ui-ux-design-agency-in-sopiste-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-sopiste-municipality-macedonia'],
  ['name' => 'Staro Nagoričane Municipality', 'url' => '/ui-ux-design-agency-in-staro-nagoricane-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-staro-nagoricane-municipality-macedonia'],
  ['name' => 'Štip Municipality', 'url' => '/ui-ux-design-agency-in-stip-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-stip-municipality-macedonia'],
  ['name' => 'Struga Municipality', 'url' => '/ui-ux-design-agency-in-struga-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-struga-municipality-macedonia'],
  ['name' => 'Strumica Municipality', 'url' => '/ui-ux-design-agency-in-strumica-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-strumica-municipality-macedonia'],
  ['name' => 'Studeničani Municipality', 'url' => '/ui-ux-design-agency-in-studenicani-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-studenicani-municipality-macedonia'],
  ['name' => 'Šuto Orizari Municipality', 'url' => '/ui-ux-design-agency-in-suto-orizari-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-suto-orizari-municipality-macedonia'],
  ['name' => 'Sveti Nikole Municipality', 'url' => '/ui-ux-design-agency-in-sveti-nikole-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-sveti-nikole-municipality-macedonia'],
  ['name' => 'Tearce Municipality', 'url' => '/ui-ux-design-agency-in-tearce-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-tearce-municipality-macedonia'],
  ['name' => 'Tetovo Municipality', 'url' => '/ui-ux-design-agency-in-tetovo-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-tetovo-municipality-macedonia'],
  ['name' => 'Valandovo Municipality', 'url' => '/ui-ux-design-agency-in-valandovo-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-valandovo-municipality-macedonia'],
  ['name' => 'Vasilevo Municipality', 'url' => '/ui-ux-design-agency-in-vasilevo-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-vasilevo-municipality-macedonia'],
  ['name' => 'Veles Municipality', 'url' => '/ui-ux-design-agency-in-veles-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-veles-municipality-macedonia'],
  ['name' => 'Vevčani Municipality', 'url' => '/ui-ux-design-agency-in-vevcani-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-vevcani-municipality-macedonia'],
  ['name' => 'Vinica Municipality', 'url' => '/ui-ux-design-agency-in-vinica-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-vinica-municipality-macedonia'],
  ['name' => 'Vraneštica Municipality', 'url' => '/ui-ux-design-agency-in-vranestica-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-vranestica-municipality-macedonia'],
  ['name' => 'Vrapčište Municipality', 'url' => '/ui-ux-design-agency-in-vrapciste-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-vrapciste-municipality-macedonia'],
  ['name' => 'Zajas Municipality', 'url' => '/ui-ux-design-agency-in-zajas-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-zajas-municipality-macedonia'],
  ['name' => 'Zelenikovo Municipality', 'url' => '/ui-ux-design-agency-in-zelenikovo-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-zelenikovo-municipality-macedonia'],
  ['name' => 'Želino Municipality', 'url' => '/ui-ux-design-agency-in-zelino-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-zelino-municipality-macedonia'],
  ['name' => 'Zrnovci Municipality', 'url' => '/ui-ux-design-agency-in-zrnovci-municipality-macedonia', 'basename' => 'ui-ux-design-agency-in-zrnovci-municipality-macedonia'],
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

    <!-- ── Hub: Browse all regions in Macedonia ── -->
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
      <h2>Browse UI/UX Design Services Across Macedonia</h2>
      <p class="hub-sub">We serve 84 regions, states, and cities in Macedonia. Select a location to see how UX Pacific can help your business.</p>
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