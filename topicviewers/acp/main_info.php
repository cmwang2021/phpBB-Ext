<?php
/**
 *
 * Topic Viewers. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2026 ECYaz
 * @license GNU General Public License, version 2 (GPL-2.0-only)
 *
 */

namespace ecyaz\topicviewers\acp;

class main_info
{
	public function module()
	{
		return [
			'filename'	=> '\ecyaz\topicviewers\acp\main_module',
			'title'		=> 'ACP_TOPICVIEWERS_TITLE',
			'modes'		=> [
				'settings'	=> [
					'title'	=> 'ACP_TOPICVIEWERS_SETTINGS',
					'auth'	=> 'ext_ecyaz/topicviewers && acl_a_board',
					'cat'	=> ['ACP_CAT_DOT_MODS'],
				],
			],
		];
	}
}
