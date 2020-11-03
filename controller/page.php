<?php
if (!defined('__Mentoring__')) {
	header('Location: ./../');
	exit();
}

if ($page != 'code' && $page != 'main') $page = 'main';

include_once(_ROOM_PATH_.'tpl/header.php');

if ($page == 'main') {
	if ($_COOKIE['lang_type'] == 'en') {
		include_once(_ROOM_PATH_.'tpl/main_en.php');
	} else {
		include_once(_ROOM_PATH_.'tpl/main_ko.php');
	}
} else {
	include_once(_ROOM_PATH_.'tpl/'.$page.'.php');
}

include_once(_ROOM_PATH_.'tpl/footer.php');
?>
