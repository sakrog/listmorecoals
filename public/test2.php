<?php
require_once '../models/Input.php';
require_once '../database/dbconnect.php';

// Counting
$selectCount = "SELECT COUNT(*) FROM posts";
$stmt1 = $dbc->query($selectCount);
$count = $stmt1->fetchColumn();
$limit = 4;
$max_page = ceil($count / $limit);

// Sanitizing
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

?>
<!DOCTYPE HTML>
<html>
<head>
	<title></title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="css/post_table.css">
<link href='https://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Indie+Flower' rel='stylesheet' type='text/css'>
</head>
<body>
<!-- <div class="col-md-2"></div>
<!-- <div class="col-md-10">
 --> <table class="table table-hover table-bordered table-striped">
		<tr class='table-hover'>
			<th class="header">Photo</th>
			<th class="header col-md-1">Date Posted</th>
			<th class="header">Title</th>
			<th class="header col-md-1">Price</th>
			<th class="header col-md-6">Description</th>
		</tr>

			<?php
			foreach ($posts as $post):?>
				<tr class='table table-hover table-bordered body'>
					<td>Photo</td>
					<td><?= $post['post_date'] ?></td>
					<td><?= $post['title']?></td> 
					<td><?= $post['price']?></td>
					<td><?= $post['description']?></td>
			<?php endforeach ?>
			</tr>
<!-- 	<div class="col-md-2"></div>
 -->	</table>
<!-- 	</div>
 -->		<?= "You are on page $page" ?>
 <?php if ($page != 1) : ?>
	<a button type="button" class="btn btn-primary" href="test2.php?page=<?= ($page - 1); ?>">Previous Page</a>
<?php endif; ?>
<?php if ($page != $max_page) : ?>
	<a button type="button" class="btn btn-primary" href="test2.php?page=<?= ($page + 1); ?>">Next Page</a>
<?php endif; ?>
</body>
</html>