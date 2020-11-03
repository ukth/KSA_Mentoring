<?php
if (!defined('__Mentoring__')) {
	header('Location: ./../');
	exit();
}

class DBEngine {
	private $db;
	private $autocommit = true;
	private $connected = false;
	
	public function __construct() {
		$this->connect();
	}
	
	public function __destruct() {
        $this->close();
    }

	public function connect() {
		if ($this->connected) return false;
		
		$this->db= new mysqli('localhost', config::$db['user'], config::$db['pw'], config::$db['db']);
		if ($this->db->connect_errno) return false;
		$this->connected = true; return true;
	}
	
	public function execute($query, $data = null, $commit = true) {
		if (!$this->connected && !$this->connect()) return false;
		if (!$commit) $this->transaction();
		
		if (!$stmt = $this->db->prepare($query)) return false;
		
		if (is_array($data))
			call_user_func_array(array($stmt, 'bind_param'), $this->makeparams($data));
		
		$stmt->execute();

		$isselect = (substr($query, 0, 6) == 'SELECT');
		return $this->getresult($stmt, $isselect);
	}
	
	public function transaction() {
		if (!$this->connected && !$this->connect()) return false;
		if (!$this->autocommit) return true;
		
		if (!$this->db->autocommit(false)) return false;
		$this->autocommit = false;
		return true;
	}
	
	public function commit() {
		if (!$this->connected || $this->autocommit) return false;
		if (!$this->db->commit()) return false;
		$this->autocommit = true;
		return true;
	}
	
	public function rollback() {
		if (!$this->connected || $this->autocommit) return false;
		if (!$this->db->rollback()) return false;
		$this->autocommit = true;
		return true;
	}
	
	public function close() {
		if (!$this->connected) return false;
		if (!$this->db->close()) return false;
		$this->connected = false; return true;
	}
	
	private function makeparams($data) {
		$params = array('');
		foreach ($data as $prop => $val) {
			$params[0] .= $this->getsqltype($val);
			$params[] = $data[$prop];
		}

		$refs = array();
		foreach ($params as $key => $value)
			$refs[$key] = &$params[$key];
		return $refs;
	}
	
	private function getsqltype($item) {
		switch (gettype($item)) {
			case 'NULL':
			case 'string': return 's'; break;
			case 'integer': return 'i'; break;
			case 'double': return 'd'; break;
			default: return '';
		}
	}
	
	private function getresult($stmt, $isselect) {
		$result = array();
		
		if ($isselect) {
			$row = array();
			$params = array();
			
			$meta = $stmt->result_metadata();
			while ($col = $meta->fetch_field()) {
				$row[$col->name] = null;
				$params[] = & $row[$col->name];
			}
			$meta->close();
			
			call_user_func_array(array($stmt, 'bind_result'), $params);

			while ($stmt->fetch()) {
				$rrow = array();
				foreach ($row as $key => $val)
					$rrow[$key] = $val;
				$result[] = $rrow;
			}
		}
		else
			$result = ($stmt->affected_rows > 0);

		$stmt->close();
		return $result;
	}
}
?>
