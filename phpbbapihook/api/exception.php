<?php
/**
 *
 * phpbbAPIhook. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2026 ECYaz
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace ecyaz\phpbbapihook\api;

/**
 * Thrown anywhere in the API request pipeline to abort with a machine-readable
 * error code and an HTTP status. The controller layer turns it into a JSON
 * `{ "success": false, "error": "<code>" }` response.
 */
class exception extends \Exception
{
	/** @var string */
	protected $error_code;

	/** @var int */
	protected $status_code;

	/**
	 * @param string $error_code  Machine-readable code, e.g. 'invalid_token'
	 * @param int    $status_code HTTP status code, e.g. 401
	 * @param string $detail      Optional human-readable detail (for the audit log)
	 */
	public function __construct($error_code, $status_code = 400, $detail = '')
	{
		parent::__construct($detail !== '' ? $detail : $error_code);

		$this->error_code  = (string) $error_code;
		$this->status_code = (int) $status_code;
	}

	public function get_error_code()
	{
		return $this->error_code;
	}

	public function get_status_code()
	{
		return $this->status_code;
	}
}
