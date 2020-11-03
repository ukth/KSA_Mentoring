<?php
if (!defined('__Mentoring__')) {
	header('Location: ./../');
	exit();
}
define('_ROOM_PATH_', '/data/www/html/mentoring/');
require_once(_ROOM_PATH_.'core/config.php');
require_once(_ROOM_PATH_.'core/DBEngine.php');
require_once(_ROOM_PATH_.'core/Model.php');
require_once(_ROOM_PATH_.'core/Util.php');
config::init();
$id = isset($_COOKIE['id']) ? $_COOKIE['id'] : null;
$key = isset($_COOKIE['key']) ? $_COOKIE['key'] : null;

$oModel = new Model($id, $key);
?>
