<?php

define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'adlister');
define('DB_USER', 'vagrant');
define('DB_PASS', 'vagrant');

$dbc = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME .'', DB_USER , DB_PASS);

$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

require_once '../utils/Input.php';

$query = "SELECT * FROM posts WHERE id=1";
$stmt = $dbc->prepare($query);
$title->bindValue(':title', 1,PDO::PARAM_STR);

$stmt->execute();
print_r($stmt->fetch(PDO::FETCH_ASSOC));

?>

<html>
	<head>
		<title>Ad Lister</title>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- BOOTSTRAP CSS -->
		<link href="/css/bootstrap.min.css" rel="stylesheet">
		<!-- CUSTOM CSS -->
		<link rel="stylesheet" type="text/css" href="css/main.css">
		<!-- TITLE IMG -->
		<!-- <link rel="shortcut icon" href="img/mole.png"> -->
	</head>
	<body>
		<?php include "../views/partials/navbar.php"; ?>
		<?php include "../views/partials/header.php"; ?>

		<div class="container">
			<h1><?= $row['title']; ?><small><?= $post['price']; ?></small></h1>
			<div class="description">
				<?= $post['description'];?>
		</div>	


		<?php include "../views/partials/footer.php"; ?>
		<!-- JQUERY -->
		<script src="/js/jquery-2.1.4.min.js"></script>
		<!-- BOOTSTRAP JS -->
		<script src="/js/bootstrap.min.js"></script>
		<!-- CUSTOM JS -->
		<script src="js/main.js"></script>
	</body>
</html>

