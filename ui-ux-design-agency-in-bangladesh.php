<?php
require_once __DIR__ . '/includes/cms_repository.php';

$countrySlug = 'bangladesh';

$featuredProjects   = get_published_projects('all', true);
$ecosystemHomeItems = get_published_ecosystem();

function home_image_url(?string $url): string {
  $url = trim((string) $url);
  if ($url === '') return uxp_normalize_stored_media_url('img/ux.webp');
  if (preg_match('#^https?://#i', $url)) return $url;
  return uxp_normalize_stored_media_url($url);
}

$pageTitle   = 'UI UX Design Agency in Bangladesh | UX Pacific';
$pageDesc    = 'UX Pacific delivers expert UI/UX design services across Bangladesh. Browse our locations or book a free UX audit today.';
$canonicalUrl = 'https://www.uxpacific.com/ui-ux-design-agency-in-bangladesh';
$ogTitle     = 'UI UX Design Agency in Bangladesh | UX Pacific';
$ogDesc      = 'UX Pacific delivers expert UI/UX design services across Bangladesh. Browse our locations or book a free UX audit today.';
$ogUrl       = 'https://www.uxpacific.com/ui-ux-design-agency-in-bangladesh';
$currentPage = 'Home';

// Schema: WebPage + BreadcrumbList
$ldJson = json_encode([
  '@context' => 'https://schema.org',
  '@graph'   => [
    ['@type' => 'WebPage',
     'url'   => 'https://www.uxpacific.com/ui-ux-design-agency-in-bangladesh',
     'name'  => 'UI UX Design Agency in Bangladesh | UX Pacific',
     'inLanguage' => 'en',
    ],
    ['@type' => 'BreadcrumbList',
     'itemListElement' => [
       ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home',       'item' => BASE_URL . '/'],
       ['@type' => 'ListItem', 'position' => 2, 'name' => 'Bangladesh', 'item' => 'https://www.uxpacific.com/ui-ux-design-agency-in-bangladesh'],
     ],
    ],
  ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

$geoPage = uxp_geo_page($countrySlug);
if ($geoPage) {
  if (!empty($geoPage['page_title']))      { $pageTitle = (string) $geoPage['page_title']; $ogTitle = $pageTitle; }
  if (!empty($geoPage['meta_description'])) { $pageDesc  = (string) $geoPage['meta_description']; $ogDesc = $pageDesc; }
}

// Child locations in Bangladesh
$hubChildren = [
  ['name' => 'Bagerhat District', 'url' => '/ui-ux-design-agency-in-bagerhat-district-bangladesh', 'basename' => 'ui-ux-design-agency-in-bagerhat-district-bangladesh'],
  ['name' => 'Bahadia', 'url' => '/ui-ux-design-agency-in-bahadia-bangladesh', 'basename' => 'ui-ux-design-agency-in-bahadia-bangladesh'],
  ['name' => 'Bandarban District', 'url' => '/ui-ux-design-agency-in-bandarban-district-bangladesh', 'basename' => 'ui-ux-design-agency-in-bandarban-district-bangladesh'],
  ['name' => 'Barguna District', 'url' => '/ui-ux-design-agency-in-barguna-district-bangladesh', 'basename' => 'ui-ux-design-agency-in-barguna-district-bangladesh'],
  ['name' => 'Barisal District', 'url' => '/ui-ux-design-agency-in-barisal-district-bangladesh', 'basename' => 'ui-ux-design-agency-in-barisal-district-bangladesh'],
  ['name' => 'Barisal Division', 'url' => '/ui-ux-design-agency-in-barisal-division-bangladesh', 'basename' => 'ui-ux-design-agency-in-barisal-division-bangladesh'],
  ['name' => 'Bhola District', 'url' => '/ui-ux-design-agency-in-bhola-district-bangladesh', 'basename' => 'ui-ux-design-agency-in-bhola-district-bangladesh'],
  ['name' => 'Bogra District', 'url' => '/ui-ux-design-agency-in-bogra-district-bangladesh', 'basename' => 'ui-ux-design-agency-in-bogra-district-bangladesh'],
  ['name' => 'Brahmanbaria District', 'url' => '/ui-ux-design-agency-in-brahmanbaria-district-bangladesh', 'basename' => 'ui-ux-design-agency-in-brahmanbaria-district-bangladesh'],
  ['name' => 'Chandpur District', 'url' => '/ui-ux-design-agency-in-chandpur-district-bangladesh', 'basename' => 'ui-ux-design-agency-in-chandpur-district-bangladesh'],
  ['name' => 'Chapai Nawabganj District', 'url' => '/ui-ux-design-agency-in-chapai-nawabganj-district-bangladesh', 'basename' => 'ui-ux-design-agency-in-chapai-nawabganj-district-bangladesh'],
  ['name' => 'Chittagong District', 'url' => '/ui-ux-design-agency-in-chittagong-district-bangladesh', 'basename' => 'ui-ux-design-agency-in-chittagong-district-bangladesh'],
  ['name' => 'Chittagong Division', 'url' => '/ui-ux-design-agency-in-chittagong-division-bangladesh', 'basename' => 'ui-ux-design-agency-in-chittagong-division-bangladesh'],
  ['name' => 'Chuadanga District', 'url' => '/ui-ux-design-agency-in-chuadanga-district-bangladesh', 'basename' => 'ui-ux-design-agency-in-chuadanga-district-bangladesh'],
  ['name' => 'Comilla District', 'url' => '/ui-ux-design-agency-in-comilla-district-bangladesh', 'basename' => 'ui-ux-design-agency-in-comilla-district-bangladesh'],
  ['name' => 'Cox\\\'s Bazar District', 'url' => '/ui-ux-design-agency-in-coxs-bazar-district-bangladesh', 'basename' => 'ui-ux-design-agency-in-coxs-bazar-district-bangladesh'],
  ['name' => 'Dhaka District', 'url' => '/ui-ux-design-agency-in-dhaka-district-bangladesh', 'basename' => 'ui-ux-design-agency-in-dhaka-district-bangladesh'],
  ['name' => 'Dhaka Division', 'url' => '/ui-ux-design-agency-in-dhaka-division-bangladesh', 'basename' => 'ui-ux-design-agency-in-dhaka-division-bangladesh'],
  ['name' => 'Dinajpur District', 'url' => '/ui-ux-design-agency-in-dinajpur-district-bangladesh', 'basename' => 'ui-ux-design-agency-in-dinajpur-district-bangladesh'],
  ['name' => 'Faridpur District', 'url' => '/ui-ux-design-agency-in-faridpur-district-bangladesh', 'basename' => 'ui-ux-design-agency-in-faridpur-district-bangladesh'],
  ['name' => 'Feni District', 'url' => '/ui-ux-design-agency-in-feni-district-bangladesh', 'basename' => 'ui-ux-design-agency-in-feni-district-bangladesh'],
  ['name' => 'Gaibandha District', 'url' => '/ui-ux-design-agency-in-gaibandha-district-bangladesh', 'basename' => 'ui-ux-design-agency-in-gaibandha-district-bangladesh'],
  ['name' => 'Gazipur District', 'url' => '/ui-ux-design-agency-in-gazipur-district-bangladesh', 'basename' => 'ui-ux-design-agency-in-gazipur-district-bangladesh'],
  ['name' => 'Gopalganj District', 'url' => '/ui-ux-design-agency-in-gopalganj-district-bangladesh', 'basename' => 'ui-ux-design-agency-in-gopalganj-district-bangladesh'],
  ['name' => 'Habiganj District', 'url' => '/ui-ux-design-agency-in-habiganj-district-bangladesh', 'basename' => 'ui-ux-design-agency-in-habiganj-district-bangladesh'],
  ['name' => 'Jamalpur District', 'url' => '/ui-ux-design-agency-in-jamalpur-district-bangladesh', 'basename' => 'ui-ux-design-agency-in-jamalpur-district-bangladesh'],
  ['name' => 'Jessore District', 'url' => '/ui-ux-design-agency-in-jessore-district-bangladesh', 'basename' => 'ui-ux-design-agency-in-jessore-district-bangladesh'],
  ['name' => 'Jhalokati District', 'url' => '/ui-ux-design-agency-in-jhalokati-district-bangladesh', 'basename' => 'ui-ux-design-agency-in-jhalokati-district-bangladesh'],
  ['name' => 'Jhenaidah District', 'url' => '/ui-ux-design-agency-in-jhenaidah-district-bangladesh', 'basename' => 'ui-ux-design-agency-in-jhenaidah-district-bangladesh'],
  ['name' => 'Joypurhat District', 'url' => '/ui-ux-design-agency-in-joypurhat-district-bangladesh', 'basename' => 'ui-ux-design-agency-in-joypurhat-district-bangladesh'],
  ['name' => 'Khagrachari District', 'url' => '/ui-ux-design-agency-in-khagrachari-district-bangladesh', 'basename' => 'ui-ux-design-agency-in-khagrachari-district-bangladesh'],
  ['name' => 'Khulna District', 'url' => '/ui-ux-design-agency-in-khulna-district-bangladesh', 'basename' => 'ui-ux-design-agency-in-khulna-district-bangladesh'],
  ['name' => 'Khulna Division', 'url' => '/ui-ux-design-agency-in-khulna-division-bangladesh', 'basename' => 'ui-ux-design-agency-in-khulna-division-bangladesh'],
  ['name' => 'Kishoreganj District', 'url' => '/ui-ux-design-agency-in-kishoreganj-district-bangladesh', 'basename' => 'ui-ux-design-agency-in-kishoreganj-district-bangladesh'],
  ['name' => 'Kurigram District', 'url' => '/ui-ux-design-agency-in-kurigram-district-bangladesh', 'basename' => 'ui-ux-design-agency-in-kurigram-district-bangladesh'],
  ['name' => 'Kushtia District', 'url' => '/ui-ux-design-agency-in-kushtia-district-bangladesh', 'basename' => 'ui-ux-design-agency-in-kushtia-district-bangladesh'],
  ['name' => 'Lakshmipur District', 'url' => '/ui-ux-design-agency-in-lakshmipur-district-bangladesh', 'basename' => 'ui-ux-design-agency-in-lakshmipur-district-bangladesh'],
  ['name' => 'Lalmonirhat District', 'url' => '/ui-ux-design-agency-in-lalmonirhat-district-bangladesh', 'basename' => 'ui-ux-design-agency-in-lalmonirhat-district-bangladesh'],
  ['name' => 'Madaripur District', 'url' => '/ui-ux-design-agency-in-madaripur-district-bangladesh', 'basename' => 'ui-ux-design-agency-in-madaripur-district-bangladesh'],
  ['name' => 'Meherpur District', 'url' => '/ui-ux-design-agency-in-meherpur-district-bangladesh', 'basename' => 'ui-ux-design-agency-in-meherpur-district-bangladesh'],
  ['name' => 'Moulvibazar District', 'url' => '/ui-ux-design-agency-in-moulvibazar-district-bangladesh', 'basename' => 'ui-ux-design-agency-in-moulvibazar-district-bangladesh'],
  ['name' => 'Munshiganj District', 'url' => '/ui-ux-design-agency-in-munshiganj-district-bangladesh', 'basename' => 'ui-ux-design-agency-in-munshiganj-district-bangladesh'],
  ['name' => 'Mymensingh District', 'url' => '/ui-ux-design-agency-in-mymensingh-district-bangladesh', 'basename' => 'ui-ux-design-agency-in-mymensingh-district-bangladesh'],
  ['name' => 'Mymensingh Division', 'url' => '/ui-ux-design-agency-in-mymensingh-division-bangladesh', 'basename' => 'ui-ux-design-agency-in-mymensingh-division-bangladesh'],
  ['name' => 'Naogaon District', 'url' => '/ui-ux-design-agency-in-naogaon-district-bangladesh', 'basename' => 'ui-ux-design-agency-in-naogaon-district-bangladesh'],
  ['name' => 'Narail District', 'url' => '/ui-ux-design-agency-in-narail-district-bangladesh', 'basename' => 'ui-ux-design-agency-in-narail-district-bangladesh'],
  ['name' => 'Narayanganj District', 'url' => '/ui-ux-design-agency-in-narayanganj-district-bangladesh', 'basename' => 'ui-ux-design-agency-in-narayanganj-district-bangladesh'],
  ['name' => 'Natore District', 'url' => '/ui-ux-design-agency-in-natore-district-bangladesh', 'basename' => 'ui-ux-design-agency-in-natore-district-bangladesh'],
  ['name' => 'Netrokona District', 'url' => '/ui-ux-design-agency-in-netrokona-district-bangladesh', 'basename' => 'ui-ux-design-agency-in-netrokona-district-bangladesh'],
  ['name' => 'Nilphamari District', 'url' => '/ui-ux-design-agency-in-nilphamari-district-bangladesh', 'basename' => 'ui-ux-design-agency-in-nilphamari-district-bangladesh'],
  ['name' => 'Noakhali District', 'url' => '/ui-ux-design-agency-in-noakhali-district-bangladesh', 'basename' => 'ui-ux-design-agency-in-noakhali-district-bangladesh'],
  ['name' => 'Pabna District', 'url' => '/ui-ux-design-agency-in-pabna-district-bangladesh', 'basename' => 'ui-ux-design-agency-in-pabna-district-bangladesh'],
  ['name' => 'Panchagarh District', 'url' => '/ui-ux-design-agency-in-panchagarh-district-bangladesh', 'basename' => 'ui-ux-design-agency-in-panchagarh-district-bangladesh'],
  ['name' => 'Patuakhali District', 'url' => '/ui-ux-design-agency-in-patuakhali-district-bangladesh', 'basename' => 'ui-ux-design-agency-in-patuakhali-district-bangladesh'],
  ['name' => 'Pirojpur District', 'url' => '/ui-ux-design-agency-in-pirojpur-district-bangladesh', 'basename' => 'ui-ux-design-agency-in-pirojpur-district-bangladesh'],
  ['name' => 'Rajbari District', 'url' => '/ui-ux-design-agency-in-rajbari-district-bangladesh', 'basename' => 'ui-ux-design-agency-in-rajbari-district-bangladesh'],
  ['name' => 'Rajshahi District', 'url' => '/ui-ux-design-agency-in-rajshahi-district-bangladesh', 'basename' => 'ui-ux-design-agency-in-rajshahi-district-bangladesh'],
  ['name' => 'Rajshahi Division', 'url' => '/ui-ux-design-agency-in-rajshahi-division-bangladesh', 'basename' => 'ui-ux-design-agency-in-rajshahi-division-bangladesh'],
  ['name' => 'Rangamati Hill District', 'url' => '/ui-ux-design-agency-in-rangamati-hill-district-bangladesh', 'basename' => 'ui-ux-design-agency-in-rangamati-hill-district-bangladesh'],
  ['name' => 'Rangpur District', 'url' => '/ui-ux-design-agency-in-rangpur-district-bangladesh', 'basename' => 'ui-ux-design-agency-in-rangpur-district-bangladesh'],
  ['name' => 'Rangpur Division', 'url' => '/ui-ux-design-agency-in-rangpur-division-bangladesh', 'basename' => 'ui-ux-design-agency-in-rangpur-division-bangladesh'],
  ['name' => 'Satkhira District', 'url' => '/ui-ux-design-agency-in-satkhira-district-bangladesh', 'basename' => 'ui-ux-design-agency-in-satkhira-district-bangladesh'],
  ['name' => 'Shariatpur District', 'url' => '/ui-ux-design-agency-in-shariatpur-district-bangladesh', 'basename' => 'ui-ux-design-agency-in-shariatpur-district-bangladesh'],
  ['name' => 'Sherpur District', 'url' => '/ui-ux-design-agency-in-sherpur-district-bangladesh', 'basename' => 'ui-ux-design-agency-in-sherpur-district-bangladesh'],
  ['name' => 'Sirajganj District', 'url' => '/ui-ux-design-agency-in-sirajganj-district-bangladesh', 'basename' => 'ui-ux-design-agency-in-sirajganj-district-bangladesh'],
  ['name' => 'Sunamganj District', 'url' => '/ui-ux-design-agency-in-sunamganj-district-bangladesh', 'basename' => 'ui-ux-design-agency-in-sunamganj-district-bangladesh'],
  ['name' => 'Sylhet District', 'url' => '/ui-ux-design-agency-in-sylhet-district-bangladesh', 'basename' => 'ui-ux-design-agency-in-sylhet-district-bangladesh'],
  ['name' => 'Sylhet Division', 'url' => '/ui-ux-design-agency-in-sylhet-division-bangladesh', 'basename' => 'ui-ux-design-agency-in-sylhet-division-bangladesh'],
  ['name' => 'Tangail District', 'url' => '/ui-ux-design-agency-in-tangail-district-bangladesh', 'basename' => 'ui-ux-design-agency-in-tangail-district-bangladesh'],
  ['name' => 'Thakurgaon District', 'url' => '/ui-ux-design-agency-in-thakurgaon-district-bangladesh', 'basename' => 'ui-ux-design-agency-in-thakurgaon-district-bangladesh'],
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

    <!-- ── Hub: Browse all regions in Bangladesh ── -->
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
      <h2>Browse UI/UX Design Services Across Bangladesh</h2>
      <p class="hub-sub">We serve 70 regions, states, and cities in Bangladesh. Select a location to see how UX Pacific can help your business.</p>
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