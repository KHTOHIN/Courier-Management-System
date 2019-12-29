<?php 

require_once 'init.php';


function trackIdGenarate(){

	global $connection;

	$statment = $connection->prepare("SELECT * FROM `courier_details`");
	$get = $statment->execute();
	$branches = $statment->fetchAll();

	$id = explode("P", end($branches)["courier_details_id"]);

	$code = current($id);

	$idNumber = (int) end($id);
	$idNumber++ ;

	return $code."P".$idNumber;
}

dump(trackIdGenarate());