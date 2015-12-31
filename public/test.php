<?php
require_once '../database/config.php';

	
// create the connection object
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Don't forget to sanitize your user queries.
// Here $conn is the connection object I assume. Replace it with yours.
$_POST['search'] = mysqli_real_escape_string($conn, $_POST['search']);
$search_sql = "SELECT * FROM `posts` WHERE `title` LIKE '%" . $_POST['search'] . "%' OR `description` LIKE '%".$_POST['search']."%'";
// change the result here.
$result = mysqli_query($conn, $search_sql);
if(mysqli_num_rows($result) > 0) {    
$search_rs = mysqli_fetch_assoc($result);
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Search Results</title>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- BOOTSTRAP CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<!-- CUSTOM CSS -->
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<!-- TITLE IMG -->
	<!-- <link rel="shortcut icon" href="img/mole.png"> -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/post_table.css">
	<link href='https://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Indie+Flower' rel='stylesheet' type='text/css'>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
	<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
</head>
<body>
	<?php include "../views/partials/navbar.php"; ?>
	<?php include "../views/partials/header.php"; ?>

	<table class="table table-hover table-bordered table-striped">
	<tr class='table-hover	'>
		<th class="header col-md-1">Date Posted</th>
		<th class="header">Title</th>
		<th class="header col-md-1">Price</th>
		<th class="header col-md-6">Description</th>
		<th class="header">E-Mail</th>
		<th class="header">Location</th>
		<th class="header col-md-6">Image</th>
	</tr>
<?php
if (mysqli_num_rows($result) > 0) {
do { ?>
<tr class='table table-hover table-bordered body'>
	<td><?php echo $search_rs['post_date']; ?></td>
	<td><?php echo $search_rs['title']; ?></td>
	<td><?php echo $search_rs['price']; ?></td>
	<td><?php echo $search_rs['description']; ?></td>
	<td><?php echo $search_rs['email']; ?></td>
	<td><?php echo $search_rs['location']; ?></td>
	<td>
	<div id="pageone" data-role="main" class="ui-content">
    	<a href="#myPopup" data-rel="popup" data-position-to="window">
    	<img src="<?php echo $search_rs['image']; ?>" class="img-responsive" alt="Image Needed" style="width:200px;"></a>
	</div>

    <div data-role="popup" id="myPopup">
    	<a href="#pageone" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a><img src="<?php echo $search_rs['image']; ?>" class="img-responsive" style="width:800px;height:400px;">
    </div>
	</td>
</tr>
<?php
// Kindly note, how false and assignment is used here.
} while (false != ($search_rs = mysqli_fetch_array($result)));
} else echo "No results found";?>
	</table>
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