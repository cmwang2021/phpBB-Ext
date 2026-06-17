# Digests

> **Community-patched build (3.3.17.1).** This is an unofficial, community-maintained
> build of the Digests extension, originally written by **Mark D. Hamill (phpbbservices)**
> and distributed under the GPL-2.0. It is **not** an official phpbbservices release. It
> takes the official `3.3.17` release and applies fixes so it runs cleanly on current
> phpBB 3.3.17 boards using PHP 8.1–8.3. See [CHANGELOG.md](CHANGELOG.md) for the exact
> changes. The version is set to `3.3.17.1` so phpBB's built-in version check will not
> offer to "update" you back to the unpatched official `3.3.17`. For the official
> extension, see https://www.phpbb.com/customise/db/extension/digests_extension
>
> **Fixes in this build:** removed the deprecated `utf8_decode()` and handle DOMDocument
> UTF-8 correctly (no PHP 8.2 deprecation; non-Latin / accented text in digest emails is
> no longer garbled); raised the `php` requirement cap so it installs on PHP 8.2/8.3;
> closed an ORDER BY SQL-injection hole in the ACP digest-report viewer; and brought the
> code to a clean pass of the phpBB Extension CodeSniffer ruleset. The extension name and
> original author are unchanged.

Digests extension for phpBB 3.3

Please note that when deployed the extension will go under ext/phpbbservices/digests. Only the digests tree is shown in GitHub.

If you are upgrading from the digests modification for phpBB 3.0, first read the FAQ on how to retain your digests subscribers: https://www.phpbb.com/customise/db/extension/digests_extension/faq/2731

Digests no longer requires that a cron job be run hourly, but it's generally a good idea to set up what is known as a "system cron". See https://www.phpbb.com/customise/db/extension/digests_extension/faq/2716.

After installation, there are recommended steps for testing digests. See: https://www.phpbb.com/customise/db/extension/digests_extension/faq/2736

Czech, French, German and Spanish language translations exist. The translation may be out of date. Translations must be placed int the extension's language folder /ext/phpbbservices/digests/language, ex: /ext/phpbbservices/digests/language/fr for French. Thanks to our translators for providing these translations!

Czech: https://github.com/petr-hendl/phpBBDigests-cs/
French: https://github.com/bonnaphil/digests-fr
French: https://github.com/ssl-origin/digests-fr/releases
German: https://github.com/Praggle/digests/releases
Spanish: https://github.com/fernandoch777/digests-es
