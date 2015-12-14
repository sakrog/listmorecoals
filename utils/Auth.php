<?php

require_once 'Log.php';
require_once 'Input.php';


class Auth
{
	$sessionId = session_id();
	$message = '';

	public static $password = '$2y$10$SLjwBwdOVvnMgWxvTI4Gb.YVcmDlPTpQystHMO2Kfyi/DS8rgA0Fm';

	public static $logger = null;

	public static function getLogger()
	{
		if(!isset(self::$logger)){
			self::$logger = new Log();
		}

		return self::$logger;
	}

	public static function attempt($username, $password)
	{
		$logger = self::getLogger();

		if(isset($_POST['username']) && isset($_POST['password'])){
			
			// $username = htmlspecialchars(strip_tags(trim($_POST['username'])));
			// $userpassword = htmlspecialchars(strip_tags(trim($_POST['password'])));

			$username = Input::get('username');
			$userpassword = Input::get('password');

			if($username == 'guest' && password_verify($userpassword, self::$password)){
				$_SESSION["LOGGED_IN_USER"] = "{$username}";
				header('Location: http://codeup.dev/php/authorized.php');
				$logMessage("USER", "User {$username} has logged in." );
				die();
			} elseif($username != 'guest' && $password != 'password'){
				$message = "**Incorrect Username or Password**";
				$logMessage("USER", "User {$username} failed to log in!");
				session_destroy();
			}
		}
	};

	public static function check()
	{


	}

	public static function user()
	{


	}

	public static function logout()
	{


	}
}

?>

