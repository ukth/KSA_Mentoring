<?php
define('__XE__', true);
require_once('/data/www/html/xe/config/config.inc.php');
$oContext = &Context::getInstance();
$oContext->init();
$logged_info = Context::get('logged_info');
if ($logged_info) {
	setcookie('id', $logged_info->user_id, time() + 24 * 3600, '/mentoring');
	setcookie('key', hash('sha512', hash('sha512', hash('sha512', '###'.$logged_info->user_id.'###'))), time() + 24 * 3600, '/mentoring');
	header('Location: ./../');
}
else
	header('Location: /xe');
$oContext->close(); 
?>
