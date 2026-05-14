<?php

declare(strict_types=1);

/**
 * CMS read helpers. Without DB tables or rows, these are safe no-ops / empty data
 * so pages that still `require` this file after a partial git revert do not fatally error.
 * Restore the full CMS schema + seed when you want DB-driven content again.
 */

require_once __DIR__ . '/database.php';
require_once __DIR__ . '/paths.php';

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
function get_published_ecosystem(): array
{
    $pdo = uxp_db();
    if (!$pdo) {
        return [];
    }
    try {
        $stmt = $pdo->query(
            "SELECT * FROM ecosystem WHERE is_visible = 1 ORDER BY sort_order ASC, created_at DESC"
        );

        $rows = $stmt ? ($stmt->fetchAll(PDO::FETCH_ASSOC) ?: []) : [];
        foreach ($rows as &$row) {
            if (!empty($row['logo_url'])) {
                $row['logo_url'] = uxp_normalize_stored_media_url((string) $row['logo_url']);
            }
        }
        unset($row);

        return $rows;
    } catch (Throwable) {
        return [];
    }
}

/** @return list<array<string, mixed>> */
function uxp_public_ecosystem(): array
{
    return get_published_ecosystem();
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
        // geo_landing_pages table doesn't exist yet - safe fallback
        return null;
    }

    return $row ?: null;
}

/** @return list<array<string, mixed>> */
function get_published_projects(string $filter = 'all', bool $featured_only = false): array
{
    $pdo = uxp_db();
    if (!$pdo) {
        return [];
    }
    $sql = "SELECT * FROM projects WHERE status = 'published'";
    $params = [];
    if ($filter !== 'all') {
        $sql .= ' AND filter_group = ?';
        $params[] = $filter;
    }
    if ($featured_only) {
        $sql .= ' AND is_featured = 1';
    }
    $sql .= ' ORDER BY sort_order ASC, created_at DESC';
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
    foreach ($rows as &$row) {
        if (!empty($row['thumbnail_url'])) {
            $row['thumbnail_url'] = uxp_normalize_stored_media_url((string) $row['thumbnail_url']);
        }
    }
    unset($row);

    return $rows;
}

/** @return list<array<string, mixed>> */
function get_published_services(): array
{
    $pdo = uxp_db();
    if (!$pdo) {
        return [];
    }
    $stmt = $pdo->query("SELECT * FROM services WHERE status = 'published' ORDER BY sort_order ASC");
    $rows = $stmt ? ($stmt->fetchAll(PDO::FETCH_ASSOC) ?: []) : [];
    foreach ($rows as &$row) {
        if (!empty($row['icon_name']) && is_string($row['icon_name'])) {
            $row['icon_name'] = uxp_normalize_if_upload_path($row['icon_name']);
        }
    }
    unset($row);

    return $rows;
}

/** @return array<string, string> */
function get_home_settings(): array
{
    $pdo = uxp_db();
    if (!$pdo) {
        return [];
    }
    try {
        $stmt = $pdo->query('SELECT setting_key, setting_value FROM home_settings');
        $rows = $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
        $settings = [];
        foreach ($rows as $row) {
            $settings[(string) $row['setting_key']] = (string) $row['setting_value'];
        }
        return $settings;
    } catch (Throwable) {
        return [];
    }
}

/** @return list<array<string, mixed>> */
function get_visible_faqs(): array
{
    $pdo = uxp_db();
    if (!$pdo) {
        return [];
    }
    $stmt = $pdo->query('SELECT * FROM faqs WHERE is_visible = 1 ORDER BY sort_order ASC');
    return $stmt ? ($stmt->fetchAll(PDO::FETCH_ASSOC) ?: []) : [];
}

/** @return list<array<string, mixed>> */
function get_visible_team(): array
{
    $pdo = uxp_db();
    if (!$pdo) {
        return [];
    }
    $stmt = $pdo->query('SELECT * FROM team_members WHERE is_visible = 1 ORDER BY sort_order ASC');
    return $stmt ? ($stmt->fetchAll(PDO::FETCH_ASSOC) ?: []) : [];
}

/** @return list<array<string, mixed>> */
function get_visible_testimonials(): array
{
    $pdo = uxp_db();
    if (!$pdo) {
        return [];
    }
    $stmt = $pdo->query('SELECT * FROM testimonials WHERE is_visible = 1 ORDER BY sort_order ASC, created_at DESC');
    return $stmt ? ($stmt->fetchAll(PDO::FETCH_ASSOC) ?: []) : [];
}

