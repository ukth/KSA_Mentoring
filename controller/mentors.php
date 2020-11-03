<?php
$mno = isset($_GET['mno']) ? $_GET['mno'] : '0';
$image = isset($_FILES['image']) ? $_FILES['image'] : '0';
include_once('tpl/header.php');
if ($mno == '0'){
	include_once('tpl/select_mentor.php');
}else{
	include_once('tpl/mentor.php');
}
include_once('tpl/footer.php');
?>
