<?php
namespace ecyaz\phpbbapihook\ucp;

class main_info
{
	public function module()
	{
		return [
			'filename'	=> '\ecyaz\phpbbapihook\ucp\main_module',
			'title'		=> 'UCP_PHPBBAPIHOOK_TITLE',
			'modes'		=> [
				'manage'	=> [
					'title'	=> 'UCP_PHPBBAPIHOOK_MANAGE',
					'auth'	=> '',
					'cat'	=> ['UCP_PROFILE'],
				],
			],
		];
	}
}
