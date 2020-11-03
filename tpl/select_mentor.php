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
			아래는 현 학기 등록된 멘토들의 목록입니다.<br>
			현재 멘토링을 진행중인 멘토들의 경우, 괄호 안에 ‘수업 종료’ 대신 현재 장소가 표기됩니다.<br>
			멘토 이름을 클릭하여 해당 멘토의 멘토링 진행 현황 및 활동 보고 사진들을 확인할 수 있습니다.<br><br>
			<?php
			$academic_mentors = $oModel->getMentorList(0);
                        $master_mentors = $oModel->getMentorList(1);
                        
                        echo '<p class="text-primary" style="font-size:18px">학업 멘토링</p>';
			for($i = 0; $i < count($academic_mentors); $i++){
                                $location = '('.$academic_mentors[$i]['location'].')';
                                echo '<li><a href="?page=mentors&mno='.$academic_mentors[$i]['mno'].'">'.$academic_mentors[$i]['sid'].$location.'   '.$academic_mentors[$i]['subj_name'].'</a></li>';
                        }
                        echo '<br><p class="text-primary" style="font-size:18px"> 장인 멘토링</p>';
                        for($i = 0; $i < count($master_mentors); $i++){
                                $location = '('.$master_mentors[$i]['location'].')';
                                echo '<li><a href="?page=mentors&mno='.$master_mentors[$i]['mno'].'">'.$master_mentors[$i]['sid'].$location.'   '.$master_mentors[$i]['subj_name'].'</a></li>';
                        }
			?>
		</div>
	</div>

