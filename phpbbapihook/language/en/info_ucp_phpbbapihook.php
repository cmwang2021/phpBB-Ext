<?php
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = [];
}

$lang = array_merge($lang, [
	'UCP_PHPBBAPIHOOK_TITLE'			=> 'API Tokens',
	'UCP_PHPBBAPIHOOK_MANAGE'			=> 'Manage API Tokens',
]);
