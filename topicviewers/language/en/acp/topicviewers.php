<?php
/**
 *
 * Topic Viewers. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2026 ECYaz
 * @license GNU General Public License, version 2 (GPL-2.0-only)
 *
 */

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = [];
}

$lang = array_merge($lang, [
	'ACP_TOPICVIEWERS_EXPLAIN'			=> 'Show how many registered users and guests are currently viewing each topic. The figures appear next to the “Who is online” list at the bottom of the topic.',
	'ACP_TOPICVIEWERS_SAVED'			=> 'Topic Viewers settings have been saved successfully.',

	'ACP_TOPICVIEWERS_ENABLE'			=> 'Show viewers on topics',
	'ACP_TOPICVIEWERS_ENABLE_EXPLAIN'	=> 'If set to “Yes”, the number of people viewing a topic is displayed on the topic page.',

	'ACP_TOPICVIEWERS_DISPLAY'			=> 'Display style',
	'ACP_TOPICVIEWERS_DISPLAY_EXPLAIN'	=> 'Choose whether to show only the counts, or to also list the names of the registered users. Members who hide their online status are never listed or counted.',
	'ACP_TOPICVIEWERS_DISPLAY_COUNTS'	=> 'Counts only',
	'ACP_TOPICVIEWERS_DISPLAY_NAMES'	=> 'Counts and member names',
]);
