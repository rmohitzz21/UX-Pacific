<?php
/**
 * Shared location content section with Read More toggle.
 *
 * Expects $pageTitle and $countrySlug to already be set by the calling page.
 * Generates SEO content, breadcrumb, schema, and Read More UI automatically.
 */

// ── 1. Parse location name from page title ──────────────────────────────────
// Pattern: "UI UX Design Agency in {Location} | UX Pacific"
$_loc = ['name' => '', 'city' => '', 'country' => '', 'slug' => $countrySlug ?? ''];

if (!empty($pageTitle) && preg_match('/\bin\s+(.+?)\s*\|/i', $pageTitle, $_m)) {
    $_loc['name'] = trim($_m[1]);
    $lastComma = strrpos($_loc['name'], ',');
    if ($lastComma !== false) {
        $_loc['city']    = trim(substr($_loc['name'], 0, $lastComma));
        $_loc['country'] = trim(substr($_loc['name'], $lastComma + 1));
    } else {
        $_loc['city']    = $_loc['name'];
        $_loc['country'] = $_loc['name'];
    }
} else {
    $_loc['name']    = ucwords(str_replace('-', ' ', $_loc['slug']));
    $_loc['city']    = $_loc['name'];
    $_loc['country'] = $_loc['name'];
}

// ── 2. Build breadcrumb URLs ────────────────────────────────────────────────
$_countryUrlSlug = strtolower(preg_replace('/[^a-z0-9]+/i', '-', $_loc['country']));
$_countryUrl     = '/ui-ux-design-agency-in-' . trim($_countryUrlSlug, '-');
$_isCountryOnly  = $_loc['city'] === $_loc['country'];

// ── 3. Content variation (stable per page, varies across locations) ─────────
$_v = abs(crc32($_loc['slug'])) % 5;

$_introBlocks = [
    "The digital economy is creating real opportunities for businesses in {name} that understand one truth: users decide in seconds whether a product is worth their time. For organisations in {name} competing for that attention, UX Pacific brings the strategic design thinking and execution rigour needed to build digital products that earn trust, drive conversions, and retain users long after the first session.",
    "{name} represents a market where digital-first expectations are rising fast. As mobile penetration deepens and competition for user attention intensifies, the gap between products that merely function and products that genuinely delight has become a measurable revenue driver. UX Pacific partners with businesses in {name} to design experiences built around real user behaviour — not assumptions or best guesses.",
    "Businesses in {name} face the same challenge as digital companies everywhere: users who have experienced world-class products from global tech leaders now apply those standards to every app, website, and platform they encounter. UX Pacific works with {name}-based teams to close that expectation gap with design that is grounded in research, refined through testing, and built to perform.",
    "In {name}, the difference between a digital product that scales and one that stagnates is often a design problem in disguise. Conversion rates, onboarding completion, and user retention are fundamentally shaped by how clearly a product communicates its value and how frictionlessly it delivers on that promise. UX Pacific specialises in turning those design problems into measurable business outcomes for clients in {name}.",
    "Whether launching a new product, scaling an existing platform, or rescuing a digital experience that is underperforming, UX Pacific brings a structured, research-backed design process to businesses across {name}. Our work starts with your users — their context, their goals, their frustrations — and builds outward from there to create products that earn loyalty from the very first interaction.",
];

$_ecosystemBlocks = [
    "The business environment in {name} reflects a pattern emerging across global markets: organisations that treat user experience as a strategic investment consistently outperform those that treat it as an afterthought. Whether your business is in its early growth stage or operating at scale, the quality of the experience you deliver to users has a direct and measurable impact on retention, referral, and revenue.",
    "Across {name}, a growing number of businesses are discovering that design is not a finishing step — it is a strategic foundation. From startups raising their first round to enterprises managing legacy platform migrations, organisations in {name} that invest in UX early in the product lifecycle consistently see better unit economics, faster time-to-value for users, and lower support costs over time.",
    "The market in {name} is evolving rapidly. As digital-first behaviour becomes the default and user expectations are shaped by global technology leaders, the bar for what constitutes an acceptable digital experience continues to rise. UX Pacific tracks these shifts across international markets and applies that global perspective to every {name}-based engagement — ensuring the products we design are built for where users are going, not just where they are today.",
    "{name} sits within a broader digital landscape where user-centred design has become a critical differentiator. As more commerce, services, and communication moves online, the organisations capturing disproportionate digital growth share are the ones that have invested in clear, frictionless user experiences. UX Pacific helps {name}-based businesses make that investment count.",
    "Digital transformation in {name} is accelerating. Businesses across healthcare, education, finance, retail, and professional services are moving services online and quickly discovering that the adoption and retention of those services is determined primarily by the quality of the user experience. UX Pacific works at the intersection of business strategy and design execution to help {name}-based organisations lead rather than follow.",
];

