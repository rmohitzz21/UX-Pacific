<?php
require_once __DIR__ . '/includes/cms_repository.php';

$countrySlug = 'russia';

$featuredProjects   = get_published_projects('all', true);
$ecosystemHomeItems = get_published_ecosystem();

function home_image_url(?string $url): string {
  $url = trim((string) $url);
  if ($url === '') return uxp_normalize_stored_media_url('img/ux.webp');
  if (preg_match('#^https?://#i', $url)) return $url;
  return uxp_normalize_stored_media_url($url);
}

$pageTitle   = 'UI UX Design Agency in Russia | UX Pacific';
$pageDesc    = 'UX Pacific delivers expert UI/UX design services across Russia. Browse our locations or book a free UX audit today.';
$canonicalUrl = 'https://www.uxpacific.com/ui-ux-design-agency-in-russia';
$ogTitle     = 'UI UX Design Agency in Russia | UX Pacific';
$ogDesc      = 'UX Pacific delivers expert UI/UX design services across Russia. Browse our locations or book a free UX audit today.';
$ogUrl       = 'https://www.uxpacific.com/ui-ux-design-agency-in-russia';
$currentPage = 'Home';

// Schema: WebPage + BreadcrumbList
$ldJson = json_encode([
  '@context' => 'https://schema.org',
  '@graph'   => [
    ['@type' => 'WebPage',
     'url'   => 'https://www.uxpacific.com/ui-ux-design-agency-in-russia',
     'name'  => 'UI UX Design Agency in Russia | UX Pacific',
     'inLanguage' => 'en',
    ],
    ['@type' => 'BreadcrumbList',
     'itemListElement' => [
       ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home',       'item' => BASE_URL . '/'],
       ['@type' => 'ListItem', 'position' => 2, 'name' => 'Russia', 'item' => 'https://www.uxpacific.com/ui-ux-design-agency-in-russia'],
     ],
    ],
  ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

$geoPage = uxp_geo_page($countrySlug);
if ($geoPage) {
  if (!empty($geoPage['page_title']))      { $pageTitle = (string) $geoPage['page_title']; $ogTitle = $pageTitle; }
  if (!empty($geoPage['meta_description'])) { $pageDesc  = (string) $geoPage['meta_description']; $ogDesc = $pageDesc; }
}

// Child locations in Russia
$hubChildren = [
  ['name' => 'Altai Krai', 'url' => '/ui-ux-design-agency-in-altai-krai-russia', 'basename' => 'ui-ux-design-agency-in-altai-krai-russia'],
  ['name' => 'Altai Republic', 'url' => '/ui-ux-design-agency-in-altai-republic-russia', 'basename' => 'ui-ux-design-agency-in-altai-republic-russia'],
  ['name' => 'Amur Oblast', 'url' => '/ui-ux-design-agency-in-amur-oblast-russia', 'basename' => 'ui-ux-design-agency-in-amur-oblast-russia'],
  ['name' => 'Arkhangelsk', 'url' => '/ui-ux-design-agency-in-arkhangelsk-russia', 'basename' => 'ui-ux-design-agency-in-arkhangelsk-russia'],
  ['name' => 'Astrakhan Oblast', 'url' => '/ui-ux-design-agency-in-astrakhan-oblast-russia', 'basename' => 'ui-ux-design-agency-in-astrakhan-oblast-russia'],
  ['name' => 'Belgorod Oblast', 'url' => '/ui-ux-design-agency-in-belgorod-oblast-russia', 'basename' => 'ui-ux-design-agency-in-belgorod-oblast-russia'],
  ['name' => 'Bryansk Oblast', 'url' => '/ui-ux-design-agency-in-bryansk-oblast-russia', 'basename' => 'ui-ux-design-agency-in-bryansk-oblast-russia'],
  ['name' => 'Chechen Republic', 'url' => '/ui-ux-design-agency-in-chechen-republic-russia', 'basename' => 'ui-ux-design-agency-in-chechen-republic-russia'],
  ['name' => 'Chelyabinsk Oblast', 'url' => '/ui-ux-design-agency-in-chelyabinsk-oblast-russia', 'basename' => 'ui-ux-design-agency-in-chelyabinsk-oblast-russia'],
  ['name' => 'Chukotka Autonomous Okrug', 'url' => '/ui-ux-design-agency-in-chukotka-autonomous-okrug-russia', 'basename' => 'ui-ux-design-agency-in-chukotka-autonomous-okrug-russia'],
  ['name' => 'Chuvash Republic', 'url' => '/ui-ux-design-agency-in-chuvash-republic-russia', 'basename' => 'ui-ux-design-agency-in-chuvash-republic-russia'],
  ['name' => 'Irkutsk', 'url' => '/ui-ux-design-agency-in-irkutsk-russia', 'basename' => 'ui-ux-design-agency-in-irkutsk-russia'],
  ['name' => 'Ivanovo Oblast', 'url' => '/ui-ux-design-agency-in-ivanovo-oblast-russia', 'basename' => 'ui-ux-design-agency-in-ivanovo-oblast-russia'],
  ['name' => 'Jewish Autonomous Oblast', 'url' => '/ui-ux-design-agency-in-jewish-autonomous-oblast-russia', 'basename' => 'ui-ux-design-agency-in-jewish-autonomous-oblast-russia'],
  ['name' => 'Kabardino-Balkar Republic', 'url' => '/ui-ux-design-agency-in-kabardino-balkar-republic-russia', 'basename' => 'ui-ux-design-agency-in-kabardino-balkar-republic-russia'],
  ['name' => 'Kaliningrad', 'url' => '/ui-ux-design-agency-in-kaliningrad-russia', 'basename' => 'ui-ux-design-agency-in-kaliningrad-russia'],
  ['name' => 'Kaluga Oblast', 'url' => '/ui-ux-design-agency-in-kaluga-oblast-russia', 'basename' => 'ui-ux-design-agency-in-kaluga-oblast-russia'],
  ['name' => 'Kamchatka Krai', 'url' => '/ui-ux-design-agency-in-kamchatka-krai-russia', 'basename' => 'ui-ux-design-agency-in-kamchatka-krai-russia'],
  ['name' => 'Karachay-Cherkess Republic', 'url' => '/ui-ux-design-agency-in-karachay-cherkess-republic-russia', 'basename' => 'ui-ux-design-agency-in-karachay-cherkess-republic-russia'],
  ['name' => 'Kemerovo Oblast', 'url' => '/ui-ux-design-agency-in-kemerovo-oblast-russia', 'basename' => 'ui-ux-design-agency-in-kemerovo-oblast-russia'],
  ['name' => 'Khabarovsk Krai', 'url' => '/ui-ux-design-agency-in-khabarovsk-krai-russia', 'basename' => 'ui-ux-design-agency-in-khabarovsk-krai-russia'],
  ['name' => 'Khanty-Mansi Autonomous Okrug', 'url' => '/ui-ux-design-agency-in-khanty-mansi-autonomous-okrug-russia', 'basename' => 'ui-ux-design-agency-in-khanty-mansi-autonomous-okrug-russia'],
  ['name' => 'Kirov Oblast', 'url' => '/ui-ux-design-agency-in-kirov-oblast-russia', 'basename' => 'ui-ux-design-agency-in-kirov-oblast-russia'],
  ['name' => 'Komi Republic', 'url' => '/ui-ux-design-agency-in-komi-republic-russia', 'basename' => 'ui-ux-design-agency-in-komi-republic-russia'],
  ['name' => 'Kostroma Oblast', 'url' => '/ui-ux-design-agency-in-kostroma-oblast-russia', 'basename' => 'ui-ux-design-agency-in-kostroma-oblast-russia'],
  ['name' => 'Krasnodar Krai', 'url' => '/ui-ux-design-agency-in-krasnodar-krai-russia', 'basename' => 'ui-ux-design-agency-in-krasnodar-krai-russia'],
  ['name' => 'Krasnoyarsk Krai', 'url' => '/ui-ux-design-agency-in-krasnoyarsk-krai-russia', 'basename' => 'ui-ux-design-agency-in-krasnoyarsk-krai-russia'],
  ['name' => 'Kurgan Oblast', 'url' => '/ui-ux-design-agency-in-kurgan-oblast-russia', 'basename' => 'ui-ux-design-agency-in-kurgan-oblast-russia'],
  ['name' => 'Kursk Oblast', 'url' => '/ui-ux-design-agency-in-kursk-oblast-russia', 'basename' => 'ui-ux-design-agency-in-kursk-oblast-russia'],
  ['name' => 'Leningrad Oblast', 'url' => '/ui-ux-design-agency-in-leningrad-oblast-russia', 'basename' => 'ui-ux-design-agency-in-leningrad-oblast-russia'],
  ['name' => 'Lipetsk Oblast', 'url' => '/ui-ux-design-agency-in-lipetsk-oblast-russia', 'basename' => 'ui-ux-design-agency-in-lipetsk-oblast-russia'],
  ['name' => 'Magadan Oblast', 'url' => '/ui-ux-design-agency-in-magadan-oblast-russia', 'basename' => 'ui-ux-design-agency-in-magadan-oblast-russia'],
  ['name' => 'Mari El Republic', 'url' => '/ui-ux-design-agency-in-mari-el-republic-russia', 'basename' => 'ui-ux-design-agency-in-mari-el-republic-russia'],
  ['name' => 'Moscow Oblast', 'url' => '/ui-ux-design-agency-in-moscow-oblast-russia', 'basename' => 'ui-ux-design-agency-in-moscow-oblast-russia'],
  ['name' => 'Moscow', 'url' => '/ui-ux-design-agency-in-moscow-russia', 'basename' => 'ui-ux-design-agency-in-moscow-russia'],
  ['name' => 'Murmansk Oblast', 'url' => '/ui-ux-design-agency-in-murmansk-oblast-russia', 'basename' => 'ui-ux-design-agency-in-murmansk-oblast-russia'],
  ['name' => 'Nenets Autonomous Okrug', 'url' => '/ui-ux-design-agency-in-nenets-autonomous-okrug-russia', 'basename' => 'ui-ux-design-agency-in-nenets-autonomous-okrug-russia'],
  ['name' => 'Nizhny Novgorod Oblast', 'url' => '/ui-ux-design-agency-in-nizhny-novgorod-oblast-russia', 'basename' => 'ui-ux-design-agency-in-nizhny-novgorod-oblast-russia'],
  ['name' => 'Novgorod Oblast', 'url' => '/ui-ux-design-agency-in-novgorod-oblast-russia', 'basename' => 'ui-ux-design-agency-in-novgorod-oblast-russia'],
  ['name' => 'Novosibirsk', 'url' => '/ui-ux-design-agency-in-novosibirsk-russia', 'basename' => 'ui-ux-design-agency-in-novosibirsk-russia'],
  ['name' => 'Omsk Oblast', 'url' => '/ui-ux-design-agency-in-omsk-oblast-russia', 'basename' => 'ui-ux-design-agency-in-omsk-oblast-russia'],
  ['name' => 'Orenburg Oblast', 'url' => '/ui-ux-design-agency-in-orenburg-oblast-russia', 'basename' => 'ui-ux-design-agency-in-orenburg-oblast-russia'],
  ['name' => 'Oryol Oblast', 'url' => '/ui-ux-design-agency-in-oryol-oblast-russia', 'basename' => 'ui-ux-design-agency-in-oryol-oblast-russia'],
  ['name' => 'Penza Oblast', 'url' => '/ui-ux-design-agency-in-penza-oblast-russia', 'basename' => 'ui-ux-design-agency-in-penza-oblast-russia'],
  ['name' => 'Perm Krai', 'url' => '/ui-ux-design-agency-in-perm-krai-russia', 'basename' => 'ui-ux-design-agency-in-perm-krai-russia'],
  ['name' => 'Primorsky Krai', 'url' => '/ui-ux-design-agency-in-primorsky-krai-russia', 'basename' => 'ui-ux-design-agency-in-primorsky-krai-russia'],
  ['name' => 'Pskov Oblast', 'url' => '/ui-ux-design-agency-in-pskov-oblast-russia', 'basename' => 'ui-ux-design-agency-in-pskov-oblast-russia'],
  ['name' => 'Republic of Adygea', 'url' => '/ui-ux-design-agency-in-republic-of-adygea-russia', 'basename' => 'ui-ux-design-agency-in-republic-of-adygea-russia'],
  ['name' => 'Republic of Bashkortostan', 'url' => '/ui-ux-design-agency-in-republic-of-bashkortostan-russia', 'basename' => 'ui-ux-design-agency-in-republic-of-bashkortostan-russia'],
  ['name' => 'Republic of Buryatia', 'url' => '/ui-ux-design-agency-in-republic-of-buryatia-russia', 'basename' => 'ui-ux-design-agency-in-republic-of-buryatia-russia'],
  ['name' => 'Republic of Dagestan', 'url' => '/ui-ux-design-agency-in-republic-of-dagestan-russia', 'basename' => 'ui-ux-design-agency-in-republic-of-dagestan-russia'],
  ['name' => 'Republic of Ingushetia', 'url' => '/ui-ux-design-agency-in-republic-of-ingushetia-russia', 'basename' => 'ui-ux-design-agency-in-republic-of-ingushetia-russia'],
  ['name' => 'Republic of Kalmykia', 'url' => '/ui-ux-design-agency-in-republic-of-kalmykia-russia', 'basename' => 'ui-ux-design-agency-in-republic-of-kalmykia-russia'],
  ['name' => 'Republic of Karelia', 'url' => '/ui-ux-design-agency-in-republic-of-karelia-russia', 'basename' => 'ui-ux-design-agency-in-republic-of-karelia-russia'],
  ['name' => 'Republic of Khakassia', 'url' => '/ui-ux-design-agency-in-republic-of-khakassia-russia', 'basename' => 'ui-ux-design-agency-in-republic-of-khakassia-russia'],
  ['name' => 'Republic of Mordovia', 'url' => '/ui-ux-design-agency-in-republic-of-mordovia-russia', 'basename' => 'ui-ux-design-agency-in-republic-of-mordovia-russia'],
  ['name' => 'Republic of North Ossetia-Alania', 'url' => '/ui-ux-design-agency-in-republic-of-north-ossetia-alania-russia', 'basename' => 'ui-ux-design-agency-in-republic-of-north-ossetia-alania-russia'],
  ['name' => 'Republic of Tatarstan', 'url' => '/ui-ux-design-agency-in-republic-of-tatarstan-russia', 'basename' => 'ui-ux-design-agency-in-republic-of-tatarstan-russia'],
  ['name' => 'Rostov Oblast', 'url' => '/ui-ux-design-agency-in-rostov-oblast-russia', 'basename' => 'ui-ux-design-agency-in-rostov-oblast-russia'],
  ['name' => 'Ryazan Oblast', 'url' => '/ui-ux-design-agency-in-ryazan-oblast-russia', 'basename' => 'ui-ux-design-agency-in-ryazan-oblast-russia'],
  ['name' => 'Saint Petersburg', 'url' => '/ui-ux-design-agency-in-saint-petersburg-russia', 'basename' => 'ui-ux-design-agency-in-saint-petersburg-russia'],
  ['name' => 'Sakha Republic', 'url' => '/ui-ux-design-agency-in-sakha-republic-russia', 'basename' => 'ui-ux-design-agency-in-sakha-republic-russia'],
  ['name' => 'Sakhalin', 'url' => '/ui-ux-design-agency-in-sakhalin-russia', 'basename' => 'ui-ux-design-agency-in-sakhalin-russia'],
  ['name' => 'Samara Oblast', 'url' => '/ui-ux-design-agency-in-samara-oblast-russia', 'basename' => 'ui-ux-design-agency-in-samara-oblast-russia'],
  ['name' => 'Saratov Oblast', 'url' => '/ui-ux-design-agency-in-saratov-oblast-russia', 'basename' => 'ui-ux-design-agency-in-saratov-oblast-russia'],
  ['name' => 'Sevastopol', 'url' => '/ui-ux-design-agency-in-sevastopol-russia', 'basename' => 'ui-ux-design-agency-in-sevastopol-russia'],
  ['name' => 'Smolensk Oblast', 'url' => '/ui-ux-design-agency-in-smolensk-oblast-russia', 'basename' => 'ui-ux-design-agency-in-smolensk-oblast-russia'],
  ['name' => 'Stavropol Krai', 'url' => '/ui-ux-design-agency-in-stavropol-krai-russia', 'basename' => 'ui-ux-design-agency-in-stavropol-krai-russia'],
  ['name' => 'Sverdlovsk', 'url' => '/ui-ux-design-agency-in-sverdlovsk-russia', 'basename' => 'ui-ux-design-agency-in-sverdlovsk-russia'],
  ['name' => 'Tambov Oblast', 'url' => '/ui-ux-design-agency-in-tambov-oblast-russia', 'basename' => 'ui-ux-design-agency-in-tambov-oblast-russia'],
  ['name' => 'Tomsk Oblast', 'url' => '/ui-ux-design-agency-in-tomsk-oblast-russia', 'basename' => 'ui-ux-design-agency-in-tomsk-oblast-russia'],
  ['name' => 'Tula Oblast', 'url' => '/ui-ux-design-agency-in-tula-oblast-russia', 'basename' => 'ui-ux-design-agency-in-tula-oblast-russia'],
  ['name' => 'Tuva Republic', 'url' => '/ui-ux-design-agency-in-tuva-republic-russia', 'basename' => 'ui-ux-design-agency-in-tuva-republic-russia'],
  ['name' => 'Tver Oblast', 'url' => '/ui-ux-design-agency-in-tver-oblast-russia', 'basename' => 'ui-ux-design-agency-in-tver-oblast-russia'],
  ['name' => 'Tyumen Oblast', 'url' => '/ui-ux-design-agency-in-tyumen-oblast-russia', 'basename' => 'ui-ux-design-agency-in-tyumen-oblast-russia'],
  ['name' => 'Udmurt Republic', 'url' => '/ui-ux-design-agency-in-udmurt-republic-russia', 'basename' => 'ui-ux-design-agency-in-udmurt-republic-russia'],
  ['name' => 'Ulyanovsk Oblast', 'url' => '/ui-ux-design-agency-in-ulyanovsk-oblast-russia', 'basename' => 'ui-ux-design-agency-in-ulyanovsk-oblast-russia'],
  ['name' => 'Vladimir Oblast', 'url' => '/ui-ux-design-agency-in-vladimir-oblast-russia', 'basename' => 'ui-ux-design-agency-in-vladimir-oblast-russia'],
  ['name' => 'Volgograd Oblast', 'url' => '/ui-ux-design-agency-in-volgograd-oblast-russia', 'basename' => 'ui-ux-design-agency-in-volgograd-oblast-russia'],
  ['name' => 'Vologda Oblast', 'url' => '/ui-ux-design-agency-in-vologda-oblast-russia', 'basename' => 'ui-ux-design-agency-in-vologda-oblast-russia'],
  ['name' => 'Voronezh Oblast', 'url' => '/ui-ux-design-agency-in-voronezh-oblast-russia', 'basename' => 'ui-ux-design-agency-in-voronezh-oblast-russia'],
  ['name' => 'Yamalo-Nenets Autonomous Okrug', 'url' => '/ui-ux-design-agency-in-yamalo-nenets-autonomous-okrug-russia', 'basename' => 'ui-ux-design-agency-in-yamalo-nenets-autonomous-okrug-russia'],
  ['name' => 'Yaroslavl Oblast', 'url' => '/ui-ux-design-agency-in-yaroslavl-oblast-russia', 'basename' => 'ui-ux-design-agency-in-yaroslavl-oblast-russia'],
  ['name' => 'Zabaykalsky Krai', 'url' => '/ui-ux-design-agency-in-zabaykalsky-krai-russia', 'basename' => 'ui-ux-design-agency-in-zabaykalsky-krai-russia'],
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

    <!-- ── Hub: Browse all regions in Russia ── -->
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
      <h2>Browse UI/UX Design Services Across Russia</h2>
      <p class="hub-sub">We serve 84 regions, states, and cities in Russia. Select a location to see how UX Pacific can help your business.</p>
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