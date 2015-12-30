<?php
session_start();

require_once '../database/config.php';
require_once '../models/BaseModel.php';

class Post extends Model
{
	protected static $table = 'posts';

	public static function findPostById($id)
	{
		self::dbConnect();
		$table=static::$table;
		$query = "SELECT * FROM $table WHERE id=:id";
		$stmt = self::$dbc->prepare($query);
		$stmt->bindValue(':id', $id, PDO::PARAM_STR);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);

		$instance = null;
		if($result)
		{
		$instance = new static;
		$instance->attributes = $result;
		}
		return $instance;
	}
}
$post = Post::findPostById(1);

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
			<h1><?= $post->title; ?><small>$<?= $post->price; ?></small>
				<hr>
				<br><h4><?= $post->description; ?></h4>
		</div>	

		<?= $_SESSION["username"]?>

		<?php include "../views/partials/footer.php"; ?>
		<!-- JQUERY -->
		<script src="/js/jquery-2.1.4.min.js"></script>
		<!-- BOOTSTRAP JS -->
		<script src="/js/bootstrap.min.js"></script>
		<!-- CUSTOM JS -->
		<script src="js/main.js"></script>
	</body>
</html>

