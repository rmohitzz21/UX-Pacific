<?php

declare(strict_types=1);

require_once __DIR__ . '/includes/location_pages.php';

$pageTitle    = 'All Locations | UX Pacific';
$pageDesc     = 'Browse all UX Pacific UI/UX design agency location pages worldwide.';
$canonicalUrl = 'https://www.uxpacific.com/site-index';
$ogTitle      = 'All Locations | UX Pacific';
$ogDesc       = 'Explore UX Pacific location pages for UI/UX design services across countries, states, and cities.';
$ogUrl        = 'https://www.uxpacific.com/site-index';
$currentPage  = 'site-index';

$locationPages = uxp_read_location_pages_index(__DIR__);
$groupedPages  = uxp_group_location_pages_by_letter($locationPages);
$totalCount    = count($locationPages);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include 'includes/head.php'; ?>
  </head>
  <body class="site-index-page">
    <?php include 'includes/navbar.php'; ?>

    <main class="site-index-main">
      <section class="site-index-intro">
        <div class="container">
          <h1>UX Pacific Locations</h1>
          <p class="site-index-lead">
            Browse all UI/UX design agency pages by location. Select any place name to open its dedicated page.
          </p>
          <div class="site-index-toolbar">
            <input
              type="search"
              id="siteIndexSearch"
              class="site-index-search"
              placeholder="Search locations (e.g. India, California, Mumbai)..."
              autocomplete="off"
              aria-label="Search locations"
            />
            <span id="siteIndexCount" class="site-index-count"><?= number_format($totalCount) ?> locations</span>
          </div>
        </div>
      </section>

      <section class="site-index-directory">
        <div class="container">
          <div id="siteIndexGrid" class="site-index-grid">
            <?php foreach ($groupedPages as $letter => $pages): ?>
              <section class="site-index-group" data-letter="<?= htmlspecialchars($letter) ?>">
                <h2 class="site-index-letter"><?= htmlspecialchars($letter) ?></h2>
                <ul class="site-index-list">
                  <?php foreach ($pages as $page): ?>
                    <li class="site-index-item" data-label="<?= htmlspecialchars(mb_strtolower((string) $page['label'], 'UTF-8')) ?>">
                      <a href="<?= htmlspecialchars(rtrim((string) BASE_URL, '/') . $page['path']) ?>">
                        <?= htmlspecialchars((string) $page['label']) ?>
                      </a>
                    </li>
                  <?php endforeach; ?>
                </ul>
              </section>
            <?php endforeach; ?>
          </div>
          <p id="siteIndexEmpty" class="site-index-empty" hidden>No locations match your search.</p>
        </div>
      </section>
    </main>

    <?php include 'includes/footer.php'; ?>
    <?php include 'includes/scripts.php'; ?>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
      const searchEl = document.getElementById("siteIndexSearch");
      const countEl = document.getElementById("siteIndexCount");
      const emptyEl = document.getElementById("siteIndexEmpty");
      const items = Array.from(document.querySelectorAll(".site-index-item"));
      const groups = Array.from(document.querySelectorAll(".site-index-group"));
      const total = items.length;
      let timer = null;

      if (!searchEl || !countEl || !emptyEl) return;

      function updateView() {
        const needle = searchEl.value.trim().toLowerCase();
        let visible = 0;

        items.forEach((item) => {
          const label = item.getAttribute("data-label") || "";
          const show = !needle || label.includes(needle);
          item.hidden = !show;
          if (show) visible++;
        });

        groups.forEach((group) => {
          const hasVisible = Array.from(group.querySelectorAll(".site-index-item")).some((item) => !item.hidden);
          group.hidden = !hasVisible;
        });

        emptyEl.hidden = visible !== 0;
        countEl.textContent = needle
          ? visible.toLocaleString() + " of " + total.toLocaleString()
          : total.toLocaleString() + " locations";
      }

      searchEl.addEventListener("input", function () {
        clearTimeout(timer);
        timer = setTimeout(updateView, 120);
      });
    });
    </script>
  </body>
</html>
