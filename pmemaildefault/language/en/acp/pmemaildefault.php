<?php
/**
 *
 * PM Email Default. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2026 ECYaz
 * @license GNU General Public License, version 2 (GPL-2.0)
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
	'ACP_PMEMAILDEFAULT_TITLE'			=> 'PM Email Default',
	'ACP_PMEMAILDEFAULT_SETTINGS'		=> 'PM Email Default settings',
	'ACP_PMEMAILDEFAULT_SETTINGS_SAVED'	=> 'PM email notification settings saved successfully.',
	'ACP_PMEMAILDEFAULT_EXPLAIN'		=> 'Choose whether email notifications for incoming private messages are on or off by default. The chosen setting applies to newly registered users, and saving this form also applies it immediately to every existing member. Members can still change their own choice afterwards in their User Control Panel — until the next time you save this form, which will override it again.',

	'PMEMAILDEFAULT_MODE'			=> 'Default PM email notifications',
	'PMEMAILDEFAULT_MODE_EXPLAIN'	=> 'When set to On, members receive an email whenever they get a new private message. When set to Off, PM email is switched off for everyone.',
	'PMEMAILDEFAULT_ON'				=> 'On for all users',
	'PMEMAILDEFAULT_OFF'			=> 'Off for all users',
]);
