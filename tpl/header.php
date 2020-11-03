<?php
if (!defined('__Mentoring__')) {
	header('Location: ./../');
	exit();
}
?>
<!DOCTYPE html>
<html lang="ko">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="한국과학영재학교 멘토링 시스템">
		<meta name="author" content="Seungwook Seo">

		<title>KSA 멘토링 시스템</title>
		<link href="res/css/bootstrap.css" rel="stylesheet" media="screen">
		<link href="res/css/custom.css" rel="stylesheet" media="screen">
		<link href="res/css/room.css" rel="stylesheet" media="screen">
		<script type="text/javascript" src="res/js/jquery.min.js"></script>
		<script type="text/javascript">
			// var dorm_name = '<?php echo $dorm_name?>';
			// var grade = '<?php echo $grade?>';
			// var floor = <?php echo $floor?>;
			// var sex = <?php echo $sex?>;
			// var canreg = <?php echo ($canreg) ? 'true' : 'false'?>;
			// <?php echo $dorm_data?>
		</script>
		<script type="text/javascript" src="res/js/bootstrap.js"></script>
	</head>
	<body>
		<header class="room-header">
			<nav class="navbar navbar-default navbar-fixed-top gl-navbar" role="navigation">
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
							<span class="sr-only">Enable Navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="./">멘토링</a>
					</div>
					<div class="collapse navbar-collapse">
						<ul class="nav navbar-nav">
							<li><a href="?page=main">Main</a></li>
							<li><a href="?page=upload">Upload</a></li>
							<li><a href="?page=mentors">Mentors</a></li>
							<!--<li><a href="?page=checkin">Check in</a></li>-->
						</ul>
						<p class="navbar-text navbar-right"><a href="./logout" >Logout (<?php echo $session_info['id']; ?>)</a></p>
						<p class="navbar-text navbar-right"><a href="./change-language">한국어/English</a></p>
					</div>
				</div>
			</nav>
		</header>
		<div class="container">
