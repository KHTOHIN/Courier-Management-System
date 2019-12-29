<?php
require_once 'start.php';

session_destroy();

redirect("login.php");