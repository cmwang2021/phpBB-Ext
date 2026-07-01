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
	'UCP_PHPBBAPIHOOK_TITLE'			=> 'API 憑證',
	'UCP_PHPBBAPIHOOK_MANAGE'			=> '管理 API 憑證',
]);
