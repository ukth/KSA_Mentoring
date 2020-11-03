<?php
define('__ROOM__', '0.1.0');
require_once('./../core/init.php');

$session_info = $oModel->getSession();
if (!$session_info['auth']) {
	header('Location: ./../login');
	exit();
}

if (config::$forbidview && !(in_array($id,config::$allowUsers))) {
	header('Location: ./../../');
	exit();
}

if ($_COOKIE["lang_type"] == "en") {
	setcookie("lang_type", "ko", 0, "/");
} else {
	setcookie("lang_type", "en", 0, "/");
}

header("Location: ".$_SERVER["HTTP_REFERER"]);
?>