<?php
require_once __DIR__ . '/includes/cms_repository.php';

$countrySlug = 'perak-malaysia';

// Shared home sections: projects slider + ecosystem cards
$featuredProjects = get_published_projects('all', true);
$ecosystemHomeItems = get_published_ecosystem();

function home_image_url(?string $url): string {
  $url = trim((string) $url);
  if ($url === '') {
    return uxp_normalize_stored_media_url('img/ux.webp');
  }
  if (preg_match('#^https?://#i', $url)) {
    return $url;
  }

  return uxp_normalize_stored_media_url($url);
}

$pageTitle    = 'UI UX Design Agency in Perak, Malaysia | UX Pacific';
$pageDesc     = 'UX Pacific offers professional UI/UX design services in Perak, Malaysia. We create user-friendly digital experiences for businesses.';
$canonicalUrl = 'https://www.uxpacific.com/ui-ux-design-agency-in-perak-malaysia';
$ogTitle      = 'UI UX Design Agency in Perak, Malaysia | UX Pacific';
$ogDesc       = 'Looking for UI UX design services in Perak, Malaysia? UX Pacific delivers modern, user-focused digital solutions.';
$ogUrl        = 'https://www.uxpacific.com/ui-ux-design-agency-in-perak-malaysia';
$currentPage  = 'Home';

