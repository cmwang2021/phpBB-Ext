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

/**
 * Creates the two tables the extension owns and seeds its global config:
 *
 *  - phpbb_apihook_keys : one row per API credential (hashed token, the phpBB
 *    user whose permissions the credential acts with, forum/IP allow-lists,
 *    rate limit, expiry, enabled flag, last-used metadata).
 *  - phpbb_apihook_log  : one row per API request (audit trail; also the source
 *    of truth for rate-limit counting).
 */
class install extends \phpbb\db\migration\migration
{
	public static function depends_on()
	{
		return ['\phpbb\db\migration\data\v330\v330'];
	}

	public function effectively_installed()
	{
		return $this->db_tools->sql_table_exists($this->table_prefix . 'apihook_keys');
	}

	public function update_schema()
	{
		return [
			'add_tables' => [
				$this->table_prefix . 'apihook_keys' => [
					'COLUMNS' => [
						'key_id'         => ['UINT', null, 'auto_increment'],
						'key_token_hash' => ['VCHAR:64', ''],
						'key_prefix'     => ['VCHAR:16', ''],
						'key_name'       => ['VCHAR_UNI:255', ''],
						'user_id'        => ['UINT', 0],
						'forum_ids'      => ['TEXT', ''],
						'ip_allowlist'   => ['TEXT', ''],
						'rate_limit'     => ['UINT', 0],
						'read_only'      => ['BOOL', 0],
						'is_enabled'     => ['BOOL', 1],
						'expiration'     => ['TIMESTAMP', 0],
						'last_used'      => ['TIMESTAMP', 0],
						'last_ip'        => ['VCHAR:40', ''],
						'created_at'     => ['TIMESTAMP', 0],
					],
					'PRIMARY_KEY' => 'key_id',
					'KEYS' => [
						'key_token_hash' => ['UNIQUE', 'key_token_hash'],
						'user_id'        => ['INDEX', 'user_id'],
					],
				],
				$this->table_prefix . 'apihook_log' => [
					'COLUMNS' => [
						'log_id'     => ['UINT', null, 'auto_increment'],
						'key_id'     => ['UINT', 0],
						'log_time'   => ['TIMESTAMP', 0],
						'log_ip'     => ['VCHAR:40', ''],
						'log_method' => ['VCHAR:8', ''],
						'log_route'  => ['VCHAR:255', ''],
						'log_action' => ['VCHAR:255', ''],
						'log_status' => ['USINT', 0],
						'log_detail' => ['TEXT_UNI', ''],
					],
					'PRIMARY_KEY' => 'log_id',
					'KEYS' => [
						'key_time' => ['INDEX', ['key_id', 'log_time']],
					],
				],
			],
		];
	}

	public function revert_schema()
	{
		return [
			'drop_tables' => [
				$this->table_prefix . 'apihook_keys',
				$this->table_prefix . 'apihook_log',
			],
		];
	}

	public function update_data()
	{
		return [
			['config.add', ['phpbbapihook_master_enabled', 1]],
			['config.add', ['phpbbapihook_require_https', 1]],
			['config.add', ['phpbbapihook_rate_window', 3600]],
		];
	}
}
