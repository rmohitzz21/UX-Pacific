<?php
/**
 * Admin API - Secure File Upload Handler
 * 
 * Security features:
 * - Admin authentication required
 * - Server-side MIME validation (finfo)
 * - Image content verification (getimagesize/GD)
 * - Size limits enforced
 * - Safe random filenames
 * - WebP conversion when possible
 */
declare(strict_types=1);

require_once __DIR__ . '/../includes/auth.php';
require_once dirname(__DIR__, 2) . '/includes/paths.php';

requireAdminAuth('api');

require_once __DIR__ . '/../includes/api_helpers.php';
adminRequireValidCsrfForMutation();

header('Content-Type: application/json');

// Only allow POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed.']);
    exit;
}

// Check if file was uploaded
if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
    $errorCode = $_FILES['image']['error'] ?? UPLOAD_ERR_NO_FILE;
    $errorMessages = [
        UPLOAD_ERR_INI_SIZE   => 'File exceeds server limit.',
        UPLOAD_ERR_FORM_SIZE  => 'File exceeds form limit.',
        UPLOAD_ERR_PARTIAL    => 'File was only partially uploaded.',
        UPLOAD_ERR_NO_FILE    => 'No file was uploaded.',
        UPLOAD_ERR_NO_TMP_DIR => 'Server configuration error.',
        UPLOAD_ERR_CANT_WRITE => 'Server write error.',
        UPLOAD_ERR_EXTENSION  => 'Upload blocked by server.',
    ];
    http_response_code(400);
    echo json_encode(['error' => $errorMessages[$errorCode] ?? 'Upload failed.']);
    exit;
}

$file = $_FILES['image'];
$tmpPath = $file['tmp_name'];
$maxSize = 5 * 1024 * 1024; // 5MB

// Size validation
if ($file['size'] > $maxSize) {
    http_response_code(400);
    echo json_encode(['error' => 'File is too large. Maximum size is 5MB.']);
    exit;
}

// Server-side MIME detection using finfo (DO NOT trust $_FILES['type'])
$finfo = new finfo(FILEINFO_MIME_TYPE);
$detectedMime = $finfo->file($tmpPath);

$allowedMimes = [
    'image/jpeg' => 'jpg',
    'image/png'  => 'png',
    'image/gif'  => 'gif',
    'image/webp' => 'webp',
];

if (!isset($allowedMimes[$detectedMime])) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid file type. Only JPG, PNG, GIF, and WebP images are allowed.']);
    exit;
}

// Additional validation: verify it's actually an image using getimagesize
$imageInfo = @getimagesize($tmpPath);
if ($imageInfo === false) {
    http_response_code(400);
    echo json_encode(['error' => 'File does not appear to be a valid image.']);
    exit;
}

// Ensure upload directory exists
$uploadDir = dirname(__DIR__, 2) . '/uploads/';
if (!is_dir($uploadDir)) {
    if (!@mkdir($uploadDir, 0755, true)) {
        error_log('Upload directory creation failed: ' . $uploadDir);
        http_response_code(500);
        echo json_encode(['error' => 'Server configuration error.']);
        exit;
    }
}

// Check directory is writable
if (!is_writable($uploadDir)) {
    error_log('Upload directory not writable: ' . $uploadDir);
    http_response_code(500);
    echo json_encode(['error' => 'Server configuration error.']);
    exit;
}

// Try to load and re-save as WebP using GD (strips metadata, validates image content)
$img = false;
$gdEnabled = extension_loaded('gd');

if ($gdEnabled) {
    switch ($detectedMime) {
        case 'image/jpeg':
            $img = @imagecreatefromjpeg($tmpPath);
            break;
        case 'image/png':
            $img = @imagecreatefrompng($tmpPath);
            if ($img !== false) {
                imagepalettetotruecolor($img);
                imagealphablending($img, true);
                imagesavealpha($img, true);
            }
            break;
        case 'image/gif':
            $img = @imagecreatefromgif($tmpPath);
            if ($img !== false) {
                imagepalettetotruecolor($img);
            }
            break;
        case 'image/webp':
            $img = @imagecreatefromwebp($tmpPath);
            break;
    }
}

// Generate secure random filename (no user input in filename)
$filename = bin2hex(random_bytes(16));

if ($img !== false) {
    // Save as WebP (optimal format, strips EXIF data)
    $filename .= '.webp';
    $targetPath = $uploadDir . $filename;
    
    if (imagewebp($img, $targetPath, 85)) {
        imagedestroy($img);
        // Root-relative so <img> works from /admin/pages/... (not admin/pages/uploads/...)
        $url = uxp_root_relative_url('uploads/' . $filename);
        echo json_encode(['success' => true, 'url' => $url]);
        exit;
    }
    
    imagedestroy($img);
    // Fall through to fallback if WebP save failed
}

// Fallback: move original file if GD failed or is unavailable
$ext = $allowedMimes[$detectedMime];
$filename .= '.' . $ext;
$targetPath = $uploadDir . $filename;

if (move_uploaded_file($tmpPath, $targetPath)) {
    $url = uxp_root_relative_url('uploads/' . $filename);
    echo json_encode(['success' => true, 'url' => $url]);
    exit;
}

error_log('Failed to move uploaded file to: ' . $targetPath);
http_response_code(500);
echo json_encode(['error' => 'Failed to save uploaded file.']);
