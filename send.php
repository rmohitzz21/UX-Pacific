<?php
declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/includes/database_config.php';
uxp_boot_database_config();
require_once __DIR__ . '/includes/cms_repository.php';

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

    $envStr = static function (string $key, string $default = ''): string {
        if (function_exists('uxp_env_raw')) {
            return uxp_env_raw($key, $default);
        }
        $v = getenv($key);
        if ($v !== false && $v !== '') {
            return (string) $v;
        }

        return $default;
    };

    $smtpHost = (string) ($config['smtp_host'] ?? $envStr('SMTP_HOST', envValue('UXPACIFIC_SMTP_HOST', 'mail.uxpacific.com')));
    $smtpPort = (int) ($config['smtp_port'] ?? $envStr('SMTP_PORT', envValue('UXPACIFIC_SMTP_PORT', '465')));
    $smtpUser = (string) ($config['smtp_user'] ?? $envStr('SMTP_USER', envValue('UXPACIFIC_SMTP_USER', 'support@uxpacific.com')));
    $smtpPassword = (string) ($config['smtp_pass'] ?? $envStr('SMTP_PASS', envValue('UXPACIFIC_SMTP_PASSWORD', '')));
    $smtpSecure = strtolower((string) ($config['smtp_secure'] ?? $envStr('SMTP_SECURE', envValue('UXPACIFIC_SMTP_SECURE', 'ssl'))));
    $fromEmail = (string) ($config['from_email'] ?? $envStr('SMTP_FROM_EMAIL', envValue('UXPACIFIC_FROM_EMAIL', 'support@uxpacific.com')));
    $fromName = (string) ($config['from_name'] ?? $envStr('SMTP_FROM_NAME', envValue('UXPACIFIC_FROM_NAME', 'UX Pacific')));

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

function uxp_send_client_ip(): string
{
    return substr((string) ($_SERVER['REMOTE_ADDR'] ?? ''), 0, 45);
}

/**
 * Max 5 submissions per IP per rolling hour (DB-backed). Fail open if table missing.
 */