// Optional overrides from admin → geo_landing_pages (country_slug = afghanistan, is_published = 1)
$geoPage = uxp_geo_page($countrySlug);
if ($geoPage) {
  if (!empty($geoPage['page_title'])) {
    $pageTitle = (string) $geoPage['page_title'];
    $ogTitle = $pageTitle;
  }
  if (!empty($geoPage['meta_description'])) {
    $pageDesc = (string) $geoPage['meta_description'];
    $ogDesc = $pageDesc;
  }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include 'includes/head.php'; ?>
  </head>
  <body>
    <?php include 'includes/navbar.php'; ?>

    <div class="hero-wrapper" style="position: relative; overflow: hidden">
      <canvas id="interactive-canvas" style="position:absolute;top:0;left:0;width:100%;height:100%;z-index:0;"></canvas>
      <div class="custom-cursor"></div>
      <section class="hero">
        <h1 id="heading">
          WE CRAFT UX THAT MAKES THEM 
          <br />
          <span style="font-weight: 200">
            STAY, ENGAGE,
            <span style="font-weight: 800"> AND </span>
            CONVERT.
          </span>
        </h1>
        <p class="subtext">Designing Experiences, Not Just Interfaces</p>
        <br />
        <a class="btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#auditModal" style="width:210px;height:42px;margin-top:0px;padding-left:27px;">
          Book a UX Audit <span class="arrow"> </span>
        </a>
        <br /><br /><br /><br /><br />
        <div class="ux-header">
          <span class="ux-badg"> </span>
          <div class="scroller">
            <ul class="scroller__inner">
              <li class="scroller__item">SIMPLE</li>
              <li class="scroller__item">INTENTIONAL</li>
              <li class="scroller__item">HUMAN</li>
              <li class="scroller__item">SCALABLE</li>
              <li class="scroller__item">SMART</li>
              <li class="scroller__item">EMPATHETIC</li>
              <li class="scroller__item">MEASURED</li>
              <li class="scroller__item">IMPACTFUL</li>
              <li class="scroller__item">ACCESSIBLE</li>
            </ul>
          </div>
          <span class="ux-end"> </span>
        </div>
      </section>
    </div>

    <div class="ux-content mt-5 mb-5">
      <h3 class="ux-subtitle" style="margin-top: 50px">
        About Us <span class="ux-line"> </span>
      </h3>
      <h2 class="ux-title">
        Where Strategy Meets <span class="highlight"> Stunning </span> Design
      </h2>
      <p class="ux-description">
        We're a creative UX/UI design studio passionate about building human-centered digital products that inspire, engage, and perform.
      </p>
      <a class="view-more" href="/about"> View More &rarr; </a>
      <br />
    </div>
    <?php include 'includes/loc-section.php'; ?>


    <div class="ux-image-container" style="margin-top: 80px">
      <img alt="UX Strategy" class="ux-image" id="ii1" src="img/b.webp" />
      <div class="floating-tag" id="d1" style="top:15%;left:5%;width:119px;font-size:16px;transform:rotate(-13.19deg);">Accessibility</div>
      <span class="tag-image" id="d66" style="top:26%;left:14%;background-image:url('img/shruti.png')"></span>
      <div class="floating-tag" id="d3" style="top:22.5%;left:22%;width:75px;font-size:16px;transform:rotate(15.19deg);">UI/UX</div>
      <div class="floating-tag" id="d1" style="top:60%;left:15%;width:119px;font-size:16px;transform:rotate(19.19deg);">Wireframing</div>
      <span class="tag-image" id="d55" style="top:70%;left:24%;background-image:url('img/aradhya.png')"></span>
      <div class="floating-tag transform-sm rotate-90" id="d2" style="top:77%;left:3%;width:119px;font-size:16px;transform:rotate(25deg);">Navigation</div>
      <div id="fixitBtn" style="top:0%;left:52%;font-size:16px">
        <div class="main-container">
          <div class="brush-strokes" id="brush"><img alt="Brush Strokes" id="emoj" src="img/emojisad.png" /></div>
          <div class="puppet" id="puppet"><img alt="Finger Puppet" src="img/hand.png" /></div>
          <button class="fixit-btn">Fix It</button>
        </div>
      </div>
      <span class="tag-image" id="d33" style="top:20%;left:60%;background-image:url('img/you.png')"></span>
      <div class="floating-tag" id="d4" style="top:15%;left:85%;width:138px;font-size:16px;transform:rotate(-20deg);">Simplification</div>
      <span class="tag-image" id="d44" style="top:25%;left:90%;background-image:url('img/zulla.png')"></span>
      <div class="floating-tag" id="d5" style="top:30%;left:70%;width:140.96px;font-size:16px;transform:rotate(12.19deg);">Design System</div>
      <div class="floating-tag" id="d6" style="top:50%;left:87%;width:119px;font-size:16px;transform:rotate(18.19deg);">Interaction</div>
      <div class="floating-tag" id="d1" style="top:73%;left:70%;width:119px;height:40px;font-size:16px;transform:rotate(-13.19deg);">Functionality</div>
      <span class="tag-image" id="d1" style="top:80%;left:80%;background-image:url('img/vedant.png')"></span>
    </div>

    <section class="services-section1">
      <h5>Our Services</h5>
      <span class="ux-line"> </span>
      <h1>Design Solutions That <br />Put <span> Users </span> First</h1>
      <p class="ux-description">We're a creative UX/UI design studio passionate about building human-centered digital products that inspire, engage, and perform.</p>
      <div class="services-container1" id="slider" style="margin-top: 100px">
        <div class="service-card1"><img alt="Interface" src="img/f1.jpeg" /><h3>Interface</h3></div>
        <div class="service-card1"><img alt="UX Audit" src="img/f2.jpeg" /><h3>UX Audit</h3></div>
        <div class="service-card1"><img alt="User Flow" src="img/f3.jpeg" /><h3>User Flow</h3></div>
      </div>
    </section>

    <div class="section-title" style="margin-top: 175px">
      <h3 class="ux-subtitle">Our Services <span class="ux-line"> </span></h3>
      <h2>Design Solutions That Put <span> Users </span> First</h2>
      <p class="ux-description">From sleek interfaces to seamless user flows, our portfolio reflects our  commitment to crafting digital experiences that work beautifully.</p>
    </div>
    <style>
      .service-pill-box { background:rgba(255,255,255,0.03); border:1px solid rgba(255,255,255,0.1); border-radius:8px; padding:16px 20px; text-align:center; color:#e0e0e0; display:flex; align-items:center; justify-content:center; height:100%; min-height:80px; transition:all 0.3s ease; font-size:15px; font-weight:500; cursor:default; }
      .service-pill-box:hover { border-color:#a78bfa; background:rgba(167,139,250,0.05); color:#fff; transform:translateY(-2px); }
      .services-pill-container { max-width:1000px; margin:0 auto; padding:0 15px; }
      @media (max-width:768px) {
        .services-pill-container .row { align-items:stretch; }
        .services-pill-container .col-6 { display:flex; }
        .service-pill-box {
          width: 100%;
          min-height: 72px;
          height: 100%;
          padding: 16px 10px;
          font-size: 12px;
          font-weight: 600;
          line-height: 1.4;
          border-radius: 14px;
          background: linear-gradient(145deg, #16113a 0%, #0d0d1f 100%);
          border: 1px solid rgba(124,95,230,0.2);
          box-shadow: 0 2px 12px rgba(97,71,189,0.1);
          color: #e8e0ff;
          transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }
        .service-pill-box:hover {
          border-color: #a78bfa;
          box-shadow: 0 0 18px rgba(167,139,250,0.25);
          transform: none;
          background: linear-gradient(145deg, #16113a 0%, #0d0d1f 100%);
          color: #fff;
        }
        .services-pill-container .col-6 .text-center {
          width: 100%; min-height: 72px; height: 100%;
          margin-top: 0 !important; display: flex;
          align-items: center; justify-content: center;
          border-radius: 14px;
          background: linear-gradient(145deg, #16113a 0%, #0d0d1f 100%);
          border: 1px solid rgba(124,95,230,0.2);
        }
      }
    </style>
    <div class="services-pill-container mb-5">
      <div class="row g-3">
        <div class="col-6 col-md-3"><div class="service-pill-box">UX Design &amp; Strategy</div></div>
        <div class="col-6 col-md-3"><div class="service-pill-box">UI Design &amp; Prototyping</div></div>
        <div class="col-6 col-md-3"><div class="service-pill-box">UX Research &amp; Testing</div></div>
        <div class="col-6 col-md-3"><div class="service-pill-box">Software Development</div></div>
        <div class="col-6 col-md-3"><div class="service-pill-box">Mobile, SaaS &amp; eCommerce UX</div></div>
        <div class="col-6 col-md-3"><div class="service-pill-box">Emerging Tech UX</div></div>
        <div class="col-6 col-md-3"><div class="service-pill-box">UX Content </div></div>
        <div class="col-6 col-md-3 d-none d-md-block"><div class="text-center"><a class="view-more" href="/service"> View More &rarr; </a></div></div>
        <div class="col-6 d-md-none"><div class="service-pill-box">Brand &amp; Visual Design</div></div>
      </div>
    </div>

    <div class="section-title" style="margin-top: 120px">
      <h3 class="ux-subtitle">Our Project <span class="ux-line"> </span></h3>
      <center>
        <h2>A Glimpse Into Our <span> Design Thinking </span></h2>
        <p>From sleek interfaces to seamless user flows, our portfolio reflects our commitment to crafting digital experiences that work beautifully.</p>
      </center>
    </div>

    <?php
      $uxpProjResolveTag = static function (array $project): string {
        $tags = [];
        if (!empty($project['tags'])) {
          $tags = is_string($project['tags']) ? (json_decode($project['tags'], true) ?: []) : $project['tags'];
        }
        if (!empty($tags)) {
          return (string) $tags[0];
        }
        $group = $project['filter_group'] ?? 'all';
        return $group === 'case_studies' ? 'Case Study' : ($group === 'articles' ? 'Article' : 'Project');
      };
      $uxpProjPlainDesc = static function (array $project): string {
        $raw = strip_tags((string) ($project['description'] ?? ''));
        if (function_exists('mb_strlen') && mb_strlen($raw) > 170) {
          return rtrim(mb_substr($raw, 0, 167)) . '...';
        }
        if (strlen($raw) > 170) {
          return rtrim(substr($raw, 0, 167)) . '...';
        }
        return $raw;
      };
      $uxpProjSliderItems = [];
      if (!empty($featuredProjects)) {
        foreach ($featuredProjects as $project) {
          $rawLink = trim((string) ($project['external_link'] ?? ''));
          $uxpProjSliderItems[] = [
            'title' => (string) ($project['title'] ?? 'Project'),
            'description' => $uxpProjPlainDesc($project),
            'image' => home_image_url($project['thumbnail_url'] ?? ''),
            'category' => $uxpProjResolveTag($project),
            'href' => $rawLink !== '' ? $rawLink : '/work',
            'external' => $rawLink !== '' && (bool) preg_match('#^https?://#i', $rawLink),
          ];
        }
      } else {
        $uxpProjSliderItems[] = [
          'title' => 'Coming Soon',
          'description' => 'Exciting projects are on the way. Check back soon!',
          'image' => 'img/ux.webp',
          'category' => 'Project',
          'href' => '/work',
          'external' => false,
        ];
      }
    ?>
    <section
      class="uxp-proj-slider"
      id="uxp-proj-slider"
      aria-label="Featured projects"
      data-uxp-proj-count="<?= count($uxpProjSliderItems) ?>"
    >
      <div class="uxp-proj-slider__viewport" id="uxp-proj-slider-viewport">
        <div class="uxp-proj-slider__track">
          <?php foreach ($uxpProjSliderItems as $uxpIndex => $uxpItem) :
            $uxpTitleEsc = htmlspecialchars($uxpItem['title'], ENT_QUOTES, 'UTF-8');
            $uxpDescEsc = htmlspecialchars($uxpItem['description'], ENT_QUOTES, 'UTF-8');
            $uxpCatEsc = htmlspecialchars($uxpItem['category'], ENT_QUOTES, 'UTF-8');
            $uxpHrefEsc = htmlspecialchars($uxpItem['href'], ENT_QUOTES, 'UTF-8');
            $uxpImgSrc = htmlspecialchars($uxpItem['image'], ENT_QUOTES, 'UTF-8');
            ?>
          <article class="uxp-proj-card">
            <div class="uxp-proj-card__media">
              <img
                src="<?= $uxpImgSrc ?>"
                alt="<?= $uxpTitleEsc ?>"
                class="uxp-proj-card__img"
                loading="<?= $uxpIndex < 2 ? 'eager' : 'lazy' ?>"
                decoding="async"
              />
              <div class="uxp-proj-card__media-gradient" aria-hidden="true"></div>
              <span class="uxp-proj-card__badge"><?= $uxpCatEsc ?></span>
            </div>
            <div class="uxp-proj-card__inner">
              <div class="uxp-proj-card__main">
                <h3 class="uxp-proj-card__title"><?= $uxpTitleEsc ?></h3>
                <p class="uxp-proj-card__desc"><?= $uxpDescEsc ?></p>
              </div>
              <div class="uxp-proj-card__cta">
                <a
                  class="uxp-proj-card__btn"
                  href="<?= $uxpHrefEsc ?>"
                  <?php if (!empty($uxpItem['external'])): ?>target="_blank" rel="noopener noreferrer" <?php endif; ?>
                >View Project</a>
               
              </div>
            </div>
          </article>
          <?php endforeach; ?>
        </div>
      </div>
      <button
        type="button"
        class="uxp-proj-slider__arrow uxp-proj-slider__arrow--prev"
        aria-controls="uxp-proj-slider-viewport"
        aria-label="Show previous projects"
      >
        <span class="uxp-proj-slider__chev" aria-hidden="true">&#8249;</span>
      </button>
      <button
        type="button"
        class="uxp-proj-slider__arrow uxp-proj-slider__arrow--next"
        aria-controls="uxp-proj-slider-viewport"
        aria-label="Show next projects"
      >
        <span class="uxp-proj-slider__chev" aria-hidden="true">&#8250;</span>
      </button>
    </section>

    <style>
      /* === UX Pacific — project cards slider (scoped; brand #6147bd) === */
      .uxp-proj-slider {
        --uxp-proj-brand: #6147bd;
        --uxp-proj-brand-rgb: 97, 71, 189;
        position: relative;
        max-width: 73rem;
        margin: 0 auto 2.75rem;
        padding: clamp(1.25rem, 3vw, 2rem) clamp(10px, 2vw, 18px);
        isolation: isolate;
      }
      .uxp-proj-slider__viewport {
        position: relative;
        z-index: 0;
        overflow-x: auto;
        overflow-y: hidden;
        scroll-behavior: smooth;
        -webkit-overflow-scrolling: touch;
        scroll-snap-type: x proximity;
        overscroll-behavior-x: contain;
        scrollbar-width: none;
        -ms-overflow-style: none;
        padding: 1.5rem 0 2rem;
        margin: 0 clamp(44px, 5vw, 56px);
        cursor: grab;
        scroll-padding-inline: max(0.75rem, calc(50% - min(160px, calc((100vw - 5.5rem) / 2))));
      }
      .uxp-proj-slider__viewport:active {
        cursor: grabbing;
      }
      .uxp-proj-slider__viewport::-webkit-scrollbar {
        display: none;
        width: 0;
        height: 0;
      }
      .uxp-proj-slider__track {
        display: flex;
        flex-direction: row;
        gap: 1.5rem;
        width: max-content;
        min-height: 1px;
        padding-inline: 0.35rem;
      }
      .uxp-proj-card {
        flex: 0 0 min(320px, calc(100vw - 5.5rem));
        width: min(320px, calc(100vw - 5.5rem));
        min-height: 0;
        scroll-snap-align: center;
        border-radius: 1.5rem;
        border: 1px solid rgba(168, 168, 196, 0.22);
        background: rgba(12, 12, 28, 0.45);
        backdrop-filter: blur(14px);
        -webkit-backdrop-filter: blur(14px);
        box-shadow: 0 22px 56px rgba(32, 24, 72, 0.45);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: border-color 0.45s ease, box-shadow 0.45s ease, transform 0.35s ease;
      }
      .uxp-proj-card:hover,
      .uxp-proj-card:focus-within {
        border-color: rgba(var(--uxp-proj-brand-rgb), 0.55);
        box-shadow: 0 28px 72px rgba(var(--uxp-proj-brand-rgb), 0.22), 0 0 0 1px rgba(var(--uxp-proj-brand-rgb), 0.12);
        transform: translateY(-8px);
      }
      .uxp-proj-card__media {
        position: relative;
        flex-shrink: 0;
        height: 12rem;
        overflow: hidden;
        background: #17172f;
      }
      .uxp-proj-card__img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transform: scale(1);
        transition: transform 0.65s cubic-bezier(0.22, 1, 0.36, 1);
      }
      .uxp-proj-card:hover .uxp-proj-card__img,
      .uxp-proj-card:focus-within .uxp-proj-card__img {
        transform: scale(1.1);
      }
      .uxp-proj-card__media-gradient {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(8, 8, 20, 0.92) 0%, rgba(8, 8, 20, 0.22) 50%, transparent 100%);
        pointer-events: none;
        opacity: 0.65;
        transition: opacity 0.35s ease;
        z-index: 1;
      }
      .uxp-proj-card:hover .uxp-proj-card__media-gradient,
      .uxp-proj-card:focus-within .uxp-proj-card__media-gradient {
        opacity: 0.42;
      }
      .uxp-proj-card__badge {
        position: absolute;
        top: 1rem;
        left: 1rem;
        z-index: 4;
        padding: 0.2rem 0.75rem;
        font-size: 0.7rem;
        font-weight: 600;
        letter-spacing: 0.02em;
        color: #fff;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.12);
        border: 1px solid rgba(255, 255, 255, 0.14);
        backdrop-filter: blur(10px);
      }
      .uxp-proj-card__inner {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 1.35rem 1.4rem 1.25rem;
        min-height: 12.5rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.12);
      }
      .uxp-proj-card__main {
        display: flex;
        flex-direction: column;
        gap: 0.65rem;
        flex-shrink: 0;
        min-height: 0;
      }
      .uxp-proj-card__cta {
        flex-shrink: 0;
        margin-top: auto;
        padding-top: 1rem;
        display: flex;
        flex-direction: column;
        align-items: stretch;
        gap: 0.65rem;
      }
      .uxp-proj-card__title {
        margin: 0;
        font-size: 1.2rem;
        font-weight: 700;
        line-height: 1.22;
        color: #f4f4ff;
        letter-spacing: -0.02em;
        transition: color 0.3s ease;
      }
      .uxp-proj-card:hover .uxp-proj-card__title,
      .uxp-proj-card:focus-within .uxp-proj-card__title {
        color: #d4c7ff;
      }
      .uxp-proj-card__desc {
        margin: 0;
        font-size: 0.8125rem;
        line-height: 1.58;
        color: rgba(200, 200, 220, 0.88);
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
      }
      .uxp-proj-card__details {
        display: block;
        width: 100%;
        text-align: center;
        font-size: 0.8125rem;
        font-weight: 600;
        letter-spacing: 0.04em;
        text-decoration: none;
        color: rgba(200, 190, 255, 0.92);
        padding: 0.35rem 0;
        border: none;
        background: transparent;
        transition: color 0.2s ease, letter-spacing 0.2s ease;
      }
      .uxp-proj-card__details:hover {
        color: #e8e0ff;
      }
      .uxp-proj-card__btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        min-height: 2.4rem;
        padding: 0 1rem;
        border-radius: 999px;
        font-size: 0.8125rem;
        font-weight: 600;
        text-decoration: none;
        color: #fff;
        background: linear-gradient(90deg, #4f3dac, var(--uxp-proj-brand));
        border: 1px solid rgba(183, 158, 255, 0.38);
        transition: filter 0.2s ease, transform 0.15s ease;
      }
      .uxp-proj-card__btn:hover {
        filter: brightness(1.08);
        color: #fff;
      }
      .uxp-proj-card__btn:active {
        transform: scale(0.98);
      }
      .uxp-proj-slider__arrow {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        z-index: 30;
        width: 3rem;
        height: 3rem;
        border-radius: 50%;
        border: 1px solid rgba(255, 255, 255, 0.16);
        background: rgba(14, 14, 28, 0.72);
        color: #fff;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 8px 28px rgba(0, 0, 0, 0.35);
        transition: background 0.22s ease, border-color 0.22s ease, opacity 0.28s ease, transform 0.15s ease;
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        pointer-events: auto;
        touch-action: manipulation;
        -webkit-tap-highlight-color: transparent;
      }
      .uxp-proj-slider__arrow:hover:not([aria-disabled='true']) {
        background: rgba(var(--uxp-proj-brand-rgb), 0.55);
        border-color: rgba(167, 139, 250, 0.8);
      }
      .uxp-proj-slider__arrow:active:not([aria-disabled='true']) {
        transform: translateY(-50%) scale(0.94);
      }
      .uxp-proj-slider__arrow[aria-disabled='true'] {
        opacity: 0.32;
        cursor: default;
      }
      .uxp-proj-slider__arrow--prev {
        left: 3px;
      }
      .uxp-proj-slider__arrow--next {
        right: clamp(4px, 1.2vw, 10px);
      }
      .uxp-proj-slider__chev {
        font-size: 1.5rem;
        line-height: 1;
        font-weight: 300;
      }
      @media (min-width: 768px) and (hover: hover) {
        .uxp-proj-slider .uxp-proj-slider__arrow:not([aria-disabled='true']) {
          opacity: 0;
        }
        .uxp-proj-slider:hover .uxp-proj-slider__arrow:not([aria-disabled='true']) {
          opacity: 1;
        }
        .uxp-proj-slider .uxp-proj-slider__arrow[aria-disabled='true'] {
          opacity: 0.2;
        }
      }
      @media (min-width: 768px) {
        .uxp-proj-card {
          flex: 0 0 320px;
          width: 320px;
          scroll-snap-align: start;
        }
        .uxp-proj-slider__viewport {
          margin: 0 clamp(48px, 4.5vw, 58px);
          scroll-padding-inline: 0.75rem;
        }
      }
      @media (max-width: 767.98px) {
        .uxp-proj-slider__viewport {
          margin: 0 2.75rem;
        }
        .uxp-proj-slider .uxp-proj-slider__arrow {
          opacity: 1;
        }
      }
      @media (prefers-reduced-motion: reduce) {
        .uxp-proj-slider__viewport {
          scroll-behavior: auto;
        }
        .uxp-proj-card,
        .uxp-proj-card__img,
        .uxp-proj-card__media-gradient {
          transition: none !important;
        }
        .uxp-proj-card:hover,
        .uxp-proj-card:focus-within {
          transform: none;
        }
        .uxp-proj-card:hover .uxp-proj-card__img,
        .uxp-proj-card:focus-within .uxp-proj-card__img {
          transform: none;
        }
      }
    </style>

    <script>
      (function () {
        <?php
        $uxpJsProjectPayload = !empty($featuredProjects)
          ? array_map(static function ($p) {
            $tags = [];
            if (!empty($p['tags'])) {
              $tags = is_string($p['tags']) ? (json_decode($p['tags'], true) ?: []) : $p['tags'];
            }
            if (empty($tags)) {
              $filterGroup = $p['filter_group'] ?? 'all';
              $tags = [$filterGroup === 'case_studies' ? 'Case Study' : ($filterGroup === 'articles' ? 'Article' : 'Project'), 'Web'];
            }
            return [
              'title' => $p['title'] ?? 'Project',
              'desc' => $p['description'] ?? '',
              'img' => home_image_url($p['thumbnail_url'] ?? ''),
              'tags' => $tags,
              'link' => $p['external_link'] ?? '',
            ];
          }, $featuredProjects)
          : [['title' => 'Coming Soon', 'desc' => 'Exciting projects are on the way.', 'img' => 'img/ux.webp', 'tags' => ['Project'], 'link' => '']];
        ?>
        window.projectData = <?= json_encode($uxpJsProjectPayload, JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS) ?>;
        if (Array.isArray(window.projectData)) {
          window.projectData.forEach(function (p) {
            if (p && p.img) { var im = new Image(); im.src = p.img; }
          });
        }
      })();

      (function () {
        'use strict';
        function initUxpProjSlider() {
          var root = document.getElementById('uxp-proj-slider');
          if (!root) return;
          var viewport = root.querySelector('.uxp-proj-slider__viewport');
          var track = root.querySelector('.uxp-proj-slider__track');
          var btnPrev = root.querySelector('.uxp-proj-slider__arrow--prev');
          var btnNext = root.querySelector('.uxp-proj-slider__arrow--next');
          if (!viewport || !track || !btnPrev || !btnNext) return;

          function getCards() {
            return track.querySelectorAll('.uxp-proj-card');
          }

          function maxScroll() {
            return Math.max(0, viewport.scrollWidth - viewport.clientWidth);
          }

          function isMobileSnapCenter() {
            return window.matchMedia('(max-width: 767.98px)').matches;
          }

          /** ScrollLeft that aligns card `index` (same math as scrollToCardIndex). */
          function idealScrollLeftForIndex(index) {
            var cards = getCards();
            var card = cards[index];
            if (!card) return 0;
            var max = maxScroll();
            var raw;
            if (isMobileSnapCenter()) {
              raw =
                card.offsetLeft -
                (viewport.clientWidth - card.offsetWidth) / 2;
            } else {
              raw = card.offsetLeft;
            }
            return Math.max(0, Math.min(max, Math.round(raw)));
          }

          /** Active slide = index whose ideal scroll is closest to current scrollLeft. */
          function getActiveIndex() {
            var cards = getCards();
            if (!cards.length) return 0;
            var cur = viewport.scrollLeft;
            var best = 0;
            var bestDiff = Infinity;
            for (var i = 0; i < cards.length; i++) {
              var ideal = idealScrollLeftForIndex(i);
              var d = Math.abs(cur - ideal);
              if (d < bestDiff) {
                bestDiff = d;
                best = i;
              }
            }
            return best;
          }

          function scrollToCardIndex(index) {
            viewport.scrollTo({
              left: idealScrollLeftForIndex(index),
              behavior: 'smooth',
            });
          }

          function updateArrows() {
            var cards = getCards();
            if (!cards.length) {
              btnPrev.setAttribute('aria-disabled', 'true');
              btnNext.setAttribute('aria-disabled', 'true');
              return;
            }
            var max = maxScroll();
            if (max <= 0) {
              btnPrev.setAttribute('aria-disabled', 'true');
              btnNext.setAttribute('aria-disabled', 'true');
              return;
            }
            var i = getActiveIndex();
            var last = cards.length - 1;
            btnPrev.setAttribute('aria-disabled', i <= 0 ? 'true' : 'false');
            btnNext.setAttribute('aria-disabled', i >= last ? 'true' : 'false');
          }

          btnPrev.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            var cards = getCards();
            if (!cards.length) return;
            var i = getActiveIndex();
            if (i <= 0) return;
            scrollToCardIndex(i - 1);
          });
          btnNext.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            var cards = getCards();
            if (!cards.length) return;
            var i = getActiveIndex();
            if (i >= cards.length - 1) return;
            scrollToCardIndex(i + 1);
          });

          viewport.addEventListener('scroll', updateArrows, { passive: true });
          viewport.addEventListener('scrollend', updateArrows);
          window.addEventListener('resize', function () {
            window.requestAnimationFrame(updateArrows);
          });
          updateArrows();
        }

        if (document.readyState === 'loading') {
          document.addEventListener('DOMContentLoaded', initUxpProjSlider);
        } else {
          initUxpProjSlider();
        }
      })();
    </script>

    <?php
    $ecoHomeDefaults = [
      ['partner_name' => 'UXP Shop', 'details' => 'Access premium UI kits, design systems, and templates crafted by industry experts.', 'website_url' => 'https://shop.uxpacific.com/'],
      ['partner_name' => 'UXP Academy', 'details' => 'Advance your skills through curated booklets and hands-on learning experiences through our workshops.', 'website_url' => 'https://academy.uxpacific.com/'],
      ['partner_name' => 'UXP Community', 'details' => 'Be part of a thriving network where ideas turn into reality. Join our community to connect and grow.', 'website_url' => 'https://community.uxpacific.com/'],
    ];
    $ecoHomeRows = !empty($ecosystemHomeItems) ? $ecosystemHomeItems : $ecoHomeDefaults;
    ?>
    <section class="ecosystem" id="ecosystem" style="margin-top: 100px">
      <h3 class="ux-subtitle">Our Ecosystem <span class="ux-line"> </span></h3>
      <h2>Expand Your Experience With <span> UX Pacific </span></h2>
      <p class="description">Unlock exclusive networking and learning opportunities across our Ambassador Club and Academy. Take the next step in your UX career with a supportive community and hands-on resources.</p>
      <div class="cards ecosystem-cards">
        <?php foreach ($ecoHomeRows as $eco) :
          $ecoTitle = htmlspecialchars($eco['partner_name'] ?? 'Partner', ENT_QUOTES, 'UTF-8');
          $ecoText = htmlspecialchars($eco['details'] ?? '', ENT_QUOTES, 'UTF-8');
          $rawEcoUrl = trim((string) ($eco['website_url'] ?? ''));
          $ecoHasUrl = $rawEcoUrl !== '' && $rawEcoUrl !== '#';
          $ecoHref = $ecoHasUrl ? htmlspecialchars($rawEcoUrl, ENT_QUOTES, 'UTF-8') : '';
          ?>
        <div class="eco-home-wrap">
          <?php if ($ecoHasUrl) : ?>
          <a href="<?= $ecoHref ?>" class="eco-home-hit" target="_blank" rel="noopener noreferrer" style="text-decoration:none">
            <div class="card"><h1 class="text-white" style="font-size:1.7rem"><?= $ecoTitle ?></h1><span class="ux-line"> </span><p><?= $ecoText ?></p><span class="arrow"> </span></div>
          </a>
          <?php else : ?>
          <div class="eco-home-hit eco-home-hit--static">
            <div class="card"><h1 class="text-white" style="font-size:1.7rem"><?= $ecoTitle ?></h1><span class="ux-line"> </span><p><?= $ecoText ?></p><span class="arrow"> </span></div>
          </div>
          <?php endif; ?>
        </div>
        <?php endforeach; ?>
      </div>
    </section>

    <section class="reviews-section">
      <h3 class="ux-subtitle" style="margin-top: 50px">Our Valued Reviews <span class="ux-line"> </span></h3>
      <h2>Feedback That Fuels <span> Growth </span></h2>
      <p>Explore experiences from our clients and workshop participants. Each review offers valuable insight into how we support growth, learning, and meaningful results across every project and event.</p>
      <div class="reviews-grid-container">
        <?php
        // BASE_URL from includes/config.php (loaded via includes/head.php)
        $uxpTestimonialsApi = rtrim((string) BASE_URL, '/') . '/api/testimonials.php';
        ?>
        <div
          class="reviews-grid"
          data-testimonials-api="<?= htmlspecialchars($uxpTestimonialsApi, ENT_QUOTES, 'UTF-8') ?>"
        >
          <div class="review-card-set" id="original-cards" aria-busy="true"></div>
        </div>
      </div>
    </section>

    <section class="cta-section">
      <div class="dots-bg desktop-only"><canvas id="dots-canvas"> </canvas></div>
      <div class="cta-container">
        <div class="cta-text">
          <h1>Start your <span> UI/UX </span> journey with <br /><span class="highlight"> UX Pacific Team </span></h1>
          <p class="mt-4 mb-4">Build your site effortlessly and showcase your work with confidence.<br />Ready to stand out? Get started today!</p>
          <a class="btn-primary" href="/contact">Get in touch <span class="arrow"> </span></a>
        </div>
        <div class="cta-blur-overlay"></div>
        <div class="cta-image"><img alt="UX Design" src="img/Rectangle 5192.webp" /></div>
      </div>
    </section>

    <section class="faq-section">
      <div class="faq-container">
        <div class="faq-main-container">
          <div class="faq-left">
            <div class="accordion accordion-flush col-lg-12 mx-auto" id="faqAccordion">
              <div class="accordion-item" style="border-radius: 8px">
                <div class="accordion-header"><h3>What services does UX Pacific offer?</h3><div class="accordion-icon"><span> </span></div></div>
                <div class="accordion-content"><p>We specialize in UI/UX design, UX audits, design systems, landing pages, and strategy consulting. Whether you're launching an MVP or scaling an enterprise platform, we craft human-first digital experiences that perform.</p></div>
              </div>
              <div class="accordion-item" style="border-radius: 8px">
                <div class="accordion-header"><h3>Can I pay you in pizza and good vibes?</h3><div class="accordion-icon"><span> </span></div></div>
                <div class="accordion-content"><p>Tempting. But we prefer clean invoices and coffee. Good vibes are always welcome though.</p></div>
              </div>
              <div class="accordion-item" style="border-radius: 8px">
                <div class="accordion-header"><h3>What tools do you use?</h3><div class="accordion-icon"><span> </span></div></div>
                <div class="accordion-content"><p>At UXPacific, we use Figma, Sketch, and Framer for designing and prototyping, Notion for organisation, Slack for communication, and Google Workspace for files and&nbsp;presentations.</p></div>
              </div>
            </div>
          </div>
          <div class="faq-right">
            <h2>Frequently Asked <span> Questions? </span></h2>
            <p>Have questions? We&rsquo;ve gathered answers to questions people ask us all the time (yes, even the weird ones!). Still stumped? Drop us a line. We love a good question!</p>
            <div><a class="faq-link" href="/faq"> View Details &rarr; </a></div>
          </div>
        </div>
      </div>
      <div class="images-row">
        <img alt="workshop" class="img1" src="img/5.webp" style="transform:rotate(-9.89deg);z-index:1" />
        <img alt="workshop" src="img/2.webp" style="transform:rotate(1.82deg)" />
        <img alt="workshop" src="img/3.webp" style="transform:rotate(14.67deg);left:-30px;z-index:1" />
        <img alt="workshop" src="img/4.webp" style="transform:rotate(-5.34deg);left:-50px" />
        <img alt="workshop" src="img/1.webp" style="transform:rotate(15.98deg);left:-100px" />
      </div>
    </section>

    <?php include 'includes/footer.php'; ?>
    <?php include 'includes/scripts.php'; ?>

    <!-- Audit Success Popup -->
    <div id="auditSuccessPopup" style="display:none;position:fixed;inset:0;z-index:9999;align-items:center;justify-content:center;background:rgba(0,0,0,0.7);backdrop-filter:blur(6px);">
      <div style="background:#111127;border:1px solid rgba(97,71,189,0.4);border-radius:20px;padding:48px 40px;max-width:420px;width:90%;text-align:center;box-shadow:0 24px 80px rgba(0,0,0,0.8);position:relative;">
        <div style="width:68px;height:68px;background:linear-gradient(135deg,#6147bd,#a78bfa);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 24px;">
          <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
        </div>
        <h3 style="color:#fff;font-size:22px;font-weight:700;margin:0 0 12px;">Submitted Successfully!</h3>
        <p style="color:#b2bad6;font-size:15px;line-height:1.6;margin:0 0 28px;">Thank you! Your UX Audit request has been received. We'll get back to you shortly.</p>
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
                <div class="contact-field" style="display:flex;flex-direction:column;gap:6px;"><label for="auditPhone" style="font-size:15px;color:#b2bad6;">Phone Number</label><input id="auditPhone" name="phone" type="tel" placeholder="+91 xxxxx- xxxxx" style="height:56px;width:100%;background:#151515;border:1px solid #2e2e3e;border-radius:6px;color:#eee;padding:16px 20px;font-size:1rem;outline:none;" onfocus="this.style.borderColor='#6147bd'" onblur="this.style.borderColor='#2e2e3e'"></div>
                <div class="contact-field" style="display:flex;flex-direction:column;gap:6px;"><label for="auditUrl" style="font-size:15px;color:#b2bad6;">Website URL</label><input id="auditUrl" name="url" type="text" placeholder="https://yourwebsite.com" style="height:56px;width:100%;background:#151515;border:1px solid #2e2e3e;border-radius:6px;color:#eee;padding:16px 20px;font-size:1rem;outline:none;" onfocus="this.style.borderColor='#6147bd'" onblur="this.style.borderColor='#2e2e3e'"></div>
              </div>
              <div id="auditError" style="display:none;margin-top:12px;color:#f87171;font-size:14px;text-align:center;"></div>
              <div class="contact-submit text-center mt-4 pt-2">
                <button id="auditSubmitBtn" type="submit" style="background-color:#6147bd;border:none;padding:12px 40px;border-radius:50px;color:#ffffff;font-weight:500;font-size:16px;width:100%;height:50px;cursor:pointer;box-shadow:0 6px 20px rgba(97,71,189,0.4);transition:transform 0.2s;" onmouseover="this.style.transform='translateY(-2px)';" onmouseout="this.style.transform='translateY(0)';">Submit Request</button>
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
      
      // Get field values
      var nameVal = document.getElementById('auditName').value.trim();
      var emailVal = document.getElementById('auditEmail').value.trim();
      var phoneVal = document.getElementById('auditPhone').value.trim();
      var urlVal = document.getElementById('auditUrl').value.trim();
      
      // Clear previous errors
      errBox.style.display = 'none';
      document.querySelectorAll('#auditForm .field-error').forEach(function(el) { el.remove(); });
      document.querySelectorAll('#auditForm input').forEach(function(el) { el.style.borderColor = '#2e2e3e'; });
      
      // Validation
      var errors = [];
      var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      var urlRegex = /^(https?:\/\/)?([\w\-]+\.)+[\w\-]+(\/[\w\-._~:/?#[\]@!$&'()*+,;=]*)?$/i;
      
      if (nameVal === '') {
        errors.push({ field: 'auditName', msg: 'Name is required' });
      } else if (nameVal.length < 2) {
        errors.push({ field: 'auditName', msg: 'Name must be at least 2 characters' });
      }
      
      if (emailVal === '') {
        errors.push({ field: 'auditEmail', msg: 'Email is required' });
      } else if (!emailRegex.test(emailVal)) {
        errors.push({ field: 'auditEmail', msg: 'Please enter a valid email address' });
      }
      
      if (phoneVal !== '' && !/^[\d\s\-+()]{7,20}$/.test(phoneVal)) {
        errors.push({ field: 'auditPhone', msg: 'Please enter a valid phone number' });
      }
      
      if (urlVal === '') {
        errors.push({ field: 'auditUrl', msg: 'Website URL is required for UX Audit' });
      } else if (!urlRegex.test(urlVal)) {
        errors.push({ field: 'auditUrl', msg: 'Please enter a valid website URL' });
      }
      
      // Show validation errors
      if (errors.length > 0) {
        errors.forEach(function(err) {
          var input = document.getElementById(err.field);
          input.style.borderColor = '#f87171';
          var errEl = document.createElement('div');
          errEl.className = 'field-error';
          errEl.style.cssText = 'color:#f87171;font-size:12px;margin-top:4px;';
          errEl.textContent = err.msg;
          input.parentNode.appendChild(errEl);
        });
        document.getElementById(errors[0].field).focus();
        return;
      }
      
      // Submit form
      btn.disabled = true;
      btn.textContent = 'Sending…';

      var data = {
        form_type: 'ux_audit',
        name: nameVal,
        email: emailVal,
        phone: phoneVal,
        url: urlVal,
        company_website: (document.getElementById('audit_company_website') || {}).value || '',
        form_started_at: parseInt((document.getElementById('audit_form_started_at') || {}).value || '0', 10) || 0
      };

      fetch('send', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify(data)
      })
      .then(function(r){ return r.json(); })
      .then(function(res) {
        if (res.success) {
          // Close audit modal
          var auditModal = bootstrap.Modal.getInstance(document.getElementById('auditModal'));
          if (auditModal) auditModal.hide();
          // Reset form
          document.getElementById('auditForm').reset();
          // Show reusable success animation
          if (window.UXPSuccessBox && typeof window.UXPSuccessBox.showSuccess === 'function') {
            window.UXPSuccessBox.showSuccess({
              title: 'Request Submitted!',
              text: 'Your UX Audit request has been received. We will contact you shortly.',
              timer: 3000
            });
          } else {
            var popup = document.getElementById('auditSuccessPopup');
            if (popup) popup.style.display = 'flex';
          }
        } else {
          var message = res.message || 'Something went wrong. Please try again.';
          errBox.textContent = message;
          errBox.style.display = 'block';
          if (window.UXPSuccessBox && typeof window.UXPSuccessBox.showError === 'function') {
            window.UXPSuccessBox.showError(message);
          }
        }
      })
      .catch(function() {
        var message = 'Network error. Please try again.';
        errBox.textContent = message;
        errBox.style.display = 'block';
        if (window.UXPSuccessBox && typeof window.UXPSuccessBox.showError === 'function') {
          window.UXPSuccessBox.showError(message);
        }
      })
      .finally(function() {
        btn.disabled = false;
        btn.textContent = 'Submit Request';
      });
    });

    // Keep audit modal/backdrop above sticky navbar
    document.getElementById('auditModal').addEventListener('shown.bs.modal', function() {
      var backdrop = document.querySelector('.modal-backdrop.show');
      if (backdrop) backdrop.style.zIndex = '2190';
      var fs = document.getElementById('audit_form_started_at');
      if (fs) fs.value = String(Date.now());
      var hp = document.getElementById('audit_company_website');
      if (hp) hp.value = '';
    });

    // Close success popup on backdrop click
    document.getElementById('auditSuccessPopup').addEventListener('click', function(e) {
      if (e.target === this) this.style.display = 'none';
    });
  </script>
  </body>
</html>