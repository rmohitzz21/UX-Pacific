<?php

declare(strict_types=1);

/**
 * Helpers for the public location-page index (footer site map).
 */

if (!function_exists('uxp_extract_location_label_from_title')) {
    function uxp_extract_location_label_from_title(string $title): string
    {
        if (preg_match('/\bin\s+(.+?)\s*\|/iu', $title, $m)) {
            return trim($m[1]);
        }

        return trim($title);
    }
}

if (!function_exists('uxp_unescape_php_single_quoted')) {
    function uxp_unescape_php_single_quoted(string $value): string
    {
        return str_replace(["\\\\", "\\'"], ["\\", "'"], $value);
    }
}

if (!function_exists('uxp_extract_location_label_from_file')) {
    function uxp_extract_location_label_from_file(string $path): string
    {
        $fh = @fopen($path, 'r');
        if (!$fh) {
            return '';
        }

        $linesRead = 0;
        while (($line = fgets($fh)) !== false && $linesRead++ < 80) {
            if (preg_match("/\\\$pageTitle\s*=\s*'((?:\\\\.|[^'\\\\])*)'\s*;/", $line, $m)) {
                fclose($fh);
                $title = uxp_unescape_php_single_quoted($m[1]);
                return uxp_extract_location_label_from_title($title);
            }
        }

        fclose($fh);
        return '';
    }
}

if (!function_exists('uxp_label_from_location_slug')) {
    function uxp_label_from_location_slug(string $slug): string
    {
        $slug = preg_replace('/^ui-ux-design-agency-in-/', '', $slug) ?? $slug;
        $parts = array_filter(explode('-', $slug), static fn(string $p): bool => $p !== '');
        if ($parts === []) {
            return '';
        }

        return implode(' ', array_map(
            static fn(string $word): string => mb_convert_case($word, MB_CASE_TITLE, 'UTF-8'),
            $parts
        ));
    }
}

if (!function_exists('uxp_build_location_pages_index')) {
    /**
     * @return list<array{slug:string,label:string,path:string}>
     */
    function uxp_build_location_pages_index(string $rootDir): array
    {
        $files = glob($rootDir . '/ui-ux-design-agency-in-*.php') ?: [];
        sort($files);

        $pages = [];
        foreach ($files as $filePath) {
            $base = basename($filePath, '.php');
            $label = uxp_extract_location_label_from_file($filePath);
            if ($label === '') {
                $label = uxp_label_from_location_slug($base);
            }

            $pages[] = [
                'slug'  => $base,
                'label' => $label,
                'path'  => '/' . $base,
            ];
        }

        usort($pages, static function (array $a, array $b): int {
            return strcasecmp($a['label'], $b['label']);
        });

        return $pages;
    }
}

if (!function_exists('uxp_write_location_pages_index')) {
    function uxp_write_location_pages_index(string $rootDir): int
    {
        $pages = uxp_build_location_pages_index($rootDir);
        $dataDir = $rootDir . '/data';
        if (!is_dir($dataDir) && !mkdir($dataDir, 0755, true) && !is_dir($dataDir)) {
            throw new RuntimeException('Unable to create data directory.');
        }

        $json = json_encode($pages, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        if ($json === false) {
            throw new RuntimeException('Unable to encode location pages index.');
        }

        file_put_contents($dataDir . '/location-pages.json', $json);

        return count($pages);
    }
}

if (!function_exists('uxp_read_location_pages_index')) {
    /**
     * @return list<array{slug:string,label:string,path:string}>
     */
    function uxp_read_location_pages_index(string $rootDir): array
    {
        $jsonFile = $rootDir . '/data/location-pages.json';
        if (!is_file($jsonFile)) {
            uxp_write_location_pages_index($rootDir);
        }

        $raw = @file_get_contents($jsonFile);
        $pages = json_decode((string) $raw, true);

        return is_array($pages) ? $pages : [];
    }
}

if (!function_exists('uxp_group_location_pages_by_letter')) {
    /**
     * @param list<array{slug:string,label:string,path:string}> $pages
     * @return array<string, list<array{slug:string,label:string,path:string}>>
     */
    function uxp_group_location_pages_by_letter(array $pages): array
    {
        $grouped = [];
        foreach ($pages as $page) {
            $label = (string) ($page['label'] ?? '');
            $letter = mb_strtoupper(mb_substr($label, 0, 1, 'UTF-8'), 'UTF-8');
            if ($letter === '' || !preg_match('/^[A-Z]$/u', $letter)) {
                $letter = '#';
            }
            $grouped[$letter][] = $page;
        }

        ksort($grouped, SORT_STRING);

        return $grouped;
    }
}
