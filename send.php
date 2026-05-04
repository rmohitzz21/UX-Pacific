<?php
declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

header('Content-Type: application/json; charset=UTF-8');

const APP_DEBUG = false;
const APP_LOG_ENABLED = true;
const APP_LOG_FILE = __DIR__ . '/storage/logs/form-handler.log';

/**
 * Read environment variables from different PHP runtimes.
 */
function envValue(string $key, ?string $default = null): ?string
{
    $value = getenv($key);
    if ($value !== false) {
        return (string) $value;
    }

    if (isset($_ENV[$key])) {
        return (string) $_ENV[$key];
    }

    if (isset($_SERVER[$key])) {
        return (string) $_SERVER[$key];
    }

    return $default;
}

/**
 * Standard JSON response helper.
 */
function jsonResponse(bool $success, string $message, int $statusCode = 200): void
{
    http_response_code($statusCode);
    echo json_encode(
        ['success' => $success, 'message' => $message],
        JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
    );
    exit;
}

/**
 * Simple application logger.
 */
function appLog(string $level, string $message, array $context = []): void
{
    if (!APP_LOG_ENABLED) {
        return;
    }

    $dir = dirname(APP_LOG_FILE);
    if (!is_dir($dir)) {
        @mkdir($dir, 0775, true);
    }

    $line = sprintf(
        "[%s] %s: %s %s%s",
        date('Y-m-d H:i:s'),
        strtoupper($level),
        $message,
        $context ? json_encode($context, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) : '',
        PHP_EOL
    );

    @file_put_contents(APP_LOG_FILE, $line, FILE_APPEND);
}

/**
 * Escape user-provided output.
 */
function esc(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_HTML5, 'UTF-8');
}

/**
 * Build and configure PHPMailer instance.
 */
function makeMailer(): PHPMailer
{
    $config = [];
    $configPath = __DIR__ . '/mailer.php';
    if (is_file($configPath)) {
        $loaded = require $configPath;
        if (is_array($loaded)) {
            $config = $loaded;
        }
    }

    $smtpHost = (string) ($config['smtp_host'] ?? envValue('UXPACIFIC_SMTP_HOST', 'mail.uxpacific.com'));
    $smtpPort = (int) ($config['smtp_port'] ?? envValue('UXPACIFIC_SMTP_PORT', '465'));
    $smtpUser = (string) ($config['smtp_user'] ?? envValue('UXPACIFIC_SMTP_USER', 'support@uxpacific.com'));
    $smtpPassword = (string) ($config['smtp_pass'] ?? envValue('UXPACIFIC_SMTP_PASSWORD', ''));
    $smtpSecure = strtolower((string) ($config['smtp_secure'] ?? envValue('UXPACIFIC_SMTP_SECURE', 'ssl')));
    $fromEmail = (string) ($config['from_email'] ?? envValue('UXPACIFIC_FROM_EMAIL', 'support@uxpacific.com'));
    $fromName = (string) ($config['from_name'] ?? envValue('UXPACIFIC_FROM_NAME', 'UX Pacific'));

    if ($smtpPassword === '') {
        throw new RuntimeException('SMTP password is missing.');
    }

    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = $smtpHost;
    $mail->SMTPAuth = true;
    $mail->Username = $smtpUser;
    $mail->Password = $smtpPassword;
    $mail->SMTPSecure = $smtpSecure === 'tls'
        ? PHPMailer::ENCRYPTION_STARTTLS
        : PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = $smtpPort;
    $mail->CharSet = 'UTF-8';
    $mail->setFrom($fromEmail, $fromName);
    $mail->isHTML(true);

    if (APP_DEBUG) {
        $mail->SMTPDebug = 2;
    }

    return $mail;
}

/**
 * Fetch request payload from JSON or form-data.
 */
function requestData(): array
{
    $raw = file_get_contents('php://input') ?: '';
    $decoded = json_decode($raw, true);
    if (is_array($decoded)) {
        return $decoded;
    }
    return $_POST;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    jsonResponse(false, 'Method not allowed.', 405);
}

