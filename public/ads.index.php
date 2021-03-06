<?php 

	require_once '../bootstrap.php';

	session_start();
	if(empty($_SESSION['LOGGED_IN_USER'])){
		header('Location: index.php');
	}
	
	function checkValues()
	{
		return Input::setAndNotEmpty('title') && Input::setAndNotEmpty('description') && Input::setAndNotEmpty('location') && Input::setAndNotEmpty('email') && Input::setAndNotEmpty('price');
	}

	function insertPost($dbc)
	{
		//Setting username (currently hard coded, will use SESSION variable later)
		$username = "pascal456";
		$user = User::findUserByUsername($username);
		var_dump($user);
		$userid = $user->userid;


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
	    $stmt->bindValue(':userid', $userid, PDO::PARAM_STR);
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

	function deletePost($dbc)
	{
		if (Input::has('id')) {
			$delete_column = "DELETE FROM posts WHERE id = :id";
			$del = $dbc->prepare($delete_column);
			$del->bindValue(':id', Input::get('id'), PDO::PARAM_STR);
			$del->execute();
		}
	}

	// Counting
	$selectCount = "SELECT COUNT(*) FROM posts";
	$stmt1 = $dbc->query($selectCount);
	$count = $stmt1->fetchColumn();
	$limit = Input::has('limit') ? Input::get('limit') : 4;
	$max_page = ceil($count / $limit);

	// // Sanitizing
	$page = Input::has('page') ? Input::get('page') : 1;
	$page = (is_numeric($page)) ? $page : 1;
	$page = ($page > 0) ? $page : 1;
	$page = ($page <= $max_page) ? $page : $max_page;

	$errors = [];


	$posts = $stmt1->fetch();

	$rows = $posts[0];

	// Offsetting
	$offset = $limit * $page - $limit;
	$selectAll = "SELECT * FROM posts LIMIT :limit OFFSET :offset";
	$stmt = $dbc->prepare($selectAll);
	$stmt->bindValue(':limit', 4, PDO::PARAM_INT);
	$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
	$stmt->execute();
	$posts = $stmt->fetchALL(PDO::FETCH_ASSOC);	

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
		<!-- TAB ICON -->
		<!-- <link rel="shortcut icon" href="img/mole.png"> -->
	</head>
	<body>
		<?php include "../views/partials/navbar.php"; ?>
		<?php include "../views/partials/header.php"; ?>

		<table class="table table-bordered table-striped">
			<tr>
				<th class="col-md-1">Date Posted</th>
				<th>Title</th>
				<th class="col-md-1">Price</th>
				<th class="col-md-6">Description</th>
				<th>Location</th>
				<th class="col-md-6">Image</th>
			</tr>
			<?php foreach ($posts as $post): ?>
				<tr class='table table-hover table-bordered body'>
					<td><?= $post['post_date'] ?></td>
					<td><?= $post['title']?></td> 
					<td><?= $post['price']?></td>
					<td><?= $post['description']?></td>
					<td><?= $post['location']?></td>
					<td><img src="<?= $post['image']?>" class="img-responsive"></td>
				</tr>
			<?php endforeach ?>
		</table>		
		<?= "You are on page $page" ?>
 		<?php if ($page < 1) : ?>

 		<?php elseif ($page != 1) : ?>
			<a button type="button" class="btn btn-primary" href="?page=<?= ($page - 1); ?>">Previous Page</a>
		<?php endif; ?>
		<?php if ($page != $max_page) : ?>
			<a button type="button" class="btn btn-primary" href="?page=<?= ($page + 1); ?>">Next Page</a>
		<?php endif; ?>
	
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