function uxp_send_rate_check_and_record(): bool
{
    $pdo = uxp_db();
    if (!$pdo) {
        return true;
    }
    $ip = uxp_send_client_ip();
    if ($ip === '') {
        return true;
    }
    try {
        if (mt_rand(1, 120) === 1) {
            $pdo->exec('DELETE FROM form_submission_attempts WHERE attempted_at < DATE_SUB(NOW(), INTERVAL 2 HOUR)');
        }
        $st = $pdo->prepare(
            'SELECT COUNT(*) FROM form_submission_attempts WHERE ip_address = ? AND attempted_at > DATE_SUB(NOW(), INTERVAL 1 HOUR)'
        );
        $st->execute([$ip]);
        if ((int) $st->fetchColumn() >= 5) {
            return false;
        }
        $pdo->prepare('INSERT INTO form_submission_attempts (ip_address) VALUES (?)')->execute([$ip]);

        return true;
    } catch (Throwable $e) {
        appLog('warning', 'form_submission_attempts unavailable', []);

        return true;
    }
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

    $honeypot = trim((string) ($payload['company_website'] ?? ''));
    if ($honeypot !== '') {
        appLog('warning', 'Public form honeypot triggered');
        jsonResponse(false, 'Unable to submit the form right now.', 400);
    }

    $startedMs = (int) ($payload['form_started_at'] ?? 0);
    if ($startedMs > 0) {
        $elapsed = (int) round(microtime(true) * 1000) - $startedMs;
        if ($elapsed < 2000) {
            jsonResponse(false, 'Please take a moment to complete the form.', 422);
        }
    }

    if (!uxp_send_rate_check_and_record()) {
        appLog('warning', 'Public form rate limited', ['ip' => uxp_send_client_ip()]);
        jsonResponse(false, 'Too many submissions from this address. Please try again later.', 429);
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
    $phoneRaw = trim((string) ($payload['phone'] ?? ''));
    $industryRaw = trim((string) ($payload['industry'] ?? ''));
    $messageRaw = trim((string) ($payload['message'] ?? ''));
    
    $nameSafe = esc($name);
    $emailSafe = esc($email);
    $phoneSafe = esc($phoneRaw);
    $urlSafe = esc(trim((string) ($payload['url'] ?? '')));
    $industrySafe = esc($industryRaw);
    $messageSafe = esc($messageRaw);
    $submittedAt = date('Y-m-d H:i:s');

    // Save contact form submissions to database first
    $dbSaved = false;
    if ($formType === 'contact') {
        $savedId = save_contact_submission([
            'name' => $name,
            'email' => $email,
            'phone' => $phoneRaw,
            'service_interest' => $industryRaw,
            'message' => $messageRaw,
        ]);
        $dbSaved = ($savedId > 0);
        if (!$dbSaved) {
            appLog('error', 'Failed to save contact submission', ['email' => $emailSafe]);
        }
    }

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

    // Different confirmation message for UX Audit vs Contact
    $userBodyContent = $formType === 'ux_audit'
        ? '<p style="margin-top:0;">Hi ' . $nameSafe . ',</p>
           <p>Thank you for requesting a <strong>UX Audit</strong> from UX Pacific!</p>
           <p>We have received your request for: <strong>' . $urlSafe . '</strong></p>
           <p>Our UX experts will analyze your website and prepare a comprehensive audit report. Expect to hear from us within <strong>24–48 hours</strong>.</p>
           <p style="margin-bottom:0;">Visit us: <a href="https://www.uxpacific.com" style="color:#6147bd;">www.uxpacific.com</a></p>'
        : '<p style="margin-top:0;">Hi ' . $nameSafe . ',</p>
           <p>Thank you for contacting UX Pacific! Your message has been received successfully.</p>
           <p>Our team will review your inquiry and get back to you within <strong>24–48 hours</strong>.</p>
           <p style="margin-bottom:0;">Visit us: <a href="https://www.uxpacific.com" style="color:#6147bd;">www.uxpacific.com</a></p>';

    $userBody = '
        <div style="font-family:Arial,sans-serif;background:#f7f7fb;padding:24px;">
            <div style="max-width:640px;margin:0 auto;background:#fff;border-radius:12px;overflow:hidden;border:1px solid #e8e8ef;">
                <div style="background:#6147bd;color:#fff;padding:24px;">
                    <h2 style="margin:0;">UX Pacific</h2>
                    <p style="margin:8px 0 0;opacity:0.9;font-size:14px;">' . esc($userSubject) . '</p>
                </div>
                <div style="padding:24px;color:#222;">' . $userBodyContent . '</div>
                <div style="background:#f0f0f5;padding:16px 24px;text-align:center;font-size:13px;color:#666;">
                    <p style="margin:0;">Questions? Reply to this email or contact us at <a href="mailto:hello@uxpacific.com" style="color:#6147bd;">hello@uxpacific.com</a></p>
                </div>
            </div>
        </div>
    ';

    $userTextContent = $formType === 'ux_audit'
        ? 'Thank you for requesting a UX Audit from UX Pacific!' . PHP_EOL
            . 'We have received your request for: ' . ($urlSafe !== '' ? $urlSafe : 'your website') . PHP_EOL
            . 'Our UX experts will analyze your website and prepare a comprehensive audit report.'
        : 'Thank you for contacting UX Pacific! Your message has been received successfully.';

    $userText = 'Hi ' . $nameSafe . ',' . PHP_EOL . PHP_EOL
        . $userTextContent . PHP_EOL
        . 'Expect to hear from us within 24-48 hours.' . PHP_EOL . PHP_EOL
        . 'Website: https://www.uxpacific.com' . PHP_EOL
        . 'Email: hello@uxpacific.com' . PHP_EOL;

    // Load mail config for recipient
    $cfgPath = __DIR__ . '/mailer.php';
    $cfgTo = is_file($cfgPath) ? (require $cfgPath) : [];
    $adminToEmail = is_array($cfgTo) ? (string) ($cfgTo['to_email'] ?? 'hello@uxpacific.com') : 'hello@uxpacific.com';

    $adminSent = false;
    $userSent = false;

    // Send admin notification email
    try {
        $adminMailer = makeMailer();
        $adminMailer->addAddress($adminToEmail);
        $adminMailer->addReplyTo($email, $name);
        $adminMailer->Subject = $adminSubject;
        $adminMailer->Body = $adminBody;
        $adminMailer->AltBody = $adminText;
        $adminMailer->send();
        $adminSent = true;
    } catch (Throwable $e) {
        appLog('error', 'Admin notification email failed', [
            'message' => $e->getMessage(),
            'form_type' => $formType,
            'visitor_email' => $email,
        ]);
    }

    // Send user confirmation email
    try {
        $userMailer = makeMailer();
        $userMailer->addAddress($email, $name);
        $userMailer->Subject = $userSubject;
        $userMailer->Body = $userBody;
        $userMailer->AltBody = $userText;
        $userMailer->send();
        $userSent = true;
    } catch (Throwable $e) {
        appLog('error', 'User confirmation email failed', [
            'message' => $e->getMessage(),
            'form_type' => $formType,
            'visitor_email' => $email,
        ]);
    }

    // For contact forms: return success if DB saved (mail is best-effort)
    if ($formType === 'contact') {
        appLog('info', 'Contact form processed', [
            'form_type' => $formType,
            'email' => $emailSafe,
            'db_saved' => $dbSaved,
            'email_admin_sent' => $adminSent,
            'email_user_sent' => $userSent,
        ]);

        if ($dbSaved) {
            $msg = ($adminSent && $userSent)
                ? 'Your form has been submitted successfully.'
                : 'Thank you! We received your message. Our team will follow up shortly.';
            jsonResponse(true, $msg);
        } else {
            jsonResponse(false, 'Unable to save your request right now. Please try again.', 500);
        }
    }

    // For UX audit (no DB): require at least admin email to succeed
    if ($adminSent || $userSent) {
        appLog('info', 'UX audit form submitted', [
            'form_type' => $formType,
            'email' => $emailSafe,
            'email_admin_sent' => $adminSent,
            'email_user_sent' => $userSent,
        ]);
        jsonResponse(true, 'Your form has been submitted successfully.');
    }

    appLog('error', 'All emails failed (ux_audit)', ['email' => $emailSafe]);
    jsonResponse(false, 'Unable to send your request right now. Please try again or email us directly.', 500);

} catch (Throwable $e) {
    appLog('error', 'Form handler failure', ['message' => $e->getMessage()]);
    jsonResponse(false, APP_DEBUG ? $e->getMessage() : 'Submission failed. Please try again.', 500);
}

