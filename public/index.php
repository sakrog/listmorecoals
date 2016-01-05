<?php
	require_once '../database/config.php';
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
		<!-- CUSTOM CSS -->
		<link rel="stylesheet" type="text/css" href="/css/main.css">
		<!-- TAB ICON -->
		<!-- <link rel="shortcut icon" href="img/mole.png"> -->
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
	</body>
</html>
