<?php
require_once __DIR__ . '/includes/cms_repository.php';

$countrySlug = 'vietnam';

$featuredProjects   = get_published_projects('all', true);
$ecosystemHomeItems = get_published_ecosystem();

function home_image_url(?string $url): string {
  $url = trim((string) $url);
  if ($url === '') return uxp_normalize_stored_media_url('img/ux.webp');
  if (preg_match('#^https?://#i', $url)) return $url;
  return uxp_normalize_stored_media_url($url);
}

$pageTitle   = 'UI UX Design Agency in Vietnam | UX Pacific';
$pageDesc    = 'UX Pacific delivers expert UI/UX design services across Vietnam. Browse our locations or book a free UX audit today.';
$canonicalUrl = 'https://www.uxpacific.com/ui-ux-design-agency-in-vietnam';
$ogTitle     = 'UI UX Design Agency in Vietnam | UX Pacific';
$ogDesc      = 'UX Pacific delivers expert UI/UX design services across Vietnam. Browse our locations or book a free UX audit today.';
$ogUrl       = 'https://www.uxpacific.com/ui-ux-design-agency-in-vietnam';
$currentPage = 'Home';

// Schema: WebPage + BreadcrumbList
$ldJson = json_encode([
  '@context' => 'https://schema.org',
  '@graph'   => [
    ['@type' => 'WebPage',
     'url'   => 'https://www.uxpacific.com/ui-ux-design-agency-in-vietnam',
     'name'  => 'UI UX Design Agency in Vietnam | UX Pacific',
     'inLanguage' => 'en',
    ],
    ['@type' => 'BreadcrumbList',
     'itemListElement' => [
       ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home',       'item' => BASE_URL . '/'],
       ['@type' => 'ListItem', 'position' => 2, 'name' => 'Vietnam', 'item' => 'https://www.uxpacific.com/ui-ux-design-agency-in-vietnam'],
     ],
    ],
  ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

$geoPage = uxp_geo_page($countrySlug);
if ($geoPage) {
  if (!empty($geoPage['page_title']))      { $pageTitle = (string) $geoPage['page_title']; $ogTitle = $pageTitle; }
  if (!empty($geoPage['meta_description'])) { $pageDesc  = (string) $geoPage['meta_description']; $ogDesc = $pageDesc; }
}

// Child locations in Vietnam
$hubChildren = [
  ['name' => 'Đà Nẵng', 'url' => '/ui-ux-design-agency-in-a-nang-vietnam', 'basename' => 'ui-ux-design-agency-in-a-nang-vietnam'],
  ['name' => 'Đắk Lắk', 'url' => '/ui-ux-design-agency-in-ak-lak-vietnam', 'basename' => 'ui-ux-design-agency-in-ak-lak-vietnam'],
  ['name' => 'Đắk Nông', 'url' => '/ui-ux-design-agency-in-ak-nong-vietnam', 'basename' => 'ui-ux-design-agency-in-ak-nong-vietnam'],
  ['name' => 'An Giang', 'url' => '/ui-ux-design-agency-in-an-giang-vietnam', 'basename' => 'ui-ux-design-agency-in-an-giang-vietnam'],
  ['name' => 'Bà Rịa-Vũng Tàu', 'url' => '/ui-ux-design-agency-in-ba-ria-vung-tau-vietnam', 'basename' => 'ui-ux-design-agency-in-ba-ria-vung-tau-vietnam'],
  ['name' => 'Bắc Giang', 'url' => '/ui-ux-design-agency-in-bac-giang-vietnam', 'basename' => 'ui-ux-design-agency-in-bac-giang-vietnam'],
  ['name' => 'Bắc Kạn', 'url' => '/ui-ux-design-agency-in-bac-kan-vietnam', 'basename' => 'ui-ux-design-agency-in-bac-kan-vietnam'],
  ['name' => 'Bạc Liêu', 'url' => '/ui-ux-design-agency-in-bac-lieu-vietnam', 'basename' => 'ui-ux-design-agency-in-bac-lieu-vietnam'],
  ['name' => 'Bắc Ninh', 'url' => '/ui-ux-design-agency-in-bac-ninh-vietnam', 'basename' => 'ui-ux-design-agency-in-bac-ninh-vietnam'],
  ['name' => 'Bến Tre', 'url' => '/ui-ux-design-agency-in-ben-tre-vietnam', 'basename' => 'ui-ux-design-agency-in-ben-tre-vietnam'],
  ['name' => 'Bình Dương', 'url' => '/ui-ux-design-agency-in-binh-duong-vietnam', 'basename' => 'ui-ux-design-agency-in-binh-duong-vietnam'],
  ['name' => 'Bình Định', 'url' => '/ui-ux-design-agency-in-binh-inh-vietnam', 'basename' => 'ui-ux-design-agency-in-binh-inh-vietnam'],
  ['name' => 'Bình Phước', 'url' => '/ui-ux-design-agency-in-binh-phuoc-vietnam', 'basename' => 'ui-ux-design-agency-in-binh-phuoc-vietnam'],
  ['name' => 'Bình Thuận', 'url' => '/ui-ux-design-agency-in-binh-thuan-vietnam', 'basename' => 'ui-ux-design-agency-in-binh-thuan-vietnam'],
  ['name' => 'Cà Mau', 'url' => '/ui-ux-design-agency-in-ca-mau-vietnam', 'basename' => 'ui-ux-design-agency-in-ca-mau-vietnam'],
  ['name' => 'Cần Thơ', 'url' => '/ui-ux-design-agency-in-can-tho-vietnam', 'basename' => 'ui-ux-design-agency-in-can-tho-vietnam'],
  ['name' => 'Cao Bằng', 'url' => '/ui-ux-design-agency-in-cao-bang-vietnam', 'basename' => 'ui-ux-design-agency-in-cao-bang-vietnam'],
  ['name' => 'Gia Lai', 'url' => '/ui-ux-design-agency-in-gia-lai-vietnam', 'basename' => 'ui-ux-design-agency-in-gia-lai-vietnam'],
  ['name' => 'Hà Giang', 'url' => '/ui-ux-design-agency-in-ha-giang-vietnam', 'basename' => 'ui-ux-design-agency-in-ha-giang-vietnam'],
  ['name' => 'Hà Nam', 'url' => '/ui-ux-design-agency-in-ha-nam-vietnam', 'basename' => 'ui-ux-design-agency-in-ha-nam-vietnam'],
  ['name' => 'Hà Nội', 'url' => '/ui-ux-design-agency-in-ha-noi-vietnam', 'basename' => 'ui-ux-design-agency-in-ha-noi-vietnam'],
  ['name' => 'Hà Tĩnh', 'url' => '/ui-ux-design-agency-in-ha-tinh-vietnam', 'basename' => 'ui-ux-design-agency-in-ha-tinh-vietnam'],
  ['name' => 'Hải Dương', 'url' => '/ui-ux-design-agency-in-hai-duong-vietnam', 'basename' => 'ui-ux-design-agency-in-hai-duong-vietnam'],
  ['name' => 'Hải Phòng', 'url' => '/ui-ux-design-agency-in-hai-phong-vietnam', 'basename' => 'ui-ux-design-agency-in-hai-phong-vietnam'],
  ['name' => 'Hậu Giang', 'url' => '/ui-ux-design-agency-in-hau-giang-vietnam', 'basename' => 'ui-ux-design-agency-in-hau-giang-vietnam'],
  ['name' => 'Hồ Chí Minh', 'url' => '/ui-ux-design-agency-in-ho-chi-minh-vietnam', 'basename' => 'ui-ux-design-agency-in-ho-chi-minh-vietnam'],
  ['name' => 'Hòa Bình', 'url' => '/ui-ux-design-agency-in-hoa-binh-vietnam', 'basename' => 'ui-ux-design-agency-in-hoa-binh-vietnam'],
  ['name' => 'Hưng Yên', 'url' => '/ui-ux-design-agency-in-hung-yen-vietnam', 'basename' => 'ui-ux-design-agency-in-hung-yen-vietnam'],
  ['name' => 'Điện Biên', 'url' => '/ui-ux-design-agency-in-ien-bien-vietnam', 'basename' => 'ui-ux-design-agency-in-ien-bien-vietnam'],
  ['name' => 'Khánh Hòa', 'url' => '/ui-ux-design-agency-in-khanh-hoa-vietnam', 'basename' => 'ui-ux-design-agency-in-khanh-hoa-vietnam'],
  ['name' => 'Kiên Giang', 'url' => '/ui-ux-design-agency-in-kien-giang-vietnam', 'basename' => 'ui-ux-design-agency-in-kien-giang-vietnam'],
  ['name' => 'Kon Tum', 'url' => '/ui-ux-design-agency-in-kon-tum-vietnam', 'basename' => 'ui-ux-design-agency-in-kon-tum-vietnam'],
  ['name' => 'Lai Châu', 'url' => '/ui-ux-design-agency-in-lai-chau-vietnam', 'basename' => 'ui-ux-design-agency-in-lai-chau-vietnam'],
  ['name' => 'Lâm Đồng', 'url' => '/ui-ux-design-agency-in-lam-ong-vietnam', 'basename' => 'ui-ux-design-agency-in-lam-ong-vietnam'],
  ['name' => 'Lạng Sơn', 'url' => '/ui-ux-design-agency-in-lang-son-vietnam', 'basename' => 'ui-ux-design-agency-in-lang-son-vietnam'],
  ['name' => 'Lào Cai', 'url' => '/ui-ux-design-agency-in-lao-cai-vietnam', 'basename' => 'ui-ux-design-agency-in-lao-cai-vietnam'],
  ['name' => 'Long An', 'url' => '/ui-ux-design-agency-in-long-an-vietnam', 'basename' => 'ui-ux-design-agency-in-long-an-vietnam'],
  ['name' => 'Nam Định', 'url' => '/ui-ux-design-agency-in-nam-inh-vietnam', 'basename' => 'ui-ux-design-agency-in-nam-inh-vietnam'],
  ['name' => 'Nghệ An', 'url' => '/ui-ux-design-agency-in-nghe-an-vietnam', 'basename' => 'ui-ux-design-agency-in-nghe-an-vietnam'],
  ['name' => 'Ninh Bình', 'url' => '/ui-ux-design-agency-in-ninh-binh-vietnam', 'basename' => 'ui-ux-design-agency-in-ninh-binh-vietnam'],
  ['name' => 'Ninh Thuận', 'url' => '/ui-ux-design-agency-in-ninh-thuan-vietnam', 'basename' => 'ui-ux-design-agency-in-ninh-thuan-vietnam'],
  ['name' => 'Đồng Nai', 'url' => '/ui-ux-design-agency-in-ong-nai-vietnam', 'basename' => 'ui-ux-design-agency-in-ong-nai-vietnam'],
  ['name' => 'Đồng Tháp', 'url' => '/ui-ux-design-agency-in-ong-thap-vietnam', 'basename' => 'ui-ux-design-agency-in-ong-thap-vietnam'],
  ['name' => 'Phú Thọ', 'url' => '/ui-ux-design-agency-in-phu-tho-vietnam', 'basename' => 'ui-ux-design-agency-in-phu-tho-vietnam'],
  ['name' => 'Phú Yên', 'url' => '/ui-ux-design-agency-in-phu-yen-vietnam', 'basename' => 'ui-ux-design-agency-in-phu-yen-vietnam'],
  ['name' => 'Quảng Bình', 'url' => '/ui-ux-design-agency-in-quang-binh-vietnam', 'basename' => 'ui-ux-design-agency-in-quang-binh-vietnam'],
  ['name' => 'Quảng Nam', 'url' => '/ui-ux-design-agency-in-quang-nam-vietnam', 'basename' => 'ui-ux-design-agency-in-quang-nam-vietnam'],
  ['name' => 'Quảng Ngãi', 'url' => '/ui-ux-design-agency-in-quang-ngai-vietnam', 'basename' => 'ui-ux-design-agency-in-quang-ngai-vietnam'],
  ['name' => 'Quảng Ninh', 'url' => '/ui-ux-design-agency-in-quang-ninh-vietnam', 'basename' => 'ui-ux-design-agency-in-quang-ninh-vietnam'],
  ['name' => 'Quảng Trị', 'url' => '/ui-ux-design-agency-in-quang-tri-vietnam', 'basename' => 'ui-ux-design-agency-in-quang-tri-vietnam'],
  ['name' => 'Sóc Trăng', 'url' => '/ui-ux-design-agency-in-soc-trang-vietnam', 'basename' => 'ui-ux-design-agency-in-soc-trang-vietnam'],
  ['name' => 'Sơn La', 'url' => '/ui-ux-design-agency-in-son-la-vietnam', 'basename' => 'ui-ux-design-agency-in-son-la-vietnam'],
  ['name' => 'Tây Ninh', 'url' => '/ui-ux-design-agency-in-tay-ninh-vietnam', 'basename' => 'ui-ux-design-agency-in-tay-ninh-vietnam'],
  ['name' => 'Thái Bình', 'url' => '/ui-ux-design-agency-in-thai-binh-vietnam', 'basename' => 'ui-ux-design-agency-in-thai-binh-vietnam'],
  ['name' => 'Thái Nguyên', 'url' => '/ui-ux-design-agency-in-thai-nguyen-vietnam', 'basename' => 'ui-ux-design-agency-in-thai-nguyen-vietnam'],
  ['name' => 'Thanh Hóa', 'url' => '/ui-ux-design-agency-in-thanh-hoa-vietnam', 'basename' => 'ui-ux-design-agency-in-thanh-hoa-vietnam'],
  ['name' => 'Thừa Thiên-Huế', 'url' => '/ui-ux-design-agency-in-thua-thien-hue-vietnam', 'basename' => 'ui-ux-design-agency-in-thua-thien-hue-vietnam'],
  ['name' => 'Tiền Giang', 'url' => '/ui-ux-design-agency-in-tien-giang-vietnam', 'basename' => 'ui-ux-design-agency-in-tien-giang-vietnam'],
  ['name' => 'Trà Vinh', 'url' => '/ui-ux-design-agency-in-tra-vinh-vietnam', 'basename' => 'ui-ux-design-agency-in-tra-vinh-vietnam'],
  ['name' => 'Tuyên Quang', 'url' => '/ui-ux-design-agency-in-tuyen-quang-vietnam', 'basename' => 'ui-ux-design-agency-in-tuyen-quang-vietnam'],
  ['name' => 'Vĩnh Long', 'url' => '/ui-ux-design-agency-in-vinh-long-vietnam', 'basename' => 'ui-ux-design-agency-in-vinh-long-vietnam'],
  ['name' => 'Vĩnh Phúc', 'url' => '/ui-ux-design-agency-in-vinh-phuc-vietnam', 'basename' => 'ui-ux-design-agency-in-vinh-phuc-vietnam'],
  ['name' => 'Yên Bái', 'url' => '/ui-ux-design-agency-in-yen-bai-vietnam', 'basename' => 'ui-ux-design-agency-in-yen-bai-vietnam'],
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

    <!-- ── Hub: Browse all regions in Vietnam ── -->
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
      <h2>Browse UI/UX Design Services Across Vietnam</h2>
      <p class="hub-sub">We serve 63 regions, states, and cities in Vietnam. Select a location to see how UX Pacific can help your business.</p>
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