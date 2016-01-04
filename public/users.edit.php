<?php 
require_once '../database/config.php';
require_once "../database/dbconnect.php";
require_once "../models/Input.php";

function checkValues()
{
	return Input::setAndNotEmpty('first_name') && Input::setAndNotEmpty('last_name') && Input::setAndNotEmpty('email') && Input::setAndNotEmpty('city') && Input::setAndNotEmpty('state') && Input::setAndNotEmpty('password') && Input::setAndNotEmpty('username');
}

var_dump($_SESSION['LOGGED_IN_USER']);

function insertPost($dbc)
{
	$errors = [];

	try{
		$title = Input::getString('first_name');
	} catch (Exception $e) {
		array_push($errors, $e->getMessage());
	}
	try{
		$description =Input::getString('last_name');
	} catch (Exception $e) {
		array_push($errors, $e->getMessage());
	}
	try{
		$location = Input::getString('email');
	} catch (Exception $e) {
		array_push($errors, $e->getMessage());
	}
	try{
		$email = Input::getString('city');
	} catch (Exception $e) {
		array_push($errors, $e->getMessage());
	}
	try{
		$price = Input::getString('state');
	} catch (Exception $e) {
		array_push($errors, $e->getMessage());
	}
	try{
		$price = Input::getString('password');
	} catch (Exception $e) {
		array_push($errors, $e->getMessage());
	}
	try{
		$price = Input::getString('username');
	} catch (Exception $e) {
		array_push($errors, $e->getMessage());
	}

	if(Input::has('username')){
    	if($_FILES) {
    		// Create variable for the uploads direc for images in our server
    		$uploads_directory = 'img/uploads/';
    		$filename = $uploads_directory . basename($_FILES['image']['name']);
        	if (move_uploaded_file($_FILES['image']['tmp_name'], $filename)) {
            // echo '<p>The file '. basename( $_FILES['image']['name']). ' has been uploaded.</p>';
        	} else {
       	    //alert("Sorry, there was an error uploading your file.");
       		}
    	}
	}

	$date = date('Y-m-d');

	$insert_table = "INSERT INTO users (userid, first_name, last_name, email, city, state, password, username) VALUES (:userid, :first_name, :last_name, :email, :city, :state, :password, :username)";

    $stmt = $dbc->prepare($insert_table);
    $stmt->bindValue(':userid', 1, PDO::PARAM_STR);
    $stmt->bindValue(':first_name', $first_name, PDO::PARAM_STR);
    $stmt->bindValue(':last_name', $last_name, PDO::PARAM_STR);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->bindValue(':city', $city, PDO::PARAM_STR);
    $stmt->bindValue(':state', $state, PDO::PARAM_STR);
    $stmt->bindValue(':password', $password, PDO::PARAM_STR);
    $stmt->bindValue(':username', $username, PDO::PARAM_STR);

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
		<title>Handel</title>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- BOOTSTRAP CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<!-- CUSTOM CSS -->
		<link rel="stylesheet" type="text/css" href="../css/main.css">
		<!-- TITLE IMG -->
		<!-- <link rel="shortcut icon" href="img/mole.png"> -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="css/post_table.css">
		<link href='https://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Indie+Flower' rel='stylesheet' type='text/css'>
	</head>
	<body>
		<?php include "../views/partials/navbar.php"; ?>
		<div class="container">
			<div class="jumbotron">
				<h1 class="title">Edit Your Profile</h1>
				<div><?= $first_name ?></div>
				<div></div>
				<div></div>
				<div></div>
				<div></div>
				<div></div>
				<div></div>
			</div>
		</div>
		<form role="form" method="POST" enctype="multipart/form-data">
			<div class="form-group col-md-4">
				<label for="first_name">first_name</label>
				<input type="text" class="form-control" name="first_name">
			</div> 
			<div class="form-group col-md-4">
				<label for="last_name">last_name</label>
				<input type="text" class="form-control" name="last_name">
			</div>  
			<div class="form-group col-md-4">
				<label for="email">email</label>
				<input type="email" class="form-control" name="email">
			</div>
			<div class="form-group col-md-4">
				<label for="city">city</label>
				<input type="text" class="form-control" name="city">
			</div>
			<div class="form-group col-md-4">
				<label for="state">state</label>
				<input type="text" class="form-control" name="state">
			</div> 
			<div class="form-group col-md-4">
				<label for="password">password</label>
				<input type="password" class="form-control" name="password">
			</div>
			<div class="form-group col-md-4">
				<label for="username">username</label>
				<input type="text" class="form-control" name="username">
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary btn-lg">Submit</button>
			</div>
		</form>
	
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
