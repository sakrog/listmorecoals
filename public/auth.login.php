<?php
	
	session_start();
	function pageController()
	{
		$name = "";
		$password = "";
		$javascript = "";
		if(!empty($_POST)){
			$name = inputHas('name') ? inputGet('name') : "";
			$password = inputHas('password') ? inputGet('password') : "";
			$javascript = '';
			if(Auth::attempt($name, $password)){
				header('Location: /ads.index.php');
				die();
			}else if ($name != "" || $password != ""){
				$javascript = 'alert("Incorrect input.")';
			}
		}
		return array(
			'name'   => $name,
			'password' => $password,
			'javascript' => $javascript
		);
	};
	extract(pageController());