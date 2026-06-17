<?php
/**
 *
 * Post Length Reminder. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2026 ECYaz
 * @license GNU General Public License, version 2 (GPL-2.0-only)
 *
 */

if (!defined('IN_PHPBB'))
{
	exit;
}

$lang = array_merge($lang ?? [], [
	// Posting screen (front-end)
	'POSTLENGTHREMINDER_DEFAULT_MESSAGE'	=> 'This post is really short. Do you want to expand on it before posting?',
	'POSTLENGTHREMINDER_CONFIRM_TITLE'		=> 'Are you sure?',
	'POSTLENGTHREMINDER_KEEP_EDITING'		=> 'Keep editing',
	'POSTLENGTHREMINDER_POST_ANYWAY'		=> 'Post anyway',

	// ACP module
	'ACP_POSTLENGTHREMINDER_TITLE'			=> 'Post Length Reminder',
	'ACP_POSTLENGTHREMINDER_SETTINGS'		=> 'Post Length Reminder settings',
	'ACP_POSTLENGTHREMINDER_EXPLAIN'		=> 'Warn users before they submit a post shorter than a chosen number of characters, giving them a chance to expand it first.',
	'ACP_POSTLENGTHREMINDER_SAVED'			=> 'Post Length Reminder settings have been saved.',

	'POSTLENGTHREMINDER_MIN_CHARS'			=> 'Minimum post length',
	'POSTLENGTHREMINDER_MIN_CHARS_EXPLAIN'	=> 'If a post has fewer characters than this, the user is asked to confirm before submitting. Set to <strong>0</strong> to turn the reminder off.',
	'POSTLENGTHREMINDER_MESSAGE'			=> 'Reminder message',
	'POSTLENGTHREMINDER_MESSAGE_EXPLAIN'	=> 'The text shown in the confirmation dialog. Leave blank to use the default message.',
]);
