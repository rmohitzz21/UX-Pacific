<?php
require_once __DIR__ . '/includes/cms_repository.php';

$pageTitle    = 'Work | UX Pacific';
$pageDesc     = 'Browse UX Pacific\'s portfolio of case studies, UX audits, and product design projects  from Distinct Buzz to CEDAR Himalaya and Survey Pacific.';
$canonicalUrl = 'https://www.uxpacific.com/work.php';
$ogTitle      = 'Work | UX Pacific';
$ogDesc       = 'Explore our featured projects  where strategy, creativity, and research create real results. View UX Pacific\'s client work and case studies.';
$ogUrl        = 'https://www.uxpacific.com/work.php';
$currentPage  = 'work';

$workProjects = get_published_projects('all');
$clientLogos = get_visible_client_logos();

/** data-category values — match live site filters (projects / case-studies / articles). */
function work_category(string $filterGroup): string {
  $map = [
    'selected_work' => 'projects',
    'case_studies' => 'case-studies',
    'articles' => 'articles',
    'all' => 'all',
  ];
  return $map[$filterGroup] ?? 'all';
}

function work_image_url(?string $url): string {
  $url = trim((string) $url);
  if ($url === '') {
    return uxp_normalize_stored_media_url('img/project3.webp');
  }
  if (preg_match('#^https?://#i', $url)) {
    return $url;
  }

  return uxp_normalize_stored_media_url($url);
}

/** Logo URL for client strip (no placeholder image — empty skips row). */
function work_client_logo_url(?string $url): string {
  $url = trim((string) $url);
  if ($url === '') {
    return '';
  }
  if (preg_match('#^https?://#i', $url)) {
    return $url;
  }

  return uxp_normalize_stored_media_url($url);
}

/** @return list<array{url:string,name:string,href:string}> */
function work_logo_slider_items(array $clientLogos): array {
  $items = [];
  foreach ($clientLogos as $row) {
    $u = work_client_logo_url($row['logo_url'] ?? '');
    if ($u === '') {
      continue;
    }
    $name = trim((string) ($row['name'] ?? ''));
    if ($name === '') {
      $name = 'Client';
    }
    $href = trim((string) ($row['website_url'] ?? ''));
    $items[] = ['url' => $u, 'name' => $name, 'href' => $href];
  }
  if ($items !== []) {
    return $items;
  }
  $defaults = ['img/c1.png', 'img/c2.png', 'img/c3.png', 'img/c4.png', 'img/c5.png', 'img/c6.png'];
  foreach ($defaults as $p) {
    $items[] = ['url' => $p, 'name' => 'Client logo', 'href' => ''];
  }
  return $items;
}

$workLogoSliderItems = work_logo_slider_items($clientLogos);

function work_logo_slider_markup(array $items, bool $decorativeClone): string {
  $out = '';
  foreach ($items as $item) {
    $url = htmlspecialchars($item['url'], ENT_QUOTES, 'UTF-8');
    $name = htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8');
    $href = trim($item['href']);
    if ($decorativeClone) {
      $img = '<img src="' . $url . '" alt="" role="presentation" />';
    } else {
      $img = '<img src="' . $url . '" alt="' . $name . '" loading="lazy" />';
    }
    if ($href !== '' && preg_match('#^https?://#i', $href)) {
      $h = htmlspecialchars($href, ENT_QUOTES, 'UTF-8');
      $aAttr = $decorativeClone ? ' aria-hidden="true"' : '';
      $out .= '<a class="logo-slider__link" href="' . $h . '" target="_blank" rel="noopener noreferrer"' . $aAttr . '>' . $img . '</a>';
    } else {
      $out .= $decorativeClone ? '<span aria-hidden="true">' . $img . '</span>' : $img;
    }
  }
  return $out;
}

