<?php
namespace ecyaz\pmemaildefault\acp;

class main_info
{
	public function module()
	{
		return [
			'filename'	=> '\ecyaz\pmemaildefault\acp\main_module',
			'title'		=> 'ACP_PMEMAILDEFAULT_TITLE',
			'modes'		=> [
				'settings'	=> [
					'title'	=> 'ACP_PMEMAILDEFAULT_SETTINGS',
					'auth'	=> 'acl_a_board',
					'cat'	=> ['ACP_CAT_DOT_MODS'],
				],
			],
		];
	}
}
