<?php
require_once '../utils/dbconnect.php';
require_once '../utils/Input.php';
require_once '../utils/insert_id.php';

$page = Input::has('page') ? Input::get('page') : 1;
$errors = [];
$selectCount = "SELECT COUNT(*) FROM posts";

$stmt1 = $dbc->query($selectCount);

$post = $stmt1->fetch();

$rows = $post[0];
 
 if ($page < 1) {
 	$page = 1;
 }

if ($page > ceil($rows/4)) {
	$page = ceil($rows/4);
}
$limit = 4;

$offset = $limit * $page - $limit;

if ($offset < 0) {
	$offset = 0;
}

$selectAll = "SELECT * FROM posts LIMIT :limit OFFSET :offset";

$stmt = $dbc->prepare($selectAll);
$stmt->bindValue(':limit', 4, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();

$posts = $stmt->fetchALL(PDO::FETCH_ASSOC);

?>