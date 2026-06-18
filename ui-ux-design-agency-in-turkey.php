<?php
require_once __DIR__ . '/includes/cms_repository.php';

$countrySlug = 'turkey';

$featuredProjects   = get_published_projects('all', true);
$ecosystemHomeItems = get_published_ecosystem();

function home_image_url(?string $url): string {
  $url = trim((string) $url);
  if ($url === '') return uxp_normalize_stored_media_url('img/ux.webp');
  if (preg_match('#^https?://#i', $url)) return $url;
  return uxp_normalize_stored_media_url($url);
}

$pageTitle   = 'UI UX Design Agency in Turkey | UX Pacific';
$pageDesc    = 'UX Pacific delivers expert UI/UX design services across Turkey. Browse our locations or book a free UX audit today.';
$canonicalUrl = 'https://www.uxpacific.com/ui-ux-design-agency-in-turkey';
$ogTitle     = 'UI UX Design Agency in Turkey | UX Pacific';
$ogDesc      = 'UX Pacific delivers expert UI/UX design services across Turkey. Browse our locations or book a free UX audit today.';
$ogUrl       = 'https://www.uxpacific.com/ui-ux-design-agency-in-turkey';
$currentPage = 'Home';

// Schema: WebPage + BreadcrumbList
$ldJson = json_encode([
  '@context' => 'https://schema.org',
  '@graph'   => [
    ['@type' => 'WebPage',
     'url'   => 'https://www.uxpacific.com/ui-ux-design-agency-in-turkey',
     'name'  => 'UI UX Design Agency in Turkey | UX Pacific',
     'inLanguage' => 'en',
    ],
    ['@type' => 'BreadcrumbList',
     'itemListElement' => [
       ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home',       'item' => BASE_URL . '/'],
       ['@type' => 'ListItem', 'position' => 2, 'name' => 'Turkey', 'item' => 'https://www.uxpacific.com/ui-ux-design-agency-in-turkey'],
     ],
    ],
  ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

$geoPage = uxp_geo_page($countrySlug);
if ($geoPage) {
  if (!empty($geoPage['page_title']))      { $pageTitle = (string) $geoPage['page_title']; $ogTitle = $pageTitle; }
  if (!empty($geoPage['meta_description'])) { $pageDesc  = (string) $geoPage['meta_description']; $ogDesc = $pageDesc; }
}

// Child locations in Turkey
$hubChildren = [
  ['name' => 'Adıyaman', 'url' => '/ui-ux-design-agency-in-ad-yaman-turkey', 'basename' => 'ui-ux-design-agency-in-ad-yaman-turkey'],
  ['name' => 'Adana', 'url' => '/ui-ux-design-agency-in-adana-turkey', 'basename' => 'ui-ux-design-agency-in-adana-turkey'],
  ['name' => 'Afyonkarahisar', 'url' => '/ui-ux-design-agency-in-afyonkarahisar-turkey', 'basename' => 'ui-ux-design-agency-in-afyonkarahisar-turkey'],
  ['name' => 'Ağrı', 'url' => '/ui-ux-design-agency-in-agr-turkey', 'basename' => 'ui-ux-design-agency-in-agr-turkey'],
  ['name' => 'Aksaray', 'url' => '/ui-ux-design-agency-in-aksaray-turkey', 'basename' => 'ui-ux-design-agency-in-aksaray-turkey'],
  ['name' => 'Amasya', 'url' => '/ui-ux-design-agency-in-amasya-turkey', 'basename' => 'ui-ux-design-agency-in-amasya-turkey'],
  ['name' => 'Ankara', 'url' => '/ui-ux-design-agency-in-ankara-turkey', 'basename' => 'ui-ux-design-agency-in-ankara-turkey'],
  ['name' => 'Antalya', 'url' => '/ui-ux-design-agency-in-antalya-turkey', 'basename' => 'ui-ux-design-agency-in-antalya-turkey'],
  ['name' => 'Ardahan', 'url' => '/ui-ux-design-agency-in-ardahan-turkey', 'basename' => 'ui-ux-design-agency-in-ardahan-turkey'],
  ['name' => 'Artvin', 'url' => '/ui-ux-design-agency-in-artvin-turkey', 'basename' => 'ui-ux-design-agency-in-artvin-turkey'],
  ['name' => 'Aydın', 'url' => '/ui-ux-design-agency-in-ayd-n-turkey', 'basename' => 'ui-ux-design-agency-in-ayd-n-turkey'],
  ['name' => 'Balıkesir', 'url' => '/ui-ux-design-agency-in-bal-kesir-turkey', 'basename' => 'ui-ux-design-agency-in-bal-kesir-turkey'],
  ['name' => 'Bartın', 'url' => '/ui-ux-design-agency-in-bart-n-turkey', 'basename' => 'ui-ux-design-agency-in-bart-n-turkey'],
  ['name' => 'Batman', 'url' => '/ui-ux-design-agency-in-batman-turkey', 'basename' => 'ui-ux-design-agency-in-batman-turkey'],
  ['name' => 'Bayburt', 'url' => '/ui-ux-design-agency-in-bayburt-turkey', 'basename' => 'ui-ux-design-agency-in-bayburt-turkey'],
  ['name' => 'Bilecik', 'url' => '/ui-ux-design-agency-in-bilecik-turkey', 'basename' => 'ui-ux-design-agency-in-bilecik-turkey'],
  ['name' => 'Bingöl', 'url' => '/ui-ux-design-agency-in-bingol-turkey', 'basename' => 'ui-ux-design-agency-in-bingol-turkey'],
  ['name' => 'Bitlis', 'url' => '/ui-ux-design-agency-in-bitlis-turkey', 'basename' => 'ui-ux-design-agency-in-bitlis-turkey'],
  ['name' => 'Bolu', 'url' => '/ui-ux-design-agency-in-bolu-turkey', 'basename' => 'ui-ux-design-agency-in-bolu-turkey'],
  ['name' => 'Burdur', 'url' => '/ui-ux-design-agency-in-burdur-turkey', 'basename' => 'ui-ux-design-agency-in-burdur-turkey'],
  ['name' => 'Bursa', 'url' => '/ui-ux-design-agency-in-bursa-turkey', 'basename' => 'ui-ux-design-agency-in-bursa-turkey'],
  ['name' => 'Çanakkale', 'url' => '/ui-ux-design-agency-in-canakkale-turkey', 'basename' => 'ui-ux-design-agency-in-canakkale-turkey'],
  ['name' => 'Çankırı', 'url' => '/ui-ux-design-agency-in-cank-r-turkey', 'basename' => 'ui-ux-design-agency-in-cank-r-turkey'],
  ['name' => 'Çorum', 'url' => '/ui-ux-design-agency-in-corum-turkey', 'basename' => 'ui-ux-design-agency-in-corum-turkey'],
  ['name' => 'Denizli', 'url' => '/ui-ux-design-agency-in-denizli-turkey', 'basename' => 'ui-ux-design-agency-in-denizli-turkey'],
  ['name' => 'Diyarbakır', 'url' => '/ui-ux-design-agency-in-diyarbak-r-turkey', 'basename' => 'ui-ux-design-agency-in-diyarbak-r-turkey'],
  ['name' => 'Düzce', 'url' => '/ui-ux-design-agency-in-duzce-turkey', 'basename' => 'ui-ux-design-agency-in-duzce-turkey'],
  ['name' => 'Edirne', 'url' => '/ui-ux-design-agency-in-edirne-turkey', 'basename' => 'ui-ux-design-agency-in-edirne-turkey'],
  ['name' => 'Elazığ', 'url' => '/ui-ux-design-agency-in-elaz-g-turkey', 'basename' => 'ui-ux-design-agency-in-elaz-g-turkey'],
  ['name' => 'Erzincan', 'url' => '/ui-ux-design-agency-in-erzincan-turkey', 'basename' => 'ui-ux-design-agency-in-erzincan-turkey'],
  ['name' => 'Erzurum', 'url' => '/ui-ux-design-agency-in-erzurum-turkey', 'basename' => 'ui-ux-design-agency-in-erzurum-turkey'],
  ['name' => 'Eskişehir', 'url' => '/ui-ux-design-agency-in-eskisehir-turkey', 'basename' => 'ui-ux-design-agency-in-eskisehir-turkey'],
  ['name' => 'Gaziantep', 'url' => '/ui-ux-design-agency-in-gaziantep-turkey', 'basename' => 'ui-ux-design-agency-in-gaziantep-turkey'],
  ['name' => 'Giresun', 'url' => '/ui-ux-design-agency-in-giresun-turkey', 'basename' => 'ui-ux-design-agency-in-giresun-turkey'],
  ['name' => 'Gümüşhane', 'url' => '/ui-ux-design-agency-in-gumushane-turkey', 'basename' => 'ui-ux-design-agency-in-gumushane-turkey'],
  ['name' => 'Hakkâri', 'url' => '/ui-ux-design-agency-in-hakkari-turkey', 'basename' => 'ui-ux-design-agency-in-hakkari-turkey'],
  ['name' => 'Hatay', 'url' => '/ui-ux-design-agency-in-hatay-turkey', 'basename' => 'ui-ux-design-agency-in-hatay-turkey'],
  ['name' => 'Iğdır', 'url' => '/ui-ux-design-agency-in-igd-r-turkey', 'basename' => 'ui-ux-design-agency-in-igd-r-turkey'],
  ['name' => 'Isparta', 'url' => '/ui-ux-design-agency-in-isparta-turkey', 'basename' => 'ui-ux-design-agency-in-isparta-turkey'],
  ['name' => 'Istanbul', 'url' => '/ui-ux-design-agency-in-istanbul-turkey', 'basename' => 'ui-ux-design-agency-in-istanbul-turkey'],
  ['name' => 'İzmir', 'url' => '/ui-ux-design-agency-in-izmir-turkey', 'basename' => 'ui-ux-design-agency-in-izmir-turkey'],
  ['name' => 'Kırıkkale', 'url' => '/ui-ux-design-agency-in-k-r-kkale-turkey', 'basename' => 'ui-ux-design-agency-in-k-r-kkale-turkey'],
  ['name' => 'Kırklareli', 'url' => '/ui-ux-design-agency-in-k-rklareli-turkey', 'basename' => 'ui-ux-design-agency-in-k-rklareli-turkey'],
  ['name' => 'Kırşehir', 'url' => '/ui-ux-design-agency-in-k-rsehir-turkey', 'basename' => 'ui-ux-design-agency-in-k-rsehir-turkey'],
  ['name' => 'Kahramanmaraş', 'url' => '/ui-ux-design-agency-in-kahramanmaras-turkey', 'basename' => 'ui-ux-design-agency-in-kahramanmaras-turkey'],
  ['name' => 'Karabük', 'url' => '/ui-ux-design-agency-in-karabuk-turkey', 'basename' => 'ui-ux-design-agency-in-karabuk-turkey'],
  ['name' => 'Karaman', 'url' => '/ui-ux-design-agency-in-karaman-turkey', 'basename' => 'ui-ux-design-agency-in-karaman-turkey'],
  ['name' => 'Kars', 'url' => '/ui-ux-design-agency-in-kars-turkey', 'basename' => 'ui-ux-design-agency-in-kars-turkey'],
  ['name' => 'Kastamonu', 'url' => '/ui-ux-design-agency-in-kastamonu-turkey', 'basename' => 'ui-ux-design-agency-in-kastamonu-turkey'],
  ['name' => 'Kayseri', 'url' => '/ui-ux-design-agency-in-kayseri-turkey', 'basename' => 'ui-ux-design-agency-in-kayseri-turkey'],
  ['name' => 'Kilis', 'url' => '/ui-ux-design-agency-in-kilis-turkey', 'basename' => 'ui-ux-design-agency-in-kilis-turkey'],
  ['name' => 'Kocaeli', 'url' => '/ui-ux-design-agency-in-kocaeli-turkey', 'basename' => 'ui-ux-design-agency-in-kocaeli-turkey'],
  ['name' => 'Konya', 'url' => '/ui-ux-design-agency-in-konya-turkey', 'basename' => 'ui-ux-design-agency-in-konya-turkey'],
  ['name' => 'Kütahya', 'url' => '/ui-ux-design-agency-in-kutahya-turkey', 'basename' => 'ui-ux-design-agency-in-kutahya-turkey'],
  ['name' => 'Malatya', 'url' => '/ui-ux-design-agency-in-malatya-turkey', 'basename' => 'ui-ux-design-agency-in-malatya-turkey'],
  ['name' => 'Manisa', 'url' => '/ui-ux-design-agency-in-manisa-turkey', 'basename' => 'ui-ux-design-agency-in-manisa-turkey'],
  ['name' => 'Mardin', 'url' => '/ui-ux-design-agency-in-mardin-turkey', 'basename' => 'ui-ux-design-agency-in-mardin-turkey'],
  ['name' => 'Mersin', 'url' => '/ui-ux-design-agency-in-mersin-turkey', 'basename' => 'ui-ux-design-agency-in-mersin-turkey'],
  ['name' => 'Muğla', 'url' => '/ui-ux-design-agency-in-mugla-turkey', 'basename' => 'ui-ux-design-agency-in-mugla-turkey'],
  ['name' => 'Muş', 'url' => '/ui-ux-design-agency-in-mus-turkey', 'basename' => 'ui-ux-design-agency-in-mus-turkey'],
  ['name' => 'Nevşehir', 'url' => '/ui-ux-design-agency-in-nevsehir-turkey', 'basename' => 'ui-ux-design-agency-in-nevsehir-turkey'],
  ['name' => 'Niğde', 'url' => '/ui-ux-design-agency-in-nigde-turkey', 'basename' => 'ui-ux-design-agency-in-nigde-turkey'],
  ['name' => 'Ordu', 'url' => '/ui-ux-design-agency-in-ordu-turkey', 'basename' => 'ui-ux-design-agency-in-ordu-turkey'],
  ['name' => 'Osmaniye', 'url' => '/ui-ux-design-agency-in-osmaniye-turkey', 'basename' => 'ui-ux-design-agency-in-osmaniye-turkey'],
  ['name' => 'Rize', 'url' => '/ui-ux-design-agency-in-rize-turkey', 'basename' => 'ui-ux-design-agency-in-rize-turkey'],
  ['name' => 'Şırnak', 'url' => '/ui-ux-design-agency-in-s-rnak-turkey', 'basename' => 'ui-ux-design-agency-in-s-rnak-turkey'],
  ['name' => 'Sakarya', 'url' => '/ui-ux-design-agency-in-sakarya-turkey', 'basename' => 'ui-ux-design-agency-in-sakarya-turkey'],
  ['name' => 'Samsun', 'url' => '/ui-ux-design-agency-in-samsun-turkey', 'basename' => 'ui-ux-design-agency-in-samsun-turkey'],
  ['name' => 'Şanlıurfa', 'url' => '/ui-ux-design-agency-in-sanl-urfa-turkey', 'basename' => 'ui-ux-design-agency-in-sanl-urfa-turkey'],
  ['name' => 'Siirt', 'url' => '/ui-ux-design-agency-in-siirt-turkey', 'basename' => 'ui-ux-design-agency-in-siirt-turkey'],
  ['name' => 'Sinop', 'url' => '/ui-ux-design-agency-in-sinop-turkey', 'basename' => 'ui-ux-design-agency-in-sinop-turkey'],
  ['name' => 'Sivas', 'url' => '/ui-ux-design-agency-in-sivas-turkey', 'basename' => 'ui-ux-design-agency-in-sivas-turkey'],
  ['name' => 'Tekirdağ', 'url' => '/ui-ux-design-agency-in-tekirdag-turkey', 'basename' => 'ui-ux-design-agency-in-tekirdag-turkey'],
  ['name' => 'Tokat', 'url' => '/ui-ux-design-agency-in-tokat-turkey', 'basename' => 'ui-ux-design-agency-in-tokat-turkey'],
  ['name' => 'Trabzon', 'url' => '/ui-ux-design-agency-in-trabzon-turkey', 'basename' => 'ui-ux-design-agency-in-trabzon-turkey'],
  ['name' => 'Tunceli', 'url' => '/ui-ux-design-agency-in-tunceli-turkey', 'basename' => 'ui-ux-design-agency-in-tunceli-turkey'],
  ['name' => 'Uşak', 'url' => '/ui-ux-design-agency-in-usak-turkey', 'basename' => 'ui-ux-design-agency-in-usak-turkey'],
  ['name' => 'Van', 'url' => '/ui-ux-design-agency-in-van-turkey', 'basename' => 'ui-ux-design-agency-in-van-turkey'],
  ['name' => 'Yalova', 'url' => '/ui-ux-design-agency-in-yalova-turkey', 'basename' => 'ui-ux-design-agency-in-yalova-turkey'],
  ['name' => 'Yozgat', 'url' => '/ui-ux-design-agency-in-yozgat-turkey', 'basename' => 'ui-ux-design-agency-in-yozgat-turkey'],
  ['name' => 'Zonguldak', 'url' => '/ui-ux-design-agency-in-zonguldak-turkey', 'basename' => 'ui-ux-design-agency-in-zonguldak-turkey'],
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

    <!-- ── Hub: Browse all regions in Turkey ── -->
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
      <h2>Browse UI/UX Design Services Across Turkey</h2>
      <p class="hub-sub">We serve 81 regions, states, and cities in Turkey. Select a location to see how UX Pacific can help your business.</p>
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