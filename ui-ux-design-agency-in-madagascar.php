<?php
$countrySlug     = 'madagascar';
$pageTitle       = 'UI UX Design Agency in Madagascar | UX Pacific';
$pageDesc        = 'UX Pacific delivers expert UI/UX design services across Madagascar. Browse our locations or book a free UX audit today.';
$metaKeywords    = 'UI UX Design Madagascar, UI UX Agency Madagascar, UX Design Madagascar, UX Research Madagascar, UI Design Madagascar, Product Design Madagascar, UX Audit Madagascar, Usability Testing Madagascar, UX Consultant Madagascar, UX Company Madagascar, Design System Madagascar';
$metaAuthor      = 'UXPACIFIC';
$metaRobots      = 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1';
$themeColor      = '#080808';
$geoRegion       = 'MG';
$geoCountry      = 'Madagascar';
$contentLanguage = 'fr-MG';
$canonicalUrl    = 'https://www.uxpacific.com/ui-ux-design-agency-in-madagascar';
$ogTitle         = 'UI UX Design Agency in Madagascar | UX Pacific';
$ogDesc          = 'UX Pacific delivers expert UI/UX design services across Madagascar. Browse our locations or book a free UX audit today.';
$ogUrl           = 'https://www.uxpacific.com/ui-ux-design-agency-in-madagascar';
$ogImage         = 'https://www.uxpacific.com/img/og-madagascar.jpg';
$ogLocale        = 'mg_MG';
$currentPage     = '';

$_gFaqs = [
  ['q' => 'Do you provide UI UX design services in Madagascar?', 'a' => 'Yes. UX Pacific supports Madagascar businesses remotely with UX research, UI design, usability testing, UX audits, product discovery, and design systems, serving businesses across all major regions of Madagascar.'],
  ['q' => 'How does GDPR-aligned affect UX design for Madagascar businesses?', 'a' => 'GDPR-aligned directly shapes consent flows, data collection forms, and privacy communications. We integrate GDPR-aligned requirements into the design process from day one, building trust through honest UX patterns rather than treating compliance as an afterthought.'],
  ['q' => 'Can you design multilingual and localised interfaces for Madagascar?', 'a' => 'Yes. We design for local language and cultural requirements from the first wireframe, not as a retrofit after an English design is finalised. All layout, text expansion, and regional adaptations are considered from the start.'],
  ['q' => 'Can you work with startups and scaleups in Madagascar?', 'a' => 'Yes. We work with early-stage startups through to growth-stage scaleups across Madagascar. Our sprint-based model adapts to startup timelines and budgets without sacrificing research quality or design rigour.'],
  ['q' => 'How much does UX design cost for a Madagascar business?', 'a' => 'Investment ranges from around $5,000 for a focused audit to $50,000+ for a full product design engagement, depending on scope. We offer transparent, milestone-based pricing. Contact us for a scoped estimate.'],
  ['q' => 'Does UX Pacific design for Madagascar accessibility standards like WCAG 2.1 AA?', 'a' => 'Yes. We design to WCAG 2.1 AA as standard — ensuring your product is accessible and meets the relevant regulatory requirements for Madagascar. Accessible design is built into our core process, not offered as an optional add-on.'],
  ['q' => 'Can you redesign an existing digital product?', 'a' => 'Yes. We begin with a thorough UX audit, identify the highest-impact friction points, and redesign key user flows to improve usability, conversion, and retention.'],
  ['q' => 'Can you sign an NDA before we discuss our project?', 'a' => 'Yes. We sign an NDA before any confidential product, user, or business information is shared, in line with the data protection standards Madagascar businesses expect.'],
  ['q' => 'How does remote collaboration work for Madagascar clients?', 'a' => 'We use Figma for shared design workspaces, structured workshops via video, and async updates between sessions. Madagascar clients consistently find our process more organised than many local agency relationships.'],
  ['q' => 'How quickly do you respond to project enquiries from Madagascar?', 'a' => 'We respond to all qualified enquiries within one business day. Book a free UX audit via the button on this page to start immediately.'],
];

$_schemaFaqs = array_map(fn($f) => [
  '@type'          => 'Question',
  'name'           => $f['q'],
  'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f['a']],
], $_gFaqs);

