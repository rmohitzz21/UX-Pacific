<?php
/**
 * Tier 2 State/Region Page Generator — UX Pacific
 * Run from CLI: php generate-tier2-pages.php
 * Or visit in browser (XAMPP): http://localhost/UX_Pacific/generate-tier2-pages.php
 *
 * What it does:
 *   Reads every ui-ux-design-agency-in-*.php file in this directory,
 *   parses the country + state/region from the filename,
 *   and overwrites each file with a full SEO-rich Tier 2 template.
 *
 * Control flags:
 */
define('DRY_RUN',    true);    // true = parse only, do not write files
define('LIMIT',      0);       // 0 = process all; N = stop after N files (testing)
define('SKIP_DONE',  true);    // true = skip files that already have the new template marker
define('DONE_MARKER','<!-- tier2-v2 -->'); // marker written into every generated file

// ─── Country data table ────────────────────────────────────────────────────
// Key = country slug as it appears at the END of the filename.
// Multi-word slugs listed longest-first so the parser matches greedily.
$COUNTRIES = [
  // ── Multi-word slugs first ─────────────────────────────────
  'united-arab-emirates'    => ['name'=>'United Arab Emirates','short'=>'UAE','geo'=>'AE','lang'=>'en-AE','locale'=>'en_AE','compliance'=>'UAE PDPL','access'=>'UAE Web Accessibility Standards / WCAG 2.1','tz'=>'GST (UTC+4)','phone'=>'+971 XX XXX XXXX'],
  'united-kingdom'          => ['name'=>'United Kingdom',      'short'=>'UK', 'geo'=>'GB','lang'=>'en-GB','locale'=>'en_GB','compliance'=>'UK GDPR','access'=>'Equality Act 2010 / WCAG 2.1','tz'=>'GMT / BST','phone'=>'+44 XXXX XXXXXX'],
  'united-states'           => ['name'=>'United States',       'short'=>'USA','geo'=>'US','lang'=>'en-US','locale'=>'en_US','compliance'=>'CCPA / ADA','access'=>'ADA / Section 508 / WCAG 2.1','tz'=>'EST / PST / CST','phone'=>'+1 (XXX) XXX-XXXX'],
  'south-africa'            => ['name'=>'South Africa',        'short'=>'SA', 'geo'=>'ZA','lang'=>'en-ZA','locale'=>'en_ZA','compliance'=>'POPIA','access'=>'WCAG 2.1 AA','tz'=>'SAST (UTC+2)','phone'=>'+27 XX XXX XXXX'],
  'new-zealand'             => ['name'=>'New Zealand',         'short'=>'NZ', 'geo'=>'NZ','lang'=>'en-NZ','locale'=>'en_NZ','compliance'=>'Privacy Act 2020','access'=>'WCAG 2.1 AA','tz'=>'NZST (UTC+12)','phone'=>'+64 X XXXX XXXX'],
  'saudi-arabia'            => ['name'=>'Saudi Arabia',        'short'=>'KSA','geo'=>'SA','lang'=>'en-SA','locale'=>'en_SA','compliance'=>'PDPL (Saudi)','access'=>'WCAG 2.1 AA','tz'=>'AST (UTC+3)','phone'=>'+966 XX XXX XXXX'],
  'sri-lanka'               => ['name'=>'Sri Lanka',           'short'=>'LK', 'geo'=>'LK','lang'=>'en-LK','locale'=>'en_LK','compliance'=>'PDPA (Sri Lanka)','access'=>'WCAG 2.1 AA','tz'=>'IST (UTC+5:30)','phone'=>'+94 XX XXX XXXX'],
  'costa-rica'              => ['name'=>'Costa Rica',          'short'=>'CR', 'geo'=>'CR','lang'=>'es-CR','locale'=>'es_CR','compliance'=>'Law 8968','access'=>'WCAG 2.1 AA','tz'=>'CST (UTC-6)','phone'=>'+506 XXXX-XXXX'],
  'czech-republic'          => ['name'=>'Czech Republic',      'short'=>'CZ', 'geo'=>'CZ','lang'=>'en-CZ','locale'=>'cs_CZ','compliance'=>'GDPR / UOOU','access'=>'WCAG 2.1 AA','tz'=>'CET / CEST','phone'=>'+420 XXX XXX XXX'],
  'trinidad-and-tobago'     => ['name'=>'Trinidad and Tobago', 'short'=>'TT', 'geo'=>'TT','lang'=>'en-TT','locale'=>'en_TT','compliance'=>'DPA 2011 (TT)','access'=>'WCAG 2.1 AA','tz'=>'AST (UTC-4)','phone'=>'+1 (868) XXX-XXXX'],
  'papua-new-guinea'        => ['name'=>'Papua New Guinea',    'short'=>'PNG','geo'=>'PG','lang'=>'en-PG','locale'=>'en_PG','compliance'=>'Privacy Act (PNG)','access'=>'WCAG 2.1 AA','tz'=>'PGT (UTC+10)','phone'=>'+675 XXX XXXX'],
  'ivory-coast'             => ['name'=>'Ivory Coast',         'short'=>'CI', 'geo'=>'CI','lang'=>'fr-CI','locale'=>'fr_CI','compliance'=>'ARTCI / GDPR-aligned','access'=>'WCAG 2.1 AA','tz'=>'GMT','phone'=>'+225 XX XX XX XX'],
  'cote-divoire'            => ['name'=>"Côte d'Ivoire",       'short'=>'CI', 'geo'=>'CI','lang'=>'fr-CI','locale'=>'fr_CI','compliance'=>'ARTCI / GDPR-aligned','access'=>'WCAG 2.1 AA','tz'=>'GMT','phone'=>'+225 XX XX XX XX'],
  'the-bahamas'             => ['name'=>'The Bahamas',         'short'=>'BS', 'geo'=>'BS','lang'=>'en-BS','locale'=>'en_BS','compliance'=>'DPA 2003 (Bahamas)','access'=>'WCAG 2.1 AA','tz'=>'EST / EDT','phone'=>'+1 (242) XXX-XXXX'],
  'north-korea'             => ['name'=>'North Korea',         'short'=>'KP', 'geo'=>'KP','lang'=>'ko-KP','locale'=>'ko_KP','compliance'=>'N/A','access'=>'WCAG 2.1 AA','tz'=>'KST (UTC+9)','phone'=>'+850 XX XXX XXXX'],
  'south-korea'             => ['name'=>'South Korea',         'short'=>'KR', 'geo'=>'KR','lang'=>'ko-KR','locale'=>'ko_KR','compliance'=>'PIPA (South Korea)','access'=>'WCAG 2.1 AA','tz'=>'KST (UTC+9)','phone'=>'+82 XX XXXX XXXX'],
  'south-sudan'             => ['name'=>'South Sudan',         'short'=>'SS', 'geo'=>'SS','lang'=>'en-SS','locale'=>'en_SS','compliance'=>'N/A','access'=>'WCAG 2.1 AA','tz'=>'EAT (UTC+3)','phone'=>'+211 XX XXX XXXX'],
  'sierra-leone'            => ['name'=>'Sierra Leone',        'short'=>'SL', 'geo'=>'SL','lang'=>'en-SL','locale'=>'en_SL','compliance'=>'DPA (Sierra Leone)','access'=>'WCAG 2.1 AA','tz'=>'GMT','phone'=>'+232 XX XXXXXX'],
  'san-marino'              => ['name'=>'San Marino',          'short'=>'SM', 'geo'=>'SM','lang'=>'it-SM','locale'=>'it_SM','compliance'=>'GDPR','access'=>'WCAG 2.1 AA','tz'=>'CET / CEST','phone'=>'+378 XX XXXX'],
  'burkina-faso'            => ['name'=>'Burkina Faso',        'short'=>'BF', 'geo'=>'BF','lang'=>'fr-BF','locale'=>'fr_BF','compliance'=>'GDPR-aligned','access'=>'WCAG 2.1 AA','tz'=>'GMT','phone'=>'+226 XX XX XX XX'],
  'equatorial-guinea'       => ['name'=>'Equatorial Guinea',   'short'=>'GQ', 'geo'=>'GQ','lang'=>'es-GQ','locale'=>'es_GQ','compliance'=>'N/A','access'=>'WCAG 2.1 AA','tz'=>'WAT (UTC+1)','phone'=>'+240 XXX XXX XXX'],
  'saint-lucia'             => ['name'=>'Saint Lucia',         'short'=>'LC', 'geo'=>'LC','lang'=>'en-LC','locale'=>'en_LC','compliance'=>'ECSC Model Law','access'=>'WCAG 2.1 AA','tz'=>'AST (UTC-4)','phone'=>'+1 (758) XXX-XXXX'],
  'saint-vincent-and-the-grenadines'=>['name'=>'Saint Vincent and the Grenadines','short'=>'VC','geo'=>'VC','lang'=>'en-VC','locale'=>'en_VC','compliance'=>'ECSC Model Law','access'=>'WCAG 2.1 AA','tz'=>'AST (UTC-4)','phone'=>'+1 (784) XXX-XXXX'],
  'sao-tome-and-principe'   => ['name'=>'São Tomé and Príncipe','short'=>'ST','geo'=>'ST','lang'=>'pt-ST','locale'=>'pt_ST','compliance'=>'GDPR-aligned','access'=>'WCAG 2.1 AA','tz'=>'GMT','phone'=>'+239 XX XXXXX'],
  'antigua-and-barbuda'     => ['name'=>'Antigua and Barbuda', 'short'=>'AG', 'geo'=>'AG','lang'=>'en-AG','locale'=>'en_AG','compliance'=>'ECSC Model Law','access'=>'WCAG 2.1 AA','tz'=>'AST (UTC-4)','phone'=>'+1 (268) XXX-XXXX'],
  'bosnia-and-herzegovina'  => ['name'=>'Bosnia and Herzegovina','short'=>'BA','geo'=>'BA','lang'=>'bs-BA','locale'=>'bs_BA','compliance'=>'GDPR-aligned','access'=>'WCAG 2.1 AA','tz'=>'CET / CEST','phone'=>'+387 XX XXX XXX'],
  'el-salvador'             => ['name'=>'El Salvador',         'short'=>'SV', 'geo'=>'SV','lang'=>'es-SV','locale'=>'es_SV','compliance'=>'LGPD-aligned','access'=>'WCAG 2.1 AA','tz'=>'CST (UTC-6)','phone'=>'+503 XXXX-XXXX'],
  'timor-leste'             => ['name'=>'Timor-Leste',         'short'=>'TL', 'geo'=>'TL','lang'=>'pt-TL','locale'=>'pt_TL','compliance'=>'N/A','access'=>'WCAG 2.1 AA','tz'=>'TLT (UTC+9)','phone'=>'+670 XXX XXXX'],
  'republic-of-the-congo'   => ['name'=>'Republic of the Congo','short'=>'CG','geo'=>'CG','lang'=>'fr-CG','locale'=>'fr_CG','compliance'=>'GDPR-aligned','access'=>'WCAG 2.1 AA','tz'=>'WAT (UTC+1)','phone'=>'+242 XX XXX XXXX'],
  'democratic-republic-of-the-congo'=>['name'=>'DR Congo','short'=>'CD','geo'=>'CD','lang'=>'fr-CD','locale'=>'fr_CD','compliance'=>'GDPR-aligned','access'=>'WCAG 2.1 AA','tz'=>'WAT / CAT','phone'=>'+243 XX XXX XXXX'],
  'central-african-republic'=>['name'=>'Central African Republic','short'=>'CF','geo'=>'CF','lang'=>'fr-CF','locale'=>'fr_CF','compliance'=>'N/A','access'=>'WCAG 2.1 AA','tz'=>'WAT (UTC+1)','phone'=>'+236 XX XX XX XX'],
  'saint-kitts-and-nevis'  =>['name'=>'Saint Kitts and Nevis',  'short'=>'KN','geo'=>'KN','lang'=>'en-KN','locale'=>'en_KN','compliance'=>'OECS Digital Economy Framework','access'=>'WCAG 2.1 AA','tz'=>'AST (UTC-4)','phone'=>'+1 (869) XXX-XXXX'],
  'dominican-republic'     =>['name'=>'Dominican Republic',     'short'=>'DO','geo'=>'DO','lang'=>'es-DO','locale'=>'es_DO','compliance'=>'Law 172-13','access'=>'WCAG 2.1 AA','tz'=>'AST (UTC-4)','phone'=>'+1 (809) XXX-XXXX'],
  'solomon-islands'        =>['name'=>'Solomon Islands',        'short'=>'SB','geo'=>'SB','lang'=>'en-SB','locale'=>'en_SB','compliance'=>'Privacy Act (Solomon Islands)','access'=>'WCAG 2.1 AA','tz'=>'SBT (UTC+11)','phone'=>'+677 XXXXX'],
  'marshall-islands'       =>['name'=>'Marshall Islands',       'short'=>'MH','geo'=>'MH','lang'=>'en-MH','locale'=>'en_MH','compliance'=>'MIIT Data Protection','access'=>'WCAG 2.1 AA','tz'=>'MHT (UTC+12)','phone'=>'+692 XXX-XXXX'],
  'vatican-city-state'     =>['name'=>'Vatican City',           'short'=>'VA','geo'=>'VA','lang'=>'it-VA','locale'=>'it_VA','compliance'=>'GDPR','access'=>'WCAG 2.1 AA','tz'=>'CET / CEST','phone'=>'+379 06698 XXXXX'],
  'fiji-islands'           =>['name'=>'Fiji',                   'short'=>'FJ','geo'=>'FJ','lang'=>'en-FJ','locale'=>'en_FJ','compliance'=>'Online Safety Act 2018 / PDPA','access'=>'WCAG 2.1 AA','tz'=>'FJT (UTC+12)','phone'=>'+679 XXX XXXX'],
  'guinea-bissau'          =>['name'=>'Guinea-Bissau',          'short'=>'GW','geo'=>'GW','lang'=>'pt-GW','locale'=>'pt_GW','compliance'=>'ECOWAS Data Protection Framework','access'=>'WCAG 2.1 AA','tz'=>'GMT','phone'=>'+245 XXX XXXX'],
  'cape-verde'             =>['name'=>'Cape Verde',             'short'=>'CV','geo'=>'CV','lang'=>'pt-CV','locale'=>'pt_CV','compliance'=>'Law 133/V/2001','access'=>'WCAG 2.1 AA','tz'=>'CVT (UTC-1)','phone'=>'+238 XXX XXXX'],
  'cote-d-ivoire'          =>["name"=>"Côte d'Ivoire",          'short'=>'CI','geo'=>'CI','lang'=>'fr-CI','locale'=>'fr_CI','compliance'=>'ARTCI / GDPR-aligned','access'=>'WCAG 2.1 AA','tz'=>'GMT','phone'=>'+225 XX XX XX XX'],
  'swaziland'              =>['name'=>'Eswatini',               'short'=>'SZ','geo'=>'SZ','lang'=>'en-SZ','locale'=>'en_SZ','compliance'=>'Data Protection Act (Eswatini)','access'=>'WCAG 2.1 AA','tz'=>'SAST (UTC+2)','phone'=>'+268 XXXX XXXX'],

  // ── Single-word country slugs ──────────────────────────────
  'afghanistan' => ['name'=>'Afghanistan',  'geo'=>'AF','lang'=>'en-AF','locale'=>'en_AF','compliance'=>'N/A','access'=>'WCAG 2.1 AA','tz'=>'AFT (UTC+4:30)','phone'=>'+93 XX XXX XXXX'],
  'albania'     => ['name'=>'Albania',      'geo'=>'AL','lang'=>'en-AL','locale'=>'sq_AL','compliance'=>'GDPR-aligned','access'=>'WCAG 2.1 AA','tz'=>'CET / CEST','phone'=>'+355 XX XXX XXXX'],
  'algeria'     => ['name'=>'Algeria',      'geo'=>'DZ','lang'=>'en-DZ','locale'=>'ar_DZ','compliance'=>'Law 18-07','access'=>'WCAG 2.1 AA','tz'=>'CET (UTC+1)','phone'=>'+213 XX XX XX XX'],
  'andorra'     => ['name'=>'Andorra',      'geo'=>'AD','lang'=>'en-AD','locale'=>'ca_AD','compliance'=>'GDPR','access'=>'WCAG 2.1 AA','tz'=>'CET / CEST','phone'=>'+376 XXX XXX'],
  'angola'      => ['name'=>'Angola',       'geo'=>'AO','lang'=>'en-AO','locale'=>'pt_AO','compliance'=>'LGPD-aligned','access'=>'WCAG 2.1 AA','tz'=>'WAT (UTC+1)','phone'=>'+244 XXX XXX XXX'],
  'argentina'   => ['name'=>'Argentina',    'geo'=>'AR','lang'=>'es-AR','locale'=>'es_AR','compliance'=>'PDPA (Argentina)','access'=>'WCAG 2.1 AA','tz'=>'ART (UTC-3)','phone'=>'+54 XX XXXX-XXXX'],
  'armenia'     => ['name'=>'Armenia',      'geo'=>'AM','lang'=>'en-AM','locale'=>'hy_AM','compliance'=>'Law on Personal Data','access'=>'WCAG 2.1 AA','tz'=>'AMT (UTC+4)','phone'=>'+374 XX XXX XXX'],
  'australia'   => ['name'=>'Australia',    'geo'=>'AU','lang'=>'en-AU','locale'=>'en_AU','compliance'=>'Privacy Act 1988','access'=>'DDA / WCAG 2.1','tz'=>'AEST / AWST','phone'=>'+61 X XXXX XXXX'],
  'austria'     => ['name'=>'Austria',      'geo'=>'AT','lang'=>'en-AT','locale'=>'de_AT','compliance'=>'GDPR / DSG','access'=>'WZG / WCAG 2.1','tz'=>'CET / CEST','phone'=>'+43 XXX XXXXXX'],
  'azerbaijan'  => ['name'=>'Azerbaijan',   'geo'=>'AZ','lang'=>'en-AZ','locale'=>'az_AZ','compliance'=>'Law on Personal Data','access'=>'WCAG 2.1 AA','tz'=>'AZT (UTC+4)','phone'=>'+994 XX XXX XX XX'],
  'bahrain'     => ['name'=>'Bahrain',      'geo'=>'BH','lang'=>'en-BH','locale'=>'ar_BH','compliance'=>'PDPL (Bahrain)','access'=>'WCAG 2.1 AA','tz'=>'AST (UTC+3)','phone'=>'+973 XXXX XXXX'],
  'bangladesh'  => ['name'=>'Bangladesh',   'geo'=>'BD','lang'=>'en-BD','locale'=>'bn_BD','compliance'=>'Digital Security Act','access'=>'WCAG 2.1 AA','tz'=>'BST (UTC+6)','phone'=>'+880 XX XXXX XXXX'],
  'barbados'    => ['name'=>'Barbados',     'geo'=>'BB','lang'=>'en-BB','locale'=>'en_BB','compliance'=>'DPA (Barbados)','access'=>'WCAG 2.1 AA','tz'=>'AST (UTC-4)','phone'=>'+1 (246) XXX-XXXX'],
  'belarus'     => ['name'=>'Belarus',      'geo'=>'BY','lang'=>'en-BY','locale'=>'be_BY','compliance'=>'Law on Personal Data','access'=>'WCAG 2.1 AA','tz'=>'FET (UTC+3)','phone'=>'+375 XX XXX XX XX'],
  'belgium'     => ['name'=>'Belgium',      'geo'=>'BE','lang'=>'en-BE','locale'=>'nl_BE','compliance'=>'GDPR / APD','access'=>'WCAG 2.1 AA','tz'=>'CET / CEST','phone'=>'+32 XXX XX XX XX'],
  'belize'      => ['name'=>'Belize',       'geo'=>'BZ','lang'=>'en-BZ','locale'=>'en_BZ','compliance'=>'DPA (Belize)','access'=>'WCAG 2.1 AA','tz'=>'CST (UTC-6)','phone'=>'+501 XXX-XXXX'],
  'benin'       => ['name'=>'Benin',        'geo'=>'BJ','lang'=>'fr-BJ','locale'=>'fr_BJ','compliance'=>'GDPR-aligned','access'=>'WCAG 2.1 AA','tz'=>'WAT (UTC+1)','phone'=>'+229 XX XX XX XX'],
  'bhutan'      => ['name'=>'Bhutan',       'geo'=>'BT','lang'=>'en-BT','locale'=>'dz_BT','compliance'=>'ICT Policy','access'=>'WCAG 2.1 AA','tz'=>'BTT (UTC+6)','phone'=>'+975 XX XXX XXX'],
  'bolivia'     => ['name'=>'Bolivia',      'geo'=>'BO','lang'=>'es-BO','locale'=>'es_BO','compliance'=>'Law 164','access'=>'WCAG 2.1 AA','tz'=>'BOT (UTC-4)','phone'=>'+591 X XXX XXXX'],
  'botswana'    => ['name'=>'Botswana',     'geo'=>'BW','lang'=>'en-BW','locale'=>'en_BW','compliance'=>'DPA (Botswana)','access'=>'WCAG 2.1 AA','tz'=>'CAT (UTC+2)','phone'=>'+267 XX XXX XXX'],
  'brazil'      => ['name'=>'Brazil',       'geo'=>'BR','lang'=>'pt-BR','locale'=>'pt_BR','compliance'=>'LGPD (Lei Geral de Proteção de Dados)','access'=>'LBI / WCAG 2.1','tz'=>'BRT (UTC-3)','phone'=>'+55 XX XXXXX-XXXX'],
  'brunei'      => ['name'=>'Brunei',       'geo'=>'BN','lang'=>'en-BN','locale'=>'ms_BN','compliance'=>'PDPO (Brunei)','access'=>'WCAG 2.1 AA','tz'=>'BNT (UTC+8)','phone'=>'+673 XXX XXXX'],
  'bulgaria'    => ['name'=>'Bulgaria',     'geo'=>'BG','lang'=>'en-BG','locale'=>'bg_BG','compliance'=>'GDPR / CPDP','access'=>'WCAG 2.1 AA','tz'=>'EET / EEST','phone'=>'+359 XX XXX XXXX'],
  'burundi'     => ['name'=>'Burundi',      'geo'=>'BI','lang'=>'fr-BI','locale'=>'fr_BI','compliance'=>'GDPR-aligned','access'=>'WCAG 2.1 AA','tz'=>'EAT (UTC+3)','phone'=>'+257 XX XX XXXX'],
  'cambodia'    => ['name'=>'Cambodia',     'geo'=>'KH','lang'=>'en-KH','locale'=>'km_KH','compliance'=>'Data Privacy Law (2023)','access'=>'WCAG 2.1 AA','tz'=>'ICT (UTC+7)','phone'=>'+855 XX XXX XXX'],
  'cameroon'    => ['name'=>'Cameroon',     'geo'=>'CM','lang'=>'en-CM','locale'=>'fr_CM','compliance'=>'GDPR-aligned','access'=>'WCAG 2.1 AA','tz'=>'WAT (UTC+1)','phone'=>'+237 XXX XX XX XX'],
  'canada'      => ['name'=>'Canada',       'geo'=>'CA','lang'=>'en-CA','locale'=>'en_CA','compliance'=>'PIPEDA','access'=>'Accessible Canada Act / WCAG 2.1','tz'=>'EST / PST','phone'=>'+1 (XXX) XXX-XXXX'],
  'chad'        => ['name'=>'Chad',         'geo'=>'TD','lang'=>'fr-TD','locale'=>'fr_TD','compliance'=>'GDPR-aligned','access'=>'WCAG 2.1 AA','tz'=>'WAT (UTC+1)','phone'=>'+235 XX XX XX XX'],
  'chile'       => ['name'=>'Chile',        'geo'=>'CL','lang'=>'es-CL','locale'=>'es_CL','compliance'=>'Law 19.628','access'=>'WCAG 2.1 AA','tz'=>'CLT (UTC-4)','phone'=>'+56 X XXXX XXXX'],
  'china'       => ['name'=>'China',        'geo'=>'CN','lang'=>'zh-CN','locale'=>'zh_CN','compliance'=>'PIPL (China)','access'=>'GB/T 37668-2019 / WCAG','tz'=>'CST (UTC+8)','phone'=>'+86 XXX XXXX XXXX'],
  'colombia'    => ['name'=>'Colombia',     'geo'=>'CO','lang'=>'es-CO','locale'=>'es_CO','compliance'=>'Law 1581','access'=>'WCAG 2.1 AA','tz'=>'COT (UTC-5)','phone'=>'+57 XXX XXX XXXX'],
  'comoros'     => ['name'=>'Comoros',      'geo'=>'KM','lang'=>'fr-KM','locale'=>'fr_KM','compliance'=>'GDPR-aligned','access'=>'WCAG 2.1 AA','tz'=>'EAT (UTC+3)','phone'=>'+269 XXX XXXX'],
  'croatia'     => ['name'=>'Croatia',      'geo'=>'HR','lang'=>'en-HR','locale'=>'hr_HR','compliance'=>'GDPR / AZOP','access'=>'WCAG 2.1 AA','tz'=>'CET / CEST','phone'=>'+385 XX XXX XXXX'],
  'cuba'        => ['name'=>'Cuba',         'geo'=>'CU','lang'=>'es-CU','locale'=>'es_CU','compliance'=>'N/A','access'=>'WCAG 2.1 AA','tz'=>'CST (UTC-5)','phone'=>'+53 X XXX XXXX'],
  'cyprus'      => ['name'=>'Cyprus',       'geo'=>'CY','lang'=>'en-CY','locale'=>'el_CY','compliance'=>'GDPR','access'=>'WCAG 2.1 AA','tz'=>'EET / EEST','phone'=>'+357 XX XXXXXX'],
  'denmark'     => ['name'=>'Denmark',      'geo'=>'DK','lang'=>'en-DK','locale'=>'da_DK','compliance'=>'GDPR / Datatilsynet','access'=>'WCAG 2.1 AA','tz'=>'CET / CEST','phone'=>'+45 XXXX XXXX'],
  'djibouti'    => ['name'=>'Djibouti',     'geo'=>'DJ','lang'=>'fr-DJ','locale'=>'fr_DJ','compliance'=>'GDPR-aligned','access'=>'WCAG 2.1 AA','tz'=>'EAT (UTC+3)','phone'=>'+253 XX XX XX XX'],
  'dominica'    => ['name'=>'Dominica',     'geo'=>'DM','lang'=>'en-DM','locale'=>'en_DM','compliance'=>'ECSC Model Law','access'=>'WCAG 2.1 AA','tz'=>'AST (UTC-4)','phone'=>'+1 (767) XXX-XXXX'],
  'ecuador'     => ['name'=>'Ecuador',      'geo'=>'EC','lang'=>'es-EC','locale'=>'es_EC','compliance'=>'LOPDP (Ecuador)','access'=>'WCAG 2.1 AA','tz'=>'ECT (UTC-5)','phone'=>'+593 XX XXX XXXX'],
  'egypt'       => ['name'=>'Egypt',        'geo'=>'EG','lang'=>'en-EG','locale'=>'ar_EG','compliance'=>'Law 151/2020','access'=>'WCAG 2.1 AA','tz'=>'EET (UTC+2)','phone'=>'+20 XX XXXX XXXX'],
  'eritrea'     => ['name'=>'Eritrea',      'geo'=>'ER','lang'=>'en-ER','locale'=>'ti_ER','compliance'=>'N/A','access'=>'WCAG 2.1 AA','tz'=>'EAT (UTC+3)','phone'=>'+291 X XXX XXX'],
  'estonia'     => ['name'=>'Estonia',      'geo'=>'EE','lang'=>'en-EE','locale'=>'et_EE','compliance'=>'GDPR / AKI','access'=>'WCAG 2.1 AA','tz'=>'EET / EEST','phone'=>'+372 XXXX XXXX'],
  'ethiopia'    => ['name'=>'Ethiopia',     'geo'=>'ET','lang'=>'en-ET','locale'=>'am_ET','compliance'=>'DP Proclamation','access'=>'WCAG 2.1 AA','tz'=>'EAT (UTC+3)','phone'=>'+251 XX XXX XXXX'],
  'finland'     => ['name'=>'Finland',      'geo'=>'FI','lang'=>'en-FI','locale'=>'fi_FI','compliance'=>'GDPR / Tietosuojalaki','access'=>'WCAG 2.1 AA','tz'=>'EET / EEST','phone'=>'+358 XX XXX XXXX'],
  'france'      => ['name'=>'France',       'geo'=>'FR','lang'=>'en-FR','locale'=>'fr_FR','compliance'=>'GDPR / CNIL','access'=>'RGAA / WCAG 2.1','tz'=>'CET / CEST','phone'=>'+33 X XX XX XX XX'],
  'gabon'       => ['name'=>'Gabon',        'geo'=>'GA','lang'=>'fr-GA','locale'=>'fr_GA','compliance'=>'GDPR-aligned','access'=>'WCAG 2.1 AA','tz'=>'WAT (UTC+1)','phone'=>'+241 X XX XX XX'],
  'gambia'      => ['name'=>'Gambia',       'geo'=>'GM','lang'=>'en-GM','locale'=>'en_GM','compliance'=>'ICA (Gambia)','access'=>'WCAG 2.1 AA','tz'=>'GMT','phone'=>'+220 XXX XXXX'],
  'georgia'     => ['name'=>'Georgia',      'geo'=>'GE','lang'=>'en-GE','locale'=>'ka_GE','compliance'=>'GDPR-aligned','access'=>'WCAG 2.1 AA','tz'=>'GET (UTC+4)','phone'=>'+995 XXX XX XX XX'],
  'germany'     => ['name'=>'Germany',      'geo'=>'DE','lang'=>'en-DE','locale'=>'de_DE','compliance'=>'GDPR / BDSG','access'=>'BITV 2.0 / EAA / WCAG 2.1','tz'=>'CET / CEST','phone'=>'+49 XXX XXXXXXX'],
  'ghana'       => ['name'=>'Ghana',        'geo'=>'GH','lang'=>'en-GH','locale'=>'en_GH','compliance'=>'Data Protection Act 2012','access'=>'WCAG 2.1 AA','tz'=>'GMT','phone'=>'+233 XX XXX XXXX'],
  'greece'      => ['name'=>'Greece',       'geo'=>'GR','lang'=>'en-GR','locale'=>'el_GR','compliance'=>'GDPR / HDPA','access'=>'WCAG 2.1 AA','tz'=>'EET / EEST','phone'=>'+30 XXX XXX XXXX'],
  'grenada'     => ['name'=>'Grenada',      'geo'=>'GD','lang'=>'en-GD','locale'=>'en_GD','compliance'=>'ECSC Model Law','access'=>'WCAG 2.1 AA','tz'=>'AST (UTC-4)','phone'=>'+1 (473) XXX-XXXX'],
  'guatemala'   => ['name'=>'Guatemala',    'geo'=>'GT','lang'=>'es-GT','locale'=>'es_GT','compliance'=>'Law 57/92','access'=>'WCAG 2.1 AA','tz'=>'CST (UTC-6)','phone'=>'+502 X XXX XXXX'],
  'guinea'      => ['name'=>'Guinea',       'geo'=>'GN','lang'=>'fr-GN','locale'=>'fr_GN','compliance'=>'GDPR-aligned','access'=>'WCAG 2.1 AA','tz'=>'GMT','phone'=>'+224 XX XXX XXXX'],
  'guyana'      => ['name'=>'Guyana',       'geo'=>'GY','lang'=>'en-GY','locale'=>'en_GY','compliance'=>'DPA (Guyana)','access'=>'WCAG 2.1 AA','tz'=>'GYT (UTC-4)','phone'=>'+592 XXX-XXXX'],
  'haiti'       => ['name'=>'Haiti',        'geo'=>'HT','lang'=>'fr-HT','locale'=>'ht_HT','compliance'=>'N/A','access'=>'WCAG 2.1 AA','tz'=>'EST / EDT','phone'=>'+509 XXXX XXXX'],
  'honduras'    => ['name'=>'Honduras',     'geo'=>'HN','lang'=>'es-HN','locale'=>'es_HN','compliance'=>'Decree 211/2019','access'=>'WCAG 2.1 AA','tz'=>'CST (UTC-6)','phone'=>'+504 XXXX-XXXX'],
  'hungary'     => ['name'=>'Hungary',      'geo'=>'HU','lang'=>'en-HU','locale'=>'hu_HU','compliance'=>'GDPR / NAIH','access'=>'WCAG 2.1 AA','tz'=>'CET / CEST','phone'=>'+36 XX XXX XXXX'],
  'iceland'     => ['name'=>'Iceland',      'geo'=>'IS','lang'=>'en-IS','locale'=>'is_IS','compliance'=>'GDPR / Persónuvernd','access'=>'WCAG 2.1 AA','tz'=>'GMT','phone'=>'+354 XXX XXXX'],
  'india'       => ['name'=>'India',        'geo'=>'IN','lang'=>'en-IN','locale'=>'en_IN','compliance'=>'DPDP Act 2023','access'=>'RPWD Act 2016 / WCAG 2.1','tz'=>'IST (UTC+5:30)','phone'=>'+91 XXXXX XXXXX'],
  'indonesia'   => ['name'=>'Indonesia',    'geo'=>'ID','lang'=>'en-ID','locale'=>'id_ID','compliance'=>'GR No. 71/2019 (PDP)','access'=>'WCAG 2.1 AA','tz'=>'WIB / WIT / WITA','phone'=>'+62 XXX XXXX XXXX'],
  'iran'        => ['name'=>'Iran',         'geo'=>'IR','lang'=>'en-IR','locale'=>'fa_IR','compliance'=>'N/A','access'=>'WCAG 2.1 AA','tz'=>'IRST (UTC+3:30)','phone'=>'+98 XXX XXX XXXX'],
  'iraq'        => ['name'=>'Iraq',         'geo'=>'IQ','lang'=>'en-IQ','locale'=>'ar_IQ','compliance'=>'N/A','access'=>'WCAG 2.1 AA','tz'=>'AST (UTC+3)','phone'=>'+964 XXX XXX XXXX'],
  'ireland'     => ['name'=>'Ireland',      'geo'=>'IE','lang'=>'en-IE','locale'=>'en_IE','compliance'=>'GDPR / DPC','access'=>'WCAG 2.1 AA','tz'=>'IST / GMT','phone'=>'+353 XX XXX XXXX'],
  'israel'      => ['name'=>'Israel',       'geo'=>'IL','lang'=>'en-IL','locale'=>'he_IL','compliance'=>'Privacy Protection Law','access'=>'IS 5568 / WCAG 2.1','tz'=>'IST (UTC+2)','phone'=>'+972 XX XXX XXXX'],
  'italy'       => ['name'=>'Italy',        'geo'=>'IT','lang'=>'en-IT','locale'=>'it_IT','compliance'=>'GDPR / Codice Privacy','access'=>'Stanca Act / WCAG 2.1','tz'=>'CET / CEST','phone'=>'+39 XXX XXX XXXX'],
  'jamaica'     => ['name'=>'Jamaica',      'geo'=>'JM','lang'=>'en-JM','locale'=>'en_JM','compliance'=>'DPA (Jamaica)','access'=>'WCAG 2.1 AA','tz'=>'EST (UTC-5)','phone'=>'+1 (876) XXX-XXXX'],
  'japan'       => ['name'=>'Japan',        'geo'=>'JP','lang'=>'ja-JP','locale'=>'ja_JP','compliance'=>'APPI (Japan)','access'=>'JIS X 8341 / WCAG 2.1','tz'=>'JST (UTC+9)','phone'=>'+81 XXX XXXX XXXX'],
  'jordan'      => ['name'=>'Jordan',       'geo'=>'JO','lang'=>'en-JO','locale'=>'ar_JO','compliance'=>'Law 24/2022','access'=>'WCAG 2.1 AA','tz'=>'EET / EEST','phone'=>'+962 X XXXX XXXX'],
  'kazakhstan'  => ['name'=>'Kazakhstan',   'geo'=>'KZ','lang'=>'en-KZ','locale'=>'kk_KZ','compliance'=>'Law on Personal Data','access'=>'WCAG 2.1 AA','tz'=>'ALMT (UTC+6)','phone'=>'+7 XXX XXX XXXX'],
  'kenya'       => ['name'=>'Kenya',        'geo'=>'KE','lang'=>'en-KE','locale'=>'en_KE','compliance'=>'DPA 2019 (Kenya)','access'=>'WCAG 2.1 AA','tz'=>'EAT (UTC+3)','phone'=>'+254 XXX XXX XXX'],
  'kiribati'    => ['name'=>'Kiribati',     'geo'=>'KI','lang'=>'en-KI','locale'=>'en_KI','compliance'=>'N/A','access'=>'WCAG 2.1 AA','tz'=>'GILT (UTC+12)','phone'=>'+686 XXXXX'],
  'kosovo'      => ['name'=>'Kosovo',       'geo'=>'XK','lang'=>'en-XK','locale'=>'sq_XK','compliance'=>'GDPR-aligned','access'=>'WCAG 2.1 AA','tz'=>'CET / CEST','phone'=>'+383 XX XXX XXX'],
  'kuwait'      => ['name'=>'Kuwait',       'geo'=>'KW','lang'=>'en-KW','locale'=>'ar_KW','compliance'=>'DPL (Kuwait)','access'=>'WCAG 2.1 AA','tz'=>'AST (UTC+3)','phone'=>'+965 XXXX XXXX'],
  'kyrgyzstan'  => ['name'=>'Kyrgyzstan',   'geo'=>'KG','lang'=>'en-KG','locale'=>'ky_KG','compliance'=>'Law on Personal Data','access'=>'WCAG 2.1 AA','tz'=>'KGT (UTC+6)','phone'=>'+996 XXX XXXXXX'],
  'laos'        => ['name'=>'Laos',         'geo'=>'LA','lang'=>'en-LA','locale'=>'lo_LA','compliance'=>'N/A','access'=>'WCAG 2.1 AA','tz'=>'ICT (UTC+7)','phone'=>'+856 XX XXX XXXX'],
  'latvia'      => ['name'=>'Latvia',       'geo'=>'LV','lang'=>'en-LV','locale'=>'lv_LV','compliance'=>'GDPR / DVI','access'=>'WCAG 2.1 AA','tz'=>'EET / EEST','phone'=>'+371 XXXX XXXX'],
  'lebanon'     => ['name'=>'Lebanon',      'geo'=>'LB','lang'=>'en-LB','locale'=>'ar_LB','compliance'=>'Law 81/2018','access'=>'WCAG 2.1 AA','tz'=>'EET / EEST','phone'=>'+961 X XXX XXX'],
  'lesotho'     => ['name'=>'Lesotho',      'geo'=>'LS','lang'=>'en-LS','locale'=>'st_LS','compliance'=>'DPA (Lesotho)','access'=>'WCAG 2.1 AA','tz'=>'SAST (UTC+2)','phone'=>'+266 XXXX XXXX'],
  'liberia'     => ['name'=>'Liberia',      'geo'=>'LR','lang'=>'en-LR','locale'=>'en_LR','compliance'=>'N/A','access'=>'WCAG 2.1 AA','tz'=>'GMT','phone'=>'+231 XXX XXX XXX'],
  'libya'       => ['name'=>'Libya',        'geo'=>'LY','lang'=>'en-LY','locale'=>'ar_LY','compliance'=>'N/A','access'=>'WCAG 2.1 AA','tz'=>'EET (UTC+2)','phone'=>'+218 XX XXX XXXX'],
  'liechtenstein'=>['name'=>'Liechtenstein','geo'=>'LI','lang'=>'en-LI','locale'=>'de_LI','compliance'=>'GDPR','access'=>'WCAG 2.1 AA','tz'=>'CET / CEST','phone'=>'+423 XXX XXXX'],
  'lithuania'   => ['name'=>'Lithuania',    'geo'=>'LT','lang'=>'en-LT','locale'=>'lt_LT','compliance'=>'GDPR / ADA (LT)','access'=>'WCAG 2.1 AA','tz'=>'EET / EEST','phone'=>'+370 XXX XXXXX'],
  'luxembourg'  => ['name'=>'Luxembourg',   'geo'=>'LU','lang'=>'en-LU','locale'=>'fr_LU','compliance'=>'GDPR / CNPD','access'=>'WCAG 2.1 AA','tz'=>'CET / CEST','phone'=>'+352 XXX XXX XXX'],
  'macedonia'   => ['name'=>'North Macedonia','geo'=>'MK','lang'=>'en-MK','locale'=>'mk_MK','compliance'=>'GDPR-aligned','access'=>'WCAG 2.1 AA','tz'=>'CET / CEST','phone'=>'+389 XX XXX XXX'],
  'madagascar'  => ['name'=>'Madagascar',   'geo'=>'MG','lang'=>'fr-MG','locale'=>'mg_MG','compliance'=>'GDPR-aligned','access'=>'WCAG 2.1 AA','tz'=>'EAT (UTC+3)','phone'=>'+261 XX XX XXX XX'],
  'malawi'      => ['name'=>'Malawi',       'geo'=>'MW','lang'=>'en-MW','locale'=>'en_MW','compliance'=>'DPA (Malawi)','access'=>'WCAG 2.1 AA','tz'=>'CAT (UTC+2)','phone'=>'+265 X XXXX XXXX'],
  'malaysia'    => ['name'=>'Malaysia',     'geo'=>'MY','lang'=>'en-MY','locale'=>'ms_MY','compliance'=>'PDPA 2010 (Malaysia)','access'=>'WCAG 2.1 AA','tz'=>'MYT (UTC+8)','phone'=>'+60 XX XXXX XXXX'],
  'maldives'    => ['name'=>'Maldives',     'geo'=>'MV','lang'=>'en-MV','locale'=>'dv_MV','compliance'=>'DPA (Maldives)','access'=>'WCAG 2.1 AA','tz'=>'MVT (UTC+5)','phone'=>'+960 XXX-XXXX'],
  'mali'        => ['name'=>'Mali',         'geo'=>'ML','lang'=>'fr-ML','locale'=>'fr_ML','compliance'=>'GDPR-aligned','access'=>'WCAG 2.1 AA','tz'=>'GMT','phone'=>'+223 XX XX XX XX'],
  'malta'       => ['name'=>'Malta',        'geo'=>'MT','lang'=>'en-MT','locale'=>'mt_MT','compliance'=>'GDPR / IDPC','access'=>'WCAG 2.1 AA','tz'=>'CET / CEST','phone'=>'+356 XXXX XXXX'],
  'mauritania'  => ['name'=>'Mauritania',   'geo'=>'MR','lang'=>'fr-MR','locale'=>'ar_MR','compliance'=>'GDPR-aligned','access'=>'WCAG 2.1 AA','tz'=>'GMT','phone'=>'+222 XXXX XXXX'],
  'mauritius'   => ['name'=>'Mauritius',    'geo'=>'MU','lang'=>'en-MU','locale'=>'fr_MU','compliance'=>'DPA 2017 (Mauritius)','access'=>'WCAG 2.1 AA','tz'=>'MUT (UTC+4)','phone'=>'+230 XXXX XXXX'],
  'mexico'      => ['name'=>'Mexico',       'geo'=>'MX','lang'=>'es-MX','locale'=>'es_MX','compliance'=>'LFPDPPP (Mexico)','access'=>'NMX-I-041 / WCAG 2.1','tz'=>'CST / PST / EST','phone'=>'+52 XX XXXX XXXX'],
  'micronesia'  => ['name'=>'Micronesia',   'geo'=>'FM','lang'=>'en-FM','locale'=>'en_FM','compliance'=>'N/A','access'=>'WCAG 2.1 AA','tz'=>'PONT (UTC+11)','phone'=>'+691 XXX-XXXX'],
  'moldova'     => ['name'=>'Moldova',      'geo'=>'MD','lang'=>'en-MD','locale'=>'ro_MD','compliance'=>'GDPR-aligned','access'=>'WCAG 2.1 AA','tz'=>'EET / EEST','phone'=>'+373 XX XXX XXX'],
  'monaco'      => ['name'=>'Monaco',       'geo'=>'MC','lang'=>'en-MC','locale'=>'fr_MC','compliance'=>'GDPR','access'=>'WCAG 2.1 AA','tz'=>'CET / CEST','phone'=>'+377 XXXX XXXX'],
  'mongolia'    => ['name'=>'Mongolia',     'geo'=>'MN','lang'=>'en-MN','locale'=>'mn_MN','compliance'=>'Law on Personal Data','access'=>'WCAG 2.1 AA','tz'=>'ULAT (UTC+8)','phone'=>'+976 XX XXX XXX'],
  'montenegro'  => ['name'=>'Montenegro',   'geo'=>'ME','lang'=>'en-ME','locale'=>'sr_ME','compliance'=>'GDPR-aligned','access'=>'WCAG 2.1 AA','tz'=>'CET / CEST','phone'=>'+382 XX XXX XXX'],
  'morocco'     => ['name'=>'Morocco',      'geo'=>'MA','lang'=>'en-MA','locale'=>'ar_MA','compliance'=>'Law 09-08','access'=>'WCAG 2.1 AA','tz'=>'WET / WEST','phone'=>'+212 XX XXXX XXXX'],
  'mozambique'  => ['name'=>'Mozambique',   'geo'=>'MZ','lang'=>'pt-MZ','locale'=>'pt_MZ','compliance'=>'GDPR-aligned','access'=>'WCAG 2.1 AA','tz'=>'CAT (UTC+2)','phone'=>'+258 XX XXX XXXX'],
  'myanmar'     => ['name'=>'Myanmar',      'geo'=>'MM','lang'=>'en-MM','locale'=>'my_MM','compliance'=>'N/A','access'=>'WCAG 2.1 AA','tz'=>'MMT (UTC+6:30)','phone'=>'+95 X XXX XXXX'],
  'namibia'     => ['name'=>'Namibia',      'geo'=>'NA','lang'=>'en-NA','locale'=>'en_NA','compliance'=>'DP Act (Namibia)','access'=>'WCAG 2.1 AA','tz'=>'WAT / CAT','phone'=>'+264 XX XXX XXXX'],
  'nauru'       => ['name'=>'Nauru',        'geo'=>'NR','lang'=>'en-NR','locale'=>'en_NR','compliance'=>'N/A','access'=>'WCAG 2.1 AA','tz'=>'NRT (UTC+12)','phone'=>'+674 XXX XXXX'],
  'nepal'       => ['name'=>'Nepal',        'geo'=>'NP','lang'=>'en-NP','locale'=>'ne_NP','compliance'=>'Privacy Act (Nepal)','access'=>'WCAG 2.1 AA','tz'=>'NPT (UTC+5:45)','phone'=>'+977 XX XXXX XXXX'],
  'netherlands' => ['name'=>'Netherlands',  'geo'=>'NL','lang'=>'en-NL','locale'=>'nl_NL','compliance'=>'GDPR / AP','access'=>'WCAG 2.1 AA','tz'=>'CET / CEST','phone'=>'+31 XX XXX XXXX'],
  'nicaragua'   => ['name'=>'Nicaragua',    'geo'=>'NI','lang'=>'es-NI','locale'=>'es_NI','compliance'=>'Law 787','access'=>'WCAG 2.1 AA','tz'=>'CST (UTC-6)','phone'=>'+505 XXXX XXXX'],
  'niger'       => ['name'=>'Niger',        'geo'=>'NE','lang'=>'fr-NE','locale'=>'fr_NE','compliance'=>'GDPR-aligned','access'=>'WCAG 2.1 AA','tz'=>'WAT (UTC+1)','phone'=>'+227 XX XX XX XX'],
  'nigeria'     => ['name'=>'Nigeria',      'geo'=>'NG','lang'=>'en-NG','locale'=>'en_NG','compliance'=>'NDPR 2019','access'=>'WCAG 2.1 AA','tz'=>'WAT (UTC+1)','phone'=>'+234 XXX XXX XXXX'],
  'norway'      => ['name'=>'Norway',       'geo'=>'NO','lang'=>'en-NO','locale'=>'nb_NO','compliance'=>'GDPR / Datatilsynet','access'=>'WCAG 2.1 AA','tz'=>'CET / CEST','phone'=>'+47 XXX XX XXX'],
  'oman'        => ['name'=>'Oman',         'geo'=>'OM','lang'=>'en-OM','locale'=>'ar_OM','compliance'=>'Royal Decree 6/2022','access'=>'WCAG 2.1 AA','tz'=>'GST (UTC+4)','phone'=>'+968 XXXX XXXX'],
  'pakistan'    => ['name'=>'Pakistan',     'geo'=>'PK','lang'=>'en-PK','locale'=>'ur_PK','compliance'=>'PECA 2016','access'=>'WCAG 2.1 AA','tz'=>'PKT (UTC+5)','phone'=>'+92 XXX XXX XXXX'],
  'palau'       => ['name'=>'Palau',        'geo'=>'PW','lang'=>'en-PW','locale'=>'en_PW','compliance'=>'N/A','access'=>'WCAG 2.1 AA','tz'=>'PWT (UTC+9)','phone'=>'+680 XXX XXXX'],
  'palestine'   => ['name'=>'Palestine',    'geo'=>'PS','lang'=>'en-PS','locale'=>'ar_PS','compliance'=>'N/A','access'=>'WCAG 2.1 AA','tz'=>'EET / EEST','phone'=>'+970 XX XXX XXXX'],
  'panama'      => ['name'=>'Panama',       'geo'=>'PA','lang'=>'es-PA','locale'=>'es_PA','compliance'=>'Law 81/2019','access'=>'WCAG 2.1 AA','tz'=>'EST (UTC-5)','phone'=>'+507 XXXX-XXXX'],
  'paraguay'    => ['name'=>'Paraguay',     'geo'=>'PY','lang'=>'es-PY','locale'=>'es_PY','compliance'=>'Law 1682','access'=>'WCAG 2.1 AA','tz'=>'PYT (UTC-4)','phone'=>'+595 XXX XXX XXX'],
  'peru'        => ['name'=>'Peru',         'geo'=>'PE','lang'=>'es-PE','locale'=>'es_PE','compliance'=>'Law 29733','access'=>'WCAG 2.1 AA','tz'=>'PET (UTC-5)','phone'=>'+51 XXX XXX XXX'],
  'philippines' => ['name'=>'Philippines',  'geo'=>'PH','lang'=>'en-PH','locale'=>'en_PH','compliance'=>'DPA 2012 (Philippines)','access'=>'WCAG 2.1 AA','tz'=>'PHT (UTC+8)','phone'=>'+63 XXX XXX XXXX'],
  'poland'      => ['name'=>'Poland',       'geo'=>'PL','lang'=>'en-PL','locale'=>'pl_PL','compliance'=>'GDPR / UODO','access'=>'WCAG 2.1 AA','tz'=>'CET / CEST','phone'=>'+48 XXX XXX XXX'],
  'portugal'    => ['name'=>'Portugal',     'geo'=>'PT','lang'=>'en-PT','locale'=>'pt_PT','compliance'=>'GDPR / CNPD','access'=>'WCAG 2.1 AA','tz'=>'WET / WEST','phone'=>'+351 XXX XXX XXX'],
  'qatar'       => ['name'=>'Qatar',        'geo'=>'QA','lang'=>'en-QA','locale'=>'ar_QA','compliance'=>'Law 13/2016','access'=>'WCAG 2.1 AA','tz'=>'AST (UTC+3)','phone'=>'+974 XXXX XXXX'],
  'romania'     => ['name'=>'Romania',      'geo'=>'RO','lang'=>'en-RO','locale'=>'ro_RO','compliance'=>'GDPR / ANSPDCP','access'=>'WCAG 2.1 AA','tz'=>'EET / EEST','phone'=>'+40 XXX XXX XXX'],
  'russia'      => ['name'=>'Russia',       'geo'=>'RU','lang'=>'en-RU','locale'=>'ru_RU','compliance'=>'Federal Law 152-FZ','access'=>'WCAG 2.1 AA','tz'=>'MSK (UTC+3)','phone'=>'+7 XXX XXX XXXX'],
  'rwanda'      => ['name'=>'Rwanda',       'geo'=>'RW','lang'=>'en-RW','locale'=>'rw_RW','compliance'=>'Law 058/2021','access'=>'WCAG 2.1 AA','tz'=>'CAT (UTC+2)','phone'=>'+250 XXX XXX XXX'],
  'samoa'       => ['name'=>'Samoa',        'geo'=>'WS','lang'=>'en-WS','locale'=>'sm_WS','compliance'=>'N/A','access'=>'WCAG 2.1 AA','tz'=>'WST (UTC+13)','phone'=>'+685 XX XXXX'],
  'senegal'     => ['name'=>'Senegal',      'geo'=>'SN','lang'=>'fr-SN','locale'=>'fr_SN','compliance'=>'GDPR-aligned / CDP','access'=>'WCAG 2.1 AA','tz'=>'GMT','phone'=>'+221 XX XXX XX XX'],
  'serbia'      => ['name'=>'Serbia',       'geo'=>'RS','lang'=>'en-RS','locale'=>'sr_RS','compliance'=>'GDPR-aligned','access'=>'WCAG 2.1 AA','tz'=>'CET / CEST','phone'=>'+381 XX XXX XXXX'],
  'seychelles'  => ['name'=>'Seychelles',   'geo'=>'SC','lang'=>'en-SC','locale'=>'fr_SC','compliance'=>'DPA (Seychelles)','access'=>'WCAG 2.1 AA','tz'=>'SCT (UTC+4)','phone'=>'+248 X XX XX XX'],
  'singapore'   => ['name'=>'Singapore',    'geo'=>'SG','lang'=>'en-SG','locale'=>'en_SG','compliance'=>'PDPA 2012','access'=>'DSS / WCAG 2.1','tz'=>'SGT (UTC+8)','phone'=>'+65 XXXX XXXX'],
  'slovakia'    => ['name'=>'Slovakia',     'geo'=>'SK','lang'=>'en-SK','locale'=>'sk_SK','compliance'=>'GDPR / UOOU','access'=>'WCAG 2.1 AA','tz'=>'CET / CEST','phone'=>'+421 XXX XXX XXX'],
  'slovenia'    => ['name'=>'Slovenia',     'geo'=>'SI','lang'=>'en-SI','locale'=>'sl_SI','compliance'=>'GDPR / IP RS','access'=>'WCAG 2.1 AA','tz'=>'CET / CEST','phone'=>'+386 X XXX XXXX'],
  'somalia'     => ['name'=>'Somalia',      'geo'=>'SO','lang'=>'en-SO','locale'=>'so_SO','compliance'=>'N/A','access'=>'WCAG 2.1 AA','tz'=>'EAT (UTC+3)','phone'=>'+252 XX XXX XXXX'],
  'spain'       => ['name'=>'Spain',        'geo'=>'ES','lang'=>'en-ES','locale'=>'es_ES','compliance'=>'GDPR / LOPDGDD','access'=>'UNE 139803 / WCAG 2.1','tz'=>'CET / CEST','phone'=>'+34 XXX XXX XXX'],
  'sudan'       => ['name'=>'Sudan',        'geo'=>'SD','lang'=>'en-SD','locale'=>'ar_SD','compliance'=>'N/A','access'=>'WCAG 2.1 AA','tz'=>'EAT (UTC+3)','phone'=>'+249 XX XXX XXXX'],
  'suriname'    => ['name'=>'Suriname',     'geo'=>'SR','lang'=>'nl-SR','locale'=>'nl_SR','compliance'=>'N/A','access'=>'WCAG 2.1 AA','tz'=>'SRT (UTC-3)','phone'=>'+597 XXX-XXXX'],
  'sweden'      => ['name'=>'Sweden',       'geo'=>'SE','lang'=>'en-SE','locale'=>'sv_SE','compliance'=>'GDPR / IMY','access'=>'WCAG 2.1 AA','tz'=>'CET / CEST','phone'=>'+46 XXX XXX XXXX'],
  'switzerland' => ['name'=>'Switzerland',  'geo'=>'CH','lang'=>'en-CH','locale'=>'de_CH','compliance'=>'nDSG (Swiss DSG)','access'=>'WCAG 2.1 AA','tz'=>'CET / CEST','phone'=>'+41 XX XXX XX XX'],
  'syria'       => ['name'=>'Syria',        'geo'=>'SY','lang'=>'en-SY','locale'=>'ar_SY','compliance'=>'N/A','access'=>'WCAG 2.1 AA','tz'=>'EET / EEST','phone'=>'+963 XX XXX XXXX'],
  'taiwan'      => ['name'=>'Taiwan',       'geo'=>'TW','lang'=>'zh-TW','locale'=>'zh_TW','compliance'=>'PDPA (Taiwan)','access'=>'WCAG 2.1 AA','tz'=>'NST (UTC+8)','phone'=>'+886 X XXXX XXXX'],
  'tajikistan'  => ['name'=>'Tajikistan',   'geo'=>'TJ','lang'=>'en-TJ','locale'=>'tg_TJ','compliance'=>'Law on Personal Data','access'=>'WCAG 2.1 AA','tz'=>'TJT (UTC+5)','phone'=>'+992 XX XXX XXXX'],
  'tanzania'    => ['name'=>'Tanzania',     'geo'=>'TZ','lang'=>'en-TZ','locale'=>'sw_TZ','compliance'=>'DPA 2022 (Tanzania)','access'=>'WCAG 2.1 AA','tz'=>'EAT (UTC+3)','phone'=>'+255 XXX XXX XXX'],
  'thailand'    => ['name'=>'Thailand',     'geo'=>'TH','lang'=>'en-TH','locale'=>'th_TH','compliance'=>'PDPA 2019 (Thailand)','access'=>'WCAG 2.1 AA','tz'=>'ICT (UTC+7)','phone'=>'+66 X XXXX XXXX'],
  'togo'        => ['name'=>'Togo',         'geo'=>'TG','lang'=>'fr-TG','locale'=>'fr_TG','compliance'=>'GDPR-aligned','access'=>'WCAG 2.1 AA','tz'=>'GMT','phone'=>'+228 XX XX XX XX'],
  'tonga'       => ['name'=>'Tonga',        'geo'=>'TO','lang'=>'en-TO','locale'=>'to_TO','compliance'=>'N/A','access'=>'WCAG 2.1 AA','tz'=>'TOT (UTC+13)','phone'=>'+676 XXXXX'],
  'tunisia'     => ['name'=>'Tunisia',      'geo'=>'TN','lang'=>'en-TN','locale'=>'ar_TN','compliance'=>'Law 63/2004','access'=>'WCAG 2.1 AA','tz'=>'CET (UTC+1)','phone'=>'+216 XX XXX XXX'],
  'turkey'      => ['name'=>'Turkey',       'geo'=>'TR','lang'=>'en-TR','locale'=>'tr_TR','compliance'=>'KVKK (Law 6698)','access'=>'WCAG 2.1 AA','tz'=>'TRT (UTC+3)','phone'=>'+90 XXX XXX XXXX'],
  'turkmenistan'=> ['name'=>'Turkmenistan', 'geo'=>'TM','lang'=>'en-TM','locale'=>'tk_TM','compliance'=>'N/A','access'=>'WCAG 2.1 AA','tz'=>'TMT (UTC+5)','phone'=>'+993 X XXX XXXX'],
  'tuvalu'      => ['name'=>'Tuvalu',       'geo'=>'TV','lang'=>'en-TV','locale'=>'en_TV','compliance'=>'N/A','access'=>'WCAG 2.1 AA','tz'=>'TVT (UTC+12)','phone'=>'+688 XXXXX'],
  'uganda'      => ['name'=>'Uganda',       'geo'=>'UG','lang'=>'en-UG','locale'=>'en_UG','compliance'=>'DPA 2019 (Uganda)','access'=>'WCAG 2.1 AA','tz'=>'EAT (UTC+3)','phone'=>'+256 XXX XXX XXX'],
  'ukraine'     => ['name'=>'Ukraine',      'geo'=>'UA','lang'=>'en-UA','locale'=>'uk_UA','compliance'=>'Law 2297-VI','access'=>'WCAG 2.1 AA','tz'=>'EET / EEST','phone'=>'+380 XX XXX XXXX'],
  'uruguay'     => ['name'=>'Uruguay',      'geo'=>'UY','lang'=>'es-UY','locale'=>'es_UY','compliance'=>'Law 18.331','access'=>'WCAG 2.1 AA','tz'=>'UYT (UTC-3)','phone'=>'+598 X XXX XXXX'],
  'uzbekistan'  => ['name'=>'Uzbekistan',   'geo'=>'UZ','lang'=>'en-UZ','locale'=>'uz_UZ','compliance'=>'Law on Personal Data','access'=>'WCAG 2.1 AA','tz'=>'UZT (UTC+5)','phone'=>'+998 XX XXX XXXX'],
  'vanuatu'     => ['name'=>'Vanuatu',      'geo'=>'VU','lang'=>'en-VU','locale'=>'bi_VU','compliance'=>'N/A','access'=>'WCAG 2.1 AA','tz'=>'VUT (UTC+11)','phone'=>'+678 XXX XXXX'],
  'venezuela'   => ['name'=>'Venezuela',    'geo'=>'VE','lang'=>'es-VE','locale'=>'es_VE','compliance'=>'Law on Data Messages','access'=>'WCAG 2.1 AA','tz'=>'VET (UTC-4)','phone'=>'+58 XXX XXX XXXX'],
  'vietnam'     => ['name'=>'Vietnam',      'geo'=>'VN','lang'=>'en-VN','locale'=>'vi_VN','compliance'=>'Decree 13/2023','access'=>'WCAG 2.1 AA','tz'=>'ICT (UTC+7)','phone'=>'+84 XXX XXX XXXX'],
  'yemen'       => ['name'=>'Yemen',        'geo'=>'YE','lang'=>'en-YE','locale'=>'ar_YE','compliance'=>'N/A','access'=>'WCAG 2.1 AA','tz'=>'AST (UTC+3)','phone'=>'+967 XXX XXX XXXX'],
  'zambia'      => ['name'=>'Zambia',       'geo'=>'ZM','lang'=>'en-ZM','locale'=>'en_ZM','compliance'=>'DPA (Zambia)','access'=>'WCAG 2.1 AA','tz'=>'CAT (UTC+2)','phone'=>'+260 XX XXX XXXX'],
  'zimbabwe'    => ['name'=>'Zimbabwe',     'geo'=>'ZW','lang'=>'en-ZW','locale'=>'en_ZW','compliance'=>'CIPA (Zimbabwe)','access'=>'WCAG 2.1 AA','tz'=>'CAT (UTC+2)','phone'=>'+263 XX XXX XXXX'],
];

