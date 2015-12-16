<?php
require_once '../utils/insert_id.php';
require_once '../utils/dbconnect.php';
require_once '../utils/Input.php';
require_once '../utils/limiter.php';
?>
<!DOCTYPE html>
 
<html>
	<head>
		<title>Ad Lister</title>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- BOOTSTRAP -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<!-- CUSTOM CSS -->
		<link rel="stylesheet" type="text/css" href="css/main.css">
		<!-- TITLE IMG -->
		<!-- <link rel="shortcut icon" href="img/mole.png"> -->
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	</head>
	<body>
		<?php include "../views/partials/navbar.php"; ?>
		<?php include "../views/partials/confirm_header.php"; ?>
		<script src="js/main.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	</body>
</html>