$_fn = $_loc['name'];
$_fc = $_loc['city'];

$_intro     = str_replace(['{name}', '{city}'], [$_fn, $_fc], $_introBlocks[$_v]);
$_ecosystem = str_replace(['{name}', '{city}'], [$_fn, $_fc], $_ecosystemBlocks[$_v]);

// ── 4. FAQ set ──────────────────────────────────────────────────────────────
$_faqs = [
    [
        'q' => "Does UX Pacific work with businesses in {$_fn}?",
        'a' => "Yes. UX Pacific works with startups, growing businesses, and established enterprises in {$_fn} and the surrounding region. Our remote-first model means we collaborate just as effectively as an on-site partner — with structured delivery milestones, clear communication cadences, and full transparency on design progress at every stage of the engagement.",
    ],
    [
        'q' => "What types of businesses in {$_fn} benefit most from UX design?",
        'a' => "Any business in {$_fn} with a digital product, website, or application stands to benefit from UX investment. We have worked across fintech, e-commerce, SaaS, edtech, health-tech, and professional services. The common thread is a team that understands good design drives measurable business outcomes — not just a better-looking interface.",
    ],
    [
        'q' => "How does UX Pacific collaborate with {$_fn} clients remotely?",
        'a' => "Our process is built for remote-first collaboration. We use Figma for shared design workspaces, run structured workshops and design reviews via video, and deliver async progress updates so your team always has visibility — regardless of time zone. Clients in {$_fn} consistently report that our remote process feels more structured and transparent than many local agency relationships.",
    ],
    [
        'q' => "What does a typical UX project for a {$_fn} business look like?",
        'a' => "Engagements typically begin with a discovery phase — a UX audit or structured workshop where we review your existing product, identify the highest-impact friction points, and agree on clear design objectives. From there we progress through wireframing, prototyping, user validation, and high-fidelity design delivery. Scope and timeline depend on whether you need a landing page redesign, a full product overhaul, or an ongoing design partner relationship.",
    ],
    [
        'q' => "How do I get started with UX Pacific for my {$_fn} project?",
        'a' => "Book a free UX audit directly from this page. We will review your existing product or website, identify your biggest UX opportunities, and outline a practical design roadmap — no obligation, no sales pressure. Just an honest, expert assessment of where your product stands and exactly what it would take to move it forward.",
    ],
];