$ldJson = json_encode([
  '@context' => 'https://schema.org',
  '@graph'   => [
    [
      '@type'         => 'WebPage',
      '@id'           => 'https://www.uxpacific.com/ui-ux-design-agency-in-madagascar#webpage',
      'url'           => 'https://www.uxpacific.com/ui-ux-design-agency-in-madagascar',
      'name'          => 'UI UX Design Agency in Madagascar | UX Pacific',
      'description'   => 'UX Pacific delivers expert UI/UX design services across Madagascar. Browse our locations or book a free UX audit today.',
      'inLanguage'    => 'en',
      'datePublished' => '2026-06-26',
      'dateModified'  => '2026-06-29',
      'about'         => ['@type' => 'Country', 'name' => 'Madagascar'],
    ],
    [
      '@type'           => 'BreadcrumbList',
      'itemListElement' => [
        ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home',      'item' => 'https://www.uxpacific.com/'],
        ['@type' => 'ListItem', 'position' => 2, 'name' => 'Madagascar',  'item' => 'https://www.uxpacific.com/ui-ux-design-agency-in-madagascar'],
      ],
    ],
    [
      '@type'  => 'Organization',
      '@id'    => 'https://www.uxpacific.com/#organization',
      'name'   => 'UX Pacific',
      'url'    => 'https://www.uxpacific.com',
      'logo'   => 'https://www.uxpacific.com/img/LOGO.png',
      'sameAs' => ['https://www.linkedin.com/company/uxpacific/', 'https://www.instagram.com/official_uxpacific/'],
    ],
    [
      '@type'       => 'Service',
      'name'        => 'UI/UX Design Services in Madagascar',
      'provider'    => ['@id' => 'https://www.uxpacific.com/#organization'],
      'areaServed'  => ['@type' => 'Country', 'name' => 'Madagascar'],
      'serviceType' => 'UI UX Design, UX Research, Usability Testing, UX Audit, Product Discovery, Design Systems, GDPR-aligned-Compliant UX',
      'url'         => 'https://www.uxpacific.com/ui-ux-design-agency-in-madagascar',
    ],
    ['@type' => 'FAQPage', 'mainEntity' => $_schemaFaqs],
  ],
], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

$hubChildren = [
  ['name' => 'Antananarivo Province', 'url' => '/ui-ux-design-agency-in-antananarivo-province-madagascar', 'basename' => 'ui-ux-design-agency-in-antananarivo-province-madagascar'],
  ['name' => 'Antsiranana Province', 'url' => '/ui-ux-design-agency-in-antsiranana-province-madagascar', 'basename' => 'ui-ux-design-agency-in-antsiranana-province-madagascar'],
  ['name' => 'Fianarantsoa Province', 'url' => '/ui-ux-design-agency-in-fianarantsoa-province-madagascar', 'basename' => 'ui-ux-design-agency-in-fianarantsoa-province-madagascar'],
  ['name' => 'Mahajanga Province', 'url' => '/ui-ux-design-agency-in-mahajanga-province-madagascar', 'basename' => 'ui-ux-design-agency-in-mahajanga-province-madagascar'],
  ['name' => 'Toamasina Province', 'url' => '/ui-ux-design-agency-in-toamasina-province-madagascar', 'basename' => 'ui-ux-design-agency-in-toamasina-province-madagascar'],
  ['name' => 'Toliara Province', 'url' => '/ui-ux-design-agency-in-toliara-province-madagascar', 'basename' => 'ui-ux-design-agency-in-toliara-province-madagascar'],
];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include 'includes/head.php'; ?>
  </head>
  <body>
    <?php include 'includes/navbar.php'; ?>

    <!-- ═══════════════════════════════════════
         HERO
    ═══════════════════════════════════════ -->
    <div class="hero-wrapper" style="position:relative;overflow:hidden">
      <canvas id="interactive-canvas" style="position:absolute;top:0;left:0;width:100%;height:100%;z-index:0;"></canvas>
      <div class="custom-cursor"></div>
      <section class="hero">
        <div style="display:inline-block;border:1px solid rgba(255,255,255,.15);background:rgba(255,255,255,.04);padding:8px 20px;border-radius:40px;color:rgba(200,200,220,.8);font-size:13px;font-weight:500;letter-spacing:.05em;margin-bottom:24px;">
          Research-Led UI UX Design Agency Serving Madagascar
        </div>
        <h1 id="heading">UI UX DESIGN AGENCY<br /><span style="font-weight:800">IN Madagascar</span></h1>
        <p class="subtext" style="max-width:780px;margin:0.4rem auto 0;line-height:1.75;">Helping Madagascar startups, SaaS teams, SMEs and enterprises make better product decisions through UX Research, Market Research, Usability Testing, Product Discovery and Human-Centered UI Design.</p>
        <div style="display:flex;gap:14px;justify-content:center;flex-wrap:wrap;margin-top:2rem;">
          <a class="btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#auditModal" style="height:44px;padding:0 28px;margin-top:0;display:inline-flex;align-items:center;gap:8px;width:auto;">
            Book Free 30-Min UX Consultation <span class="arrow"> </span>
          </a>
          <a href="#framework" style="display:inline-flex;align-items:center;height:44px;padding:0 26px;border:1px solid rgba(255,255,255,.18);border-radius:50px;color:rgba(200,200,220,.85);font-size:.9rem;font-weight:600;text-decoration:none;transition:background .2s,border-color .2s,color .2s;" onmouseover="this.style.background='rgba(255,255,255,.06)';this.style.borderColor='rgba(255,255,255,.35)';this.style.color='#fff'" onmouseout="this.style.background='transparent';this.style.borderColor='rgba(255,255,255,.18)';this.style.color='rgba(200,200,220,.85)'">
            See Our Framework
          </a>
        </div>
        <div class="ux-header">
          <span class="ux-badg"> </span>
          <div class="scroller">
            <ul class="scroller__inner">
              <li class="scroller__item">SIMPLE</li><li class="scroller__item">INTENTIONAL</li>
              <li class="scroller__item">HUMAN</li><li class="scroller__item">SCALABLE</li>
              <li class="scroller__item">SMART</li><li class="scroller__item">EMPATHETIC</li>
              <li class="scroller__item">MEASURED</li><li class="scroller__item">IMPACTFUL</li>
              <li class="scroller__item">ACCESSIBLE</li>
            </ul>
          </div>
          <span class="ux-end"> </span>
        </div>
      </section>
    </div>

    <style>
      /* ── Gold Standard .de-* additions ── */
      .de-wrap{max-width:1100px;margin:0 auto;padding:0 22px}
      .de-section{padding:64px 0}
      .de-bc{display:flex;flex-wrap:wrap;gap:6px;align-items:center;font-size:.78rem;color:rgba(200,200,220,.5);padding:28px 22px 0;max-width:1100px;margin:0 auto}
      .de-bc a{color:#a78bfa;text-decoration:none}.de-bc a:hover{text-decoration:underline}
      .de-bc span{color:rgba(200,200,220,.25)}
      .de-h2{font-size:clamp(1.45rem,3vw,2.1rem);font-weight:700;color:#f0eeff;margin-bottom:.55rem;line-height:1.2}
      .de-sub{color:rgba(200,200,220,.72);font-size:1rem;max-width:680px;line-height:1.75;margin-bottom:2rem}
      .de-label{display:inline-block;font-size:.75rem;font-weight:600;letter-spacing:.08em;text-transform:uppercase;color:#a78bfa;margin-bottom:.6rem}
      .de-grid{display:grid;gap:1rem}
      .de-grid-4{grid-template-columns:repeat(auto-fit,minmax(230px,1fr))}
      .de-grid-3{grid-template-columns:repeat(auto-fit,minmax(270px,1fr))}
      .de-grid-2{grid-template-columns:repeat(auto-fit,minmax(340px,1fr))}
      .de-card{background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.08);border-radius:12px;padding:1.35rem 1.45rem;transition:border-color .3s,background .3s}
      .de-card:hover{border-color:#a78bfa;background:rgba(97,71,189,.06)}
      .de-card-icon{font-size:1.6rem;margin-bottom:.75rem;display:block;line-height:1}
      .de-card h3{color:#e8e0ff;font-size:.97rem;font-weight:700;margin:0 0 .45rem}
      .de-card p{color:rgba(200,200,220,.75);font-size:.855rem;line-height:1.7;margin:0}
      .de-svc{background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.08);border-left:3px solid #6147bd;border-radius:0 12px 12px 0;padding:1.2rem 1.4rem;transition:border-color .3s,background .3s}
      .de-svc:hover{border-color:#a78bfa;border-left-color:#a78bfa;background:rgba(97,71,189,.05)}
      .de-svc h3{color:#e8e0ff;font-size:.95rem;font-weight:700;margin:0 0 .4rem}
      .de-svc p{color:rgba(200,200,220,.72);font-size:.84rem;line-height:1.65;margin:0}
      .de-dlv-icon{width:36px;height:36px;border-radius:8px;background:rgba(97,71,189,.18);border:1px solid rgba(97,71,189,.3);display:flex;align-items:center;justify-content:center;font-size:1rem;margin-bottom:.85rem;flex-shrink:0}
      .de-compare-wrap{border:1px solid rgba(255,255,255,.07);border-radius:12px;overflow:hidden;margin-top:1.8rem}
      .de-compare{width:100%;border-collapse:collapse}
      .de-compare thead th{padding:1rem 1.3rem;font-size:.75rem;font-weight:700;letter-spacing:.07em;text-transform:uppercase;border-bottom:1px solid rgba(255,255,255,.08);background:rgba(255,255,255,.02)}
      .de-compare thead th:first-child{color:rgba(200,200,220,.45)}
      .de-compare thead th:last-child{color:#a78bfa}
      .de-compare tbody tr{border-bottom:1px solid rgba(255,255,255,.05);transition:background .2s}
      .de-compare tbody tr:last-child{border-bottom:none}
      .de-compare tbody tr:hover{background:rgba(97,71,189,.05)}
      .de-compare td{padding:.95rem 1.3rem;font-size:.875rem;line-height:1.55;vertical-align:top}
      .de-compare td:first-child{color:rgba(200,200,220,.5);position:relative;padding-left:2rem}
      .de-compare td:first-child::before{content:"\2715";position:absolute;left:.85rem;top:.95rem;font-size:.7rem;color:rgba(200,50,50,.5)}
      .de-compare td:last-child{color:#d4c7ff;font-weight:500;position:relative;padding-left:2rem}
      .de-compare td:last-child::before{content:"\2713";position:absolute;left:.85rem;top:.95rem;font-size:.75rem;color:#6147bd;font-weight:700}
      .de-faq-list{margin-top:1.5rem}
      .de-faq-item{border-bottom:1px solid rgba(255,255,255,.07)}
      .de-faq-item:last-child{border-bottom:none}
      .de-faq-q{width:100%;background:none;border:none;text-align:left;padding:1rem 0;cursor:pointer;display:flex;justify-content:space-between;align-items:center;gap:1rem;color:#e8e0ff;font-size:.93rem;font-weight:600;line-height:1.45}
      .de-faq-q:hover{color:#c4b5fd}
      .de-faq-icon{flex-shrink:0;width:20px;height:20px;border-radius:50%;border:1px solid rgba(167,139,250,.35);display:flex;align-items:center;justify-content:center;color:#a78bfa;font-size:.85rem;transition:transform .3s,background .2s}
      .de-faq-item.open .de-faq-icon{transform:rotate(45deg);background:rgba(97,71,189,.15)}
      .de-faq-a{display:none;padding:0 0 1rem;color:rgba(200,200,220,.78);font-size:.875rem;line-height:1.75}
      .de-faq-item.open .de-faq-a{display:block}
      .de-hub-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(195px,1fr));gap:.8rem;margin-top:1.5rem}
      .de-hub-card{display:flex;align-items:center;justify-content:space-between;background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.08);border-radius:9px;padding:.78rem 1.05rem;text-decoration:none;color:#d4c7ff;font-size:.875rem;font-weight:500;transition:border-color .25s,background .25s,color .25s}
      .de-hub-card:hover{border-color:#a78bfa;background:rgba(97,71,189,.1);color:#fff}
      .de-hub-arr{font-size:.8rem;opacity:.45;transition:opacity .25s,transform .25s}
      .de-hub-card:hover .de-hub-arr{opacity:1;transform:translateX(3px)}
      .de-cta-box{background:linear-gradient(135deg,rgba(97,71,189,.15),rgba(167,139,250,.06));border:1px solid rgba(167,139,250,.22);border-radius:16px;padding:2.5rem 2rem;text-align:center;margin-top:1.5rem}
      .de-cta-box h2{color:#fff;font-size:clamp(1.2rem,2.5vw,1.6rem);font-weight:700;margin-bottom:.6rem}
      .de-cta-box p{color:rgba(200,200,220,.78);font-size:.95rem;margin-bottom:1.5rem;line-height:1.7}
      .de-cred-strip{display:flex;flex-wrap:wrap;gap:0;border:1px solid rgba(255,255,255,.07);border-radius:12px;overflow:hidden;margin-top:2rem}
      .de-cred-item{flex:1;min-width:160px;padding:1.2rem 1.5rem;text-align:center;border-right:1px solid rgba(255,255,255,.07)}
      .de-cred-item:last-child{border-right:none}
      .de-cred-val{display:block;font-size:1.6rem;font-weight:800;color:#c4b5fd;letter-spacing:-.02em;margin-bottom:.2rem}
      .de-cred-lbl{font-size:.78rem;color:rgba(200,200,220,.55);line-height:1.4}
      @media(max-width:640px){.de-cred-item{border-right:none;border-bottom:1px solid rgba(255,255,255,.07)}.de-cred-item:last-child{border-bottom:none}}
      .de-process{display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:1rem;margin-top:1.4rem}
      .de-proc-step{display:flex;gap:.85rem;align-items:flex-start}
      .de-proc-num{flex-shrink:0;width:28px;height:28px;border-radius:50%;background:#6147bd;color:#fff;font-size:.75rem;font-weight:800;display:flex;align-items:center;justify-content:center;margin-top:.1rem}
      .de-proc-step h4{color:#e8e0ff;font-size:.88rem;font-weight:700;margin:0 0 .2rem}
      .de-proc-step p{color:rgba(200,200,220,.65);font-size:.8rem;line-height:1.55;margin:0}
      .de-fw-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1px;background:rgba(255,255,255,.065);border:1px solid rgba(255,255,255,.07);border-radius:14px;overflow:hidden;margin-top:2rem}
      .de-fw-step{background:#080812;padding:1.8rem 1.6rem;transition:background .3s}
      .de-fw-step:hover{background:rgba(97,71,189,.08)}
      .de-fw-num{font-size:.68rem;font-weight:800;color:#6147bd;letter-spacing:.12em;text-transform:uppercase;display:block;margin-bottom:.8rem}
      .de-fw-step h3{color:#e8e0ff;font-size:1rem;font-weight:700;margin:0 0 .5rem;line-height:1.25}
      .de-fw-step p{color:rgba(200,200,220,.62);font-size:.835rem;line-height:1.7;margin:0}
      @media(max-width:768px){.de-fw-grid{grid-template-columns:repeat(2,1fr)}}
      @media(max-width:480px){.de-fw-grid{grid-template-columns:1fr}}
      .de-proc-grid{display:grid;gap:1rem;margin-top:2rem;grid-template-columns:repeat(auto-fit,minmax(134px,1fr))}
      @media(min-width:1024px){.de-proc-grid{grid-template-columns:repeat(7,1fr)}}
      @media(max-width:600px){.de-proc-grid{grid-template-columns:repeat(2,1fr)}}
      .de-proc-card{background:rgba(255,255,255,.025);border:1px solid rgba(255,255,255,.07);border-radius:10px;padding:1.25rem 1.1rem;transition:border-color .25s,background .25s}
      .de-proc-card:hover{border-color:rgba(97,71,189,.45);background:rgba(97,71,189,.06)}
      .de-proc-label{font-size:.65rem;font-weight:800;color:#6147bd;letter-spacing:.1em;text-transform:uppercase;display:block;margin-bottom:.7rem}
      .de-proc-card h3{color:#e8e0ff;font-size:.9rem;font-weight:700;margin:0 0 .4rem;line-height:1.2}
      .de-proc-card p{color:rgba(200,200,220,.58);font-size:.79rem;line-height:1.6;margin:0}
      .de-team-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1.25rem;margin-top:2rem}
      @media(max-width:768px){.de-team-grid{grid-template-columns:1fr}}
      .de-team-card{background:rgba(255,255,255,.025);border:1px solid rgba(255,255,255,.07);border-radius:14px;padding:2rem 1.75rem;display:flex;flex-direction:column;gap:1.25rem;transition:border-color .25s,background .25s}
      .de-team-card:hover{border-color:rgba(97,71,189,.4);background:rgba(97,71,189,.05)}
      .de-team-avatar{width:56px;height:56px;border-radius:50%;background:linear-gradient(135deg,rgba(97,71,189,.35),rgba(167,139,250,.2));border:1px solid rgba(97,71,189,.35);display:flex;align-items:center;justify-content:center;font-size:1.3rem;flex-shrink:0}
      .de-team-role{font-size:.65rem;font-weight:800;color:#6147bd;letter-spacing:.1em;text-transform:uppercase;margin-bottom:.3rem}
      .de-team-card h3{color:#e8e0ff;font-size:1rem;font-weight:700;margin:0 0 .5rem;line-height:1.25}
      .de-team-card p{color:rgba(200,200,220,.6);font-size:.83rem;line-height:1.65;margin:0 0 1rem}
      .de-team-tags{display:flex;flex-wrap:wrap;gap:.4rem}
      .de-team-tag{font-size:.7rem;font-weight:600;color:#a78bfa;background:rgba(97,71,189,.12);border:1px solid rgba(97,71,189,.22);border-radius:20px;padding:.25rem .65rem}
      .de-link-btn{display:inline-flex;align-items:center;gap:.45rem;color:#a78bfa;border:1px solid rgba(167,139,250,.28);border-radius:8px;padding:.6rem 1.2rem;font-size:.875rem;font-weight:600;text-decoration:none;transition:background .2s,border-color .2s,color .2s}
      .de-link-btn:hover{background:rgba(97,71,189,.12);border-color:#a78bfa;color:#c4b5fd}
      .de-divider{border:none;border-top:1px solid rgba(255,255,255,.06);margin:0}
      @media(max-width:768px){.de-grid-2{grid-template-columns:1fr}.de-grid-3{grid-template-columns:1fr}.de-grid-4{grid-template-columns:1fr 1fr}}
    </style>

    <!-- ═══════════════════════════════════════
         BREADCRUMB
    ═══════════════════════════════════════ -->
    <nav class="de-bc" aria-label="Breadcrumb">
      <a href="/">Home</a><span>&#8250;</span>
      <span>Madagascar</span>
    </nav>

    <!-- ═══════════════════════════════════════
         TRUST SECTION
    ═══════════════════════════════════════ -->
    <div class="de-wrap de-section">
      <span class="de-label">Why Trust UX Pacific</span>
      <h2 class="de-h2">We Don't Start With Screens. We Start With Research.</h2>
      <p class="de-sub">Every engagement begins with users, evidence, and business goals — not assumptions. Here is what that means in practice for Madagascar businesses.</p>

      <div class="de-grid de-grid-4" style="margin-top:1.8rem">
        <div class="de-card">
          <span class="de-card-icon">&#128269;</span>
          <h3>Research Before Design</h3>
          <p>Every recommendation is backed by user behaviour, interviews, surveys, usability testing, or UX audit findings — not assumptions.</p>
        </div>
        <div class="de-card">
          <span class="de-card-icon">&#128230;</span>
          <h3>Clear Deliverables</h3>
          <p>You receive UX audit reports, research summaries, wireframes, high-fidelity UI screens, prototypes, and developer handoff files.</p>
        </div>
        <div class="de-card">
          <span class="de-card-icon">&#129504;</span>
          <h3>Senior-Led Process</h3>
          <p>Every project is led by an experienced UX strategist — structured, research-driven, and aligned to your specific business goals.</p>
        </div>
        <div class="de-card">
          <span class="de-card-icon">&#128737;</span>
          <h3>GDPR-aligned-Aware Approach</h3>
          <p>We follow privacy-conscious research practices and responsible data handling — built into the process, not retrofitted after.</p>
        </div>
      </div>

      <div class="de-cred-strip">
        <div class="de-cred-item"><span class="de-cred-val">50+</span><span class="de-cred-lbl">Products Designed &amp; Audited</span></div>
        <div class="de-cred-item"><span class="de-cred-val">15+</span><span class="de-cred-lbl">Countries Served Remotely</span></div>
        <div class="de-cred-item"><span class="de-cred-val">100%</span><span class="de-cred-lbl">NDA Signed Before Every Discussion</span></div>
        <div class="de-cred-item"><span class="de-cred-val">&lt;24h</span><span class="de-cred-lbl">Response Time to Qualified Enquiries</span></div>
      </div>
    </div>

    <hr class="de-divider">

    <!-- ═══════════════════════════════════════
         SERVICES
    ═══════════════════════════════════════ -->
    <div class="de-wrap de-section">
      <span class="de-label">Services</span>
      <h2 class="de-h2">UI/UX Design Services for Madagascar Businesses</h2>
      <p class="de-sub">From early-stage user research and product discovery through to launch-ready UI design and scalable design systems — covering the complete product experience lifecycle.</p>

      <div class="de-grid de-grid-3">
        <div class="de-svc">
          <h3>UX Research &amp; Audit</h3>
          <p>User interviews, heuristic evaluation, journey mapping, competitive benchmarking, and usability testing. We identify where your product loses users and why.</p>
        </div>
        <div class="de-svc">
          <h3>UI Design &amp; Prototyping</h3>
          <p>High-fidelity Figma screens and interactive prototypes — responsive across desktop and mobile, built to WCAG 2.1 AA standards, ready for developer handoff.</p>
        </div>
        <div class="de-svc">
          <h3>GDPR-aligned-Compliant UX</h3>
          <p>Consent flows, cookie banners, data collection forms, and privacy communication designed to meet Madagascar regulatory requirements without harming the user experience.</p>
        </div>
        <div class="de-svc">
          <h3>Design Systems</h3>
          <p>Scalable component libraries and token-based design systems that unify product teams and accelerate consistent, quality delivery at pace.</p>
        </div>
        <div class="de-svc">
          <h3>Product Discovery</h3>
          <p>Stakeholder workshops, user journey mapping, and opportunity framing — aligning business goals with user needs before a single screen is designed.</p>
        </div>
        <div class="de-svc">
          <h3>Accessibility (WCAG 2.1 AA)</h3>
          <p>Design to WCAG 2.1 AA standards — ensuring your product reaches every user and meets Madagascar regulatory accessibility requirements.</p>
        </div>
      </div>

      <div style="margin-top:1.8rem">
        <a class="de-link-btn" href="/service">View All Services &#8594;</a>
      </div>
    </div>

    <hr class="de-divider">

    <!-- ═══════════════════════════════════════
         INSIGHT FRAMEWORK
    ═══════════════════════════════════════ -->
    <div class="de-wrap de-section" id="framework">
      <span class="de-label">Our Method</span>
      <h2 class="de-h2">UXPACIFIC Insight Framework&#8482;</h2>
      <p class="de-sub">A six-stage method that ensures every design decision is grounded in real user evidence — not internal opinion or visual preference.</p>
      <div class="de-fw-grid">
        <div class="de-fw-step"><span class="de-fw-num">01 &mdash; Understand</span><h3>Discover the Real Problem</h3><p>We align with stakeholders to surface business goals, constraints, and the gap between what you think users want and what they actually need.</p></div>
        <div class="de-fw-step"><span class="de-fw-num">02 &mdash; Observe</span><h3>Research Real Users</h3><p>Interviews, surveys, usability sessions, and behavioural data collection — conducted with actual users in your target market across Madagascar.</p></div>
        <div class="de-fw-step"><span class="de-fw-num">03 &mdash; Synthesise</span><h3>Find the Patterns</h3><p>Raw data becomes structured insight — pain points ranked by frequency and severity, opportunity areas identified, and key findings documented for your team.</p></div>
        <div class="de-fw-step"><span class="de-fw-num">04 &mdash; Define</span><h3>Frame the Solution</h3><p>Insights are translated into a clear UX strategy: prioritised user flows, experience principles, and a product direction your whole team can align around.</p></div>
        <div class="de-fw-step"><span class="de-fw-num">05 &mdash; Design</span><h3>Create and Iterate</h3><p>Wireframes, high-fidelity UI screens, and interactive prototypes — designed to WCAG 2.1 AA standards and GDPR-aligned-compliant interface patterns.</p></div>
        <div class="de-fw-step"><span class="de-fw-num">06 &mdash; Validate</span><h3>Test Before You Build</h3><p>Moderated usability testing on real prototypes identifies friction before development starts — saving your team from costly mid-build rework.</p></div>
      </div>
    </div>

    <hr class="de-divider">

    <!-- ═══════════════════════════════════════
         DELIVERABLES
    ═══════════════════════════════════════ -->
    <div class="de-wrap de-section">
      <span class="de-label">Deliverables</span>
      <h2 class="de-h2">What You Receive</h2>
      <p class="de-sub">Every engagement produces clear, structured outputs — making the work easy to review, approve, implement, and build on over time.</p>
      <div class="de-grid de-grid-3" style="margin-top:1.8rem">
        <div class="de-card"><div class="de-dlv-icon">&#128203;</div><h3>UX Audit Report</h3><p>A detailed written review of usability issues, conversion barriers, accessibility gaps, GDPR-aligned compliance risks, and navigation problems — each prioritised by business impact.</p></div>
        <div class="de-card"><div class="de-dlv-icon">&#128269;</div><h3>Research Summary</h3><p>Interview findings, observed user behaviour, ranked pain points, validated opportunities, and clear evidence-backed recommendations — documented for your team and stakeholders.</p></div>
        <div class="de-card"><div class="de-dlv-icon">&#128396;</div><h3>Wireframes</h3><p>Low to mid-fidelity layouts showing structure, content hierarchy, and user flow logic — ready for internal review, stakeholder sign-off, and developer scoping.</p></div>
        <div class="de-card"><div class="de-dlv-icon">&#128187;</div><h3>UI Screens</h3><p>High-fidelity Figma screens designed to WCAG 2.1 AA accessibility standards, responsive across desktop and mobile — production-quality from day one.</p></div>
        <div class="de-card"><div class="de-dlv-icon">&#128257;</div><h3>Interactive Prototype</h3><p>A clickable Figma prototype for stakeholder presentations, client reviews, and moderated usability testing — before a single line of code is committed.</p></div>
        <div class="de-card"><div class="de-dlv-icon">&#128230;</div><h3>Developer Handoff</h3><p>Organised Figma files with auto-layout components, design tokens, annotated specs, and export-ready assets — structured so developers can implement without ambiguity.</p></div>
      </div>
    </div>

    <hr class="de-divider">

    <!-- ═══════════════════════════════════════
         COMPARISON TABLE
    ═══════════════════════════════════════ -->
    <div class="de-wrap de-section">
      <span class="de-label">Why UX Pacific</span>
      <h2 class="de-h2">Traditional Design Agency vs UX Pacific</h2>
      <p class="de-sub">Most agencies start with screens. We start with research. Here is what that difference looks like in practice for Madagascar businesses.</p>
      <div class="de-compare-wrap">
        <table class="de-compare">
          <thead><tr><th>Traditional Design Agency</th><th>UX Pacific Approach</th></tr></thead>
          <tbody>
            <tr><td>Starts with visual concepts and screen layouts</td><td>Starts with user research, business goals, and evidence</td></tr>
            <tr><td>Opinion-based design decisions</td><td>Recommendations backed by real user data and audit findings</td></tr>
            <tr><td>No usability testing or validation stage</td><td>Usability testing built into every engagement before development</td></tr>
            <tr><td>Focused on visual output only</td><td>Focused on user experience and measurable business outcomes</td></tr>
            <tr><td>Handoff files with minimal context or documentation</td><td>Structured handoff with design tokens, annotations, and developer specs</td></tr>
            <tr><td>GDPR-aligned and accessibility treated as afterthoughts</td><td>GDPR-aligned compliance and WCAG 2.1 AA accessibility designed in from day one</td></tr>
          </tbody>
        </table>
      </div>
    </div>

    <hr class="de-divider">

    <!-- ═══════════════════════════════════════
         UX DELIVERY PROCESS
    ═══════════════════════════════════════ -->
    <div class="de-wrap de-section" id="process">
      <span class="de-label">HOW WE WORK</span>
      <h2 class="de-h2">Our UX Delivery Process</h2>
      <p class="de-sub">A structured, transparent workflow designed for Madagascar and international teams that need clarity, speed, and reliable communication at every stage.</p>
      <div class="de-proc-grid">
        <div class="de-proc-card"><span class="de-proc-label">Step 01</span><h3>Discovery</h3><p>Align on business goals, user needs, constraints, and measurable success criteria before a single pixel is drawn.</p></div>
        <div class="de-proc-card"><span class="de-proc-label">Step 02</span><h3>Research</h3><p>Gather evidence through user interviews, usability tests, competitor audits, and surveys tailored to your market.</p></div>
        <div class="de-proc-card"><span class="de-proc-label">Step 03</span><h3>UX Strategy</h3><p>Translate raw insights into prioritised user flows, experience principles, and a clear product direction.</p></div>
        <div class="de-proc-card"><span class="de-proc-label">Step 04</span><h3>Wireframes</h3><p>Define information architecture, content hierarchy, and journey logic before committing to visual design.</p></div>
        <div class="de-proc-card"><span class="de-proc-label">Step 05</span><h3>UI Design</h3><p>Craft modern, accessible, and scalable interfaces aligned with your brand and GDPR-aligned requirements.</p></div>
        <div class="de-proc-card"><span class="de-proc-label">Step 06</span><h3>Testing</h3><p>Validate usability with real users, identify friction points, and iterate before final delivery.</p></div>
        <div class="de-proc-card"><span class="de-proc-label">Step 07</span><h3>Handoff</h3><p>Deliver organised design files, developer annotations, and a full asset library ready for implementation.</p></div>
      </div>
    </div>

    <hr class="de-divider">

    <!-- ═══════════════════════════════════════
         EXPERT TEAM
    ═══════════════════════════════════════ -->
    <div class="de-wrap de-section">
      <span class="de-label">THE TEAM</span>
      <h2 class="de-h2">Expert Team Framework</h2>
      <p class="de-sub">Every UX Pacific project is staffed with a dedicated trio — a researcher, a designer, and a project manager — so nothing falls between the cracks.</p>
      <div class="de-team-grid">
        <div class="de-team-card"><div class="de-team-avatar">&#128269;</div><div><div class="de-team-role">Research</div><h3>UX Research Lead</h3><p>Plans and runs every research activity: stakeholder interviews, user sessions, usability tests, survey design, heuristic audits, and synthesis into actionable insight reports.</p><div class="de-team-tags"><span class="de-team-tag">User Interviews</span><span class="de-team-tag">Usability Testing</span><span class="de-team-tag">Survey Design</span><span class="de-team-tag">Insight Reports</span></div></div></div>
        <div class="de-team-card"><div class="de-team-avatar">&#9998;</div><div><div class="de-team-role">Design</div><h3>Senior Product Designer</h3><p>Translates research findings into user flows, wireframes, high-fidelity UI screens, interactive prototypes, and a documented design system ready for your development team.</p><div class="de-team-tags"><span class="de-team-tag">Wireframes</span><span class="de-team-tag">UI Design</span><span class="de-team-tag">Prototyping</span><span class="de-team-tag">Design Systems</span></div></div></div>
        <div class="de-team-card"><div class="de-team-avatar">&#128203;</div><div><div class="de-team-role">Delivery</div><h3>Project Manager</h3><p>Owns timelines, async communication, milestone tracking, and structured handoff documentation so your engineering team can move immediately without back-and-forth.</p><div class="de-team-tags"><span class="de-team-tag">Timeline Management</span><span class="de-team-tag">Weekly Updates</span><span class="de-team-tag">Handoff Docs</span><span class="de-team-tag">NDA &amp; Contracts</span></div></div></div>
      </div>
    </div>

    <hr class="de-divider">

    <!-- ═══════════════════════════════════════
         FAQ
    ═══════════════════════════════════════ -->
    <div class="de-wrap de-section">
      <span class="de-label">FAQ</span>
      <h2 class="de-h2">Frequently Asked Questions — UI/UX Design in Madagascar</h2>
      <p class="de-sub">Common questions from Madagascar startups, SMEs, and enterprises exploring UI/UX design and user research services.</p>

      <div class="de-faq-list" id="deFaqList">
        <?php foreach ($_gFaqs as $fq): ?>
        <div class="de-faq-item">
          <button class="de-faq-q" type="button" aria-expanded="false">
            <?= htmlspecialchars($fq['q'], ENT_QUOTES, 'UTF-8') ?>
            <span class="de-faq-icon" aria-hidden="true">+</span>
          </button>
          <div class="de-faq-a"><?= htmlspecialchars($fq['a'], ENT_QUOTES, 'UTF-8') ?></div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>

    <script>
      (function(){
        var items = document.querySelectorAll('#deFaqList .de-faq-item');
        items.forEach(function(item){
          var btn = item.querySelector('.de-faq-q');
          btn.addEventListener('click', function(){
            var isOpen = item.classList.contains('open');
            items.forEach(function(i){ i.classList.remove('open'); i.querySelector('.de-faq-q').setAttribute('aria-expanded','false'); });
            if(!isOpen){ item.classList.add('open'); btn.setAttribute('aria-expanded','true'); }
          });
        });
      })();
    </script>

    <hr class="de-divider">

    <!-- ═══════════════════════════════════════
         HUB NAVIGATION
    ═══════════════════════════════════════ -->
        <!-- ═══════════════════════════════════════
         HUB NAVIGATION
    ═══════════════════════════════════════ -->
    <?php if (!empty($hubChildren)): ?>
    <div class="de-wrap de-section">
      <span class="de-label">Browse by Region</span>
      <h2 class="de-h2">UI/UX Design Services Across Madagascar</h2>
      <p class="de-sub">We serve businesses in 6 regions, states, and cities in Madagascar. Select your location to see how UX Pacific supports companies in your specific area.</p>
      <div class="de-hub-grid">
        <?php foreach ($hubChildren as $hc): ?>
        <a href="<?= htmlspecialchars($hc['url'], ENT_QUOTES, 'UTF-8') ?>" class="de-hub-card">
          <span><?= htmlspecialchars($hc['name'], ENT_QUOTES, 'UTF-8') ?></span>
          <span class="de-hub-arr">&#8250;</span>
        </a>
        <?php endforeach; ?>
      </div>
    </div>
    <?php endif; ?>

    <hr class="de-divider">

    <!-- ═══════════════════════════════════════
         CTA
    ═══════════════════════════════════════ -->
    <div class="de-wrap de-section">
      <div class="de-cta-box">
        <span class="de-label" style="display:block;text-align:center;margin-bottom:.8rem">Get Started</span>
        <h2>Book a Free UX Audit for Your Madagascar Product</h2>
        <p>Share your product or website and we will give you a clear, honest review — what is working, what is losing users, and what to fix first.</p>

        <div class="de-process" style="text-align:left;margin-bottom:1.8rem">
          <div class="de-proc-step">
            <span class="de-proc-num">1</span>
            <div><h4>Submit Your Details</h4><p>Fill the form with your name, email, and product URL. We review it the same day.</p></div>
          </div>
          <div class="de-proc-step">
            <span class="de-proc-num">2</span>
            <div><h4>We Review Your Product</h4><p>Our team evaluates usability, trust signals, conversion flow, and GDPR-aligned compliance.</p></div>
          </div>
          <div class="de-proc-step">
            <span class="de-proc-num">3</span>
            <div><h4>You Receive a Written Report</h4><p>A concise audit with your top friction points and a prioritised action plan — no fluff.</p></div>
          </div>
        </div>

        <a class="btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#auditModal"
           style="width:230px;height:44px;padding-left:24px;display:inline-flex;align-items:center;text-decoration:none;margin:0 auto;">
          Book a Free UX Audit <span class="arrow"> </span>
        </a>

        <div style="margin-top:1.4rem;display:flex;flex-wrap:wrap;justify-content:center;gap:1.2rem 2rem;font-size:.8rem;color:rgba(200,200,220,.5)">
          <span>&#128274; NDA signed before any discussion</span>
          <span>&#128231; <a href="mailto:hello@uxpacific.com" style="color:#a78bfa;text-decoration:none;">hello@uxpacific.com</a></span>
          <span>&#9203; Response within one business day</span>
        </div>
      </div>
    </div>

    <?php include 'includes/footer.php'; ?>
    <?php include 'includes/scripts.php'; ?>

    <!-- Audit Success Popup -->
    <div id="auditSuccessPopup" style="display:none;position:fixed;inset:0;z-index:9999;align-items:center;justify-content:center;background:rgba(0,0,0,0.7);backdrop-filter:blur(6px);">
      <div style="background:#111127;border:1px solid rgba(97,71,189,0.4);border-radius:20px;padding:48px 40px;max-width:420px;width:90%;text-align:center;box-shadow:0 24px 80px rgba(0,0,0,0.8);position:relative;">
        <div style="width:68px;height:68px;background:linear-gradient(135deg,#6147bd,#a78bfa);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 24px;">
          <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
        </div>
        <h3 style="color:#fff;font-size:22px;font-weight:700;margin:0 0 12px;">Submitted Successfully!</h3>
        <p style="color:#b2bad6;font-size:15px;line-height:1.6;margin:0 0 28px;">Thank you! Your UX Audit request has been received. We will get back to you shortly.</p>
        <button onclick="document.getElementById('auditSuccessPopup').style.display='none';" style="background:linear-gradient(90deg,#6147bd,#a78bfa);border:none;padding:12px 36px;border-radius:50px;color:#fff;font-weight:600;font-size:15px;cursor:pointer;">Done</button>
      </div>
    </div>

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
                <div class="contact-field" style="display:flex;flex-direction:column;gap:6px;"><label for="auditName" style="font-size:15px;color:#b2bad6;">Name</label><input id="auditName" name="name" type="text" placeholder="Enter your name here" style="height:56px;width:100%;background:#151515;border:1px solid #2e2e3e;border-radius:6px;color:#eee;padding:16px 20px;font-size:1rem;outline:none;" onfocus="this.style.borderColor='#6147bd'" onblur="this.style.borderColor='#2e2e3e'"></div>
                <div class="contact-field" style="display:flex;flex-direction:column;gap:6px;"><label for="auditEmail" style="font-size:15px;color:#b2bad6;">Email</label><input id="auditEmail" name="email" type="email" placeholder="Enter your email address" style="height:56px;width:100%;background:#151515;border:1px solid #2e2e3e;border-radius:6px;color:#eee;padding:16px 20px;font-size:1rem;outline:none;" onfocus="this.style.borderColor='#6147bd'" onblur="this.style.borderColor='#2e2e3e'"></div>
                <div class="contact-field" style="display:flex;flex-direction:column;gap:6px;"><label for="auditPhone" style="font-size:15px;color:#b2bad6;">Phone Number</label><input id="auditPhone" name="phone" type="tel" placeholder="+1 xxx xxxxxxx" style="height:56px;width:100%;background:#151515;border:1px solid #2e2e3e;border-radius:6px;color:#eee;padding:16px 20px;font-size:1rem;outline:none;" onfocus="this.style.borderColor='#6147bd'" onblur="this.style.borderColor='#2e2e3e'"></div>
                <div class="contact-field" style="display:flex;flex-direction:column;gap:6px;"><label for="auditUrl" style="font-size:15px;color:#b2bad6;">Website URL</label><input id="auditUrl" name="url" type="text" placeholder="https://yourwebsite.com" style="height:56px;width:100%;background:#151515;border:1px solid #2e2e3e;border-radius:6px;color:#eee;padding:16px 20px;font-size:1rem;outline:none;" onfocus="this.style.borderColor='#6147bd'" onblur="this.style.borderColor='#2e2e3e'"></div>
              </div>
              <div id="auditError" style="display:none;margin-top:12px;color:#f87171;font-size:14px;text-align:center;"></div>
              <div class="contact-submit text-center mt-4 pt-2">
                <button id="auditSubmitBtn" type="submit" style="background-color:#6147bd;border:none;padding:12px 40px;border-radius:50px;color:#fff;font-weight:500;font-size:16px;width:100%;height:50px;cursor:pointer;box-shadow:0 6px 20px rgba(97,71,189,0.4);transition:transform 0.2s;" onmouseover="this.style.transform='translateY(-2px)';" onmouseout="this.style.transform='translateY(0)';">Submit Request</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <script>
      document.getElementById('auditForm').addEventListener('submit', function(e) {
        e.preventDefault();
        var btn = document.getElementById('auditSubmitBtn');
        var errBox = document.getElementById('auditError');
        var nameVal  = document.getElementById('auditName').value.trim();
        var emailVal = document.getElementById('auditEmail').value.trim();
        var phoneVal = document.getElementById('auditPhone').value.trim();
        var urlVal   = document.getElementById('auditUrl').value.trim();
        errBox.style.display = 'none';
        document.querySelectorAll('#auditForm .field-error').forEach(function(el){el.remove();});
        document.querySelectorAll('#auditForm input').forEach(function(el){el.style.borderColor='#2e2e3e';});
        var errors = [];
        var emailRe = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        var urlRe   = /^(https?:\/\/)?([\w\-]+\.)+[\w\-]+(\/[\w\-._~:/?#[\]@!$&'()*+,;=]*)?$/i;
        if (!nameVal || nameVal.length < 2) errors.push({field:'auditName', msg:'Please enter your name'});
        if (!emailVal || !emailRe.test(emailVal)) errors.push({field:'auditEmail', msg:'Please enter a valid email address'});
        if (phoneVal && !/^[\d\s\-+()]{7,20}$/.test(phoneVal)) errors.push({field:'auditPhone', msg:'Please enter a valid phone number'});
        if (!urlVal || !urlRe.test(urlVal)) errors.push({field:'auditUrl', msg:'Please enter a valid website URL'});
        if (errors.length > 0) {
          errors.forEach(function(err){
            var inp = document.getElementById(err.field);
            inp.style.borderColor = '#f87171';
            var el = document.createElement('div');
            el.className = 'field-error';
            el.style.cssText = 'color:#f87171;font-size:12px;margin-top:4px;';
            el.textContent = err.msg;
            inp.parentNode.appendChild(el);
          });
          document.getElementById(errors[0].field).focus();
          return;
        }
        btn.disabled = true; btn.textContent = 'Sending…';
        fetch('send', {
          method: 'POST',
          headers: {'Content-Type': 'application/json'},
          body: JSON.stringify({form_type:'ux_audit',name:nameVal,email:emailVal,phone:phoneVal,url:urlVal,
            company_website:(document.getElementById('audit_company_website')||{}).value||'',
            form_started_at:parseInt((document.getElementById('audit_form_started_at')||{}).value||'0',10)||0})
        })
        .then(function(r){return r.json();})
        .then(function(res){
          if (res.success) {
            var m = bootstrap.Modal.getInstance(document.getElementById('auditModal'));
            if (m) m.hide();
            document.getElementById('auditForm').reset();
            if (window.UXPSuccessBox && typeof window.UXPSuccessBox.showSuccess === 'function') {
              window.UXPSuccessBox.showSuccess({title:'Request Submitted!',text:'Your UX Audit request has been received.',timer:3000});
            } else {
              var pop = document.getElementById('auditSuccessPopup');
              if (pop) pop.style.display = 'flex';
            }
          } else {
            errBox.textContent = res.message||'Something went wrong. Please try again.';
            errBox.style.display = 'block';
          }
        })
        .catch(function(){errBox.textContent='Network error. Please try again.';errBox.style.display='block';})
        .finally(function(){btn.disabled=false;btn.textContent='Submit Request';});
      });
      document.getElementById('auditModal').addEventListener('shown.bs.modal', function(){
        var bd = document.querySelector('.modal-backdrop.show');
        if (bd) bd.style.zIndex = '2190';
        var fs = document.getElementById('audit_form_started_at');
        if (fs) fs.value = String(Date.now());
        var hp = document.getElementById('audit_company_website');
        if (hp) hp.value = '';
      });
      document.getElementById('auditSuccessPopup').addEventListener('click', function(e){
        if (e.target === this) this.style.display = 'none';
      });
    </script>
  </body>
</html>