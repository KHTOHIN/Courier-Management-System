<?php 
session_start();
ob_start();

define("INC_ROOT", dirname(__DIR__) . "/likhon");
define("URL", "http://localhost/likhon");

require_once INC_ROOT . '/app/db.php';
require_once INC_ROOT . '/app/functions.php';
require_once INC_ROOT . '/vendor/autoload.php';
require_once INC_ROOT . '/app/validation.php';
require_once INC_ROOT . '/app/map.php';
require_once INC_ROOT . '/app/mailer.php';