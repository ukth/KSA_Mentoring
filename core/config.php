<?php
if (!defined('__ROOM__')) {
	header('Location: ./../');
	exit();
}

class config {
	public static $db = array(
		'user' => '####',
		'pw' => '####',
		'db' => '####'
	);
	public static $forbidview = false;
	public static $allowUsers = array('intel', '16-047', '17-085');
public static function init() {}
}
?>
