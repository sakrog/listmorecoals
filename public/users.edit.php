<?php

	require_once '../bootstrap.php';

	session_start();

	function checkUserValues()
	{
		return Input::setAndNotEmpty('first_name') && Input::setAndNotEmpty('last_name') && Input::setAndNotEmpty('email') && Input::setAndNotEmpty('city') && Input::setAndNotEmpty('state') && Input::setAndNotEmpty('password') && Input::setAndNotEmpty('username') && Input::setAndNotEmpty('image');
	}

	function insertUser($dbc)
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
		try{
			$price = Input::getString('image');
		} catch (Exception $e) {
			array_push($errors, $e->getMessage());
		}

		$date = date('Y-m-d');

		$insert_user = "INSERT INTO users (userid, first_name, last_name, email, city, state, password, username, image) VALUES (:userid, :first_name, :last_name, :email, :city, :state, :password, :username, :image)";

	    $stmt = $dbc->prepare($insert_user);
	    $stmt->bindValue(':userid', 1, PDO::PARAM_STR);
	    $stmt->bindValue(':first_name', $first_name, PDO::PARAM_STR);
	    $stmt->bindValue(':last_name', $last_name, PDO::PARAM_STR);
	    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
	    $stmt->bindValue(':city', $city, PDO::PARAM_STR);
	    $stmt->bindValue(':state', $state, PDO::PARAM_STR);
	    $stmt->bindValue(':password', $password, PDO::PARAM_STR);
	    $stmt->bindValue(':username', $username, PDO::PARAM_STR);
	    $stmt->bindValue(':image', $filename, PDO::PARAM_STR);

	    $stmt->execute();

		return $errors;
	}

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

		if(Input::has('title')){
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

		$insert_table = "INSERT INTO posts (userid, post_date, title, price, description, email, location, image) VALUES (:userid, :post_date, :title, :price, :description, :email, :location, :image)";

	    $stmt = $dbc->prepare($insert_table);
	    $stmt->bindValue(':userid', 1, PDO::PARAM_STR);
	    $stmt->bindValue(':post_date', $date, PDO::PARAM_STR);
	    $stmt->bindValue(':title', $title, PDO::PARAM_STR);
	    $stmt->bindValue(':price', $price, PDO::PARAM_STR);
	    $stmt->bindValue(':description', $description, PDO::PARAM_STR);
	    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
	    $stmt->bindValue(':location', $location, PDO::PARAM_STR);
	    $stmt->bindValue(':image', $filename, PDO::PARAM_STR);

	    $stmt->execute();

		return $errors;
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

	$loggedInUser = $_SESSION['tempuser'];
	$user = User::findUserByUsername($loggedInUser);

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
				<div>First Name: <?= $user->first_name ?></div>
				<div>Last Name: <?= $user->last_name ?></div>
				<div>Email: <?= $user->email ?></div>
				<div>City: <?= $user->city ?></div>
				<div>State: <?= $user->state ?></div>
				<div>Password: <?= $user->password ?></div>
				<div>Username: <?= $user->username ?></div>
				<div><img src="/img/uploads/<?= $user->image ?>" class="img-responsive"></div>
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
			<div class="form-group">
				<label for="image"></label>
				<input type="file" name="image" id="image">
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
