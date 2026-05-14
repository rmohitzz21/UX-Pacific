<?php
require_once __DIR__ . '/includes/cms_repository.php';

$pageTitle    = 'Ecosystem | UX Pacific';
$pageDesc     = 'Discover the UX Pacific ecosystem  a community-driven network of designers, mentors, collaborators, and tools shaping the future of UX design.';
$canonicalUrl = 'https://www.uxpacific.com/ecosystem.php';
$ogTitle      = 'Ecosystem | UX Pacific';
$ogDesc       = 'Join the UX Pacific ecosystem. Connect with a thriving community of UX professionals, access resources, and grow your design career.';
$ogUrl        = 'https://www.uxpacific.com/ecosystem.php';
$currentPage  = 'ecosystem';

$ecosystemItems = get_published_ecosystem();

/** Normalize logo paths from admin uploads (preserve root-relative URLs). */
function ecosystem_logo_url(?string $url): string
{
    $url = trim((string) $url);
    if ($url === '') {
        return '';
    }
    if (preg_match('#^https?://#i', $url)) {
        return $url;
    }

    return uxp_normalize_stored_media_url($url);
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include 'includes/head.php'; ?>
    <style>
      .eco-accordion-container { display:flex; flex-direction:column; gap:16px; max-width:1000px; margin:4rem auto; padding:0 1rem; }
      .eco-acc-item { background:#141416; border:1px solid #1c1c1f; border-radius:8px; overflow:hidden; transition:border-color 0.3s ease,box-shadow 0.3s ease; }
      .eco-acc-item:hover { border-color:#3f3f46; background:#18181b; }
      .eco-acc-header { width:100%; display:flex; justify-content:space-between; align-items:center; padding:24px; background:transparent; border:none; color:white; font-family:'DM Sans',sans-serif; font-size:1.35rem; font-weight:600; cursor:pointer; transition:background 0.3s; }
      .eco-acc-header:hover { background:rgba(255,255,255,0.02); }
      .drop-icon { transition:transform 0.3s ease; color:#fff; font-size:1.2rem; }
      .eco-acc-header[aria-expanded="true"] .drop-icon { transform:rotate(180deg); color:#a78bfa; }
      .eco-acc-body { padding:0 24px 24px; margin-top:12px; }
      .eco-btn { display:inline-flex; align-items:center; margin-top:auto; padding:0.8rem 2rem; background:linear-gradient(90deg,#6e54bb,#845ef7); border-radius:999px; color:white; font-weight:600; text-decoration:none; transition:all 0.3s; border:none; }
      .eco-btn:hover { background:linear-gradient(90deg,#845ef7,#6e54bb); box-shadow:0 4px 15px rgba(132,94,247,0.4); color:white; }
      @media (max-width:768px) {
        .services {
          flex-direction: column !important;
          padding: 16px !important;
          margin-bottom: 50px !important;
          gap: 14px !important;
          overflow: visible !important;
          display: flex !important;
        }
        .service-card {
          width: 100% !important;
          max-width: 100% !important;
          flex: none !important;
          margin: 0 !important;
          padding: 20px !important;
          border: 1px solid rgba(255,255,255,0.12) !important;
          border-radius: 14px !important;
          background: linear-gradient(135deg, rgba(99,73,192,0.55), rgba(14,2,56,0.7)) !important;
          display: flex !important;
          flex-direction: row !important;
          align-items: flex-start !important;
          gap: 14px !important;
          min-height: unset !important;
          text-align: left !important;
          box-shadow: 0 4px 20px rgba(99,73,192,0.2) !important;
        }
        .service-card .service-icon {
          display: flex !important;
          align-items: center !important;
          justify-content: center !important;
          flex-shrink: 0 !important;
          width: 60px !important;
          height: 60px !important;
          margin: 0 !important;
          background: rgba(255,255,255,0.07) !important;
          border-radius: 12px !important;
        }
        .service-card .service-icon img {
          width: 40px !important;
          height: 40px !important;
          object-fit: contain !important;
          border-radius: 6px !important;
        }
        .service-card-content {
          display: flex;
          flex-direction: column;
          flex: 1;
          min-width: 0;
        }
        .service-card h3 {
          margin: 0 0 6px 0 !important;
          font-size: 17px !important;
          font-weight: 700 !important;
          color: white !important;
          line-height: 1.3 !important;
        }
        .service-card p {
          display: block !important;
          font-size: 13px !important;
          line-height: 1.55 !important;
          color: rgba(255,255,255,0.65) !important;
          margin: 0 0 10px 0 !important;
        }
        .service-card a {
          display: inline-flex !important;
          align-items: center !important;
          font-size: 13px !important;
          font-weight: 600 !important;
          color: #a78bfa !important;
          border-bottom: none !important;
          gap: 3px !important;
        }
        .eco-acc-header { padding: 16px !important; font-size: 1.05rem !important; }
        .eco-acc-body { padding: 0 16px 16px !important; }

        .eco-logo-placeholder {
          width: 40px;
          height: 40px;
          border-radius: 8px;
          background: rgba(255,255,255,0.12);
          display: flex;
          align-items: center;
          justify-content: center;
          font-size: 14px;
          font-weight: 700;
          color: rgba(255,255,255,0.9);
          letter-spacing: 0.02em;
        }

        /* Prevent hover icon size change on mobile tap */
        .service-card:nth-child(1):hover .service-icon img,
        .service-card:nth-child(2):hover .service-icon img,
        .service-card:nth-child(3):hover .service-icon img {
          width: 40px !important;
          height: 40px !important;
        }
      }
    </style>
  </head>
  <body class="about-page">
    <?php include 'includes/navbar.php'; ?>

    <section class="about-header">
      <video class="header-bg-video" autoplay muted loop playsinline>
        <source src="img/test.mp4" type="video/mp4">
      </video>
      <div class="header-bg-overlay"></div>
      <h1>Ecosystem</h1>
      <div class="innovation-badge-exact">
        <span class="badge-desktop">Our ecosystem connects learning, resources, and community in one unified space.<br>From UX Shop to UX Academy and UX Community, we empower designers at every stage.</span>
        <span class="badge-mobile">Learn, <span>Grow</span>, Design <span>Better</span></span>
      </div>
    </section>

    <h2 class="ux-title" style="margin-top: 50px;">Expand Your Experience With <span class="highlight"> UX Pacific </span></h2>

    <div class="services">
      <?php
      $ecoRows = !empty($ecosystemItems)
          ? $ecosystemItems
          : [
              ['partner_name' => 'UX Pacific Shop', 'details' => 'Access premium UI kits, design systems, and templates crafted by industry experts to speed up your workflow and elevate your final products.', 'website_url' => '#', 'logo_url' => 'img/shop1.png'],
              ['partner_name' => 'UX Academy', 'details' => 'Level up your skills with our hands-on workshops, courses, and mentorship programs specifically tailored and designed for future design leaders.', 'website_url' => 'https://academy.uxpacific.com/', 'logo_url' => 'img/acedmy.png'],
              ['partner_name' => 'UX Community', 'details' => 'Be part of a thriving network where ideas turn into reality. Join our broader UX Pacific ecosystem community to connect and grow.', 'website_url' => 'https://community.uxpacific.com/', 'logo_url' => 'img/community.png'],
          ];

      foreach ($ecoRows as $eco):
          $name = htmlspecialchars($eco['partner_name'] ?? 'Partner', ENT_QUOTES, 'UTF-8');
          $details = htmlspecialchars($eco['details'] ?? '', ENT_QUOTES, 'UTF-8');
          $rawUrl = trim((string) ($eco['website_url'] ?? ''));
          $hasUrl = $rawUrl !== '' && $rawUrl !== '#';
          $openUrl = $hasUrl ? $rawUrl : '';
          $logoResolved = ecosystem_logo_url($eco['logo_url'] ?? '');
          $initials = '';
          $pn = (string) ($eco['partner_name'] ?? '');
          if ($pn !== '') {
              $parts = preg_split('/\s+/u', $pn, -1, PREG_SPLIT_NO_EMPTY);
              if ($parts && count($parts) >= 2) {
                  $initials = mb_strtoupper(mb_substr($parts[0], 0, 1) . mb_substr($parts[count($parts) - 1], 0, 1));
              } else {
                  $initials = mb_strtoupper(mb_substr($pn, 0, 2));
              }
          }
          $onclick = $hasUrl
              ? ' onclick=\'window.open(' . json_encode($openUrl, JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP) . ', "_blank")\''
              : '';
          $cursorStyle = $hasUrl ? 'cursor:pointer;' : 'cursor:default;';
      ?>
      <div class="service-card"<?= $onclick ?> style="<?= $cursorStyle ?>">
        <div class="service-icon">
          <?php if ($logoResolved !== ''): ?>
            <img alt="<?= $name ?>" src="<?= htmlspecialchars($logoResolved, ENT_QUOTES, 'UTF-8') ?>" />
          <?php else: ?>
            <span class="eco-logo-placeholder"><?= htmlspecialchars($initials ?: '?', ENT_QUOTES, 'UTF-8') ?></span>
          <?php endif; ?>
        </div>
        <div class="service-card-content">
          <h3><?= $name ?></h3>
          <p><?= $details ?></p>
          <?php if ($hasUrl): ?>
            <a href="<?= htmlspecialchars($openUrl, ENT_QUOTES, 'UTF-8') ?>" target="_blank" rel="noopener noreferrer" style="text-decoration:none;color:#6366f1;font-weight:500;">View Details &rarr;</a>
          <?php else: ?>
            <span style="color:rgba(255,255,255,0.35);font-size:0.95rem;">Link coming soon</span>
          <?php endif; ?>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <?php include 'includes/footer.php'; ?>
    <?php include 'includes/scripts.php'; ?>
  </body>
</html>
