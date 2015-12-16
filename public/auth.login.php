<?php
	require_once "functions.php";
	require_once "../Auth.php";
	session_start();
	function pageController()
	{
		$name = inputHas('name') ? inputGet('name') : "";
		$password = inputHas('password') ? inputGet('password') : "";
		$javascript = '';
			if(Auth::attempt($name, $password)){
				header('Location: /ads.index.php');
				die();
			}else if ($name != "" || $password != ""){
				$javascript = 'alert("Incorrect input.")';
			}
			return array(
				'name'   => $name,
				'password' => $password,
				'javascript' => $javascript
			);
	};
	extract(pageController());