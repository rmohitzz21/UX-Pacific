<?php

declare(strict_types=1);

/**
 * CMS read helpers. Without DB tables or rows, these are safe no-ops / empty data
 * so pages that still `require` this file after a partial git revert do not fatally error.
 * Restore the full CMS schema + seed when you want DB-driven content again.
 */

require_once __DIR__ . '/database.php';

function uxp_page_seo_overlay(string $routeKey): void
{
    $pdo = uxp_db();
    if (!$pdo) {
        return;
    }
    try {
        $stmt = $pdo->prepare('SELECT * FROM page_seo WHERE route_key = ? LIMIT 1');
        $stmt->execute([$routeKey]);
        $r = $stmt->fetch();
    } catch (Throwable) {
        return;
    }
    if (!$r) {
        return;
    }
    if (!empty($r['page_title'])) {
        $GLOBALS['pageTitle'] = (string) $r['page_title'];
    }
    if (array_key_exists('meta_description', $r) && $r['meta_description'] !== null && $r['meta_description'] !== '') {
        $GLOBALS['pageDesc'] = (string) $r['meta_description'];
    }
    if (!empty($r['canonical_url'])) {
        $GLOBALS['canonicalUrl'] = (string) $r['canonical_url'];
    }
    if (!empty($r['og_title'])) {
        $GLOBALS['ogTitle'] = (string) $r['og_title'];
    }
    if (array_key_exists('og_description', $r) && $r['og_description'] !== null && $r['og_description'] !== '') {
        $GLOBALS['ogDesc'] = (string) $r['og_description'];
    }
    if (!empty($r['og_image'])) {
        $GLOBALS['ogImage'] = (string) $r['og_image'];
    }
    if (!empty($r['robots'])) {
        $GLOBALS['metaRobots'] = (string) $r['robots'];
    }
    if (array_key_exists('structured_data_json', $r) && $r['structured_data_json'] !== null && $r['structured_data_json'] !== '') {
        $GLOBALS['ldJson'] = (string) $r['structured_data_json'];
    }
}

function uxp_site_setting(string $key, string $default = ''): string
{
    static $cache = null;
    if ($cache === null) {
        $cache = [];
        $pdo = uxp_db();
        if ($pdo) {
            try {
                $stmt = $pdo->query('SELECT setting_key, setting_value FROM site_settings');
                if ($stmt) {
                    foreach ($stmt->fetchAll() as $r) {
                        $cache[(string) $r['setting_key']] = (string) ($r['setting_value'] ?? '');
                    }
                }
            } catch (Throwable) {
                // Table missing or DB error — keep empty cache, fall back to defaults per key.
            }
        }
    }

    return $cache[$key] ?? $default;
}

/** @return list<array<string, mixed>> */
function uxp_public_services(): array
{
    return [];
}

/** @return list<array<string, mixed>> */
function uxp_public_portfolio(): array
{
    return [];
}

/** @return list<array<string, mixed>> */
function uxp_public_testimonials(): array
{
    return [];
}

/** @return list<array<string, mixed>> */
function uxp_public_ecosystem(): array
{
    return [];
}

/** @return array<string, mixed>|null */
function uxp_geo_page(string $slug): ?array
{
    $pdo = uxp_db();
    if (!$pdo) {
        return null;
    }
    try {
        $stmt = $pdo->prepare('SELECT * FROM geo_landing_pages WHERE country_slug = ? AND is_published = 1 LIMIT 1');
        $stmt->execute([$slug]);
        $row = $stmt->fetch();
    } catch (Throwable) {
        return null;
    }

    return $row ?: null;
}