function work_tags($tags): array {
  if (is_array($tags)) {
    return array_values(array_filter(array_map('trim', $tags), static fn($v) => $v !== ''));
  }
  if (is_string($tags) && trim($tags) !== '') {
    $decoded = json_decode($tags, true);
    if (is_array($decoded)) {
      return array_values(array_filter(array_map('trim', $decoded), static fn($v) => $v !== ''));
    }
  }
  return [];
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include 'includes/head.php'; ?>
    <style>
      .filter-bar { display:flex; align-items:center; gap:8px; background:#101028; border:1px solid rgba(255,255,255,0.06); border-radius:9999px; padding:4px; width:fit-content; margin:0 auto 48px; overflow-x:auto; -webkit-overflow-scrolling:touch; }
      .filter-btn { font-family:'Inter',sans-serif; font-size:0.875rem; font-weight:500; color:#8888b0; padding:8px 20px; border-radius:9999px; border:none; background:transparent; cursor:pointer; transition:all 250ms ease; white-space:nowrap; }
      .filter-btn:hover { color:#ffffff; }
      .filter-btn.active { background:linear-gradient(90deg,#6147bd,#a78bfa); color:#ffffff; box-shadow:0 0 30px rgba(124,95,230,0.25); }
      .work-grid { display:grid; grid-template-columns:repeat(2,1fr); gap:24px; }
      .work-card { background:#101028; border:1px solid rgba(255,255,255,0.06); border-radius:24px; overflow:hidden; transition:transform 400ms ease,box-shadow 400ms ease,border-color 400ms ease; cursor:pointer; }
      .work-card:hover { border-color:rgba(124,95,230,0.35); transform:translateY(-6px); box-shadow:0 8px 32px rgba(0,0,0,0.7),0 0 30px rgba(124,95,230,0.25); }
      .work-card__image { position:relative; overflow:hidden; aspect-ratio:16/10; background:#14143a; }
      .work-card__image img { width:100%; height:100%; object-fit:cover; transition:transform 0.6s cubic-bezier(0.22,1,0.36,1); display:block; }
      .work-card:hover .work-card__image img { transform:scale(1.05); }
      .work-card__overlay { position:absolute; inset:0; background:rgba(7,7,26,0.7); display:flex; align-items:center; justify-content:center; opacity:0; transition:opacity 250ms ease; }
      .work-card:hover .work-card__overlay { opacity:1; }
      .work-card__view-btn { display:inline-flex; align-items:center; gap:8px; font-family:'Inter',sans-serif; font-size:0.875rem; font-weight:600; color:#ffffff; background:#6147bd; padding:10px 24px; border-radius:9999px; text-decoration:none; transform:translateY(8px); transition:transform 400ms cubic-bezier(0.175,0.885,0.32,1.275),box-shadow 250ms ease; }
      .work-card:hover .work-card__view-btn { transform:translateY(0); box-shadow:0 4px 24px rgba(124,95,230,0.45); }
      .work-card__body { padding:clamp(1.25rem,2.5vw,2rem); }
      .work-card__tags { display:flex; flex-wrap:wrap; gap:8px; margin-bottom:12px; }
      .work-tag { font-size:0.75rem; font-weight:500; color:#a78bfa; background:rgba(124,95,230,0.12); border:1px solid rgba(124,95,230,0.18); padding:4px 10px; border-radius:9999px; }
      .work-card__title { font-family:'Inter',sans-serif; font-size:1.5rem; font-weight:700; color:#ffffff; margin-bottom:12px; line-height:1.25; }
      .work-card__desc { font-size:0.875rem; color:#cccccc; line-height:1.7; margin:0; }
      /* Uniform grid like production — no featured row spanning */
      @keyframes fadeInUp { from{opacity:0;transform:translateY(28px)} to{opacity:1;transform:translateY(0)} }
      .work-card { opacity:1; }
      .hidden-card { display:none !important; }
      .card-reveal { animation:fadeInUp 0.5s cubic-bezier(0.22,1,0.36,1) both; }
      .view-more-wrap { text-align:center; margin-top:48px; }
      .btn-arrow-icon { width:18px; height:18px; transition:transform 250ms ease; }
      @media (max-width:768px) {
        .work-grid { grid-template-columns:1fr; }
        .filter-bar { max-width:360px !important; font-size:0.8rem !important; padding:4px; }
      }
      .logo-track .logo-slider__link { display:inline-flex; align-items:center; text-decoration:none; vertical-align:middle; }
      /* Client logos from admin: crisp + stable marquee regardless of logo count */
      .project-page .logo-track {
        width: max-content;
        align-items: center;
        gap: 36px;
        animation: workLogoScroll 24s linear infinite;
      }
      .project-page .logo-track img {
        height: 42px;
        width: auto;
        max-width: 150px;
        object-fit: contain;
        filter: none;
        opacity: 1;
        backface-visibility: hidden;
        transform: translateZ(0);
        image-rendering: -webkit-optimize-contrast;
      }
      .project-page .logo-track img:hover {
        filter: none;
        opacity: 1;
      }
      @keyframes workLogoScroll {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
      }
      @media (max-width:650px) {
        .project-page .logo-track img {
          height: 28px;
          max-width: 110px;
        }
      }
    </style>
  </head>
  <body class="project-page">
    <?php include 'includes/navbar.php'; ?>

    <section class="about-header">
      <video class="header-bg-video" autoplay muted loop playsinline>
        <source src="img/test.mp4" type="video/mp4">
      </video>
      <div class="header-bg-overlay"></div>
      <h1>Project</h1>
      <div class="innovation-badge-exact">
        <span class="badge-desktop">From live projects to powerful case studies and thought-provoking blogs.<br>See how strategy, creativity, and research turn into real results.</span>
        <span class="badge-mobile">Real <span>Work</span>, Real <span>Results</span></span>
      </div>
    </section>

    <h2 class="ux-title" style="margin-top:50px;">A Glimpse Into Our <span class="highlight"> Design Thinking </span></h2>

    <section class="projects-section">
      <div class="projects-container">
        <div class="filter-bar" role="tablist" aria-label="Filter work by category">
          <button class="filter-btn active" data-filter="all"          role="tab" aria-selected="true">All</button>
          <button class="filter-btn"        data-filter="projects" role="tab" aria-selected="false">Selected Work</button>
          <button class="filter-btn"        data-filter="case-studies" role="tab" aria-selected="false">Case Studies</button>
          <button class="filter-btn"        data-filter="articles"     role="tab" aria-selected="false">Articles</button>
        </div>

        <div class="work-grid" id="work-grid">
          <?php if (!empty($workProjects)): ?>
            <?php foreach ($workProjects as $project): ?>
              <?php
                $title = trim((string) ($project['title'] ?? 'Untitled Project'));
                $desc = trim((string) ($project['description'] ?? ''));
                $thumb = work_image_url($project['thumbnail_url'] ?? '');
                $link = trim((string) ($project['external_link'] ?? ''));
                $linkLabel = trim((string) ($project['link_label'] ?? 'View Details'));
                $category = work_category((string) ($project['filter_group'] ?? 'all'));
                $tags = work_tags($project['tags'] ?? null);
                $isFeatured = (int) ($project['is_featured'] ?? 0) === 1;
                if ($isFeatured && !in_array('Featured', $tags, true)) {
                  $tags[] = 'Featured';
                }
              ?>
              <div class="work-card" data-category="<?= htmlspecialchars($category) ?>">
                <div class="work-card__image">
                  <img src="<?= htmlspecialchars($thumb) ?>" alt="<?= htmlspecialchars($title) ?>" loading="lazy" />
                  <div class="work-card__overlay">
                    <?php if ($link !== ''): ?>
                      <a href="<?= htmlspecialchars($link) ?>" class="work-card__view-btn" target="_blank" rel="noopener noreferrer"><?= htmlspecialchars($linkLabel !== '' ? $linkLabel : 'View Details') ?></a>
                    <?php else: ?>
                      <span class="work-card__view-btn" aria-hidden="true">Coming Soon</span>
                    <?php endif; ?>
                  </div>
                </div>
                <div class="work-card__body">
                  <?php if (!empty($tags)): ?>
                    <div class="work-card__tags">
                      <?php foreach ($tags as $tag): ?>
                        <span class="work-tag"><?= htmlspecialchars((string) $tag) ?></span>
                      <?php endforeach; ?>
                    </div>
                  <?php endif; ?>
                  <h3 class="work-card__title"><?= htmlspecialchars($title) ?></h3>
                  <p class="work-card__desc"><?= htmlspecialchars($desc) ?></p>
                </div>
              </div>
            <?php endforeach; ?>
          <?php else: ?>
            <div class="work-card" data-category="all">
              <div class="work-card__body">
                <h3 class="work-card__title">Projects coming soon</h3>
                <p class="work-card__desc">No published projects are available right now. Please add and publish projects from the admin panel.</p>
              </div>
            </div>
          <?php endif; ?>
        </div>

        <div class="view-more-wrap">
          <button id="view-more-btn" class="btn-primary" style="gap:10px;">
            <span class="btn-text">View More</span>
            <svg class="btn-arrow-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" /></svg>
          </button>
        </div>
      </div>
    </section>

    <h2 class="ux-subtitle" style="margin-top:100px">Our Clients <span class="ux-line"></span></h2>
    <div class="logo-slider">
      <div class="logo-track">
        <?= work_logo_slider_markup($workLogoSliderItems, false) ?>
        <?= work_logo_slider_markup($workLogoSliderItems, true) ?>
      </div>
    </div>

    <section class="cta-section">
      <div class="dots-bg desktop-only"><canvas id="dots-canvas"></canvas></div>
      <div class="cta-container">
        <div class="cta-text cta-text--padded">
          <h2>Start your <span>UI/UX</span> journey with <br /><span class="highlight">UX Pacific Team</span></h2>
          <p class="mt-4 mb-4 cta-desc">Build your site effortlessly and showcase your work with confidence.<br />Ready to stand out? Get started today!</p>
          <a href="/contact" class="btn-primary cta-button--wide">Get in touch <span class="arrow"></span></a>
        </div>
        <div class="cta-blur-overlay"></div>
        <div class="cta-image"><img src="img/Rectangle 5192.webp" alt="UX designer working on a digital product" /></div>
      </div>
    </section>

    <?php include 'includes/footer.php'; ?>
    <?php include 'includes/scripts.php'; ?>
    <script>
      document.addEventListener('DOMContentLoaded', () => {
        const filterBtns   = document.querySelectorAll('.filter-btn');
        const workCards    = Array.from(document.querySelectorAll('.work-card[data-category]'));
        const viewMoreBtn  = document.getElementById('view-more-btn');
        const viewMoreWrap = document.querySelector('.view-more-wrap');
        let expanded = false;

        function revealCard(card, delay) {
          card.classList.remove('hidden-card', 'card-reveal');
          void card.offsetWidth;
          card.style.animationDelay = delay + 'ms';
          card.classList.add('card-reveal');
        }

        function getLimit() {
          return window.innerWidth <= 767 ? 2 : 4;
        }

        function renderCards(animateAll) {
          const activeFilter = document.querySelector('.filter-btn.active')?.dataset.filter || 'all';
          const limit = getLimit();
          const matching = [];

          workCards.forEach(card => {
            const cat = (card.dataset.category || '').trim();
            const matches = activeFilter === 'all' || cat === activeFilter;
            if (matches) {
              matching.push(card);
            } else {
              card.classList.add('hidden-card');
              card.classList.remove('card-reveal');
              card.style.animationDelay = '';
            }
          });

          matching.forEach((card, i) => {
            if (i < limit || expanded) {
              const wasHidden = card.classList.contains('hidden-card');
              if (wasHidden || animateAll) revealCard(card, i * 60);
            } else {
              card.classList.add('hidden-card');
              card.classList.remove('card-reveal');
              card.style.animationDelay = '';
            }
          });

          if (viewMoreWrap && viewMoreBtn) {
            viewMoreWrap.style.display = (!expanded && matching.length > limit) ? 'block' : 'none';
          }
        }

        filterBtns.forEach(btn => {
          btn.addEventListener('click', () => {
            filterBtns.forEach(b => { b.classList.remove('active'); b.setAttribute('aria-selected','false'); });
            btn.classList.add('active');
            btn.setAttribute('aria-selected','true');
            expanded = false;
            renderCards(true);
          });
          btn.addEventListener('keydown', e => {
            if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); btn.click(); }
          });
        });

        if (viewMoreBtn) {
          viewMoreBtn.addEventListener('click', () => {
            expanded = true;
            renderCards(false);
          });
        }

        renderCards(true);
      });
    </script>
  </body>
</html>
