<?php
/**
 *
 * Post Length Reminder. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2026 ECYaz
 * @license GNU General Public License, version 2 (GPL-2.0-only)
 *
 */

namespace ecyaz\postlengthreminder\migrations;

class v_1_0_0 extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return $this->config->offsetExists('postlengthreminder_min_chars');
	}

	public static function depends_on()
	{
		return ['\phpbb\db\migration\data\v330\v330'];
	}

	public function update_data()
	{
		return [
			['config.add', ['postlengthreminder_min_chars', 100]],
			['config.add', ['postlengthreminder_message', '']],
			['config.add', ['postlengthreminder_version', '1.0.0']],

			['module.add', [
				'acp',
				'ACP_CAT_DOT_MODS',
				[
					'module_basename'	=> '\ecyaz\postlengthreminder\acp\main_module',
					'module_langname'	=> 'ACP_POSTLENGTHREMINDER_TITLE',
					'module_mode'		=> 'settings',
					'module_auth'		=> 'ext_ecyaz/postlengthreminder && acl_a_board',
				],
			]],
		];
	}

	public function revert_data()
	{
		return [
			['module.remove', [
				'acp',
				'ACP_CAT_DOT_MODS',
				'ACP_POSTLENGTHREMINDER_TITLE',
			]],
			['config.remove', ['postlengthreminder_min_chars']],
			['config.remove', ['postlengthreminder_message']],
			['config.remove', ['postlengthreminder_version']],
		];
	}
}
