<?php

$files = [
    "ui-ux-design-agency-in-slovakia.php",
    "ui-ux-design-agency-in-slovenia.php",
    "ui-ux-design-agency-in-solomon-islands.php",
    "ui-ux-design-agency-in-somalia.php",
    "ui-ux-design-agency-in-south-africa.php",
    "ui-ux-design-agency-in-south-korea.php",
    "ui-ux-design-agency-in-south-sudan.php",
    "ui-ux-design-agency-in-spain.php",
    "ui-ux-design-agency-in-sri-lanka.php",
    "ui-ux-design-agency-in-sudan.php",
    "ui-ux-design-agency-in-suriname.php",
    "ui-ux-design-agency-in-sweden.php",
    "ui-ux-design-agency-in-switzerland.php",
    "ui-ux-design-agency-in-syria.php",
    "ui-ux-design-agency-in-tajikistan.php",
    "ui-ux-design-agency-in-tanzania.php",
    "ui-ux-design-agency-in-thailand.php",
    "ui-ux-design-agency-in-timor-leste.php",
    "ui-ux-design-agency-in-togo.php",
    "ui-ux-design-agency-in-tonga.php",
    "ui-ux-design-agency-in-trinidad-and-tobago.php",
    "ui-ux-design-agency-in-tunisia.php",
    "ui-ux-design-agency-in-turkey.php",
    "ui-ux-design-agency-in-turkmenistan.php",
    "ui-ux-design-agency-in-tuvalu.php",
    "ui-ux-design-agency-in-uganda.php",
    "ui-ux-design-agency-in-ukraine.php",
    "ui-ux-design-agency-in-united-arab-emirates.php",
    "ui-ux-design-agency-in-united-kingdom.php",
    "ui-ux-design-agency-in-united-states.php",
    "ui-ux-design-agency-in-uruguay.php",
    "ui-ux-design-agency-in-uzbekistan.php",
    "ui-ux-design-agency-in-vanuatu.php",
    "ui-ux-design-agency-in-vatican-city.php",
    "ui-ux-design-agency-in-venezuela.php",
    "ui-ux-design-agency-in-vietnam.php",
    "ui-ux-design-agency-in-yemen.php",
    "ui-ux-design-agency-in-zambia.php",
    "ui-ux-design-agency-in-zimbabwe.php",
    "ui-ux-design-agency-in-palestine.php",
    "ui-ux-design-agency-in-kosovo.php",
    "ui-ux-design-agency-in-taiwan.php",
];

foreach ($files as $file) {
    $filePath = __DIR__ . '/' . $file;

    if (!file_exists($filePath)) {
        file_put_contents($filePath, "<?php\n// $file\n?>");
        echo "Created: $file<br>";
    } else {
        echo "Already exists: $file<br>";
    }
}

echo "<br>Done!";