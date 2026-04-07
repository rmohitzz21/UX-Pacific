<?php require_once __DIR__ . '/config.php'; ?>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title><?php echo htmlspecialchars($pageTitle ?? 'UX Pacific'); ?></title>
<?php if (!empty($pageDesc)): ?>
<meta name="description" content="<?php echo htmlspecialchars($pageDesc); ?>" />
<?php endif; ?>
<?php if (!empty($metaRobots)): ?>
<meta name="robots" content="<?php echo htmlspecialchars($metaRobots); ?>" />
<?php endif; ?>
<?php if (!empty($canonicalUrl)): ?>
<link rel="canonical" href="<?php echo htmlspecialchars($canonicalUrl); ?>" />
<?php endif; ?>
<?php if (!empty($ogTitle)): ?>
<meta property="og:title" content="<?php echo htmlspecialchars($ogTitle); ?>" />
<meta property="og:description" content="<?php echo htmlspecialchars($ogDesc ?? ''); ?>" />
<meta property="og:type" content="website" />
<meta property="og:url" content="<?php echo htmlspecialchars($ogUrl ?? ''); ?>" />
<meta property="og:image" content="https://www.uxpacific.com/img/LOGO.png" />
<?php endif; ?>
<?php if (!empty($ldJson)): ?>
<script type="application/ld+json"><?php echo $ldJson; ?></script>
<?php endif; ?>
<link href="<?php echo $favicon ?? 'img/Final.png'; ?>" rel="shortcut icon" type="image/x-icon" />
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
<link rel="stylesheet" href="main.css" />
