<?php
/**
 *
 * phpbbAPIhook. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2026 ECYaz
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace ecyaz\phpbbapihook\migrations;

class acp_module extends \phpbb\db\migration\migration
{
	public static function depends_on()
	{
		return ['\ecyaz\phpbbapihook\migrations\install'];
	}

	public function effectively_installed()
	{
		$sql = 'SELECT module_id
			FROM ' . $this->table_prefix . "modules
			WHERE module_class = 'acp'
				AND module_langname = 'ACP_PHPBBAPIHOOK_MANAGE'";
		$result   = $this->db->sql_query($sql);
		$module_id = (int) $this->db->sql_fetchfield('module_id');
		$this->db->sql_freeresult($result);

		return (bool) $module_id;
	}

	public function update_data()
	{
		return [
			['module.add', [
				'acp',
				'ACP_CAT_DOT_MODS',
				'ACP_PHPBBAPIHOOK_TITLE',
			]],
			['module.add', [
				'acp',
				'ACP_PHPBBAPIHOOK_TITLE',
				[
					'module_basename'	=> '\ecyaz\phpbbapihook\acp\main_module',
					'module_langname'	=> 'ACP_PHPBBAPIHOOK_MANAGE',
					'module_mode'		=> 'manage',
					'module_auth'		=> 'acl_a_board',
				],
			]],
		];
	}

	public function revert_data()
	{
		return [
			['module.remove', [
				'acp',
				'ACP_PHPBBAPIHOOK_TITLE',
				'ACP_PHPBBAPIHOOK_MANAGE',
			]],
			['module.remove', [
				'acp',
				'ACP_CAT_DOT_MODS',
				'ACP_PHPBBAPIHOOK_TITLE',
			]],
		];
	}
}
