# Codeksha admin panel & analytics

A self-hosted, first-party analytics + admin panel for the Codeksha site.
No third-party services, no external JS. Everything lives in this repo + one
MySQL database.

---

## 1. One-time install

### a. Create the database

```bash
"C:\xampp\mysql\bin\mysql.exe" -uroot < db/schema.sql
```

This creates the `codeksha_admin` database and all tables.

### b. Configure

Edit **`inc/config.php`**:

| Key | What to set |
|-----|-------------|
| `db` | MySQL host/user/pass (XAMPP default `root` / empty is pre-filled) |
| `app_key` | Replace with a fresh 64-char random string **once**, then never change it (it signs form tokens & CSRF). Generate: `php -r "echo bin2hex(random_bytes(32));"` |
| `site_url` | Public base URL, no trailing slash. Local: `http://codeksha.test` — change for production. |
| `tracking.anonymize_ip` | `true` to store IPs with the last octet zeroed |
| `admin.bind_ip` | `true` locks a login session to one IP (more secure, but logs mobile users out when their IP changes) |

`inc/config.php` is blocked from the web by `.htaccess`. Keep real
credentials out of any public git repo (`inc/config.sample.php` is the
shareable template).

### c. The tracker hook

The analytics tracker is loaded by a one-line `<?php @include … ?>` at the
very top of every public page (`index.php`, `course/*.php`, `blog/*.php`,
etc.). **No server configuration is needed** — it works on XAMPP and on any
shared host as-is. If you add a new page, copy that first line from an
existing page.

*(The `@` means a missing/broken tracker never breaks the page. Do NOT add
`auto_prepend_file` anywhere — it is not needed and causes 500s on many
hosts.)*

### d. Create the first admin

Visit **`/admin/setup.php`** once and create your admin username + password
(min 10 chars). The page disables itself as soon as one account exists.

Then sign in at **`/admin/`**.

---

## 2. What gets tracked

**Server-side (every page load, works without JavaScript):**
new vs returning visitor (first-party cookie `ck_vid`), session
(`ck_sid`, 30-min timeout), path, referrer, UTM params, channel
(direct / organic / social / referral / paid / email), IP + country/region/city
(cached per IP), browser, OS, device type, bot detection.

**Browser beacon (`/assets/track.js`):** screen & viewport size, engaged
time per page, scroll depth, scroll milestones, clicks on links/buttons,
outbound / `tel:` / `mailto:` / download clicks, CTA clicks, and
form **start / submit / abandon** (with the last field touched).

**Forms:** every `contact`, `book-demo` and `become-an-instructor` submission
is stored in `form_submissions`, linked to the visitor who sent it, with
status workflow (new / read / replied / spam) + private notes. Demo
bookings store the chosen course in `field1` and the preferred time slot in
`field2`; the dashboard shows a **Leads** panel counting each form type.

Bots and any IPs on the exclusion list are still recorded but hidden from
every stat (tick **"include bots"** on any list page to see them).

---

## 3. Admin panel pages

| Page | Purpose |
|------|---------|
| **Dashboard** | GSC-style KPIs with vs-previous-period deltas, new/returning chart, top pages, referrers, channels, devices, countries, latest submissions |
| **Visitors** | Every visitor; open one to see its **entire page-by-page journey** across all sessions, with events inline |
| **Sessions** | Every visit with entry/exit, channel, duration; drill into the timeline |
| **Page Views** | Per-page summary (views, unique, avg time, avg scroll) + raw log |
| **Interactions** | All click/CTA/outbound/form events; most-clicked report |
| **Form Submissions** | Inbox with search, status workflow, notes, per-submission detail |
| **Live** | Auto-refreshing view of who is on the site right now + recent events |
| **Settings** | Password change, data retention, IP exclusions, email alerts + SMTP, blocked IPs |
| **Admin Users** | Add/disable/delete admins, roles (Admin vs read-only Viewer), password resets, activity log |

Every list page has a **Export CSV** button (opens in Excel).

---

## 4. Email alerts

Settings → *Email alerts*. Turn on, set the destination address.

- **Leave SMTP host blank** to use the server's built-in `mail()` (works if
  your host has a mail server; XAMPP on Windows usually does **not**).
