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
	'UCP_PHPBBAPIHOOK_TITLE'			=> 'API 憑證',
	'UCP_PHPBBAPIHOOK_MANAGE'			=> '管理 API 憑證',

	// Page headings
	'UCP_PHPBBAPIHOOK_KEYS_TITLE'		=> '您的 API 憑證',
	'UCP_PHPBBAPIHOOK_ADD_TITLE'		=> '產生新憑證',
	'UCP_PHPBBAPIHOOK_EDIT_TITLE'		=> '編輯憑證',
	'UCP_PHPBBAPIHOOK_LOG_TITLE'		=> '憑證使用紀錄',

	// Table column headers
	'UCP_PHPBBAPIHOOK_COL_NAME'			=> '名稱',
	'UCP_PHPBBAPIHOOK_COL_PREFIX'		=> '前綴',
	'UCP_PHPBBAPIHOOK_COL_STATUS'		=> '狀態',
	'UCP_PHPBBAPIHOOK_COL_RATE'			=> '速率限制',
	'UCP_PHPBBAPIHOOK_COL_EXPIRES'		=> '過期時間',
	'UCP_PHPBBAPIHOOK_COL_LAST_USED'	=> '最後使用',
	'UCP_PHPBBAPIHOOK_COL_ACTIONS'		=> '操作',

	// Status labels
	'UCP_PHPBBAPIHOOK_ENABLED'			=> '已啟用',
	'UCP_PHPBBAPIHOOK_DISABLED'			=> '已停用',
	'UCP_PHPBBAPIHOOK_READ_ONLY'		=> '唯讀',
	'UCP_PHPBBAPIHOOK_READ_WRITE'		=> '讀取/寫入',
	'UCP_PHPBBAPIHOOK_NEVER'			=> '從未',
	'UCP_PHPBBAPIHOOK_UNLIMITED'		=> '無限制',

	// Field labels
	'UCP_PHPBBAPIHOOK_KEY_NAME'			=> '憑證名稱',
	'UCP_PHPBBAPIHOOK_KEY_NAME_EXPLAIN'	=> '為了方便辨識而設定的名稱。',
	'UCP_PHPBBAPIHOOK_FORUM_IDS'		=> '允許存取的版塊 ID',
	'UCP_PHPBBAPIHOOK_FORUM_IDS_EXPLAIN'	=> '請用逗號分隔版塊 ID。留空代表允許存取所有版塊。',
	'UCP_PHPBBAPIHOOK_IP_ALLOWLIST'		=> 'IP 白名單',
	'UCP_PHPBBAPIHOOK_IP_ALLOWLIST_EXPLAIN'	=> '允許連線的 IP，用逗號分隔。留空代表允許任何 IP。',
	'UCP_PHPBBAPIHOOK_READ_ONLY_FIELD'	=> '唯讀模式',
	'UCP_PHPBBAPIHOOK_READ_ONLY_EXPLAIN'	=> '勾選後，此憑證將只能進行讀取 (GET) 操作，無法發文。',
	'UCP_PHPBBAPIHOOK_IS_ENABLED'		=> '啟用憑證',
	'UCP_PHPBBAPIHOOK_IS_ENABLED_EXPLAIN'	=> '取消勾選可暫時停用此憑證。',

	// Log column headers
	'UCP_PHPBBAPIHOOK_LOG_COL_TIME'		=> '時間',
	'UCP_PHPBBAPIHOOK_LOG_COL_IP'		=> 'IP 位址',
	'UCP_PHPBBAPIHOOK_LOG_COL_METHOD'	=> '請求方法',
	'UCP_PHPBBAPIHOOK_LOG_COL_ROUTE'	=> '路由',
	'UCP_PHPBBAPIHOOK_LOG_COL_ACTION'	=> '動作',
	'UCP_PHPBBAPIHOOK_LOG_COL_STATUS'	=> '狀態碼',
	'UCP_PHPBBAPIHOOK_LOG_COL_DETAIL'	=> '詳細資訊',
	'UCP_PHPBBAPIHOOK_LOG_EMPTY'		=> '此憑證目前沒有任何使用紀錄。',

	// Action links
	'UCP_PHPBBAPIHOOK_ACTION_EDIT'		=> '編輯',
	'UCP_PHPBBAPIHOOK_ACTION_ENABLE'	=> '啟用',
	'UCP_PHPBBAPIHOOK_ACTION_DISABLE'	=> '停用',
	'UCP_PHPBBAPIHOOK_ACTION_DELETE'	=> '刪除',
	'UCP_PHPBBAPIHOOK_ACTION_VIEWLOG'	=> '檢視紀錄',
	'UCP_PHPBBAPIHOOK_ACTION_ADD'		=> '產生新憑證',
	'UCP_PHPBBAPIHOOK_BACK_TO_LIST'		=> '回到憑證列表',

	// New token notice (shown once after creation)
	'UCP_PHPBBAPIHOOK_TOKEN_NOTICE'		=> 'API 憑證已產生 — 請立即妥善保存',
	'UCP_PHPBBAPIHOOK_TOKEN_WARNING'	=> '<strong>這把鑰匙只會顯示這唯一的一次。</strong>請立刻將它複製並安全保存，離開此頁面後將無法再次檢視。',
	'UCP_PHPBBAPIHOOK_TOKEN_LABEL'		=> 'API Token',

	// Success / error messages
	'UCP_PHPBBAPIHOOK_ADDED'			=> 'API 憑證已成功產生。',
	'UCP_PHPBBAPIHOOK_UPDATED'			=> 'API 憑證已成功更新。',
	'UCP_PHPBBAPIHOOK_DELETED'			=> 'API 憑證已成功刪除。',
	'UCP_PHPBBAPIHOOK_NOT_FOUND'		=> '找不到您請求的 API 憑證，或您沒有權限存取。',
	'UCP_PHPBBAPIHOOK_CONFIRM_DELETE'	=> '您確定要永久刪除此 API 憑證嗎？',
	'UCP_PHPBBAPIHOOK_NO_KEYS'			=> '您目前尚未產生任何 API 憑證。',
	'UCP_PHPBBAPIHOOK_LIMIT_REACHED'	=> '您已達到 API 憑證數量的上限 (2 把)。若要產生新憑證，請先刪除舊的憑證。',
]);
