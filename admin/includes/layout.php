<?php // FILE: admin/includes/layout.php
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/../../includes/paths.php';
requireAdminAuth('page');
$base_url = str_contains($_SERVER['SCRIPT_NAME'], '/pages/') ? '../' : '';
$adminUser = $_SESSION['admin_user'] ?? ['name' => 'Admin', 'role' => 'admin'];
?>
<!DOCTYPE html>
<html lang="en" class="h-full" x-data="{ isDark: localStorage.getItem('darkMode') === 'true' }" x-init="$watch('isDark', val => localStorage.setItem('darkMode', val))" :class="{ 'dark': isDark }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($page_title ?? 'Admin') ?> — UX Pacific Admin</title>
    <meta name="robots" content="noindex, nofollow">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>tailwind.config = { darkMode: 'class' }</script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= $base_url ?>assets/admin.css">
    <style>
        body { font-family: 'Inter', system-ui, sans-serif; }
    </style>
    <script>
        window.__UXP_ADMIN_CSRF__ = <?= json_encode(adminCsrfToken(), JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;
        window.uxpAdminFetch = function (url, opts) {
            opts = opts || {};
            var headers = new Headers(opts.headers || {});
            headers.set('X-CSRF-Token', window.__UXP_ADMIN_CSRF__ || '');
            opts.headers = headers;
            return fetch(url, opts);
        };
    </script>
</head>
<body class="h-full bg-gradient-to-br from-[#111111] via-[#1a1133] to-[#6147bd] text-white font-sans transition-colors">
<div class="flex h-screen overflow-hidden">

  <!-- LEFT -->
  <aside class="w-60 bg-[#111111] flex flex-col h-screen flex-shrink-0 z-20">
    <div class="px-6 py-5 border-b border-zinc-800 flex items-baseline">
      <img src="<?= uxp_root_relative_url('img/LOGO.png') ?>" alt="UX Pacific Logo" style="height: 20px; width: auto; display: block;">
      <!-- <span class="text-zinc-500 text-xs ml-2">Admin</span> -->
    </div>

    <nav class="flex-1 px-3 py-4 overflow-y-auto space-y-0.5 custom-scrollbar">
      <?php
      $nav_items = [
          'dashboard' => ['label' => 'Dashboard', 'href' => $base_url . 'dashboard.php', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />'],
          'projects' => ['label' => 'Projects', 'href' => $base_url . 'pages/projects.php', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />'],
          'client_logos' => ['label' => 'Client logos', 'href' => $base_url . 'pages/client-logos.php', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />'],
          'services' => ['label' => 'Services', 'href' => $base_url . 'pages/services.php', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />'],
          'contacts' => ['label' => 'Contacts', 'href' => $base_url . 'pages/contacts.php', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />', 'badge' => ''],
          'reviews' => ['label' => 'Reviews', 'href' => $base_url . 'pages/reviews.php', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />'],
          'ecosystem' => ['label' => 'Ecosystem', 'href' => $base_url . 'pages/ecosystem.php', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />'],
          // 'team' => ['label' => 'Team', 'href' => $base_url . 'pages/team.php', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />'],
          'faqs' => ['label' => 'FAQs', 'href' => $base_url . 'pages/faqs.php', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />'],
          // 'seo' => ['label' => 'SEO Meta', 'href' => $base_url . 'pages/seo.php', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />'],
      ];

      foreach ($nav_items as $key => $item):
          $active_class = (isset($active_nav) && $active_nav === $key) ? 'bg-zinc-800 text-white' : 'text-zinc-400 hover:text-white hover:bg-zinc-800 transition-colors';
      ?>
          <a href="<?= $item['href'] ?>" class="flex items-center gap-3 px-3 py-2 rounded-md text-sm <?= $active_class ?>">
              <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <?= $item['icon'] ?>
              </svg>
              <span><?= $item['label'] ?></span>
              <?php if (isset($item['badge'])): ?>
                  <span class="ml-auto bg-zinc-700 text-white text-xs px-1.5 py-0.5 rounded-full"><?= $item['badge'] ?></span>
              <?php endif; ?>
          </a>
      <?php endforeach; ?>
    </nav>

    <?php
    $adminDisplayName = (string) ($adminUser['name'] ?? 'Admin');
    $adminNameTrimmed = trim($adminDisplayName);
    $adminInitial = strtoupper(($adminNameTrimmed !== '' ? $adminNameTrimmed : 'A')[0] ?? 'A');
    ?>
    <div class="border-t border-zinc-800 px-3 py-4 flex-shrink-0 space-y-3">
      <div class="flex items-center gap-3 px-1 min-w-0">
        <div class="w-9 h-9 rounded-full bg-zinc-800 border border-zinc-700 flex items-center justify-center text-sm font-semibold text-zinc-300 flex-shrink-0" aria-hidden="true"><?= htmlspecialchars($adminInitial) ?></div>
        <div class="min-w-0 flex-1">
          <div class="text-sm font-medium text-zinc-200 truncate"><?= htmlspecialchars($adminDisplayName) ?></div>
          <div class="text-xs text-zinc-500 capitalize truncate"><?= htmlspecialchars((string) ($adminUser['role'] ?? 'admin')) ?></div>
        </div>
      </div>
      <form method="POST" action="<?= htmlspecialchars(adminUrl('logout.php')) ?>" class="block">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(adminCsrfToken()) ?>">
        <button
          type="submit"
          class="w-full flex items-center justify-center gap-2 rounded-lg border border-zinc-700/80 bg-zinc-900/60 px-3 py-2.5 text-sm font-medium text-zinc-300 hover:border-red-900/50 hover:bg-red-950/40 hover:text-red-300 focus:outline-none focus:ring-2 focus:ring-red-500/30 transition-colors"
        >
          <svg class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
          </svg>
          Sign out
        </button>
      </form>
    </div>
  </aside>

  <!-- RIGHT MAIN -->
  <main class="flex-1 overflow-y-auto flex flex-col relative">
    <!-- TOPBAR -->
    <header class="bg-[#111111]/40 backdrop-blur-md border-b border-white/10 px-6 py-4 flex items-center justify-between sticky top-0 z-10 transition-colors">
      <h1 class="text-lg font-semibold text-white"><?= htmlspecialchars($page_title ?? '') ?></h1>
      <div class="flex items-center gap-5">
        <a href="https://uxpacific.com" target="_blank" class="text-xs text-white/70 hover:text-white transition-colors">View site ↗</a>
      </div>
    </header>

    <!-- CONTENT AREA -->
    <div class="p-6 flex-1">
<?php
// We use register_shutdown_function to automatically close tags at the end of the page execution.
register_shutdown_function(function() {
?>
    </div> <!-- /CONTENT AREA -->
  </main>
</div> <!-- /flex h-screen -->

<div id="toast-container" class="fixed bottom-4 right-4 z-50 space-y-2 pointer-events-none"></div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize SortableJS on all elements with 'projects-tbody' or just anything with drag-handle
    document.querySelectorAll('tbody').forEach(function(tbody) {
        if(tbody.querySelector('.drag-handle')) {
            new Sortable(tbody, {
                handle: '.drag-handle',
                animation: 150,
                ghostClass: 'bg-zinc-50'
            });
        }
    });
});
</script>
</body>
</html>
<?php
});
?>
