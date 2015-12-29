<?php
require_once 'config.php';
require_once 'dbconnect.php';

$dbc->exec('TRUNCATE users;');

$users = [
	['first_name' => 'Roger', 'last_name'=> 'Chin', 'email'=> 'roger.sc.chin@gmail.com', 'city'=>'San Antonio', 'state'=>'Tx', 'password' => 'password', 'username' => 'roger123']
];

$query = 'INSERT INTO users(first_name, last_name, email, city, state, password, username) VALUES(:first_name, :last_name, :email, :city, :state, :password, :username)';
$stmt = $dbc->prepare($query);
foreach ($users as $user) {
    $stmt->bindValue(':first_name', $user['first_name'], PDO::PARAM_STR);
    $stmt->bindValue(':last_name', $user['last_name'], PDO::PARAM_STR);
    $stmt->bindValue(':email', $user['email'], PDO::PARAM_STR);
    $stmt->bindValue(':city', $user['city'], PDO::PARAM_STR);
    $stmt->bindValue(':state', $user['state'], PDO::PARAM_STR);
    $stmt->bindValue(':password', $user['password'], PDO::PARAM_STR);
    $stmt->bindValue(':username', $user['username'], PDO::PARAM_STR);
    $stmt->execute();
}

?>
