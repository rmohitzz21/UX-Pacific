<?php
/**
 * Database Setup Script
 * 
 * WARNING: This script creates/modifies database tables.
 * It is blocked in production environments for safety.
 * Only accessible from localhost during development.
 */
declare(strict_types=1);

// Production guard - MUST be first
require_once __DIR__ . '/../includes/production_guard.php';

// Auth check - super_admin only
require_once __DIR__ . '/../includes/auth.php';
requireAdminRole('super_admin', 'api');

// Use shared credentials (no hardcoded values)
require_once __DIR__ . '/db.php';

header('Content-Type: application/json');

try {
    // Create services table
    $pdo->exec("CREATE TABLE IF NOT EXISTS services (
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        slug VARCHAR(255) NOT NULL UNIQUE,
        short_desc VARCHAR(500) NOT NULL,
        what_it_solves JSON NULL,
        how_we_work JSON NULL,
        what_changes JSON NULL,
        deliverables JSON NULL,
        icon_name VARCHAR(100) NULL,
        status ENUM('published','draft') DEFAULT 'published',
        sort_order INT UNSIGNED NOT NULL DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
    
    // Create contacts table
    $pdo->exec("CREATE TABLE IF NOT EXISTS contacts (
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(150) NOT NULL,
        email VARCHAR(255) NOT NULL,
        phone VARCHAR(20) NULL,
        industry VARCHAR(100) NULL,
        service_interest VARCHAR(100) NULL,
        message TEXT NOT NULL,
        status ENUM('new','read','awaiting_reply','replied') DEFAULT 'new',
        admin_note TEXT NULL,
        ip_address VARCHAR(45) NULL,
        user_agent VARCHAR(500) NULL,
        submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        replied_at TIMESTAMP NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
    
    // Create testimonials table
    $pdo->exec("CREATE TABLE IF NOT EXISTS testimonials (
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        client_name VARCHAR(150) NOT NULL,
        client_company VARCHAR(150) NULL,
        client_role VARCHAR(150) NULL,
        badge_label VARCHAR(120) NULL,
        photo_url VARCHAR(500) NULL,
        quote TEXT NOT NULL,
        rating TINYINT(1) DEFAULT 5,
        is_visible TINYINT(1) NOT NULL DEFAULT 1,
        sort_order INT UNSIGNED NOT NULL DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
    
    // Create ecosystem table
    $pdo->exec("CREATE TABLE IF NOT EXISTS ecosystem (
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        partner_name VARCHAR(150) NOT NULL,
        details TEXT NULL,
        website_url VARCHAR(500) NULL,
        logo_url VARCHAR(500) NULL,
        is_visible TINYINT(1) NOT NULL DEFAULT 1,
        sort_order INT UNSIGNED NOT NULL DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
    
    // Create faqs table
    $pdo->exec("CREATE TABLE IF NOT EXISTS faqs (
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        question VARCHAR(500) NOT NULL,
        answer TEXT NOT NULL,
        category VARCHAR(100) DEFAULT 'General',
        sort_order INT UNSIGNED NOT NULL DEFAULT 0,
        is_visible TINYINT(1) NOT NULL DEFAULT 1,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
    
    // Create client_logos table
    $pdo->exec("CREATE TABLE IF NOT EXISTS client_logos (
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        logo_url VARCHAR(500) NOT NULL,
        website_url VARCHAR(500) NULL,
        sort_order INT UNSIGNED NOT NULL DEFAULT 0,
        is_visible TINYINT(1) NOT NULL DEFAULT 1,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

    echo json_encode(['success' => true, 'message' => 'Tables created/verified successfully.']);

} catch (PDOException $e) {
    error_log('Setup DB error: ' . $e->getMessage());
    http_response_code(500);
    echo json_encode(['error' => 'Database setup failed. Check server logs.']);
}
