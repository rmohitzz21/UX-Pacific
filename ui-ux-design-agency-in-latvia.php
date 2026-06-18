<?php
require_once __DIR__ . '/includes/cms_repository.php';

$countrySlug = 'latvia';

$featuredProjects   = get_published_projects('all', true);
$ecosystemHomeItems = get_published_ecosystem();

function home_image_url(?string $url): string {
  $url = trim((string) $url);
  if ($url === '') return uxp_normalize_stored_media_url('img/ux.webp');
  if (preg_match('#^https?://#i', $url)) return $url;
  return uxp_normalize_stored_media_url($url);
}

$pageTitle   = 'UI UX Design Agency in Latvia | UX Pacific';
$pageDesc    = 'UX Pacific delivers expert UI/UX design services across Latvia. Browse our locations or book a free UX audit today.';
$canonicalUrl = 'https://www.uxpacific.com/ui-ux-design-agency-in-latvia';
$ogTitle     = 'UI UX Design Agency in Latvia | UX Pacific';
$ogDesc      = 'UX Pacific delivers expert UI/UX design services across Latvia. Browse our locations or book a free UX audit today.';
$ogUrl       = 'https://www.uxpacific.com/ui-ux-design-agency-in-latvia';
$currentPage = 'Home';

// Schema: WebPage + BreadcrumbList
$ldJson = json_encode([
  '@context' => 'https://schema.org',
  '@graph'   => [
    ['@type' => 'WebPage',
     'url'   => 'https://www.uxpacific.com/ui-ux-design-agency-in-latvia',
     'name'  => 'UI UX Design Agency in Latvia | UX Pacific',
     'inLanguage' => 'en',
    ],
    ['@type' => 'BreadcrumbList',
     'itemListElement' => [
       ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home',       'item' => BASE_URL . '/'],
       ['@type' => 'ListItem', 'position' => 2, 'name' => 'Latvia', 'item' => 'https://www.uxpacific.com/ui-ux-design-agency-in-latvia'],
     ],
    ],
  ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

$geoPage = uxp_geo_page($countrySlug);
if ($geoPage) {
  if (!empty($geoPage['page_title']))      { $pageTitle = (string) $geoPage['page_title']; $ogTitle = $pageTitle; }
  if (!empty($geoPage['meta_description'])) { $pageDesc  = (string) $geoPage['meta_description']; $ogDesc = $pageDesc; }
}

// Child locations in Latvia
$hubChildren = [
  ['name' => 'Aglona Municipality', 'url' => '/ui-ux-design-agency-in-aglona-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-aglona-municipality-latvia'],
  ['name' => 'Aizkraukle Municipality', 'url' => '/ui-ux-design-agency-in-aizkraukle-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-aizkraukle-municipality-latvia'],
  ['name' => 'Aizpute Municipality', 'url' => '/ui-ux-design-agency-in-aizpute-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-aizpute-municipality-latvia'],
  ['name' => 'Aknīste Municipality', 'url' => '/ui-ux-design-agency-in-akniste-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-akniste-municipality-latvia'],
  ['name' => 'Aloja Municipality', 'url' => '/ui-ux-design-agency-in-aloja-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-aloja-municipality-latvia'],
  ['name' => 'Alsunga Municipality', 'url' => '/ui-ux-design-agency-in-alsunga-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-alsunga-municipality-latvia'],
  ['name' => 'Alūksne Municipality', 'url' => '/ui-ux-design-agency-in-aluksne-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-aluksne-municipality-latvia'],
  ['name' => 'Amata Municipality', 'url' => '/ui-ux-design-agency-in-amata-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-amata-municipality-latvia'],
  ['name' => 'Ape Municipality', 'url' => '/ui-ux-design-agency-in-ape-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-ape-municipality-latvia'],
  ['name' => 'Auce Municipality', 'url' => '/ui-ux-design-agency-in-auce-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-auce-municipality-latvia'],
  ['name' => 'Babīte Municipality', 'url' => '/ui-ux-design-agency-in-babite-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-babite-municipality-latvia'],
  ['name' => 'Baldone Municipality', 'url' => '/ui-ux-design-agency-in-baldone-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-baldone-municipality-latvia'],
  ['name' => 'Baltinava Municipality', 'url' => '/ui-ux-design-agency-in-baltinava-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-baltinava-municipality-latvia'],
  ['name' => 'Balvi Municipality', 'url' => '/ui-ux-design-agency-in-balvi-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-balvi-municipality-latvia'],
  ['name' => 'Bauska Municipality', 'url' => '/ui-ux-design-agency-in-bauska-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-bauska-municipality-latvia'],
  ['name' => 'Beverīna Municipality', 'url' => '/ui-ux-design-agency-in-beverina-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-beverina-municipality-latvia'],
  ['name' => 'Brocēni Municipality', 'url' => '/ui-ux-design-agency-in-broceni-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-broceni-municipality-latvia'],
  ['name' => 'Burtnieki Municipality', 'url' => '/ui-ux-design-agency-in-burtnieki-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-burtnieki-municipality-latvia'],
  ['name' => 'Carnikava Municipality', 'url' => '/ui-ux-design-agency-in-carnikava-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-carnikava-municipality-latvia'],
  ['name' => 'Cēsis Municipality', 'url' => '/ui-ux-design-agency-in-cesis-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-cesis-municipality-latvia'],
  ['name' => 'Cesvaine Municipality', 'url' => '/ui-ux-design-agency-in-cesvaine-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-cesvaine-municipality-latvia'],
  ['name' => 'Cibla Municipality', 'url' => '/ui-ux-design-agency-in-cibla-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-cibla-municipality-latvia'],
  ['name' => 'Dagda Municipality', 'url' => '/ui-ux-design-agency-in-dagda-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-dagda-municipality-latvia'],
  ['name' => 'Daugavpils', 'url' => '/ui-ux-design-agency-in-daugavpils-latvia', 'basename' => 'ui-ux-design-agency-in-daugavpils-latvia'],
  ['name' => 'Daugavpils Municipality', 'url' => '/ui-ux-design-agency-in-daugavpils-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-daugavpils-municipality-latvia'],
  ['name' => 'Dobele Municipality', 'url' => '/ui-ux-design-agency-in-dobele-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-dobele-municipality-latvia'],
  ['name' => 'Dundaga Municipality', 'url' => '/ui-ux-design-agency-in-dundaga-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-dundaga-municipality-latvia'],
  ['name' => 'Durbe Municipality', 'url' => '/ui-ux-design-agency-in-durbe-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-durbe-municipality-latvia'],
  ['name' => 'Engure Municipality', 'url' => '/ui-ux-design-agency-in-engure-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-engure-municipality-latvia'],
  ['name' => 'Ērgļi Municipality', 'url' => '/ui-ux-design-agency-in-ergli-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-ergli-municipality-latvia'],
  ['name' => 'Garkalne Municipality', 'url' => '/ui-ux-design-agency-in-garkalne-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-garkalne-municipality-latvia'],
  ['name' => 'Grobiņa Municipality', 'url' => '/ui-ux-design-agency-in-grobina-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-grobina-municipality-latvia'],
  ['name' => 'Gulbene Municipality', 'url' => '/ui-ux-design-agency-in-gulbene-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-gulbene-municipality-latvia'],
  ['name' => 'Iecava Municipality', 'url' => '/ui-ux-design-agency-in-iecava-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-iecava-municipality-latvia'],
  ['name' => 'Ikšķile Municipality', 'url' => '/ui-ux-design-agency-in-ikskile-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-ikskile-municipality-latvia'],
  ['name' => 'Ilūkste Municipality', 'url' => '/ui-ux-design-agency-in-ilukste-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-ilukste-municipality-latvia'],
  ['name' => 'Inčukalns Municipality', 'url' => '/ui-ux-design-agency-in-incukalns-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-incukalns-municipality-latvia'],
  ['name' => 'Jaunjelgava Municipality', 'url' => '/ui-ux-design-agency-in-jaunjelgava-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-jaunjelgava-municipality-latvia'],
  ['name' => 'Jaunpiebalga Municipality', 'url' => '/ui-ux-design-agency-in-jaunpiebalga-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-jaunpiebalga-municipality-latvia'],
  ['name' => 'Jaunpils Municipality', 'url' => '/ui-ux-design-agency-in-jaunpils-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-jaunpils-municipality-latvia'],
  ['name' => 'Jēkabpils', 'url' => '/ui-ux-design-agency-in-jekabpils-latvia', 'basename' => 'ui-ux-design-agency-in-jekabpils-latvia'],
  ['name' => 'Jēkabpils Municipality', 'url' => '/ui-ux-design-agency-in-jekabpils-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-jekabpils-municipality-latvia'],
  ['name' => 'Jelgava', 'url' => '/ui-ux-design-agency-in-jelgava-latvia', 'basename' => 'ui-ux-design-agency-in-jelgava-latvia'],
  ['name' => 'Jelgava Municipality', 'url' => '/ui-ux-design-agency-in-jelgava-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-jelgava-municipality-latvia'],
  ['name' => 'Jūrmala', 'url' => '/ui-ux-design-agency-in-jurmala-latvia', 'basename' => 'ui-ux-design-agency-in-jurmala-latvia'],
  ['name' => 'Kandava Municipality', 'url' => '/ui-ux-design-agency-in-kandava-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-kandava-municipality-latvia'],
  ['name' => 'Kārsava Municipality', 'url' => '/ui-ux-design-agency-in-karsava-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-karsava-municipality-latvia'],
  ['name' => 'Ķegums Municipality', 'url' => '/ui-ux-design-agency-in-kegums-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-kegums-municipality-latvia'],
  ['name' => 'Ķekava Municipality', 'url' => '/ui-ux-design-agency-in-kekava-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-kekava-municipality-latvia'],
  ['name' => 'Kocēni Municipality', 'url' => '/ui-ux-design-agency-in-koceni-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-koceni-municipality-latvia'],
  ['name' => 'Koknese Municipality', 'url' => '/ui-ux-design-agency-in-koknese-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-koknese-municipality-latvia'],
  ['name' => 'Krāslava Municipality', 'url' => '/ui-ux-design-agency-in-kraslava-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-kraslava-municipality-latvia'],
  ['name' => 'Krimulda Municipality', 'url' => '/ui-ux-design-agency-in-krimulda-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-krimulda-municipality-latvia'],
  ['name' => 'Krustpils Municipality', 'url' => '/ui-ux-design-agency-in-krustpils-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-krustpils-municipality-latvia'],
  ['name' => 'Kuldīga Municipality', 'url' => '/ui-ux-design-agency-in-kuldiga-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-kuldiga-municipality-latvia'],
  ['name' => 'Lielvārde Municipality', 'url' => '/ui-ux-design-agency-in-lielvarde-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-lielvarde-municipality-latvia'],
  ['name' => 'Liepāja', 'url' => '/ui-ux-design-agency-in-liepaja-latvia', 'basename' => 'ui-ux-design-agency-in-liepaja-latvia'],
  ['name' => 'Līgatne Municipality', 'url' => '/ui-ux-design-agency-in-ligatne-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-ligatne-municipality-latvia'],
  ['name' => 'Limbaži Municipality', 'url' => '/ui-ux-design-agency-in-limbazi-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-limbazi-municipality-latvia'],
  ['name' => 'Līvāni Municipality', 'url' => '/ui-ux-design-agency-in-livani-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-livani-municipality-latvia'],
  ['name' => 'Lubāna Municipality', 'url' => '/ui-ux-design-agency-in-lubana-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-lubana-municipality-latvia'],
  ['name' => 'Ludza Municipality', 'url' => '/ui-ux-design-agency-in-ludza-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-ludza-municipality-latvia'],
  ['name' => 'Madona Municipality', 'url' => '/ui-ux-design-agency-in-madona-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-madona-municipality-latvia'],
  ['name' => 'Mālpils Municipality', 'url' => '/ui-ux-design-agency-in-malpils-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-malpils-municipality-latvia'],
  ['name' => 'Mārupe Municipality', 'url' => '/ui-ux-design-agency-in-marupe-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-marupe-municipality-latvia'],
  ['name' => 'Mazsalaca Municipality', 'url' => '/ui-ux-design-agency-in-mazsalaca-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-mazsalaca-municipality-latvia'],
  ['name' => 'Mērsrags Municipality', 'url' => '/ui-ux-design-agency-in-mersrags-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-mersrags-municipality-latvia'],
  ['name' => 'Naukšēni Municipality', 'url' => '/ui-ux-design-agency-in-naukseni-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-naukseni-municipality-latvia'],
  ['name' => 'Nereta Municipality', 'url' => '/ui-ux-design-agency-in-nereta-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-nereta-municipality-latvia'],
  ['name' => 'Nīca Municipality', 'url' => '/ui-ux-design-agency-in-nica-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-nica-municipality-latvia'],
  ['name' => 'Ogre Municipality', 'url' => '/ui-ux-design-agency-in-ogre-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-ogre-municipality-latvia'],
  ['name' => 'Olaine Municipality', 'url' => '/ui-ux-design-agency-in-olaine-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-olaine-municipality-latvia'],
  ['name' => 'Ozolnieki Municipality', 'url' => '/ui-ux-design-agency-in-ozolnieki-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-ozolnieki-municipality-latvia'],
  ['name' => 'Pārgauja Municipality', 'url' => '/ui-ux-design-agency-in-pargauja-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-pargauja-municipality-latvia'],
  ['name' => 'Pāvilosta Municipality', 'url' => '/ui-ux-design-agency-in-pavilosta-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-pavilosta-municipality-latvia'],
  ['name' => 'Pļaviņas Municipality', 'url' => '/ui-ux-design-agency-in-plavinas-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-plavinas-municipality-latvia'],
  ['name' => 'Preiļi Municipality', 'url' => '/ui-ux-design-agency-in-preili-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-preili-municipality-latvia'],
  ['name' => 'Priekule Municipality', 'url' => '/ui-ux-design-agency-in-priekule-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-priekule-municipality-latvia'],
  ['name' => 'Priekuļi Municipality', 'url' => '/ui-ux-design-agency-in-priekuli-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-priekuli-municipality-latvia'],
  ['name' => 'Rauna Municipality', 'url' => '/ui-ux-design-agency-in-rauna-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-rauna-municipality-latvia'],
  ['name' => 'Rēzekne', 'url' => '/ui-ux-design-agency-in-rezekne-latvia', 'basename' => 'ui-ux-design-agency-in-rezekne-latvia'],
  ['name' => 'Rēzekne Municipality', 'url' => '/ui-ux-design-agency-in-rezekne-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-rezekne-municipality-latvia'],
  ['name' => 'Riebiņi Municipality', 'url' => '/ui-ux-design-agency-in-riebini-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-riebini-municipality-latvia'],
  ['name' => 'Riga', 'url' => '/ui-ux-design-agency-in-riga-latvia', 'basename' => 'ui-ux-design-agency-in-riga-latvia'],
  ['name' => 'Roja Municipality', 'url' => '/ui-ux-design-agency-in-roja-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-roja-municipality-latvia'],
  ['name' => 'Ropaži Municipality', 'url' => '/ui-ux-design-agency-in-ropazi-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-ropazi-municipality-latvia'],
  ['name' => 'Rucava Municipality', 'url' => '/ui-ux-design-agency-in-rucava-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-rucava-municipality-latvia'],
  ['name' => 'Rugāji Municipality', 'url' => '/ui-ux-design-agency-in-rugaji-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-rugaji-municipality-latvia'],
  ['name' => 'Rūjiena Municipality', 'url' => '/ui-ux-design-agency-in-rujiena-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-rujiena-municipality-latvia'],
  ['name' => 'Rundāle Municipality', 'url' => '/ui-ux-design-agency-in-rundale-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-rundale-municipality-latvia'],
  ['name' => 'Sala Municipality', 'url' => '/ui-ux-design-agency-in-sala-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-sala-municipality-latvia'],
  ['name' => 'Salacgrīva Municipality', 'url' => '/ui-ux-design-agency-in-salacgriva-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-salacgriva-municipality-latvia'],
  ['name' => 'Salaspils Municipality', 'url' => '/ui-ux-design-agency-in-salaspils-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-salaspils-municipality-latvia'],
  ['name' => 'Saldus Municipality', 'url' => '/ui-ux-design-agency-in-saldus-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-saldus-municipality-latvia'],
  ['name' => 'Saulkrasti Municipality', 'url' => '/ui-ux-design-agency-in-saulkrasti-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-saulkrasti-municipality-latvia'],
  ['name' => 'Sēja Municipality', 'url' => '/ui-ux-design-agency-in-seja-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-seja-municipality-latvia'],
  ['name' => 'Sigulda Municipality', 'url' => '/ui-ux-design-agency-in-sigulda-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-sigulda-municipality-latvia'],
  ['name' => 'Skrīveri Municipality', 'url' => '/ui-ux-design-agency-in-skriveri-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-skriveri-municipality-latvia'],
  ['name' => 'Skrunda Municipality', 'url' => '/ui-ux-design-agency-in-skrunda-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-skrunda-municipality-latvia'],
  ['name' => 'Smiltene Municipality', 'url' => '/ui-ux-design-agency-in-smiltene-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-smiltene-municipality-latvia'],
  ['name' => 'Stopiņi Municipality', 'url' => '/ui-ux-design-agency-in-stopini-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-stopini-municipality-latvia'],
  ['name' => 'Strenči Municipality', 'url' => '/ui-ux-design-agency-in-strenci-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-strenci-municipality-latvia'],
  ['name' => 'Talsi Municipality', 'url' => '/ui-ux-design-agency-in-talsi-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-talsi-municipality-latvia'],
  ['name' => 'Tērvete Municipality', 'url' => '/ui-ux-design-agency-in-tervete-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-tervete-municipality-latvia'],
  ['name' => 'Tukums Municipality', 'url' => '/ui-ux-design-agency-in-tukums-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-tukums-municipality-latvia'],
  ['name' => 'Vaiņode Municipality', 'url' => '/ui-ux-design-agency-in-vainode-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-vainode-municipality-latvia'],
  ['name' => 'Valka Municipality', 'url' => '/ui-ux-design-agency-in-valka-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-valka-municipality-latvia'],
  ['name' => 'Valmiera', 'url' => '/ui-ux-design-agency-in-valmiera-latvia', 'basename' => 'ui-ux-design-agency-in-valmiera-latvia'],
  ['name' => 'Varakļāni Municipality', 'url' => '/ui-ux-design-agency-in-varaklani-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-varaklani-municipality-latvia'],
  ['name' => 'Vārkava Municipality', 'url' => '/ui-ux-design-agency-in-varkava-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-varkava-municipality-latvia'],
  ['name' => 'Vecpiebalga Municipality', 'url' => '/ui-ux-design-agency-in-vecpiebalga-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-vecpiebalga-municipality-latvia'],
  ['name' => 'Vecumnieki Municipality', 'url' => '/ui-ux-design-agency-in-vecumnieki-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-vecumnieki-municipality-latvia'],
  ['name' => 'Ventspils', 'url' => '/ui-ux-design-agency-in-ventspils-latvia', 'basename' => 'ui-ux-design-agency-in-ventspils-latvia'],
  ['name' => 'Ventspils Municipality', 'url' => '/ui-ux-design-agency-in-ventspils-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-ventspils-municipality-latvia'],
  ['name' => 'Viesīte Municipality', 'url' => '/ui-ux-design-agency-in-viesite-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-viesite-municipality-latvia'],
  ['name' => 'Viļaka Municipality', 'url' => '/ui-ux-design-agency-in-vilaka-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-vilaka-municipality-latvia'],
  ['name' => 'Viļāni Municipality', 'url' => '/ui-ux-design-agency-in-vilani-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-vilani-municipality-latvia'],
  ['name' => 'Zilupe Municipality', 'url' => '/ui-ux-design-agency-in-zilupe-municipality-latvia', 'basename' => 'ui-ux-design-agency-in-zilupe-municipality-latvia'],
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

    <!-- ── Hub: Browse all regions in Latvia ── -->
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
      <h2>Browse UI/UX Design Services Across Latvia</h2>
      <p class="hub-sub">We serve 118 regions, states, and cities in Latvia. Select a location to see how UX Pacific can help your business.</p>
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