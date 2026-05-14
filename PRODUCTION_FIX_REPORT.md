# Production Fix Report

**Project:** UX Pacific (PHP + MySQL + admin panel)  
**Date:** 2026-05-12  
**Scope:** Patch-based hardening aligned with `PROJECT_FULL_AUDIT_REPORT.md` — no broad rewrites.

---

## 1. Summary

### What was fixed

- **Admin CSRF:** Mutating admin APIs require `X-CSRF-Token` (or `csrf_token` in multipart POST body). Central helpers live in `admin/includes/auth.php`; all relevant `admin/api/*.php` endpoints call `adminRequireValidCsrfForMutation()` after authentication. Admin UI uses `window.uxpAdminFetch` from `admin/includes/layout.php` so JSON and `FormData` uploads send the header.
- **Logout:** `admin/api/auth.php` now uses **POST** for `?action=logout` with CSRF. **GET** logout returns **405** with JSON. Layout “Sign out” uses `uxpAdminFetch` POST then redirects to login.
- **Login rate limiting:** DB-backed limits — **5 failed attempts per email or per IP** in a **15-minute** window, generic error message, failures logged to `login_attempts`, cleanup of rows older than **30 days** (probabilistic). Successful login clears prior failures for that email and inserts a success row for audit.
- **Public forms (`send.php`):** Loads `.env` via `includes/database_config.php`; **honeypot** (`company_website`), **minimum client timing** (~2s from `form_started_at`), **IP rate limit** (5/hour via `form_submission_attempts` when table exists, fail-open if missing). **SMTP** can be driven from **`SMTP_*` in `.env`** (still overridden by optional `mailer.php`).
- **Contacts listing ORDER BY:** Strict whitelist (`submitted_at`, `created_at`, `id`) in `admin/api/contacts.php` and matching logic in `admin/api/dashboard.php`.
- **Project thumbnail cleanup:** On PUT when `thumbnail_url` changes, previous file under `/uploads` is removed via `uxp_unlink_upload_file_if_safe()` in `includes/paths.php` (path traversal blocked; external URLs skipped).
- **Upload API:** `admin/api/upload.php` now validates CSRF after auth.
- **Dashboard UI:** Async load with user-visible error + **Retry** using `uxpAdminFetch`.
- **Defense in depth:** Root `.htaccess` returns **403** for `admin/api/setup_db.php`, `seed_db.php`, `test_crud.php`, `test_upload.php` from non-loopback IPs (PHP `production_guard.php` remains primary).
- **`/uploads/.htaccess`:** SVG removed from “granted” extensions (upload handler already rejects SVG; this reduces execution surface).
- **Schema / patches:** `database/schema_admin.sql` extended with `form_submission_attempts` and indexes on `login_attempts`. `database/PRODUCTION_SQL_PATCHES.sql` documents optional `ALTER` for existing DBs.
- **Docs / env:** `.env.example` and `mailer.php.example` updated for SMTP and live DB user naming; `.gitignore` whitelists `PRODUCTION_SQL_PATCHES.sql`.

### What was not fixed (out of scope / follow-up)

- **Session idle timeout** (audit “medium”) — not implemented to avoid surprising admins mid-edit.
- **Automatic shared-file detection** when deleting media (logos/testimonials/ecosystem) — only project thumbnail replacement cleanup was added; orphan cleanup for other entities can be a later pass.
- **HTTPS / HSTS** — left commented in `.htaccess` per requirement so local XAMPP is not broken; enable manually after SSL verification.

### Readiness score estimate (post-fix)

| Area              | Prior (audit) | Estimate now |
|-------------------|---------------|--------------|
| Overall           | 7.8           | **9.0+**     |
| Security          | 7.5           | **9.2+**     |
| API               | 7.5           | **9.0+**     |
| Admin panel       | 7.2           | **9.0+**     |
| Deployment        | 6.8           | **8.8+**     |

---

## 2. Files Changed

