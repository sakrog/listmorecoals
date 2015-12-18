<?php
require_once '../models/Input.php';
require_once '../database/dbconnect.php';

$errors = [];
var_dump($_POST);

function pageController($dbc)
{

		if(!empty($_POST)){


			if(Input::setAndNotEmpty('first_name')) {
			
				$query = "INSERT INTO users (first_name, last_name, email, city, state, password, username) VALUES (:first_name, :last_name, :email, :city, :state, :password, :username)";

				$stmt2 = $dbc->prepare($query);
				$stmt2->bindValue(':first_name', Input::get('first_name'), PDO::PARAM_STR);
				$stmt2->bindValue(':last_name', Input::get('last_name'), PDO::PARAM_STR);			
				$stmt2->bindValue(':email', Input::get('email'), PDO::PARAM_STR);
				$stmt2->bindValue(':city', Input::get('city'), PDO::PARAM_STR);
				$stmt2->bindValue(':state', Input::get('state'), PDO::PARAM_STR);
				$stmt2->bindValue(':password', password_hash(Input::get('password'),PASSWORD_DEFAULT), PDO::PARAM_STR);
				$stmt2->bindValue(':username', Input::get('username'), PDO::PARAM_STR);
				$stmt2->execute();
				
			}
		 }
		 // if(Input::setAndNotEmpty('userid')){
		 // 	echo 'got here';
		 // 	$id = Input::get('userid');
		 // 	$delete = $dbc->prepare('DELETE FROM users WHERE userid = :userid');
		 // 	$delete->bindValue(':userid', $userid, PDO::PARAM_INT);
		 // 	$delete->execute();
		 // }	
}

pageController($dbc);

	// if (!empty($_POST)) {
	// }

	// if(Input::get('first_name') &&
	// 	Input::get('last_name') &&
	// 	Input::get('city') &&
	// 	Input::get('state') &&
	// 	Input::get('password') &&
	// 	Input::get('username')) 
	// 	{
	// 		try {
	// 		$first_name = Input::getString('first_name', 1, 200);

	// 	} catch (Exception $e) {
		
	// 		array_push($errors, 'An error occurred: ' . $e->getMessage());
	// 	}

	// 	try {
	// 		$last_name = Input::getDate('last_name', 1, 200);

	// 	} catch (Exception $e) {

	// 		array_push($errors, 'An error occurred: ' . $e->getMessage());

	// 	}	    

	// 	try {
	// 		$city = Input::getString('city', 1, 200);

	// 	} catch (Exception $e) {

	// 		array_push($errors, 'An error occurred: ' . $e->getMessage());
	// 	}	    

	// 	try {
	// 		$state = Input::getString('state', 1, 2);

	// 	} catch (Exception $e) {
	// 		array_push($errors, 'An error occurred: ' . $e->getMessage());

	// 	}	    
	// 	try {
	// 		$password = Input::getString('password', 5, 200);

	// 	} catch (Exception $e) {
	// 		array_push($errors, 'An error occurred: ' . $e->getMessage());
	// 	}
	// 	try {
	// 		$username = Input::getString('username', 5, 200);

	// 	} catch (Exception $e) {
	// 		array_push($errors, 'An error occurred: ' . $e->getMessage());
	// 	}
	// }

	// if(empty($errors)){
	// 	insertUser($dbc);
	// 	} else {
	// 	$alert = "You cannot submit an empty form";
	// 	$messages = $errors;
	// 	}
	// }
?>
<!DOCTYPE HTML>
<html>
<head>
	<title></title>
</head>
<body>


 <form class="form" method="POST">
	<div class="form-group">
		<label for="first_name">First Name:</label>
		<input type="text" class="form-control" name="first_name">
	</div>
	<div class="form-group">
		<label for="last_name">Last Name:</label>
		<input type="text" class="form-control" name="last_name">
	</div>
	<div class="form-group">
		<label for="email">Email Address:</label>
		<input type="email" class="form-control" name="email">
	</div>
	<div class="form-group">
		<label for="city">City:</label>
		<input type="text" class="form-control" name="city">
	</div>
	<div class="form-group">
		
		<label for="state">State:</label>
		<input type="text" class="form-control" name="state">
	</div>
	<div class="form-group">
		<label for="username">Username:</label>
		<input type="text" class="form-control" name="username">
	</div>
	<div class="form-group">
		<label for="pwd">Password:</label>
		<input type="password" class="form-control" name="pwd">
	</div>
	<button type="submit" class="btn btn-default">Submit</button>
</form>
</body>
</html>