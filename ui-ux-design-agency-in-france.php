<?php
require_once __DIR__ . '/includes/cms_repository.php';

$countrySlug = 'france';

$featuredProjects   = get_published_projects('all', true);
$ecosystemHomeItems = get_published_ecosystem();

function home_image_url(?string $url): string {
  $url = trim((string) $url);
  if ($url === '') return uxp_normalize_stored_media_url('img/ux.webp');
  if (preg_match('#^https?://#i', $url)) return $url;
  return uxp_normalize_stored_media_url($url);
}

$pageTitle   = 'UI UX Design Agency in France | UX Pacific';
$pageDesc    = 'UX Pacific delivers expert UI/UX design services across France. Browse our locations or book a free UX audit today.';
$canonicalUrl = 'https://www.uxpacific.com/ui-ux-design-agency-in-france';
$ogTitle     = 'UI UX Design Agency in France | UX Pacific';
$ogDesc      = 'UX Pacific delivers expert UI/UX design services across France. Browse our locations or book a free UX audit today.';
$ogUrl       = 'https://www.uxpacific.com/ui-ux-design-agency-in-france';
$currentPage = 'Home';

// Schema: WebPage + BreadcrumbList
$ldJson = json_encode([
  '@context' => 'https://schema.org',
  '@graph'   => [
    ['@type' => 'WebPage',
     'url'   => 'https://www.uxpacific.com/ui-ux-design-agency-in-france',
     'name'  => 'UI UX Design Agency in France | UX Pacific',
     'inLanguage' => 'en',
    ],
    ['@type' => 'BreadcrumbList',
     'itemListElement' => [
       ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home',       'item' => BASE_URL . '/'],
       ['@type' => 'ListItem', 'position' => 2, 'name' => 'France', 'item' => 'https://www.uxpacific.com/ui-ux-design-agency-in-france'],
     ],
    ],
  ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

$geoPage = uxp_geo_page($countrySlug);
if ($geoPage) {
  if (!empty($geoPage['page_title']))      { $pageTitle = (string) $geoPage['page_title']; $ogTitle = $pageTitle; }
  if (!empty($geoPage['meta_description'])) { $pageDesc  = (string) $geoPage['meta_description']; $ogDesc = $pageDesc; }
}

// Child locations in France
$hubChildren = [
  ['name' => 'Ain', 'url' => '/ui-ux-design-agency-in-ain-france', 'basename' => 'ui-ux-design-agency-in-ain-france'],
  ['name' => 'Aisne', 'url' => '/ui-ux-design-agency-in-aisne-france', 'basename' => 'ui-ux-design-agency-in-aisne-france'],
  ['name' => 'Allier', 'url' => '/ui-ux-design-agency-in-allier-france', 'basename' => 'ui-ux-design-agency-in-allier-france'],
  ['name' => 'Alpes-de-Haute-Provence', 'url' => '/ui-ux-design-agency-in-alpes-de-haute-provence-france', 'basename' => 'ui-ux-design-agency-in-alpes-de-haute-provence-france'],
  ['name' => 'Alpes-Maritimes', 'url' => '/ui-ux-design-agency-in-alpes-maritimes-france', 'basename' => 'ui-ux-design-agency-in-alpes-maritimes-france'],
  ['name' => 'Alsace', 'url' => '/ui-ux-design-agency-in-alsace-france', 'basename' => 'ui-ux-design-agency-in-alsace-france'],
  ['name' => 'Ardèche', 'url' => '/ui-ux-design-agency-in-ardeche-france', 'basename' => 'ui-ux-design-agency-in-ardeche-france'],
  ['name' => 'Ardennes', 'url' => '/ui-ux-design-agency-in-ardennes-france', 'basename' => 'ui-ux-design-agency-in-ardennes-france'],
  ['name' => 'Ariège', 'url' => '/ui-ux-design-agency-in-ariege-france', 'basename' => 'ui-ux-design-agency-in-ariege-france'],
  ['name' => 'Aube', 'url' => '/ui-ux-design-agency-in-aube-france', 'basename' => 'ui-ux-design-agency-in-aube-france'],
  ['name' => 'Aude', 'url' => '/ui-ux-design-agency-in-aude-france', 'basename' => 'ui-ux-design-agency-in-aude-france'],
  ['name' => 'Auvergne-Rhône-Alpes', 'url' => '/ui-ux-design-agency-in-auvergne-rhone-alpes-france', 'basename' => 'ui-ux-design-agency-in-auvergne-rhone-alpes-france'],
  ['name' => 'Aveyron', 'url' => '/ui-ux-design-agency-in-aveyron-france', 'basename' => 'ui-ux-design-agency-in-aveyron-france'],
  ['name' => 'Bas-Rhin', 'url' => '/ui-ux-design-agency-in-bas-rhin-france', 'basename' => 'ui-ux-design-agency-in-bas-rhin-france'],
  ['name' => 'Bouches-du-Rhône', 'url' => '/ui-ux-design-agency-in-bouches-du-rhone-france', 'basename' => 'ui-ux-design-agency-in-bouches-du-rhone-france'],
  ['name' => 'Bourgogne-Franche-Comté', 'url' => '/ui-ux-design-agency-in-bourgogne-franche-comte-france', 'basename' => 'ui-ux-design-agency-in-bourgogne-franche-comte-france'],
  ['name' => 'Bretagne', 'url' => '/ui-ux-design-agency-in-bretagne-france', 'basename' => 'ui-ux-design-agency-in-bretagne-france'],
  ['name' => 'Calvados', 'url' => '/ui-ux-design-agency-in-calvados-france', 'basename' => 'ui-ux-design-agency-in-calvados-france'],
  ['name' => 'Cantal', 'url' => '/ui-ux-design-agency-in-cantal-france', 'basename' => 'ui-ux-design-agency-in-cantal-france'],
  ['name' => 'Centre-Val de Loire', 'url' => '/ui-ux-design-agency-in-centre-val-de-loire-france', 'basename' => 'ui-ux-design-agency-in-centre-val-de-loire-france'],
  ['name' => 'Charente', 'url' => '/ui-ux-design-agency-in-charente-france', 'basename' => 'ui-ux-design-agency-in-charente-france'],
  ['name' => 'Charente-Maritime', 'url' => '/ui-ux-design-agency-in-charente-maritime-france', 'basename' => 'ui-ux-design-agency-in-charente-maritime-france'],
  ['name' => 'Cher', 'url' => '/ui-ux-design-agency-in-cher-france', 'basename' => 'ui-ux-design-agency-in-cher-france'],
  ['name' => 'Clipperton', 'url' => '/ui-ux-design-agency-in-clipperton-france', 'basename' => 'ui-ux-design-agency-in-clipperton-france'],
  ['name' => 'Corrèze', 'url' => '/ui-ux-design-agency-in-correze-france', 'basename' => 'ui-ux-design-agency-in-correze-france'],
  ['name' => 'Corse-du-Sud', 'url' => '/ui-ux-design-agency-in-corse-du-sud-france', 'basename' => 'ui-ux-design-agency-in-corse-du-sud-france'],
  ['name' => 'Corse', 'url' => '/ui-ux-design-agency-in-corse-france', 'basename' => 'ui-ux-design-agency-in-corse-france'],
  ['name' => 'Côte-d\\\'Or', 'url' => '/ui-ux-design-agency-in-cote-dor-france', 'basename' => 'ui-ux-design-agency-in-cote-dor-france'],
  ['name' => 'Côtes-d\\\'Armor', 'url' => '/ui-ux-design-agency-in-cotes-darmor-france', 'basename' => 'ui-ux-design-agency-in-cotes-darmor-france'],
  ['name' => 'Creuse', 'url' => '/ui-ux-design-agency-in-creuse-france', 'basename' => 'ui-ux-design-agency-in-creuse-france'],
  ['name' => 'Deux-Sèvres', 'url' => '/ui-ux-design-agency-in-deux-sevres-france', 'basename' => 'ui-ux-design-agency-in-deux-sevres-france'],
  ['name' => 'Dordogne', 'url' => '/ui-ux-design-agency-in-dordogne-france', 'basename' => 'ui-ux-design-agency-in-dordogne-france'],
  ['name' => 'Doubs', 'url' => '/ui-ux-design-agency-in-doubs-france', 'basename' => 'ui-ux-design-agency-in-doubs-france'],
  ['name' => 'Drôme', 'url' => '/ui-ux-design-agency-in-drome-france', 'basename' => 'ui-ux-design-agency-in-drome-france'],
  ['name' => 'Essonne', 'url' => '/ui-ux-design-agency-in-essonne-france', 'basename' => 'ui-ux-design-agency-in-essonne-france'],
  ['name' => 'Eure-et-Loir', 'url' => '/ui-ux-design-agency-in-eure-et-loir-france', 'basename' => 'ui-ux-design-agency-in-eure-et-loir-france'],
  ['name' => 'Eure', 'url' => '/ui-ux-design-agency-in-eure-france', 'basename' => 'ui-ux-design-agency-in-eure-france'],
  ['name' => 'Finistère', 'url' => '/ui-ux-design-agency-in-finistere-france', 'basename' => 'ui-ux-design-agency-in-finistere-france'],
  ['name' => 'French Guiana', 'url' => '/ui-ux-design-agency-in-french-guiana-france', 'basename' => 'ui-ux-design-agency-in-french-guiana-france'],
  ['name' => 'French Polynesia', 'url' => '/ui-ux-design-agency-in-french-polynesia-france', 'basename' => 'ui-ux-design-agency-in-french-polynesia-france'],
  ['name' => 'French Southern and Antarctic Lands', 'url' => '/ui-ux-design-agency-in-french-southern-and-antarctic-lands-france', 'basename' => 'ui-ux-design-agency-in-french-southern-and-antarctic-lands-france'],
  ['name' => 'Gard', 'url' => '/ui-ux-design-agency-in-gard-france', 'basename' => 'ui-ux-design-agency-in-gard-france'],
  ['name' => 'Gers', 'url' => '/ui-ux-design-agency-in-gers-france', 'basename' => 'ui-ux-design-agency-in-gers-france'],
  ['name' => 'Gironde', 'url' => '/ui-ux-design-agency-in-gironde-france', 'basename' => 'ui-ux-design-agency-in-gironde-france'],
  ['name' => 'Grand-Est', 'url' => '/ui-ux-design-agency-in-grand-est-france', 'basename' => 'ui-ux-design-agency-in-grand-est-france'],
  ['name' => 'Guadeloupe', 'url' => '/ui-ux-design-agency-in-guadeloupe-france', 'basename' => 'ui-ux-design-agency-in-guadeloupe-france'],
  ['name' => 'Haut-Rhin', 'url' => '/ui-ux-design-agency-in-haut-rhin-france', 'basename' => 'ui-ux-design-agency-in-haut-rhin-france'],
  ['name' => 'Haute-Corse', 'url' => '/ui-ux-design-agency-in-haute-corse-france', 'basename' => 'ui-ux-design-agency-in-haute-corse-france'],
  ['name' => 'Haute-Garonne', 'url' => '/ui-ux-design-agency-in-haute-garonne-france', 'basename' => 'ui-ux-design-agency-in-haute-garonne-france'],
  ['name' => 'Haute-Loire', 'url' => '/ui-ux-design-agency-in-haute-loire-france', 'basename' => 'ui-ux-design-agency-in-haute-loire-france'],
  ['name' => 'Haute-Marne', 'url' => '/ui-ux-design-agency-in-haute-marne-france', 'basename' => 'ui-ux-design-agency-in-haute-marne-france'],
  ['name' => 'Haute-Saône', 'url' => '/ui-ux-design-agency-in-haute-saone-france', 'basename' => 'ui-ux-design-agency-in-haute-saone-france'],
  ['name' => 'Haute-Savoie', 'url' => '/ui-ux-design-agency-in-haute-savoie-france', 'basename' => 'ui-ux-design-agency-in-haute-savoie-france'],
  ['name' => 'Haute-Vienne', 'url' => '/ui-ux-design-agency-in-haute-vienne-france', 'basename' => 'ui-ux-design-agency-in-haute-vienne-france'],
  ['name' => 'Hautes-Alpes', 'url' => '/ui-ux-design-agency-in-hautes-alpes-france', 'basename' => 'ui-ux-design-agency-in-hautes-alpes-france'],
  ['name' => 'Hautes-Pyrénées', 'url' => '/ui-ux-design-agency-in-hautes-pyrenees-france', 'basename' => 'ui-ux-design-agency-in-hautes-pyrenees-france'],
  ['name' => 'Hauts-de-France', 'url' => '/ui-ux-design-agency-in-hauts-de-france-france', 'basename' => 'ui-ux-design-agency-in-hauts-de-france-france'],
  ['name' => 'Hauts-de-Seine', 'url' => '/ui-ux-design-agency-in-hauts-de-seine-france', 'basename' => 'ui-ux-design-agency-in-hauts-de-seine-france'],
  ['name' => 'Hérault', 'url' => '/ui-ux-design-agency-in-herault-france', 'basename' => 'ui-ux-design-agency-in-herault-france'],
  ['name' => 'Île-de-France', 'url' => '/ui-ux-design-agency-in-ile-de-france-france', 'basename' => 'ui-ux-design-agency-in-ile-de-france-france'],
  ['name' => 'Ille-et-Vilaine', 'url' => '/ui-ux-design-agency-in-ille-et-vilaine-france', 'basename' => 'ui-ux-design-agency-in-ille-et-vilaine-france'],
  ['name' => 'Indre-et-Loire', 'url' => '/ui-ux-design-agency-in-indre-et-loire-france', 'basename' => 'ui-ux-design-agency-in-indre-et-loire-france'],
  ['name' => 'Indre', 'url' => '/ui-ux-design-agency-in-indre-france', 'basename' => 'ui-ux-design-agency-in-indre-france'],
  ['name' => 'Isère', 'url' => '/ui-ux-design-agency-in-isere-france', 'basename' => 'ui-ux-design-agency-in-isere-france'],
  ['name' => 'Jura', 'url' => '/ui-ux-design-agency-in-jura-france', 'basename' => 'ui-ux-design-agency-in-jura-france'],
  ['name' => 'La Réunion', 'url' => '/ui-ux-design-agency-in-la-reunion-france', 'basename' => 'ui-ux-design-agency-in-la-reunion-france'],
  ['name' => 'Landes', 'url' => '/ui-ux-design-agency-in-landes-france', 'basename' => 'ui-ux-design-agency-in-landes-france'],
  ['name' => 'Loir-et-Cher', 'url' => '/ui-ux-design-agency-in-loir-et-cher-france', 'basename' => 'ui-ux-design-agency-in-loir-et-cher-france'],
  ['name' => 'Loire-Atlantique', 'url' => '/ui-ux-design-agency-in-loire-atlantique-france', 'basename' => 'ui-ux-design-agency-in-loire-atlantique-france'],
  ['name' => 'Loire', 'url' => '/ui-ux-design-agency-in-loire-france', 'basename' => 'ui-ux-design-agency-in-loire-france'],
  ['name' => 'Loiret', 'url' => '/ui-ux-design-agency-in-loiret-france', 'basename' => 'ui-ux-design-agency-in-loiret-france'],
  ['name' => 'Lot-et-Garonne', 'url' => '/ui-ux-design-agency-in-lot-et-garonne-france', 'basename' => 'ui-ux-design-agency-in-lot-et-garonne-france'],
  ['name' => 'Lot', 'url' => '/ui-ux-design-agency-in-lot-france', 'basename' => 'ui-ux-design-agency-in-lot-france'],
  ['name' => 'Lozère', 'url' => '/ui-ux-design-agency-in-lozere-france', 'basename' => 'ui-ux-design-agency-in-lozere-france'],
  ['name' => 'Maine-et-Loire', 'url' => '/ui-ux-design-agency-in-maine-et-loire-france', 'basename' => 'ui-ux-design-agency-in-maine-et-loire-france'],
  ['name' => 'Manche', 'url' => '/ui-ux-design-agency-in-manche-france', 'basename' => 'ui-ux-design-agency-in-manche-france'],
  ['name' => 'Marne', 'url' => '/ui-ux-design-agency-in-marne-france', 'basename' => 'ui-ux-design-agency-in-marne-france'],
  ['name' => 'Martinique', 'url' => '/ui-ux-design-agency-in-martinique-france', 'basename' => 'ui-ux-design-agency-in-martinique-france'],
  ['name' => 'Mayenne', 'url' => '/ui-ux-design-agency-in-mayenne-france', 'basename' => 'ui-ux-design-agency-in-mayenne-france'],
  ['name' => 'Mayotte', 'url' => '/ui-ux-design-agency-in-mayotte-france', 'basename' => 'ui-ux-design-agency-in-mayotte-france'],
  ['name' => 'Métropole de Lyon', 'url' => '/ui-ux-design-agency-in-metropole-de-lyon-france', 'basename' => 'ui-ux-design-agency-in-metropole-de-lyon-france'],
  ['name' => 'Meurthe-et-Moselle', 'url' => '/ui-ux-design-agency-in-meurthe-et-moselle-france', 'basename' => 'ui-ux-design-agency-in-meurthe-et-moselle-france'],
  ['name' => 'Meuse', 'url' => '/ui-ux-design-agency-in-meuse-france', 'basename' => 'ui-ux-design-agency-in-meuse-france'],
  ['name' => 'Morbihan', 'url' => '/ui-ux-design-agency-in-morbihan-france', 'basename' => 'ui-ux-design-agency-in-morbihan-france'],
  ['name' => 'Moselle', 'url' => '/ui-ux-design-agency-in-moselle-france', 'basename' => 'ui-ux-design-agency-in-moselle-france'],
  ['name' => 'Nièvre', 'url' => '/ui-ux-design-agency-in-nievre-france', 'basename' => 'ui-ux-design-agency-in-nievre-france'],
  ['name' => 'Nord', 'url' => '/ui-ux-design-agency-in-nord-france', 'basename' => 'ui-ux-design-agency-in-nord-france'],
  ['name' => 'Normandie', 'url' => '/ui-ux-design-agency-in-normandie-france', 'basename' => 'ui-ux-design-agency-in-normandie-france'],
  ['name' => 'Nouvelle-Aquitaine', 'url' => '/ui-ux-design-agency-in-nouvelle-aquitaine-france', 'basename' => 'ui-ux-design-agency-in-nouvelle-aquitaine-france'],
  ['name' => 'Occitanie', 'url' => '/ui-ux-design-agency-in-occitanie-france', 'basename' => 'ui-ux-design-agency-in-occitanie-france'],
  ['name' => 'Oise', 'url' => '/ui-ux-design-agency-in-oise-france', 'basename' => 'ui-ux-design-agency-in-oise-france'],
  ['name' => 'Orne', 'url' => '/ui-ux-design-agency-in-orne-france', 'basename' => 'ui-ux-design-agency-in-orne-france'],
  ['name' => 'Paris', 'url' => '/ui-ux-design-agency-in-paris-france', 'basename' => 'ui-ux-design-agency-in-paris-france'],
  ['name' => 'Pas-de-Calais', 'url' => '/ui-ux-design-agency-in-pas-de-calais-france', 'basename' => 'ui-ux-design-agency-in-pas-de-calais-france'],
  ['name' => 'Pays-de-la-Loire', 'url' => '/ui-ux-design-agency-in-pays-de-la-loire-france', 'basename' => 'ui-ux-design-agency-in-pays-de-la-loire-france'],
  ['name' => 'Provence-Alpes-Côte-d’Azur', 'url' => '/ui-ux-design-agency-in-provence-alpes-cote-d-azur-france', 'basename' => 'ui-ux-design-agency-in-provence-alpes-cote-d-azur-france'],
  ['name' => 'Puy-de-Dôme', 'url' => '/ui-ux-design-agency-in-puy-de-dome-france', 'basename' => 'ui-ux-design-agency-in-puy-de-dome-france'],
  ['name' => 'Pyrénées-Atlantiques', 'url' => '/ui-ux-design-agency-in-pyrenees-atlantiques-france', 'basename' => 'ui-ux-design-agency-in-pyrenees-atlantiques-france'],
  ['name' => 'Pyrénées-Orientales', 'url' => '/ui-ux-design-agency-in-pyrenees-orientales-france', 'basename' => 'ui-ux-design-agency-in-pyrenees-orientales-france'],
  ['name' => 'Rhône', 'url' => '/ui-ux-design-agency-in-rhone-france', 'basename' => 'ui-ux-design-agency-in-rhone-france'],
  ['name' => 'Saint-Barthélemy', 'url' => '/ui-ux-design-agency-in-saint-barthelemy-france', 'basename' => 'ui-ux-design-agency-in-saint-barthelemy-france'],
  ['name' => 'Saint-Martin', 'url' => '/ui-ux-design-agency-in-saint-martin-france', 'basename' => 'ui-ux-design-agency-in-saint-martin-france'],
  ['name' => 'Saint Pierre and Miquelon', 'url' => '/ui-ux-design-agency-in-saint-pierre-and-miquelon-france', 'basename' => 'ui-ux-design-agency-in-saint-pierre-and-miquelon-france'],
  ['name' => 'Saône-et-Loire', 'url' => '/ui-ux-design-agency-in-saone-et-loire-france', 'basename' => 'ui-ux-design-agency-in-saone-et-loire-france'],
  ['name' => 'Sarthe', 'url' => '/ui-ux-design-agency-in-sarthe-france', 'basename' => 'ui-ux-design-agency-in-sarthe-france'],
  ['name' => 'Savoie', 'url' => '/ui-ux-design-agency-in-savoie-france', 'basename' => 'ui-ux-design-agency-in-savoie-france'],
  ['name' => 'Seine-et-Marne', 'url' => '/ui-ux-design-agency-in-seine-et-marne-france', 'basename' => 'ui-ux-design-agency-in-seine-et-marne-france'],
  ['name' => 'Seine-Maritime', 'url' => '/ui-ux-design-agency-in-seine-maritime-france', 'basename' => 'ui-ux-design-agency-in-seine-maritime-france'],
  ['name' => 'Seine-Saint-Denis', 'url' => '/ui-ux-design-agency-in-seine-saint-denis-france', 'basename' => 'ui-ux-design-agency-in-seine-saint-denis-france'],
  ['name' => 'Somme', 'url' => '/ui-ux-design-agency-in-somme-france', 'basename' => 'ui-ux-design-agency-in-somme-france'],
  ['name' => 'Tarn-et-Garonne', 'url' => '/ui-ux-design-agency-in-tarn-et-garonne-france', 'basename' => 'ui-ux-design-agency-in-tarn-et-garonne-france'],
  ['name' => 'Tarn', 'url' => '/ui-ux-design-agency-in-tarn-france', 'basename' => 'ui-ux-design-agency-in-tarn-france'],
  ['name' => 'Territoire de Belfort', 'url' => '/ui-ux-design-agency-in-territoire-de-belfort-france', 'basename' => 'ui-ux-design-agency-in-territoire-de-belfort-france'],
  ['name' => 'Val-de-Marne', 'url' => '/ui-ux-design-agency-in-val-de-marne-france', 'basename' => 'ui-ux-design-agency-in-val-de-marne-france'],
  ['name' => 'Val-d\\\'Oise', 'url' => '/ui-ux-design-agency-in-val-doise-france', 'basename' => 'ui-ux-design-agency-in-val-doise-france'],
  ['name' => 'Var', 'url' => '/ui-ux-design-agency-in-var-france', 'basename' => 'ui-ux-design-agency-in-var-france'],
  ['name' => 'Vaucluse', 'url' => '/ui-ux-design-agency-in-vaucluse-france', 'basename' => 'ui-ux-design-agency-in-vaucluse-france'],
  ['name' => 'Vendée', 'url' => '/ui-ux-design-agency-in-vendee-france', 'basename' => 'ui-ux-design-agency-in-vendee-france'],
  ['name' => 'Vienne', 'url' => '/ui-ux-design-agency-in-vienne-france', 'basename' => 'ui-ux-design-agency-in-vienne-france'],
  ['name' => 'Vosges', 'url' => '/ui-ux-design-agency-in-vosges-france', 'basename' => 'ui-ux-design-agency-in-vosges-france'],
  ['name' => 'Wallis and Futuna', 'url' => '/ui-ux-design-agency-in-wallis-and-futuna-france', 'basename' => 'ui-ux-design-agency-in-wallis-and-futuna-france'],
  ['name' => 'Yonne', 'url' => '/ui-ux-design-agency-in-yonne-france', 'basename' => 'ui-ux-design-agency-in-yonne-france'],
  ['name' => 'Yvelines', 'url' => '/ui-ux-design-agency-in-yvelines-france', 'basename' => 'ui-ux-design-agency-in-yvelines-france'],
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

    <!-- ── Hub: Browse all regions in France ── -->
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
      <h2>Browse UI/UX Design Services Across France</h2>
      <p class="hub-sub">We serve 123 regions, states, and cities in France. Select a location to see how UX Pacific can help your business.</p>
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