// Sort by slug length descending so multi-word slugs match before single-word ones
uksort($COUNTRIES, fn($a,$b) => strlen($b) - strlen($a));

// ─── Direct map: slugs that have no country suffix (Indian states, ACT, etc.) ─
$DIRECT_MAP = [
  'andaman-and-nicobar-islands'              => ['andaman-and-nicobar-islands', 'india'],
  'andhra-pradesh'                           => ['andhra-pradesh',              'india'],
  'arunachal-pradesh'                        => ['arunachal-pradesh',           'india'],
  'assam'                                    => ['assam',                       'india'],
  'bihar'                                    => ['bihar',                       'india'],
  'chandigarh'                               => ['chandigarh',                  'india'],
  'chhattisgarh'                             => ['chhattisgarh',                'india'],
  'dadra-and-nagar-haveli-and-daman-and-diu' => ['dadra-and-nagar-haveli-and-daman-and-diu','india'],
  'delhi'                                    => ['delhi',                       'india'],
  'goa'                                      => ['goa',                         'india'],
  'gujarat'                                  => ['gujarat',                     'india'],
  'haryana'                                  => ['haryana',                     'india'],
  'himachal-pradesh'                         => ['himachal-pradesh',            'india'],
  'jammu-and-kashmir'                        => ['jammu-and-kashmir',           'india'],
  'jharkhand'                                => ['jharkhand',                   'india'],
  'karnataka'                                => ['karnataka',                   'india'],
  'kerala'                                   => ['kerala',                      'india'],
  'ladakh'                                   => ['ladakh',                      'india'],
  'lakshadweep'                              => ['lakshadweep',                 'india'],
  'madhya-pradesh'                           => ['madhya-pradesh',              'india'],
  'maharashtra'                              => ['maharashtra',                 'india'],
  'manipur'                                  => ['manipur',                     'india'],
  'meghalaya'                                => ['meghalaya',                   'india'],
  'mizoram'                                  => ['mizoram',                     'india'],
  'nagaland'                                 => ['nagaland',                    'india'],
  'odisha'                                   => ['odisha',                      'india'],
  'puducherry'                               => ['puducherry',                  'india'],
  'punjab'                                   => ['punjab',                      'india'],
  'rajasthan'                                => ['rajasthan',                   'india'],
  'sikkim'                                   => ['sikkim',                      'india'],
  'tamil-nadu'                               => ['tamil-nadu',                  'india'],
  'telangana'                                => ['telangana',                   'india'],
  'tripura'                                  => ['tripura',                     'india'],
  'uttar-pradesh'                            => ['uttar-pradesh',               'india'],
  'uttarakhand'                              => ['uttarakhand',                 'india'],
  'west-bengal'                              => ['west-bengal',                 'india'],
  'australian-capital-territory'             => ['australian-capital-territory','australia'],
];

