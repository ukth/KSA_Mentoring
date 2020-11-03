<?php
// error_reporting(E_ALL);

// ini_set("display_errors", 1);

define('__Mentoring__', '0.1.0');
require_once('core/init.php');
$session_info = $oModel->getSession();
if (!$session_info['auth']) {
	header('Location: ./login');
	exit();
}
$page = isset($_GET['page']) ? $_GET['page'] : 'main';
if ($page == 'upload')
	include_once('controller/upload.php');
else if ($page == 'mentors')
	include_once('controller/mentors.php');
else if ($page == 'checkin')
        include_once('controller/checkin.php');
else
	include_once('controller/page.php');
if (config::$forbidview && !(in_array($id,config::$allowUsers))) {
	header('Location: ./../');
	exit();
}
?>
