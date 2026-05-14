<?php
/**
 * Upload Test Script
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

header('Content-Type: text/plain');

echo "=== Upload Test ===\n\n";

// Create a minimal valid JPEG for testing
$testImagePath = sys_get_temp_dir() . '/uxp_test_image_' . time() . '.jpg';

// Minimal 1x1 JPEG (valid image data)
$jpegData = base64_decode('/9j/4AAQSkZJRgABAQEASABIAAD/2wBDAAgGBgcGBQgHBwcJCQgKDBQNDAsLDBkSEw8UHRofHh0aHBwgJC4nICIsIxwcKDcpLDAxNDQ0Hyc5PTgyPC4zNDL/2wBDAQkJCQwLDBgNDRgyIRwhMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjL/wAARCAABAAEDASIAAhEBAxEB/8QAFQABAQAAAAAAAAAAAAAAAAAAAAn/xAAUEAEAAAAAAAAAAAAAAAAAAAAA/8QAFQEBAQAAAAAAAAAAAAAAAAAAAAX/xAAUEQEAAAAAAAAAAAAAAAAAAAAA/9oADAMBEQCEAwEPwAAB/9k=');

file_put_contents($testImagePath, $jpegData);

echo "Test image created at: $testImagePath\n";
echo "File size: " . filesize($testImagePath) . " bytes\n";
echo "Is valid image: " . (getimagesize($testImagePath) ? 'Yes' : 'No') . "\n\n";

// Note: This script doesn't make HTTP requests to avoid cURL dependency issues
// It just validates that the test setup works

echo "To test uploads manually:\n";
echo "1. Log into admin panel\n";
echo "2. Go to Projects page\n";
echo "3. Try uploading an image\n\n";

// Clean up
unlink($testImagePath);
echo "Test image cleaned up.\n";
echo "=== Test Complete ===\n";
