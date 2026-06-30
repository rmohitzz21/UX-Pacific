<?php
$files = glob('ui-ux-design-agency-in-*.php');
$unknowns = [];
$gold = 0; $tier2 = 0; $old = 0; $skip = 0;
foreach ($files as $f) {
    $b = basename($f);
    if ($b === 'ui-ux-design-agency-in-germany.php') continue;
    if ($b === 'scan_types.php' || $b === 'migrate_to_gold.php') continue;
    $c = file_get_contents($f);
    if (strpos($c, 'de-fw-grid') !== false && strpos($c, '$_gFaqs') !== false) { $gold++; continue; }
    if (strpos($c, '// <!-- tier2-v1 -->') !== false || strpos($c, 't2-faq-item') !== false) { $tier2++; continue; }
    if (strpos($c, 'cms_repository') !== false || strpos($c, 'loc-section.php') !== false
        || strpos($c, 'get_published_projects') !== false || strpos($c, 'ecosystemHomeItems') !== false) { $old++; continue; }
    $skip++;
    $unknowns[] = $b;
}
echo "Gold (already done): $gold\n";
echo "Tier2: $tier2\n";
echo "Old country: $old\n";
echo "Unknown/skip: $skip\n";
if ($unknowns) {
    echo "\nUnknown files:\n";
    foreach ($unknowns as $u) echo "  $u\n";
}
