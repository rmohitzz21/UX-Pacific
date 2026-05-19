-- UX Pacific — optional idempotent-ish patches for EXISTING databases.
-- Review before running in phpMyAdmin / mysql CLI. Do not run destructive statements on production without a backup.

-- Rate limiting for public contact / audit forms (send.php)
CREATE TABLE IF NOT EXISTS form_submission_attempts (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  ip_address VARCHAR(45) NOT NULL,
  attempted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  KEY idx_uxp_form_rate (ip_address, attempted_at)
);

-- Tables referenced by production code. These are non-destructive for existing databases.
CREATE TABLE IF NOT EXISTS ecosystem (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  partner_name VARCHAR(150) NOT NULL,
  details TEXT NULL,
  website_url VARCHAR(500) NULL,
  logo_url VARCHAR(500) NULL,
  is_visible TINYINT(1) NOT NULL DEFAULT 1,
  sort_order INT UNSIGNED NOT NULL DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS form_submissions (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  form_type VARCHAR(80) NOT NULL DEFAULT 'contact',
  name VARCHAR(150) NOT NULL,
  email VARCHAR(255) NOT NULL,
  phone VARCHAR(50) NULL,
  website_url VARCHAR(500) NULL,
  industry VARCHAR(150) NULL,
  message TEXT NOT NULL,
  status VARCHAR(40) NOT NULL DEFAULT 'new',
  source_url VARCHAR(500) NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS page_seo (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  route_key VARCHAR(150) NOT NULL UNIQUE,
  page_title VARCHAR(255) NULL,
  meta_description VARCHAR(500) NULL,
  canonical_url VARCHAR(500) NULL,
  og_title VARCHAR(255) NULL,
  og_description VARCHAR(500) NULL,
  og_image VARCHAR(500) NULL,
  robots VARCHAR(120) NULL,
  structured_data_json LONGTEXT NULL,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS site_settings (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  setting_key VARCHAR(150) NOT NULL UNIQUE,
  setting_value LONGTEXT NULL,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS geo_landing_pages (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  country_slug VARCHAR(150) NOT NULL UNIQUE,
  country_name VARCHAR(150) NOT NULL,
  page_title VARCHAR(255) NULL,
  meta_description VARCHAR(500) NULL,
  hero_title VARCHAR(255) NULL,
  hero_subtitle TEXT NULL,
  body_content LONGTEXT NULL,
  is_published TINYINT(1) NOT NULL DEFAULT 0,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Login rate limiting indexes (ignore duplicate key name errors if indexes already exist)
-- ALTER TABLE login_attempts ADD INDEX idx_uxp_login_email (email, success, attempted_at);
-- ALTER TABLE login_attempts ADD INDEX idx_uxp_login_ip (ip_address, success, attempted_at);
