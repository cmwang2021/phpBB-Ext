<?php
/**
 *
 * Post Length Reminder. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2026 ECYaz
 * @license GNU General Public License, version 2 (GPL-2.0-only)
 *
 */

namespace ecyaz\postlengthreminder\event;

use phpbb\config\config;
use phpbb\language\language;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Post Length Reminder event listener.
 */
class listener implements EventSubscriberInterface
{
	/** @var config */
	protected $config;

	/** @var language */
	protected $language;

	/**
	 * Constructor.
	 *
	 * @param config   $config   Config object
	 * @param language $language Language object
	 */
	public function __construct(config $config, language $language)
	{
		$this->config = $config;
		$this->language = $language;
	}

	/**
	 * {@inheritDoc}
	 */
	public static function getSubscribedEvents()
	{
		return [
			'core.user_setup'					=> 'load_language_on_setup',
			'core.posting_modify_template_vars'	=> 'set_posting_template_vars',
		];
	}

	/**
	 * Register the extension's language file on every page.
	 *
	 * @param \phpbb\event\data $event Event object
	 * @return void
	 */
	public function load_language_on_setup($event)
	{
		$lang_set_ext = $event['lang_set_ext'];
		$lang_set_ext[] = [
			'ext_name' => 'ecyaz/postlengthreminder',
			'lang_set' => 'common',
		];
		$event['lang_set_ext'] = $lang_set_ext;
	}

	/**
	 * Expose the configured minimum length and reminder message to the
	 * posting screen so the template event's script can use them.
	 *
	 * @param \phpbb\event\data $event Event object
	 * @return void
	 */
	public function set_posting_template_vars($event)
	{
		$message = (string) $this->config['postlengthreminder_message'];

		if ($message === '')
		{
			$message = $this->language->lang('POSTLENGTHREMINDER_DEFAULT_MESSAGE');
		}

		$page_data = $event['page_data'];
		$page_data['POSTLENGTHREMINDER_MIN_CHARS'] = (int) $this->config['postlengthreminder_min_chars'];
		$page_data['POSTLENGTHREMINDER_MESSAGE'] = $message;
		$event['page_data'] = $page_data;
	}
}
