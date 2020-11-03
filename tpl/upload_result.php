<?php
if (!defined('__Mentoring__')) {
	header('Location: ./../');
	exit();
}

if ($_COOKIE['id'] == $_POST['sid']) {
	$sid = $_COOKIE['id'];

}
?>
<?php echo $message; ?>
<div class="page-header">
	<h1>KSA 멘토링 시스템</h1>
</div>
<div id="message"></div>
	<div class="panel panel-primary">
		<div class="panel-heading" style="font-size:16px"><span class="glyphicon glyphicon-ok"></span> &nbsp; 사진 업로드</div>
		<div class="panel-body">
			<?php
			$time = date("Y-m-d H:i:s");
			$inputTime = strtotime($_POST['time']);
			if (substr($_POST['time'],0,2)>=0 && substr($_POST['time'],0,2)<9){
				//echo substr($_POST['time'],0,2);
				$inputTime+=86400;
			}
			$timeDif = $inputTime - strtotime($time);

			ini_set("display_errors", "1");
			$uploaddir = '/var/www/html/mentoring/images/'.$mno.'/';
			$uploadfile = $uploaddir.basename($inputTime.'.jpg');
			$validTime = true;
			/*
			if ($timeDif<32400+100){
				if (!$class['teaching']){
					$validTime = true;
				}else if($oModel->getLastTime($mno)[0]=='1' && $inputTime - $oModel->getLastTime($mno)[1]>0){
					$validTime = true;
				}

			}
			*/ //2020.04.13 비활성화
			if (substr($image['type'],0,5)=="image" && $validTime && strlen($location)<50){
				if(move_uploaded_file($image['tmp_name'],$uploadfile)){
					$result = $oModel->uploadClass($mno,$class['teaching'],$inputTime,$location);
					//echo $result;
					//var_dump($result);
					if($result){
						if($class['teaching']){$state = '종료';}else{$state = '시작';}
						echo $class['subj_name'].'의 수업이 정상적으로 '.$state.'되었습니다.';
					}else{
						echo '데이터베이스 문제로 업로드되지 않았습니다,';
                                		echo '정보부에 문의하세요.';
					}
				}else{
					echo '사진 업로드에 실패했습니다,';
                                       	echo '정보부에 문의하세요.';
				}
			}else{
				$error_code=0;
				if(substr($image['type'],0,5)!="image"){$error_code=$error_code+1;}
				if(!$validTime){$error_code=$error_code+10;}
				if(strlen($location)>=50){$error_code=$error_code+100;}
				echo '파일이 정상적으로 업로드되지 않았습니다, 올바르지 않은 파일이거나 시간, 또는 너무 긴 장소일 수 있습니다.';
				echo '맞게 입력했는데도 이런 경우, 정보부에 문의하세요.<br>';
				echo 'ERROR CODE:'.$error_code;
			}
			?>
		</div>
	</div>
