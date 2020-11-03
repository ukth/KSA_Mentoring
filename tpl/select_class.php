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
		<div class="panel-heading" style="font-size:16px"><span class="glyphicon glyphicon-ok"></span> &nbsp; 멘토링 선택</div>
		<div class="panel-body">
			업로드 가능한 멘토링은 다음과 같습니다.
			<form action="?page=upload" method="post">
				<?php
				$classes = $oModel->getClassList($session_info['id']);
				for($i = 0; $i < count($classes); $i++){
					echo '<li><label for="class'.$classes[$i][0].'"><input type="radio" id="class'.$classes[$i][0].'" name="mno" value="'.$classes[$i][0].'"> '.$classes[$i][1].'</label></li>';
				}
				?>
			<div align="center"><button type="submit" class="btn btn-primary">멘토링 선택</button></div>
			</form>
		</div>
	</div>

