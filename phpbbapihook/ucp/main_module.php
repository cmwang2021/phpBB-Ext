<?php
namespace ecyaz\phpbbapihook\ucp;

class main_module
{
	public $u_action;
	public $tpl_name;
	public $page_title;

	public function main($id, $mode)
	{
		global $request, $template, $user, $db, $phpbb_container;

		// Security: Must be logged in
		if ($user->data['user_id'] == ANONYMOUS)
		{
			trigger_error('NOT_AUTHORIZED');
		}

		$user->add_lang_ext('ecyaz/phpbbapihook', 'ucp_phpbbapihook');

		$this->tpl_name   = 'ucp_phpbbapihook';
		$this->page_title = 'UCP_PHPBBAPIHOOK_TITLE';

		/** @var \ecyaz\phpbbapihook\api\credential_manager $credential_manager */
		$credential_manager = $phpbb_container->get('ecyaz.phpbbapihook.credential_manager');

		/** @var \ecyaz\phpbbapihook\api\logger $logger */
		$logger = $phpbb_container->get('ecyaz.phpbbapihook.logger');

		$form_key = 'phpbbapihook_ucp';
		add_form_key($form_key);

		$action = $request->variable('action', '');
		$key_id = $request->variable('id', 0);
		
		$my_user_id = (int) $user->data['user_id'];

		// Helper to fetch user keys
		$my_keys = $credential_manager->all_by_user($my_user_id);
		$my_keys_count = $credential_manager->count_by_user($my_user_id);

		// Security check: if key_id is provided, verify ownership
		if ($key_id)
		{
			$row = $credential_manager->get($key_id);
			if ($row === null || $row['user_id'] != $my_user_id)
			{
				trigger_error($user->lang('UCP_PHPBBAPIHOOK_NOT_FOUND') . '<br /><br /><a href="' . $this->u_action . '">' . $user->lang('UCP_PHPBBAPIHOOK_BACK_TO_LIST') . '</a>', E_USER_WARNING);
			}
		}

		// ------------------------------------------------------------------ //
		// DELETE
		// ------------------------------------------------------------------ //
		if ($action === 'delete' && $key_id)
		{
			if (confirm_box(true))
			{
				$credential_manager->delete($key_id);
				trigger_error($user->lang('UCP_PHPBBAPIHOOK_DELETED') . '<br /><br /><a href="' . $this->u_action . '">' . $user->lang('UCP_PHPBBAPIHOOK_BACK_TO_LIST') . '</a>');
			}
			else
			{
				confirm_box(
					false,
					$user->lang('UCP_PHPBBAPIHOOK_CONFIRM_DELETE'),
					build_hidden_fields([
						'action'	=> 'delete',
						'id'		=> $key_id,
					])
				);
			}
		}

		// ------------------------------------------------------------------ //
		// TOGGLE enabled/disabled
		// ------------------------------------------------------------------ //
		if ($action === 'toggle' && $key_id)
		{
			if (!check_link_hash($request->variable('hash', ''), 'phpbbapihook_toggle'))
			{
				trigger_error('FORM_INVALID', E_USER_WARNING);
			}

			$credential_manager->update($key_id, ['is_enabled' => ($row['is_enabled'] ? 0 : 1)]);
			trigger_error($user->lang('UCP_PHPBBAPIHOOK_UPDATED') . '<br /><br /><a href="' . $this->u_action . '">' . $user->lang('UCP_PHPBBAPIHOOK_BACK_TO_LIST') . '</a>');
		}

		// ------------------------------------------------------------------ //
		// SAVE (edit existing)
		// ------------------------------------------------------------------ //
		if ($action === 'save' && $key_id && $request->is_set_post('submit'))
		{
			if (!check_form_key($form_key))
			{
				trigger_error('FORM_INVALID', E_USER_WARNING);
			}

			$data = $this->parse_form_data($request);
			$data['user_id'] = $my_user_id; // Enforce user_id

			$credential_manager->update($key_id, $data);
			trigger_error($user->lang('UCP_PHPBBAPIHOOK_UPDATED') . '<br /><br /><a href="' . $this->u_action . '">' . $user->lang('UCP_PHPBBAPIHOOK_BACK_TO_LIST') . '</a>');
		}

		// ------------------------------------------------------------------ //
		// ADD (create new)
		// ------------------------------------------------------------------ //
		if ($action === 'add' && $request->is_set_post('submit'))
		{
			if (!check_form_key($form_key))
			{
				trigger_error('FORM_INVALID', E_USER_WARNING);
			}
			
			if ($my_keys_count >= 2)
			{
				trigger_error($user->lang('UCP_PHPBBAPIHOOK_LIMIT_REACHED') . '<br /><br /><a href="' . $this->u_action . '">' . $user->lang('UCP_PHPBBAPIHOOK_BACK_TO_LIST') . '</a>', E_USER_WARNING);
			}

			$data = $this->parse_form_data($request);
			$data['user_id'] = $my_user_id; // Enforce user_id
			$data['rate_limit'] = 1000; // Hardcoded default limit for UCP keys

			$result    = $credential_manager->create($data);
			$new_token = $result['token'];

			$template->assign_vars([
				'NEW_TOKEN'			=> $new_token,
				'NEW_KEY_ID'		=> $result['key_id'],
				'S_TOKEN_CREATED'	=> true,
			]);
		}

		// ------------------------------------------------------------------ //
		// EDIT form (show form pre-filled)
		// ------------------------------------------------------------------ //
		if ($action === 'edit' && $key_id)
		{
			$template->assign_vars([
				'S_EDIT_MODE'		=> true,
				'EDIT_KEY_ID'		=> (int) $row['key_id'],
				'EDIT_KEY_NAME'		=> $row['key_name'],
				'EDIT_FORUM_IDS'	=> $row['forum_ids'] !== '' ? implode(', ', array_map('intval', json_decode($row['forum_ids'], true) ?: [])) : '',
				'EDIT_IP_ALLOWLIST'	=> $row['ip_allowlist'],
				'S_EDIT_READ_ONLY'	=> (bool) $row['read_only'],
				'S_EDIT_ENABLED'	=> (bool) $row['is_enabled'],
				'U_SAVE'			=> $this->u_action . '&amp;action=save&amp;id=' . $row['key_id'],
			]);
		}

		// ------------------------------------------------------------------ //
		// VIEW LOG
		// ------------------------------------------------------------------ //
		if ($action === 'viewlog' && $key_id)
		{
			$template->assign_vars([
				'S_VIEW_LOG'		=> true,
				'LOG_KEY_NAME'		=> $row['key_name'],
				'LOG_KEY_ID'		=> $key_id,
			]);

			$log_rows = $logger->recent($key_id, 50);
			foreach ($log_rows as $log_row)
			{
				$template->assign_block_vars('logs', [
					'LOG_TIME'		=> $user->format_date($log_row['log_time']),
					'LOG_IP'		=> $log_row['log_ip'],
					'LOG_METHOD'	=> $log_row['log_method'],
					'LOG_ROUTE'		=> $log_row['log_route'],
					'LOG_ACTION'	=> $log_row['log_action'],
					'LOG_STATUS'	=> (int) $log_row['log_status'],
					'LOG_DETAIL'	=> $log_row['log_detail'],
				]);
			}
		}

		// ------------------------------------------------------------------ //
		// LIST (default view)
		// ------------------------------------------------------------------ //
		if (!in_array($action, ['edit', 'viewlog'], true) || ($action === 'add' && $request->is_set_post('submit')) || ($action === 'save' && $key_id && $request->is_set_post('submit')))
		{
			foreach ($my_keys as $cred)
			{
				$cid      = (int) $cred['key_id'];
				$exp_str  = $cred['expiration'] ? $user->format_date($cred['expiration']) : $user->lang('UCP_PHPBBAPIHOOK_NEVER');
				$last_str = $cred['last_used'] ? $user->format_date($cred['last_used']) : $user->lang('UCP_PHPBBAPIHOOK_NEVER');

				$template->assign_block_vars('keys', [
					'KEY_ID'		=> $cid,
					'KEY_NAME'		=> $cred['key_name'],
					'KEY_PREFIX'	=> $cred['key_prefix'],
					'ENABLED'		=> (bool) $cred['is_enabled'],
					'READ_ONLY'		=> (bool) $cred['read_only'],
					'RATE_LIMIT'	=> $cred['rate_limit'] ? $cred['rate_limit'] : $user->lang('UCP_PHPBBAPIHOOK_UNLIMITED'),
					'EXPIRATION'	=> $exp_str,
					'LAST_USED'		=> $last_str,
					'U_EDIT'		=> $this->u_action . '&amp;action=edit&amp;id=' . $cid,
					'U_TOGGLE'		=> $this->u_action . '&amp;action=toggle&amp;id=' . $cid . '&amp;hash=' . generate_link_hash('phpbbapihook_toggle'),
					'U_DELETE'		=> $this->u_action . '&amp;action=delete&amp;id=' . $cid,
					'U_VIEWLOG'		=> $this->u_action . '&amp;action=viewlog&amp;id=' . $cid,
				]);
			}
		}

		$template->assign_vars([
			'U_ACTION'		=> $this->u_action,
			'U_ADD_ACTION'	=> $this->u_action . '&amp;action=add',
			'S_ACTION'		=> $action,
			'S_LIMIT_REACHED' => $my_keys_count >= 2,
		]);
	}

	protected function parse_form_data($request)
	{
		$key_name      = $request->variable('key_name', '', true);
		$forum_ids_raw = $request->variable('forum_ids', '');
		$ip_allowlist  = $request->variable('ip_allowlist', '');
		$read_only     = $request->variable('read_only', 0);
		$is_enabled    = $request->variable('is_enabled', 0);

		$forum_ids_arr = [];
		if (trim($forum_ids_raw) !== '')
		{
			$parts = preg_split('/[^0-9]+/', $forum_ids_raw, -1, PREG_SPLIT_NO_EMPTY);
			foreach ($parts as $part)
			{
				$int = (int) $part;
				if ($int > 0)
				{
					$forum_ids_arr[] = $int;
				}
			}
		}
		$forum_ids = empty($forum_ids_arr) ? '' : json_encode(array_values(array_unique($forum_ids_arr)));

		return [
			'key_name'      => $key_name,
			'forum_ids'     => $forum_ids,
			'ip_allowlist'  => $ip_allowlist,
			'read_only'     => $read_only ? 1 : 0,
			'is_enabled'    => $is_enabled ? 1 : 0,
		];
	}
}
