<?php

require_once '../database/config.php';	


session_start();
$sessionId = session_id();
$_SESSION['tempuser'] = $_POST('username_login');
$_SESSION['temppass'] = $_POST('password_login');
$username = $_SESSION['tempuser'];
$password = $_SESSION['temppass'];
$javascript = '';
if(Auth::attempt($username, $password)){
header('Location: ads.index.php');
}else if ($username != "" || $password != ""){
	$javascript = 'alert("Incorrect input.")';
	session_destroy();
}

?>