<?php 

function redirect($locatin){
	return header("Location: " . $locatin);
}


function setSessionMessage($key, $vlaue){
	$_SESSION[$key] = $vlaue;
}


function getSessionMessage($key){
	if (isset($_SESSION[$key])) {
		echo $_SESSION[$key];
		unset($_SESSION[$key]);
	}
}


function getMsg(){
	if (isset($_SESSION['msg'])) {
		echo $_SESSION['msg'];
		unset($_SESSION['msg']);
	}
}

function setMsg($msg){
	$_SESSION['msg'] = $msg;
}

function dump($input){
	echo "<pre>";
	var_dump($input);
	echo "</pre>";
}

function isLogin(){
	if(isset($_SESSION["id"]) && isset($_SESSION["login"]) && $_SESSION["login"] == true){
		return true;
	}
	return false;
}


