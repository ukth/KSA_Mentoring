<?php
//$mentors = array('ksa18068', 'ksa19055');
$mentors = array('ksa19120','ksa19059','ksa19057','ksa19121','ksa19003','ksa19010','ksa19019','ksa18057','ksa18064','ksa18045','ksa18007','ksa18022','ksa18083','ksa19098','ksa19033','ksa19110','ksa19114','ksa19042','ksa19123','ksa19052','ksa19054','ksa18055','ksa18073','ksa19050','ksa19075','ksa19005','ksa19012','ksa19035','ksa19091','ksa18012','ksa20009','ksa18216','ksa18205','ksa18211','ksa20070','ksa20076','ksa19005','ksa19065','ksa19011','ksa19117','ksa19038','ksa19066','ksa19068','ksa19023','ksa19028','ksa19055','ksa20061','ksa20072','ksa20096','ksa19042','ksa19074','ksa19038','ksa19067','ksa19077','ksa19103');
$mno = isset($_POST['mno']) ? $_POST['mno'] : '0';
$image = isset($_FILES['image']) ? $_FILES['image'] : '0';
$location = isset($_POST['location']) ? $_POST['location'] : '수업 종료';
include_once('tpl/header.php');
if (!in_array($id, $mentors)){
	echo '<script type="text/javascript">alert(\'등록된 멘토가 아니시네요ㅠ 업로드 기능은 등록된 멘토만 사용할 수 있습니다. \');</script>';
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
?>
