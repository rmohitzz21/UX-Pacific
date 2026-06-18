<?php
require_once __DIR__ . '/includes/cms_repository.php';

$countrySlug = 'slovenia';

$featuredProjects   = get_published_projects('all', true);
$ecosystemHomeItems = get_published_ecosystem();

function home_image_url(?string $url): string {
  $url = trim((string) $url);
  if ($url === '') return uxp_normalize_stored_media_url('img/ux.webp');
  if (preg_match('#^https?://#i', $url)) return $url;
  return uxp_normalize_stored_media_url($url);
}

$pageTitle   = 'UI UX Design Agency in Slovenia | UX Pacific';
$pageDesc    = 'UX Pacific delivers expert UI/UX design services across Slovenia. Browse our locations or book a free UX audit today.';
$canonicalUrl = 'https://www.uxpacific.com/ui-ux-design-agency-in-slovenia';
$ogTitle     = 'UI UX Design Agency in Slovenia | UX Pacific';
$ogDesc      = 'UX Pacific delivers expert UI/UX design services across Slovenia. Browse our locations or book a free UX audit today.';
$ogUrl       = 'https://www.uxpacific.com/ui-ux-design-agency-in-slovenia';
$currentPage = 'Home';

// Schema: WebPage + BreadcrumbList
$ldJson = json_encode([
  '@context' => 'https://schema.org',
  '@graph'   => [
    ['@type' => 'WebPage',
     'url'   => 'https://www.uxpacific.com/ui-ux-design-agency-in-slovenia',
     'name'  => 'UI UX Design Agency in Slovenia | UX Pacific',
     'inLanguage' => 'en',
    ],
    ['@type' => 'BreadcrumbList',
     'itemListElement' => [
       ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home',       'item' => BASE_URL . '/'],
       ['@type' => 'ListItem', 'position' => 2, 'name' => 'Slovenia', 'item' => 'https://www.uxpacific.com/ui-ux-design-agency-in-slovenia'],
     ],
    ],
  ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

$geoPage = uxp_geo_page($countrySlug);
if ($geoPage) {
  if (!empty($geoPage['page_title']))      { $pageTitle = (string) $geoPage['page_title']; $ogTitle = $pageTitle; }
  if (!empty($geoPage['meta_description'])) { $pageDesc  = (string) $geoPage['meta_description']; $ogDesc = $pageDesc; }
}

// Child locations in Slovenia
$hubChildren = [
  ['name' => 'Ajdovščina Municipality', 'url' => '/ui-ux-design-agency-in-ajdovscina-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-ajdovscina-municipality-slovenia'],
  ['name' => 'Ankaran Municipality', 'url' => '/ui-ux-design-agency-in-ankaran-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-ankaran-municipality-slovenia'],
  ['name' => 'Beltinci Municipality', 'url' => '/ui-ux-design-agency-in-beltinci-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-beltinci-municipality-slovenia'],
  ['name' => 'Benedikt Municipality', 'url' => '/ui-ux-design-agency-in-benedikt-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-benedikt-municipality-slovenia'],
  ['name' => 'Bistrica ob Sotli Municipality', 'url' => '/ui-ux-design-agency-in-bistrica-ob-sotli-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-bistrica-ob-sotli-municipality-slovenia'],
  ['name' => 'Bled Municipality', 'url' => '/ui-ux-design-agency-in-bled-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-bled-municipality-slovenia'],
  ['name' => 'Bloke Municipality', 'url' => '/ui-ux-design-agency-in-bloke-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-bloke-municipality-slovenia'],
  ['name' => 'Bohinj Municipality', 'url' => '/ui-ux-design-agency-in-bohinj-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-bohinj-municipality-slovenia'],
  ['name' => 'Borovnica Municipality', 'url' => '/ui-ux-design-agency-in-borovnica-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-borovnica-municipality-slovenia'],
  ['name' => 'Bovec Municipality', 'url' => '/ui-ux-design-agency-in-bovec-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-bovec-municipality-slovenia'],
  ['name' => 'Braslovče Municipality', 'url' => '/ui-ux-design-agency-in-braslovce-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-braslovce-municipality-slovenia'],
  ['name' => 'Brda Municipality', 'url' => '/ui-ux-design-agency-in-brda-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-brda-municipality-slovenia'],
  ['name' => 'Brežice Municipality', 'url' => '/ui-ux-design-agency-in-brezice-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-brezice-municipality-slovenia'],
  ['name' => 'Brezovica Municipality', 'url' => '/ui-ux-design-agency-in-brezovica-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-brezovica-municipality-slovenia'],
  ['name' => 'Cankova Municipality', 'url' => '/ui-ux-design-agency-in-cankova-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-cankova-municipality-slovenia'],
  ['name' => 'Cerklje na Gorenjskem Municipality', 'url' => '/ui-ux-design-agency-in-cerklje-na-gorenjskem-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-cerklje-na-gorenjskem-municipality-slovenia'],
  ['name' => 'Cerknica Municipality', 'url' => '/ui-ux-design-agency-in-cerknica-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-cerknica-municipality-slovenia'],
  ['name' => 'Cerkno Municipality', 'url' => '/ui-ux-design-agency-in-cerkno-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-cerkno-municipality-slovenia'],
  ['name' => 'Cerkvenjak Municipality', 'url' => '/ui-ux-design-agency-in-cerkvenjak-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-cerkvenjak-municipality-slovenia'],
  ['name' => 'City Municipality of Celje', 'url' => '/ui-ux-design-agency-in-city-municipality-of-celje-slovenia', 'basename' => 'ui-ux-design-agency-in-city-municipality-of-celje-slovenia'],
  ['name' => 'City Municipality of Novo Mesto', 'url' => '/ui-ux-design-agency-in-city-municipality-of-novo-mesto-slovenia', 'basename' => 'ui-ux-design-agency-in-city-municipality-of-novo-mesto-slovenia'],
  ['name' => 'Črenšovci Municipality', 'url' => '/ui-ux-design-agency-in-crensovci-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-crensovci-municipality-slovenia'],
  ['name' => 'Črna na Koroškem Municipality', 'url' => '/ui-ux-design-agency-in-crna-na-koroskem-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-crna-na-koroskem-municipality-slovenia'],
  ['name' => 'Črnomelj Municipality', 'url' => '/ui-ux-design-agency-in-crnomelj-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-crnomelj-municipality-slovenia'],
  ['name' => 'Destrnik Municipality', 'url' => '/ui-ux-design-agency-in-destrnik-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-destrnik-municipality-slovenia'],
  ['name' => 'Divača Municipality', 'url' => '/ui-ux-design-agency-in-divaca-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-divaca-municipality-slovenia'],
  ['name' => 'Dobje Municipality', 'url' => '/ui-ux-design-agency-in-dobje-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-dobje-municipality-slovenia'],
  ['name' => 'Dobrepolje Municipality', 'url' => '/ui-ux-design-agency-in-dobrepolje-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-dobrepolje-municipality-slovenia'],
  ['name' => 'Dobrna Municipality', 'url' => '/ui-ux-design-agency-in-dobrna-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-dobrna-municipality-slovenia'],
  ['name' => 'Dobrova–Polhov Gradec Municipality', 'url' => '/ui-ux-design-agency-in-dobrova-polhov-gradec-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-dobrova-polhov-gradec-municipality-slovenia'],
  ['name' => 'Dobrovnik Municipality', 'url' => '/ui-ux-design-agency-in-dobrovnik-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-dobrovnik-municipality-slovenia'],
  ['name' => 'Dol pri Ljubljani Municipality', 'url' => '/ui-ux-design-agency-in-dol-pri-ljubljani-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-dol-pri-ljubljani-municipality-slovenia'],
  ['name' => 'Dolenjske Toplice Municipality', 'url' => '/ui-ux-design-agency-in-dolenjske-toplice-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-dolenjske-toplice-municipality-slovenia'],
  ['name' => 'Domžale Municipality', 'url' => '/ui-ux-design-agency-in-domzale-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-domzale-municipality-slovenia'],
  ['name' => 'Dornava Municipality', 'url' => '/ui-ux-design-agency-in-dornava-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-dornava-municipality-slovenia'],
  ['name' => 'Dravograd Municipality', 'url' => '/ui-ux-design-agency-in-dravograd-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-dravograd-municipality-slovenia'],
  ['name' => 'Duplek Municipality', 'url' => '/ui-ux-design-agency-in-duplek-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-duplek-municipality-slovenia'],
  ['name' => 'Gorenja Vas–Poljane Municipality', 'url' => '/ui-ux-design-agency-in-gorenja-vas-poljane-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-gorenja-vas-poljane-municipality-slovenia'],
  ['name' => 'Gorišnica Municipality', 'url' => '/ui-ux-design-agency-in-gorisnica-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-gorisnica-municipality-slovenia'],
  ['name' => 'Gorje Municipality', 'url' => '/ui-ux-design-agency-in-gorje-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-gorje-municipality-slovenia'],
  ['name' => 'Gornja Radgona Municipality', 'url' => '/ui-ux-design-agency-in-gornja-radgona-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-gornja-radgona-municipality-slovenia'],
  ['name' => 'Gornji Grad Municipality', 'url' => '/ui-ux-design-agency-in-gornji-grad-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-gornji-grad-municipality-slovenia'],
  ['name' => 'Gornji Petrovci Municipality', 'url' => '/ui-ux-design-agency-in-gornji-petrovci-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-gornji-petrovci-municipality-slovenia'],
  ['name' => 'Grad Municipality', 'url' => '/ui-ux-design-agency-in-grad-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-grad-municipality-slovenia'],
  ['name' => 'Grosuplje Municipality', 'url' => '/ui-ux-design-agency-in-grosuplje-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-grosuplje-municipality-slovenia'],
  ['name' => 'Hajdina Municipality', 'url' => '/ui-ux-design-agency-in-hajdina-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-hajdina-municipality-slovenia'],
  ['name' => 'Hoče–Slivnica Municipality', 'url' => '/ui-ux-design-agency-in-hoce-slivnica-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-hoce-slivnica-municipality-slovenia'],
  ['name' => 'Hodoš Municipality', 'url' => '/ui-ux-design-agency-in-hodos-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-hodos-municipality-slovenia'],
  ['name' => 'Horjul Municipality', 'url' => '/ui-ux-design-agency-in-horjul-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-horjul-municipality-slovenia'],
  ['name' => 'Hrastnik Municipality', 'url' => '/ui-ux-design-agency-in-hrastnik-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-hrastnik-municipality-slovenia'],
  ['name' => 'Hrpelje–Kozina Municipality', 'url' => '/ui-ux-design-agency-in-hrpelje-kozina-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-hrpelje-kozina-municipality-slovenia'],
  ['name' => 'Idrija Municipality', 'url' => '/ui-ux-design-agency-in-idrija-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-idrija-municipality-slovenia'],
  ['name' => 'Ig Municipality', 'url' => '/ui-ux-design-agency-in-ig-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-ig-municipality-slovenia'],
  ['name' => 'Ivančna Gorica Municipality', 'url' => '/ui-ux-design-agency-in-ivancna-gorica-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-ivancna-gorica-municipality-slovenia'],
  ['name' => 'Izola Municipality', 'url' => '/ui-ux-design-agency-in-izola-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-izola-municipality-slovenia'],
  ['name' => 'Jesenice Municipality', 'url' => '/ui-ux-design-agency-in-jesenice-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-jesenice-municipality-slovenia'],
  ['name' => 'Jezersko Municipality', 'url' => '/ui-ux-design-agency-in-jezersko-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-jezersko-municipality-slovenia'],
  ['name' => 'Juršinci Municipality', 'url' => '/ui-ux-design-agency-in-jursinci-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-jursinci-municipality-slovenia'],
  ['name' => 'Kamnik Municipality', 'url' => '/ui-ux-design-agency-in-kamnik-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-kamnik-municipality-slovenia'],
  ['name' => 'Kanal ob Soči Municipality', 'url' => '/ui-ux-design-agency-in-kanal-ob-soci-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-kanal-ob-soci-municipality-slovenia'],
  ['name' => 'Kidričevo Municipality', 'url' => '/ui-ux-design-agency-in-kidricevo-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-kidricevo-municipality-slovenia'],
  ['name' => 'Kobarid Municipality', 'url' => '/ui-ux-design-agency-in-kobarid-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-kobarid-municipality-slovenia'],
  ['name' => 'Kobilje Municipality', 'url' => '/ui-ux-design-agency-in-kobilje-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-kobilje-municipality-slovenia'],
  ['name' => 'Kočevje Municipality', 'url' => '/ui-ux-design-agency-in-kocevje-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-kocevje-municipality-slovenia'],
  ['name' => 'Komen Municipality', 'url' => '/ui-ux-design-agency-in-komen-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-komen-municipality-slovenia'],
  ['name' => 'Komenda Municipality', 'url' => '/ui-ux-design-agency-in-komenda-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-komenda-municipality-slovenia'],
  ['name' => 'Koper City Municipality', 'url' => '/ui-ux-design-agency-in-koper-city-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-koper-city-municipality-slovenia'],
  ['name' => 'Kostanjevica na Krki Municipality', 'url' => '/ui-ux-design-agency-in-kostanjevica-na-krki-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-kostanjevica-na-krki-municipality-slovenia'],
  ['name' => 'Kostel Municipality', 'url' => '/ui-ux-design-agency-in-kostel-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-kostel-municipality-slovenia'],
  ['name' => 'Kozje Municipality', 'url' => '/ui-ux-design-agency-in-kozje-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-kozje-municipality-slovenia'],
  ['name' => 'Kranj City Municipality', 'url' => '/ui-ux-design-agency-in-kranj-city-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-kranj-city-municipality-slovenia'],
  ['name' => 'Kranjska Gora Municipality', 'url' => '/ui-ux-design-agency-in-kranjska-gora-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-kranjska-gora-municipality-slovenia'],
  ['name' => 'Križevci Municipality', 'url' => '/ui-ux-design-agency-in-krizevci-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-krizevci-municipality-slovenia'],
  ['name' => 'Kungota', 'url' => '/ui-ux-design-agency-in-kungota-slovenia', 'basename' => 'ui-ux-design-agency-in-kungota-slovenia'],
  ['name' => 'Kuzma Municipality', 'url' => '/ui-ux-design-agency-in-kuzma-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-kuzma-municipality-slovenia'],
  ['name' => 'Laško Municipality', 'url' => '/ui-ux-design-agency-in-lasko-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-lasko-municipality-slovenia'],
  ['name' => 'Lenart Municipality', 'url' => '/ui-ux-design-agency-in-lenart-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-lenart-municipality-slovenia'],
  ['name' => 'Lendava Municipality', 'url' => '/ui-ux-design-agency-in-lendava-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-lendava-municipality-slovenia'],
  ['name' => 'Litija Municipality', 'url' => '/ui-ux-design-agency-in-litija-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-litija-municipality-slovenia'],
  ['name' => 'Ljubljana City Municipality', 'url' => '/ui-ux-design-agency-in-ljubljana-city-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-ljubljana-city-municipality-slovenia'],
  ['name' => 'Ljubno Municipality', 'url' => '/ui-ux-design-agency-in-ljubno-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-ljubno-municipality-slovenia'],
  ['name' => 'Ljutomer Municipality', 'url' => '/ui-ux-design-agency-in-ljutomer-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-ljutomer-municipality-slovenia'],
  ['name' => 'Log–Dragomer Municipality', 'url' => '/ui-ux-design-agency-in-log-dragomer-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-log-dragomer-municipality-slovenia'],
  ['name' => 'Logatec Municipality', 'url' => '/ui-ux-design-agency-in-logatec-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-logatec-municipality-slovenia'],
  ['name' => 'Loška Dolina Municipality', 'url' => '/ui-ux-design-agency-in-loska-dolina-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-loska-dolina-municipality-slovenia'],
  ['name' => 'Loški Potok Municipality', 'url' => '/ui-ux-design-agency-in-loski-potok-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-loski-potok-municipality-slovenia'],
  ['name' => 'Lovrenc na Pohorju Municipality', 'url' => '/ui-ux-design-agency-in-lovrenc-na-pohorju-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-lovrenc-na-pohorju-municipality-slovenia'],
  ['name' => 'Luče Municipality', 'url' => '/ui-ux-design-agency-in-luce-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-luce-municipality-slovenia'],
  ['name' => 'Lukovica Municipality', 'url' => '/ui-ux-design-agency-in-lukovica-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-lukovica-municipality-slovenia'],
  ['name' => 'Majšperk Municipality', 'url' => '/ui-ux-design-agency-in-majsperk-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-majsperk-municipality-slovenia'],
  ['name' => 'Makole Municipality', 'url' => '/ui-ux-design-agency-in-makole-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-makole-municipality-slovenia'],
  ['name' => 'Maribor City Municipality', 'url' => '/ui-ux-design-agency-in-maribor-city-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-maribor-city-municipality-slovenia'],
  ['name' => 'Markovci Municipality', 'url' => '/ui-ux-design-agency-in-markovci-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-markovci-municipality-slovenia'],
  ['name' => 'Medvode Municipality', 'url' => '/ui-ux-design-agency-in-medvode-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-medvode-municipality-slovenia'],
  ['name' => 'Mengeš Municipality', 'url' => '/ui-ux-design-agency-in-menges-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-menges-municipality-slovenia'],
  ['name' => 'Metlika Municipality', 'url' => '/ui-ux-design-agency-in-metlika-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-metlika-municipality-slovenia'],
  ['name' => 'Mežica Municipality', 'url' => '/ui-ux-design-agency-in-mezica-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-mezica-municipality-slovenia'],
  ['name' => 'Miklavž na Dravskem Polju Municipality', 'url' => '/ui-ux-design-agency-in-miklavz-na-dravskem-polju-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-miklavz-na-dravskem-polju-municipality-slovenia'],
  ['name' => 'Miren–Kostanjevica Municipality', 'url' => '/ui-ux-design-agency-in-miren-kostanjevica-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-miren-kostanjevica-municipality-slovenia'],
  ['name' => 'Mirna Municipality', 'url' => '/ui-ux-design-agency-in-mirna-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-mirna-municipality-slovenia'],
  ['name' => 'Mirna Peč Municipality', 'url' => '/ui-ux-design-agency-in-mirna-pec-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-mirna-pec-municipality-slovenia'],
  ['name' => 'Mislinja Municipality', 'url' => '/ui-ux-design-agency-in-mislinja-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-mislinja-municipality-slovenia'],
  ['name' => 'Mokronog–Trebelno Municipality', 'url' => '/ui-ux-design-agency-in-mokronog-trebelno-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-mokronog-trebelno-municipality-slovenia'],
  ['name' => 'Moravče Municipality', 'url' => '/ui-ux-design-agency-in-moravce-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-moravce-municipality-slovenia'],
  ['name' => 'Moravske Toplice Municipality', 'url' => '/ui-ux-design-agency-in-moravske-toplice-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-moravske-toplice-municipality-slovenia'],
  ['name' => 'Mozirje Municipality', 'url' => '/ui-ux-design-agency-in-mozirje-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-mozirje-municipality-slovenia'],
  ['name' => 'Municipality of Apače', 'url' => '/ui-ux-design-agency-in-municipality-of-apace-slovenia', 'basename' => 'ui-ux-design-agency-in-municipality-of-apace-slovenia'],
  ['name' => 'Municipality of Cirkulane', 'url' => '/ui-ux-design-agency-in-municipality-of-cirkulane-slovenia', 'basename' => 'ui-ux-design-agency-in-municipality-of-cirkulane-slovenia'],
  ['name' => 'Municipality of Ilirska Bistrica', 'url' => '/ui-ux-design-agency-in-municipality-of-ilirska-bistrica-slovenia', 'basename' => 'ui-ux-design-agency-in-municipality-of-ilirska-bistrica-slovenia'],
  ['name' => 'Municipality of Krško', 'url' => '/ui-ux-design-agency-in-municipality-of-krsko-slovenia', 'basename' => 'ui-ux-design-agency-in-municipality-of-krsko-slovenia'],
  ['name' => 'Municipality of Škofljica', 'url' => '/ui-ux-design-agency-in-municipality-of-skofljica-slovenia', 'basename' => 'ui-ux-design-agency-in-municipality-of-skofljica-slovenia'],
  ['name' => 'Murska Sobota City Municipality', 'url' => '/ui-ux-design-agency-in-murska-sobota-city-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-murska-sobota-city-municipality-slovenia'],
  ['name' => 'Muta Municipality', 'url' => '/ui-ux-design-agency-in-muta-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-muta-municipality-slovenia'],
  ['name' => 'Naklo Municipality', 'url' => '/ui-ux-design-agency-in-naklo-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-naklo-municipality-slovenia'],
  ['name' => 'Nazarje Municipality', 'url' => '/ui-ux-design-agency-in-nazarje-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-nazarje-municipality-slovenia'],
  ['name' => 'Nova Gorica City Municipality', 'url' => '/ui-ux-design-agency-in-nova-gorica-city-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-nova-gorica-city-municipality-slovenia'],
  ['name' => 'Odranci Municipality', 'url' => '/ui-ux-design-agency-in-odranci-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-odranci-municipality-slovenia'],
  ['name' => 'Oplotnica', 'url' => '/ui-ux-design-agency-in-oplotnica-slovenia', 'basename' => 'ui-ux-design-agency-in-oplotnica-slovenia'],
  ['name' => 'Ormož Municipality', 'url' => '/ui-ux-design-agency-in-ormoz-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-ormoz-municipality-slovenia'],
  ['name' => 'Osilnica Municipality', 'url' => '/ui-ux-design-agency-in-osilnica-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-osilnica-municipality-slovenia'],
  ['name' => 'Pesnica Municipality', 'url' => '/ui-ux-design-agency-in-pesnica-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-pesnica-municipality-slovenia'],
  ['name' => 'Piran Municipality', 'url' => '/ui-ux-design-agency-in-piran-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-piran-municipality-slovenia'],
  ['name' => 'Pivka Municipality', 'url' => '/ui-ux-design-agency-in-pivka-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-pivka-municipality-slovenia'],
  ['name' => 'Podčetrtek Municipality', 'url' => '/ui-ux-design-agency-in-podcetrtek-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-podcetrtek-municipality-slovenia'],
  ['name' => 'Podlehnik Municipality', 'url' => '/ui-ux-design-agency-in-podlehnik-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-podlehnik-municipality-slovenia'],
  ['name' => 'Podvelka Municipality', 'url' => '/ui-ux-design-agency-in-podvelka-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-podvelka-municipality-slovenia'],
  ['name' => 'Poljčane Municipality', 'url' => '/ui-ux-design-agency-in-poljcane-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-poljcane-municipality-slovenia'],
  ['name' => 'Polzela Municipality', 'url' => '/ui-ux-design-agency-in-polzela-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-polzela-municipality-slovenia'],
  ['name' => 'Postojna Municipality', 'url' => '/ui-ux-design-agency-in-postojna-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-postojna-municipality-slovenia'],
  ['name' => 'Prebold Municipality', 'url' => '/ui-ux-design-agency-in-prebold-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-prebold-municipality-slovenia'],
  ['name' => 'Preddvor Municipality', 'url' => '/ui-ux-design-agency-in-preddvor-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-preddvor-municipality-slovenia'],
  ['name' => 'Prevalje Municipality', 'url' => '/ui-ux-design-agency-in-prevalje-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-prevalje-municipality-slovenia'],
  ['name' => 'Ptuj City Municipality', 'url' => '/ui-ux-design-agency-in-ptuj-city-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-ptuj-city-municipality-slovenia'],
  ['name' => 'Puconci Municipality', 'url' => '/ui-ux-design-agency-in-puconci-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-puconci-municipality-slovenia'],
  ['name' => 'Rače–Fram Municipality', 'url' => '/ui-ux-design-agency-in-race-fram-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-race-fram-municipality-slovenia'],
  ['name' => 'Radeče Municipality', 'url' => '/ui-ux-design-agency-in-radece-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-radece-municipality-slovenia'],
  ['name' => 'Radenci Municipality', 'url' => '/ui-ux-design-agency-in-radenci-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-radenci-municipality-slovenia'],
  ['name' => 'Radlje ob Dravi Municipality', 'url' => '/ui-ux-design-agency-in-radlje-ob-dravi-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-radlje-ob-dravi-municipality-slovenia'],
  ['name' => 'Radovljica Municipality', 'url' => '/ui-ux-design-agency-in-radovljica-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-radovljica-municipality-slovenia'],
  ['name' => 'Ravne na Koroškem Municipality', 'url' => '/ui-ux-design-agency-in-ravne-na-koroskem-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-ravne-na-koroskem-municipality-slovenia'],
  ['name' => 'Razkrižje Municipality', 'url' => '/ui-ux-design-agency-in-razkrizje-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-razkrizje-municipality-slovenia'],
  ['name' => 'Rečica ob Savinji Municipality', 'url' => '/ui-ux-design-agency-in-recica-ob-savinji-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-recica-ob-savinji-municipality-slovenia'],
  ['name' => 'Renče–Vogrsko Municipality', 'url' => '/ui-ux-design-agency-in-rence-vogrsko-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-rence-vogrsko-municipality-slovenia'],
  ['name' => 'Ribnica Municipality', 'url' => '/ui-ux-design-agency-in-ribnica-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-ribnica-municipality-slovenia'],
  ['name' => 'Ribnica na Pohorju Municipality', 'url' => '/ui-ux-design-agency-in-ribnica-na-pohorju-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-ribnica-na-pohorju-municipality-slovenia'],
  ['name' => 'Rogaška Slatina Municipality', 'url' => '/ui-ux-design-agency-in-rogaska-slatina-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-rogaska-slatina-municipality-slovenia'],
  ['name' => 'Rogašovci Municipality', 'url' => '/ui-ux-design-agency-in-rogasovci-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-rogasovci-municipality-slovenia'],
  ['name' => 'Rogatec Municipality', 'url' => '/ui-ux-design-agency-in-rogatec-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-rogatec-municipality-slovenia'],
  ['name' => 'Ruše Municipality', 'url' => '/ui-ux-design-agency-in-ruse-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-ruse-municipality-slovenia'],
  ['name' => 'Šalovci Municipality', 'url' => '/ui-ux-design-agency-in-salovci-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-salovci-municipality-slovenia'],
  ['name' => 'Selnica ob Dravi Municipality', 'url' => '/ui-ux-design-agency-in-selnica-ob-dravi-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-selnica-ob-dravi-municipality-slovenia'],
  ['name' => 'Semič Municipality', 'url' => '/ui-ux-design-agency-in-semic-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-semic-municipality-slovenia'],
  ['name' => 'Šempeter–Vrtojba Municipality', 'url' => '/ui-ux-design-agency-in-sempeter-vrtojba-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-sempeter-vrtojba-municipality-slovenia'],
  ['name' => 'Šenčur Municipality', 'url' => '/ui-ux-design-agency-in-sencur-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-sencur-municipality-slovenia'],
  ['name' => 'Šentilj Municipality', 'url' => '/ui-ux-design-agency-in-sentilj-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-sentilj-municipality-slovenia'],
  ['name' => 'Šentjernej Municipality', 'url' => '/ui-ux-design-agency-in-sentjernej-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-sentjernej-municipality-slovenia'],
  ['name' => 'Šentjur Municipality', 'url' => '/ui-ux-design-agency-in-sentjur-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-sentjur-municipality-slovenia'],
  ['name' => 'Šentrupert Municipality', 'url' => '/ui-ux-design-agency-in-sentrupert-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-sentrupert-municipality-slovenia'],
  ['name' => 'Sevnica Municipality', 'url' => '/ui-ux-design-agency-in-sevnica-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-sevnica-municipality-slovenia'],
  ['name' => 'Sežana Municipality', 'url' => '/ui-ux-design-agency-in-sezana-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-sezana-municipality-slovenia'],
  ['name' => 'Škocjan Municipality', 'url' => '/ui-ux-design-agency-in-skocjan-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-skocjan-municipality-slovenia'],
  ['name' => 'Škofja Loka Municipality', 'url' => '/ui-ux-design-agency-in-skofja-loka-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-skofja-loka-municipality-slovenia'],
  ['name' => 'Slovenj Gradec City Municipality', 'url' => '/ui-ux-design-agency-in-slovenj-gradec-city-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-slovenj-gradec-city-municipality-slovenia'],
  ['name' => 'Slovenska Bistrica Municipality', 'url' => '/ui-ux-design-agency-in-slovenska-bistrica-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-slovenska-bistrica-municipality-slovenia'],
  ['name' => 'Slovenske Konjice Municipality', 'url' => '/ui-ux-design-agency-in-slovenske-konjice-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-slovenske-konjice-municipality-slovenia'],
  ['name' => 'Šmarje pri Jelšah Municipality', 'url' => '/ui-ux-design-agency-in-smarje-pri-jelsah-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-smarje-pri-jelsah-municipality-slovenia'],
  ['name' => 'Šmarješke Toplice Municipality', 'url' => '/ui-ux-design-agency-in-smarjeske-toplice-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-smarjeske-toplice-municipality-slovenia'],
  ['name' => 'Šmartno ob Paki Municipality', 'url' => '/ui-ux-design-agency-in-smartno-ob-paki-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-smartno-ob-paki-municipality-slovenia'],
  ['name' => 'Šmartno pri Litiji Municipality', 'url' => '/ui-ux-design-agency-in-smartno-pri-litiji-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-smartno-pri-litiji-municipality-slovenia'],
  ['name' => 'Sodražica Municipality', 'url' => '/ui-ux-design-agency-in-sodrazica-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-sodrazica-municipality-slovenia'],
  ['name' => 'Solčava Municipality', 'url' => '/ui-ux-design-agency-in-solcava-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-solcava-municipality-slovenia'],
  ['name' => 'Šoštanj Municipality', 'url' => '/ui-ux-design-agency-in-sostanj-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-sostanj-municipality-slovenia'],
  ['name' => 'Središče ob Dravi', 'url' => '/ui-ux-design-agency-in-sredisce-ob-dravi-slovenia', 'basename' => 'ui-ux-design-agency-in-sredisce-ob-dravi-slovenia'],
  ['name' => 'Starše Municipality', 'url' => '/ui-ux-design-agency-in-starse-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-starse-municipality-slovenia'],
  ['name' => 'Štore Municipality', 'url' => '/ui-ux-design-agency-in-store-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-store-municipality-slovenia'],
  ['name' => 'Straža Municipality', 'url' => '/ui-ux-design-agency-in-straza-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-straza-municipality-slovenia'],
  ['name' => 'Sveta Ana Municipality', 'url' => '/ui-ux-design-agency-in-sveta-ana-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-sveta-ana-municipality-slovenia'],
  ['name' => 'Sveta Trojica v Slovenskih Goricah Municipality', 'url' => '/ui-ux-design-agency-in-sveta-trojica-v-slovenskih-goricah-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-sveta-trojica-v-slovenskih-goricah-municipality-slovenia'],
  ['name' => 'Sveti Andraž v Slovenskih Goricah Municipality', 'url' => '/ui-ux-design-agency-in-sveti-andraz-v-slovenskih-goricah-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-sveti-andraz-v-slovenskih-goricah-municipality-slovenia'],
  ['name' => 'Sveti Jurij ob Ščavnici Municipality', 'url' => '/ui-ux-design-agency-in-sveti-jurij-ob-scavnici-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-sveti-jurij-ob-scavnici-municipality-slovenia'],
  ['name' => 'Sveti Jurij v Slovenskih Goricah Municipality', 'url' => '/ui-ux-design-agency-in-sveti-jurij-v-slovenskih-goricah-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-sveti-jurij-v-slovenskih-goricah-municipality-slovenia'],
  ['name' => 'Sveti Tomaž Municipality', 'url' => '/ui-ux-design-agency-in-sveti-tomaz-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-sveti-tomaz-municipality-slovenia'],
  ['name' => 'Tabor Municipality', 'url' => '/ui-ux-design-agency-in-tabor-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-tabor-municipality-slovenia'],
  ['name' => 'Tišina Municipality', 'url' => '/ui-ux-design-agency-in-tisina-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-tisina-municipality-slovenia'],
  ['name' => 'Tolmin Municipality', 'url' => '/ui-ux-design-agency-in-tolmin-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-tolmin-municipality-slovenia'],
  ['name' => 'Trbovlje Municipality', 'url' => '/ui-ux-design-agency-in-trbovlje-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-trbovlje-municipality-slovenia'],
  ['name' => 'Trebnje Municipality', 'url' => '/ui-ux-design-agency-in-trebnje-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-trebnje-municipality-slovenia'],
  ['name' => 'Trnovska Vas Municipality', 'url' => '/ui-ux-design-agency-in-trnovska-vas-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-trnovska-vas-municipality-slovenia'],
  ['name' => 'Tržič Municipality', 'url' => '/ui-ux-design-agency-in-trzic-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-trzic-municipality-slovenia'],
  ['name' => 'Trzin Municipality', 'url' => '/ui-ux-design-agency-in-trzin-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-trzin-municipality-slovenia'],
  ['name' => 'Turnišče Municipality', 'url' => '/ui-ux-design-agency-in-turnisce-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-turnisce-municipality-slovenia'],
  ['name' => 'Velika Polana Municipality', 'url' => '/ui-ux-design-agency-in-velika-polana-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-velika-polana-municipality-slovenia'],
  ['name' => 'Velike Lašče Municipality', 'url' => '/ui-ux-design-agency-in-velike-lasce-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-velike-lasce-municipality-slovenia'],
  ['name' => 'Veržej Municipality', 'url' => '/ui-ux-design-agency-in-verzej-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-verzej-municipality-slovenia'],
  ['name' => 'Videm Municipality', 'url' => '/ui-ux-design-agency-in-videm-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-videm-municipality-slovenia'],
  ['name' => 'Vipava Municipality', 'url' => '/ui-ux-design-agency-in-vipava-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-vipava-municipality-slovenia'],
  ['name' => 'Vitanje Municipality', 'url' => '/ui-ux-design-agency-in-vitanje-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-vitanje-municipality-slovenia'],
  ['name' => 'Vodice Municipality', 'url' => '/ui-ux-design-agency-in-vodice-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-vodice-municipality-slovenia'],
  ['name' => 'Vojnik Municipality', 'url' => '/ui-ux-design-agency-in-vojnik-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-vojnik-municipality-slovenia'],
  ['name' => 'Vransko Municipality', 'url' => '/ui-ux-design-agency-in-vransko-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-vransko-municipality-slovenia'],
  ['name' => 'Vrhnika Municipality', 'url' => '/ui-ux-design-agency-in-vrhnika-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-vrhnika-municipality-slovenia'],
  ['name' => 'Vuzenica Municipality', 'url' => '/ui-ux-design-agency-in-vuzenica-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-vuzenica-municipality-slovenia'],
  ['name' => 'Zagorje ob Savi Municipality', 'url' => '/ui-ux-design-agency-in-zagorje-ob-savi-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-zagorje-ob-savi-municipality-slovenia'],
  ['name' => 'Žalec Municipality', 'url' => '/ui-ux-design-agency-in-zalec-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-zalec-municipality-slovenia'],
  ['name' => 'Zavrč Municipality', 'url' => '/ui-ux-design-agency-in-zavrc-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-zavrc-municipality-slovenia'],
  ['name' => 'Železniki Municipality', 'url' => '/ui-ux-design-agency-in-zelezniki-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-zelezniki-municipality-slovenia'],
  ['name' => 'Žetale Municipality', 'url' => '/ui-ux-design-agency-in-zetale-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-zetale-municipality-slovenia'],
  ['name' => 'Žiri Municipality', 'url' => '/ui-ux-design-agency-in-ziri-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-ziri-municipality-slovenia'],
  ['name' => 'Žirovnica Municipality', 'url' => '/ui-ux-design-agency-in-zirovnica-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-zirovnica-municipality-slovenia'],
  ['name' => 'Zreče Municipality', 'url' => '/ui-ux-design-agency-in-zrece-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-zrece-municipality-slovenia'],
  ['name' => 'Žužemberk Municipality', 'url' => '/ui-ux-design-agency-in-zuzemberk-municipality-slovenia', 'basename' => 'ui-ux-design-agency-in-zuzemberk-municipality-slovenia'],
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

    <!-- ── Hub: Browse all regions in Slovenia ── -->
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
      <h2>Browse UI/UX Design Services Across Slovenia</h2>
      <p class="hub-sub">We serve 211 regions, states, and cities in Slovenia. Select a location to see how UX Pacific can help your business.</p>
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