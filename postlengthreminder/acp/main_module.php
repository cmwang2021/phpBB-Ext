<?php
/**
 *
 * Post Length Reminder. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2026 ECYaz
 * @license GNU General Public License, version 2 (GPL-2.0-only)
 *
 */

namespace ecyaz\postlengthreminder\acp;

class main_module
{
	/** @var string */
	public $u_action;

	/** @var string */
	public $tpl_name;

	/** @var string */
	public $page_title;

	public function main($id, $mode)
	{
		global $config, $request, $template, $user;

		$user->add_lang_ext('ecyaz/postlengthreminder', 'common');

		$this->tpl_name = 'acp_postlengthreminder';
		$this->page_title = 'ACP_POSTLENGTHREMINDER_SETTINGS';

		$form_key = 'acp_postlengthreminder';
		add_form_key($form_key);

		if ($request->is_set_post('submit'))
		{
			if (!check_form_key($form_key))
			{
				trigger_error('FORM_INVALID', E_USER_ERROR);
			}

			$min_chars = $request->variable('postlengthreminder_min_chars', 0);
			if ($min_chars < 0)
			{
				$min_chars = 0;
			}

			$message = $request->variable('postlengthreminder_message', '', true);

			$config->set('postlengthreminder_min_chars', $min_chars);
			$config->set('postlengthreminder_message', $message);

			trigger_error($user->lang('ACP_POSTLENGTHREMINDER_SAVED') . adm_back_link($this->u_action));
		}

		$template->assign_vars([
			'POSTLENGTHREMINDER_MIN_CHARS'	=> (int) $config['postlengthreminder_min_chars'],
			'POSTLENGTHREMINDER_MESSAGE'	=> $config['postlengthreminder_message'],
			'U_ACTION'						=> $this->u_action,
		]);
	}
}
