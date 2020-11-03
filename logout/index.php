<?php
setcookie('id', '', time() - 500, '/mentoring');
setcookie('key', '', time() - 500, '/mentoring');
header('Location: http://gaonnuri.ksain.net/xe/index.php?mid=home&act=dispMemberLogout');
?>
