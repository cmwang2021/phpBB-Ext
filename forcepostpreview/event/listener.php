<?php
/**
 *
 * Force Post Preview. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2026 ECYaz
 * @license GNU General Public License, version 2 (GPL-2.0-only)
 *
 */

namespace ecyaz\forcepostpreview\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Force Post Preview event listener.
 *
 * Loads the extension language file on every page so the template event's
 * tooltip string is translatable.
 */
class listener implements EventSubscriberInterface
{
	/**
	 * {@inheritDoc}
	 */
	public static function getSubscribedEvents()
	{
		return [
			'core.user_setup' => 'load_language_on_setup',
		];
	}

	/**
	 * Register the extension's language file.
	 *
	 * @param \phpbb\event\data $event Event object
	 * @return void
	 */
	public function load_language_on_setup($event)
	{
		$lang_set_ext = $event['lang_set_ext'];
		$lang_set_ext[] = [
			'ext_name' => 'ecyaz/forcepostpreview',
			'lang_set' => 'common',
		];
		$event['lang_set_ext'] = $lang_set_ext;
	}
}
