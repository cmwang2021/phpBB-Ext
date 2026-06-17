<?php
/**
 *
 * phpbbAPIhook. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2026 ECYaz
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace ecyaz\phpbbapihook\api;

/**
 * Immutable result of a successful authentication: the API credential row and
 * the phpBB user row whose permissions the request now runs with. Controllers
 * use it for credential-level restrictions (read-only, forum allow-list) that
 * sit on top of the user's native phpBB ACL.
 */
class auth_context
{
	/** @var array */
	protected $credential;

	/** @var array */
	protected $user_row;

	public function __construct(array $credential, array $user_row)
	{
		$this->credential = $credential;
		$this->user_row   = $user_row;
	}

	public function get_key_id()
	{
		return (int) $this->credential['key_id'];
	}

	public function get_user_id()
	{
		return (int) $this->credential['user_id'];
	}

	public function is_read_only()
	{
		return (bool) $this->credential['read_only'];
	}

	/**
	 * Forum ids this credential is restricted to.
	 *
	 * @return int[] Allowed forum ids, or an empty array meaning "all forums
	 *               the linked user can already see".
	 */
	public function get_allowed_forums()
	{
		$raw = trim((string) $this->credential['forum_ids']);

		if ($raw === '')
		{
			return [];
		}

		$ids = json_decode($raw, true);

		return is_array($ids) ? array_values(array_map('intval', $ids)) : [];
	}

	/**
	 * Whether this credential's forum allow-list permits the given forum.
	 * This is the credential restriction only; the user's phpBB ACL is checked
	 * separately and independently.
	 */
	public function can_access_forum($forum_id)
	{
		$allowed = $this->get_allowed_forums();

		return empty($allowed) || in_array((int) $forum_id, $allowed, true);
	}
}
