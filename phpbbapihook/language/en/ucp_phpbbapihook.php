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
	// Module title / navigation
	'UCP_PHPBBAPIHOOK_TITLE'			=> 'API Tokens',
	'UCP_PHPBBAPIHOOK_MANAGE'			=> 'Manage API Tokens',

	// Page headings
	'UCP_PHPBBAPIHOOK_KEYS_TITLE'		=> 'Your API Tokens',
	'UCP_PHPBBAPIHOOK_ADD_TITLE'		=> 'Generate New Token',
	'UCP_PHPBBAPIHOOK_EDIT_TITLE'		=> 'Edit Token',
	'UCP_PHPBBAPIHOOK_LOG_TITLE'		=> 'Token Usage Log',

	// Table column headers
	'UCP_PHPBBAPIHOOK_COL_NAME'			=> 'Name',
	'UCP_PHPBBAPIHOOK_COL_PREFIX'		=> 'Prefix',
	'UCP_PHPBBAPIHOOK_COL_STATUS'		=> 'Status',
	'UCP_PHPBBAPIHOOK_COL_RATE'			=> 'Rate Limit',
	'UCP_PHPBBAPIHOOK_COL_EXPIRES'		=> 'Expires',
	'UCP_PHPBBAPIHOOK_COL_LAST_USED'	=> 'Last Used',
	'UCP_PHPBBAPIHOOK_COL_ACTIONS'		=> 'Actions',

	// Status labels
	'UCP_PHPBBAPIHOOK_ENABLED'			=> 'Enabled',
	'UCP_PHPBBAPIHOOK_DISABLED'			=> 'Disabled',
	'UCP_PHPBBAPIHOOK_READ_ONLY'		=> 'Read-only',
	'UCP_PHPBBAPIHOOK_READ_WRITE'		=> 'Read/Write',
	'UCP_PHPBBAPIHOOK_NEVER'			=> 'Never',
	'UCP_PHPBBAPIHOOK_UNLIMITED'		=> 'Unlimited',

	// Field labels
	'UCP_PHPBBAPIHOOK_KEY_NAME'			=> 'Token Name',
	'UCP_PHPBBAPIHOOK_KEY_NAME_EXPLAIN'	=> 'A human-readable label for this API token.',
	'UCP_PHPBBAPIHOOK_FORUM_IDS'		=> 'Allowed Forum IDs',
	'UCP_PHPBBAPIHOOK_FORUM_IDS_EXPLAIN'	=> 'Comma-separated forum IDs this token may access. Leave blank to allow all accessible forums.',
	'UCP_PHPBBAPIHOOK_IP_ALLOWLIST'		=> 'IP Allowlist',
	'UCP_PHPBBAPIHOOK_IP_ALLOWLIST_EXPLAIN'	=> 'Comma or space-separated list of allowed client IPs. Leave blank to allow any IP.',
	'UCP_PHPBBAPIHOOK_READ_ONLY_FIELD'	=> 'Read-only',
	'UCP_PHPBBAPIHOOK_READ_ONLY_EXPLAIN'	=> 'If checked, this token may only perform read operations (GET requests).',
	'UCP_PHPBBAPIHOOK_IS_ENABLED'		=> 'Enabled',
	'UCP_PHPBBAPIHOOK_IS_ENABLED_EXPLAIN'	=> 'Uncheck to temporarily disable this token.',

	// Log column headers
	'UCP_PHPBBAPIHOOK_LOG_COL_TIME'		=> 'Time',
	'UCP_PHPBBAPIHOOK_LOG_COL_IP'		=> 'IP',
	'UCP_PHPBBAPIHOOK_LOG_COL_METHOD'	=> 'Method',
	'UCP_PHPBBAPIHOOK_LOG_COL_ROUTE'	=> 'Route',
	'UCP_PHPBBAPIHOOK_LOG_COL_ACTION'	=> 'Action',
	'UCP_PHPBBAPIHOOK_LOG_COL_STATUS'	=> 'Status',
	'UCP_PHPBBAPIHOOK_LOG_COL_DETAIL'	=> 'Detail',
	'UCP_PHPBBAPIHOOK_LOG_EMPTY'		=> 'No log entries found for this token.',

	// Action links
	'UCP_PHPBBAPIHOOK_ACTION_EDIT'		=> 'Edit',
	'UCP_PHPBBAPIHOOK_ACTION_ENABLE'	=> 'Enable',
	'UCP_PHPBBAPIHOOK_ACTION_DISABLE'	=> 'Disable',
	'UCP_PHPBBAPIHOOK_ACTION_DELETE'	=> 'Delete',
	'UCP_PHPBBAPIHOOK_ACTION_VIEWLOG'	=> 'View Log',
	'UCP_PHPBBAPIHOOK_ACTION_ADD'		=> 'Generate New Token',
	'UCP_PHPBBAPIHOOK_BACK_TO_LIST'		=> 'Back to tokens list',

	// New token notice (shown once after creation)
	'UCP_PHPBBAPIHOOK_TOKEN_NOTICE'		=> 'API Token Generated — Save It Now',
	'UCP_PHPBBAPIHOOK_TOKEN_WARNING'	=> '<strong>This is the only time this token will be displayed.</strong> Copy it now and store it securely. It cannot be recovered after you leave this page.',
	'UCP_PHPBBAPIHOOK_TOKEN_LABEL'		=> 'API Token',

	// Success / error messages
	'UCP_PHPBBAPIHOOK_ADDED'			=> 'API token generated successfully.',
	'UCP_PHPBBAPIHOOK_UPDATED'			=> 'API token updated successfully.',
	'UCP_PHPBBAPIHOOK_DELETED'			=> 'API token deleted successfully.',
	'UCP_PHPBBAPIHOOK_NOT_FOUND'		=> 'The requested API token could not be found or you do not have permission to access it.',
	'UCP_PHPBBAPIHOOK_CONFIRM_DELETE'	=> 'Are you sure you want to permanently delete this API token?',
	'UCP_PHPBBAPIHOOK_NO_KEYS'			=> 'You have not generated any API tokens yet.',
	'UCP_PHPBBAPIHOOK_LIMIT_REACHED'	=> 'You have reached the maximum number of allowed API tokens (2). Please delete an existing token before creating a new one.',
]);