- **For Gmail / a real mailbox:** fill SMTP host (`smtp.gmail.com`), port
  `587`, encryption `TLS`, your SMTP username + an **app password**.
- Use **"Save & send test email"** to verify.

---

## 5. Data retention

Settings → retention days (default 90). Old page views, events and sessions
are purged automatically once per day when any admin loads a page.
Form submissions are kept forever.

For a guaranteed schedule, add a Windows Task Scheduler job:

```
"C:\xampp\php\php.exe" "C:\xampp\htdocs\codeksha\admin\cron-cleanup.php"
```

---

## 6. Security summary

- Passwords hashed with `password_hash()` (bcrypt), auto-rehash on login
- Login rate-limited (8 fails / 15 min per IP), constant delay on failure
- Sessions: `HttpOnly` + `SameSite=Strict` + `Secure` (on HTTPS), strict
  mode, id regenerated on login, idle (30 min) + absolute (8 h) timeouts,
  bound to the user-agent
- CSRF token on every admin form
- All DB access via prepared statements; all output escaped (tracked data is
  attacker-controlled — URLs, user-agents, form text)
- CSP + `X-Frame-Options: DENY` + `noindex` on the whole admin area
- `/inc/`, `/db/`, `/admin/inc/` blocked from direct web access
- Public forms: honeypot + signed timing token + per-IP rate limit

---

## 7. Deploying to a live host (e.g. raj.codeksha.com on cPanel)

The `.htaccess` in this repo is **portable** — do not add `php_value` /
`php_flag` lines to it (they 500 on PHP-FPM / CGI / LiteSpeed). If the site
shows a 500 error right after uploading `.htaccess`, that is almost always a
`php_value` line or an `Options` your host forbids.

**Steps:**

1. **Upload the files** into the subdomain's document root (the folder that
   already contains `index.php`).

2. **Create the database** in cPanel → *MySQL Databases*: make a DB + user,
   grant all privileges. Then import `db/schema.sql` via *phpMyAdmin*
   (it will create the tables inside the DB you select — you can delete the
   `CREATE DATABASE` line at the top before importing, or import as-is into a
   DB literally named `codeksha_admin` if your host allows that name).

3. **Edit `inc/config.php`** on the server:
   - `db` → the cPanel DB name / user / password / `host` usually `localhost`
   - `site_url` → your real public domain, e.g. `https://raj.codeksha.com`
     (this drives `/robots.txt`, `/sitemap.xml`, `/llms.txt` and admin email
     links). The page `<link rel="canonical">` tags are hard-coded to
     `https://codeksha.com` — if that is NOT your final domain, find-and-replace
     `https://codeksha.com` across the `.php` files.
   - `app_key` → a fresh 64-char random string
     (`php -r "echo bin2hex(random_bytes(32));"`)

4. **The tracker needs no setup** — it is included by each page directly.
   Just make sure the whole `inc/` folder is uploaded. (You can delete
   `get-path.php` and ignore `.user.ini`.)

5. **HTTPS** — issue a free *AutoSSL* / Let's Encrypt cert for the subdomain,
   force HTTPS (cPanel usually has a toggle), then uncomment the HSTS line in
   `.htaccess`.

6. Visit `/admin/setup.php` to create the admin account.

**If a page still 500s:** open cPanel → *Errors* (or `error_log` in the doc
root) — it names the exact `.htaccess` line or PHP error.

---

## 8. Security summary continued

### Before going to production
1. Serve everything over **HTTPS**; uncomment the HSTS line in `.htaccess`.
   Cookie `Secure` flags turn on automatically under HTTPS.
2. Change `db.pass` to a real MySQL password.
3. Regenerate `app_key`.
4. Consider IP-allowlisting `/admin/` (cPanel → *Directory Privacy* or an
   `.htaccess` in `/admin/`).
5. **Cookie consent** (`/assets/consent.js`) — a bottom-left banner with
   **Accept all** / **Reject**. The choice is stored in the `ck_consent`
   cookie (`all` / `essential`). Both the server-side tracker
   (`inc/tracker.php`) and the browser beacon honour it: `essential` stops
   all analytics and clears the `ck_vid` / `ck_sid` cookies. Visitors who
   have not chosen yet are still tracked (implied consent) — to require an
   explicit opt-in instead, change the tracker to also `return` when the
   `ck_consent` cookie is absent.
