<?php
/**
 * Database Seed Script
 * 
 * WARNING: This script inserts sample data into the database.
 * It is blocked in production environments for safety.
 * Only accessible from localhost during development.
 */
declare(strict_types=1);

// Production guard - MUST be first
require_once __DIR__ . '/../includes/production_guard.php';

// Auth check - super_admin only
require_once __DIR__ . '/../includes/auth.php';
requireAdminRole('super_admin', 'api');

// Use shared credentials
require_once __DIR__ . '/db.php';

header('Content-Type: application/json');

try {
    $stmt = $pdo->prepare("INSERT INTO projects (title, slug, description, thumbnail_url, external_link, link_label, tags, filter_group, is_featured, status, sort_order) VALUES 
        (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?),
        (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?),
        (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");
    
    $stmt->execute([
        'UX Audit — FinTech App', 'ux-audit-fintech', 'Comprehensive UX Audit for a major FinTech application, increasing conversion by 20%.', 
        'https://placehold.co/60x40/2e2e3e/ffffff?text=P1', 'https://example.com/fintech', 'View Case Study', 
        '["UX Audit", "FinTech"]', 'case_studies', 1, 'published', 1,
        
        'Mobile Dashboard — EdTech', 'mobile-dashboard-edtech', 'Designed a seamless mobile dashboard for students and teachers.', 
        'https://placehold.co/60x40/2e2e3e/ffffff?text=P2', 'https://example.com/edtech', 'View Project', 
        '["Mobile", "Dashboard"]', 'selected_work', 0, 'draft', 2,
        
        'Brand Redesign — Healthcare', 'brand-redesign', 'A complete brand overhaul and digital presence redesign for a healthcare provider.', 
        'https://placehold.co/60x40/2e2e3e/ffffff?text=P3', 'https://example.com/health', 'Read More', 
        '["UI/UX", "Healthcare"]', 'all', 1, 'published', 3
    ]);
    
    echo json_encode(['success' => true, 'message' => 'Sample data seeded successfully.']);

} catch (PDOException $e) {
    error_log('Seed DB error: ' . $e->getMessage());
    http_response_code(500);
    echo json_encode(['error' => 'Database seeding failed. Check server logs.']);
}
