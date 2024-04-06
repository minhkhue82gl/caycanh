<?php
class DBController {
	private $host = "localhost";
	private $user = "root";
	private $password = "";
	private $database = "caycanh1";
	private $conn;
	
	function __construct() {
		$this->conn = $this->connectDB();
	}
	
	function connectDB() {
		$conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
		return $conn;
	}
	
	function runQuery($query) {
		$result = mysqli_query($this->conn, $query);
		if ($result === false) {
			return false;
		}
	
		if ($result === true) {
			return true;
		}
	
		$resultset = array();
		while ($row = mysqli_fetch_assoc($result)) {
			$resultset[] = $row;
		}
		return $resultset;
	}
	public function getLastInsertedId() {
        return mysqli_insert_id($this->conn);
    }

	function numRows($query) {
		$result  = mysqli_query($this->conn,$query);
		$rowcount = mysqli_num_rows($result);
		return $rowcount;	
	}
}
?>