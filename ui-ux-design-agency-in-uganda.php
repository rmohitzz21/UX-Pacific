<?php
require_once __DIR__ . '/includes/cms_repository.php';

$countrySlug = 'uganda';

$featuredProjects   = get_published_projects('all', true);
$ecosystemHomeItems = get_published_ecosystem();

function home_image_url(?string $url): string {
  $url = trim((string) $url);
  if ($url === '') return uxp_normalize_stored_media_url('img/ux.webp');
  if (preg_match('#^https?://#i', $url)) return $url;
  return uxp_normalize_stored_media_url($url);
}

$pageTitle   = 'UI UX Design Agency in Uganda | UX Pacific';
$pageDesc    = 'UX Pacific delivers expert UI/UX design services across Uganda. Browse our locations or book a free UX audit today.';
$canonicalUrl = 'https://www.uxpacific.com/ui-ux-design-agency-in-uganda';
$ogTitle     = 'UI UX Design Agency in Uganda | UX Pacific';
$ogDesc      = 'UX Pacific delivers expert UI/UX design services across Uganda. Browse our locations or book a free UX audit today.';
$ogUrl       = 'https://www.uxpacific.com/ui-ux-design-agency-in-uganda';
$currentPage = 'Home';

// Schema: WebPage + BreadcrumbList
$ldJson = json_encode([
  '@context' => 'https://schema.org',
  '@graph'   => [
    ['@type' => 'WebPage',
     'url'   => 'https://www.uxpacific.com/ui-ux-design-agency-in-uganda',
     'name'  => 'UI UX Design Agency in Uganda | UX Pacific',
     'inLanguage' => 'en',
    ],
    ['@type' => 'BreadcrumbList',
     'itemListElement' => [
       ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home',       'item' => BASE_URL . '/'],
       ['@type' => 'ListItem', 'position' => 2, 'name' => 'Uganda', 'item' => 'https://www.uxpacific.com/ui-ux-design-agency-in-uganda'],
     ],
    ],
  ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

$geoPage = uxp_geo_page($countrySlug);
if ($geoPage) {
  if (!empty($geoPage['page_title']))      { $pageTitle = (string) $geoPage['page_title']; $ogTitle = $pageTitle; }
  if (!empty($geoPage['meta_description'])) { $pageDesc  = (string) $geoPage['meta_description']; $ogDesc = $pageDesc; }
}

// Child locations in Uganda
$hubChildren = [
  ['name' => 'Abim District', 'url' => '/ui-ux-design-agency-in-abim-district-uganda', 'basename' => 'ui-ux-design-agency-in-abim-district-uganda'],
  ['name' => 'Adjumani District', 'url' => '/ui-ux-design-agency-in-adjumani-district-uganda', 'basename' => 'ui-ux-design-agency-in-adjumani-district-uganda'],
  ['name' => 'Agago District', 'url' => '/ui-ux-design-agency-in-agago-district-uganda', 'basename' => 'ui-ux-design-agency-in-agago-district-uganda'],
  ['name' => 'Alebtong District', 'url' => '/ui-ux-design-agency-in-alebtong-district-uganda', 'basename' => 'ui-ux-design-agency-in-alebtong-district-uganda'],
  ['name' => 'Amolatar District', 'url' => '/ui-ux-design-agency-in-amolatar-district-uganda', 'basename' => 'ui-ux-design-agency-in-amolatar-district-uganda'],
  ['name' => 'Amudat District', 'url' => '/ui-ux-design-agency-in-amudat-district-uganda', 'basename' => 'ui-ux-design-agency-in-amudat-district-uganda'],
  ['name' => 'Amuria District', 'url' => '/ui-ux-design-agency-in-amuria-district-uganda', 'basename' => 'ui-ux-design-agency-in-amuria-district-uganda'],
  ['name' => 'Amuru District', 'url' => '/ui-ux-design-agency-in-amuru-district-uganda', 'basename' => 'ui-ux-design-agency-in-amuru-district-uganda'],
  ['name' => 'Apac District', 'url' => '/ui-ux-design-agency-in-apac-district-uganda', 'basename' => 'ui-ux-design-agency-in-apac-district-uganda'],
  ['name' => 'Arua District', 'url' => '/ui-ux-design-agency-in-arua-district-uganda', 'basename' => 'ui-ux-design-agency-in-arua-district-uganda'],
  ['name' => 'Budaka District', 'url' => '/ui-ux-design-agency-in-budaka-district-uganda', 'basename' => 'ui-ux-design-agency-in-budaka-district-uganda'],
  ['name' => 'Bududa District', 'url' => '/ui-ux-design-agency-in-bududa-district-uganda', 'basename' => 'ui-ux-design-agency-in-bududa-district-uganda'],
  ['name' => 'Bugiri District', 'url' => '/ui-ux-design-agency-in-bugiri-district-uganda', 'basename' => 'ui-ux-design-agency-in-bugiri-district-uganda'],
  ['name' => 'Buhweju District', 'url' => '/ui-ux-design-agency-in-buhweju-district-uganda', 'basename' => 'ui-ux-design-agency-in-buhweju-district-uganda'],
  ['name' => 'Buikwe District', 'url' => '/ui-ux-design-agency-in-buikwe-district-uganda', 'basename' => 'ui-ux-design-agency-in-buikwe-district-uganda'],
  ['name' => 'Bukedea District', 'url' => '/ui-ux-design-agency-in-bukedea-district-uganda', 'basename' => 'ui-ux-design-agency-in-bukedea-district-uganda'],
  ['name' => 'Bukomansimbi District', 'url' => '/ui-ux-design-agency-in-bukomansimbi-district-uganda', 'basename' => 'ui-ux-design-agency-in-bukomansimbi-district-uganda'],
  ['name' => 'Bukwo District', 'url' => '/ui-ux-design-agency-in-bukwo-district-uganda', 'basename' => 'ui-ux-design-agency-in-bukwo-district-uganda'],
  ['name' => 'Bulambuli District', 'url' => '/ui-ux-design-agency-in-bulambuli-district-uganda', 'basename' => 'ui-ux-design-agency-in-bulambuli-district-uganda'],
  ['name' => 'Buliisa District', 'url' => '/ui-ux-design-agency-in-buliisa-district-uganda', 'basename' => 'ui-ux-design-agency-in-buliisa-district-uganda'],
  ['name' => 'Bundibugyo District', 'url' => '/ui-ux-design-agency-in-bundibugyo-district-uganda', 'basename' => 'ui-ux-design-agency-in-bundibugyo-district-uganda'],
  ['name' => 'Bunyangabu District', 'url' => '/ui-ux-design-agency-in-bunyangabu-district-uganda', 'basename' => 'ui-ux-design-agency-in-bunyangabu-district-uganda'],
  ['name' => 'Bushenyi District', 'url' => '/ui-ux-design-agency-in-bushenyi-district-uganda', 'basename' => 'ui-ux-design-agency-in-bushenyi-district-uganda'],
  ['name' => 'Busia District', 'url' => '/ui-ux-design-agency-in-busia-district-uganda', 'basename' => 'ui-ux-design-agency-in-busia-district-uganda'],
  ['name' => 'Butaleja District', 'url' => '/ui-ux-design-agency-in-butaleja-district-uganda', 'basename' => 'ui-ux-design-agency-in-butaleja-district-uganda'],
  ['name' => 'Butambala District', 'url' => '/ui-ux-design-agency-in-butambala-district-uganda', 'basename' => 'ui-ux-design-agency-in-butambala-district-uganda'],
  ['name' => 'Butebo District', 'url' => '/ui-ux-design-agency-in-butebo-district-uganda', 'basename' => 'ui-ux-design-agency-in-butebo-district-uganda'],
  ['name' => 'Buvuma District', 'url' => '/ui-ux-design-agency-in-buvuma-district-uganda', 'basename' => 'ui-ux-design-agency-in-buvuma-district-uganda'],
  ['name' => 'Buyende District', 'url' => '/ui-ux-design-agency-in-buyende-district-uganda', 'basename' => 'ui-ux-design-agency-in-buyende-district-uganda'],
  ['name' => 'Central Region', 'url' => '/ui-ux-design-agency-in-central-region-uganda', 'basename' => 'ui-ux-design-agency-in-central-region-uganda'],
  ['name' => 'Dokolo District', 'url' => '/ui-ux-design-agency-in-dokolo-district-uganda', 'basename' => 'ui-ux-design-agency-in-dokolo-district-uganda'],
  ['name' => 'Eastern Region', 'url' => '/ui-ux-design-agency-in-eastern-region-uganda', 'basename' => 'ui-ux-design-agency-in-eastern-region-uganda'],
  ['name' => 'Gomba District', 'url' => '/ui-ux-design-agency-in-gomba-district-uganda', 'basename' => 'ui-ux-design-agency-in-gomba-district-uganda'],
  ['name' => 'Gulu District', 'url' => '/ui-ux-design-agency-in-gulu-district-uganda', 'basename' => 'ui-ux-design-agency-in-gulu-district-uganda'],
  ['name' => 'Ibanda District', 'url' => '/ui-ux-design-agency-in-ibanda-district-uganda', 'basename' => 'ui-ux-design-agency-in-ibanda-district-uganda'],
  ['name' => 'Iganga District', 'url' => '/ui-ux-design-agency-in-iganga-district-uganda', 'basename' => 'ui-ux-design-agency-in-iganga-district-uganda'],
  ['name' => 'Isingiro District', 'url' => '/ui-ux-design-agency-in-isingiro-district-uganda', 'basename' => 'ui-ux-design-agency-in-isingiro-district-uganda'],
  ['name' => 'Jinja District', 'url' => '/ui-ux-design-agency-in-jinja-district-uganda', 'basename' => 'ui-ux-design-agency-in-jinja-district-uganda'],
  ['name' => 'Kaabong District', 'url' => '/ui-ux-design-agency-in-kaabong-district-uganda', 'basename' => 'ui-ux-design-agency-in-kaabong-district-uganda'],
  ['name' => 'Kabale District', 'url' => '/ui-ux-design-agency-in-kabale-district-uganda', 'basename' => 'ui-ux-design-agency-in-kabale-district-uganda'],
  ['name' => 'Kabarole District', 'url' => '/ui-ux-design-agency-in-kabarole-district-uganda', 'basename' => 'ui-ux-design-agency-in-kabarole-district-uganda'],
  ['name' => 'Kaberamaido District', 'url' => '/ui-ux-design-agency-in-kaberamaido-district-uganda', 'basename' => 'ui-ux-design-agency-in-kaberamaido-district-uganda'],
  ['name' => 'Kagadi District', 'url' => '/ui-ux-design-agency-in-kagadi-district-uganda', 'basename' => 'ui-ux-design-agency-in-kagadi-district-uganda'],
  ['name' => 'Kakumiro District', 'url' => '/ui-ux-design-agency-in-kakumiro-district-uganda', 'basename' => 'ui-ux-design-agency-in-kakumiro-district-uganda'],
  ['name' => 'Kalangala District', 'url' => '/ui-ux-design-agency-in-kalangala-district-uganda', 'basename' => 'ui-ux-design-agency-in-kalangala-district-uganda'],
  ['name' => 'Kaliro District', 'url' => '/ui-ux-design-agency-in-kaliro-district-uganda', 'basename' => 'ui-ux-design-agency-in-kaliro-district-uganda'],
  ['name' => 'Kalungu District', 'url' => '/ui-ux-design-agency-in-kalungu-district-uganda', 'basename' => 'ui-ux-design-agency-in-kalungu-district-uganda'],
  ['name' => 'Kampala District', 'url' => '/ui-ux-design-agency-in-kampala-district-uganda', 'basename' => 'ui-ux-design-agency-in-kampala-district-uganda'],
  ['name' => 'Kamuli District', 'url' => '/ui-ux-design-agency-in-kamuli-district-uganda', 'basename' => 'ui-ux-design-agency-in-kamuli-district-uganda'],
  ['name' => 'Kamwenge District', 'url' => '/ui-ux-design-agency-in-kamwenge-district-uganda', 'basename' => 'ui-ux-design-agency-in-kamwenge-district-uganda'],
  ['name' => 'Kanungu District', 'url' => '/ui-ux-design-agency-in-kanungu-district-uganda', 'basename' => 'ui-ux-design-agency-in-kanungu-district-uganda'],
  ['name' => 'Kapchorwa District', 'url' => '/ui-ux-design-agency-in-kapchorwa-district-uganda', 'basename' => 'ui-ux-design-agency-in-kapchorwa-district-uganda'],
  ['name' => 'Kasese District', 'url' => '/ui-ux-design-agency-in-kasese-district-uganda', 'basename' => 'ui-ux-design-agency-in-kasese-district-uganda'],
  ['name' => 'Katakwi District', 'url' => '/ui-ux-design-agency-in-katakwi-district-uganda', 'basename' => 'ui-ux-design-agency-in-katakwi-district-uganda'],
  ['name' => 'Kayunga District', 'url' => '/ui-ux-design-agency-in-kayunga-district-uganda', 'basename' => 'ui-ux-design-agency-in-kayunga-district-uganda'],
  ['name' => 'Kibaale District', 'url' => '/ui-ux-design-agency-in-kibaale-district-uganda', 'basename' => 'ui-ux-design-agency-in-kibaale-district-uganda'],
  ['name' => 'Kiboga District', 'url' => '/ui-ux-design-agency-in-kiboga-district-uganda', 'basename' => 'ui-ux-design-agency-in-kiboga-district-uganda'],
  ['name' => 'Kibuku District', 'url' => '/ui-ux-design-agency-in-kibuku-district-uganda', 'basename' => 'ui-ux-design-agency-in-kibuku-district-uganda'],
  ['name' => 'Kiruhura District', 'url' => '/ui-ux-design-agency-in-kiruhura-district-uganda', 'basename' => 'ui-ux-design-agency-in-kiruhura-district-uganda'],
  ['name' => 'Kiryandongo District', 'url' => '/ui-ux-design-agency-in-kiryandongo-district-uganda', 'basename' => 'ui-ux-design-agency-in-kiryandongo-district-uganda'],
  ['name' => 'Kisoro District', 'url' => '/ui-ux-design-agency-in-kisoro-district-uganda', 'basename' => 'ui-ux-design-agency-in-kisoro-district-uganda'],
  ['name' => 'Kitgum District', 'url' => '/ui-ux-design-agency-in-kitgum-district-uganda', 'basename' => 'ui-ux-design-agency-in-kitgum-district-uganda'],
  ['name' => 'Koboko District', 'url' => '/ui-ux-design-agency-in-koboko-district-uganda', 'basename' => 'ui-ux-design-agency-in-koboko-district-uganda'],
  ['name' => 'Kole District', 'url' => '/ui-ux-design-agency-in-kole-district-uganda', 'basename' => 'ui-ux-design-agency-in-kole-district-uganda'],
  ['name' => 'Kotido District', 'url' => '/ui-ux-design-agency-in-kotido-district-uganda', 'basename' => 'ui-ux-design-agency-in-kotido-district-uganda'],
  ['name' => 'Kumi District', 'url' => '/ui-ux-design-agency-in-kumi-district-uganda', 'basename' => 'ui-ux-design-agency-in-kumi-district-uganda'],
  ['name' => 'Kween District', 'url' => '/ui-ux-design-agency-in-kween-district-uganda', 'basename' => 'ui-ux-design-agency-in-kween-district-uganda'],
  ['name' => 'Kyankwanzi District', 'url' => '/ui-ux-design-agency-in-kyankwanzi-district-uganda', 'basename' => 'ui-ux-design-agency-in-kyankwanzi-district-uganda'],
  ['name' => 'Kyegegwa District', 'url' => '/ui-ux-design-agency-in-kyegegwa-district-uganda', 'basename' => 'ui-ux-design-agency-in-kyegegwa-district-uganda'],
  ['name' => 'Kyenjojo District', 'url' => '/ui-ux-design-agency-in-kyenjojo-district-uganda', 'basename' => 'ui-ux-design-agency-in-kyenjojo-district-uganda'],
  ['name' => 'Kyotera District', 'url' => '/ui-ux-design-agency-in-kyotera-district-uganda', 'basename' => 'ui-ux-design-agency-in-kyotera-district-uganda'],
  ['name' => 'Lamwo District', 'url' => '/ui-ux-design-agency-in-lamwo-district-uganda', 'basename' => 'ui-ux-design-agency-in-lamwo-district-uganda'],
  ['name' => 'Lira District', 'url' => '/ui-ux-design-agency-in-lira-district-uganda', 'basename' => 'ui-ux-design-agency-in-lira-district-uganda'],
  ['name' => 'Luuka District', 'url' => '/ui-ux-design-agency-in-luuka-district-uganda', 'basename' => 'ui-ux-design-agency-in-luuka-district-uganda'],
  ['name' => 'Luwero District', 'url' => '/ui-ux-design-agency-in-luwero-district-uganda', 'basename' => 'ui-ux-design-agency-in-luwero-district-uganda'],
  ['name' => 'Lwengo District', 'url' => '/ui-ux-design-agency-in-lwengo-district-uganda', 'basename' => 'ui-ux-design-agency-in-lwengo-district-uganda'],
  ['name' => 'Lyantonde District', 'url' => '/ui-ux-design-agency-in-lyantonde-district-uganda', 'basename' => 'ui-ux-design-agency-in-lyantonde-district-uganda'],
  ['name' => 'Manafwa District', 'url' => '/ui-ux-design-agency-in-manafwa-district-uganda', 'basename' => 'ui-ux-design-agency-in-manafwa-district-uganda'],
  ['name' => 'Maracha District', 'url' => '/ui-ux-design-agency-in-maracha-district-uganda', 'basename' => 'ui-ux-design-agency-in-maracha-district-uganda'],
  ['name' => 'Masaka District', 'url' => '/ui-ux-design-agency-in-masaka-district-uganda', 'basename' => 'ui-ux-design-agency-in-masaka-district-uganda'],
  ['name' => 'Masindi District', 'url' => '/ui-ux-design-agency-in-masindi-district-uganda', 'basename' => 'ui-ux-design-agency-in-masindi-district-uganda'],
  ['name' => 'Mayuge District', 'url' => '/ui-ux-design-agency-in-mayuge-district-uganda', 'basename' => 'ui-ux-design-agency-in-mayuge-district-uganda'],
  ['name' => 'Mbale District', 'url' => '/ui-ux-design-agency-in-mbale-district-uganda', 'basename' => 'ui-ux-design-agency-in-mbale-district-uganda'],
  ['name' => 'Mbarara District', 'url' => '/ui-ux-design-agency-in-mbarara-district-uganda', 'basename' => 'ui-ux-design-agency-in-mbarara-district-uganda'],
  ['name' => 'Mitooma District', 'url' => '/ui-ux-design-agency-in-mitooma-district-uganda', 'basename' => 'ui-ux-design-agency-in-mitooma-district-uganda'],
  ['name' => 'Mityana District', 'url' => '/ui-ux-design-agency-in-mityana-district-uganda', 'basename' => 'ui-ux-design-agency-in-mityana-district-uganda'],
  ['name' => 'Moroto District', 'url' => '/ui-ux-design-agency-in-moroto-district-uganda', 'basename' => 'ui-ux-design-agency-in-moroto-district-uganda'],
  ['name' => 'Moyo District', 'url' => '/ui-ux-design-agency-in-moyo-district-uganda', 'basename' => 'ui-ux-design-agency-in-moyo-district-uganda'],
  ['name' => 'Mpigi District', 'url' => '/ui-ux-design-agency-in-mpigi-district-uganda', 'basename' => 'ui-ux-design-agency-in-mpigi-district-uganda'],
  ['name' => 'Mubende District', 'url' => '/ui-ux-design-agency-in-mubende-district-uganda', 'basename' => 'ui-ux-design-agency-in-mubende-district-uganda'],
  ['name' => 'Mukono District', 'url' => '/ui-ux-design-agency-in-mukono-district-uganda', 'basename' => 'ui-ux-design-agency-in-mukono-district-uganda'],
  ['name' => 'Nakapiripirit District', 'url' => '/ui-ux-design-agency-in-nakapiripirit-district-uganda', 'basename' => 'ui-ux-design-agency-in-nakapiripirit-district-uganda'],
  ['name' => 'Nakaseke District', 'url' => '/ui-ux-design-agency-in-nakaseke-district-uganda', 'basename' => 'ui-ux-design-agency-in-nakaseke-district-uganda'],
  ['name' => 'Nakasongola District', 'url' => '/ui-ux-design-agency-in-nakasongola-district-uganda', 'basename' => 'ui-ux-design-agency-in-nakasongola-district-uganda'],
  ['name' => 'Namayingo District', 'url' => '/ui-ux-design-agency-in-namayingo-district-uganda', 'basename' => 'ui-ux-design-agency-in-namayingo-district-uganda'],
  ['name' => 'Namisindwa District', 'url' => '/ui-ux-design-agency-in-namisindwa-district-uganda', 'basename' => 'ui-ux-design-agency-in-namisindwa-district-uganda'],
  ['name' => 'Namutumba District', 'url' => '/ui-ux-design-agency-in-namutumba-district-uganda', 'basename' => 'ui-ux-design-agency-in-namutumba-district-uganda'],
  ['name' => 'Napak District', 'url' => '/ui-ux-design-agency-in-napak-district-uganda', 'basename' => 'ui-ux-design-agency-in-napak-district-uganda'],
  ['name' => 'Nebbi District', 'url' => '/ui-ux-design-agency-in-nebbi-district-uganda', 'basename' => 'ui-ux-design-agency-in-nebbi-district-uganda'],
  ['name' => 'Ngora District', 'url' => '/ui-ux-design-agency-in-ngora-district-uganda', 'basename' => 'ui-ux-design-agency-in-ngora-district-uganda'],
  ['name' => 'Northern Region', 'url' => '/ui-ux-design-agency-in-northern-region-uganda', 'basename' => 'ui-ux-design-agency-in-northern-region-uganda'],
  ['name' => 'Ntoroko District', 'url' => '/ui-ux-design-agency-in-ntoroko-district-uganda', 'basename' => 'ui-ux-design-agency-in-ntoroko-district-uganda'],
  ['name' => 'Ntungamo District', 'url' => '/ui-ux-design-agency-in-ntungamo-district-uganda', 'basename' => 'ui-ux-design-agency-in-ntungamo-district-uganda'],
  ['name' => 'Nwoya District', 'url' => '/ui-ux-design-agency-in-nwoya-district-uganda', 'basename' => 'ui-ux-design-agency-in-nwoya-district-uganda'],
  ['name' => 'Omoro District', 'url' => '/ui-ux-design-agency-in-omoro-district-uganda', 'basename' => 'ui-ux-design-agency-in-omoro-district-uganda'],
  ['name' => 'Otuke District', 'url' => '/ui-ux-design-agency-in-otuke-district-uganda', 'basename' => 'ui-ux-design-agency-in-otuke-district-uganda'],
  ['name' => 'Oyam District', 'url' => '/ui-ux-design-agency-in-oyam-district-uganda', 'basename' => 'ui-ux-design-agency-in-oyam-district-uganda'],
  ['name' => 'Pader District', 'url' => '/ui-ux-design-agency-in-pader-district-uganda', 'basename' => 'ui-ux-design-agency-in-pader-district-uganda'],
  ['name' => 'Pakwach District', 'url' => '/ui-ux-design-agency-in-pakwach-district-uganda', 'basename' => 'ui-ux-design-agency-in-pakwach-district-uganda'],
  ['name' => 'Pallisa District', 'url' => '/ui-ux-design-agency-in-pallisa-district-uganda', 'basename' => 'ui-ux-design-agency-in-pallisa-district-uganda'],
  ['name' => 'Rakai District', 'url' => '/ui-ux-design-agency-in-rakai-district-uganda', 'basename' => 'ui-ux-design-agency-in-rakai-district-uganda'],
  ['name' => 'Rubanda District', 'url' => '/ui-ux-design-agency-in-rubanda-district-uganda', 'basename' => 'ui-ux-design-agency-in-rubanda-district-uganda'],
  ['name' => 'Rubirizi District', 'url' => '/ui-ux-design-agency-in-rubirizi-district-uganda', 'basename' => 'ui-ux-design-agency-in-rubirizi-district-uganda'],
  ['name' => 'Rukiga District', 'url' => '/ui-ux-design-agency-in-rukiga-district-uganda', 'basename' => 'ui-ux-design-agency-in-rukiga-district-uganda'],
  ['name' => 'Rukungiri District', 'url' => '/ui-ux-design-agency-in-rukungiri-district-uganda', 'basename' => 'ui-ux-design-agency-in-rukungiri-district-uganda'],
  ['name' => 'Sembabule District', 'url' => '/ui-ux-design-agency-in-sembabule-district-uganda', 'basename' => 'ui-ux-design-agency-in-sembabule-district-uganda'],
  ['name' => 'Serere District', 'url' => '/ui-ux-design-agency-in-serere-district-uganda', 'basename' => 'ui-ux-design-agency-in-serere-district-uganda'],
  ['name' => 'Sheema District', 'url' => '/ui-ux-design-agency-in-sheema-district-uganda', 'basename' => 'ui-ux-design-agency-in-sheema-district-uganda'],
  ['name' => 'Sironko District', 'url' => '/ui-ux-design-agency-in-sironko-district-uganda', 'basename' => 'ui-ux-design-agency-in-sironko-district-uganda'],
  ['name' => 'Soroti District', 'url' => '/ui-ux-design-agency-in-soroti-district-uganda', 'basename' => 'ui-ux-design-agency-in-soroti-district-uganda'],
  ['name' => 'Tororo District', 'url' => '/ui-ux-design-agency-in-tororo-district-uganda', 'basename' => 'ui-ux-design-agency-in-tororo-district-uganda'],
  ['name' => 'Wakiso District', 'url' => '/ui-ux-design-agency-in-wakiso-district-uganda', 'basename' => 'ui-ux-design-agency-in-wakiso-district-uganda'],
  ['name' => 'Western Region', 'url' => '/ui-ux-design-agency-in-western-region-uganda', 'basename' => 'ui-ux-design-agency-in-western-region-uganda'],
  ['name' => 'Yumbe District', 'url' => '/ui-ux-design-agency-in-yumbe-district-uganda', 'basename' => 'ui-ux-design-agency-in-yumbe-district-uganda'],
  ['name' => 'Zombo District', 'url' => '/ui-ux-design-agency-in-zombo-district-uganda', 'basename' => 'ui-ux-design-agency-in-zombo-district-uganda'],
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

    <!-- ── Hub: Browse all regions in Uganda ── -->
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
      <h2>Browse UI/UX Design Services Across Uganda</h2>
      <p class="hub-sub">We serve 125 regions, states, and cities in Uganda. Select a location to see how UX Pacific can help your business.</p>
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