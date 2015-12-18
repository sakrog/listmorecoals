<?php include "../database/dbconnect.php"; ?>
<?php 
function checkValues()
{
	return Input::setAndNotEmpty('title') && Input::setAndNotEmpty('description') && Input::setAndNotEmpty('location') && Input::setAndNotEmpty('email') && Input::setAndNotEmpty('price');
}

function insertPark($dbc)
{
	$errors = [];

	try{
		$name = Input::has('title') ? Input::getString('title') : null;
	} catch (Exception $e) {
		array_push($errors, $e->getMessage());
	}
	try{
		$location = Input::has('description') ? Input::getString('description') : null;
	} catch (Exception $e) {
		array_push($errors, $e->getMessage());
	}
	try{
		$date_established = Input::has('location') ? Input::getDate('location') : null;
	} catch (Exception $e) {
		array_push($errors, $e->getMessage());
	}
	try{
		$area_in_acres = Input::has('email') ? Input::getNumber('email') : null;
	} catch (Exception $e) {
		array_push($errors, $e->getMessage());
	}
	try{
		$description = Input::has('price') ? Input::getString('price') : null;
	} catch (Exception $e) {
		array_push($errors, $e->getMessage());
	}

	if(!empty($errors)){
		return $errors;
	}


	$insert_table = "INSERT INTO posts (userid, post_date, title, price, description, email, location) VALUES (:userid, :post_date, :title, :price, :description, :email, :location)";

    $stmt = $dbc->prepare($insert_table);
    $stmt->bindValue(':userid', $userid, PDO::PARAM_STR);
    $stmt->bindValue(':post_date', $post_date, PDO::PARAM_STR);
    $stmt->bindValue(':title', $title, PDO::PARAM_STR);
    $stmt->bindValue(':price', $price, PDO::PARAM_STR);
    $stmt->bindValue(':description', $description, PDO::PARAM_STR);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->bindValue(':location', $location, PDO::PARAM_STR);

    $stmt->execute();

	return $errors;
}

function deletePark($dbc)
{
	if (Input::has('id')) {
		$delete_column = "DELETE FROM posts WHERE id = :id";
		$del = $dbc->prepare($delete_column);
		$del->bindValue(':id', Input::get('id'), PDO::PARAM_STR);
		$del->execute();
	}
}

function pageController($dbc)
{
	$errors = null;


	if (!empty($_POST)) {
		if (checkValues()) {
			$errors = insertPark($dbc);			
		} else {
			$message = "Invalid format. Please try again.";
			$javascript = "<script type='text/javascript'>alert('$message');</script>";
			echo $javascript;
		}
	}

	deletePark($dbc);

	// Count
	$countAll = 'SELECT count(*) FROM national_parks';
	$count_stmt = $dbc->query($countAll);
	$count = $count_stmt->fetchColumn();
	$limit = 2;
	$max_page = ceil($count / $limit);

	// Sanitizing
	$page = Input::has('page') ? Input::get('page') : 1; // grabs url value if exists, if not set to 1
	$page = (is_numeric($page)) ? $page : 1; // is value numeric, if not set to 1
	$page = ($page > 0) ? $page : 1; // is value greater than zero, if not set to 1
	$page = ($page <= $max_page) ? $page : $max_page; // is value less than or equal maximum amount of pages, if not set to max page

	// Offset
	$offset = $page * $limit - $limit;
	$selectAll = 'SELECT * FROM national_parks LIMIT :limit OFFSET :offset';
	$stmt = $dbc->prepare($selectAll);
	$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
	$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
	$stmt->execute();
	$parks = $stmt->fetchAll(PDO::FETCH_ASSOC);

	return array(
		'page' => $page,
		'parks' => $parks,
		'errors' => $errors,
		'max_page' => $max_page
		);
}
extract(pageController($dbc));
?>

<!-- Modal -->
<div class="modal fade" tabindex="-1" id="post_modal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<!-- Modal content-->
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">What Are You Posting?</h4>
			</div>
			<form role="form" method="POST">
				<div class="form-group col-md-6">
					<label for="title">Title</label>
					<input type="text" class="form-control" name="title">
				</div> 
				<div class="form-group col-md-8">
					<label for="description">Description</label>
					<textarea class="form-control" rows="10" name="description"></textarea>
				</div>  
				<div class="form-group col-md-4">
					<label for="location">Location</label>
					<input type="text" class="form-control" name="location">
				</div>
				<div class="form-group col-md-4">
					<label for="email">Email Address</label>
					<input type="email" class="form-control" name="email">
				</div>
				<div class="form-group col-md-4">
					<label for="price">Price</label>
					<input type="text" class="form-control" name="price">
				</div> 
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary btn-lg">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>




