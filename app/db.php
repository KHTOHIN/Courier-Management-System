<?php

define("DSN", "mysql:host=localhost;dbname=couriermanagementsystem");
define("USER", "root");
define("PASS", "");



try{
	
	$connection = new PDO(DSN, USER, PASS);
	
}catch(PDOException $e){
	
	echo $e->getMessage();
}

function passCheck($email, $pass){
	global $connection;

	$statment = $connection->prepare("SELECT `pass` FROM `user` WHERE `email` = :email");
	$done = $statment->execute(array(
			"email" => $email
		));
	$dbPass = $statment->fetch();
	return password_verify($pass, $dbPass['pass']);
}

function getUserByEmail($email){

	global $connection;

	$statment = $connection->prepare("SELECT * FROM `user` WHERE `email` = :email");
	$get = $statment->execute(array(
		"email" => $email
	));

	return $statment->fetch();
}

function getUserById($id){

	global $connection;

	$statment = $connection->prepare("SELECT * FROM `user` WHERE `id` = :id");
	$get = $statment->execute(array(
		"id" => $id
	));

	return $statment->fetch();
}

function trackIdGenarate(){

	global $connection;

	$statment = $connection->prepare("SELECT * FROM `courier_details`");
	$get = $statment->execute();
	$branches = $statment->fetchAll();

    $branchID = end($branches)["courier_details_id"];

    if(sizeof($branches) == 0){
        $branchID = "SRP10001";
    }

	$id = explode("P", $branchID);
	$code = current($id);

	$idNumber = (int) end($id);
	$idNumber++ ;

	return $code."P".$idNumber;
}