<?php
require_once __DIR__ . '/includes/cms_repository.php';

$countrySlug = 'thailand';

$featuredProjects   = get_published_projects('all', true);
$ecosystemHomeItems = get_published_ecosystem();

function home_image_url(?string $url): string {
  $url = trim((string) $url);
  if ($url === '') return uxp_normalize_stored_media_url('img/ux.webp');
  if (preg_match('#^https?://#i', $url)) return $url;
  return uxp_normalize_stored_media_url($url);
}

$pageTitle   = 'UI UX Design Agency in Thailand | UX Pacific';
$pageDesc    = 'UX Pacific delivers expert UI/UX design services across Thailand. Browse our locations or book a free UX audit today.';
$canonicalUrl = 'https://www.uxpacific.com/ui-ux-design-agency-in-thailand';
$ogTitle     = 'UI UX Design Agency in Thailand | UX Pacific';
$ogDesc      = 'UX Pacific delivers expert UI/UX design services across Thailand. Browse our locations or book a free UX audit today.';
$ogUrl       = 'https://www.uxpacific.com/ui-ux-design-agency-in-thailand';
$currentPage = 'Home';

// Schema: WebPage + BreadcrumbList
$ldJson = json_encode([
  '@context' => 'https://schema.org',
  '@graph'   => [
    ['@type' => 'WebPage',
     'url'   => 'https://www.uxpacific.com/ui-ux-design-agency-in-thailand',
     'name'  => 'UI UX Design Agency in Thailand | UX Pacific',
     'inLanguage' => 'en',
    ],
    ['@type' => 'BreadcrumbList',
     'itemListElement' => [
       ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home',       'item' => BASE_URL . '/'],
       ['@type' => 'ListItem', 'position' => 2, 'name' => 'Thailand', 'item' => 'https://www.uxpacific.com/ui-ux-design-agency-in-thailand'],
     ],
    ],
  ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

$geoPage = uxp_geo_page($countrySlug);
if ($geoPage) {
  if (!empty($geoPage['page_title']))      { $pageTitle = (string) $geoPage['page_title']; $ogTitle = $pageTitle; }
  if (!empty($geoPage['meta_description'])) { $pageDesc  = (string) $geoPage['meta_description']; $ogDesc = $pageDesc; }
}

// Child locations in Thailand
$hubChildren = [
  ['name' => 'Amnat Charoen', 'url' => '/ui-ux-design-agency-in-amnat-charoen-thailand', 'basename' => 'ui-ux-design-agency-in-amnat-charoen-thailand'],
  ['name' => 'Ang Thong', 'url' => '/ui-ux-design-agency-in-ang-thong-thailand', 'basename' => 'ui-ux-design-agency-in-ang-thong-thailand'],
  ['name' => 'Bangkok', 'url' => '/ui-ux-design-agency-in-bangkok-thailand', 'basename' => 'ui-ux-design-agency-in-bangkok-thailand'],
  ['name' => 'Bueng Kan', 'url' => '/ui-ux-design-agency-in-bueng-kan-thailand', 'basename' => 'ui-ux-design-agency-in-bueng-kan-thailand'],
  ['name' => 'Buri Ram', 'url' => '/ui-ux-design-agency-in-buri-ram-thailand', 'basename' => 'ui-ux-design-agency-in-buri-ram-thailand'],
  ['name' => 'Chachoengsao', 'url' => '/ui-ux-design-agency-in-chachoengsao-thailand', 'basename' => 'ui-ux-design-agency-in-chachoengsao-thailand'],
  ['name' => 'Chai Nat', 'url' => '/ui-ux-design-agency-in-chai-nat-thailand', 'basename' => 'ui-ux-design-agency-in-chai-nat-thailand'],
  ['name' => 'Chaiyaphum', 'url' => '/ui-ux-design-agency-in-chaiyaphum-thailand', 'basename' => 'ui-ux-design-agency-in-chaiyaphum-thailand'],
  ['name' => 'Chanthaburi', 'url' => '/ui-ux-design-agency-in-chanthaburi-thailand', 'basename' => 'ui-ux-design-agency-in-chanthaburi-thailand'],
  ['name' => 'Chiang Mai', 'url' => '/ui-ux-design-agency-in-chiang-mai-thailand', 'basename' => 'ui-ux-design-agency-in-chiang-mai-thailand'],
  ['name' => 'Chiang Rai', 'url' => '/ui-ux-design-agency-in-chiang-rai-thailand', 'basename' => 'ui-ux-design-agency-in-chiang-rai-thailand'],
  ['name' => 'Chon Buri', 'url' => '/ui-ux-design-agency-in-chon-buri-thailand', 'basename' => 'ui-ux-design-agency-in-chon-buri-thailand'],
  ['name' => 'Chumphon', 'url' => '/ui-ux-design-agency-in-chumphon-thailand', 'basename' => 'ui-ux-design-agency-in-chumphon-thailand'],
  ['name' => 'Kalasin', 'url' => '/ui-ux-design-agency-in-kalasin-thailand', 'basename' => 'ui-ux-design-agency-in-kalasin-thailand'],
  ['name' => 'Kamphaeng Phet', 'url' => '/ui-ux-design-agency-in-kamphaeng-phet-thailand', 'basename' => 'ui-ux-design-agency-in-kamphaeng-phet-thailand'],
  ['name' => 'Kanchanaburi', 'url' => '/ui-ux-design-agency-in-kanchanaburi-thailand', 'basename' => 'ui-ux-design-agency-in-kanchanaburi-thailand'],
  ['name' => 'Khon Kaen', 'url' => '/ui-ux-design-agency-in-khon-kaen-thailand', 'basename' => 'ui-ux-design-agency-in-khon-kaen-thailand'],
  ['name' => 'Krabi', 'url' => '/ui-ux-design-agency-in-krabi-thailand', 'basename' => 'ui-ux-design-agency-in-krabi-thailand'],
  ['name' => 'Lampang', 'url' => '/ui-ux-design-agency-in-lampang-thailand', 'basename' => 'ui-ux-design-agency-in-lampang-thailand'],
  ['name' => 'Lamphun', 'url' => '/ui-ux-design-agency-in-lamphun-thailand', 'basename' => 'ui-ux-design-agency-in-lamphun-thailand'],
  ['name' => 'Loei', 'url' => '/ui-ux-design-agency-in-loei-thailand', 'basename' => 'ui-ux-design-agency-in-loei-thailand'],
  ['name' => 'Lop Buri', 'url' => '/ui-ux-design-agency-in-lop-buri-thailand', 'basename' => 'ui-ux-design-agency-in-lop-buri-thailand'],
  ['name' => 'Mae Hong Son', 'url' => '/ui-ux-design-agency-in-mae-hong-son-thailand', 'basename' => 'ui-ux-design-agency-in-mae-hong-son-thailand'],
  ['name' => 'Maha Sarakham', 'url' => '/ui-ux-design-agency-in-maha-sarakham-thailand', 'basename' => 'ui-ux-design-agency-in-maha-sarakham-thailand'],
  ['name' => 'Mukdahan', 'url' => '/ui-ux-design-agency-in-mukdahan-thailand', 'basename' => 'ui-ux-design-agency-in-mukdahan-thailand'],
  ['name' => 'Nakhon Nayok', 'url' => '/ui-ux-design-agency-in-nakhon-nayok-thailand', 'basename' => 'ui-ux-design-agency-in-nakhon-nayok-thailand'],
  ['name' => 'Nakhon Pathom', 'url' => '/ui-ux-design-agency-in-nakhon-pathom-thailand', 'basename' => 'ui-ux-design-agency-in-nakhon-pathom-thailand'],
  ['name' => 'Nakhon Phanom', 'url' => '/ui-ux-design-agency-in-nakhon-phanom-thailand', 'basename' => 'ui-ux-design-agency-in-nakhon-phanom-thailand'],
  ['name' => 'Nakhon Ratchasima', 'url' => '/ui-ux-design-agency-in-nakhon-ratchasima-thailand', 'basename' => 'ui-ux-design-agency-in-nakhon-ratchasima-thailand'],
  ['name' => 'Nakhon Sawan', 'url' => '/ui-ux-design-agency-in-nakhon-sawan-thailand', 'basename' => 'ui-ux-design-agency-in-nakhon-sawan-thailand'],
  ['name' => 'Nakhon Si Thammarat', 'url' => '/ui-ux-design-agency-in-nakhon-si-thammarat-thailand', 'basename' => 'ui-ux-design-agency-in-nakhon-si-thammarat-thailand'],
  ['name' => 'Nan', 'url' => '/ui-ux-design-agency-in-nan-thailand', 'basename' => 'ui-ux-design-agency-in-nan-thailand'],
  ['name' => 'Narathiwat', 'url' => '/ui-ux-design-agency-in-narathiwat-thailand', 'basename' => 'ui-ux-design-agency-in-narathiwat-thailand'],
  ['name' => 'Nong Bua Lam Phu', 'url' => '/ui-ux-design-agency-in-nong-bua-lam-phu-thailand', 'basename' => 'ui-ux-design-agency-in-nong-bua-lam-phu-thailand'],
  ['name' => 'Nong Khai', 'url' => '/ui-ux-design-agency-in-nong-khai-thailand', 'basename' => 'ui-ux-design-agency-in-nong-khai-thailand'],
  ['name' => 'Nonthaburi', 'url' => '/ui-ux-design-agency-in-nonthaburi-thailand', 'basename' => 'ui-ux-design-agency-in-nonthaburi-thailand'],
  ['name' => 'Pathum Thani', 'url' => '/ui-ux-design-agency-in-pathum-thani-thailand', 'basename' => 'ui-ux-design-agency-in-pathum-thani-thailand'],
  ['name' => 'Pattani', 'url' => '/ui-ux-design-agency-in-pattani-thailand', 'basename' => 'ui-ux-design-agency-in-pattani-thailand'],
  ['name' => 'Pattaya', 'url' => '/ui-ux-design-agency-in-pattaya-thailand', 'basename' => 'ui-ux-design-agency-in-pattaya-thailand'],
  ['name' => 'Phangnga', 'url' => '/ui-ux-design-agency-in-phangnga-thailand', 'basename' => 'ui-ux-design-agency-in-phangnga-thailand'],
  ['name' => 'Phatthalung', 'url' => '/ui-ux-design-agency-in-phatthalung-thailand', 'basename' => 'ui-ux-design-agency-in-phatthalung-thailand'],
  ['name' => 'Phayao', 'url' => '/ui-ux-design-agency-in-phayao-thailand', 'basename' => 'ui-ux-design-agency-in-phayao-thailand'],
  ['name' => 'Phetchabun', 'url' => '/ui-ux-design-agency-in-phetchabun-thailand', 'basename' => 'ui-ux-design-agency-in-phetchabun-thailand'],
  ['name' => 'Phetchaburi', 'url' => '/ui-ux-design-agency-in-phetchaburi-thailand', 'basename' => 'ui-ux-design-agency-in-phetchaburi-thailand'],
  ['name' => 'Phichit', 'url' => '/ui-ux-design-agency-in-phichit-thailand', 'basename' => 'ui-ux-design-agency-in-phichit-thailand'],
  ['name' => 'Phitsanulok', 'url' => '/ui-ux-design-agency-in-phitsanulok-thailand', 'basename' => 'ui-ux-design-agency-in-phitsanulok-thailand'],
  ['name' => 'Phra Nakhon Si Ayutthaya', 'url' => '/ui-ux-design-agency-in-phra-nakhon-si-ayutthaya-thailand', 'basename' => 'ui-ux-design-agency-in-phra-nakhon-si-ayutthaya-thailand'],
  ['name' => 'Phrae', 'url' => '/ui-ux-design-agency-in-phrae-thailand', 'basename' => 'ui-ux-design-agency-in-phrae-thailand'],
  ['name' => 'Phuket', 'url' => '/ui-ux-design-agency-in-phuket-thailand', 'basename' => 'ui-ux-design-agency-in-phuket-thailand'],
  ['name' => 'Prachin Buri', 'url' => '/ui-ux-design-agency-in-prachin-buri-thailand', 'basename' => 'ui-ux-design-agency-in-prachin-buri-thailand'],
  ['name' => 'Prachuap Khiri Khan', 'url' => '/ui-ux-design-agency-in-prachuap-khiri-khan-thailand', 'basename' => 'ui-ux-design-agency-in-prachuap-khiri-khan-thailand'],
  ['name' => 'Ranong', 'url' => '/ui-ux-design-agency-in-ranong-thailand', 'basename' => 'ui-ux-design-agency-in-ranong-thailand'],
  ['name' => 'Ratchaburi', 'url' => '/ui-ux-design-agency-in-ratchaburi-thailand', 'basename' => 'ui-ux-design-agency-in-ratchaburi-thailand'],
  ['name' => 'Rayong', 'url' => '/ui-ux-design-agency-in-rayong-thailand', 'basename' => 'ui-ux-design-agency-in-rayong-thailand'],
  ['name' => 'Roi Et', 'url' => '/ui-ux-design-agency-in-roi-et-thailand', 'basename' => 'ui-ux-design-agency-in-roi-et-thailand'],
  ['name' => 'Sa Kaeo', 'url' => '/ui-ux-design-agency-in-sa-kaeo-thailand', 'basename' => 'ui-ux-design-agency-in-sa-kaeo-thailand'],
  ['name' => 'Sakon Nakhon', 'url' => '/ui-ux-design-agency-in-sakon-nakhon-thailand', 'basename' => 'ui-ux-design-agency-in-sakon-nakhon-thailand'],
  ['name' => 'Samut Prakan', 'url' => '/ui-ux-design-agency-in-samut-prakan-thailand', 'basename' => 'ui-ux-design-agency-in-samut-prakan-thailand'],
  ['name' => 'Samut Sakhon', 'url' => '/ui-ux-design-agency-in-samut-sakhon-thailand', 'basename' => 'ui-ux-design-agency-in-samut-sakhon-thailand'],
  ['name' => 'Samut Songkhram', 'url' => '/ui-ux-design-agency-in-samut-songkhram-thailand', 'basename' => 'ui-ux-design-agency-in-samut-songkhram-thailand'],
  ['name' => 'Saraburi', 'url' => '/ui-ux-design-agency-in-saraburi-thailand', 'basename' => 'ui-ux-design-agency-in-saraburi-thailand'],
  ['name' => 'Satun', 'url' => '/ui-ux-design-agency-in-satun-thailand', 'basename' => 'ui-ux-design-agency-in-satun-thailand'],
  ['name' => 'Si Sa Ket', 'url' => '/ui-ux-design-agency-in-si-sa-ket-thailand', 'basename' => 'ui-ux-design-agency-in-si-sa-ket-thailand'],
  ['name' => 'Sing Buri', 'url' => '/ui-ux-design-agency-in-sing-buri-thailand', 'basename' => 'ui-ux-design-agency-in-sing-buri-thailand'],
  ['name' => 'Songkhla', 'url' => '/ui-ux-design-agency-in-songkhla-thailand', 'basename' => 'ui-ux-design-agency-in-songkhla-thailand'],
  ['name' => 'Sukhothai', 'url' => '/ui-ux-design-agency-in-sukhothai-thailand', 'basename' => 'ui-ux-design-agency-in-sukhothai-thailand'],
  ['name' => 'Suphan Buri', 'url' => '/ui-ux-design-agency-in-suphan-buri-thailand', 'basename' => 'ui-ux-design-agency-in-suphan-buri-thailand'],
  ['name' => 'Surat Thani', 'url' => '/ui-ux-design-agency-in-surat-thani-thailand', 'basename' => 'ui-ux-design-agency-in-surat-thani-thailand'],
  ['name' => 'Surin', 'url' => '/ui-ux-design-agency-in-surin-thailand', 'basename' => 'ui-ux-design-agency-in-surin-thailand'],
  ['name' => 'Tak', 'url' => '/ui-ux-design-agency-in-tak-thailand', 'basename' => 'ui-ux-design-agency-in-tak-thailand'],
  ['name' => 'Trang', 'url' => '/ui-ux-design-agency-in-trang-thailand', 'basename' => 'ui-ux-design-agency-in-trang-thailand'],
  ['name' => 'Trat', 'url' => '/ui-ux-design-agency-in-trat-thailand', 'basename' => 'ui-ux-design-agency-in-trat-thailand'],
  ['name' => 'Ubon Ratchathani', 'url' => '/ui-ux-design-agency-in-ubon-ratchathani-thailand', 'basename' => 'ui-ux-design-agency-in-ubon-ratchathani-thailand'],
  ['name' => 'Udon Thani', 'url' => '/ui-ux-design-agency-in-udon-thani-thailand', 'basename' => 'ui-ux-design-agency-in-udon-thani-thailand'],
  ['name' => 'Uthai Thani', 'url' => '/ui-ux-design-agency-in-uthai-thani-thailand', 'basename' => 'ui-ux-design-agency-in-uthai-thani-thailand'],
  ['name' => 'Uttaradit', 'url' => '/ui-ux-design-agency-in-uttaradit-thailand', 'basename' => 'ui-ux-design-agency-in-uttaradit-thailand'],
  ['name' => 'Yala', 'url' => '/ui-ux-design-agency-in-yala-thailand', 'basename' => 'ui-ux-design-agency-in-yala-thailand'],
  ['name' => 'Yasothon', 'url' => '/ui-ux-design-agency-in-yasothon-thailand', 'basename' => 'ui-ux-design-agency-in-yasothon-thailand'],
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

    <!-- ── Hub: Browse all regions in Thailand ── -->
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
      <h2>Browse UI/UX Design Services Across Thailand</h2>
      <p class="hub-sub">We serve 78 regions, states, and cities in Thailand. Select a location to see how UX Pacific can help your business.</p>
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