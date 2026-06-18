<?php
require_once __DIR__ . '/includes/cms_repository.php';

$countrySlug = 'united-kingdom';

$featuredProjects   = get_published_projects('all', true);
$ecosystemHomeItems = get_published_ecosystem();

function home_image_url(?string $url): string {
  $url = trim((string) $url);
  if ($url === '') return uxp_normalize_stored_media_url('img/ux.webp');
  if (preg_match('#^https?://#i', $url)) return $url;
  return uxp_normalize_stored_media_url($url);
}

$pageTitle   = 'UI UX Design Agency in United Kingdom | UX Pacific';
$pageDesc    = 'UX Pacific delivers expert UI/UX design services across United Kingdom. Browse our locations or book a free UX audit today.';
$canonicalUrl = 'https://www.uxpacific.com/ui-ux-design-agency-in-united-kingdom';
$ogTitle     = 'UI UX Design Agency in United Kingdom | UX Pacific';
$ogDesc      = 'UX Pacific delivers expert UI/UX design services across United Kingdom. Browse our locations or book a free UX audit today.';
$ogUrl       = 'https://www.uxpacific.com/ui-ux-design-agency-in-united-kingdom';
$currentPage = 'Home';

// Schema: WebPage + BreadcrumbList
$ldJson = json_encode([
  '@context' => 'https://schema.org',
  '@graph'   => [
    ['@type' => 'WebPage',
     'url'   => 'https://www.uxpacific.com/ui-ux-design-agency-in-united-kingdom',
     'name'  => 'UI UX Design Agency in United Kingdom | UX Pacific',
     'inLanguage' => 'en',
    ],
    ['@type' => 'BreadcrumbList',
     'itemListElement' => [
       ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home',       'item' => BASE_URL . '/'],
       ['@type' => 'ListItem', 'position' => 2, 'name' => 'United Kingdom', 'item' => 'https://www.uxpacific.com/ui-ux-design-agency-in-united-kingdom'],
     ],
    ],
  ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

$geoPage = uxp_geo_page($countrySlug);
if ($geoPage) {
  if (!empty($geoPage['page_title']))      { $pageTitle = (string) $geoPage['page_title']; $ogTitle = $pageTitle; }
  if (!empty($geoPage['meta_description'])) { $pageDesc  = (string) $geoPage['meta_description']; $ogDesc = $pageDesc; }
}

// Child locations in United Kingdom
$hubChildren = [
  ['name' => 'Aberdeen', 'url' => '/ui-ux-design-agency-in-aberdeen-united-kingdom', 'basename' => 'ui-ux-design-agency-in-aberdeen-united-kingdom'],
  ['name' => 'Aberdeenshire', 'url' => '/ui-ux-design-agency-in-aberdeenshire-united-kingdom', 'basename' => 'ui-ux-design-agency-in-aberdeenshire-united-kingdom'],
  ['name' => 'Angus', 'url' => '/ui-ux-design-agency-in-angus-united-kingdom', 'basename' => 'ui-ux-design-agency-in-angus-united-kingdom'],
  ['name' => 'Antrim and Newtownabbey', 'url' => '/ui-ux-design-agency-in-antrim-and-newtownabbey-united-kingdom', 'basename' => 'ui-ux-design-agency-in-antrim-and-newtownabbey-united-kingdom'],
  ['name' => 'Antrim', 'url' => '/ui-ux-design-agency-in-antrim-united-kingdom', 'basename' => 'ui-ux-design-agency-in-antrim-united-kingdom'],
  ['name' => 'Ards and North Down', 'url' => '/ui-ux-design-agency-in-ards-and-north-down-united-kingdom', 'basename' => 'ui-ux-design-agency-in-ards-and-north-down-united-kingdom'],
  ['name' => 'Ards', 'url' => '/ui-ux-design-agency-in-ards-united-kingdom', 'basename' => 'ui-ux-design-agency-in-ards-united-kingdom'],
  ['name' => 'Argyll and Bute', 'url' => '/ui-ux-design-agency-in-argyll-and-bute-united-kingdom', 'basename' => 'ui-ux-design-agency-in-argyll-and-bute-united-kingdom'],
  ['name' => 'Armagh, Banbridge and Craigavon', 'url' => '/ui-ux-design-agency-in-armagh-banbridge-and-craigavon-united-kingdom', 'basename' => 'ui-ux-design-agency-in-armagh-banbridge-and-craigavon-united-kingdom'],
  ['name' => 'Armagh City and District Council', 'url' => '/ui-ux-design-agency-in-armagh-city-and-district-council-united-kingdom', 'basename' => 'ui-ux-design-agency-in-armagh-city-and-district-council-united-kingdom'],
  ['name' => 'Ascension Island', 'url' => '/ui-ux-design-agency-in-ascension-island-united-kingdom', 'basename' => 'ui-ux-design-agency-in-ascension-island-united-kingdom'],
  ['name' => 'Ballymena Borough', 'url' => '/ui-ux-design-agency-in-ballymena-borough-united-kingdom', 'basename' => 'ui-ux-design-agency-in-ballymena-borough-united-kingdom'],
  ['name' => 'Ballymoney', 'url' => '/ui-ux-design-agency-in-ballymoney-united-kingdom', 'basename' => 'ui-ux-design-agency-in-ballymoney-united-kingdom'],
  ['name' => 'Banbridge', 'url' => '/ui-ux-design-agency-in-banbridge-united-kingdom', 'basename' => 'ui-ux-design-agency-in-banbridge-united-kingdom'],
  ['name' => 'Barnsley', 'url' => '/ui-ux-design-agency-in-barnsley-united-kingdom', 'basename' => 'ui-ux-design-agency-in-barnsley-united-kingdom'],
  ['name' => 'Bath and North East Somerset', 'url' => '/ui-ux-design-agency-in-bath-and-north-east-somerset-united-kingdom', 'basename' => 'ui-ux-design-agency-in-bath-and-north-east-somerset-united-kingdom'],
  ['name' => 'Bedford', 'url' => '/ui-ux-design-agency-in-bedford-united-kingdom', 'basename' => 'ui-ux-design-agency-in-bedford-united-kingdom'],
  ['name' => 'Belfast district', 'url' => '/ui-ux-design-agency-in-belfast-district-united-kingdom', 'basename' => 'ui-ux-design-agency-in-belfast-district-united-kingdom'],
  ['name' => 'Birmingham', 'url' => '/ui-ux-design-agency-in-birmingham-united-kingdom', 'basename' => 'ui-ux-design-agency-in-birmingham-united-kingdom'],
  ['name' => 'Blackburn with Darwen', 'url' => '/ui-ux-design-agency-in-blackburn-with-darwen-united-kingdom', 'basename' => 'ui-ux-design-agency-in-blackburn-with-darwen-united-kingdom'],
  ['name' => 'Blackpool', 'url' => '/ui-ux-design-agency-in-blackpool-united-kingdom', 'basename' => 'ui-ux-design-agency-in-blackpool-united-kingdom'],
  ['name' => 'Blaenau Gwent County Borough', 'url' => '/ui-ux-design-agency-in-blaenau-gwent-county-borough-united-kingdom', 'basename' => 'ui-ux-design-agency-in-blaenau-gwent-county-borough-united-kingdom'],
  ['name' => 'Bolton', 'url' => '/ui-ux-design-agency-in-bolton-united-kingdom', 'basename' => 'ui-ux-design-agency-in-bolton-united-kingdom'],
  ['name' => 'Bournemouth', 'url' => '/ui-ux-design-agency-in-bournemouth-united-kingdom', 'basename' => 'ui-ux-design-agency-in-bournemouth-united-kingdom'],
  ['name' => 'Bracknell Forest', 'url' => '/ui-ux-design-agency-in-bracknell-forest-united-kingdom', 'basename' => 'ui-ux-design-agency-in-bracknell-forest-united-kingdom'],
  ['name' => 'Bradford', 'url' => '/ui-ux-design-agency-in-bradford-united-kingdom', 'basename' => 'ui-ux-design-agency-in-bradford-united-kingdom'],
  ['name' => 'Bridgend County Borough', 'url' => '/ui-ux-design-agency-in-bridgend-county-borough-united-kingdom', 'basename' => 'ui-ux-design-agency-in-bridgend-county-borough-united-kingdom'],
  ['name' => 'Brighton and Hove', 'url' => '/ui-ux-design-agency-in-brighton-and-hove-united-kingdom', 'basename' => 'ui-ux-design-agency-in-brighton-and-hove-united-kingdom'],
  ['name' => 'Buckinghamshire', 'url' => '/ui-ux-design-agency-in-buckinghamshire-united-kingdom', 'basename' => 'ui-ux-design-agency-in-buckinghamshire-united-kingdom'],
  ['name' => 'Bury', 'url' => '/ui-ux-design-agency-in-bury-united-kingdom', 'basename' => 'ui-ux-design-agency-in-bury-united-kingdom'],
  ['name' => 'Caerphilly County Borough', 'url' => '/ui-ux-design-agency-in-caerphilly-county-borough-united-kingdom', 'basename' => 'ui-ux-design-agency-in-caerphilly-county-borough-united-kingdom'],
  ['name' => 'Calderdale', 'url' => '/ui-ux-design-agency-in-calderdale-united-kingdom', 'basename' => 'ui-ux-design-agency-in-calderdale-united-kingdom'],
  ['name' => 'Cambridgeshire', 'url' => '/ui-ux-design-agency-in-cambridgeshire-united-kingdom', 'basename' => 'ui-ux-design-agency-in-cambridgeshire-united-kingdom'],
  ['name' => 'Carmarthenshire', 'url' => '/ui-ux-design-agency-in-carmarthenshire-united-kingdom', 'basename' => 'ui-ux-design-agency-in-carmarthenshire-united-kingdom'],
  ['name' => 'Carrickfergus Borough Council', 'url' => '/ui-ux-design-agency-in-carrickfergus-borough-council-united-kingdom', 'basename' => 'ui-ux-design-agency-in-carrickfergus-borough-council-united-kingdom'],
  ['name' => 'Castlereagh', 'url' => '/ui-ux-design-agency-in-castlereagh-united-kingdom', 'basename' => 'ui-ux-design-agency-in-castlereagh-united-kingdom'],
  ['name' => 'Causeway Coast and Glens', 'url' => '/ui-ux-design-agency-in-causeway-coast-and-glens-united-kingdom', 'basename' => 'ui-ux-design-agency-in-causeway-coast-and-glens-united-kingdom'],
  ['name' => 'Central Bedfordshire', 'url' => '/ui-ux-design-agency-in-central-bedfordshire-united-kingdom', 'basename' => 'ui-ux-design-agency-in-central-bedfordshire-united-kingdom'],
  ['name' => 'Ceredigion', 'url' => '/ui-ux-design-agency-in-ceredigion-united-kingdom', 'basename' => 'ui-ux-design-agency-in-ceredigion-united-kingdom'],
  ['name' => 'Cheshire East', 'url' => '/ui-ux-design-agency-in-cheshire-east-united-kingdom', 'basename' => 'ui-ux-design-agency-in-cheshire-east-united-kingdom'],
  ['name' => 'Cheshire West and Chester', 'url' => '/ui-ux-design-agency-in-cheshire-west-and-chester-united-kingdom', 'basename' => 'ui-ux-design-agency-in-cheshire-west-and-chester-united-kingdom'],
  ['name' => 'City and County of Cardiff', 'url' => '/ui-ux-design-agency-in-city-and-county-of-cardiff-united-kingdom', 'basename' => 'ui-ux-design-agency-in-city-and-county-of-cardiff-united-kingdom'],
  ['name' => 'City and County of Swansea', 'url' => '/ui-ux-design-agency-in-city-and-county-of-swansea-united-kingdom', 'basename' => 'ui-ux-design-agency-in-city-and-county-of-swansea-united-kingdom'],
  ['name' => 'City of Bristol', 'url' => '/ui-ux-design-agency-in-city-of-bristol-united-kingdom', 'basename' => 'ui-ux-design-agency-in-city-of-bristol-united-kingdom'],
  ['name' => 'City of Derby', 'url' => '/ui-ux-design-agency-in-city-of-derby-united-kingdom', 'basename' => 'ui-ux-design-agency-in-city-of-derby-united-kingdom'],
  ['name' => 'City of Kingston upon Hull', 'url' => '/ui-ux-design-agency-in-city-of-kingston-upon-hull-united-kingdom', 'basename' => 'ui-ux-design-agency-in-city-of-kingston-upon-hull-united-kingdom'],
  ['name' => 'City of Leicester', 'url' => '/ui-ux-design-agency-in-city-of-leicester-united-kingdom', 'basename' => 'ui-ux-design-agency-in-city-of-leicester-united-kingdom'],
  ['name' => 'City of London', 'url' => '/ui-ux-design-agency-in-city-of-london-united-kingdom', 'basename' => 'ui-ux-design-agency-in-city-of-london-united-kingdom'],
  ['name' => 'City of Nottingham', 'url' => '/ui-ux-design-agency-in-city-of-nottingham-united-kingdom', 'basename' => 'ui-ux-design-agency-in-city-of-nottingham-united-kingdom'],
  ['name' => 'City of Peterborough', 'url' => '/ui-ux-design-agency-in-city-of-peterborough-united-kingdom', 'basename' => 'ui-ux-design-agency-in-city-of-peterborough-united-kingdom'],
  ['name' => 'City of Plymouth', 'url' => '/ui-ux-design-agency-in-city-of-plymouth-united-kingdom', 'basename' => 'ui-ux-design-agency-in-city-of-plymouth-united-kingdom'],
  ['name' => 'City of Portsmouth', 'url' => '/ui-ux-design-agency-in-city-of-portsmouth-united-kingdom', 'basename' => 'ui-ux-design-agency-in-city-of-portsmouth-united-kingdom'],
  ['name' => 'City of Southampton', 'url' => '/ui-ux-design-agency-in-city-of-southampton-united-kingdom', 'basename' => 'ui-ux-design-agency-in-city-of-southampton-united-kingdom'],
  ['name' => 'City of Stoke-on-Trent', 'url' => '/ui-ux-design-agency-in-city-of-stoke-on-trent-united-kingdom', 'basename' => 'ui-ux-design-agency-in-city-of-stoke-on-trent-united-kingdom'],
  ['name' => 'City of Sunderland', 'url' => '/ui-ux-design-agency-in-city-of-sunderland-united-kingdom', 'basename' => 'ui-ux-design-agency-in-city-of-sunderland-united-kingdom'],
  ['name' => 'City of Westminster', 'url' => '/ui-ux-design-agency-in-city-of-westminster-united-kingdom', 'basename' => 'ui-ux-design-agency-in-city-of-westminster-united-kingdom'],
  ['name' => 'City of Wolverhampton', 'url' => '/ui-ux-design-agency-in-city-of-wolverhampton-united-kingdom', 'basename' => 'ui-ux-design-agency-in-city-of-wolverhampton-united-kingdom'],
  ['name' => 'City of York', 'url' => '/ui-ux-design-agency-in-city-of-york-united-kingdom', 'basename' => 'ui-ux-design-agency-in-city-of-york-united-kingdom'],
  ['name' => 'Clackmannanshire', 'url' => '/ui-ux-design-agency-in-clackmannanshire-united-kingdom', 'basename' => 'ui-ux-design-agency-in-clackmannanshire-united-kingdom'],
  ['name' => 'Coleraine Borough Council', 'url' => '/ui-ux-design-agency-in-coleraine-borough-council-united-kingdom', 'basename' => 'ui-ux-design-agency-in-coleraine-borough-council-united-kingdom'],
  ['name' => 'Conwy County Borough', 'url' => '/ui-ux-design-agency-in-conwy-county-borough-united-kingdom', 'basename' => 'ui-ux-design-agency-in-conwy-county-borough-united-kingdom'],
  ['name' => 'Cookstown District Council', 'url' => '/ui-ux-design-agency-in-cookstown-district-council-united-kingdom', 'basename' => 'ui-ux-design-agency-in-cookstown-district-council-united-kingdom'],
  ['name' => 'Cornwall', 'url' => '/ui-ux-design-agency-in-cornwall-united-kingdom', 'basename' => 'ui-ux-design-agency-in-cornwall-united-kingdom'],
  ['name' => 'County Durham', 'url' => '/ui-ux-design-agency-in-county-durham-united-kingdom', 'basename' => 'ui-ux-design-agency-in-county-durham-united-kingdom'],
  ['name' => 'Coventry', 'url' => '/ui-ux-design-agency-in-coventry-united-kingdom', 'basename' => 'ui-ux-design-agency-in-coventry-united-kingdom'],
  ['name' => 'Craigavon Borough Council', 'url' => '/ui-ux-design-agency-in-craigavon-borough-council-united-kingdom', 'basename' => 'ui-ux-design-agency-in-craigavon-borough-council-united-kingdom'],
  ['name' => 'Cumbria', 'url' => '/ui-ux-design-agency-in-cumbria-united-kingdom', 'basename' => 'ui-ux-design-agency-in-cumbria-united-kingdom'],
  ['name' => 'Darlington', 'url' => '/ui-ux-design-agency-in-darlington-united-kingdom', 'basename' => 'ui-ux-design-agency-in-darlington-united-kingdom'],
  ['name' => 'Denbighshire', 'url' => '/ui-ux-design-agency-in-denbighshire-united-kingdom', 'basename' => 'ui-ux-design-agency-in-denbighshire-united-kingdom'],
  ['name' => 'Derbyshire', 'url' => '/ui-ux-design-agency-in-derbyshire-united-kingdom', 'basename' => 'ui-ux-design-agency-in-derbyshire-united-kingdom'],
  ['name' => 'Derry City and Strabane', 'url' => '/ui-ux-design-agency-in-derry-city-and-strabane-united-kingdom', 'basename' => 'ui-ux-design-agency-in-derry-city-and-strabane-united-kingdom'],
  ['name' => 'Derry City Council', 'url' => '/ui-ux-design-agency-in-derry-city-council-united-kingdom', 'basename' => 'ui-ux-design-agency-in-derry-city-council-united-kingdom'],
  ['name' => 'Devon', 'url' => '/ui-ux-design-agency-in-devon-united-kingdom', 'basename' => 'ui-ux-design-agency-in-devon-united-kingdom'],
  ['name' => 'Doncaster', 'url' => '/ui-ux-design-agency-in-doncaster-united-kingdom', 'basename' => 'ui-ux-design-agency-in-doncaster-united-kingdom'],
  ['name' => 'Dorset', 'url' => '/ui-ux-design-agency-in-dorset-united-kingdom', 'basename' => 'ui-ux-design-agency-in-dorset-united-kingdom'],
  ['name' => 'Down District Council', 'url' => '/ui-ux-design-agency-in-down-district-council-united-kingdom', 'basename' => 'ui-ux-design-agency-in-down-district-council-united-kingdom'],
  ['name' => 'Dudley', 'url' => '/ui-ux-design-agency-in-dudley-united-kingdom', 'basename' => 'ui-ux-design-agency-in-dudley-united-kingdom'],
  ['name' => 'Dumfries and Galloway', 'url' => '/ui-ux-design-agency-in-dumfries-and-galloway-united-kingdom', 'basename' => 'ui-ux-design-agency-in-dumfries-and-galloway-united-kingdom'],
  ['name' => 'Dundee', 'url' => '/ui-ux-design-agency-in-dundee-united-kingdom', 'basename' => 'ui-ux-design-agency-in-dundee-united-kingdom'],
  ['name' => 'Dungannon and South Tyrone Borough Council', 'url' => '/ui-ux-design-agency-in-dungannon-and-south-tyrone-borough-council-united-kingdom', 'basename' => 'ui-ux-design-agency-in-dungannon-and-south-tyrone-borough-council-united-kingdom'],
  ['name' => 'East Ayrshire', 'url' => '/ui-ux-design-agency-in-east-ayrshire-united-kingdom', 'basename' => 'ui-ux-design-agency-in-east-ayrshire-united-kingdom'],
  ['name' => 'East Dunbartonshire', 'url' => '/ui-ux-design-agency-in-east-dunbartonshire-united-kingdom', 'basename' => 'ui-ux-design-agency-in-east-dunbartonshire-united-kingdom'],
  ['name' => 'East Lothian', 'url' => '/ui-ux-design-agency-in-east-lothian-united-kingdom', 'basename' => 'ui-ux-design-agency-in-east-lothian-united-kingdom'],
  ['name' => 'East Renfrewshire', 'url' => '/ui-ux-design-agency-in-east-renfrewshire-united-kingdom', 'basename' => 'ui-ux-design-agency-in-east-renfrewshire-united-kingdom'],
  ['name' => 'East Riding of Yorkshire', 'url' => '/ui-ux-design-agency-in-east-riding-of-yorkshire-united-kingdom', 'basename' => 'ui-ux-design-agency-in-east-riding-of-yorkshire-united-kingdom'],
  ['name' => 'East Sussex', 'url' => '/ui-ux-design-agency-in-east-sussex-united-kingdom', 'basename' => 'ui-ux-design-agency-in-east-sussex-united-kingdom'],
  ['name' => 'Edinburgh', 'url' => '/ui-ux-design-agency-in-edinburgh-united-kingdom', 'basename' => 'ui-ux-design-agency-in-edinburgh-united-kingdom'],
  ['name' => 'England', 'url' => '/ui-ux-design-agency-in-england-united-kingdom', 'basename' => 'ui-ux-design-agency-in-england-united-kingdom'],
  ['name' => 'Essex', 'url' => '/ui-ux-design-agency-in-essex-united-kingdom', 'basename' => 'ui-ux-design-agency-in-essex-united-kingdom'],
  ['name' => 'Falkirk', 'url' => '/ui-ux-design-agency-in-falkirk-united-kingdom', 'basename' => 'ui-ux-design-agency-in-falkirk-united-kingdom'],
  ['name' => 'Fermanagh and Omagh', 'url' => '/ui-ux-design-agency-in-fermanagh-and-omagh-united-kingdom', 'basename' => 'ui-ux-design-agency-in-fermanagh-and-omagh-united-kingdom'],
  ['name' => 'Fermanagh District Council', 'url' => '/ui-ux-design-agency-in-fermanagh-district-council-united-kingdom', 'basename' => 'ui-ux-design-agency-in-fermanagh-district-council-united-kingdom'],
  ['name' => 'Fife', 'url' => '/ui-ux-design-agency-in-fife-united-kingdom', 'basename' => 'ui-ux-design-agency-in-fife-united-kingdom'],
  ['name' => 'Flintshire', 'url' => '/ui-ux-design-agency-in-flintshire-united-kingdom', 'basename' => 'ui-ux-design-agency-in-flintshire-united-kingdom'],
  ['name' => 'Gateshead', 'url' => '/ui-ux-design-agency-in-gateshead-united-kingdom', 'basename' => 'ui-ux-design-agency-in-gateshead-united-kingdom'],
  ['name' => 'Glasgow', 'url' => '/ui-ux-design-agency-in-glasgow-united-kingdom', 'basename' => 'ui-ux-design-agency-in-glasgow-united-kingdom'],
  ['name' => 'Gloucestershire', 'url' => '/ui-ux-design-agency-in-gloucestershire-united-kingdom', 'basename' => 'ui-ux-design-agency-in-gloucestershire-united-kingdom'],
  ['name' => 'Gwynedd', 'url' => '/ui-ux-design-agency-in-gwynedd-united-kingdom', 'basename' => 'ui-ux-design-agency-in-gwynedd-united-kingdom'],
  ['name' => 'Halton', 'url' => '/ui-ux-design-agency-in-halton-united-kingdom', 'basename' => 'ui-ux-design-agency-in-halton-united-kingdom'],
  ['name' => 'Hampshire', 'url' => '/ui-ux-design-agency-in-hampshire-united-kingdom', 'basename' => 'ui-ux-design-agency-in-hampshire-united-kingdom'],
  ['name' => 'Hartlepool', 'url' => '/ui-ux-design-agency-in-hartlepool-united-kingdom', 'basename' => 'ui-ux-design-agency-in-hartlepool-united-kingdom'],
  ['name' => 'Herefordshire', 'url' => '/ui-ux-design-agency-in-herefordshire-united-kingdom', 'basename' => 'ui-ux-design-agency-in-herefordshire-united-kingdom'],
  ['name' => 'Hertfordshire', 'url' => '/ui-ux-design-agency-in-hertfordshire-united-kingdom', 'basename' => 'ui-ux-design-agency-in-hertfordshire-united-kingdom'],
  ['name' => 'Highland', 'url' => '/ui-ux-design-agency-in-highland-united-kingdom', 'basename' => 'ui-ux-design-agency-in-highland-united-kingdom'],
  ['name' => 'Inverclyde', 'url' => '/ui-ux-design-agency-in-inverclyde-united-kingdom', 'basename' => 'ui-ux-design-agency-in-inverclyde-united-kingdom'],
  ['name' => 'Isle of Wight', 'url' => '/ui-ux-design-agency-in-isle-of-wight-united-kingdom', 'basename' => 'ui-ux-design-agency-in-isle-of-wight-united-kingdom'],
  ['name' => 'Isles of Scilly', 'url' => '/ui-ux-design-agency-in-isles-of-scilly-united-kingdom', 'basename' => 'ui-ux-design-agency-in-isles-of-scilly-united-kingdom'],
  ['name' => 'Kent', 'url' => '/ui-ux-design-agency-in-kent-united-kingdom', 'basename' => 'ui-ux-design-agency-in-kent-united-kingdom'],
  ['name' => 'Kirklees', 'url' => '/ui-ux-design-agency-in-kirklees-united-kingdom', 'basename' => 'ui-ux-design-agency-in-kirklees-united-kingdom'],
  ['name' => 'Knowsley', 'url' => '/ui-ux-design-agency-in-knowsley-united-kingdom', 'basename' => 'ui-ux-design-agency-in-knowsley-united-kingdom'],
  ['name' => 'Lancashire', 'url' => '/ui-ux-design-agency-in-lancashire-united-kingdom', 'basename' => 'ui-ux-design-agency-in-lancashire-united-kingdom'],
  ['name' => 'Larne Borough Council', 'url' => '/ui-ux-design-agency-in-larne-borough-council-united-kingdom', 'basename' => 'ui-ux-design-agency-in-larne-borough-council-united-kingdom'],
  ['name' => 'Leeds', 'url' => '/ui-ux-design-agency-in-leeds-united-kingdom', 'basename' => 'ui-ux-design-agency-in-leeds-united-kingdom'],
  ['name' => 'Leicestershire', 'url' => '/ui-ux-design-agency-in-leicestershire-united-kingdom', 'basename' => 'ui-ux-design-agency-in-leicestershire-united-kingdom'],
  ['name' => 'Limavady Borough Council', 'url' => '/ui-ux-design-agency-in-limavady-borough-council-united-kingdom', 'basename' => 'ui-ux-design-agency-in-limavady-borough-council-united-kingdom'],
  ['name' => 'Lincolnshire', 'url' => '/ui-ux-design-agency-in-lincolnshire-united-kingdom', 'basename' => 'ui-ux-design-agency-in-lincolnshire-united-kingdom'],
  ['name' => 'Lisburn and Castlereagh', 'url' => '/ui-ux-design-agency-in-lisburn-and-castlereagh-united-kingdom', 'basename' => 'ui-ux-design-agency-in-lisburn-and-castlereagh-united-kingdom'],
  ['name' => 'Lisburn City Council', 'url' => '/ui-ux-design-agency-in-lisburn-city-council-united-kingdom', 'basename' => 'ui-ux-design-agency-in-lisburn-city-council-united-kingdom'],
  ['name' => 'Liverpool', 'url' => '/ui-ux-design-agency-in-liverpool-united-kingdom', 'basename' => 'ui-ux-design-agency-in-liverpool-united-kingdom'],
  ['name' => 'London Borough of Barking and Dagenham', 'url' => '/ui-ux-design-agency-in-london-borough-of-barking-and-dagenham-united-kingdom', 'basename' => 'ui-ux-design-agency-in-london-borough-of-barking-and-dagenham-united-kingdom'],
  ['name' => 'London Borough of Barnet', 'url' => '/ui-ux-design-agency-in-london-borough-of-barnet-united-kingdom', 'basename' => 'ui-ux-design-agency-in-london-borough-of-barnet-united-kingdom'],
  ['name' => 'London Borough of Bexley', 'url' => '/ui-ux-design-agency-in-london-borough-of-bexley-united-kingdom', 'basename' => 'ui-ux-design-agency-in-london-borough-of-bexley-united-kingdom'],
  ['name' => 'London Borough of Brent', 'url' => '/ui-ux-design-agency-in-london-borough-of-brent-united-kingdom', 'basename' => 'ui-ux-design-agency-in-london-borough-of-brent-united-kingdom'],
  ['name' => 'London Borough of Bromley', 'url' => '/ui-ux-design-agency-in-london-borough-of-bromley-united-kingdom', 'basename' => 'ui-ux-design-agency-in-london-borough-of-bromley-united-kingdom'],
  ['name' => 'London Borough of Camden', 'url' => '/ui-ux-design-agency-in-london-borough-of-camden-united-kingdom', 'basename' => 'ui-ux-design-agency-in-london-borough-of-camden-united-kingdom'],
  ['name' => 'London Borough of Croydon', 'url' => '/ui-ux-design-agency-in-london-borough-of-croydon-united-kingdom', 'basename' => 'ui-ux-design-agency-in-london-borough-of-croydon-united-kingdom'],
  ['name' => 'London Borough of Ealing', 'url' => '/ui-ux-design-agency-in-london-borough-of-ealing-united-kingdom', 'basename' => 'ui-ux-design-agency-in-london-borough-of-ealing-united-kingdom'],
  ['name' => 'London Borough of Enfield', 'url' => '/ui-ux-design-agency-in-london-borough-of-enfield-united-kingdom', 'basename' => 'ui-ux-design-agency-in-london-borough-of-enfield-united-kingdom'],
  ['name' => 'London Borough of Hackney', 'url' => '/ui-ux-design-agency-in-london-borough-of-hackney-united-kingdom', 'basename' => 'ui-ux-design-agency-in-london-borough-of-hackney-united-kingdom'],
  ['name' => 'London Borough of Hammersmith and Fulham', 'url' => '/ui-ux-design-agency-in-london-borough-of-hammersmith-and-fulham-united-kingdom', 'basename' => 'ui-ux-design-agency-in-london-borough-of-hammersmith-and-fulham-united-kingdom'],
  ['name' => 'London Borough of Haringey', 'url' => '/ui-ux-design-agency-in-london-borough-of-haringey-united-kingdom', 'basename' => 'ui-ux-design-agency-in-london-borough-of-haringey-united-kingdom'],
  ['name' => 'London Borough of Harrow', 'url' => '/ui-ux-design-agency-in-london-borough-of-harrow-united-kingdom', 'basename' => 'ui-ux-design-agency-in-london-borough-of-harrow-united-kingdom'],
  ['name' => 'London Borough of Havering', 'url' => '/ui-ux-design-agency-in-london-borough-of-havering-united-kingdom', 'basename' => 'ui-ux-design-agency-in-london-borough-of-havering-united-kingdom'],
  ['name' => 'London Borough of Hillingdon', 'url' => '/ui-ux-design-agency-in-london-borough-of-hillingdon-united-kingdom', 'basename' => 'ui-ux-design-agency-in-london-borough-of-hillingdon-united-kingdom'],
  ['name' => 'London Borough of Hounslow', 'url' => '/ui-ux-design-agency-in-london-borough-of-hounslow-united-kingdom', 'basename' => 'ui-ux-design-agency-in-london-borough-of-hounslow-united-kingdom'],
  ['name' => 'London Borough of Islington', 'url' => '/ui-ux-design-agency-in-london-borough-of-islington-united-kingdom', 'basename' => 'ui-ux-design-agency-in-london-borough-of-islington-united-kingdom'],
  ['name' => 'London Borough of Lambeth', 'url' => '/ui-ux-design-agency-in-london-borough-of-lambeth-united-kingdom', 'basename' => 'ui-ux-design-agency-in-london-borough-of-lambeth-united-kingdom'],
  ['name' => 'London Borough of Lewisham', 'url' => '/ui-ux-design-agency-in-london-borough-of-lewisham-united-kingdom', 'basename' => 'ui-ux-design-agency-in-london-borough-of-lewisham-united-kingdom'],
  ['name' => 'London Borough of Merton', 'url' => '/ui-ux-design-agency-in-london-borough-of-merton-united-kingdom', 'basename' => 'ui-ux-design-agency-in-london-borough-of-merton-united-kingdom'],
  ['name' => 'London Borough of Newham', 'url' => '/ui-ux-design-agency-in-london-borough-of-newham-united-kingdom', 'basename' => 'ui-ux-design-agency-in-london-borough-of-newham-united-kingdom'],
  ['name' => 'London Borough of Redbridge', 'url' => '/ui-ux-design-agency-in-london-borough-of-redbridge-united-kingdom', 'basename' => 'ui-ux-design-agency-in-london-borough-of-redbridge-united-kingdom'],
  ['name' => 'London Borough of Richmond upon Thames', 'url' => '/ui-ux-design-agency-in-london-borough-of-richmond-upon-thames-united-kingdom', 'basename' => 'ui-ux-design-agency-in-london-borough-of-richmond-upon-thames-united-kingdom'],
  ['name' => 'London Borough of Southwark', 'url' => '/ui-ux-design-agency-in-london-borough-of-southwark-united-kingdom', 'basename' => 'ui-ux-design-agency-in-london-borough-of-southwark-united-kingdom'],
  ['name' => 'London Borough of Sutton', 'url' => '/ui-ux-design-agency-in-london-borough-of-sutton-united-kingdom', 'basename' => 'ui-ux-design-agency-in-london-borough-of-sutton-united-kingdom'],
  ['name' => 'London Borough of Tower Hamlets', 'url' => '/ui-ux-design-agency-in-london-borough-of-tower-hamlets-united-kingdom', 'basename' => 'ui-ux-design-agency-in-london-borough-of-tower-hamlets-united-kingdom'],
  ['name' => 'London Borough of Waltham Forest', 'url' => '/ui-ux-design-agency-in-london-borough-of-waltham-forest-united-kingdom', 'basename' => 'ui-ux-design-agency-in-london-borough-of-waltham-forest-united-kingdom'],
  ['name' => 'London Borough of Wandsworth', 'url' => '/ui-ux-design-agency-in-london-borough-of-wandsworth-united-kingdom', 'basename' => 'ui-ux-design-agency-in-london-borough-of-wandsworth-united-kingdom'],
  ['name' => 'Magherafelt District Council', 'url' => '/ui-ux-design-agency-in-magherafelt-district-council-united-kingdom', 'basename' => 'ui-ux-design-agency-in-magherafelt-district-council-united-kingdom'],
  ['name' => 'Manchester', 'url' => '/ui-ux-design-agency-in-manchester-united-kingdom', 'basename' => 'ui-ux-design-agency-in-manchester-united-kingdom'],
  ['name' => 'Medway', 'url' => '/ui-ux-design-agency-in-medway-united-kingdom', 'basename' => 'ui-ux-design-agency-in-medway-united-kingdom'],
  ['name' => 'Merthyr Tydfil County Borough', 'url' => '/ui-ux-design-agency-in-merthyr-tydfil-county-borough-united-kingdom', 'basename' => 'ui-ux-design-agency-in-merthyr-tydfil-county-borough-united-kingdom'],
  ['name' => 'Metropolitan Borough of Wigan', 'url' => '/ui-ux-design-agency-in-metropolitan-borough-of-wigan-united-kingdom', 'basename' => 'ui-ux-design-agency-in-metropolitan-borough-of-wigan-united-kingdom'],
  ['name' => 'Mid and East Antrim', 'url' => '/ui-ux-design-agency-in-mid-and-east-antrim-united-kingdom', 'basename' => 'ui-ux-design-agency-in-mid-and-east-antrim-united-kingdom'],
  ['name' => 'Mid Ulster', 'url' => '/ui-ux-design-agency-in-mid-ulster-united-kingdom', 'basename' => 'ui-ux-design-agency-in-mid-ulster-united-kingdom'],
  ['name' => 'Middlesbrough', 'url' => '/ui-ux-design-agency-in-middlesbrough-united-kingdom', 'basename' => 'ui-ux-design-agency-in-middlesbrough-united-kingdom'],
  ['name' => 'Midlothian', 'url' => '/ui-ux-design-agency-in-midlothian-united-kingdom', 'basename' => 'ui-ux-design-agency-in-midlothian-united-kingdom'],
  ['name' => 'Milton Keynes', 'url' => '/ui-ux-design-agency-in-milton-keynes-united-kingdom', 'basename' => 'ui-ux-design-agency-in-milton-keynes-united-kingdom'],
  ['name' => 'Monmouthshire', 'url' => '/ui-ux-design-agency-in-monmouthshire-united-kingdom', 'basename' => 'ui-ux-design-agency-in-monmouthshire-united-kingdom'],
  ['name' => 'Moray', 'url' => '/ui-ux-design-agency-in-moray-united-kingdom', 'basename' => 'ui-ux-design-agency-in-moray-united-kingdom'],
  ['name' => 'Moyle District Council', 'url' => '/ui-ux-design-agency-in-moyle-district-council-united-kingdom', 'basename' => 'ui-ux-design-agency-in-moyle-district-council-united-kingdom'],
  ['name' => 'Neath Port Talbot County Borough', 'url' => '/ui-ux-design-agency-in-neath-port-talbot-county-borough-united-kingdom', 'basename' => 'ui-ux-design-agency-in-neath-port-talbot-county-borough-united-kingdom'],
  ['name' => 'Newcastle upon Tyne', 'url' => '/ui-ux-design-agency-in-newcastle-upon-tyne-united-kingdom', 'basename' => 'ui-ux-design-agency-in-newcastle-upon-tyne-united-kingdom'],
  ['name' => 'Newport', 'url' => '/ui-ux-design-agency-in-newport-united-kingdom', 'basename' => 'ui-ux-design-agency-in-newport-united-kingdom'],
  ['name' => 'Newry and Mourne District Council', 'url' => '/ui-ux-design-agency-in-newry-and-mourne-district-council-united-kingdom', 'basename' => 'ui-ux-design-agency-in-newry-and-mourne-district-council-united-kingdom'],
  ['name' => 'Newry, Mourne and Down', 'url' => '/ui-ux-design-agency-in-newry-mourne-and-down-united-kingdom', 'basename' => 'ui-ux-design-agency-in-newry-mourne-and-down-united-kingdom'],
  ['name' => 'Newtownabbey Borough Council', 'url' => '/ui-ux-design-agency-in-newtownabbey-borough-council-united-kingdom', 'basename' => 'ui-ux-design-agency-in-newtownabbey-borough-council-united-kingdom'],
  ['name' => 'Norfolk', 'url' => '/ui-ux-design-agency-in-norfolk-united-kingdom', 'basename' => 'ui-ux-design-agency-in-norfolk-united-kingdom'],
  ['name' => 'North Ayrshire', 'url' => '/ui-ux-design-agency-in-north-ayrshire-united-kingdom', 'basename' => 'ui-ux-design-agency-in-north-ayrshire-united-kingdom'],
  ['name' => 'North Down Borough Council', 'url' => '/ui-ux-design-agency-in-north-down-borough-council-united-kingdom', 'basename' => 'ui-ux-design-agency-in-north-down-borough-council-united-kingdom'],
  ['name' => 'North East Lincolnshire', 'url' => '/ui-ux-design-agency-in-north-east-lincolnshire-united-kingdom', 'basename' => 'ui-ux-design-agency-in-north-east-lincolnshire-united-kingdom'],
  ['name' => 'North Lanarkshire', 'url' => '/ui-ux-design-agency-in-north-lanarkshire-united-kingdom', 'basename' => 'ui-ux-design-agency-in-north-lanarkshire-united-kingdom'],
  ['name' => 'North Lincolnshire', 'url' => '/ui-ux-design-agency-in-north-lincolnshire-united-kingdom', 'basename' => 'ui-ux-design-agency-in-north-lincolnshire-united-kingdom'],
  ['name' => 'North Somerset', 'url' => '/ui-ux-design-agency-in-north-somerset-united-kingdom', 'basename' => 'ui-ux-design-agency-in-north-somerset-united-kingdom'],
  ['name' => 'North Tyneside', 'url' => '/ui-ux-design-agency-in-north-tyneside-united-kingdom', 'basename' => 'ui-ux-design-agency-in-north-tyneside-united-kingdom'],
  ['name' => 'North Yorkshire', 'url' => '/ui-ux-design-agency-in-north-yorkshire-united-kingdom', 'basename' => 'ui-ux-design-agency-in-north-yorkshire-united-kingdom'],
  ['name' => 'Northamptonshire', 'url' => '/ui-ux-design-agency-in-northamptonshire-united-kingdom', 'basename' => 'ui-ux-design-agency-in-northamptonshire-united-kingdom'],
  ['name' => 'Northern Ireland', 'url' => '/ui-ux-design-agency-in-northern-ireland-united-kingdom', 'basename' => 'ui-ux-design-agency-in-northern-ireland-united-kingdom'],
  ['name' => 'Northumberland', 'url' => '/ui-ux-design-agency-in-northumberland-united-kingdom', 'basename' => 'ui-ux-design-agency-in-northumberland-united-kingdom'],
  ['name' => 'Nottinghamshire', 'url' => '/ui-ux-design-agency-in-nottinghamshire-united-kingdom', 'basename' => 'ui-ux-design-agency-in-nottinghamshire-united-kingdom'],
  ['name' => 'Oldham', 'url' => '/ui-ux-design-agency-in-oldham-united-kingdom', 'basename' => 'ui-ux-design-agency-in-oldham-united-kingdom'],
  ['name' => 'Omagh District Council', 'url' => '/ui-ux-design-agency-in-omagh-district-council-united-kingdom', 'basename' => 'ui-ux-design-agency-in-omagh-district-council-united-kingdom'],
  ['name' => 'Orkney Islands', 'url' => '/ui-ux-design-agency-in-orkney-islands-united-kingdom', 'basename' => 'ui-ux-design-agency-in-orkney-islands-united-kingdom'],
  ['name' => 'Outer Hebrides', 'url' => '/ui-ux-design-agency-in-outer-hebrides-united-kingdom', 'basename' => 'ui-ux-design-agency-in-outer-hebrides-united-kingdom'],
  ['name' => 'Oxfordshire', 'url' => '/ui-ux-design-agency-in-oxfordshire-united-kingdom', 'basename' => 'ui-ux-design-agency-in-oxfordshire-united-kingdom'],
  ['name' => 'Pembrokeshire', 'url' => '/ui-ux-design-agency-in-pembrokeshire-united-kingdom', 'basename' => 'ui-ux-design-agency-in-pembrokeshire-united-kingdom'],
  ['name' => 'Perth and Kinross', 'url' => '/ui-ux-design-agency-in-perth-and-kinross-united-kingdom', 'basename' => 'ui-ux-design-agency-in-perth-and-kinross-united-kingdom'],
  ['name' => 'Poole', 'url' => '/ui-ux-design-agency-in-poole-united-kingdom', 'basename' => 'ui-ux-design-agency-in-poole-united-kingdom'],
  ['name' => 'Powys', 'url' => '/ui-ux-design-agency-in-powys-united-kingdom', 'basename' => 'ui-ux-design-agency-in-powys-united-kingdom'],
  ['name' => 'Reading', 'url' => '/ui-ux-design-agency-in-reading-united-kingdom', 'basename' => 'ui-ux-design-agency-in-reading-united-kingdom'],
  ['name' => 'Redcar and Cleveland', 'url' => '/ui-ux-design-agency-in-redcar-and-cleveland-united-kingdom', 'basename' => 'ui-ux-design-agency-in-redcar-and-cleveland-united-kingdom'],
  ['name' => 'Renfrewshire', 'url' => '/ui-ux-design-agency-in-renfrewshire-united-kingdom', 'basename' => 'ui-ux-design-agency-in-renfrewshire-united-kingdom'],
  ['name' => 'Rhondda Cynon Taf', 'url' => '/ui-ux-design-agency-in-rhondda-cynon-taf-united-kingdom', 'basename' => 'ui-ux-design-agency-in-rhondda-cynon-taf-united-kingdom'],
  ['name' => 'Rochdale', 'url' => '/ui-ux-design-agency-in-rochdale-united-kingdom', 'basename' => 'ui-ux-design-agency-in-rochdale-united-kingdom'],
  ['name' => 'Rotherham', 'url' => '/ui-ux-design-agency-in-rotherham-united-kingdom', 'basename' => 'ui-ux-design-agency-in-rotherham-united-kingdom'],
  ['name' => 'Royal Borough of Greenwich', 'url' => '/ui-ux-design-agency-in-royal-borough-of-greenwich-united-kingdom', 'basename' => 'ui-ux-design-agency-in-royal-borough-of-greenwich-united-kingdom'],
  ['name' => 'Royal Borough of Kensington and Chelsea', 'url' => '/ui-ux-design-agency-in-royal-borough-of-kensington-and-chelsea-united-kingdom', 'basename' => 'ui-ux-design-agency-in-royal-borough-of-kensington-and-chelsea-united-kingdom'],
  ['name' => 'Royal Borough of Kingston upon Thames', 'url' => '/ui-ux-design-agency-in-royal-borough-of-kingston-upon-thames-united-kingdom', 'basename' => 'ui-ux-design-agency-in-royal-borough-of-kingston-upon-thames-united-kingdom'],
  ['name' => 'Rutland', 'url' => '/ui-ux-design-agency-in-rutland-united-kingdom', 'basename' => 'ui-ux-design-agency-in-rutland-united-kingdom'],
  ['name' => 'Saint Helena', 'url' => '/ui-ux-design-agency-in-saint-helena-united-kingdom', 'basename' => 'ui-ux-design-agency-in-saint-helena-united-kingdom'],
  ['name' => 'Salford', 'url' => '/ui-ux-design-agency-in-salford-united-kingdom', 'basename' => 'ui-ux-design-agency-in-salford-united-kingdom'],
  ['name' => 'Sandwell', 'url' => '/ui-ux-design-agency-in-sandwell-united-kingdom', 'basename' => 'ui-ux-design-agency-in-sandwell-united-kingdom'],
  ['name' => 'Scotland', 'url' => '/ui-ux-design-agency-in-scotland-united-kingdom', 'basename' => 'ui-ux-design-agency-in-scotland-united-kingdom'],
  ['name' => 'Scottish Borders', 'url' => '/ui-ux-design-agency-in-scottish-borders-united-kingdom', 'basename' => 'ui-ux-design-agency-in-scottish-borders-united-kingdom'],
  ['name' => 'Sefton', 'url' => '/ui-ux-design-agency-in-sefton-united-kingdom', 'basename' => 'ui-ux-design-agency-in-sefton-united-kingdom'],
  ['name' => 'Sheffield', 'url' => '/ui-ux-design-agency-in-sheffield-united-kingdom', 'basename' => 'ui-ux-design-agency-in-sheffield-united-kingdom'],
  ['name' => 'Shetland Islands', 'url' => '/ui-ux-design-agency-in-shetland-islands-united-kingdom', 'basename' => 'ui-ux-design-agency-in-shetland-islands-united-kingdom'],
  ['name' => 'Shropshire', 'url' => '/ui-ux-design-agency-in-shropshire-united-kingdom', 'basename' => 'ui-ux-design-agency-in-shropshire-united-kingdom'],
  ['name' => 'Slough', 'url' => '/ui-ux-design-agency-in-slough-united-kingdom', 'basename' => 'ui-ux-design-agency-in-slough-united-kingdom'],
  ['name' => 'Solihull', 'url' => '/ui-ux-design-agency-in-solihull-united-kingdom', 'basename' => 'ui-ux-design-agency-in-solihull-united-kingdom'],
  ['name' => 'Somerset', 'url' => '/ui-ux-design-agency-in-somerset-united-kingdom', 'basename' => 'ui-ux-design-agency-in-somerset-united-kingdom'],
  ['name' => 'South Ayrshire', 'url' => '/ui-ux-design-agency-in-south-ayrshire-united-kingdom', 'basename' => 'ui-ux-design-agency-in-south-ayrshire-united-kingdom'],
  ['name' => 'South Gloucestershire', 'url' => '/ui-ux-design-agency-in-south-gloucestershire-united-kingdom', 'basename' => 'ui-ux-design-agency-in-south-gloucestershire-united-kingdom'],
  ['name' => 'South Lanarkshire', 'url' => '/ui-ux-design-agency-in-south-lanarkshire-united-kingdom', 'basename' => 'ui-ux-design-agency-in-south-lanarkshire-united-kingdom'],
  ['name' => 'South Tyneside', 'url' => '/ui-ux-design-agency-in-south-tyneside-united-kingdom', 'basename' => 'ui-ux-design-agency-in-south-tyneside-united-kingdom'],
  ['name' => 'Southend-on-Sea', 'url' => '/ui-ux-design-agency-in-southend-on-sea-united-kingdom', 'basename' => 'ui-ux-design-agency-in-southend-on-sea-united-kingdom'],
  ['name' => 'St Helens', 'url' => '/ui-ux-design-agency-in-st-helens-united-kingdom', 'basename' => 'ui-ux-design-agency-in-st-helens-united-kingdom'],
  ['name' => 'Staffordshire', 'url' => '/ui-ux-design-agency-in-staffordshire-united-kingdom', 'basename' => 'ui-ux-design-agency-in-staffordshire-united-kingdom'],
  ['name' => 'Stirling', 'url' => '/ui-ux-design-agency-in-stirling-united-kingdom', 'basename' => 'ui-ux-design-agency-in-stirling-united-kingdom'],
  ['name' => 'Stockport', 'url' => '/ui-ux-design-agency-in-stockport-united-kingdom', 'basename' => 'ui-ux-design-agency-in-stockport-united-kingdom'],
  ['name' => 'Stockton-on-Tees', 'url' => '/ui-ux-design-agency-in-stockton-on-tees-united-kingdom', 'basename' => 'ui-ux-design-agency-in-stockton-on-tees-united-kingdom'],
  ['name' => 'Strabane District Council', 'url' => '/ui-ux-design-agency-in-strabane-district-council-united-kingdom', 'basename' => 'ui-ux-design-agency-in-strabane-district-council-united-kingdom'],
  ['name' => 'Suffolk', 'url' => '/ui-ux-design-agency-in-suffolk-united-kingdom', 'basename' => 'ui-ux-design-agency-in-suffolk-united-kingdom'],
  ['name' => 'Surrey', 'url' => '/ui-ux-design-agency-in-surrey-united-kingdom', 'basename' => 'ui-ux-design-agency-in-surrey-united-kingdom'],
  ['name' => 'Swindon', 'url' => '/ui-ux-design-agency-in-swindon-united-kingdom', 'basename' => 'ui-ux-design-agency-in-swindon-united-kingdom'],
  ['name' => 'Tameside', 'url' => '/ui-ux-design-agency-in-tameside-united-kingdom', 'basename' => 'ui-ux-design-agency-in-tameside-united-kingdom'],
  ['name' => 'Telford and Wrekin', 'url' => '/ui-ux-design-agency-in-telford-and-wrekin-united-kingdom', 'basename' => 'ui-ux-design-agency-in-telford-and-wrekin-united-kingdom'],
  ['name' => 'Thurrock', 'url' => '/ui-ux-design-agency-in-thurrock-united-kingdom', 'basename' => 'ui-ux-design-agency-in-thurrock-united-kingdom'],
  ['name' => 'Torbay', 'url' => '/ui-ux-design-agency-in-torbay-united-kingdom', 'basename' => 'ui-ux-design-agency-in-torbay-united-kingdom'],
  ['name' => 'Torfaen', 'url' => '/ui-ux-design-agency-in-torfaen-united-kingdom', 'basename' => 'ui-ux-design-agency-in-torfaen-united-kingdom'],
  ['name' => 'Trafford', 'url' => '/ui-ux-design-agency-in-trafford-united-kingdom', 'basename' => 'ui-ux-design-agency-in-trafford-united-kingdom'],
  ['name' => 'Vale of Glamorgan', 'url' => '/ui-ux-design-agency-in-vale-of-glamorgan-united-kingdom', 'basename' => 'ui-ux-design-agency-in-vale-of-glamorgan-united-kingdom'],
  ['name' => 'Wakefield', 'url' => '/ui-ux-design-agency-in-wakefield-united-kingdom', 'basename' => 'ui-ux-design-agency-in-wakefield-united-kingdom'],
  ['name' => 'Wales', 'url' => '/ui-ux-design-agency-in-wales-united-kingdom', 'basename' => 'ui-ux-design-agency-in-wales-united-kingdom'],
  ['name' => 'Walsall', 'url' => '/ui-ux-design-agency-in-walsall-united-kingdom', 'basename' => 'ui-ux-design-agency-in-walsall-united-kingdom'],
  ['name' => 'Warrington', 'url' => '/ui-ux-design-agency-in-warrington-united-kingdom', 'basename' => 'ui-ux-design-agency-in-warrington-united-kingdom'],
  ['name' => 'Warwickshire', 'url' => '/ui-ux-design-agency-in-warwickshire-united-kingdom', 'basename' => 'ui-ux-design-agency-in-warwickshire-united-kingdom'],
  ['name' => 'West Berkshire', 'url' => '/ui-ux-design-agency-in-west-berkshire-united-kingdom', 'basename' => 'ui-ux-design-agency-in-west-berkshire-united-kingdom'],
  ['name' => 'West Dunbartonshire', 'url' => '/ui-ux-design-agency-in-west-dunbartonshire-united-kingdom', 'basename' => 'ui-ux-design-agency-in-west-dunbartonshire-united-kingdom'],
  ['name' => 'West Lothian', 'url' => '/ui-ux-design-agency-in-west-lothian-united-kingdom', 'basename' => 'ui-ux-design-agency-in-west-lothian-united-kingdom'],
  ['name' => 'West Sussex', 'url' => '/ui-ux-design-agency-in-west-sussex-united-kingdom', 'basename' => 'ui-ux-design-agency-in-west-sussex-united-kingdom'],
  ['name' => 'Wiltshire', 'url' => '/ui-ux-design-agency-in-wiltshire-united-kingdom', 'basename' => 'ui-ux-design-agency-in-wiltshire-united-kingdom'],
  ['name' => 'Windsor and Maidenhead', 'url' => '/ui-ux-design-agency-in-windsor-and-maidenhead-united-kingdom', 'basename' => 'ui-ux-design-agency-in-windsor-and-maidenhead-united-kingdom'],
  ['name' => 'Wirral', 'url' => '/ui-ux-design-agency-in-wirral-united-kingdom', 'basename' => 'ui-ux-design-agency-in-wirral-united-kingdom'],
  ['name' => 'Wokingham', 'url' => '/ui-ux-design-agency-in-wokingham-united-kingdom', 'basename' => 'ui-ux-design-agency-in-wokingham-united-kingdom'],
  ['name' => 'Worcestershire', 'url' => '/ui-ux-design-agency-in-worcestershire-united-kingdom', 'basename' => 'ui-ux-design-agency-in-worcestershire-united-kingdom'],
  ['name' => 'Wrexham County Borough', 'url' => '/ui-ux-design-agency-in-wrexham-county-borough-united-kingdom', 'basename' => 'ui-ux-design-agency-in-wrexham-county-borough-united-kingdom'],
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

    <!-- ── Hub: Browse all regions in United Kingdom ── -->
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
      <h2>Browse UI/UX Design Services Across United Kingdom</h2>
      <p class="hub-sub">We serve 246 regions, states, and cities in United Kingdom. Select a location to see how UX Pacific can help your business.</p>
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