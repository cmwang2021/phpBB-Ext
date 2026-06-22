<?php
/**
 *
 * Topic Viewers. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2026 ECYaz
 * @license GNU General Public License, version 2 (GPL-2.0-only)
 *
 */

namespace ecyaz\topicviewers\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Counts the registered users and guests viewing the current topic and assigns
 * the result to the template, next to phpBB's "Who is online" list.
 */
class main_listener implements EventSubscriberInterface
{
	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\language\language */
	protected $language;

	/**
	 * Constructor.
	 *
	 * @param \phpbb\db\driver\driver_interface	$db			Database abstraction layer
	 * @param \phpbb\config\config				$config		Config object
	 * @param \phpbb\template\template			$template	Template object
	 * @param \phpbb\language\language			$language	Language object
	 */
	public function __construct(\phpbb\db\driver\driver_interface $db, \phpbb\config\config $config, \phpbb\template\template $template, \phpbb\language\language $language)
	{
		$this->db = $db;
		$this->config = $config;
		$this->template = $template;
		$this->language = $language;
	}

	/**
	 * {@inheritDoc}
	 */
	public static function getSubscribedEvents()
	{
		return [
			'core.user_setup'								=> 'load_language_on_setup',
			'core.viewtopic_assign_template_vars_before'	=> 'show_topic_viewers',
		];
	}

	/**
	 * Register the extension's language files on every page.
	 *
	 * @param \phpbb\event\data	$event	Event object
	 * @return void
	 */
	public function load_language_on_setup($event)
	{
		$lang_set_ext = $event['lang_set_ext'];
		$lang_set_ext[] = [
			'ext_name' => 'ecyaz/topicviewers',
			'lang_set' => 'common',
		];
		$event['lang_set_ext'] = $lang_set_ext;
	}

	/**
	 * Count who is viewing the current topic and assign the figures to the template.
	 *
	 * @param \phpbb\event\data	$event	Event object
	 * @return void
	 */
	public function show_topic_viewers($event)
	{
		if (empty($this->config['topicviewers_enable']))
		{
			return;
		}

		$topic_id = (int) $event['topic_id'];

		if ($topic_id <= 0)
		{
			return;
		}

		$show_names = !empty($this->config['topicviewers_show_names']);

		// Mirror core's "who is online" window: sessions touched within load_online_time minutes.
		$online_time = (int) $this->config['load_online_time'];
		$time = time() - (($online_time ?: 5) * 60);
		$time = $time - ($time % 60);

		// Coarse filter on the stored page; the exact topic id is verified in PHP below
		// because session_page can contain look-alikes such as "start=<topic_id>".
		$like = $this->db->sql_like_expression($this->db->get_any_char() . 't=' . $topic_id . $this->db->get_any_char());

		$sql = 'SELECT s.session_user_id, s.session_page, s.session_viewonline, u.username, u.user_colour
			FROM ' . SESSIONS_TABLE . ' s, ' . USERS_TABLE . ' u
			WHERE s.session_user_id = u.user_id
				AND s.session_time >= ' . (int) $time . '
				AND s.session_page ' . $like . ' ORDER BY u.username_clean ASC';
		$result = $this->db->sql_query($sql);

		$guest_count = 0;
		$members = [];

		while ($row = $this->db->sql_fetchrow($result))
		{
			if (!$this->page_matches_topic($row['session_page'], $topic_id))
			{
				continue;
			}

			if ((int) $row['session_user_id'] === ANONYMOUS)
			{
				$guest_count++;
				continue;
			}

			// Respect "hide my online status" — hidden members are never counted or listed.
			if (!(int) $row['session_viewonline'])
			{
				continue;
			}

			// Keyed by user id so a member with several sessions is only counted once.
			$members[(int) $row['session_user_id']] = [
				'username'	=> $row['username'],
				'colour'	=> $row['user_colour'],
			];
		}
		$this->db->sql_freeresult($result);

		$reg_count = count($members);

		$this->template->assign_vars([
			'S_TOPICVIEWERS'			=> true,
			'S_TOPICVIEWERS_NAMES'		=> $show_names,
			'TOPICVIEWERS_REG_COUNT'	=> $reg_count,
			'TOPICVIEWERS_GUEST_COUNT'	=> $guest_count,
			'TOPICVIEWERS_REGISTERED'	=> $this->language->lang('TOPICVIEWERS_REGISTERED_USERS', $reg_count),
			'TOPICVIEWERS_GUESTS'		=> $this->language->lang('TOPICVIEWERS_GUESTS', $guest_count),
		]);

		if ($show_names && $reg_count)
		{
			foreach ($members as $user_id => $data)
			{
				$this->template->assign_block_vars('topicviewers_member', [
					'USERNAME_FULL' => get_username_string('full', $user_id, $data['username'], $data['colour']),
				]);
			}
		}
	}

	/**
	 * Verify that a stored session_page is actually viewing the given topic.
	 *
	 * Parses the query string so that "t=<id>" matches exactly and look-alikes
	 * such as "start=<id>" do not. Handles both raw and HTML-encoded ampersands.
	 *
	 * @param string	$session_page	The session_page value from the sessions table
	 * @param int		$topic_id		The topic id to match against
	 * @return bool		True if the page is viewing this topic
	 */
	protected function page_matches_topic($session_page, $topic_id)
	{
		$query_pos = strpos($session_page, '?');

		if ($query_pos === false)
		{
			return false;
		}

		$query = html_entity_decode(substr($session_page, $query_pos + 1), ENT_QUOTES);
		parse_str($query, $params);

		return isset($params['t']) && (int) $params['t'] === (int) $topic_id;
	}
}
