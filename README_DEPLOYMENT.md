# UX Pacific Deployment Checklist

## What PHP Connects To

DBeaver is only a MySQL client. The website does not fetch data from DBeaver. The website fetches data from the MySQL database named in the live `.env` file.

Local PHP, DBeaver, and live PHP can all point to different MySQL servers. On Hostinger/cPanel-style hosting, PHP normally uses `DB_HOST=localhost` because PHP and MySQL run on the same hosting account/server. DBeaver may use a remote IP or hostname from your computer; do not copy that host into live `.env` unless the host explicitly tells you PHP must use a remote MySQL host.

## Live `.env`

Create this file at:

```text
/home/u986293637/domains/uxpacific.com/public_html/.env
```

Use fake example values like this shape:

```dotenv
DB_HOST=localhost
DB_PORT=3306
DB_NAME=cpanelprefix_database_name
DB_USER=cpanelprefix_mysql_user
DB_PASS="rotated#password#from#hosting"
DB_CHARSET=utf8mb4

APP_ENV=production
APP_DEBUG=false
UXP_FORCE_PRODUCTION=1
```

Important: if the password contains `#`, spaces, or special characters, keep it in double quotes. The diagnostic endpoint reports password presence, length, and hash/quote status, but never prints the password.

## cPanel Values To Verify

1. MySQL database name matches `DB_NAME` exactly, including the account prefix.
2. MySQL username matches `DB_USER` exactly, including the account prefix.
3. MySQL user is assigned to the database.
4. User has the needed privileges: `SELECT`, `INSERT`, `UPDATE`, `DELETE`, and table/schema privileges for imports or migrations.
5. Password was rotated after any exposure, then copied into `.env` as `DB_PASS="..."`.
6. For live PHP, keep `DB_HOST=localhost` unless hosting support gives a specific database hostname.

## Required Tables

Admin login requires:

```text
admin_users
login_attempts
```

Admin/content functionality expects:

```text
projects
services
contacts
testimonials
client_logos
faqs
ecosystem
home_settings
team_members
seo_meta
form_submission_attempts
```

At least one active admin row must exist in `admin_users` with `is_active = 1` and a `password_hash` created by PHP `password_hash()`.

## Safe Diagnostics

Temporarily set:

```dotenv
APP_DEBUG=true
```

Then open:

```text
/admin/api/db-health.php
```

The output should show:

```text
db_connection: ok
current_database: same as DB_NAME
current_user: masked MySQL user
tables.admin_users.exists: true
visibility_counts.admin_users_active: at least 1
```

After fixing, set:

```dotenv
APP_DEBUG=false
```

For maximum hardening, delete `admin/api/db-health.php` from the live server after the database/admin issue is resolved.

## Admin Login Test

1. Upload the current files and live `.env`.
2. Open `/admin/api/db-health.php` only while `APP_DEBUG=true`.
3. Confirm `db_connection` is `ok`.
4. Confirm `admin_users` exists and `admin_users_active` is at least `1`.
5. Set `APP_DEBUG=false`.
6. Open `/admin/` and sign in with the admin email/password stored in the live database.

If login says the password is invalid after `db_connection: ok`, the live database likely does not contain the same admin row/password hash as local. Import or create the admin row in the live MySQL database without dropping production data.
