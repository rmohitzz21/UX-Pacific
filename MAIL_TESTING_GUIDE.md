# Mail Service Testing Guide

This document outlines the steps to verify that the custom mail service (`send_mail.php`) is functioning correctly after transitioning from Formspree.

## Prerequisites
Before testing, make sure you have the following ready:
1. **Local Server Setup:** Ensure your XAMPP server (Apache & PHP) is running.
2. **Mail Configuration (Localhost):** If testing on localhost, `mail()` function in PHP requires SMTP configuration in your `php.ini` and `sendmail.ini` files. (If testing on a live server, the web host usually has this pre-configured).

## Test Case 1: Frontend Form Validation
**Goal:** Ensure the client-side JavaScript still validates fields before attempting to send the email.
1. Open the Contact Page (`contact.php`) in your browser.
2. Click the **"Send Message"** button without filling out any fields.
3. **Expected Result:** Validation error messages should appear for required fields (Name, Email, Phone, Industry, Message, and Terms).
4. Fill in an invalid email address (e.g., `test@.com`) and click **"Send Message"**.
5. **Expected Result:** An email validation error should appear.

## Test Case 2: Successful Submission (Happy Path)
**Goal:** Verify that a valid form submission successfully calls `send_mail.php` and shows the success modal.
1. Fill out all form fields with valid test data:
   * **Name:** John Doe
   * **Email:** test@example.com
   * **Phone:** 1234567890
   * **Industry:** Technology
   * **Message:** This is a test message.
   * **Terms:** Checked
2. Open your browser's **Developer Tools (F12)** and go to the **Network** tab.
3. Click **"Send Message"**.
4. **Expected Result:** 
   * The button text should change to **"Sending..."** and become disabled.
   * A network request to `send_mail.php` should appear in the Network tab with a `200 OK` status.
   * The response payload should be JSON containing `{"success": true}` (or similar based on your PHP logic).
   * The success modal should appear on the screen.
   * The form fields and dropdown should reset to their default empty states.

## Test Case 3: Email Delivery Verification
**Goal:** Confirm that the email actually arrives in your inbox.
1. After completing Test Case 2, check the inbox of the email address configured as the recipient in `send_mail.php`.
2. Don't forget to check the **Spam/Junk** folder.
3. **Expected Result:** You should receive an email containing the submitted details formatted correctly.

## Test Case 4: Server Error Handling
**Goal:** Ensure the frontend handles failures gracefully if `send_mail.php` encounters an issue.
1. To simulate a server error, temporarily rename `send_mail.php` to `send_mail_temp.php`.
2. Fill out the form and submit.
3. **Expected Result:** 
   * The network request will fail (404 Not Found).
   * An alert should pop up saying: "Submission failed. Please try again later."
   * The submit button should re-enable and change back to **"Send Message"**.
4. *Remember to rename the file back to `send_mail.php` after this test.*

## Troubleshooting Common Issues

### 1. The network request to `send_mail.php` returns a 500 Internal Server Error
* Check your PHP error logs (usually in XAMPP at `xampp/apache/logs/error.log`).
* Verify there are no syntax errors in `send_mail.php`.

### 2. The form submits successfully (shows modal), but no email is received
* If on XAMPP localhost, PHP's `mail()` function might fail silently if SMTP is not configured properly in XAMPP.
* To fix localhost email sending, configure XAMPP to use an SMTP server (like Gmail):
  1. Open XAMPP Control Panel, click Config on Apache, and open `php.ini`. Locate `[mail function]`. Set `SMTP = smtp.gmail.com` and `smtp_port = 587`.
  2. Open XAMPP installation folder to edit `sendmail/sendmail.ini` and set `smtp_server=smtp.gmail.com`, `smtp_port=587`, `auth_username=your_email@gmail.com`, and `auth_password=your_app_password`.
* If on a live server, ensure your hosting provider hasn't blocked the `mail()` function to prevent spam. Consider using a library like **PHPMailer** for more robust SMTP sending instead of the native PHP `mail()` function.

### 3. Fetch API throws a CORS error
* This shouldn't happen if `send_mail.php` is hosted on the same domain as `contact.php`, but it can if you access the site via `http://localhost` but the script points to `http://127.0.0.1`. Make sure you load the page properly using exactly how it's configured in your environment.
