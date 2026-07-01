<?php
/**
 *
 * phpbbAPIhook. An extension for the phpBB Forum Software package.
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

// These keys label the extension's entry in the ACP navigation. phpBB loads any
// language/en/info_acp_*.php file from an enabled extension when it builds the
// ACP menu (includes/functions_module.php::add_mod_info), so the sidebar shows
// translated names instead of the raw language keys.
$lang = array_merge($lang, [
	'ACP_PHPBBAPIHOOK_TITLE'  => 'phpBB API Hook',
	'ACP_PHPBBAPIHOOK_MANAGE' => 'Manage API Keys',
]);