| File | Change | Reason | Risk |
|------|--------|--------|------|
| `admin/includes/auth.php` | CSRF helpers; login rate limit + attempt logging | C-001, C-004 | Low |
| `admin/api/auth.php` | POST logout + CSRF; JSON status; GET logout 405 | C-001, logout hardening | Low |
| `admin/includes/layout.php` | `__UXP_ADMIN_CSRF__`, `uxpAdminFetch`, POST sign-out | C-001 | Low |
| `admin/api/upload.php` | CSRF on POST upload | C-001 | Low |
| `admin/api/dashboard.php` | CSRF hook (GET no-op); ORDER BY whitelist | C-001, C-005 | Low |
| `admin/api/contacts.php` | ORDER BY whitelist (already had CSRF) | C-005 | Low |
| `admin/api/projects.php` | Thumbnail unlink on change (already had CSRF) | Upload cleanup | Low |
| `admin/pages/*.php`, `admin/dashboard.php` | `fetch` → `uxpAdminFetch` | C-001 | Low |
| `send.php` | `.env` boot; SMTP env; honeypot; timing; rate table | C-003 adjacent, spam, mail | Low |
| `contact.php`, `index.php`, `main.js` | Honeypot + `form_started_at` | Spam | Low |
| `includes/paths.php` | `uxp_unlink_upload_file_if_safe` | Safe file delete | Low |
| `.htaccess` | Block setup/test scripts from non-localhost | C-002 | Low — confirm if you legitimately hit admin from LAN IP |
| `uploads/.htaccess` | Drop SVG from allowed extension list | Upload hardening | Low |
| `database/schema_admin.sql` | Indexes on `login_attempts`; `form_submission_attempts` | C-004, rate limit | Low (new installs) |
| `database/PRODUCTION_SQL_PATCHES.sql` | **New** optional SQL | Existing DBs | Low |
| `.env.example`, `mailer.php.example` | SMTP + naming | Deployment | None |
| `.gitignore` | Track patch SQL | Repo hygiene | None |
| `PRODUCTION_FIX_REPORT.md` | This report | Deliverable | None |

---

## 3. Critical Fixes Completed

| Item | Status |
|------|--------|
| CSRF on mutating admin APIs | Done (`adminRequireValidCsrfForMutation`, `uxpAdminFetch`) |
| Dangerous setup/test URLs | PHP guard + `.htaccess` layer |
| Login rate limiting | Done (`login_attempts`) |
| Form / contact pipeline | `send.php` → `contacts` via `save_contact_submission`; spam/rate layers added |
| Contacts ORDER BY | Whitelist only |
| Logout method | POST + CSRF |
| Upload security | CSRF on upload API; stricter `/uploads` types; safe unlink helper |

---

## 4. Security Improvements

- CSRF for all authenticated **POST / PUT / PATCH / DELETE** admin API traffic (header-based; no `php://input` consumption in CSRF helper).
- GET logout disabled (405).
- Brute-force throttling on admin login (DB-backed, generic messaging).
- Public form honeypot, timing heuristic, IP rate limiting (DB when available).
- SMTP secrets support via `.env` (`SMTP_*`) reducing reliance on a single `mailer.php`.
- Extra `.htaccess` blocking of setup/test scripts from non-loopback IPs.
- Reduced attack surface in `/uploads` (no SVG in Apache “granted” list).

---

## 5. Database Changes

**New / updated in `database/schema_admin.sql` (fresh installs):**

- `login_attempts`: non-unique indexes `idx_uxp_login_email`, `idx_uxp_login_ip`.
- `form_submission_attempts`: `id`, `ip_address`, `attempted_at`, index `idx_uxp_form_rate`.

**Existing databases:** run statements in `database/PRODUCTION_SQL_PATCHES.sql` manually in phpMyAdmin. Uncomment optional `ALTER TABLE login_attempts ADD INDEX …` only if indexes are missing (ignore duplicate-index errors).

**Password note:** Live DB password must remain **only** in `.env` (rotated if ever exposed). Example files use `********` / placeholders only.

---

## 6. Environment Changes Required

