<?php
require_once __DIR__ . '/includes/cms_repository.php';

$countrySlug = 'italy';

$featuredProjects   = get_published_projects('all', true);
$ecosystemHomeItems = get_published_ecosystem();

function home_image_url(?string $url): string {
  $url = trim((string) $url);
  if ($url === '') return uxp_normalize_stored_media_url('img/ux.webp');
  if (preg_match('#^https?://#i', $url)) return $url;
  return uxp_normalize_stored_media_url($url);
}

$pageTitle   = 'UI UX Design Agency in Italy | UX Pacific';
$pageDesc    = 'UX Pacific delivers expert UI/UX design services across Italy. Browse our locations or book a free UX audit today.';
$canonicalUrl = 'https://www.uxpacific.com/ui-ux-design-agency-in-italy';
$ogTitle     = 'UI UX Design Agency in Italy | UX Pacific';
$ogDesc      = 'UX Pacific delivers expert UI/UX design services across Italy. Browse our locations or book a free UX audit today.';
$ogUrl       = 'https://www.uxpacific.com/ui-ux-design-agency-in-italy';
$currentPage = 'Home';

// Schema: WebPage + BreadcrumbList
$ldJson = json_encode([
  '@context' => 'https://schema.org',
  '@graph'   => [
    ['@type' => 'WebPage',
     'url'   => 'https://www.uxpacific.com/ui-ux-design-agency-in-italy',
     'name'  => 'UI UX Design Agency in Italy | UX Pacific',
     'inLanguage' => 'en',
    ],
    ['@type' => 'BreadcrumbList',
     'itemListElement' => [
       ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home',       'item' => BASE_URL . '/'],
       ['@type' => 'ListItem', 'position' => 2, 'name' => 'Italy', 'item' => 'https://www.uxpacific.com/ui-ux-design-agency-in-italy'],
     ],
    ],
  ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

$geoPage = uxp_geo_page($countrySlug);
if ($geoPage) {
  if (!empty($geoPage['page_title']))      { $pageTitle = (string) $geoPage['page_title']; $ogTitle = $pageTitle; }
  if (!empty($geoPage['meta_description'])) { $pageDesc  = (string) $geoPage['meta_description']; $ogDesc = $pageDesc; }
}

// Child locations in Italy
$hubChildren = [
  ['name' => 'Abruzzo', 'url' => '/ui-ux-design-agency-in-abruzzo-italy', 'basename' => 'ui-ux-design-agency-in-abruzzo-italy'],
  ['name' => 'Aosta Valley', 'url' => '/ui-ux-design-agency-in-aosta-valley-italy', 'basename' => 'ui-ux-design-agency-in-aosta-valley-italy'],
  ['name' => 'Apulia', 'url' => '/ui-ux-design-agency-in-apulia-italy', 'basename' => 'ui-ux-design-agency-in-apulia-italy'],
  ['name' => 'Basilicata', 'url' => '/ui-ux-design-agency-in-basilicata-italy', 'basename' => 'ui-ux-design-agency-in-basilicata-italy'],
  ['name' => 'Benevento Province', 'url' => '/ui-ux-design-agency-in-benevento-province-italy', 'basename' => 'ui-ux-design-agency-in-benevento-province-italy'],
  ['name' => 'Calabria', 'url' => '/ui-ux-design-agency-in-calabria-italy', 'basename' => 'ui-ux-design-agency-in-calabria-italy'],
  ['name' => 'Campania', 'url' => '/ui-ux-design-agency-in-campania-italy', 'basename' => 'ui-ux-design-agency-in-campania-italy'],
  ['name' => 'Emilia-Romagna', 'url' => '/ui-ux-design-agency-in-emilia-romagna-italy', 'basename' => 'ui-ux-design-agency-in-emilia-romagna-italy'],
  ['name' => 'Friuli–Venezia Giulia', 'url' => '/ui-ux-design-agency-in-friuli-venezia-giulia-italy', 'basename' => 'ui-ux-design-agency-in-friuli-venezia-giulia-italy'],
  ['name' => 'Lazio', 'url' => '/ui-ux-design-agency-in-lazio-italy', 'basename' => 'ui-ux-design-agency-in-lazio-italy'],
  ['name' => 'Libero consorzio comunale di Agrigento', 'url' => '/ui-ux-design-agency-in-libero-consorzio-comunale-di-agrigento-italy', 'basename' => 'ui-ux-design-agency-in-libero-consorzio-comunale-di-agrigento-italy'],
  ['name' => 'Libero consorzio comunale di Caltanissetta', 'url' => '/ui-ux-design-agency-in-libero-consorzio-comunale-di-caltanissetta-italy', 'basename' => 'ui-ux-design-agency-in-libero-consorzio-comunale-di-caltanissetta-italy'],
  ['name' => 'Libero consorzio comunale di Enna', 'url' => '/ui-ux-design-agency-in-libero-consorzio-comunale-di-enna-italy', 'basename' => 'ui-ux-design-agency-in-libero-consorzio-comunale-di-enna-italy'],
  ['name' => 'Libero consorzio comunale di Ragusa', 'url' => '/ui-ux-design-agency-in-libero-consorzio-comunale-di-ragusa-italy', 'basename' => 'ui-ux-design-agency-in-libero-consorzio-comunale-di-ragusa-italy'],
  ['name' => 'Libero consorzio comunale di Siracusa', 'url' => '/ui-ux-design-agency-in-libero-consorzio-comunale-di-siracusa-italy', 'basename' => 'ui-ux-design-agency-in-libero-consorzio-comunale-di-siracusa-italy'],
  ['name' => 'Libero consorzio comunale di Trapani', 'url' => '/ui-ux-design-agency-in-libero-consorzio-comunale-di-trapani-italy', 'basename' => 'ui-ux-design-agency-in-libero-consorzio-comunale-di-trapani-italy'],
  ['name' => 'Liguria', 'url' => '/ui-ux-design-agency-in-liguria-italy', 'basename' => 'ui-ux-design-agency-in-liguria-italy'],
  ['name' => 'Lombardy', 'url' => '/ui-ux-design-agency-in-lombardy-italy', 'basename' => 'ui-ux-design-agency-in-lombardy-italy'],
  ['name' => 'Marche', 'url' => '/ui-ux-design-agency-in-marche-italy', 'basename' => 'ui-ux-design-agency-in-marche-italy'],
  ['name' => 'Metropolitan City of Bari', 'url' => '/ui-ux-design-agency-in-metropolitan-city-of-bari-italy', 'basename' => 'ui-ux-design-agency-in-metropolitan-city-of-bari-italy'],
  ['name' => 'Metropolitan City of Bologna', 'url' => '/ui-ux-design-agency-in-metropolitan-city-of-bologna-italy', 'basename' => 'ui-ux-design-agency-in-metropolitan-city-of-bologna-italy'],
  ['name' => 'Metropolitan City of Cagliari', 'url' => '/ui-ux-design-agency-in-metropolitan-city-of-cagliari-italy', 'basename' => 'ui-ux-design-agency-in-metropolitan-city-of-cagliari-italy'],
  ['name' => 'Metropolitan City of Catania', 'url' => '/ui-ux-design-agency-in-metropolitan-city-of-catania-italy', 'basename' => 'ui-ux-design-agency-in-metropolitan-city-of-catania-italy'],
  ['name' => 'Metropolitan City of Florence', 'url' => '/ui-ux-design-agency-in-metropolitan-city-of-florence-italy', 'basename' => 'ui-ux-design-agency-in-metropolitan-city-of-florence-italy'],
  ['name' => 'Metropolitan City of Genoa', 'url' => '/ui-ux-design-agency-in-metropolitan-city-of-genoa-italy', 'basename' => 'ui-ux-design-agency-in-metropolitan-city-of-genoa-italy'],
  ['name' => 'Metropolitan City of Messina', 'url' => '/ui-ux-design-agency-in-metropolitan-city-of-messina-italy', 'basename' => 'ui-ux-design-agency-in-metropolitan-city-of-messina-italy'],
  ['name' => 'Metropolitan City of Milan', 'url' => '/ui-ux-design-agency-in-metropolitan-city-of-milan-italy', 'basename' => 'ui-ux-design-agency-in-metropolitan-city-of-milan-italy'],
  ['name' => 'Metropolitan City of Naples', 'url' => '/ui-ux-design-agency-in-metropolitan-city-of-naples-italy', 'basename' => 'ui-ux-design-agency-in-metropolitan-city-of-naples-italy'],
  ['name' => 'Metropolitan City of Palermo', 'url' => '/ui-ux-design-agency-in-metropolitan-city-of-palermo-italy', 'basename' => 'ui-ux-design-agency-in-metropolitan-city-of-palermo-italy'],
  ['name' => 'Metropolitan City of Reggio Calabria', 'url' => '/ui-ux-design-agency-in-metropolitan-city-of-reggio-calabria-italy', 'basename' => 'ui-ux-design-agency-in-metropolitan-city-of-reggio-calabria-italy'],
  ['name' => 'Metropolitan City of Rome', 'url' => '/ui-ux-design-agency-in-metropolitan-city-of-rome-italy', 'basename' => 'ui-ux-design-agency-in-metropolitan-city-of-rome-italy'],
  ['name' => 'Metropolitan City of Turin', 'url' => '/ui-ux-design-agency-in-metropolitan-city-of-turin-italy', 'basename' => 'ui-ux-design-agency-in-metropolitan-city-of-turin-italy'],
  ['name' => 'Metropolitan City of Venice', 'url' => '/ui-ux-design-agency-in-metropolitan-city-of-venice-italy', 'basename' => 'ui-ux-design-agency-in-metropolitan-city-of-venice-italy'],
  ['name' => 'Molise', 'url' => '/ui-ux-design-agency-in-molise-italy', 'basename' => 'ui-ux-design-agency-in-molise-italy'],
  ['name' => 'Pesaro and Urbino Province', 'url' => '/ui-ux-design-agency-in-pesaro-and-urbino-province-italy', 'basename' => 'ui-ux-design-agency-in-pesaro-and-urbino-province-italy'],
  ['name' => 'Piedmont', 'url' => '/ui-ux-design-agency-in-piedmont-italy', 'basename' => 'ui-ux-design-agency-in-piedmont-italy'],
  ['name' => 'Province of Alessandria', 'url' => '/ui-ux-design-agency-in-province-of-alessandria-italy', 'basename' => 'ui-ux-design-agency-in-province-of-alessandria-italy'],
  ['name' => 'Province of Ancona', 'url' => '/ui-ux-design-agency-in-province-of-ancona-italy', 'basename' => 'ui-ux-design-agency-in-province-of-ancona-italy'],
  ['name' => 'Province of Ascoli Piceno', 'url' => '/ui-ux-design-agency-in-province-of-ascoli-piceno-italy', 'basename' => 'ui-ux-design-agency-in-province-of-ascoli-piceno-italy'],
  ['name' => 'Province of Asti', 'url' => '/ui-ux-design-agency-in-province-of-asti-italy', 'basename' => 'ui-ux-design-agency-in-province-of-asti-italy'],
  ['name' => 'Province of Avellino', 'url' => '/ui-ux-design-agency-in-province-of-avellino-italy', 'basename' => 'ui-ux-design-agency-in-province-of-avellino-italy'],
  ['name' => 'Province of Barletta-Andria-Trani', 'url' => '/ui-ux-design-agency-in-province-of-barletta-andria-trani-italy', 'basename' => 'ui-ux-design-agency-in-province-of-barletta-andria-trani-italy'],
  ['name' => 'Province of Belluno', 'url' => '/ui-ux-design-agency-in-province-of-belluno-italy', 'basename' => 'ui-ux-design-agency-in-province-of-belluno-italy'],
  ['name' => 'Province of Bergamo', 'url' => '/ui-ux-design-agency-in-province-of-bergamo-italy', 'basename' => 'ui-ux-design-agency-in-province-of-bergamo-italy'],
  ['name' => 'Province of Biella', 'url' => '/ui-ux-design-agency-in-province-of-biella-italy', 'basename' => 'ui-ux-design-agency-in-province-of-biella-italy'],
  ['name' => 'Province of Brescia', 'url' => '/ui-ux-design-agency-in-province-of-brescia-italy', 'basename' => 'ui-ux-design-agency-in-province-of-brescia-italy'],
  ['name' => 'Province of Brindisi', 'url' => '/ui-ux-design-agency-in-province-of-brindisi-italy', 'basename' => 'ui-ux-design-agency-in-province-of-brindisi-italy'],
  ['name' => 'Province of Campobasso', 'url' => '/ui-ux-design-agency-in-province-of-campobasso-italy', 'basename' => 'ui-ux-design-agency-in-province-of-campobasso-italy'],
  ['name' => 'Province of Carbonia-Iglesias', 'url' => '/ui-ux-design-agency-in-province-of-carbonia-iglesias-italy', 'basename' => 'ui-ux-design-agency-in-province-of-carbonia-iglesias-italy'],
  ['name' => 'Province of Caserta', 'url' => '/ui-ux-design-agency-in-province-of-caserta-italy', 'basename' => 'ui-ux-design-agency-in-province-of-caserta-italy'],
  ['name' => 'Province of Catanzaro', 'url' => '/ui-ux-design-agency-in-province-of-catanzaro-italy', 'basename' => 'ui-ux-design-agency-in-province-of-catanzaro-italy'],
  ['name' => 'Province of Chieti', 'url' => '/ui-ux-design-agency-in-province-of-chieti-italy', 'basename' => 'ui-ux-design-agency-in-province-of-chieti-italy'],
  ['name' => 'Province of Como', 'url' => '/ui-ux-design-agency-in-province-of-como-italy', 'basename' => 'ui-ux-design-agency-in-province-of-como-italy'],
  ['name' => 'Province of Cosenza', 'url' => '/ui-ux-design-agency-in-province-of-cosenza-italy', 'basename' => 'ui-ux-design-agency-in-province-of-cosenza-italy'],
  ['name' => 'Province of Cremona', 'url' => '/ui-ux-design-agency-in-province-of-cremona-italy', 'basename' => 'ui-ux-design-agency-in-province-of-cremona-italy'],
  ['name' => 'Province of Crotone', 'url' => '/ui-ux-design-agency-in-province-of-crotone-italy', 'basename' => 'ui-ux-design-agency-in-province-of-crotone-italy'],
  ['name' => 'Province of Cuneo', 'url' => '/ui-ux-design-agency-in-province-of-cuneo-italy', 'basename' => 'ui-ux-design-agency-in-province-of-cuneo-italy'],
  ['name' => 'Province of Fermo', 'url' => '/ui-ux-design-agency-in-province-of-fermo-italy', 'basename' => 'ui-ux-design-agency-in-province-of-fermo-italy'],
  ['name' => 'Province of Ferrara', 'url' => '/ui-ux-design-agency-in-province-of-ferrara-italy', 'basename' => 'ui-ux-design-agency-in-province-of-ferrara-italy'],
  ['name' => 'Province of Foggia', 'url' => '/ui-ux-design-agency-in-province-of-foggia-italy', 'basename' => 'ui-ux-design-agency-in-province-of-foggia-italy'],
  ['name' => 'Province of Forlì-Cesena', 'url' => '/ui-ux-design-agency-in-province-of-forli-cesena-italy', 'basename' => 'ui-ux-design-agency-in-province-of-forli-cesena-italy'],
  ['name' => 'Province of Frosinone', 'url' => '/ui-ux-design-agency-in-province-of-frosinone-italy', 'basename' => 'ui-ux-design-agency-in-province-of-frosinone-italy'],
  ['name' => 'Province of Gorizia', 'url' => '/ui-ux-design-agency-in-province-of-gorizia-italy', 'basename' => 'ui-ux-design-agency-in-province-of-gorizia-italy'],
  ['name' => 'Province of Grosseto', 'url' => '/ui-ux-design-agency-in-province-of-grosseto-italy', 'basename' => 'ui-ux-design-agency-in-province-of-grosseto-italy'],
  ['name' => 'Province of Imperia', 'url' => '/ui-ux-design-agency-in-province-of-imperia-italy', 'basename' => 'ui-ux-design-agency-in-province-of-imperia-italy'],
  ['name' => 'Province of Isernia', 'url' => '/ui-ux-design-agency-in-province-of-isernia-italy', 'basename' => 'ui-ux-design-agency-in-province-of-isernia-italy'],
  ['name' => 'Province of La Spezia', 'url' => '/ui-ux-design-agency-in-province-of-la-spezia-italy', 'basename' => 'ui-ux-design-agency-in-province-of-la-spezia-italy'],
  ['name' => 'Province of L\\\'Aquila', 'url' => '/ui-ux-design-agency-in-province-of-laquila-italy', 'basename' => 'ui-ux-design-agency-in-province-of-laquila-italy'],
  ['name' => 'Province of Latina', 'url' => '/ui-ux-design-agency-in-province-of-latina-italy', 'basename' => 'ui-ux-design-agency-in-province-of-latina-italy'],
  ['name' => 'Province of Lecce', 'url' => '/ui-ux-design-agency-in-province-of-lecce-italy', 'basename' => 'ui-ux-design-agency-in-province-of-lecce-italy'],
  ['name' => 'Province of Lecco', 'url' => '/ui-ux-design-agency-in-province-of-lecco-italy', 'basename' => 'ui-ux-design-agency-in-province-of-lecco-italy'],
  ['name' => 'Province of Livorno', 'url' => '/ui-ux-design-agency-in-province-of-livorno-italy', 'basename' => 'ui-ux-design-agency-in-province-of-livorno-italy'],
  ['name' => 'Province of Lodi', 'url' => '/ui-ux-design-agency-in-province-of-lodi-italy', 'basename' => 'ui-ux-design-agency-in-province-of-lodi-italy'],
  ['name' => 'Province of Lucca', 'url' => '/ui-ux-design-agency-in-province-of-lucca-italy', 'basename' => 'ui-ux-design-agency-in-province-of-lucca-italy'],
  ['name' => 'Province of Macerata', 'url' => '/ui-ux-design-agency-in-province-of-macerata-italy', 'basename' => 'ui-ux-design-agency-in-province-of-macerata-italy'],
  ['name' => 'Province of Mantua', 'url' => '/ui-ux-design-agency-in-province-of-mantua-italy', 'basename' => 'ui-ux-design-agency-in-province-of-mantua-italy'],
  ['name' => 'Province of Massa and Carrara', 'url' => '/ui-ux-design-agency-in-province-of-massa-and-carrara-italy', 'basename' => 'ui-ux-design-agency-in-province-of-massa-and-carrara-italy'],
  ['name' => 'Province of Matera', 'url' => '/ui-ux-design-agency-in-province-of-matera-italy', 'basename' => 'ui-ux-design-agency-in-province-of-matera-italy'],
  ['name' => 'Province of Medio Campidano', 'url' => '/ui-ux-design-agency-in-province-of-medio-campidano-italy', 'basename' => 'ui-ux-design-agency-in-province-of-medio-campidano-italy'],
  ['name' => 'Province of Modena', 'url' => '/ui-ux-design-agency-in-province-of-modena-italy', 'basename' => 'ui-ux-design-agency-in-province-of-modena-italy'],
  ['name' => 'Province of Monza and Brianza', 'url' => '/ui-ux-design-agency-in-province-of-monza-and-brianza-italy', 'basename' => 'ui-ux-design-agency-in-province-of-monza-and-brianza-italy'],
  ['name' => 'Province of Novara', 'url' => '/ui-ux-design-agency-in-province-of-novara-italy', 'basename' => 'ui-ux-design-agency-in-province-of-novara-italy'],
  ['name' => 'Province of Nuoro', 'url' => '/ui-ux-design-agency-in-province-of-nuoro-italy', 'basename' => 'ui-ux-design-agency-in-province-of-nuoro-italy'],
  ['name' => 'Province of Ogliastra', 'url' => '/ui-ux-design-agency-in-province-of-ogliastra-italy', 'basename' => 'ui-ux-design-agency-in-province-of-ogliastra-italy'],
  ['name' => 'Province of Olbia-Tempio', 'url' => '/ui-ux-design-agency-in-province-of-olbia-tempio-italy', 'basename' => 'ui-ux-design-agency-in-province-of-olbia-tempio-italy'],
  ['name' => 'Province of Oristano', 'url' => '/ui-ux-design-agency-in-province-of-oristano-italy', 'basename' => 'ui-ux-design-agency-in-province-of-oristano-italy'],
  ['name' => 'Province of Padua', 'url' => '/ui-ux-design-agency-in-province-of-padua-italy', 'basename' => 'ui-ux-design-agency-in-province-of-padua-italy'],
  ['name' => 'Province of Parma', 'url' => '/ui-ux-design-agency-in-province-of-parma-italy', 'basename' => 'ui-ux-design-agency-in-province-of-parma-italy'],
  ['name' => 'Province of Pavia', 'url' => '/ui-ux-design-agency-in-province-of-pavia-italy', 'basename' => 'ui-ux-design-agency-in-province-of-pavia-italy'],
  ['name' => 'Province of Perugia', 'url' => '/ui-ux-design-agency-in-province-of-perugia-italy', 'basename' => 'ui-ux-design-agency-in-province-of-perugia-italy'],
  ['name' => 'Province of Pescara', 'url' => '/ui-ux-design-agency-in-province-of-pescara-italy', 'basename' => 'ui-ux-design-agency-in-province-of-pescara-italy'],
  ['name' => 'Province of Piacenza', 'url' => '/ui-ux-design-agency-in-province-of-piacenza-italy', 'basename' => 'ui-ux-design-agency-in-province-of-piacenza-italy'],
  ['name' => 'Province of Pisa', 'url' => '/ui-ux-design-agency-in-province-of-pisa-italy', 'basename' => 'ui-ux-design-agency-in-province-of-pisa-italy'],
  ['name' => 'Province of Pistoia', 'url' => '/ui-ux-design-agency-in-province-of-pistoia-italy', 'basename' => 'ui-ux-design-agency-in-province-of-pistoia-italy'],
  ['name' => 'Province of Pordenone', 'url' => '/ui-ux-design-agency-in-province-of-pordenone-italy', 'basename' => 'ui-ux-design-agency-in-province-of-pordenone-italy'],
  ['name' => 'Province of Potenza', 'url' => '/ui-ux-design-agency-in-province-of-potenza-italy', 'basename' => 'ui-ux-design-agency-in-province-of-potenza-italy'],
  ['name' => 'Province of Prato', 'url' => '/ui-ux-design-agency-in-province-of-prato-italy', 'basename' => 'ui-ux-design-agency-in-province-of-prato-italy'],
  ['name' => 'Province of Ravenna', 'url' => '/ui-ux-design-agency-in-province-of-ravenna-italy', 'basename' => 'ui-ux-design-agency-in-province-of-ravenna-italy'],
  ['name' => 'Province of Reggio Emilia', 'url' => '/ui-ux-design-agency-in-province-of-reggio-emilia-italy', 'basename' => 'ui-ux-design-agency-in-province-of-reggio-emilia-italy'],
  ['name' => 'Province of Rieti', 'url' => '/ui-ux-design-agency-in-province-of-rieti-italy', 'basename' => 'ui-ux-design-agency-in-province-of-rieti-italy'],
  ['name' => 'Province of Rimini', 'url' => '/ui-ux-design-agency-in-province-of-rimini-italy', 'basename' => 'ui-ux-design-agency-in-province-of-rimini-italy'],
  ['name' => 'Province of Rovigo', 'url' => '/ui-ux-design-agency-in-province-of-rovigo-italy', 'basename' => 'ui-ux-design-agency-in-province-of-rovigo-italy'],
  ['name' => 'Province of Salerno', 'url' => '/ui-ux-design-agency-in-province-of-salerno-italy', 'basename' => 'ui-ux-design-agency-in-province-of-salerno-italy'],
  ['name' => 'Province of Sassari', 'url' => '/ui-ux-design-agency-in-province-of-sassari-italy', 'basename' => 'ui-ux-design-agency-in-province-of-sassari-italy'],
  ['name' => 'Province of Savona', 'url' => '/ui-ux-design-agency-in-province-of-savona-italy', 'basename' => 'ui-ux-design-agency-in-province-of-savona-italy'],
  ['name' => 'Province of Siena', 'url' => '/ui-ux-design-agency-in-province-of-siena-italy', 'basename' => 'ui-ux-design-agency-in-province-of-siena-italy'],
  ['name' => 'Province of Sondrio', 'url' => '/ui-ux-design-agency-in-province-of-sondrio-italy', 'basename' => 'ui-ux-design-agency-in-province-of-sondrio-italy'],
  ['name' => 'Province of Taranto', 'url' => '/ui-ux-design-agency-in-province-of-taranto-italy', 'basename' => 'ui-ux-design-agency-in-province-of-taranto-italy'],
  ['name' => 'Province of Teramo', 'url' => '/ui-ux-design-agency-in-province-of-teramo-italy', 'basename' => 'ui-ux-design-agency-in-province-of-teramo-italy'],
  ['name' => 'Province of Terni', 'url' => '/ui-ux-design-agency-in-province-of-terni-italy', 'basename' => 'ui-ux-design-agency-in-province-of-terni-italy'],
  ['name' => 'Province of Treviso', 'url' => '/ui-ux-design-agency-in-province-of-treviso-italy', 'basename' => 'ui-ux-design-agency-in-province-of-treviso-italy'],
  ['name' => 'Province of Trieste', 'url' => '/ui-ux-design-agency-in-province-of-trieste-italy', 'basename' => 'ui-ux-design-agency-in-province-of-trieste-italy'],
  ['name' => 'Province of Udine', 'url' => '/ui-ux-design-agency-in-province-of-udine-italy', 'basename' => 'ui-ux-design-agency-in-province-of-udine-italy'],
  ['name' => 'Province of Varese', 'url' => '/ui-ux-design-agency-in-province-of-varese-italy', 'basename' => 'ui-ux-design-agency-in-province-of-varese-italy'],
  ['name' => 'Province of Verbano-Cusio-Ossola', 'url' => '/ui-ux-design-agency-in-province-of-verbano-cusio-ossola-italy', 'basename' => 'ui-ux-design-agency-in-province-of-verbano-cusio-ossola-italy'],
  ['name' => 'Province of Vercelli', 'url' => '/ui-ux-design-agency-in-province-of-vercelli-italy', 'basename' => 'ui-ux-design-agency-in-province-of-vercelli-italy'],
  ['name' => 'Province of Verona', 'url' => '/ui-ux-design-agency-in-province-of-verona-italy', 'basename' => 'ui-ux-design-agency-in-province-of-verona-italy'],
  ['name' => 'Province of Vibo Valentia', 'url' => '/ui-ux-design-agency-in-province-of-vibo-valentia-italy', 'basename' => 'ui-ux-design-agency-in-province-of-vibo-valentia-italy'],
  ['name' => 'Province of Vicenza', 'url' => '/ui-ux-design-agency-in-province-of-vicenza-italy', 'basename' => 'ui-ux-design-agency-in-province-of-vicenza-italy'],
  ['name' => 'Province of Viterbo', 'url' => '/ui-ux-design-agency-in-province-of-viterbo-italy', 'basename' => 'ui-ux-design-agency-in-province-of-viterbo-italy'],
  ['name' => 'Sardinia', 'url' => '/ui-ux-design-agency-in-sardinia-italy', 'basename' => 'ui-ux-design-agency-in-sardinia-italy'],
  ['name' => 'Sicily', 'url' => '/ui-ux-design-agency-in-sicily-italy', 'basename' => 'ui-ux-design-agency-in-sicily-italy'],
  ['name' => 'South Tyrol', 'url' => '/ui-ux-design-agency-in-south-tyrol-italy', 'basename' => 'ui-ux-design-agency-in-south-tyrol-italy'],
  ['name' => 'Trentino', 'url' => '/ui-ux-design-agency-in-trentino-italy', 'basename' => 'ui-ux-design-agency-in-trentino-italy'],
  ['name' => 'Trentino-South Tyrol', 'url' => '/ui-ux-design-agency-in-trentino-south-tyrol-italy', 'basename' => 'ui-ux-design-agency-in-trentino-south-tyrol-italy'],
  ['name' => 'Tuscany', 'url' => '/ui-ux-design-agency-in-tuscany-italy', 'basename' => 'ui-ux-design-agency-in-tuscany-italy'],
  ['name' => 'Umbria', 'url' => '/ui-ux-design-agency-in-umbria-italy', 'basename' => 'ui-ux-design-agency-in-umbria-italy'],
  ['name' => 'Veneto', 'url' => '/ui-ux-design-agency-in-veneto-italy', 'basename' => 'ui-ux-design-agency-in-veneto-italy'],
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

    <!-- ── Hub: Browse all regions in Italy ── -->
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
      <h2>Browse UI/UX Design Services Across Italy</h2>
      <p class="hub-sub">We serve 128 regions, states, and cities in Italy. Select a location to see how UX Pacific can help your business.</p>
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