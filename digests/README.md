# Digests (`phpbbservices/digests`)

A phpBB **3.3.x** extension that emails members a **daily, weekly, or monthly digest**
of new posts — or posts in their bookmarked topics — from the forums they subscribe to.
Members configure their own digest in the UCP; admins configure board-wide defaults and
can view a delivery report in the ACP.

> **Community-patched build (`3.3.17.1`).** This is an unofficial, community-maintained
> build of the Digests extension, originally written by **Mark D. Hamill (phpbbservices)**
> and distributed under the GPL-2.0. It is **not** an official phpbbservices release — it
> takes the official `3.3.17` release and fixes it to run cleanly on current phpBB 3.3.17
> boards using PHP 8.1–8.3. The extension name and original author are unchanged. See the
> [CHANGELOG](CHANGELOG.md) for the exact changes, and
> [the official extension](https://www.phpbb.com/customise/db/extension/digests_extension)
> for upstream. The version is `3.3.17.1` so phpBB's version check won't offer to replace
> this build with the unpatched official `3.3.17`.

## Requirements

- phpBB 3.3.x
- PHP 7.1.3 or newer (including PHP 8.1, 8.2, 8.3)
- PHP extensions: `libxml`, `dom` (standard on virtually all hosts)

## Installation

1. Download [`digests.zip`](https://github.com/ECYaz/phpBB-Ext/raw/main/digests.zip).
2. Unzip it into your board's `ext/` directory so the files end up at
   `ext/phpbbservices/digests/`. (The archive already contains the
   `phpbbservices/digests/` folder structure, so you can extract it straight into `ext/`.)
3. In the ACP, go to **Customise → Manage extensions**.
4. Click **Enable** next to **Digests** and confirm.

## Setup

- **System cron.** Digests are sent on the hour by phpBB's scheduled tasks. On a busy
  board the normal page-triggered cron is enough; on a quieter board set up a
  "system cron" so digests go out reliably. See the official FAQ:
  <https://www.phpbb.com/customise/db/extension/digests_extension/faq/2716>
- **Testing.** Recommended steps for verifying delivery after install:
  <https://www.phpbb.com/customise/db/extension/digests_extension/faq/2736>
- **Upgrading from the phpBB 3.0 Digests MOD?** First read how to retain subscribers:
  <https://www.phpbb.com/customise/db/extension/digests_extension/faq/2731>

## Uninstall

- To switch it off: **ACP → Customise → Manage extensions → Disable** next to *Digests*.
  Disabling stops all digest activity and is safe on every database.
- **Full data removal ("Delete data"):** works on MySQL and PostgreSQL. **On SQLite it
  currently errors** — see *Known limitations* below; use **Disable** instead.

## Known limitations

- **SQLite + "Delete data".** On SQLite boards, clicking **Delete data** during uninstall
  produces a `General Error` (`SQL ERROR [ sqlite3 ] near "2": syntax error`). This is a
  **phpBB core limitation, not specific to this build** (it affects the official release
  too): the extension stores the digest send-hour as a `decimal(5,2)` column on the
  `phpbb_users` table, and phpBB's SQLite routine for dropping a column rebuilds the table
  with a regex that breaks on the comma inside the column type. The operation runs inside
  a transaction and rolls back on the error, so **your board and user data are not harmed**
  — the extension simply isn't fully removed. **Workaround:** use **Disable** (safe on
  SQLite), or remove the data manually with SQL. MySQL and PostgreSQL boards are
  unaffected.

## What was fixed in this build

See [CHANGELOG.md](CHANGELOG.md) for details. In short (vs. the official `3.3.17`):
removed the deprecated `utf8_decode()` and handle DOMDocument UTF-8 correctly (no PHP 8.2
deprecation; accented / non-Latin text in digests is no longer garbled); raised the `php`
requirement so it installs on PHP 8.2/8.3; fixed an `ORDER BY` SQL-injection in the ACP
digest-report viewer; and brought the code to a clean pass of the phpBB Extension
CodeSniffer.

## Translations

Czech, French, German and Spanish community translations exist (may be out of date). Place
a translation in the extension's language folder, e.g. `ext/phpbbservices/digests/language/fr`
for French.

- Czech: <https://github.com/petr-hendl/phpBBDigests-cs/>
- French: <https://github.com/bonnaphil/digests-fr> · <https://github.com/ssl-origin/digests-fr/releases>
- German: <https://github.com/Praggle/digests/releases>
- Spanish: <https://github.com/fernandoch777/digests-es>

## License

[GPL-2.0-only](license.txt)

## Credits

Original extension by **Mark D. Hamill** (phpbbservices) — <https://www.phpbbservices.com/>.
This is a community-patched build; see the [CHANGELOG](CHANGELOG.md).