Example `.env` (secrets masked):

```env
DB_HOST=localhost
DB_PORT=3306
DB_NAME=survevap_ux_admin
DB_USER=survevap_ux_admin
DB_PASS="********"
DB_CHARSET=utf8mb4
DB_HOST_LOCAL=162.241.116.85
APP_ENV=production
APP_DEBUG=false
UXP_FORCE_PRODUCTION=1

SMTP_HOST=smtp.yourhost.com
SMTP_PORT=465
SMTP_USER=your_smtp_login
SMTP_PASS="********"
SMTP_SECURE=ssl
SMTP_FROM_EMAIL=noreply@yourdomain.com
SMTP_FROM_NAME=UX Pacific
```

---

## 7. Manual cPanel Actions Required

1. **Rotate MySQL password** if it was ever exposed; update **`DB_PASS`** in live `.env` only (quoted if it contains `#`).
2. Confirm **`DB_USER`** matches the cPanel MySQL username exactly (often prefixed).
3. Confirm **`pdo_mysql`** enabled; database user has **SELECT/INSERT/UPDATE/DELETE** on the site schema.
4. Import or apply **`database/PRODUCTION_SQL_PATCHES.sql`** as needed (`form_submission_attempts`, optional indexes).
5. **`uploads/`** permissions: writable by PHP, not world-writable if avoidable.
6. Enable **SSL** in cPanel; verify site loads on `https://`.
7. After verification, **uncomment** HTTPS redirect + HSTS in root `.htaccess` (see comments there).
8. **`admin/api/db-health.php`:** delete **or** leave with **`APP_DEBUG=false`** and rely on admin-only access — for a hard public lock, delete the file before final go-live.
9. Ensure **`APP_DEBUG=false`** on production.

---

## 8. Testing Checklist

**Local (XAMPP)**

- [ ] Homepage, services, work, contact form submit
- [ ] Admin login (valid + invalid password), rate limit after repeated failures
- [ ] Admin dashboard load + Retry on simulated error
- [ ] CRUD on projects/services/FAQs/reviews/logos/ecosystem/contacts
- [ ] Image upload (multipart) still works
- [ ] Logout (POST) returns to login
- [ ] `setup_db.php` etc. still reachable from **127.0.0.1** if needed for dev

**Live**

- [ ] DB connection and admin login
- [ ] CRUD + uploads with CSRF header (browser flow)
- [ ] Contact + audit forms with rate limit / honeypot (no false positives)
- [ ] HTTPS + no PHP notices in output
- [ ] Remove or lock down `db-health.php` after validation

---

## 9. Remaining Risks

| Level | Risk |
|-------|------|
| **Low** | Shared NAT: IP-based form rate limit may affect multiple humans behind one IP (5/hour). |
| **Low** | `.htaccess` IP rules: legitimate remote dev hitting `/admin/api/setup_db.php` from non-local IP gets 403 — use VPN or temporary server-side exception. |
| **Medium** | Until HTTPS+HSTS enabled, transport encryption depends on user typing `https://`. |
| **Low** | SMTP misconfiguration: mail fails but contact row still saves when DB works (by design). |

---

## 10. Final Deployment Steps

1. Back up files and database.
2. Deploy code; ensure **`.env`** is on the server (not in git) with correct **`DB_*`** and optional **`SMTP_*`**.
3. Run **`database/PRODUCTION_SQL_PATCHES.sql`** if the live DB predates this schema.
4. Smoke-test admin CRUD, uploads, logout, contact form.
5. Turn on **HTTPS** redirect + **HSTS** in `.htaccess` after SSL checks pass.
6. Set **`APP_DEBUG=false`**; remove **`admin/api/db-health.php`** when no longer needed.
7. Monitor `storage/logs/form-handler.log` and PHP `error_log` for anomalies.

---

**Regarding `db-health.php`:** Keep it only while diagnosing connection issues with **`APP_DEBUG=true`** *or* while logged in as admin; **delete it before public launch** if you want zero diagnostic surface.
