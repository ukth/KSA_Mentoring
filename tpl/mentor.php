<?php
//error_reporting(E_ALL);

//ini_set("display_errors", 1);
if (!defined('__Mentoring__')) {
	header('Location: ./../');
	exit();
}

if ($_COOKIE['id'] == $_POST['sid']) {
	$sid = $_COOKIE['id'];
}

$class = $oModel->getClass($mno);
$timeLog = $oModel->getTimeLog($mno);
if(!$timeLog){
	$hour = 0;
	$min = 0;
}else{
	$totalTime = 0;
	$l = count($timeLog);
	for( $i=0; $i < ($l-($l%2))/2; $i++){
		if ($timeLog[$i*2]['value']!='1'){return false;}
		$totalTime+=$timeLog[$i*2+1]['time'] - $timeLog[$i*2]['time'];
	}
	$hour = ($totalTime-$totalTime%3600)/3600;
	$totalTime -= $hour*3600;
	$min = ($totalTime-$totalTime%60)/60;
}
?>
<?php echo $message;?>
<div class="page-header">
	<h1>총 <?php echo $hour.'시간 '.$min.'분'; ?> <small><?php echo $class['sid'].'('.$class['location'].')'.' '.$class['subj_name']; ?></small></h1>
</div>
<div id="message"></div>
	<div class="form-group">
	<div class="panel panel-primary">
		<div class="panel-heading" style="font-size:16px"><span class="glyphicon glyphicon-ok"></span> &nbsp; 수업 기록</div>
		<div class="panel-body">
		<?php
		if(!$timeLog){
        		echo '아직 등록된 수업이 없습니다.<br>수업 이후에도 이 메세지가 나타난다면 정보부에 문의하세요.';
		}else{
			$w = 420;
			for($i=0; $i<($l-$l%2)/2; $i++){
				$simage = 'images/'.$mno.'/'.$timeLog [$i*2]['time'].'.jpg';
				$eimage = 'images/'.$mno.'/'.$timeLog [$i*2+1]['time'].'.jpg';
				$ssize = getImageSize($simage);
				$esize = getImageSize($eimage);
				echo date("Y-m-d / g:i a", $timeLog[$i*2]['time']).'~'.date("Y-m-d / g:i a", $timeLog[$i*2+1]['time']).'<br>';
				echo '<img src="'.$simage.'" height="'.$w*($ssize[1]/$ssize[0]).'" width="'.$w.'" /> ';
				echo '<img src="'.$eimage.'" height="'.$w*($esize[1]/$esize[0]).'" width="'.$w.'" /><br><br>';
			}
			if($l%2==1){
				$image = 'images/'.$mno.'/'.$timeLog[$l-1]['time'].'.jpg';
				$size = getImageSize($image);
				echo date("Y-m-d / g:i a", $timeLog[$l-1]['time']).'~<br>';
				echo '<img src="'.$image.'" height="'.$w*($size[1]/$size[0]).'" width="'.$w.'" /><br>';
			}
		}
		?>
		</div>
	</div>
