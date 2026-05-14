-- UX Pacific — optional idempotent-ish patches for EXISTING databases.
-- Review before running in phpMyAdmin / mysql CLI. Do not run destructive statements on production without a backup.

-- Rate limiting for public contact / audit forms (send.php)
CREATE TABLE IF NOT EXISTS form_submission_attempts (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  ip_address VARCHAR(45) NOT NULL,
  attempted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  KEY idx_uxp_form_rate (ip_address, attempted_at)
);

-- Login rate limiting indexes (ignore duplicate key name errors if indexes already exist)
-- ALTER TABLE login_attempts ADD INDEX idx_uxp_login_email (email, success, attempted_at);
-- ALTER TABLE login_attempts ADD INDEX idx_uxp_login_ip (ip_address, success, attempted_at);
