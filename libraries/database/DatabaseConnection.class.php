<?php

class Database{

	private $host = '****';
	private $dbUser = '****';
	private $dbPassword = '****';
	private $database = '****';

	public function __construct(){
		$this->dbConnection = mysqli_connect($this->host, $this->dbUser, $this->dbPassword, $this->database);
		if ($this->dbConnection->connect_errno) {
			die('Connection Error: '.$this->dbConnection->connect_errno);
		}
	}
	
	public function getConnection(){
		return $this->dbConnection;
	}
	
	public function close(){
	    $this->dbConnection->close();
	}
	
	public function sanitizeInput($input){
		return mysqli_real_escape_string($this->dbConnection,$input);
	}
	
}
	
?>