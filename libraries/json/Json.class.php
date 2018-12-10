<?php

class Json{
	
	private $type;
	private $search;
	private $allData;
	private $jsonObject = array();
	
	function __construct($type, $search, $allData){
		$this->type = $type;
		$this->allData = $allData;
		$this->search = $search;
		$this->queryType();
	}	
	
	private function queryType(){
		switch(strtolower($this->type)){
			case "api":
				$this->apiData();
				break;
			case "getapi":
				$this->getApiData();
				break;
			default:
				$this->jsonObject = array("error" => "invalid type" , "type" => strtolower($this->type));
				break;
		}
	}	
	
	private function apiData(){
		$database = new Database;
		$cleanName = $database->sanitizeInput($this->allData['ownName']);
		$cleanaddress = $database->sanitizeInput($this->allData['address']);
		$cleanrealName = $database->sanitizeInput($this->allData['name']);
		$sql = "CALL saveDevice('$cleanName','$cleanaddress','$cleanrealName')";
		if(mysqli_query($database->getConnection(), $sql)){
			$this->jsonObject = array("saved" => "true");
		}else{
			$this->jsonObject = array("saved" => "nah");
		}
		$database->close();	
	
	}
	
	private function getApiData(){
		$database = new Database;
		$sql = "CALL getDevices()";
		$query = mysqli_query($database->getConnection(), $sql);
		while($row = mysqli_fetch_assoc($query)){
			array_push($this->jsonObject,$row);
		}
		$database->close();
	}

	public function getJsonObject(){
		return json_encode($this->jsonObject);
	}	
}