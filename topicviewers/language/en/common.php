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
	'TOPICVIEWERS_VIEWING'	=> 'Viewing this topic:',
	'TOPICVIEWERS_AND'		=> 'and',

	'TOPICVIEWERS_GUESTS'	=> [
		1	=> '%d guest',
		2	=> '%d guests',
	],
	'TOPICVIEWERS_REGISTERED_USERS'	=> [
		1	=> '%d registered user',
		2	=> '%d registered users',
	],
]);
