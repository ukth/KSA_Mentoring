<?php
if (!defined('__Mentoring__')) {
	header('Location: ./../');
	exit();
}

class Util {
	public function convert_to_json($data) {
		if ($data === null || count($data) == 0)
			return '';
		else
			return json_encode($data);
	}
}
?>