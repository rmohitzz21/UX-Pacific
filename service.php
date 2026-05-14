<?php
require_once __DIR__ . '/includes/cms_repository.php';

$pageTitle    = 'Services | UX Pacific';
$pageDesc     = 'Explore UX Pacific\'s full range of design services  UI/UX design, UX audits, product design, user research, and more for startups and enterprises.';
$canonicalUrl = 'https://www.uxpacific.com/services.php';
$ogTitle      = 'Services | UX Pacific';
$ogDesc       = 'From UX audits to full product design, UX Pacific offers tailored design services for every stage of your digital product journey.';
$ogUrl        = 'https://www.uxpacific.com/services.php';
$currentPage  = 'service';

$publishedServices = get_published_services();

function service_decode_list($value): array
{
  if (is_array($value)) {
    return array_values(array_filter(array_map(static fn($v) => trim((string) $v), $value), static fn($v) => $v !== ''));
  }
  if (is_string($value) && trim($value) !== '') {
    $decoded = json_decode($value, true);
    if (is_array($decoded)) {
      return array_values(array_filter(array_map(static fn($v) => trim((string) $v), $decoded), static fn($v) => $v !== ''));
    }
  }
  return [];
}

function service_icon_url(string $icon): string
{
  $icon = trim($icon);
  if ($icon === '') {
    return '';
  }

  if (preg_match('#^https?://#i', $icon)) {
    return $icon;
  }

  // Uploaded image or absolute site path — same rules as projects/logos
  if (
    strpos($icon, 'uploads/') !== false
    || strpos($icon, '/uploads/') !== false
    || (isset($icon[0]) && $icon[0] === '/')
    || preg_match('#\.(png|jpe?g|webp|gif)(\?|$)#i', $icon)
  ) {
    return uxp_normalize_stored_media_url($icon);
  }

  // Font Awesome class (e.g. fa-palette) — do not prefix with site path
  return $icon;
}

