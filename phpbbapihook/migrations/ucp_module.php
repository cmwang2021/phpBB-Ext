<?php
namespace ecyaz\phpbbapihook\migrations;

class ucp_module extends \phpbb\db\migration\migration
{
	public static function depends_on()
	{
		return ['\ecyaz\phpbbapihook\migrations\install'];
	}

	public function effectively_installed()
	{
		$sql = 'SELECT module_id
			FROM ' . $this->table_prefix . "modules
			WHERE module_class = 'ucp'
				AND module_langname = 'UCP_PHPBBAPIHOOK_MANAGE'";
		$result   = $this->db->sql_query($sql);
		$module_id = (int) $this->db->sql_fetchfield('module_id');
		$this->db->sql_freeresult($result);

		return (bool) $module_id;
	}

	public function update_data()
	{
		return [
			['module.add', [
				'ucp',
				'UCP_PROFILE',
				'UCP_PHPBBAPIHOOK_TITLE',
			]],
			['module.add', [
				'ucp',
				'UCP_PHPBBAPIHOOK_TITLE',
				[
					'module_basename'	=> '\ecyaz\phpbbapihook\ucp\main_module',
					'module_langname'	=> 'UCP_PHPBBAPIHOOK_MANAGE',
					'module_mode'		=> 'manage',
					'module_auth'		=> '',
				],
			]],
		];
	}

	public function revert_data()
	{
		return [
			['module.remove', [
				'ucp',
				'UCP_PHPBBAPIHOOK_TITLE',
				'UCP_PHPBBAPIHOOK_MANAGE',
			]],
			['module.remove', [
				'ucp',
				'UCP_PROFILE',
				'UCP_PHPBBAPIHOOK_TITLE',
			]],
		];
	}
}
