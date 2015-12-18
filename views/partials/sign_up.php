<?php

require_once '../models/Input.php';
require_once '../database/dbconnect.php';

var_dump($dbc);

function pageController2($dbc)
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
}

pageController2($dbc);

?>

<form role="form" class="form" method="POST">
	<h2>Sign up to buy, sell and trade!</h2>
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