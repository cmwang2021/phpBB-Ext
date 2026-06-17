<?php
/**
 *
 * phpbbAPIhook. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2026 ECYaz
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace ecyaz\phpbbapihook\controller;

/**
 * Forum read endpoint. Only forums the credential's user can see (f_list) and
 * the credential is allowed to use are returned.
 */
class forums extends base
{
	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	public function __construct(
		\ecyaz\phpbbapihook\api\authenticator $authenticator,
		\ecyaz\phpbbapihook\api\responder $responder,
		\ecyaz\phpbbapihook\api\logger $logger,
		\phpbb\request\request_interface $request,
		\phpbb\user $user,
		\phpbb\auth\auth $auth,
		\phpbb\db\driver\driver_interface $db
	)
	{
		parent::__construct($authenticator, $responder, $logger, $request, $user);

		$this->auth = $auth;
		$this->db   = $db;
	}

	/**
	 * GET /api/forums — list forums visible to the credential.
	 */
	public function list_forums()
	{
		return $this->run('forum.list', function (\ecyaz\phpbbapihook\api\auth_context $ctx) {
			$forums = [];

			$sql = 'SELECT forum_id, parent_id, forum_name, forum_type
				FROM ' . FORUMS_TABLE . '
				ORDER BY left_id ASC';
			$result = $this->db->sql_query($sql);
			while ($row = $this->db->sql_fetchrow($result))
			{
				$forum_id = (int) $row['forum_id'];

				if (!$this->auth->acl_get('f_list', $forum_id) || !$ctx->can_access_forum($forum_id))
				{
					continue;
				}

				$forums[] = [
					'forum_id'  => $forum_id,
					'parent_id' => (int) $row['parent_id'],
					'name'      => (string) $row['forum_name'],
					'type'      => (int) $row['forum_type'],
					'can_read'  => (bool) $this->auth->acl_get('f_read', $forum_id),
					'can_post'  => (bool) $this->auth->acl_get('f_post', $forum_id),
					'can_reply' => (bool) $this->auth->acl_get('f_reply', $forum_id),
				];
			}
			$this->db->sql_freeresult($result);

			return $this->responder->success(['forums' => $forums]);
		});
	}
}
