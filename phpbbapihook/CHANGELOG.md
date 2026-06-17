# Changelog

All notable changes to **phpbbAPIhook** are documented here.
This project adheres to [Semantic Versioning](https://semver.org/).

## [1.0.0] — 2026-06-17

Initial release.

### Features
- Secure REST API for phpBB 3.3.x with token authentication
  (`Authorization: Bearer` or `X-API-Key`).
- ACP credential management: create keys (token shown once), bind each key to a
  phpBB user account, set forum allow-lists, IP allow-lists, rate limits,
  expiry dates, read-only and enabled flags, and view a per-credential audit log.
- Endpoints: `POST /api/topics`, `POST /api/topics/{id}/reply`,
  `GET /api/topics/{id}`, `GET /api/forums`, `GET /api/me/permissions`.
- Every action runs with the linked account's phpBB permissions via
  `$auth->acl()`; content is created through phpBB's own `submit_post()`.
- Full request audit logging; HTTPS enforced by default.

### Security
- Enforces phpBB forum/topic lock status (locked forum requires `m_edit` for new
  topics / `m_lock` for replies) and refuses password-protected forums, so the
  API can never post where the linked account could not.
- API tokens are stored only as SHA-256 hashes; CSRF form keys protect all ACP
  write actions.

### Tested
- 17 functional tests (authentication, per-user ACL enforcement, forum-lock
  enforcement, forum/credential restrictions, rate limiting, expiry, ACP page
  load). Passes phpBB CodeSniffer and the Extension Pre-Validator (EPV).

### Not yet implemented (roadmap)
- Attachments, post/topic editing, topic locking and moderation actions,
  webhooks, OAuth2, and SSO — see the README roadmap.
