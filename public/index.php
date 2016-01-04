<?php
require_once '../database/config.php';

function pageController()
{
	session_start();
	$sessionId = session_id();
	$_SESSION['tempuser'] = Input::get('username_login');
	$_SESSION['temppass'] = Input::get('password_login');
	$username = $_SESSION['tempuser'];
	$password = $_SESSION['temppass'];
	$javascript = '';
	if(Auth::attempt($username, $password)){
        header('Location: ads.index.php');
    }else if ($username != "" || $password != ""){
		$javascript = 'alert("Incorrect input.")';
		session_destroy();
    };
	return array(
		'username' 	 => $username,
		'password' => $password,
		'javascript' => $javascript
	);
};
extract(pageController());
?>

<!DOCTYPE html>

<html>
	<head>	
		<title>Handel</title>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- BOOTSTRAP CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<!-- CUSTOM CSS -->
		<link rel="stylesheet" type="text/css" href="../css/main.css">
		<link href='https://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
		<!-- TITLE IMG -->
		<!-- <link rel="shortcut icon" href="img/mole.png"> -->
		<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>

	</head>
	<body>
		<?php include "../views/partials/entry_navbar.php"; ?>
		<?php include "../views/partials/header.php"; ?>
		<?php include "../views/partials/sign_up.php"; ?>
		<?php include "../views/partials/footer.php"; ?>
		<!-- JQUERY -->
		<script src="/js/jquery-2.1.4.min.js"></script>
		<script src="/js/jquery.validate.js"></script>
		<!-- BOOTSTRAP JS -->
		<script src="/js/bootstrap.min.js"></script>
		<!-- CUSTOM JS -->
		<script src="js/main.js"></script>
		<script src="js/signup_form.js"></script>
	</body>
</html>
