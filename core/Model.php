<?php
if (!defined('__Mentoring__')) {
	header('Location: ./../');
	exit();
}

class Model {
	private $oDB;
	private $account;

	public function __construct($id, $key) {
		$this->makeSession($id, $key);
		$this->oDB = new DBEngine();
		$this->oDB->execute("SET NAMES 'utf8'", array());
	}

	private function makeSession($id, $key) {
		if ($key == hash('sha512', hash('sha512', hash('sha512', '###'.$id.'###'))))
			$this->account = array('auth' => true, 'id' => $id);
		else
			$this->account = array('auth' => false, 'id' => '#ANON#');
	}

	public function getSession() {
		return $this->account;
	}

	public function getClassList($sid){
		$class_list = $this->oDB->execute("SELECT mno, subj_name, subj_id FROM `class` WHERE sid = ?", array($sid));
		if($class_list == false){
			return array(); // 멘토가 아님
		}
		$result = array();
		foreach($class_list as $class){
			array_push($result, array($class['mno'],$class['subj_name'],$class['subj_id']));
		}
		return $result;
	}
	public function getClass($mno){
                $class = $this->oDB->execute("SELECT * FROM `class` WHERE mno = ?", array($mno));
                if($class == false){
                        return 'Error:empty class'; // 멘토가 아님
                }
                return $class[0];
        }
	public function uploadClass($mno,$teaching,$time,$location){
		if($teaching){$s = '0';}
		else{$s = '1';}
                $result = $this->oDB->execute("UPDATE `class` set teaching = ?, location = ? WHERE mno = ?", array($s,$location,$mno));
                if($result == false){
                        return false; // 실패
                }
		$result = $this->oDB->execute("INSERT INTO `log` (mno,time,value,location) VALUES (?,?,?,?)", array($mno,$time,$s,$location));
                if($result == false){
                        return array($mno,$teaching,$time);
			return false; // 실패
                }
                return 1;
        }
	public function getTimeLog($mno){
                $result = $this->oDB->execute("SELECT * FROM `log` WHERE mno = ? ORDER BY id", array($mno));
		if($result == false){
                        return false; // 실패
                }
                return $result;
        }

	public function getLastTime($mno){
		$timeLog = $this->getTimeLog($mno);
		if($timeLog == false){
			return false;
		}
		return array($timeLog[count($timeLog)-1]['value'],$timeLog[count($timeLog)-1]['time']);

	}

	public function getMentorList($classify){
                $result = $this->oDB->execute("SELECT * FROM `class` WHERE classify = ?", array($classify));
                if($result == false){
                        return false; // 실패
                }
                return $result;
        }

	private static function isQuerySafe() {
		$arg_list = func_get_args();
		$ban_list = array(";", "'", "@", "#", "$", "*", "<", ">", '\\', '"');

		foreach ($arg_list as $arg)
			foreach ($ban_list as $ban)
				if (strpos($arg, $ban) !== false)
					return false;
		return true;
	}
}
?>
