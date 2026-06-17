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

use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Builds the extension's consistent JSON envelope:
 *   success: { "success": true, ... }
 *   error:   { "success": false, "error": "<code>", ... }
 */
class responder
{
	public function success(array $data = [], $status = 200)
	{
		return new JsonResponse(array_merge(['success' => true], $data), (int) $status);
	}

	public function error($error_code, $status = 400, array $extra = [])
	{
		return new JsonResponse(array_merge([
			'success' => false,
			'error'   => (string) $error_code,
		], $extra), (int) $status);
	}

	public function from_exception(exception $e)
	{
		return $this->error($e->get_error_code(), $e->get_status_code());
	}
}
