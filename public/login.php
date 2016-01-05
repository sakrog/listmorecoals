<?php

	require_once '../bootstrap.php';	

	session_start();
	$sessionId = session_id();
	$_SESSION['tempuser'] = $_POST['username_login'];
	$_SESSION['temppass'] = $_POST['password_login'];
	$username = $_SESSION['tempuser'];
	$password = $_SESSION['temppass'];
	$javascript = '';
	if(Auth::attempt($username, $password)){
		header('Location: ads.index.php');
	}else if ($username != "" || $password != ""){
		$javascript = "Wrong Username or Password. Please try again.";
		header('Location: index.php');
		session_destroy();
	}

?>