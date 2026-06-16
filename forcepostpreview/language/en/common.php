<?php
/**
 *
 * Force Post Preview. An extension for the phpBB Forum Software package.
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
	'FPP_PREVIEW_REQUIRED' => 'Please preview your post before submitting.',
]);
