<?php
require_once __DIR__ . '/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed.']);
    exit;
}

$raw  = file_get_contents('php://input');
$data = json_decode($raw, true) ?: $_POST;

$name  = trim($data['name']  ?? '');
$email = trim($data['email'] ?? '');
$phone = trim($data['phone'] ?? '');
$url   = trim($data['url']   ?? '');

$errors = [];
if (strlen($name) < 2)                         $errors[] = 'Name is required.';
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Valid email is required.';

if ($errors) {
    http_response_code(422);
    echo json_encode(['success' => false, 'message' => implode(' ', $errors)]);
    exit;
}

$cfg = require __DIR__ . '/mailer.php';

$safeDate = date('d M Y, h:i A');
$h = fn(string $v): string => htmlspecialchars($v, ENT_QUOTES | ENT_HTML5, 'UTF-8');

$nameEsc  = $h($name);
$emailEsc = $h($email);
$phoneEsc = $h($phone ?: '—');
$urlEsc   = $h($url   ?: '—');

$htmlBody = <<<HTML
<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><title>UX Audit Request  UX Pacific</title></head>
<body style="margin:0;padding:0;background:#0d0d1a;font-family:'Segoe UI',Arial,sans-serif;">
  <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#0d0d1a;padding:40px 16px;">
    <tr><td align="center">
      <table width="600" cellpadding="0" cellspacing="0" border="0"
             style="max-width:600px;width:100%;border-radius:20px;overflow:hidden;border:1px solid rgba(97,71,189,0.25);">
        <tr>
          <td style="background:linear-gradient(135deg,#1e1040 0%,#6147bd 100%);padding:40px 40px 32px;text-align:center;">
            <p style="margin:0 0 12px;font-size:13px;letter-spacing:0.12em;text-transform:uppercase;color:rgba(167,139,250,0.9);font-weight:600;">UX Pacific</p>
            <h1 style="margin:0;font-size:26px;font-weight:700;color:#ffffff;line-height:1.25;">New UX Audit Request</h1>
            <p style="margin:10px 0 0;font-size:13px;color:rgba(255,255,255,0.55);">{$safeDate}</p>
          </td>
        </tr>
        <tr>
          <td style="background:#111127;padding:36px 40px;">
            <p style="margin:0 0 24px;font-size:15px;color:rgba(148,163,184,0.9);line-height:1.6;">
              A new <strong style="color:#a78bfa;">UX Audit</strong> request has been submitted via <a href="https://www.uxpacific.com" style="color:#a78bfa;text-decoration:none;">uxpacific.com</a>.
            </p>
            <table width="100%" cellpadding="0" cellspacing="0" border="0"
                   style="border-radius:12px;overflow:hidden;border:1px solid rgba(255,255,255,0.07);">
              <tr style="background:rgba(97,71,189,0.12);">
                <td style="padding:14px 20px;font-size:11px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:rgba(167,139,250,0.7);width:30%;">Name</td>
                <td style="padding:14px 20px;font-size:15px;color:#e8e8f4;font-weight:600;">{$nameEsc}</td>
              </tr>
              <tr style="background:#13132b;">
                <td style="padding:14px 20px;font-size:11px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:rgba(167,139,250,0.7);">Email</td>
                <td style="padding:14px 20px;font-size:15px;"><a href="mailto:{$emailEsc}" style="color:#a78bfa;text-decoration:none;">{$emailEsc}</a></td>
              </tr>
              <tr style="background:rgba(97,71,189,0.12);">
                <td style="padding:14px 20px;font-size:11px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:rgba(167,139,250,0.7);">Phone</td>
                <td style="padding:14px 20px;font-size:15px;color:#e8e8f4;">{$phoneEsc}</td>
              </tr>
              <tr style="background:#13132b;">
                <td style="padding:14px 20px;font-size:11px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:rgba(167,139,250,0.7);">Website URL</td>
                <td style="padding:14px 20px;font-size:15px;color:#e8e8f4;">{$urlEsc}</td>
              </tr>
            </table>
            <div style="margin-top:28px;text-align:center;">
              <a href="mailto:{$emailEsc}" style="display:inline-block;padding:14px 32px;border-radius:999px;background:linear-gradient(90deg,#6147bd,#a78bfa);color:#fff;font-weight:600;font-size:15px;text-decoration:none;">
                Reply to {$nameEsc}
              </a>
            </div>
          </td>
        </tr>
        <tr>
          <td style="background:#0d0d1a;padding:24px 40px;text-align:center;border-top:1px solid rgba(255,255,255,0.05);">
            <p style="margin:0;font-size:12px;color:rgba(148,163,184,0.45);line-height:1.8;">
              Auto-generated from the UX Audit form on <a href="https://www.uxpacific.com" style="color:rgba(167,139,250,0.6);text-decoration:none;">uxpacific.com</a>.<br>
              &copy; {$safeDate} UX Pacific. All rights reserved.
            </p>
          </td>
        </tr>
      </table>
    </td></tr>
  </table>
</body>
</html>
HTML;

$plainBody = "New UX Audit Request – UX Pacific\n"
           . "Date: {$safeDate}\n\n"
           . "Name: {$name}\n"
           . "Email: {$email}\n"
           . "Phone: " . ($phone ?: '—') . "\n"
           . "Website URL: " . ($url ?: '—') . "\n";

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = $cfg['smtp_host'];
    $mail->SMTPAuth   = true;
    $mail->Username   = $cfg['smtp_user'];
    $mail->Password   = $cfg['smtp_pass'];
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = $cfg['smtp_port'];

    $mail->setFrom($cfg['from_email'], $cfg['from_name']);
    $mail->addAddress($cfg['to_email'], $cfg['to_name']);
    $mail->addReplyTo($email, $name);

    $mail->isHTML(true);
    $mail->Subject = "UX Audit Request from {$name} UX Pacific";
    $mail->Body    = $htmlBody;
    $mail->AltBody = $plainBody;

    $mail->send();

    echo json_encode(['success' => true, 'message' => 'Your request has been submitted successfully.']);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Mailer error: ' . $mail->ErrorInfo]);
}
