<?php
	function inputHas($key){
		return isset($_REQUEST[$key]);	
	}

	function inputGet($key){
		if(inputHas($key)){
			return $_REQUEST[$key];
		}
		return null;
	}

	function escape($input){
		return htmlspecialchars(strip_tags($input));
	}

?>