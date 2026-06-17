<?php
namespace ecyaz\pmemaildefault\migrations;

class m3_acp_module extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		$sql = 'SELECT module_id
			FROM ' . $this->table_prefix . "modules
			WHERE module_class = 'acp'
				AND module_langname = 'ACP_PMEMAILDEFAULT_SETTINGS'";
		$result = $this->db->sql_query($sql);
		$module_id = (int) $this->db->sql_fetchfield('module_id');
		$this->db->sql_freeresult($result);

		return (bool) $module_id;
	}

	public static function depends_on()
	{
		return ['\ecyaz\pmemaildefault\migrations\m2_pm_email_config'];
	}

	public function update_data()
	{
		return [
			['module.add', [
				'acp',
				'ACP_CAT_DOT_MODS',
				[
					'module_basename'	=> '\ecyaz\pmemaildefault\acp\main_module',
					'module_langname'	=> 'ACP_PMEMAILDEFAULT_SETTINGS',
					'module_mode'		=> 'settings',
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
				'ACP_CAT_DOT_MODS',
				'ACP_PMEMAILDEFAULT_SETTINGS',
			]],
		];
	}
}
