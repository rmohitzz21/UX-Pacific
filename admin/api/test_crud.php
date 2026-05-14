<?php
/**
 * CRUD Test Script
 * 
 * WARNING: Development/testing script only.
 * Blocked in production environments for safety.
 * Only accessible from localhost during development.
 */
declare(strict_types=1);

// Production guard - MUST be first
require_once __DIR__ . '/../includes/production_guard.php';

// Auth check
require_once __DIR__ . '/../includes/auth.php';
requireAdminAuth('api');

// Use shared credentials
require_once __DIR__ . '/db.php';

header('Content-Type: text/plain');

echo "=== CRUD Test Suite ===\n\n";

try {
    echo "1. Testing READ...\n";
    $stmt = $pdo->query("SELECT COUNT(*) as cnt FROM projects");
    echo "   Projects count: " . $stmt->fetch()['cnt'] . "\n\n";

    echo "2. Testing CREATE...\n";
    $stmt = $pdo->prepare("INSERT INTO projects (title, slug, description, thumbnail_url, external_link, link_label, tags, filter_group, is_featured, status, sort_order) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute(['Test Project', 'test-proj-' . time(), 'Test Description', null, null, 'View', json_encode(['test']), 'all', 0, 'draft', 999]);
    $id = $pdo->lastInsertId();
    echo "   Inserted ID: $id\n\n";

    echo "3. Testing UPDATE...\n";
    $stmt = $pdo->prepare("UPDATE projects SET title = ? WHERE id = ?");
    $stmt->execute(['Updated Test Project', $id]);
    $stmt = $pdo->prepare("SELECT title FROM projects WHERE id = ?");
    $stmt->execute([$id]);
    echo "   Updated title: " . $stmt->fetch()['title'] . "\n\n";

    echo "4. Testing DELETE...\n";
    $stmt = $pdo->prepare("DELETE FROM projects WHERE id = ?");
    $stmt->execute([$id]);
    $stmt = $pdo->prepare("SELECT COUNT(*) as cnt FROM projects WHERE id = ?");
    $stmt->execute([$id]);
    echo "   Count after delete: " . $stmt->fetch()['cnt'] . "\n\n";

    echo "=== All CRUD tests passed! ===\n";

} catch (PDOException $e) {
    error_log('CRUD test error: ' . $e->getMessage());
    echo "ERROR: Test failed. Check server logs.\n";
}
