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

// These keys label the extension's entry in the ACP navigation. phpBB loads any
// language/en/info_acp_*.php file from an enabled extension when it builds the
// ACP menu, so the sidebar shows translated names instead of the raw keys.
$lang = array_merge($lang, [
	'ACP_TOPICVIEWERS_TITLE'	=> 'Topic Viewers',
	'ACP_TOPICVIEWERS_SETTINGS'	=> 'Topic Viewers settings',
]);
