<?php
declare(strict_types=1);

/**
 * Site favicon path (same as public site via includes/config.php).
 */
function adminFaviconHref(): string
{
    if (!function_exists('uxp_root_relative_url')) {
        require_once dirname(__DIR__, 2) . '/includes/paths.php';
    }

    require_once dirname(__DIR__, 2) . '/includes/config.php';

    $path = isset($favicon) && is_string($favicon) && $favicon !== ''
        ? $favicon
        : 'img/fav.png';

    return uxp_root_relative_url($path);
}

/**
 * Browser tab title for admin pages.
 */
function adminDocumentTitle(?string $pageTitle = null): string
{
    $name = trim((string) ($pageTitle ?? ''));
    if ($name === '') {
        $name = 'Admin';
    }

    return $name . ' | UX Pacific Admin';
}

/**
 * Resolve page heading / document name from nav key when a page omits $page_title.
 *
 * @param array<string, array{label: string, href: string, icon: string, title?: string}> $navItems
 */
function adminResolvePageTitle(?string $pageTitle, ?string $activeNav, array $navItems): string
{
    $title = trim((string) ($pageTitle ?? ''));
    if ($title !== '') {
        return $title;
    }

    if ($activeNav !== null && $activeNav !== '' && isset($navItems[$activeNav])) {
        $item = $navItems[$activeNav];
        if (!empty($item['title']) && is_string($item['title'])) {
            return $item['title'];
        }
        if (!empty($item['label']) && is_string($item['label'])) {
            return $item['label'];
        }
    }

    return 'Admin';
}
