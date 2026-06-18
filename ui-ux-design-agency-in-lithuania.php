<?php
require_once __DIR__ . '/includes/cms_repository.php';

$countrySlug = 'lithuania';

$featuredProjects   = get_published_projects('all', true);
$ecosystemHomeItems = get_published_ecosystem();

function home_image_url(?string $url): string {
  $url = trim((string) $url);
  if ($url === '') return uxp_normalize_stored_media_url('img/ux.webp');
  if (preg_match('#^https?://#i', $url)) return $url;
  return uxp_normalize_stored_media_url($url);
}

$pageTitle   = 'UI UX Design Agency in Lithuania | UX Pacific';
$pageDesc    = 'UX Pacific delivers expert UI/UX design services across Lithuania. Browse our locations or book a free UX audit today.';
$canonicalUrl = 'https://www.uxpacific.com/ui-ux-design-agency-in-lithuania';
$ogTitle     = 'UI UX Design Agency in Lithuania | UX Pacific';
$ogDesc      = 'UX Pacific delivers expert UI/UX design services across Lithuania. Browse our locations or book a free UX audit today.';
$ogUrl       = 'https://www.uxpacific.com/ui-ux-design-agency-in-lithuania';
$currentPage = 'Home';

// Schema: WebPage + BreadcrumbList
$ldJson = json_encode([
  '@context' => 'https://schema.org',
  '@graph'   => [
    ['@type' => 'WebPage',
     'url'   => 'https://www.uxpacific.com/ui-ux-design-agency-in-lithuania',
     'name'  => 'UI UX Design Agency in Lithuania | UX Pacific',
     'inLanguage' => 'en',
    ],
    ['@type' => 'BreadcrumbList',
     'itemListElement' => [
       ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home',       'item' => BASE_URL . '/'],
       ['@type' => 'ListItem', 'position' => 2, 'name' => 'Lithuania', 'item' => 'https://www.uxpacific.com/ui-ux-design-agency-in-lithuania'],
     ],
    ],
  ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

$geoPage = uxp_geo_page($countrySlug);
if ($geoPage) {
  if (!empty($geoPage['page_title']))      { $pageTitle = (string) $geoPage['page_title']; $ogTitle = $pageTitle; }
  if (!empty($geoPage['meta_description'])) { $pageDesc  = (string) $geoPage['meta_description']; $ogDesc = $pageDesc; }
}

// Child locations in Lithuania
$hubChildren = [
  ['name' => 'Akmenė District Municipality', 'url' => '/ui-ux-design-agency-in-akmene-district-municipality-lithuania', 'basename' => 'ui-ux-design-agency-in-akmene-district-municipality-lithuania'],
  ['name' => 'Alytus City Municipality', 'url' => '/ui-ux-design-agency-in-alytus-city-municipality-lithuania', 'basename' => 'ui-ux-design-agency-in-alytus-city-municipality-lithuania'],
  ['name' => 'Alytus County', 'url' => '/ui-ux-design-agency-in-alytus-county-lithuania', 'basename' => 'ui-ux-design-agency-in-alytus-county-lithuania'],
  ['name' => 'Alytus District Municipality', 'url' => '/ui-ux-design-agency-in-alytus-district-municipality-lithuania', 'basename' => 'ui-ux-design-agency-in-alytus-district-municipality-lithuania'],
  ['name' => 'Birštonas Municipality', 'url' => '/ui-ux-design-agency-in-birstonas-municipality-lithuania', 'basename' => 'ui-ux-design-agency-in-birstonas-municipality-lithuania'],
  ['name' => 'Biržai District Municipality', 'url' => '/ui-ux-design-agency-in-birzai-district-municipality-lithuania', 'basename' => 'ui-ux-design-agency-in-birzai-district-municipality-lithuania'],
  ['name' => 'Druskininkai municipality', 'url' => '/ui-ux-design-agency-in-druskininkai-municipality-lithuania', 'basename' => 'ui-ux-design-agency-in-druskininkai-municipality-lithuania'],
  ['name' => 'Elektrėnai municipality', 'url' => '/ui-ux-design-agency-in-elektrenai-municipality-lithuania', 'basename' => 'ui-ux-design-agency-in-elektrenai-municipality-lithuania'],
  ['name' => 'Ignalina District Municipality', 'url' => '/ui-ux-design-agency-in-ignalina-district-municipality-lithuania', 'basename' => 'ui-ux-design-agency-in-ignalina-district-municipality-lithuania'],
  ['name' => 'Jonava District Municipality', 'url' => '/ui-ux-design-agency-in-jonava-district-municipality-lithuania', 'basename' => 'ui-ux-design-agency-in-jonava-district-municipality-lithuania'],
  ['name' => 'Joniškis District Municipality', 'url' => '/ui-ux-design-agency-in-joniskis-district-municipality-lithuania', 'basename' => 'ui-ux-design-agency-in-joniskis-district-municipality-lithuania'],
  ['name' => 'Jurbarkas District Municipality', 'url' => '/ui-ux-design-agency-in-jurbarkas-district-municipality-lithuania', 'basename' => 'ui-ux-design-agency-in-jurbarkas-district-municipality-lithuania'],
  ['name' => 'Kaišiadorys District Municipality', 'url' => '/ui-ux-design-agency-in-kaisiadorys-district-municipality-lithuania', 'basename' => 'ui-ux-design-agency-in-kaisiadorys-district-municipality-lithuania'],
  ['name' => 'Kalvarija municipality', 'url' => '/ui-ux-design-agency-in-kalvarija-municipality-lithuania', 'basename' => 'ui-ux-design-agency-in-kalvarija-municipality-lithuania'],
  ['name' => 'Kaunas City Municipality', 'url' => '/ui-ux-design-agency-in-kaunas-city-municipality-lithuania', 'basename' => 'ui-ux-design-agency-in-kaunas-city-municipality-lithuania'],
  ['name' => 'Kaunas County', 'url' => '/ui-ux-design-agency-in-kaunas-county-lithuania', 'basename' => 'ui-ux-design-agency-in-kaunas-county-lithuania'],
  ['name' => 'Kaunas District Municipality', 'url' => '/ui-ux-design-agency-in-kaunas-district-municipality-lithuania', 'basename' => 'ui-ux-design-agency-in-kaunas-district-municipality-lithuania'],
  ['name' => 'Kazlų Rūda municipality', 'url' => '/ui-ux-design-agency-in-kazlu-ruda-municipality-lithuania', 'basename' => 'ui-ux-design-agency-in-kazlu-ruda-municipality-lithuania'],
  ['name' => 'Kėdainiai District Municipality', 'url' => '/ui-ux-design-agency-in-kedainiai-district-municipality-lithuania', 'basename' => 'ui-ux-design-agency-in-kedainiai-district-municipality-lithuania'],
  ['name' => 'Kelmė District Municipality', 'url' => '/ui-ux-design-agency-in-kelme-district-municipality-lithuania', 'basename' => 'ui-ux-design-agency-in-kelme-district-municipality-lithuania'],
  ['name' => 'Klaipeda City Municipality', 'url' => '/ui-ux-design-agency-in-klaipeda-city-municipality-lithuania', 'basename' => 'ui-ux-design-agency-in-klaipeda-city-municipality-lithuania'],
  ['name' => 'Klaipėda County', 'url' => '/ui-ux-design-agency-in-klaipeda-county-lithuania', 'basename' => 'ui-ux-design-agency-in-klaipeda-county-lithuania'],
  ['name' => 'Klaipėda District Municipality', 'url' => '/ui-ux-design-agency-in-klaipeda-district-municipality-lithuania', 'basename' => 'ui-ux-design-agency-in-klaipeda-district-municipality-lithuania'],
  ['name' => 'Kretinga District Municipality', 'url' => '/ui-ux-design-agency-in-kretinga-district-municipality-lithuania', 'basename' => 'ui-ux-design-agency-in-kretinga-district-municipality-lithuania'],
  ['name' => 'Kupiškis District Municipality', 'url' => '/ui-ux-design-agency-in-kupiskis-district-municipality-lithuania', 'basename' => 'ui-ux-design-agency-in-kupiskis-district-municipality-lithuania'],
  ['name' => 'Lazdijai District Municipality', 'url' => '/ui-ux-design-agency-in-lazdijai-district-municipality-lithuania', 'basename' => 'ui-ux-design-agency-in-lazdijai-district-municipality-lithuania'],
  ['name' => 'Marijampolė County', 'url' => '/ui-ux-design-agency-in-marijampole-county-lithuania', 'basename' => 'ui-ux-design-agency-in-marijampole-county-lithuania'],
  ['name' => 'Marijampolė Municipality', 'url' => '/ui-ux-design-agency-in-marijampole-municipality-lithuania', 'basename' => 'ui-ux-design-agency-in-marijampole-municipality-lithuania'],
  ['name' => 'Mažeikiai District Municipality', 'url' => '/ui-ux-design-agency-in-mazeikiai-district-municipality-lithuania', 'basename' => 'ui-ux-design-agency-in-mazeikiai-district-municipality-lithuania'],
  ['name' => 'Molėtai District Municipality', 'url' => '/ui-ux-design-agency-in-moletai-district-municipality-lithuania', 'basename' => 'ui-ux-design-agency-in-moletai-district-municipality-lithuania'],
  ['name' => 'Neringa Municipality', 'url' => '/ui-ux-design-agency-in-neringa-municipality-lithuania', 'basename' => 'ui-ux-design-agency-in-neringa-municipality-lithuania'],
  ['name' => 'Pagėgiai municipality', 'url' => '/ui-ux-design-agency-in-pagegiai-municipality-lithuania', 'basename' => 'ui-ux-design-agency-in-pagegiai-municipality-lithuania'],
  ['name' => 'Pakruojis District Municipality', 'url' => '/ui-ux-design-agency-in-pakruojis-district-municipality-lithuania', 'basename' => 'ui-ux-design-agency-in-pakruojis-district-municipality-lithuania'],
  ['name' => 'Palanga City Municipality', 'url' => '/ui-ux-design-agency-in-palanga-city-municipality-lithuania', 'basename' => 'ui-ux-design-agency-in-palanga-city-municipality-lithuania'],
  ['name' => 'Panevėžys City Municipality', 'url' => '/ui-ux-design-agency-in-panevezys-city-municipality-lithuania', 'basename' => 'ui-ux-design-agency-in-panevezys-city-municipality-lithuania'],
  ['name' => 'Panevėžys County', 'url' => '/ui-ux-design-agency-in-panevezys-county-lithuania', 'basename' => 'ui-ux-design-agency-in-panevezys-county-lithuania'],
  ['name' => 'Panevėžys District Municipality', 'url' => '/ui-ux-design-agency-in-panevezys-district-municipality-lithuania', 'basename' => 'ui-ux-design-agency-in-panevezys-district-municipality-lithuania'],
  ['name' => 'Pasvalys District Municipality', 'url' => '/ui-ux-design-agency-in-pasvalys-district-municipality-lithuania', 'basename' => 'ui-ux-design-agency-in-pasvalys-district-municipality-lithuania'],
  ['name' => 'Plungė District Municipality', 'url' => '/ui-ux-design-agency-in-plunge-district-municipality-lithuania', 'basename' => 'ui-ux-design-agency-in-plunge-district-municipality-lithuania'],
  ['name' => 'Prienai District Municipality', 'url' => '/ui-ux-design-agency-in-prienai-district-municipality-lithuania', 'basename' => 'ui-ux-design-agency-in-prienai-district-municipality-lithuania'],
  ['name' => 'Radviliškis District Municipality', 'url' => '/ui-ux-design-agency-in-radviliskis-district-municipality-lithuania', 'basename' => 'ui-ux-design-agency-in-radviliskis-district-municipality-lithuania'],
  ['name' => 'Raseiniai District Municipality', 'url' => '/ui-ux-design-agency-in-raseiniai-district-municipality-lithuania', 'basename' => 'ui-ux-design-agency-in-raseiniai-district-municipality-lithuania'],
  ['name' => 'Rietavas municipality', 'url' => '/ui-ux-design-agency-in-rietavas-municipality-lithuania', 'basename' => 'ui-ux-design-agency-in-rietavas-municipality-lithuania'],
  ['name' => 'Rokiškis District Municipality', 'url' => '/ui-ux-design-agency-in-rokiskis-district-municipality-lithuania', 'basename' => 'ui-ux-design-agency-in-rokiskis-district-municipality-lithuania'],
  ['name' => 'Šakiai District Municipality', 'url' => '/ui-ux-design-agency-in-sakiai-district-municipality-lithuania', 'basename' => 'ui-ux-design-agency-in-sakiai-district-municipality-lithuania'],
  ['name' => 'Šalčininkai District Municipality', 'url' => '/ui-ux-design-agency-in-salcininkai-district-municipality-lithuania', 'basename' => 'ui-ux-design-agency-in-salcininkai-district-municipality-lithuania'],
  ['name' => 'Šiauliai City Municipality', 'url' => '/ui-ux-design-agency-in-siauliai-city-municipality-lithuania', 'basename' => 'ui-ux-design-agency-in-siauliai-city-municipality-lithuania'],
  ['name' => 'Šiauliai County', 'url' => '/ui-ux-design-agency-in-siauliai-county-lithuania', 'basename' => 'ui-ux-design-agency-in-siauliai-county-lithuania'],
  ['name' => 'Šiauliai District Municipality', 'url' => '/ui-ux-design-agency-in-siauliai-district-municipality-lithuania', 'basename' => 'ui-ux-design-agency-in-siauliai-district-municipality-lithuania'],
  ['name' => 'Šilalė District Municipality', 'url' => '/ui-ux-design-agency-in-silale-district-municipality-lithuania', 'basename' => 'ui-ux-design-agency-in-silale-district-municipality-lithuania'],
  ['name' => 'Šilutė District Municipality', 'url' => '/ui-ux-design-agency-in-silute-district-municipality-lithuania', 'basename' => 'ui-ux-design-agency-in-silute-district-municipality-lithuania'],
  ['name' => 'Širvintos District Municipality', 'url' => '/ui-ux-design-agency-in-sirvintos-district-municipality-lithuania', 'basename' => 'ui-ux-design-agency-in-sirvintos-district-municipality-lithuania'],
  ['name' => 'Skuodas District Municipality', 'url' => '/ui-ux-design-agency-in-skuodas-district-municipality-lithuania', 'basename' => 'ui-ux-design-agency-in-skuodas-district-municipality-lithuania'],
  ['name' => 'Švenčionys District Municipality', 'url' => '/ui-ux-design-agency-in-svencionys-district-municipality-lithuania', 'basename' => 'ui-ux-design-agency-in-svencionys-district-municipality-lithuania'],
  ['name' => 'Tauragė County', 'url' => '/ui-ux-design-agency-in-taurage-county-lithuania', 'basename' => 'ui-ux-design-agency-in-taurage-county-lithuania'],
  ['name' => 'Tauragė District Municipality', 'url' => '/ui-ux-design-agency-in-taurage-district-municipality-lithuania', 'basename' => 'ui-ux-design-agency-in-taurage-district-municipality-lithuania'],
  ['name' => 'Telšiai County', 'url' => '/ui-ux-design-agency-in-telsiai-county-lithuania', 'basename' => 'ui-ux-design-agency-in-telsiai-county-lithuania'],
  ['name' => 'Telšiai District Municipality', 'url' => '/ui-ux-design-agency-in-telsiai-district-municipality-lithuania', 'basename' => 'ui-ux-design-agency-in-telsiai-district-municipality-lithuania'],
  ['name' => 'Trakai District Municipality', 'url' => '/ui-ux-design-agency-in-trakai-district-municipality-lithuania', 'basename' => 'ui-ux-design-agency-in-trakai-district-municipality-lithuania'],
  ['name' => 'Ukmergė District Municipality', 'url' => '/ui-ux-design-agency-in-ukmerge-district-municipality-lithuania', 'basename' => 'ui-ux-design-agency-in-ukmerge-district-municipality-lithuania'],
  ['name' => 'Utena County', 'url' => '/ui-ux-design-agency-in-utena-county-lithuania', 'basename' => 'ui-ux-design-agency-in-utena-county-lithuania'],
  ['name' => 'Utena District Municipality', 'url' => '/ui-ux-design-agency-in-utena-district-municipality-lithuania', 'basename' => 'ui-ux-design-agency-in-utena-district-municipality-lithuania'],
  ['name' => 'Varėna District Municipality', 'url' => '/ui-ux-design-agency-in-varena-district-municipality-lithuania', 'basename' => 'ui-ux-design-agency-in-varena-district-municipality-lithuania'],
  ['name' => 'Vilkaviškis District Municipality', 'url' => '/ui-ux-design-agency-in-vilkaviskis-district-municipality-lithuania', 'basename' => 'ui-ux-design-agency-in-vilkaviskis-district-municipality-lithuania'],
  ['name' => 'Vilnius City Municipality', 'url' => '/ui-ux-design-agency-in-vilnius-city-municipality-lithuania', 'basename' => 'ui-ux-design-agency-in-vilnius-city-municipality-lithuania'],
  ['name' => 'Vilnius County', 'url' => '/ui-ux-design-agency-in-vilnius-county-lithuania', 'basename' => 'ui-ux-design-agency-in-vilnius-county-lithuania'],
  ['name' => 'Vilnius District Municipality', 'url' => '/ui-ux-design-agency-in-vilnius-district-municipality-lithuania', 'basename' => 'ui-ux-design-agency-in-vilnius-district-municipality-lithuania'],
  ['name' => 'Visaginas Municipality', 'url' => '/ui-ux-design-agency-in-visaginas-municipality-lithuania', 'basename' => 'ui-ux-design-agency-in-visaginas-municipality-lithuania'],
  ['name' => 'Zarasai District Municipality', 'url' => '/ui-ux-design-agency-in-zarasai-district-municipality-lithuania', 'basename' => 'ui-ux-design-agency-in-zarasai-district-municipality-lithuania'],
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

    <!-- ── Hub: Browse all regions in Lithuania ── -->
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
      <h2>Browse UI/UX Design Services Across Lithuania</h2>
      <p class="hub-sub">We serve 69 regions, states, and cities in Lithuania. Select a location to see how UX Pacific can help your business.</p>
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