$servicesDataDynamic = [];
foreach ($publishedServices as $service) {
  $title = trim((string) ($service['title'] ?? 'Service'));
  $shortDesc = trim((string) ($service['short_desc'] ?? ''));
  $iconName = trim((string) ($service['icon_name'] ?? ''));
  $servicesDataDynamic[] = [
    'id' => (int) ($service['id'] ?? 0),
    'title' => $title,
    'desc' => $shortDesc,
    'icon' => $iconName !== '' ? service_icon_url($iconName) : 'fa-palette',
    'fullDesc' => $shortDesc,
    'solves' => service_decode_list($service['what_it_solves'] ?? null),
    'steps' => service_decode_list($service['how_we_work'] ?? null),
    'changes' => service_decode_list($service['what_changes'] ?? null),
    'deliverables' => service_decode_list($service['deliverables'] ?? null),
  ];
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include 'includes/head.php'; ?>
    <style>
      /* ── Our Story ── */
      .ab-story-section { padding: 64px 0; max-width: 1200px; margin: 0 auto; padding-left: 16px; padding-right: 16px; }
      .ab-story-grid { display: grid; grid-template-columns: 1fr 1fr; gap: clamp(2rem, 5vw, 6rem); align-items: center; }
      .ab-story-image { position: relative; border-radius: 32px; overflow: hidden; aspect-ratio: 4/3; }
      .ab-story-image img { width: 100%; height: 100%; object-fit: cover; display: block; }
      .ab-story-image::after { content: ''; position: absolute; inset: 0; background: linear-gradient(135deg, rgba(124,95,230,0.15) 0%, transparent 100%); pointer-events: none; }
      .ab-story-content { display: flex; flex-direction: column; gap: 24px; }
      .ab-label { display: inline-block; font-size: 0.75rem; font-weight: 600; letter-spacing: 0.16em; text-transform: uppercase; color: #a78bfa; }
      .ab-title { font-family: 'Inter', sans-serif; font-size: clamp(1.75rem, 4vw, 2.75rem); font-weight: 700; letter-spacing: -0.02em; line-height: 1.25; color: #ffffff; margin: 0; }
      .ab-title em { font-style: normal; background: linear-gradient(135deg, #6147bd 0%, #a78bfa 50%, #c084fc 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
      .ab-story-text { color: #8888b0; line-height: 1.7; font-size: 1rem; margin: 0; }
      .ab-cta-btn { display: inline-flex; align-items: center; gap: 8px; font-size: 0.9375rem; font-weight: 600; color: #ffffff !important; background: linear-gradient(90deg, #6147bd, #a78bfa); padding: 14px 28px; border-radius: 9999px; text-decoration: none !important; width: fit-content; transition: box-shadow 0.3s ease, transform 0.3s ease; }
      .ab-cta-btn:hover { box-shadow: 0 4px 24px rgba(124,95,230,0.45); transform: translateY(-2px); }
      /* ── Mission / Vision ── */
      .ab-mv-section { padding: 80px 16px; }
      .ab-mv-inner { max-width: 1200px; margin: 0 auto; }
      .ab-mv-header { text-align: center; max-width: 680px; margin: 0 auto clamp(2.5rem, 5vw, 4.5rem); }
      .ab-mv-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; }
      .ab-mv-card { position: relative; border-radius: 32px; overflow: hidden; aspect-ratio: 4/3; }
      .ab-mv-card img { width: 100%; height: 100%; object-fit: cover; filter: brightness(0.35); transition: filter 400ms ease, transform 400ms ease; display: block; }
      .ab-mv-card:hover img { filter: brightness(0.45); transform: scale(1.03); }
      .ab-mv-card__body { position: absolute; inset: 0; display: flex; flex-direction: column; justify-content: flex-end; padding: clamp(1.5rem, 3vw, 2.5rem); background: linear-gradient(to top, rgba(7,7,26,0.9) 0%, transparent 60%); }
      .ab-mv-card__label { font-size: 0.75rem; font-weight: 600; letter-spacing: 0.16em; text-transform: uppercase; color: #a78bfa; margin-bottom: 12px; }
      .ab-mv-card__title { font-family: 'Inter', sans-serif; font-size: clamp(1.75rem, 3.5vw, 2.5rem); font-weight: 800; color: #ffffff; margin-bottom: 12px; line-height: 1.1; }
      .ab-mv-card__text { font-size: 0.875rem; color: rgba(255,255,255,0.7); line-height: 1.7; margin: 0; }
      .ab-mv-card__chips { display: flex; flex-wrap: wrap; gap: 8px; margin-top: 16px; }
      .ab-mv-chip { font-size: 0.75rem; font-weight: 500; color: #a78bfa; background: rgba(124,95,230,0.2); border: 1px solid rgba(124,95,230,0.3); padding: 4px 12px; border-radius: 9999px; backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px); }
      /* ── Core Values ── */
      .ab-values-section { background: #0b0b1e; padding: 80px 16px; }
      .ab-values-inner { max-width: 1200px; margin: 0 auto; }
      .ab-section-header-center { text-align: center; max-width: 680px; margin: 0 auto clamp(2.5rem, 5vw, 4.5rem); }
      /* ── Process Steps ── */
      .ab-process-section { padding: 80px 16px; }
      .ab-process-inner { max-width: 1200px; margin: 0 auto; }
      .ab-process-steps { display: grid; grid-template-columns: repeat(5, 1fr); gap: 16px; position: relative; margin-top: 48px; }
      .ab-process-steps::before { content: ''; position: absolute; top: 28px; left: 10%; right: 10%; height: 1px; background: linear-gradient(90deg, #6147bd, #a78bfa); opacity: 0.3; pointer-events: none; }
      .ab-process-step { display: flex; flex-direction: column; align-items: center; gap: 16px; text-align: center; }
      .ab-process-step__num { width: 56px; height: 56px; border-radius: 50%; background: #14143a; border: 2px solid rgba(124,95,230,0.35); display: flex; align-items: center; justify-content: center; font-family: 'Inter', sans-serif; font-size: 0.875rem; font-weight: 800; color: #a78bfa; position: relative; z-index: 1; transition: all 250ms ease; flex-shrink: 0; }
      .ab-process-step:hover .ab-process-step__num { background: linear-gradient(90deg, #6147bd, #a78bfa); border-color: transparent; color: #ffffff; box-shadow: 0 0 30px rgba(124,95,230,0.25); }
      .ab-process-step__title { font-family: 'Inter', sans-serif; font-size: 0.875rem; font-weight: 600; color: #ffffff; }
      .ab-process-step__desc { font-size: 0.75rem; color: #8888b0; line-height: 1.7; }
      @media (max-width: 900px) {
        .ab-story-grid { grid-template-columns: 1fr; }
        .ab-mv-grid { grid-template-columns: 1fr; }
        .ab-process-steps { grid-template-columns: repeat(2, 1fr); }
        .ab-process-steps::before { display: none; }
      }
      @media (max-width: 720px) { .ab-story-section { padding: 40px 16px; } .ab-mv-section { padding: 48px 16px; } }
      @media (max-width: 580px) { .ab-process-steps { grid-template-columns: 1fr; } .ab-process-section { padding: 48px 16px; } }
    </style>
  </head>
  <body class="about-page">
    <?php include 'includes/navbar.php'; ?>

    <section class="about-header">
      <video class="header-bg-video" autoplay muted loop playsinline>
        <source src="img/test.mp4" type="video/mp4">
      </video>
      <div class="header-bg-overlay"></div>
      <h1>Services</h1>
      <div class="innovation-badge-exact">
        <span class="badge-desktop">We design user-focused digital solutions that combine strategy, creativity, and research.<br>From UI to brand strategy, every service is built to deliver real results.</span>
        <span class="badge-mobile">Design That <span>Delivers</span> Real <span>Results</span></span>
      </div>
    </section>


        <h2 class="ux-title" style="margin-top: 50px;">Design Solutions That Put <span class="highlight"> Users </span> First</h2>


   

        <main>
      <section class="services-grid-section mb-5 mt-0">
        <div class="container text-center">
          <div class="row g-4 justify-content-center" id="services-grid-container" style="max-width:1200px;margin:0 auto;">
            <!-- Cards populated dynamically by JS -->
          </div>
        </div>
      </section>
    </main>

    <!-- <h3 class="ux-subtitle" style="margin-top: 50px">Our Story <span class="ux-line"> </span></h3> -->
    <!-- <div class="ab-story-section">
      <div class="ab-story-grid">
        <div class="ab-story-image">
          <img src="img/Rectangle 5208.webp" alt="Our Story — UX Pacific team at work" loading="lazy" />
        </div>
        <div class="ab-story-content">
          <h2 class="ab-title">Born from a Belief<br />in <em>Better Design</em></h2>
          <p class="ab-story-text">UX Pacific was established on 1st May, 2025 with a clear vision — to create meaningful and impactful digital experiences. What started as a passion for design and strategy has grown into a mission to help brands build user-focused solutions that truly make a difference.</p>
          <p class="ab-story-text">From day one, our goal has been simple: combine creativity, research, and empathy to design experiences that not only look beautiful but also solve real problems. We are known for delivering reliable work with unmatched precision, backed by robust design thinking and professional execution.</p>
        </div>
      </div>
    </div>

    <section class="ab-mv-section">
      <div class="ab-mv-inner">
        <div class="ab-mv-header">
          <h3 class="ux-subtitle" style="margin-top: 50px">Our Purpose <span class="ux-line"> </span></h3>
          <h2 class="ab-title" style="margin-top: 12px;">Mission &amp; <em>Vision</em></h2>
        </div>
        <div class="ab-mv-grid">
          <div class="ab-mv-card">
            <img src="img/Rectangle 5208.webp" alt="Our Mission" loading="lazy" />
            <div class="ab-mv-card__body">
              <div class="ab-mv-card__label">Mission</div>
              <h3 class="ab-mv-card__title">What We Do</h3>
              <p class="ab-mv-card__text">To humanize digital experiences through purposeful, scalable, and trend-aware design solutions that drive real impact for people and businesses.</p>
              <div class="ab-mv-card__chips"><span class="ab-mv-chip">Trust-building</span><span class="ab-mv-chip">High Performance</span><span class="ab-mv-chip">Research-driven</span></div>
            </div>
          </div>
          <div class="ab-mv-card">
            <img src="img/Rectangle 5208 (1).webp" alt="Our Vision" loading="lazy" />
            <div class="ab-mv-card__body">
              <div class="ab-mv-card__label">Vision</div>
              <h3 class="ab-mv-card__title">Where We're Headed</h3>
              <p class="ab-mv-card__text">To be a global leader in human-centred design by delivering intuitive, impactful, and accessible digital experiences that set new industry standards.</p>
              <div class="ab-mv-card__chips"><span class="ab-mv-chip">Inclusive Design</span><span class="ab-mv-chip">Accessibility</span><span class="ab-mv-chip">Global Scale</span></div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="ab-process-section">
      <div class="ab-values-inner">
        <div class="ab-section-header-center">
          <h3 class="ux-subtitle" style="margin-top: 50px">What Drives Us <span class="ux-line"> </span></h3>
          <h2 class="ab-title" style="margin-top: 12px;">Our Core <em>Values</em></h2>
          <p class="ab-story-text" style="max-width:560px;margin:16px auto 0;">The principles that guide every decision we make and every experience we design.</p>
        </div>
        <div class="ab-process-steps">
          <div class="ab-process-step"><div class="ab-process-step__num">01</div><h4 class="ab-process-step__title">Purpose-First</h4><p class="ab-process-step__desc">Every design decision starts with a clear reason. We never design for decoration — we design for outcomes.</p></div>
          <div class="ab-process-step"><div class="ab-process-step__num">02</div><h4 class="ab-process-step__title">Empathy Always</h4><p class="ab-process-step__desc">We put people at the centre of everything. Understanding users deeply is our most important design tool.</p></div>
          <div class="ab-process-step"><div class="ab-process-step__num">03</div><h4 class="ab-process-step__title">Research-Driven</h4><p class="ab-process-step__desc">Intuition is great. Data is better. We combine both to build experiences grounded in real-world insight.</p></div>
          <div class="ab-process-step"><div class="ab-process-step__num">04</div><h4 class="ab-process-step__title">Craft Obsessed</h4><p class="ab-process-step__desc">We sweat the details so our clients don't have to. Quality and precision are non-negotiable at every stage.</p></div>
          <div class="ab-process-step"><div class="ab-process-step__num">05</div><h4 class="ab-process-step__title">Deliver Impact</h4><p class="ab-process-step__desc">We launch with confidence and measure what matters. Every solution is built to create measurable results — not just visual appeal.</p></div>
        </div>
      </div>
    </section>

    <div class="container">
      <div class="process-section">
        <div class="process-card"><img src="img/process.gif" alt="Process Illustration" class="process-img"></div>
        <div class="process-content">
          <div class="process-title">Our Proven Process</div>
          <ul class="process-list">
            <li>Gain deep insight into user behavior, motivations, and pain points.</li>
            <li>Analyze insights and clearly define the core problem.</li>
            <li>Brainstorm and explore a wide range of creative solutions.</li>
            <li>Create low to high-fidelity versions of solutions to test ideas quickly.</li>
            <li>Validate prototypes with real users, gather feedback, and refine.</li>
          </ul>
        </div>
      </div>
    </div> -->

    <section class="cta-section">
      <div class="dots-bg desktop-only"><canvas id="dots-canvas"></canvas></div>
      <div class="cta-container">
        <div class="cta-text">
          <h1>Start your <span>UI/UX</span> journey with <br><span class="highlight">UX Pacific Team</span></h1>
          <p class="mt-4 mb-4">Build your site effortlessly and showcase your work with confidence.<br> Ready to stand out? Get started today!</p>
          <a href="/contact" class="btn-primary">Get in touch <span class="arrow"></span></a>
        </div>
        <div class="cta-blur-overlay"></div>
        <div class="cta-image"><img src="img/Rectangle 5192.webp" alt="UX Design" /></div>
      </div>
    </section>

    <?php include 'includes/footer.php'; ?>
    <?php include 'includes/scripts.php'; ?>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="serviceOffcanvas" aria-labelledby="serviceOffcanvasLabel" style="width:650px;background-color:#111111;color:#fff;max-width:100vw;border-left:1px solid #2e2e3e;margin-top:150px;">
      <div class="offcanvas-header pb-0 border-0" style="padding:24px 32px;">
        <div class="d-flex w-100 justify-content-between align-items-start">
          <div id="oc-icon" style="width:48px;height:48px;background:rgba(255,255,255,0.05);border:1px solid #2e2e3e;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:20px;color:#fff;"><i class="fas fa-palette"></i></div>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close" style="font-size:12px;opacity:0.5;"></button>
        </div>
      </div>
      <div class="offcanvas-body" style="padding:16px 32px 32px 32px;">
        <h3 id="oc-title" style="font-size:24px;font-weight:700;margin-bottom:24px;color:#fff;">UI Design &amp; Prototyping</h3>
        <p id="oc-desc" style="color:#b2bad6;font-size:15px;margin-bottom:32px;line-height:1.6;">We craft pixel-perfect interfaces that look beautiful and feel effortless. Every interaction is intentional.</p>
        <h6 style="font-size:12px;font-weight:700;color:#a78bfa;letter-spacing:1px;text-transform:uppercase;margin-bottom:16px;">What This Solves</h6>
        <div class="row g-2 mb-4" id="oc-solves" style="color:#e0e0e0;font-size:14px;"></div>
        <h6 style="font-size:12px;font-weight:700;color:#a78bfa;letter-spacing:1px;text-transform:uppercase;margin-bottom:16px;">How We Work</h6>
        <div id="oc-steps" class="mb-4"></div>
        <h6 style="font-size:12px;font-weight:700;color:#a78bfa;letter-spacing:1px;text-transform:uppercase;margin-bottom:16px;">What Changes After This</h6>
        <div class="row g-2 mb-4" id="oc-changes" style="color:#e0e0e0;font-size:14px;"></div>
        <div class="accordion mb-4 border-0" id="deliverablesAccordion" style="--bs-accordion-border-width:0;--bs-accordion-bg:transparent;">
          <div class="accordion-item border-0" style="background:rgba(255,255,255,0.05);border:1px solid #2e2e3e;border-radius:8px;overflow:hidden;">
            <h2 class="accordion-header" id="headingDeliverables">
              <button class="accordion-button collapsed shadow-none border-0" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDeliverables" aria-expanded="false" style="background:transparent;color:#fff;font-weight:600;font-size:14px;padding:16px;">See Deliverables</button>
            </h2>
            <div id="collapseDeliverables" class="accordion-collapse collapse" aria-labelledby="headingDeliverables">
              <div class="accordion-body" style="padding:0 16px 16px 16px;">
                <ul id="oc-deliverables" style="list-style:none;padding:0;margin:0;color:#b2bad6;font-size:14px;line-height:2;"></ul>
              </div>
            </div>
          </div>
        </div>
        <div class="mt-auto pt-3 pb-4">
          <div class="text-center">
            <a href="/contact" class="custom-discuss-btn" style="background-color:#6147bd;color:#ffffff;padding:14px 40px;border-radius:50px;text-decoration:none;font-weight:500;font-size:18px;display:inline-block;box-shadow:0 10px 30px rgba(97,71,189,0.5);min-width:250px;">Discuss This Service</a>
          </div>
        </div>
      </div>
    </div>

    <style>
      .ux-card { background:#111111; border-radius:12px; padding:32px 24px; text-align:left; color:#fff; box-shadow:0 4px 6px -1px rgba(0,0,0,0.3),0 2px 4px -1px rgba(0,0,0,0.2); height:100%; display:flex; flex-direction:column; cursor:pointer; transition:transform 0.2s ease,box-shadow 0.2s ease,border-color 0.2s ease; border:1px solid #2e2e3e; text-decoration:none !important; }
      .ux-card:hover { transform:translateY(-4px); box-shadow:0 10px 15px -3px rgba(0,0,0,0.5),0 4px 6px -2px rgba(0,0,0,0.3); border-color:#a78bfa; }
      .ux-card-icon { width:48px; height:48px; background:rgba(255,255,255,0.05); border:1px solid #2e2e3e; border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:20px; color:#fff; margin-bottom:24px; }
      .ux-card-title { font-size:18px; font-weight:600; margin-bottom:12px; color:#fff; }
      .ux-card-desc { font-size:14px; color:#cccccc; margin-bottom:24px; flex-grow:1; line-height:1.5; }
      .ux-card-link { font-size:14px; color:#6147bd; font-weight:500; }
      .ux-card:hover .ux-card-link { color:#d8b4fe; }
      .oc-step { background:rgba(255,255,255,0.05); border:1px solid #2e2e3e; border-radius:8px; padding:12px 16px; margin-bottom:8px; display:flex; align-items:center; font-size:14px; color:#e0e0e0; }
      .oc-step-num { color:#a78bfa; margin-right:16px; font-size:13px; font-weight:600; }
      .accordion-button::after { filter:invert(1) grayscale(100%) brightness(200%); }
    </style>

   <script>
const servicesData = <?= json_encode($servicesDataDynamic, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?>;

function normalizeIconValue(value) {
  const icon = (value || '').toString().trim();
  return icon ? icon : 'fa-palette';
}

function isImageIcon(value) {
  const icon = normalizeIconValue(value).toLowerCase();
  return icon.includes('/') || icon.endsWith('.png') || icon.endsWith('.jpg') || icon.endsWith('.jpeg') || icon.endsWith('.webp') || icon.endsWith('.gif');
}

function renderIconHtml(value, title) {
  const icon = normalizeIconValue(value);
  if (isImageIcon(icon)) {
    return `<img src="${icon}" alt="${title || 'Service icon'}" style="width:26px;height:26px;object-fit:contain;">`;
  }
  return `<i class="fas ${icon}"></i>`;
}

function renderServiceCards() {
  const container = document.getElementById('services-grid-container');
  if (!servicesData.length) {
    container.innerHTML = `
      <div class="col-12 col-md-8 col-lg-6">
        <div class="ux-card" style="cursor:default;">
          <div class="ux-card-title">Services coming soon</div>
          <div class="ux-card-desc">No published services found yet. Add and publish services from the admin panel.</div>
        </div>
      </div>`;
    return;
  }
  container.innerHTML = servicesData.map(s => `
    <div class="col-12 col-md-6 col-lg-4">
      <div class="ux-card" onclick="openService(${s.id})" data-bs-toggle="offcanvas" data-bs-target="#serviceOffcanvas">
        <div class="ux-card-icon">${renderIconHtml(s.icon, s.title)}</div>
        <div class="ux-card-title">${s.title}</div>
        <div class="ux-card-desc">${s.desc}</div>
        <div class="ux-card-link">Explore Service →</div>
      </div>
    </div>
  `).join('');
}

function openService(id) {
  const s = servicesData.find(x => x.id === id);
  if (!s) return;
  document.getElementById('oc-icon').innerHTML = renderIconHtml(s.icon, s.title);
  document.getElementById('oc-title').textContent = s.title;
  document.getElementById('oc-desc').textContent = s.fullDesc || s.desc || '';
  document.getElementById('oc-solves').innerHTML = (s.solves || []).map(x => `<div class="col-6"><div style="background:rgba(255,255,255,0.05);border-radius:6px;padding:8px 12px;font-size:13px;">✓ ${x}</div></div>`).join('');
  document.getElementById('oc-steps').innerHTML = (s.steps || []).map((x,i)=>`<div class="oc-step"><span class="oc-step-num">${String(i+1).padStart(2,'0')}</span>${x}</div>`).join('');
  document.getElementById('oc-changes').innerHTML = (s.changes || []).map(x => `<div class="col-6"><div style="background:rgba(167,139,250,0.1);border-radius:6px;padding:8px 12px;font-size:13px;color:#c4b5fd;">→ ${x}</div></div>`).join('');
  document.getElementById('oc-deliverables').innerHTML = (s.deliverables || []).map(x => `<li>• ${x}</li>`).join('');
}

document.addEventListener('DOMContentLoaded', renderServiceCards);
</script>
  </body>
</html>
