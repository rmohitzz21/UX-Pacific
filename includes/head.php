<head>
<?php require_once __DIR__ . '/config.php'; ?>

<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title><?= htmlspecialchars($pageTitle ?? 'UX Pacific'); ?></title>

<meta name="description" content="<?= htmlspecialchars($pageDesc ?? ''); ?>" />
<meta name="robots" content="<?= htmlspecialchars($metaRobots ?? 'index, follow'); ?>" />
<?php if (!empty($canonicalUrl)): ?>
<link rel="canonical" href="<?= htmlspecialchars($canonicalUrl); ?>" />
<?php endif; ?>

<!-- Open Graph -->
<meta property="og:title" content="<?= htmlspecialchars($ogTitle ?? $pageTitle); ?>" />
<meta property="og:description" content="<?= htmlspecialchars($ogDesc ?? $pageDesc); ?>" />
<meta property="og:type" content="website" />
<meta property="og:url" content="<?= htmlspecialchars($ogUrl ?? $canonicalUrl); ?>" />
<meta property="og:image" content="https://www.uxpacific.com/img/LOGO.png" />
<meta property="og:site_name" content="UX Pacific" />

<!-- Twitter -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?= htmlspecialchars($ogTitle ?? $pageTitle); ?>">
<meta name="twitter:description" content="<?= htmlspecialchars($ogDesc ?? $pageDesc); ?>">
<meta name="twitter:image" content="https://www.uxpacific.com/img/LOGO.png">
<meta name="p:domain_verify" content="cead6e216e4572e79f4591f818674d75"/>
  <meta name="google-site-verification" content="eBDfCy1a9pilJTyIDnbpUeBgP9apI8hdROPMMvqeqXU" />


<?php if (!empty($ldJson)): ?>
<?php
  // Validate that ldJson is actually valid JSON before outputting
  $ldJsonDecoded = json_decode($ldJson);
  if (json_last_error() === JSON_ERROR_NONE && $ldJsonDecoded !== null):
?>
<script type="application/ld+json"><?= $ldJson; ?></script>
<?php endif; ?>
<?php endif; ?>

<link rel="icon" href="<?= $favicon ?? 'img/Workbook.png'; ?>" />

<link rel="preload" href="main.css" as="style">

<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet" />

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
<link rel="stylesheet" href="main.css" />

</head>