/**
 * Normalize testimonial avatar / photo for public output (relative site paths or HTTPS URLs only).
 */
function uxp_testimonial_photo_url(?string $url): string
{
    $url = trim((string) $url);
    if ($url === '') {
        return 'img/Oval.png';
    }
    $lower = strtolower($url);
    if (
        strpos($lower, 'javascript:') === 0
        || strpos($lower, 'data:') === 0
        || strpos($lower, 'vbscript:') === 0
    ) {
        return 'img/Oval.png';
    }
    if (preg_match('#^https?://#i', $url)) {
        return $url;
    }
    $url = str_replace('\\', '/', $url);
    $url = preg_replace('#^(\.\./)+#', '', $url);
    $url = ltrim($url, './');

    $rel = $url === '' ? 'img/Oval.png' : $url;

    return uxp_normalize_stored_media_url($rel);
}

/**
 * Public JSON payload for the home page reviews marquee (no admin-only fields).
 *
 * @return list<array{client_name:string, subtitle:string, badge_label:string, quote:string, rating:int, photo_url:string}>
 */
function get_visible_testimonials_for_api(): array
{
    $rows = get_visible_testimonials();
    $out = [];
    foreach ($rows as $r) {
        $quote = trim((string) ($r['quote'] ?? ''));
        $name = trim((string) ($r['client_name'] ?? ''));
        if ($quote === '' || $name === '') {
            continue;
        }
        $role = trim((string) ($r['client_role'] ?? ''));
        $company = trim((string) ($r['client_company'] ?? ''));
        $subtitleParts = array_filter([$role, $company], static fn ($p) => $p !== '');
        $subtitle = implode(' · ', $subtitleParts);
        $badge = trim((string) ($r['badge_label'] ?? ''));
        if ($badge === '') {
            $badge = 'Review';
        }
        $rating = (int) ($r['rating'] ?? 5);
        if ($rating < 1) {
            $rating = 1;
        }
        if ($rating > 5) {
            $rating = 5;
        }
        $out[] = [
            'client_name' => $name,
            'subtitle' => $subtitle,
            'badge_label' => $badge,
            'quote' => $quote,
            'rating' => $rating,
            'photo_url' => uxp_testimonial_photo_url($r['photo_url'] ?? null),
        ];
    }

    return $out;
}

/** @return list<array<string, mixed>> */
function get_visible_client_logos(): array
{
    $pdo = uxp_db();
    if (!$pdo) {
        return [];
    }
    $stmt = $pdo->query('SELECT * FROM client_logos WHERE is_visible = 1 ORDER BY sort_order ASC');
    $rows = $stmt ? ($stmt->fetchAll(PDO::FETCH_ASSOC) ?: []) : [];
    foreach ($rows as &$row) {
        if (!empty($row['logo_url'])) {
            $row['logo_url'] = uxp_normalize_stored_media_url((string) $row['logo_url']);
        }
    }
    unset($row);

    return $rows;
}

/** @return array<string, mixed> */
function get_page_seo(string $page_key): array
{
    $pdo = uxp_db();
    if (!$pdo) {
        return [];
    }
    $stmt = $pdo->prepare('SELECT * FROM seo_meta WHERE page_key = ? LIMIT 1');
    $stmt->execute([$page_key]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row ?: [];
}

function save_contact_submission(array $data): int
{
    $pdo = uxp_db();
    if (!$pdo) {
        return 0;
    }
    $stmt = $pdo->prepare(
        'INSERT INTO contacts (name, email, phone, service_interest, message, ip_address, user_agent)
         VALUES (?, ?, ?, ?, ?, ?, ?)'
    );
    $stmt->execute([
        strip_tags((string) ($data['name'] ?? '')),
        filter_var((string) ($data['email'] ?? ''), FILTER_SANITIZE_EMAIL),
        strip_tags((string) ($data['phone'] ?? '')),
        strip_tags((string) ($data['service_interest'] ?? ($data['service'] ?? ''))),
        strip_tags((string) ($data['message'] ?? '')),
        (string) ($_SERVER['REMOTE_ADDR'] ?? ''),
        substr((string) ($_SERVER['HTTP_USER_AGENT'] ?? ''), 0, 500),
    ]);

    return (int) $pdo->lastInsertId();
}