// ── 5. FAQPage schema for this location ─────────────────────────────────────
if (empty($ldJson)) {
    $schemaFaqs = array_map(function($f) {
        return [
            '@type' => 'Question',
            'name'  => $f['q'],
            'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f['a']],
        ];
    }, $_faqs);

    $ldJson = json_encode([
        '@context' => 'https://schema.org',
        '@graph'   => [
            ['@type' => 'WebPage',
             'url'   => $canonicalUrl ?? '',
             'name'  => $pageTitle ?? '',
             'inLanguage' => 'en',
            ],
            ['@type' => 'FAQPage', 'mainEntity' => $schemaFaqs],
        ],
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
}
?>

<!-- ===== LOCATION SECTION ===== -->
<style>
  .loc-section{max-width:860px;margin:0 auto;padding:0 20px}
  .loc-section h2{font-size:clamp(1.35rem,3vw,2rem);font-weight:700;color:#f0eeff;margin-bottom:.9rem}
  .loc-section h3{font-size:clamp(1rem,2.5vw,1.3rem);font-weight:600;color:#d4c7ff;margin:1.9rem 0 .7rem}
  .loc-section p{color:rgba(200,200,220,.88);line-height:1.8;font-size:1rem}
  .loc-breadcrumb{display:flex;flex-wrap:wrap;gap:5px;align-items:center;font-size:.8rem;color:rgba(200,200,220,.55);margin-bottom:1.6rem}
  .loc-breadcrumb a{color:#a78bfa;text-decoration:none}.loc-breadcrumb a:hover{text-decoration:underline}
  .loc-breadcrumb .sep{color:rgba(200,200,220,.25)}
  .loc-svc-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(190px,1fr));gap:1rem;margin:1.4rem 0}
  .loc-svc-card{background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.08);border-radius:10px;padding:1.1rem 1.2rem;transition:border-color .3s}
  .loc-svc-card:hover{border-color:#a78bfa}
  .loc-svc-card h4{color:#e8e0ff;font-size:.92rem;font-weight:600;margin:0 0 .4rem}
  .loc-svc-card p{color:rgba(200,200,220,.75);font-size:.83rem;line-height:1.6;margin:0}
  .loc-faq-item{border-bottom:1px solid rgba(255,255,255,.07);padding:1rem 0}
  .loc-faq-item h4{color:#e8e0ff;font-size:.93rem;font-weight:600;margin:0 0 .4rem}
  .loc-faq-item p{color:rgba(200,200,220,.8);font-size:.85rem;line-height:1.7;margin:0}
  .loc-links-grid{display:flex;flex-wrap:wrap;gap:7px;margin:1.1rem 0 1.8rem}
  .loc-links-grid a{background:rgba(97,71,189,.1);border:1px solid rgba(97,71,189,.28);border-radius:999px;padding:4px 13px;font-size:.78rem;color:#c4b5fd;text-decoration:none;transition:background .2s}
  .loc-links-grid a:hover{background:rgba(97,71,189,.25);color:#fff}
  .loc-cta-box{background:linear-gradient(135deg,rgba(97,71,189,.14),rgba(167,139,250,.05));border:1px solid rgba(167,139,250,.2);border-radius:13px;padding:1.75rem;text-align:center;margin:2.5rem 0 0}
  .loc-cta-box h2{color:#fff;margin-bottom:.7rem;font-size:clamp(1.1rem,2.5vw,1.55rem)}
  .loc-cta-box p{color:rgba(200,200,220,.8);margin-bottom:1.2rem;font-size:.93rem}
  #locFullContent{display:none}
  #locFullContent.loc-open{display:block;animation:locIn .38s ease forwards}
  @keyframes locIn{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:translateY(0)}}
  .loc-rm-btn{display:inline-flex;align-items:center;gap:7px;background:none;border:1px solid rgba(167,139,250,.32);border-radius:999px;color:#a78bfa;font-size:.88rem;font-weight:600;padding:6px 18px;margin-top:1.1rem;cursor:pointer;transition:background .2s,color .2s,border-color .2s;letter-spacing:.01em}
  .loc-rm-btn:hover{background:rgba(167,139,250,.1);color:#fff;border-color:#a78bfa}
  .loc-rm-btn .loc-icon{display:inline-block;transition:transform .3s ease;font-style:normal;font-size:1.05rem;line-height:1}
  .loc-rm-btn.loc-open .loc-icon{transform:rotate(90deg)}
</style>

<div class="loc-section" style="margin-top:48px;margin-bottom:56px">

  <!-- Breadcrumb -->
  <nav class="loc-breadcrumb" aria-label="Breadcrumb">
    <a href="/">Home</a>
    <?php if (!$_isCountryOnly): ?>
    <span class="sep">/</span>
    <a href="<?= htmlspecialchars($_countryUrl, ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($_loc['country'], ENT_QUOTES, 'UTF-8') ?></a>
    <?php endif; ?>
    <span class="sep">/</span>
    <span style="color:#e8e0ff"><?= htmlspecialchars($_loc['city'], ENT_QUOTES, 'UTF-8') ?></span>
  </nav>

  <!-- Teaser: always visible -->
  <h2>UI/UX Design Agency Serving <?= htmlspecialchars($_loc['name'], ENT_QUOTES, 'UTF-8') ?></h2>
  <p><?= htmlspecialchars($_intro, ENT_QUOTES, 'UTF-8') ?></p>
  <p>We are a remote-first UX and product design studio with a global portfolio and deep experience across international markets. Our team brings structured design thinking, rigorous user research, and pixel-perfect execution to every engagement — whether you are a startup building your first digital product or an enterprise redesigning a platform used by thousands.</p>

  <!-- Read More toggle -->
  <button id="locReadMoreBtn" class="loc-rm-btn" aria-expanded="false" aria-controls="locFullContent">
    Read More <i class="loc-icon">&#8250;</i>
  </button>

  <!-- Expandable content -->
  <div id="locFullContent" aria-hidden="true">

    <h3>Business and Digital Landscape in <?= htmlspecialchars($_loc['name'], ENT_QUOTES, 'UTF-8') ?></h3>
    <p><?= htmlspecialchars($_ecosystem, ENT_QUOTES, 'UTF-8') ?></p>
    <p>UX Pacific brings a global design perspective to every local engagement. We have worked with clients across Asia-Pacific, Europe, North America, and Africa — and we apply that breadth of experience to help <?= htmlspecialchars($_loc['name'], ENT_QUOTES, 'UTF-8') ?>-based businesses build products that are not just locally competitive but ready to scale internationally when the time comes.</p>

    <h3>UI/UX Design Services for <?= htmlspecialchars($_loc['name'], ENT_QUOTES, 'UTF-8') ?> Businesses</h3>
    <p>Our UI/UX design practice covers the complete spectrum of experience work — from early-stage discovery and user research through to high-fidelity design systems and production-ready component libraries. For clients in <?= htmlspecialchars($_loc['name'], ENT_QUOTES, 'UTF-8') ?>, we engage at the stage where impact is highest and work collaboratively through every design decision until launch and beyond.</p>
    <div class="loc-svc-grid">
      <div class="loc-svc-card">
        <h4>UX Strategy &amp; Research</h4>
        <p>Heuristic audits, user interviews, journey mapping, and competitive benchmarking to ground every design decision in evidence.</p>
      </div>
      <div class="loc-svc-card">
        <h4>UI Design &amp; Prototyping</h4>
        <p>High-fidelity Figma prototypes and interactive mockups that communicate design intent clearly to stakeholders and developers.</p>
      </div>
      <div class="loc-svc-card">
        <h4>Usability Testing</h4>
        <p>Moderated and unmoderated testing sessions that validate design decisions with real users before development investment is made.</p>
      </div>
      <div class="loc-svc-card">
        <h4>Design Systems</h4>
        <p>Scalable component libraries and token-based design systems that unify product teams and accelerate consistent delivery.</p>
      </div>
    </div>

    <h3>Web Design Services in <?= htmlspecialchars($_loc['name'], ENT_QUOTES, 'UTF-8') ?></h3>
    <p>A website in <?= htmlspecialchars($_loc['name'], ENT_QUOTES, 'UTF-8') ?> must do more than present information — it must convert. Our web design work begins with your conversion objectives and works backwards through information architecture, visual hierarchy, and interaction design to produce sites that attract the right users, communicate value clearly, and guide them to action without friction.</p>
    <p>We design websites across sectors including professional services, technology, retail, healthcare, and education. Every project begins with a discovery phase where we audit your existing analytics, benchmark competitor experiences, and align on the user tasks your site must enable. The result is a design that is purposeful by evidence — not just polished by opinion.</p>

    <h3>Product Design for <?= htmlspecialchars($_loc['name'], ENT_QUOTES, 'UTF-8') ?> Startups &amp; Scale-ups</h3>
    <p>For product teams in <?= htmlspecialchars($_loc['name'], ENT_QUOTES, 'UTF-8') ?> that need to move fast without sacrificing quality, UX Pacific operates as an embedded design partner. We offer sprint-based engagements, dedicated retainer models, and full product design buildouts — adapting our engagement model to where your company is in its growth journey and what your product needs most at this stage.</p>
    <p>Our product design work spans mobile-first consumer applications, enterprise SaaS platforms, B2B marketplaces, and data-heavy dashboards. We bring a consistent approach to each: define the problem clearly, validate the proposed solution with real users early, and iterate until the design is objectively ready — not just subjectively satisfying to the team that built it.</p>

    <h3>Why <?= htmlspecialchars($_loc['name'], ENT_QUOTES, 'UTF-8') ?> Businesses Choose a Remote UX Partner</h3>
    <p>The shift to remote-first collaboration has made geography largely irrelevant to design quality. Businesses in <?= htmlspecialchars($_loc['name'], ENT_QUOTES, 'UTF-8') ?> that partner with UX Pacific gain access to a senior design team without local agency overhead, without the cost and timeline of building an internal design function, and without the delays that come from geography or time zone constraints. Our async-first working model means your team always has design progress to review and react to — on your schedule.</p>
    <p>There is also a creative advantage to working with a team whose reference points extend beyond your immediate market. UX Pacific brings perspectives shaped by design work across multiple continents and dozens of industries. For businesses in <?= htmlspecialchars($_loc['name'], ENT_QUOTES, 'UTF-8') ?> with ambitions that extend beyond their home market, that global fluency is built into every design decision from day one.</p>

    <h3>Frequently Asked Questions — UX Design in <?= htmlspecialchars($_loc['name'], ENT_QUOTES, 'UTF-8') ?></h3>
    <?php foreach ($_faqs as $_fi => $_faq): ?>
    <div class="loc-faq-item"<?= $_fi === count($_faqs) - 1 ? ' style="border-bottom:none"' : '' ?>>
      <h4><?= htmlspecialchars($_faq['q'], ENT_QUOTES, 'UTF-8') ?></h4>
      <p><?= htmlspecialchars($_faq['a'], ENT_QUOTES, 'UTF-8') ?></p>
    </div>
    <?php endforeach; ?>

    <?php if (!$_isCountryOnly): ?>
    <h3>More UI/UX Design Locations in <?= htmlspecialchars($_loc['country'], ENT_QUOTES, 'UTF-8') ?></h3>
    <div class="loc-links-grid">
      <a href="<?= htmlspecialchars($_countryUrl, ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($_loc['country'], ENT_QUOTES, 'UTF-8') ?> (All Regions)</a>
    </div>
    <?php endif; ?>

    <div class="loc-cta-box">
      <h2>Ready to Improve Your Digital Product in <?= htmlspecialchars($_loc['name'], ENT_QUOTES, 'UTF-8') ?>?</h2>
      <p>Book a free UX audit — we will review your existing product or website and deliver a clear, actionable assessment with no obligation.</p>
      <a class="btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#auditModal"
         style="width:220px;height:44px;padding-left:24px;display:inline-flex;align-items:center;">
        Book a Free UX Audit <span class="arrow"> </span>
      </a>
    </div>

  </div><!-- /#locFullContent -->

</div><!-- /.loc-section -->

<script>
(function(){
  var btn=document.getElementById('locReadMoreBtn');
  var box=document.getElementById('locFullContent');
  if(!btn||!box)return;
  btn.addEventListener('click',function(){
    var open=box.classList.contains('loc-open');
    if(open){
      box.classList.remove('loc-open');
      box.setAttribute('aria-hidden','true');
      btn.setAttribute('aria-expanded','false');
      btn.classList.remove('loc-open');
      btn.firstChild.textContent='Read More ';
      btn.scrollIntoView({behavior:'smooth',block:'nearest'});
    } else {
      box.classList.add('loc-open');
      box.setAttribute('aria-hidden','false');
      btn.setAttribute('aria-expanded','true');
      btn.classList.add('loc-open');
      btn.firstChild.textContent='Read Less ';
    }
  });
})();
</script>
<!-- ===== END LOCATION SECTION ===== -->
