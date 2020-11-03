<?php
//$mentors = array('16-047', '15-017');
$mentors = array('19-025');
$mno = isset($_POST['mno']) ? $_POST['mno'] : '0';
include_once('tpl/header.php');
if (!in_array($id, $mentors)){
	include_once('tpl/main.php');
}elseif ($mno == '0'){
	include_once('tpl/select_class.php');
}else{
	$class = $oModel->getClass($_POST['mno']);
	if ($image != '0'){
		include_once('tpl/upload_result.php');
	}else{
		include_once('tpl/upload.php');
	}
}
include_once('tpl/footer.php');
