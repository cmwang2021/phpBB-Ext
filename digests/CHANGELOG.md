# Changelog

This file documents changes made in this community-patched build of the Digests
extension. The extension was originally written by Mark D. Hamill (phpbbservices) and is
distributed under the GPL-2.0. This build is unofficial and community-maintained.

## 3.3.17.1 — 2026-06-17 (community patch)

Based on the official `3.3.17` release; fixed to run cleanly on phpBB 3.3.17 boards
running PHP 8.1–8.3. The extension name (`phpbbservices/digests`) and original author are
unchanged.

### Fixed
- **PHP 8.2 deprecation / UTF-8 corruption in digest emails.** `cron/task/digests.php`
  called the deprecated `utf8_decode()` (deprecated in PHP 8.2, removed in PHP 9) after
  post-processing post HTML with `DOMDocument`. Besides the deprecation, `utf8_decode()`
  converts UTF-8 to ISO-8859-1, mangling accented and non-Latin text in digests. The HTML
  is now parsed as UTF-8 (`'<?xml encoding="UTF-8">'` hint on `loadHTML`) and
  `saveHTML()` output is used directly, preserving multibyte characters.
- **SQL injection (ORDER BY) in the ACP digest-report viewer.** `controller/acp_controller.php`
  interpolated the `sort_field` and `sort` request parameters (string-typed, unescaped)
  directly into an `ORDER BY` clause, allowing injection via a crafted ACP URL (and
  CSRF-reachable). `sort_field` is now validated against an allow-list of report columns,
  the sort direction is constrained to `ASC`/`DESC`, and `LIMIT`/offset moved into
  `sql_query_limit()` with integer casts (also making the query database-portable).

### Changed
- **`composer.json`:** raised the `php` requirement from `>=7.1.3,<=8.1` to `>=7.1.3` so
  the extension installs on PHP 8.2/8.3 boards. Bumped `version` to `3.3.17.1` so phpBB's
  version check does not offer to replace this patched build with the unpatched official
  `3.3.17`.
- **Code style:** brought all PHP files to a clean pass of the phpBB Extension
  CodeSniffer ruleset (`ruleset-php-extensions`). These are whitespace/formatting-only
  changes; no logic was altered.
