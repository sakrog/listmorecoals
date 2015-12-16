<?php
class Auth
{
	public static $password = '$2y$10$SLjwBwdOVvnMgWxvTI4Gb.YVcmDlPTpQystHMO2Kfyi/DS8rgA0Fm';

	public static function attempt($username, $password)
	{
		if($username == 'guest' && password_verify($password, self::$password))
		{
			$_SESSION['LOGGED_IN_USER'] = $username;
			return true;
		}
		return false;
	}

	public static function check()
	{
		return isset($_SESSION['LOGGED_IN_USER']) ? true : false;
	}

	public static function user()
	{
		return isset($_SESSION['LOGGED_IN_USER']) ? $_SESSION['LOGGED_IN_USER'] : null;
	}

	public static function logout()
	{
		$_SESSION = array();
	    // If it's desired to kill the session, also delete the session cookie.
	    // Note: This will destroy the session, and not just the session data!
	    if (ini_get("session.use_cookies")) {
	        $params = session_get_cookie_params();
	        setcookie(session_name(), '', time() - 42000,
	            $params["path"], $params["domain"],
	            $params["secure"], $params["httponly"]
	        );
	    }
	    // Finally, destroy the session.
	    session_destroy();

	    header('Location: /login.php');
	}
}




