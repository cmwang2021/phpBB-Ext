<?php
/**
 *
 * phpbbAPIhook. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2026 ECYaz
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace ecyaz\phpbbapihook;

class ext extends \phpbb\extension\base
{
	/**
	 * The extension requires phpBB 3.3.0 or newer (it relies on the 3.3 routing
	 * and notification/auth APIs). phpBB calls this before enabling.
	 *
	 * @return bool
	 */
	public function is_enableable()
	{
		$config = $this->container->get('config');

		return phpbb_version_compare($config['version'], '3.3.0', '>=')
			&& phpbb_version_compare($config['version'], '4.0.0@dev', '<');
	}
}