try {
    $payload = requestData();

    $formType = strtolower(trim((string) ($payload['form_type'] ?? '')));
    if (!in_array($formType, ['ux_audit', 'contact'], true)) {
        jsonResponse(false, 'Invalid form type.', 422);
    }

    // Required field checks per requirement.
    $name = trim((string) ($payload['name'] ?? ''));
    $email = trim((string) ($payload['email'] ?? ''));
    if ($name === '') {
        jsonResponse(false, 'Name is required.', 422);
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        jsonResponse(false, 'Valid email is required.', 422);
    }

    // Sanitize all expected fields.
    $nameSafe = esc($name);
    $emailSafe = esc($email);
    $phoneSafe = esc(trim((string) ($payload['phone'] ?? '')));
    $urlSafe = esc(trim((string) ($payload['url'] ?? '')));
    $industrySafe = esc(trim((string) ($payload['industry'] ?? '')));
    $messageSafe = esc(trim((string) ($payload['message'] ?? '')));
    $submittedAt = date('Y-m-d H:i:s');

    $fieldRows = '';
    if ($formType === 'ux_audit') {
        $fieldRows .= '<tr><td style="padding:12px;border-bottom:1px solid #eee;"><strong>Name</strong></td><td style="padding:12px;border-bottom:1px solid #eee;">' . $nameSafe . '</td></tr>';
        $fieldRows .= '<tr><td style="padding:12px;border-bottom:1px solid #eee;"><strong>Email</strong></td><td style="padding:12px;border-bottom:1px solid #eee;">' . $emailSafe . '</td></tr>';
        $fieldRows .= '<tr><td style="padding:12px;border-bottom:1px solid #eee;"><strong>Phone</strong></td><td style="padding:12px;border-bottom:1px solid #eee;">' . ($phoneSafe !== '' ? $phoneSafe : '-') . '</td></tr>';
        $fieldRows .= '<tr><td style="padding:12px;border-bottom:1px solid #eee;"><strong>Website URL</strong></td><td style="padding:12px;border-bottom:1px solid #eee;">' . ($urlSafe !== '' ? $urlSafe : '-') . '</td></tr>';
    } else {
        $fieldRows .= '<tr><td style="padding:12px;border-bottom:1px solid #eee;"><strong>Name</strong></td><td style="padding:12px;border-bottom:1px solid #eee;">' . $nameSafe . '</td></tr>';
        $fieldRows .= '<tr><td style="padding:12px;border-bottom:1px solid #eee;"><strong>Email</strong></td><td style="padding:12px;border-bottom:1px solid #eee;">' . $emailSafe . '</td></tr>';
        $fieldRows .= '<tr><td style="padding:12px;border-bottom:1px solid #eee;"><strong>Phone</strong></td><td style="padding:12px;border-bottom:1px solid #eee;">' . ($phoneSafe !== '' ? $phoneSafe : '-') . '</td></tr>';
        $fieldRows .= '<tr><td style="padding:12px;border-bottom:1px solid #eee;"><strong>Industry</strong></td><td style="padding:12px;border-bottom:1px solid #eee;">' . ($industrySafe !== '' ? $industrySafe : '-') . '</td></tr>';
        $fieldRows .= '<tr><td style="padding:12px;border-bottom:1px solid #eee;"><strong>Message</strong></td><td style="padding:12px;border-bottom:1px solid #eee;">' . nl2br($messageSafe) . '</td></tr>';
    }

    $adminSubject = $formType === 'ux_audit' ? 'New UX Audit Request' : 'New Contact Inquiry';
    $userSubject = $formType === 'ux_audit'
        ? 'Your UX Audit Request Received'
        : 'We Received Your Message';

    $adminBody = '
        <div style="font-family:Arial,sans-serif;background:#f7f7fb;padding:24px;">
            <div style="max-width:640px;margin:0 auto;background:#fff;border-radius:12px;overflow:hidden;border:1px solid #e8e8ef;">
                <div style="background:#6147bd;color:#fff;padding:20px 24px;">
                    <h2 style="margin:0;font-size:20px;">' . esc($adminSubject) . '</h2>
                    <p style="margin:8px 0 0 0;opacity:0.9;">Submission Date: ' . esc($submittedAt) . '</p>
                </div>
                <div style="padding:24px;">
                    <table style="width:100%;border-collapse:collapse;">' . $fieldRows . '</table>
                    <div style="margin-top:24px;text-align:center;">
                        <a href="mailto:' . $emailSafe . '" style="background:#6147bd;color:#fff;text-decoration:none;padding:12px 20px;border-radius:999px;display:inline-block;font-weight:600;">Reply to user</a>
                    </div>
                </div>
            </div>
        </div>
    ';

    $adminText = $adminSubject . PHP_EOL
        . 'Submission Date: ' . $submittedAt . PHP_EOL
        . 'Name: ' . $nameSafe . PHP_EOL
        . 'Email: ' . $emailSafe . PHP_EOL
        . 'Phone: ' . ($phoneSafe !== '' ? $phoneSafe : '-') . PHP_EOL
        . ($formType === 'ux_audit'
            ? 'Website URL: ' . ($urlSafe !== '' ? $urlSafe : '-') . PHP_EOL
            : 'Industry: ' . ($industrySafe !== '' ? $industrySafe : '-') . PHP_EOL
                . 'Message: ' . ($messageSafe !== '' ? strip_tags($messageSafe) : '-') . PHP_EOL
        );

    $userBody = '
        <div style="font-family:Arial,sans-serif;background:#f7f7fb;padding:24px;">
            <div style="max-width:640px;margin:0 auto;background:#fff;border-radius:12px;overflow:hidden;border:1px solid #e8e8ef;">
                <div style="background:#6147bd;color:#fff;padding:24px;">
                    <h2 style="margin:0;">UX Pacific</h2>
                </div>
                <div style="padding:24px;color:#222;">
                    <p style="margin-top:0;">Hi ' . $nameSafe . ',</p>
                    <p>Thank you for reaching out to UX Pacific. Your request has been received successfully.</p>
                    <p>Our team will review your details and get back to you within <strong>24–48 hours</strong>.</p>
                    <p style="margin-bottom:0;">
                        Visit us: <a href="https://www.uxpacific.com" style="color:#6147bd;">www.uxpacific.com</a>
                    </p>
                </div>
            </div>
        </div>
    ';

    $userText = 'Hi ' . $nameSafe . ',' . PHP_EOL . PHP_EOL
        . 'Thank you for reaching out to UX Pacific. Your request has been received successfully.' . PHP_EOL
        . 'Our team will get back to you within 24-48 hours.' . PHP_EOL
        . 'Website: https://www.uxpacific.com' . PHP_EOL;

    $adminMailer = makeMailer();
    $adminMailer->addAddress('hello@uxpacific.com');
    $adminMailer->addReplyTo($email, $name);
    $adminMailer->Subject = $adminSubject;
    $adminMailer->Body = $adminBody;
    $adminMailer->AltBody = $adminText;
    $adminMailer->send();

    $userMailer = makeMailer();
    $userMailer->addAddress($email, $name);
    $userMailer->Subject = $userSubject;
    $userMailer->Body = $userBody;
    $userMailer->AltBody = $userText;
    $userMailer->send();

    appLog('info', 'Form submitted successfully', [
        'form_type' => $formType,
        'email' => $emailSafe,
    ]);

    jsonResponse(true, 'Your form has been submitted successfully.');
} catch (Exception $e) {
    appLog('error', 'PHPMailer failure', ['message' => $e->getMessage()]);
    jsonResponse(false, APP_DEBUG ? 'Mailer error: ' . $e->getMessage() : 'Unable to send email right now.', 500);
} catch (Throwable $e) {
    appLog('error', 'Form handler failure', ['message' => $e->getMessage()]);
    jsonResponse(false, APP_DEBUG ? $e->getMessage() : 'Submission failed. Please try again.', 500);
}

