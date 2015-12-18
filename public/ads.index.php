<?php 
require_once "../database/config.php";
require_once "../database/dbconnect.php";
require_once "../models/Input.php";

function checkValues()
{
	return Input::setAndNotEmpty('title') && Input::setAndNotEmpty('description') && Input::setAndNotEmpty('location') && Input::setAndNotEmpty('email') && Input::setAndNotEmpty('price');
}

function insertPost($dbc)
{
	$errors = [];

	try{
		$title = Input::getString('title');
	} catch (Exception $e) {
		array_push($errors, $e->getMessage());
	}
	try{
		$description =Input::getString('description');
	} catch (Exception $e) {
		array_push($errors, $e->getMessage());
	}
	try{
		$location = Input::getString('location');
	} catch (Exception $e) {
		array_push($errors, $e->getMessage());
	}
	try{
		$email = Input::getString('email');
	} catch (Exception $e) {
		array_push($errors, $e->getMessage());
	}
	try{
		$price = Input::getString('price');
	} catch (Exception $e) {
		array_push($errors, $e->getMessage());
	}

	$date = date('Y-m-d');

	$insert_table = "INSERT INTO posts (userid, post_date, title, price, description, email, location) VALUES (:userid, :post_date, :title, :price, :description, :email, :location)";

    $stmt = $dbc->prepare($insert_table);
    $stmt->bindValue(':userid', 1, PDO::PARAM_STR);
    $stmt->bindValue(':post_date', $date, PDO::PARAM_STR);
    $stmt->bindValue(':title', $title, PDO::PARAM_STR);
    $stmt->bindValue(':price', $price, PDO::PARAM_STR);
    $stmt->bindValue(':description', $description, PDO::PARAM_STR);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->bindValue(':location', $location, PDO::PARAM_STR);

    $stmt->execute();

	return $errors;
}

function deletePost($dbc)
{
	if (Input::has('id')) {
		$delete_column = "DELETE FROM posts WHERE id = :id";
		$del = $dbc->prepare($delete_column);
		$del->bindValue(':id', Input::get('id'), PDO::PARAM_STR);
		$del->execute();
	}
}

if (!empty($_POST)) {
	if (checkValues()) {

		$errors = insertPost($dbc);			
	} else {
		$message = "Invalid format. Please try again.";
		$javascript = "<script type='text/javascript'>alert('$message');</script>";
		echo $javascript;
	}
}
?>
<!DOCTYPE html>
 
<html>
	<head>
		<title>Ad Lister</title>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- BOOTSTRAP CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<!-- CUSTOM CSS -->
		<link rel="stylesheet" type="text/css" href="css/main.css">
		<!-- TITLE IMG -->
		<!-- <link rel="shortcut icon" href="img/mole.png"> -->
	</head>
	<body>
		<?php include "../views/partials/navbar.php"; ?>
		<?php include "../views/partials/header.php"; ?>
		<div class="images">
			<img src="http://placehold.it/350x350" class="img-rounded">
			<img src="http://placehold.it/350x350" class="img-circle">
			<img src="http://placehold.it/350x350" class="img-rounded">
		</div>
		<?php include "../views/partials/post_modal.php"; ?>
		<?php include "../views/partials/footer.php"; ?>
		<!-- JQUERY -->
		<script src="/js/jquery-2.1.4.min.js"></script>
		<!-- BOOTSTRAP JS -->
		<script src="/js/bootstrap.min.js"></script>
		<!-- CUSTOM JS -->
		<script src="js/main.js"></script>
	</body>
</html>