// ─── Helper: parse filename → [stateSlug, countrySlug, countryData] ────────
function parse_location(string $filename, array $countries, array $directMap): ?array {
  $slug = preg_replace('/^ui-ux-design-agency-in-/', '', basename($filename, '.php'));
  foreach ($countries as $cSlug => $cData) {
    if (str_ends_with($slug, '-' . $cSlug)) {
      $stateSlug = substr($slug, 0, strlen($slug) - strlen($cSlug) - 1);
      return [$stateSlug, $cSlug, $cData];
    }
    if ($slug === $cSlug) return null; // country-level page — skip
  }
  if (isset($directMap[$slug]) && isset($countries[$directMap[$slug][1]])) {
    [$stateSlug, $cSlug] = $directMap[$slug];
    return [$stateSlug, $cSlug, $countries[$cSlug]];
  }
  return null;
}

// ─── Helper: slug → display name ────────────────────────────────────────────
function slug_to_name(string $slug): string {
  return ucwords(str_replace('-', ' ', $slug));
}

// ─── Helper: escape string for PHP single-quoted literal ─────────────────────
function php_esc(string $s): string {
  return str_replace(["\\", "'"], ["\\\\", "\\'"], $s);
}

// ─── Tier 2 page template — Germany Gold Standard (tier2-v2) ─────────────────
function render_tier2(
  string $stateSlug,
  string $stateName,
  string $countrySlug,
  array  $c,
  string $fileSlug
): string {
  // ── Pre-compute all template variables ──────────────────────────────────────
  $countryName = $c['name'];
  $canonical   = "https://www.uxpacific.com/ui-ux-design-agency-in-{$fileSlug}";
  $countryUrl  = "https://www.uxpacific.com/ui-ux-design-agency-in-{$countrySlug}";
  $geo         = $c['geo'];
  $lang        = $c['lang'];
  $locale      = $c['locale'];
  $compliance  = $c['compliance'];
  $access      = $c['access'];
  $tz          = $c['tz'];
  $phone       = $c['phone'];
  $ogImage     = "https://www.uxpacific.com/img/og-{$countrySlug}.jpg";

  $pageTitle  = "UI UX Design Agency in {$stateName}, {$countryName} | UX Pacific";
  $pageDesc   = "{$compliance}-aware UI/UX design for businesses in {$stateName}, {$countryName}. UX research, usability testing & product design. Book a free audit.";
  $pageDesc   = substr($pageDesc, 0, 160); // enforce limit

  $ogTitle = $pageTitle;
  $ogDesc  = "Research-led UI/UX design agency serving {$stateName}, {$countryName}. {$compliance}-compliant. UX research, usability testing, and product design. Get a free audit.";
  $ogDesc  = substr($ogDesc, 0, 160);

  $keywords = "UI UX Design {$stateName}, UI UX Agency {$stateName}, UX Design {$stateName} {$countryName}, UX Research {$stateName}, UX Audit {$stateName}, Usability Testing {$stateName}, UX Agency {$stateName}";

  $schemaJson = json_encode([
    '@context' => 'https://schema.org',
    '@graph'   => [
      [
        '@type'         => 'WebPage',
        '@id'           => "{$canonical}#webpage",
        'url'           => $canonical,
        'name'          => $pageTitle,
        'description'   => "Research-led UI/UX design agency serving {$stateName}, {$countryName} with UX research, usability testing, and {$compliance}-compliant product design.",
        'inLanguage'    => 'en',
        'datePublished' => '2026-06-26',
        'dateModified'  => '2026-06-26',
        'about'         => ['@type' => 'State', 'name' => $stateName, 'containedInPlace' => ['@type' => 'Country', 'name' => $countryName]],
      ],
      [
        '@type'           => 'BreadcrumbList',
        'itemListElement' => [
          ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home',         'item' => 'https://www.uxpacific.com/'],
          ['@type' => 'ListItem', 'position' => 2, 'name' => $countryName,   'item' => $countryUrl],
          ['@type' => 'ListItem', 'position' => 3, 'name' => $stateName,     'item' => $canonical],
        ],
      ],
      [
        '@type'  => 'Organization',
        '@id'    => 'https://www.uxpacific.com/#organization',
        'name'   => 'UX Pacific',
        'url'    => 'https://www.uxpacific.com',
        'logo'   => 'https://www.uxpacific.com/img/LOGO.png',
        'sameAs' => ['https://www.linkedin.com/company/uxpacific/', 'https://www.instagram.com/official_uxpacific/'],
      ],
      [
        '@type'       => 'Service',
        'name'        => "UI/UX Design Services in {$stateName}, {$countryName}",
        'provider'    => ['@id' => 'https://www.uxpacific.com/#organization'],
        'areaServed'  => ['@type' => 'State', 'name' => $stateName, 'containedInPlace' => ['@type' => 'Country', 'name' => $countryName]],
        'serviceType' => "UI UX Design, UX Research, Usability Testing, UX Audit, Product Discovery, Design Systems, {$compliance}-Compliant UX",
        'url'         => $canonical,
      ],
    ],
  ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

  // Escape for PHP heredoc output
  $schemaJsonE = htmlspecialchars($schemaJson, ENT_NOQUOTES);

  return <<<PHP
<?php
// <!-- tier2-v1 -->
\$pageTitle       = '{$pageTitle}';
\$pageDesc        = '{$pageDesc}';
\$metaKeywords    = '{$keywords}';
\$metaAuthor      = 'UXPACIFIC';
\$metaRobots      = 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1';
\$themeColor      = '#080808';
\$geoRegion       = '{$geo}';
\$geoCountry      = '{$countryName}';
\$contentLanguage = '{$lang}';
\$canonicalUrl    = '{$canonical}';
\$ogTitle         = '{$ogTitle}';
\$ogDesc          = '{$ogDesc}';
\$ogUrl           = '{$canonical}';
\$ogImage         = '{$ogImage}';
\$ogLocale        = '{$locale}';
\$currentPage     = '';
\$ldJson          = '{$schemaJsonE}';
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
        <div style="display:inline-block;border:1px solid rgba(255,255,255,.15);background:rgba(255,255,255,.04);padding:8px 20px;border-radius:40px;color:rgba(200,200,220,.8);font-size:13px;font-weight:500;letter-spacing:.05em;margin-bottom:24px;">
          Research-Led UI UX Design Agency Serving {$stateName}, {$countryName}
        </div>
        <h1 id="heading">UI UX DESIGN AGENCY<br /><span style="font-weight:800">IN {$stateName}</span></h1>
        <p class="subtext" style="max-width:780px;margin:0.4rem auto 0;line-height:1.75;">Helping businesses in {$stateName}, {$countryName} make better product decisions through UX Research, Usability Testing, Product Discovery and Human-Centered UI Design. {$compliance}-compliant. IST-friendly remote collaboration.</p>
        <div style="display:flex;gap:14px;justify-content:center;flex-wrap:wrap;margin-top:2rem;">
          <a class="btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#auditModal" style="height:44px;padding:0 28px;margin-top:0;display:inline-flex;align-items:center;gap:8px;width:auto;">
            Book Free 30-Min UX Consultation <span class="arrow"> </span>
          </a>
          <a href="{$countryUrl}" style="display:inline-flex;align-items:center;height:44px;padding:0 26px;border:1px solid rgba(255,255,255,.18);border-radius:50px;color:rgba(200,200,220,.85);font-size:.9rem;font-weight:600;text-decoration:none;">
            All {$countryName} Services
          </a>
        </div>
        <div class="ux-header">
          <span class="ux-badg"> </span>
          <div class="scroller">
            <ul class="scroller__inner">
              <li class="scroller__item">SIMPLE</li><li class="scroller__item">INTENTIONAL</li>
              <li class="scroller__item">HUMAN</li><li class="scroller__item">SCALABLE</li>
              <li class="scroller__item">SMART</li><li class="scroller__item">EMPATHETIC</li>
              <li class="scroller__item">MEASURED</li><li class="scroller__item">IMPACTFUL</li>
              <li class="scroller__item">ACCESSIBLE</li>
            </ul>
          </div>
          <span class="ux-end"> </span>
        </div>
      </section>
    </div>

    <style>
      .hero-wrapper{min-height:100vh}
      .hero{min-height:100vh!important;padding:0 1.5rem!important;justify-content:center!important;padding-bottom:72px!important;box-sizing:border-box}
      .hero .ux-header{position:absolute;bottom:0;left:0;right:0;width:100%}
      .t2-wrap{max-width:1100px;margin:0 auto;padding:0 22px}
      .t2-section{padding:64px 0}
      .t2-bc{display:flex;flex-wrap:wrap;gap:6px;align-items:center;font-size:.78rem;color:rgba(200,200,220,.5);padding:28px 22px 0;max-width:1100px;margin:0 auto}
      .t2-bc a{color:#a78bfa;text-decoration:none}.t2-bc a:hover{text-decoration:underline}
      .t2-bc span{color:rgba(200,200,220,.25)}
      .t2-h2{font-size:clamp(1.35rem,2.8vw,2rem);font-weight:700;color:#f0eeff;margin-bottom:.5rem;line-height:1.2}
      .t2-sub{color:rgba(200,200,220,.72);font-size:.97rem;max-width:680px;line-height:1.75;margin-bottom:2rem}
      .t2-label{display:inline-block;font-size:.75rem;font-weight:600;letter-spacing:.08em;text-transform:uppercase;color:#a78bfa;margin-bottom:.6rem}
      .t2-grid{display:grid;gap:1rem}
      .t2-grid-3{grid-template-columns:repeat(auto-fit,minmax(270px,1fr))}
      .t2-svc{background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.08);border-left:3px solid #6147bd;border-radius:0 12px 12px 0;padding:1.2rem 1.4rem;transition:border-color .3s,background .3s}
      .t2-svc:hover{border-color:#a78bfa;border-left-color:#a78bfa;background:rgba(97,71,189,.05)}
      .t2-svc h3{color:#e8e0ff;font-size:.95rem;font-weight:700;margin:0 0 .4rem}
      .t2-svc p{color:rgba(200,200,220,.72);font-size:.84rem;line-height:1.65;margin:0}
      .t2-faq-list{margin-top:1.5rem}
      .t2-faq-item{border-bottom:1px solid rgba(255,255,255,.07)}
      .t2-faq-item:last-child{border-bottom:none}
      .t2-faq-q{width:100%;background:none;border:none;text-align:left;padding:1rem 0;cursor:pointer;display:flex;justify-content:space-between;align-items:center;gap:1rem;color:#e8e0ff;font-size:.93rem;font-weight:600;line-height:1.45}
      .t2-faq-q:hover{color:#c4b5fd}
      .t2-faq-icon{flex-shrink:0;width:20px;height:20px;border-radius:50%;border:1px solid rgba(167,139,250,.35);display:flex;align-items:center;justify-content:center;color:#a78bfa;font-size:.85rem;transition:transform .3s}
      .t2-faq-item.open .t2-faq-icon{transform:rotate(45deg)}
      .t2-faq-a{display:none;padding:0 0 1rem;color:rgba(200,200,220,.78);font-size:.875rem;line-height:1.75}
      .t2-faq-item.open .t2-faq-a{display:block}
      .t2-cta-box{background:linear-gradient(135deg,rgba(97,71,189,.15),rgba(167,139,250,.06));border:1px solid rgba(167,139,250,.22);border-radius:16px;padding:2.5rem 2rem;text-align:center;margin-top:1.5rem}
      .t2-cta-box h2{color:#fff;font-size:clamp(1.2rem,2.5vw,1.6rem);font-weight:700;margin-bottom:.6rem}
      .t2-cta-box p{color:rgba(200,200,220,.78);font-size:.95rem;margin-bottom:1.5rem;line-height:1.7}
      .t2-divider{border:none;border-top:1px solid rgba(255,255,255,.06);margin:0}
      @media(max-width:768px){.t2-grid-3{grid-template-columns:1fr}}
    </style>

    <nav class="t2-bc" aria-label="Breadcrumb">
      <a href="/">Home</a><span>&#8250;</span>
      <a href="{$countryUrl}">{$countryName}</a><span>&#8250;</span>
      <span>{$stateName}</span>
    </nav>

    <div class="t2-wrap t2-section">
      <span class="t2-label">UI/UX Design in {$stateName}</span>
      <h2 class="t2-h2">Research-Led UX Design for Businesses in {$stateName}, {$countryName}</h2>
      <p class="t2-sub">Every engagement begins with users, evidence, and business goals. We serve companies in {$stateName} remotely — with structured UX research, usability testing, UI design, and {$compliance}-compliant product design.</p>

      <div class="t2-grid t2-grid-3">
        <div class="t2-svc">
          <h3>UX Research &amp; Audit</h3>
          <p>User interviews, heuristic evaluation, journey mapping, and usability testing for products used in {$stateName}. We identify where users drop off and why.</p>
        </div>
        <div class="t2-svc">
          <h3>UI Design &amp; Prototyping</h3>
          <p>High-fidelity Figma screens and interactive prototypes — responsive, accessible to {$access} standards, and ready for developer handoff.</p>
        </div>
        <div class="t2-svc">
          <h3>{$compliance}-Compliant UX</h3>
          <p>Consent flows, privacy notices, and data collection forms designed to meet {$compliance} requirements without damaging the user experience.</p>
        </div>
        <div class="t2-svc">
          <h3>Design Systems</h3>
          <p>Scalable component libraries and token-based design systems that unify product teams and accelerate consistent, quality delivery.</p>
        </div>
        <div class="t2-svc">
          <h3>Product Discovery</h3>
          <p>Stakeholder workshops, user journey mapping, and opportunity framing — aligning business goals with user needs before a single screen is designed.</p>
        </div>
        <div class="t2-svc">
          <h3>Accessibility ({$access})</h3>
          <p>Design to {$access} standards — ensuring your product is usable by every member of your audience in {$stateName}.</p>
        </div>
      </div>
    </div>

    <hr class="t2-divider">

    <div class="t2-wrap t2-section">
      <span class="t2-label">FAQ</span>
      <h2 class="t2-h2">Frequently Asked Questions — UI/UX Design in {$stateName}</h2>
      <p class="t2-sub">Common questions from businesses in {$stateName}, {$countryName} exploring UI/UX design and user research services.</p>
      <div class="t2-faq-list" id="t2FaqList">
        <div class="t2-faq-item">
          <button class="t2-faq-q" type="button" aria-expanded="false">Do you provide UI UX design services in {$stateName}, {$countryName}?<span class="t2-faq-icon" aria-hidden="true">+</span></button>
          <div class="t2-faq-a">Yes. UX Pacific works with businesses in {$stateName} remotely — delivering UX research, UI design, usability testing, UX audits, product discovery, and design systems. We serve clients across all of {$countryName}, including {$stateName}.</div>
        </div>
        <div class="t2-faq-item">
          <button class="t2-faq-q" type="button" aria-expanded="false">How does {$compliance} affect UX design for businesses in {$stateName}?<span class="t2-faq-icon" aria-hidden="true">+</span></button>
          <div class="t2-faq-a">{$compliance} shapes how consent flows, privacy notices, and data collection forms are designed. We integrate {$compliance} requirements from day one, building user trust through transparent UX patterns rather than treating compliance as an afterthought.</div>
        </div>
        <div class="t2-faq-item">
          <button class="t2-faq-q" type="button" aria-expanded="false">How much does UX design cost for a business in {$stateName}?<span class="t2-faq-icon" aria-hidden="true">+</span></button>
          <div class="t2-faq-a">Investment varies by scope. A focused UX audit starts at a fixed fee; a full product design engagement is scoped per project. We offer transparent, milestone-based pricing. Contact us with your product details for an estimate. See the full <a href="{$countryUrl}" style="color:#a78bfa">UI/UX design services in {$countryName}</a> page for more context.</div>
        </div>
        <div class="t2-faq-item">
          <button class="t2-faq-q" type="button" aria-expanded="false">Does UX Pacific design for {$access} standards?<span class="t2-faq-icon" aria-hidden="true">+</span></button>
          <div class="t2-faq-a">Yes. We design to {$access} as standard — ensuring your product is accessible and meets the relevant regulatory requirements for {$countryName}. Accessible design is part of our core process, not an optional add-on.</div>
        </div>
        <div class="t2-faq-item">
          <button class="t2-faq-q" type="button" aria-expanded="false">How quickly do you respond to enquiries from {$stateName}?<span class="t2-faq-icon" aria-hidden="true">+</span></button>
          <div class="t2-faq-a">We respond to all qualified enquiries within one business day. We work across {$tz} and are flexible on meeting times. Book a free UX audit via the button on this page to start immediately.</div>
        </div>
      </div>
    </div>

    <script>
      (function(){
        var items = document.querySelectorAll('#t2FaqList .t2-faq-item');
        items.forEach(function(item){
          var btn = item.querySelector('.t2-faq-q');
          btn.addEventListener('click', function(){
            var open = item.classList.contains('open');
            items.forEach(function(i){ i.classList.remove('open'); i.querySelector('.t2-faq-q').setAttribute('aria-expanded','false'); });
            if(!open){ item.classList.add('open'); btn.setAttribute('aria-expanded','true'); }
          });
        });
      })();
    </script>

    <hr class="t2-divider">

    <div class="t2-wrap t2-section">
      <div class="t2-cta-box">
        <span class="t2-label" style="display:block;text-align:center;margin-bottom:.8rem">Get Started</span>
        <h2>Book a Free UX Audit for Your {$stateName} Product</h2>
        <p>Share your product and we will give you a clear, honest review — what is working, what is losing users, and what to fix first. {$compliance}-aware evaluation included.</p>
        <a class="btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#auditModal"
           style="width:230px;height:44px;padding-left:24px;display:inline-flex;align-items:center;text-decoration:none;margin:0 auto;">
          Book a Free UX Audit <span class="arrow"> </span>
        </a>
        <div style="margin-top:1.4rem;display:flex;flex-wrap:wrap;justify-content:center;gap:1.2rem 2rem;font-size:.8rem;color:rgba(200,200,220,.5)">
          <span>&#128274; NDA signed before any discussion</span>
          <span>&#128231; <a href="mailto:hello@uxpacific.com" style="color:#a78bfa;text-decoration:none;">hello@uxpacific.com</a></span>
          <span>&#9203; Response within one business day</span>
        </div>
        <p style="margin-top:1.2rem;font-size:.78rem;color:rgba(200,200,220,.35)">
          Part of <a href="{$countryUrl}" style="color:#a78bfa;text-decoration:none;">UI/UX Design Services in {$countryName}</a>
        </p>
      </div>
    </div>

    <?php include 'includes/footer.php'; ?>
    <?php include 'includes/scripts.php'; ?>

    <div id="auditSuccessPopup" style="display:none;position:fixed;inset:0;z-index:9999;align-items:center;justify-content:center;background:rgba(0,0,0,0.7);backdrop-filter:blur(6px);">
      <div style="background:#111127;border:1px solid rgba(97,71,189,0.4);border-radius:20px;padding:48px 40px;max-width:420px;width:90%;text-align:center;box-shadow:0 24px 80px rgba(0,0,0,0.8);">
        <div style="width:68px;height:68px;background:linear-gradient(135deg,#6147bd,#a78bfa);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 24px;">
          <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
        </div>
        <h3 style="color:#fff;font-size:22px;font-weight:700;margin:0 0 12px;">Submitted Successfully!</h3>
        <p style="color:#b2bad6;font-size:15px;line-height:1.6;margin:0 0 28px;">Thank you! Your UX Audit request has been received. We will get back to you shortly.</p>
        <button onclick="document.getElementById('auditSuccessPopup').style.display='none';" style="background:linear-gradient(90deg,#6147bd,#a78bfa);border:none;padding:12px 36px;border-radius:50px;color:#fff;font-weight:600;font-size:15px;cursor:pointer;">Done</button>
      </div>
    </div>

    <div class="modal fade" id="auditModal" tabindex="-1" aria-hidden="true" style="backdrop-filter:blur(8px);background-color:rgba(0,0,0,0.6);z-index:2200;" data-bs-backdrop="true">
      <div class="modal-dialog modal-dialog-centered" style="max-width:500px;">
        <div class="modal-content" style="background:rgba(17,17,17,0.95);border:1px solid #2e2e3e;border-radius:20px;overflow:hidden;box-shadow:0 24px 80px rgba(0,0,0,0.8);">
          <div class="modal-header border-0 pb-0 d-flex justify-content-between align-items-center" style="padding:24px 32px 0;">
            <h4 class="modal-title" style="color:#fff;font-weight:700;font-size:24px;">Book a UX Audit</h4>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" style="opacity:0.5;"></button>
          </div>
          <div class="modal-body" style="padding:24px 32px 36px;">
            <form id="auditForm" class="contact-form" action="send" method="post">
              <input type="hidden" name="form_type" value="ux_audit">
              <input type="text" name="company_website" id="audit_company_website" value="" tabindex="-1" autocomplete="off" aria-hidden="true" style="position:absolute;left:-10000px;top:auto;width:1px;height:1px;overflow:hidden;">
              <input type="hidden" name="form_started_at" id="audit_form_started_at" value="">
              <div class="contact-row d-flex flex-column" style="gap:16px;">
                <div style="display:flex;flex-direction:column;gap:6px;"><label for="auditName" style="font-size:15px;color:#b2bad6;">Name</label><input id="auditName" name="name" type="text" placeholder="Your name" style="height:56px;width:100%;background:#151515;border:1px solid #2e2e3e;border-radius:6px;color:#eee;padding:16px 20px;font-size:1rem;outline:none;" onfocus="this.style.borderColor='#6147bd'" onblur="this.style.borderColor='#2e2e3e'"></div>
                <div style="display:flex;flex-direction:column;gap:6px;"><label for="auditEmail" style="font-size:15px;color:#b2bad6;">Email</label><input id="auditEmail" name="email" type="email" placeholder="Your email address" style="height:56px;width:100%;background:#151515;border:1px solid #2e2e3e;border-radius:6px;color:#eee;padding:16px 20px;font-size:1rem;outline:none;" onfocus="this.style.borderColor='#6147bd'" onblur="this.style.borderColor='#2e2e3e'"></div>
                <div style="display:flex;flex-direction:column;gap:6px;"><label for="auditPhone" style="font-size:15px;color:#b2bad6;">Phone</label><input id="auditPhone" name="phone" type="tel" placeholder="{$phone}" style="height:56px;width:100%;background:#151515;border:1px solid #2e2e3e;border-radius:6px;color:#eee;padding:16px 20px;font-size:1rem;outline:none;" onfocus="this.style.borderColor='#6147bd'" onblur="this.style.borderColor='#2e2e3e'"></div>
                <div style="display:flex;flex-direction:column;gap:6px;"><label for="auditUrl" style="font-size:15px;color:#b2bad6;">Website URL</label><input id="auditUrl" name="url" type="text" placeholder="https://yourwebsite.com" style="height:56px;width:100%;background:#151515;border:1px solid #2e2e3e;border-radius:6px;color:#eee;padding:16px 20px;font-size:1rem;outline:none;" onfocus="this.style.borderColor='#6147bd'" onblur="this.style.borderColor='#2e2e3e'"></div>
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

    <script>
      document.getElementById('auditForm').addEventListener('submit', function(e) {
        e.preventDefault();
        var btn=document.getElementById('auditSubmitBtn'),errBox=document.getElementById('auditError');
        var n=document.getElementById('auditName').value.trim(),em=document.getElementById('auditEmail').value.trim(),ph=document.getElementById('auditPhone').value.trim(),u=document.getElementById('auditUrl').value.trim();
        errBox.style.display='none';
        document.querySelectorAll('#auditForm .field-error').forEach(function(el){el.remove();});
        document.querySelectorAll('#auditForm input').forEach(function(el){el.style.borderColor='#2e2e3e';});
        var errors=[],eRe=/^[^\s@]+@[^\s@]+\.[^\s@]+$/,uRe=/^(https?:\/\/)?([\w\-]+\.)+[\w\-]+(\/[\w\-._~:/?#[\]@!\$&'()*+,;=]*)?$/i;
        if(!n||n.length<2)errors.push({f:'auditName',m:'Please enter your name'});
        if(!em||!eRe.test(em))errors.push({f:'auditEmail',m:'Please enter a valid email'});
        if(ph&&!/^[\d\s\-+()]{7,20}$/.test(ph))errors.push({f:'auditPhone',m:'Please enter a valid phone'});
        if(!u||!uRe.test(u))errors.push({f:'auditUrl',m:'Please enter a valid website URL'});
        if(errors.length){errors.forEach(function(err){var i=document.getElementById(err.f);i.style.borderColor='#f87171';var el=document.createElement('div');el.className='field-error';el.style.cssText='color:#f87171;font-size:12px;margin-top:4px;';el.textContent=err.m;i.parentNode.appendChild(el);});document.getElementById(errors[0].f).focus();return;}
        btn.disabled=true;btn.textContent='Sending…';
        fetch('send',{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify({form_type:'ux_audit',name:n,email:em,phone:ph,url:u,company_website:(document.getElementById('audit_company_website')||{}).value||'',form_started_at:parseInt((document.getElementById('audit_form_started_at')||{}).value||'0',10)||0})})
        .then(function(r){return r.json();}).then(function(res){if(res.success){var m=bootstrap.Modal.getInstance(document.getElementById('auditModal'));if(m)m.hide();document.getElementById('auditForm').reset();var pop=document.getElementById('auditSuccessPopup');if(pop)pop.style.display='flex';}else{errBox.textContent=res.message||'Something went wrong.';errBox.style.display='block';}}).catch(function(){errBox.textContent='Network error.';errBox.style.display='block';}).finally(function(){btn.disabled=false;btn.textContent='Submit Request';});
      });
      document.getElementById('auditModal').addEventListener('shown.bs.modal',function(){var bd=document.querySelector('.modal-backdrop.show');if(bd)bd.style.zIndex='2190';var fs=document.getElementById('audit_form_started_at');if(fs)fs.value=String(Date.now());var hp=document.getElementById('audit_company_website');if(hp)hp.value='';});
      document.getElementById('auditSuccessPopup').addEventListener('click',function(e){if(e.target===this)this.style.display='none';});
    </script>
  </body>
</html>
PHP;
}

// ─── Main loop ───────────────────────────────────────────────────────────────
$dir   = __DIR__;
$files = glob("{$dir}/ui-ux-design-agency-in-*.php");
sort($files);

// Exclude the generator itself + country-level pages already done
$countryPageSlugs = array_keys($COUNTRIES);
$skip_files = array_merge(
  [__FILE__],
  array_map(fn($s) => "{$dir}/ui-ux-design-agency-in-{$s}.php", $countryPageSlugs)
);

$total   = 0;
$written = 0;
$skipped = 0;
$unknown = 0;
$errors  = 0;
$log     = [];

$isCli = PHP_SAPI === 'cli';
$nl     = $isCli ? "\n" : "<br>\n";

foreach ($files as $file) {
  if (in_array(realpath($file), array_map('realpath', $skip_files), true)) continue;

  $total++;
  if (LIMIT > 0 && $total > LIMIT) break;

  // Skip-done check
  if (SKIP_DONE) {
    $existing = file_get_contents($file);
    if ($existing !== false && str_contains($existing, DONE_MARKER)) {
      $skipped++;
      continue;
    }
  }

  $parsed = parse_location($file, $COUNTRIES, $DIRECT_MAP);
  if ($parsed === null) {
    $unknown++;
    $log[] = "UNKNOWN: " . basename($file);
    continue;
  }

  [$stateSlug, $countrySlug, $countryData] = $parsed;
  $stateName = slug_to_name($stateSlug);
  $fileSlug  = preg_replace('/^ui-ux-design-agency-in-/', '', basename($file, '.php'));

  $content = render_tier2($stateSlug, $stateName, $countrySlug, $countryData, $fileSlug);

  if (DRY_RUN) {
    $log[] = "DRY: {$stateName} ({$countryData['name']}) ← " . basename($file);
    $written++;
    continue;
  }

  $result = file_put_contents($file, $content);
  if ($result === false) {
    $errors++;
    $log[] = "ERROR: " . basename($file);
  } else {
    $written++;
    if ($written % 100 === 0) {
      echo "Progress: {$written} written...{$nl}";
      flush();
    }
  }
}

// ─── Report ──────────────────────────────────────────────────────────────────
echo $nl;
echo "=== Tier 2 Generator Complete ==={$nl}";
echo "Total files scanned : {$total}{$nl}";
echo "Written             : {$written}{$nl}";
echo "Skipped (done)      : {$skipped}{$nl}";
echo "Unknown country     : {$unknown}{$nl}";
echo "Errors              : {$errors}{$nl}";
if (!empty($log)) {
  echo $nl . "--- Log (all entries) ---{$nl}";
  foreach ($log as $line) echo $line . $nl;
}
