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
	<h1>KSA 멘토링 시스템 <small>사진 업로드</small></h1>
</div>
<div id="message"></div>
	<div class="form-group">

	<div class="panel panel-primary">
		<div class="panel-heading" style="font-size:16px"><span class="glyphicon glyphicon-ok"></span> &nbsp; 사진 업로드</div>
		<div class="panel-body">
<?php
if($class['teaching']){
	$lastClass=$oModel->getLastTime($mno);
	$lastTime=intval($lastClass[2])+32400;
	$nowTime=time()+32400;
	$state = '종료';
	if(date("Y-m-d",$lastTime)!=date("Y-m-d",$nowTime)){
		//$oModel->deleteClass($lastClass[0]);
		//echo '날짜가 지나 지난 수업 데이터가 지워졌습니다.<br><br>';
		//$state = '시작';
	}else{$state = '종료';}
}
else{$state = '시작';}
?>
			활동 사진을 업로드하여 멘토링 활동 보고를 시작 및 종료합니다.<br>
			사진 업로드를 위하여 파일 선택 버튼을 클릭하여 주세요. <br>
			사진을 업로드 한 이후에는 현재 멘토링 진행 장소와 시작 시각(또는 종료 시각)을 입력하여 주세요.<br><br>
			<form method="post" action="?page=upload" enctype="multipart/form-data">
			<input type="hidden" value="30000" />
			<?php
			if($state=='시작'){
			echo '장소(10자 이내):<input type="text" name="location" /><br>';}?>
			사진:<input type="file" name="image" />
			<?php echo $state.'시간';?><input type="time" name="time" /><br>
			<p><input type="submit" class="btn btn-primary" value="<?php echo '멘토링 '.$state;?>" /></p>
			<input type="hidden" name="mno" value="<?php echo $_POST['mno'];?>" />
			</form>
		</div>
	</div>
