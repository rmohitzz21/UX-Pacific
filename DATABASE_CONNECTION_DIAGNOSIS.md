   # Database Connection Diagnosis

   This document explains how this PHP app chooses MySQL credentials, how to verify the **same** database DBeaver uses vs what PHP uses, and how to interpret **`1045 access_denied`**. It is based on repository code inspection; fill the comparison tables using outputs from **`/admin/api/db-health.php`** (browser) and **`php tools/db_check.php`** (SSH/CLI).

   **Never commit or paste real `DB_PASS` values.** If a password was ever exposed, rotate it in cPanel and update only the server `.env`.

   ---

   ## 1. Summary

   | Question | How to verify |
   |----------|----------------|
   | Is `.env` loading? | JSON field `dotenv_found` / `dotenv_readable` / `dotenv_loaded_path` from `db-health.php`, or first line of `php tools/db_check.php` |
   | Is PDO available? | `pdo_extension` |
   | Is `pdo_mysql` available? | `pdo_mysql_extension` |
   | Is the database connected? | `db_connection` === `"ok"` |
   | Exact failure category | `failure` + `db_error_code` when `db_connection` === `"failed"` |
   | Same DB as DBeaver? | Compare DBeaver `SELECT DATABASE()` / `SELECT CURRENT_USER()` with `current_database` and `current_user` from `db-health.php` after connection succeeds |

   **Typical cause of `1045` on live cPanel:** `DB_USER` or `DB_PASS` on the server `.env` does not match the MySQL user as defined in cPanel (including **full prefixed username**), or the password was truncated/misparsed (use **double quotes** around values that contain `#`).

   ---

   ## 2. Effective Website DB Config (code rules)

   | Setting | Source | Notes |
   |---------|--------|--------|
   | `DB_HOST` | `.env` | On live, usually **`localhost`**. |
   | `DB_PORT` | `.env` | Default `3306`. |
   | `DB_NAME` | `.env` | Must match the database MySQL user is assigned to. |
   | `DB_USER` | `.env` | Must match **cPanel → MySQL Users** name exactly (often `account_dbuser`). |
   | `DB_PASS` | `.env` | Never logged or returned by diagnostics; only **`db_pass_present`** / **`db_pass_contains_hash`**. |
   | `DB_CHARSET` | `.env` | Default `utf8mb4`. |
   | `DB_HOST_LOCAL` / `DB_*_LOCAL` | `.env` | Applied **only** when `uxp_is_local_dev_request()` is true (localhost / `UXP_LOCAL_HOSTS` / `UXP_FORCE_LOCAL=1`), unless `UXP_FORCE_PRODUCTION=1`. |
   | `UXP_FORCE_PRODUCTION` | `.env` | If `1`, **never** treats the request as local → **never** uses `DB_HOST_LOCAL`. Recommended on live if host detection is ambiguous. |

   Implementation: `includes/database_config.php` (`uxp_db_credentials()`, `uxp_is_local_dev_request()`).

   ---

   ## 3. Connection Test Result (JSON fields)

   When you open **`/admin/api/db-health.php`** (with **`APP_DEBUG=true`** or while logged into admin):

   | Field | Meaning |
   |-------|---------|
   | `db_connection` | `"ok"` \| `"failed"` \| `"not_attempted"` |
   | `db_error_code` | MySQL driver error code (e.g. `1045`, `1049`, `2002`) or `null` |
   | `failure` | `access_denied` \| `unknown_database` \| `connection_refused_or_timeout` \| `missing_config` \| `pdo_missing` \| `table_missing` \| `unknown` |
   | `current_database` | Result of `SELECT DATABASE()` when connected |
   | `current_user` | Masked result of `SELECT CURRENT_USER()` |
   | `visibility_counts` | Read-only counts for **published / visible** rows (explains empty UI when connection works) |

   **Raw PDO / stack traces** are intentionally **not** included in the JSON response.

   ---

   ## 4. DBeaver vs Website Comparison

   After `db_connection` is **`ok`**, compare:

   | Check | DBeaver | Website (`db-health`) | Match? |
   |-------|---------|-------------------------|--------|
   | Database | `SELECT DATABASE();` | `current_database` | Should match `DB_NAME` |
   | MySQL account | `SELECT CURRENT_USER();` | `current_user` (masked) | User part should match `DB_USER` pattern |
   | Row counts (e.g. projects) | `SELECT COUNT(*) FROM projects;` | `row_counts.projects` | Should match |
   | Published projects | `SELECT COUNT(*) FROM projects WHERE status='published';` | `visibility_counts.projects_published` | — |

   If counts match but the site still looks empty, see **Section 6** (filters, connection still failing in a different environment, etc.).

   ---

   ## 5. Table and Row Count Check (read-only)

   `db-health.php` inspects **only whitelisted** tables (no user-controlled table names). For each:

   - **`exists`**: table readable
   - **`row_count`**: `SELECT COUNT(*)`
   - **`optional`**: missing table is OK for some features
   - **`important_columns`**: `expected` vs `present` / `missing` (from `SHOW COLUMNS`)

   **Core tables (required for full CMS + admin):**

   `admin_users`, `projects`, `services`, `contacts`, `login_attempts`

   **CMS public content:**

   `testimonials`, `client_logos`, `faqs`, `ecosystem`

   **Optional / auxiliary:**

   `form_submission_attempts`, `form_submissions`, `page_seo`, `seo_meta`, `site_settings`, `home_settings`, `team_members`, `geo_landing_pages`

   ---

   ## 6. Why Data Is Not Showing

   ### A. Connection still failing (`1045`)

   PHP never reaches your data. DBeaver can still show data because it uses **host `162.241.116.85`** and possibly **a different MySQL user/password** than the website `.env`.

   On the live web server, PHP almost always must use:

   ```env
   DB_HOST=localhost
   ```

   with the **cPanel MySQL user + password** for that same database.

   ### B. Wrong database or user (after fix)

   `current_database` from `db-health` ≠ database you imported in DBeaver → wrong `DB_NAME` in server `.env`.

   ### C. Connection OK but “empty” UI — **status / visibility filters**

   Public reads use `includes/cms_repository.php`:

   | Page / API | PHP entry | Table | Filter / notes |
   |------------|-----------|-------|----------------|
   | Home featured work | `index.php` | `projects` | `get_published_projects('all', true)` → **`status = 'published'` AND `is_featured = 1`**. If all rows are draft or none featured, featured section is empty. |
   | Work / portfolio | `work.php` | `projects` | `get_published_projects('all')` → **`status = 'published'`** only. |
   | Services | `service.php` | `services` | **`status = 'published'`** only. |
   | FAQ | `faq.php` | `faqs` | **`is_visible = 1`**. |
   | Ecosystem | `ecosystem.php`, home | `ecosystem` | **`is_visible = 1`**. |
   | Testimonials (page) | (via CMS helpers) | `testimonials` | **`is_visible = 1`**. |
   | Public JSON reviews | `api/testimonials.php` | `testimonials` | Same visibility rules via `get_visible_testimonials_for_api()`. |
   | Public JSON logos | `api/client-logos.php` | `client_logos` | **`is_visible = 1`**. |
   | SEO overlay | `includes/head.php` (if used) | `page_seo` | `uxp_page_seo_overlay()` uses table **`page_seo`** + `route_key`. |
   | Per-page SEO helper | various | `seo_meta` | `get_page_seo()` uses **`seo_meta`** + `page_key`. **Different table** from `page_seo`. |

   If DBeaver shows rows but `status` is **`draft`** or `is_visible` is **`0`**, the site will hide them by design.

   ### D. Schema mismatch

   If an import created different table names (e.g. `service` vs `services`), code queries will fail or return empty. Use `SHOW TABLES;` in DBeaver and compare to the whitelist in `db-health.php`.

   ### E. `uxp_db()` silently returns null

   `includes/database.php` — `uxp_db()` catches connection errors and returns **`null`**; many CMS functions then return **empty arrays** without a visible error on public pages. Fixing **`1045`** on the **same** `.env` the web uses resolves this.

   ---

   ## 7. Exact Fix Steps (1045 on live)

   1. **cPanel → MySQL® Databases**  
      Confirm database name exactly (e.g. `survevap_ux_admin`).

   2. **MySQL Users**  
      Copy the **full** username (often `cpanelprefix_ux_admin`).

   3. **Add User To Database**  
      Assign that user to the database with **ALL PRIVILEGES** (at least `SELECT`, `INSERT`, `UPDATE`, `DELETE` for runtime; `CREATE`/`ALTER` only if applying schema).

   4. **Set / reset password** in cPanel if unsure.

   5. **Edit live `.env`** (next to live `index.php`, or path from `UXP_ENV_FILE`):

      ```env
      DB_HOST=localhost
      DB_PORT=3306
      DB_NAME=survevap_ux_admin
      DB_USER=exact_cpanel_mysql_username
      DB_PASS="your_password_use_quotes_if_special_chars_like_hash"
      DB_CHARSET=utf8mb4
      APP_DEBUG=true
      UXP_FORCE_PRODUCTION=1
      ```

   6. Reload **`/admin/api/db-health.php`** until:

      ```json
      "db_connection": "ok"
      ```

   7. Set **`APP_DEBUG=false`** and remove or protect **`db-health.php`** after go-live.

   ---

   ## 8. Tools shipped with this repo

   | Tool | Purpose |
   |------|---------|
   | `admin/api/db-health.php` | JSON read-only diagnostic (browser; needs debug or admin). |
   | `tools/db_check.php` | CLI read-only summary; **`PHP_SAPI !== 'cli'`** exits. |
   | `tools/.htaccess` | Denies HTTP access if `tools/` is under the document root. |

   ---

   ## 9. DBeaver verification SQL (read-only)

   Run in the same connection you use for the live data:

   ```sql
   SELECT DATABASE();
   SELECT CURRENT_USER();
   SHOW TABLES;

   SELECT COUNT(*) AS projects_count FROM projects;
   SELECT COUNT(*) AS services_count FROM services;
   SELECT COUNT(*) AS admin_users_count FROM admin_users;
   SELECT COUNT(*) AS contacts_count FROM contacts;
   SELECT COUNT(*) AS testimonials_count FROM testimonials;
   SELECT COUNT(*) AS client_logos_count FROM client_logos;
   SELECT COUNT(*) AS faqs_count FROM faqs;
   ```

   If `ecosystem` exists:

   ```sql
   SELECT COUNT(*) AS ecosystem_count FROM ecosystem;
   ```

   **Visibility sanity checks** (match PHP filters):

   ```sql
   SELECT id, title, status, is_featured, sort_order
   FROM projects
   ORDER BY id DESC
   LIMIT 20;

   SELECT id, title, status, sort_order
   FROM services
   ORDER BY id DESC
   LIMIT 20;

   SELECT id, email, role, is_active
   FROM admin_users;
   ```

   If `page_seo` / `seo_meta` exist:

   ```sql
   SELECT COUNT(*) FROM page_seo;
   SELECT COUNT(*) FROM seo_meta;
   ```

   ---

   ## 10. Step 1 file inspection (static report)

   | File | Role |
   |------|------|
   | `.env` | **Not in git**; must exist on server next to `index.php` (or `UXP_ENV_FILE`). |
   | `.env.example` | Template; no real secrets. |
   | `includes/database_config.php` | Loads `.env`, resolves local vs live DB host. |
   | `includes/database.php` | `uxp_db()` — shared PDO; fails quietly to `null` on error. |
   | `admin/api/db-health.php` | Read-only diagnostic JSON. |
   | `admin/api/db.php` | Admin API PDO bootstrap. |
   | `admin/includes/auth.php` | Admin login PDO; maps `1045` to user-facing hint (no password). |
   | `includes/cms_repository.php` | All main **SELECT** sources for public pages + `save_contact_submission` **INSERT** into `contacts`. |
   | `send.php` | Uses `save_contact_submission` + rate limit table `form_submission_attempts`. |
   | `database/schema_admin.sql` | Reference schema for new installs. |
   | `database/PRODUCTION_SQL_PATCHES.sql` | Optional patches for existing DBs. |

   ---

   *End of diagnosis guide. Use `db-health.php` output to fill Sections 3–5 numerically on your server.*

---

## 11. Code note: no hardcoded DB credentials

`uxp_db_credentials()` in `includes/database_config.php` reads **only** from `.env` (plus `DB_*_LOCAL` when in local dev mode). **`DB_NAME` and `DB_USER` must be set**; there are no PHP fallbacks for database name, username, or password. If either name or user is missing after load, the app reports missing configuration instead of guessing wrong values (which would cause `1045` on the server).

