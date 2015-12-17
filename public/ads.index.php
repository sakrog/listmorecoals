
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
		<link rel="stylesheet" type="text/css" href="/css/main.css">
		<!-- TITLE IMG -->
		<!-- <link rel="shortcut icon" href="img/mole.png"> -->
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	</head>
	<body>
		<div id="page-content-wrapper">
		<?php include "../views/partials/navbar.php"; ?>
		<?php include "../views/partials/header.php"; ?>
		<table class="table table-hover table-bordered">
			<tr class='column'>
				<th>Date</th>
				<th>Title</th>
				<th>Price</th>
				<th>Description</th>
			</tr>

			<?php
			foreach ($posts as $post):?>
				<tr>
					<td><?= $post['post_date'] ?></td>
					<td><?= $post['title']?></td> 
					<td><?= $post['price']?></td>
					<td><?= $post['description']?></td>
			<?php endforeach ?>
			</tr>
		</table>
		<?php include "../views/partials/footer.php"; ?>
		<script src="js/main.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		</div>
	</body>
</html>