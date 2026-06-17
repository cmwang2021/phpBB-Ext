<?php
/**
 *
 * phpbbAPIhook. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2026 ECYaz
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace ecyaz\phpbbapihook\acp;

class main_info
{
	public function module()
	{
		return [
			'filename'	=> '\ecyaz\phpbbapihook\acp\main_module',
			'title'		=> 'ACP_PHPBBAPIHOOK_TITLE',
			'modes'		=> [
				'manage'	=> [
					'title'	=> 'ACP_PHPBBAPIHOOK_MANAGE',
					'auth'	=> 'acl_a_board',
					'cat'	=> ['ACP_CAT_DOT_MODS'],
				],
			],
		];
	}
}
