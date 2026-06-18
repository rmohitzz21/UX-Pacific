<?php
require_once __DIR__ . '/includes/cms_repository.php';

$countrySlug = 'czech-republic';

$featuredProjects   = get_published_projects('all', true);
$ecosystemHomeItems = get_published_ecosystem();

function home_image_url(?string $url): string {
  $url = trim((string) $url);
  if ($url === '') return uxp_normalize_stored_media_url('img/ux.webp');
  if (preg_match('#^https?://#i', $url)) return $url;
  return uxp_normalize_stored_media_url($url);
}

$pageTitle   = 'UI UX Design Agency in Czech Republic | UX Pacific';
$pageDesc    = 'UX Pacific delivers expert UI/UX design services across Czech Republic. Browse our locations or book a free UX audit today.';
$canonicalUrl = 'https://www.uxpacific.com/ui-ux-design-agency-in-czech-republic';
$ogTitle     = 'UI UX Design Agency in Czech Republic | UX Pacific';
$ogDesc      = 'UX Pacific delivers expert UI/UX design services across Czech Republic. Browse our locations or book a free UX audit today.';
$ogUrl       = 'https://www.uxpacific.com/ui-ux-design-agency-in-czech-republic';
$currentPage = 'Home';

// Schema: WebPage + BreadcrumbList
$ldJson = json_encode([
  '@context' => 'https://schema.org',
  '@graph'   => [
    ['@type' => 'WebPage',
     'url'   => 'https://www.uxpacific.com/ui-ux-design-agency-in-czech-republic',
     'name'  => 'UI UX Design Agency in Czech Republic | UX Pacific',
     'inLanguage' => 'en',
    ],
    ['@type' => 'BreadcrumbList',
     'itemListElement' => [
       ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home',       'item' => BASE_URL . '/'],
       ['@type' => 'ListItem', 'position' => 2, 'name' => 'Czech Republic', 'item' => 'https://www.uxpacific.com/ui-ux-design-agency-in-czech-republic'],
     ],
    ],
  ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

$geoPage = uxp_geo_page($countrySlug);
if ($geoPage) {
  if (!empty($geoPage['page_title']))      { $pageTitle = (string) $geoPage['page_title']; $ogTitle = $pageTitle; }
  if (!empty($geoPage['meta_description'])) { $pageDesc  = (string) $geoPage['meta_description']; $ogDesc = $pageDesc; }
}

// Child locations in Czech Republic
$hubChildren = [
  ['name' => 'Benešov', 'url' => '/ui-ux-design-agency-in-benesov-czech-republic', 'basename' => 'ui-ux-design-agency-in-benesov-czech-republic'],
  ['name' => 'Beroun', 'url' => '/ui-ux-design-agency-in-beroun-czech-republic', 'basename' => 'ui-ux-design-agency-in-beroun-czech-republic'],
  ['name' => 'Blansko', 'url' => '/ui-ux-design-agency-in-blansko-czech-republic', 'basename' => 'ui-ux-design-agency-in-blansko-czech-republic'],
  ['name' => 'Břeclav', 'url' => '/ui-ux-design-agency-in-breclav-czech-republic', 'basename' => 'ui-ux-design-agency-in-breclav-czech-republic'],
  ['name' => 'Brno-město', 'url' => '/ui-ux-design-agency-in-brno-mesto-czech-republic', 'basename' => 'ui-ux-design-agency-in-brno-mesto-czech-republic'],
  ['name' => 'Brno-venkov', 'url' => '/ui-ux-design-agency-in-brno-venkov-czech-republic', 'basename' => 'ui-ux-design-agency-in-brno-venkov-czech-republic'],
  ['name' => 'Bruntál', 'url' => '/ui-ux-design-agency-in-bruntal-czech-republic', 'basename' => 'ui-ux-design-agency-in-bruntal-czech-republic'],
  ['name' => 'Česká Lípa', 'url' => '/ui-ux-design-agency-in-ceska-lipa-czech-republic', 'basename' => 'ui-ux-design-agency-in-ceska-lipa-czech-republic'],
  ['name' => 'České Budějovice', 'url' => '/ui-ux-design-agency-in-ceske-budejovice-czech-republic', 'basename' => 'ui-ux-design-agency-in-ceske-budejovice-czech-republic'],
  ['name' => 'Český Krumlov', 'url' => '/ui-ux-design-agency-in-cesky-krumlov-czech-republic', 'basename' => 'ui-ux-design-agency-in-cesky-krumlov-czech-republic'],
  ['name' => 'Cheb', 'url' => '/ui-ux-design-agency-in-cheb-czech-republic', 'basename' => 'ui-ux-design-agency-in-cheb-czech-republic'],
  ['name' => 'Chomutov', 'url' => '/ui-ux-design-agency-in-chomutov-czech-republic', 'basename' => 'ui-ux-design-agency-in-chomutov-czech-republic'],
  ['name' => 'Chrudim', 'url' => '/ui-ux-design-agency-in-chrudim-czech-republic', 'basename' => 'ui-ux-design-agency-in-chrudim-czech-republic'],
  ['name' => 'Děčín', 'url' => '/ui-ux-design-agency-in-decin-czech-republic', 'basename' => 'ui-ux-design-agency-in-decin-czech-republic'],
  ['name' => 'Domažlice', 'url' => '/ui-ux-design-agency-in-domazlice-czech-republic', 'basename' => 'ui-ux-design-agency-in-domazlice-czech-republic'],
  ['name' => 'Frýdek-Místek', 'url' => '/ui-ux-design-agency-in-frydek-mistek-czech-republic', 'basename' => 'ui-ux-design-agency-in-frydek-mistek-czech-republic'],
  ['name' => 'Havlíčkův Brod', 'url' => '/ui-ux-design-agency-in-havlickuv-brod-czech-republic', 'basename' => 'ui-ux-design-agency-in-havlickuv-brod-czech-republic'],
  ['name' => 'Hodonín', 'url' => '/ui-ux-design-agency-in-hodonin-czech-republic', 'basename' => 'ui-ux-design-agency-in-hodonin-czech-republic'],
  ['name' => 'Hradec Králové', 'url' => '/ui-ux-design-agency-in-hradec-kralove-czech-republic', 'basename' => 'ui-ux-design-agency-in-hradec-kralove-czech-republic'],
  ['name' => 'Jablonec nad Nisou', 'url' => '/ui-ux-design-agency-in-jablonec-nad-nisou-czech-republic', 'basename' => 'ui-ux-design-agency-in-jablonec-nad-nisou-czech-republic'],
  ['name' => 'Jeseník', 'url' => '/ui-ux-design-agency-in-jesenik-czech-republic', 'basename' => 'ui-ux-design-agency-in-jesenik-czech-republic'],
  ['name' => 'Jičín', 'url' => '/ui-ux-design-agency-in-jicin-czech-republic', 'basename' => 'ui-ux-design-agency-in-jicin-czech-republic'],
  ['name' => 'Jihlava', 'url' => '/ui-ux-design-agency-in-jihlava-czech-republic', 'basename' => 'ui-ux-design-agency-in-jihlava-czech-republic'],
  ['name' => 'Jihočeský kraj', 'url' => '/ui-ux-design-agency-in-jihocesky-kraj-czech-republic', 'basename' => 'ui-ux-design-agency-in-jihocesky-kraj-czech-republic'],
  ['name' => 'Jihomoravský kraj', 'url' => '/ui-ux-design-agency-in-jihomoravsky-kraj-czech-republic', 'basename' => 'ui-ux-design-agency-in-jihomoravsky-kraj-czech-republic'],
  ['name' => 'Jindřichův Hradec', 'url' => '/ui-ux-design-agency-in-jindrichuv-hradec-czech-republic', 'basename' => 'ui-ux-design-agency-in-jindrichuv-hradec-czech-republic'],
  ['name' => 'Karlovarský kraj', 'url' => '/ui-ux-design-agency-in-karlovarsky-kraj-czech-republic', 'basename' => 'ui-ux-design-agency-in-karlovarsky-kraj-czech-republic'],
  ['name' => 'Karlovy Vary', 'url' => '/ui-ux-design-agency-in-karlovy-vary-czech-republic', 'basename' => 'ui-ux-design-agency-in-karlovy-vary-czech-republic'],
  ['name' => 'Karviná', 'url' => '/ui-ux-design-agency-in-karvina-czech-republic', 'basename' => 'ui-ux-design-agency-in-karvina-czech-republic'],
  ['name' => 'Kladno', 'url' => '/ui-ux-design-agency-in-kladno-czech-republic', 'basename' => 'ui-ux-design-agency-in-kladno-czech-republic'],
  ['name' => 'Klatovy', 'url' => '/ui-ux-design-agency-in-klatovy-czech-republic', 'basename' => 'ui-ux-design-agency-in-klatovy-czech-republic'],
  ['name' => 'Kolín', 'url' => '/ui-ux-design-agency-in-kolin-czech-republic', 'basename' => 'ui-ux-design-agency-in-kolin-czech-republic'],
  ['name' => 'Kraj Vysočina', 'url' => '/ui-ux-design-agency-in-kraj-vysocina-czech-republic', 'basename' => 'ui-ux-design-agency-in-kraj-vysocina-czech-republic'],
  ['name' => 'Královéhradecký kraj', 'url' => '/ui-ux-design-agency-in-kralovehradecky-kraj-czech-republic', 'basename' => 'ui-ux-design-agency-in-kralovehradecky-kraj-czech-republic'],
  ['name' => 'Kroměříž', 'url' => '/ui-ux-design-agency-in-kromeriz-czech-republic', 'basename' => 'ui-ux-design-agency-in-kromeriz-czech-republic'],
  ['name' => 'Kutná Hora', 'url' => '/ui-ux-design-agency-in-kutna-hora-czech-republic', 'basename' => 'ui-ux-design-agency-in-kutna-hora-czech-republic'],
  ['name' => 'Liberec', 'url' => '/ui-ux-design-agency-in-liberec-czech-republic', 'basename' => 'ui-ux-design-agency-in-liberec-czech-republic'],
  ['name' => 'Liberecký kraj', 'url' => '/ui-ux-design-agency-in-liberecky-kraj-czech-republic', 'basename' => 'ui-ux-design-agency-in-liberecky-kraj-czech-republic'],
  ['name' => 'Litoměřice', 'url' => '/ui-ux-design-agency-in-litomerice-czech-republic', 'basename' => 'ui-ux-design-agency-in-litomerice-czech-republic'],
  ['name' => 'Louny', 'url' => '/ui-ux-design-agency-in-louny-czech-republic', 'basename' => 'ui-ux-design-agency-in-louny-czech-republic'],
  ['name' => 'Mělník', 'url' => '/ui-ux-design-agency-in-melnik-czech-republic', 'basename' => 'ui-ux-design-agency-in-melnik-czech-republic'],
  ['name' => 'Mladá Boleslav', 'url' => '/ui-ux-design-agency-in-mlada-boleslav-czech-republic', 'basename' => 'ui-ux-design-agency-in-mlada-boleslav-czech-republic'],
  ['name' => 'Moravskoslezský kraj', 'url' => '/ui-ux-design-agency-in-moravskoslezsky-kraj-czech-republic', 'basename' => 'ui-ux-design-agency-in-moravskoslezsky-kraj-czech-republic'],
  ['name' => 'Most', 'url' => '/ui-ux-design-agency-in-most-czech-republic', 'basename' => 'ui-ux-design-agency-in-most-czech-republic'],
  ['name' => 'Náchod', 'url' => '/ui-ux-design-agency-in-nachod-czech-republic', 'basename' => 'ui-ux-design-agency-in-nachod-czech-republic'],
  ['name' => 'Nový Jičín', 'url' => '/ui-ux-design-agency-in-novy-jicin-czech-republic', 'basename' => 'ui-ux-design-agency-in-novy-jicin-czech-republic'],
  ['name' => 'Nymburk', 'url' => '/ui-ux-design-agency-in-nymburk-czech-republic', 'basename' => 'ui-ux-design-agency-in-nymburk-czech-republic'],
  ['name' => 'Olomouc', 'url' => '/ui-ux-design-agency-in-olomouc-czech-republic', 'basename' => 'ui-ux-design-agency-in-olomouc-czech-republic'],
  ['name' => 'Olomoucký kraj', 'url' => '/ui-ux-design-agency-in-olomoucky-kraj-czech-republic', 'basename' => 'ui-ux-design-agency-in-olomoucky-kraj-czech-republic'],
  ['name' => 'Opava', 'url' => '/ui-ux-design-agency-in-opava-czech-republic', 'basename' => 'ui-ux-design-agency-in-opava-czech-republic'],
  ['name' => 'Ostrava-město', 'url' => '/ui-ux-design-agency-in-ostrava-mesto-czech-republic', 'basename' => 'ui-ux-design-agency-in-ostrava-mesto-czech-republic'],
  ['name' => 'Pardubice', 'url' => '/ui-ux-design-agency-in-pardubice-czech-republic', 'basename' => 'ui-ux-design-agency-in-pardubice-czech-republic'],
  ['name' => 'Pardubický kraj', 'url' => '/ui-ux-design-agency-in-pardubicky-kraj-czech-republic', 'basename' => 'ui-ux-design-agency-in-pardubicky-kraj-czech-republic'],
  ['name' => 'Pelhřimov', 'url' => '/ui-ux-design-agency-in-pelhrimov-czech-republic', 'basename' => 'ui-ux-design-agency-in-pelhrimov-czech-republic'],
  ['name' => 'Písek', 'url' => '/ui-ux-design-agency-in-pisek-czech-republic', 'basename' => 'ui-ux-design-agency-in-pisek-czech-republic'],
  ['name' => 'Plzeň-jih', 'url' => '/ui-ux-design-agency-in-plzen-jih-czech-republic', 'basename' => 'ui-ux-design-agency-in-plzen-jih-czech-republic'],
  ['name' => 'Plzeň-město', 'url' => '/ui-ux-design-agency-in-plzen-mesto-czech-republic', 'basename' => 'ui-ux-design-agency-in-plzen-mesto-czech-republic'],
  ['name' => 'Plzeň-sever', 'url' => '/ui-ux-design-agency-in-plzen-sever-czech-republic', 'basename' => 'ui-ux-design-agency-in-plzen-sever-czech-republic'],
  ['name' => 'Plzeňský kraj', 'url' => '/ui-ux-design-agency-in-plzensky-kraj-czech-republic', 'basename' => 'ui-ux-design-agency-in-plzensky-kraj-czech-republic'],
  ['name' => 'Prachatice', 'url' => '/ui-ux-design-agency-in-prachatice-czech-republic', 'basename' => 'ui-ux-design-agency-in-prachatice-czech-republic'],
  ['name' => 'Praha, Hlavní město', 'url' => '/ui-ux-design-agency-in-praha-hlavni-mesto-czech-republic', 'basename' => 'ui-ux-design-agency-in-praha-hlavni-mesto-czech-republic'],
  ['name' => 'Praha-východ', 'url' => '/ui-ux-design-agency-in-praha-vychod-czech-republic', 'basename' => 'ui-ux-design-agency-in-praha-vychod-czech-republic'],
  ['name' => 'Praha-západ', 'url' => '/ui-ux-design-agency-in-praha-zapad-czech-republic', 'basename' => 'ui-ux-design-agency-in-praha-zapad-czech-republic'],
  ['name' => 'Přerov', 'url' => '/ui-ux-design-agency-in-prerov-czech-republic', 'basename' => 'ui-ux-design-agency-in-prerov-czech-republic'],
  ['name' => 'Příbram', 'url' => '/ui-ux-design-agency-in-pribram-czech-republic', 'basename' => 'ui-ux-design-agency-in-pribram-czech-republic'],
  ['name' => 'Prostějov', 'url' => '/ui-ux-design-agency-in-prostejov-czech-republic', 'basename' => 'ui-ux-design-agency-in-prostejov-czech-republic'],
  ['name' => 'Rakovník', 'url' => '/ui-ux-design-agency-in-rakovnik-czech-republic', 'basename' => 'ui-ux-design-agency-in-rakovnik-czech-republic'],
  ['name' => 'Rokycany', 'url' => '/ui-ux-design-agency-in-rokycany-czech-republic', 'basename' => 'ui-ux-design-agency-in-rokycany-czech-republic'],
  ['name' => 'Rychnov nad Kněžnou', 'url' => '/ui-ux-design-agency-in-rychnov-nad-kneznou-czech-republic', 'basename' => 'ui-ux-design-agency-in-rychnov-nad-kneznou-czech-republic'],
  ['name' => 'Semily', 'url' => '/ui-ux-design-agency-in-semily-czech-republic', 'basename' => 'ui-ux-design-agency-in-semily-czech-republic'],
  ['name' => 'Sokolov', 'url' => '/ui-ux-design-agency-in-sokolov-czech-republic', 'basename' => 'ui-ux-design-agency-in-sokolov-czech-republic'],
  ['name' => 'Strakonice', 'url' => '/ui-ux-design-agency-in-strakonice-czech-republic', 'basename' => 'ui-ux-design-agency-in-strakonice-czech-republic'],
  ['name' => 'Středočeský kraj', 'url' => '/ui-ux-design-agency-in-stredocesky-kraj-czech-republic', 'basename' => 'ui-ux-design-agency-in-stredocesky-kraj-czech-republic'],
  ['name' => 'Šumperk', 'url' => '/ui-ux-design-agency-in-sumperk-czech-republic', 'basename' => 'ui-ux-design-agency-in-sumperk-czech-republic'],
  ['name' => 'Svitavy', 'url' => '/ui-ux-design-agency-in-svitavy-czech-republic', 'basename' => 'ui-ux-design-agency-in-svitavy-czech-republic'],
  ['name' => 'Tábor', 'url' => '/ui-ux-design-agency-in-tabor-czech-republic', 'basename' => 'ui-ux-design-agency-in-tabor-czech-republic'],
  ['name' => 'Tachov', 'url' => '/ui-ux-design-agency-in-tachov-czech-republic', 'basename' => 'ui-ux-design-agency-in-tachov-czech-republic'],
  ['name' => 'Teplice', 'url' => '/ui-ux-design-agency-in-teplice-czech-republic', 'basename' => 'ui-ux-design-agency-in-teplice-czech-republic'],
  ['name' => 'Třebíč', 'url' => '/ui-ux-design-agency-in-trebic-czech-republic', 'basename' => 'ui-ux-design-agency-in-trebic-czech-republic'],
  ['name' => 'Trutnov', 'url' => '/ui-ux-design-agency-in-trutnov-czech-republic', 'basename' => 'ui-ux-design-agency-in-trutnov-czech-republic'],
  ['name' => 'Uherské Hradiště', 'url' => '/ui-ux-design-agency-in-uherske-hradiste-czech-republic', 'basename' => 'ui-ux-design-agency-in-uherske-hradiste-czech-republic'],
  ['name' => 'Ústecký kraj', 'url' => '/ui-ux-design-agency-in-ustecky-kraj-czech-republic', 'basename' => 'ui-ux-design-agency-in-ustecky-kraj-czech-republic'],
  ['name' => 'Ústí nad Labem', 'url' => '/ui-ux-design-agency-in-usti-nad-labem-czech-republic', 'basename' => 'ui-ux-design-agency-in-usti-nad-labem-czech-republic'],
  ['name' => 'Ústí nad Orlicí', 'url' => '/ui-ux-design-agency-in-usti-nad-orlici-czech-republic', 'basename' => 'ui-ux-design-agency-in-usti-nad-orlici-czech-republic'],
  ['name' => 'Vsetín', 'url' => '/ui-ux-design-agency-in-vsetin-czech-republic', 'basename' => 'ui-ux-design-agency-in-vsetin-czech-republic'],
  ['name' => 'Vyškov', 'url' => '/ui-ux-design-agency-in-vyskov-czech-republic', 'basename' => 'ui-ux-design-agency-in-vyskov-czech-republic'],
  ['name' => 'Žďár nad Sázavou', 'url' => '/ui-ux-design-agency-in-zdar-nad-sazavou-czech-republic', 'basename' => 'ui-ux-design-agency-in-zdar-nad-sazavou-czech-republic'],
  ['name' => 'Zlín', 'url' => '/ui-ux-design-agency-in-zlin-czech-republic', 'basename' => 'ui-ux-design-agency-in-zlin-czech-republic'],
  ['name' => 'Zlínský kraj', 'url' => '/ui-ux-design-agency-in-zlinsky-kraj-czech-republic', 'basename' => 'ui-ux-design-agency-in-zlinsky-kraj-czech-republic'],
  ['name' => 'Znojmo', 'url' => '/ui-ux-design-agency-in-znojmo-czech-republic', 'basename' => 'ui-ux-design-agency-in-znojmo-czech-republic'],
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

    <!-- ── Hub: Browse all regions in Czech Republic ── -->
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
      <h2>Browse UI/UX Design Services Across Czech Republic</h2>
      <p class="hub-sub">We serve 90 regions, states, and cities in Czech Republic. Select a location to see how UX Pacific can help your business.</p>
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