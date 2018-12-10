<?php

	require_once('../libraries/database/DatabaseConnection.class.php');
	require_once('../libraries/json/Json.class.php');
	
	header('Access-Control-Allow-Origin:*');
	header('Access-Control-Allow-Methods: POST, GET');
	header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With');
	header('Access-Control-Allow-Credentials: true');
	header("Content-Type: application/json");
	
	$type = filter_input(INPUT_POST, 'type', FILTER_DEFAULT);
	$search = filter_input(INPUT_POST, 'search', FILTER_DEFAULT);	
	$jsonCall = new Json($type,$search, $_POST);	
	print_r($jsonCall->getJsonObject());