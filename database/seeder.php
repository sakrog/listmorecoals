<?php
require_once 'config.php';
require_once 'dbconnect.php';

$dbc->exec('TRUNCATE users;');

$users = [
	['first_name' => 'Roger', 'last_name'=> 'Chin', 'email'=> 'roger.sc.chin@gmail.com', 'city'=>'San Antonio', 'state'=>'Tx', 'password' => 'password', 'username' => 'roger123'],
	['first_name' => 'Sakib', 'last_name' => 'Shaikh', 'email' => 'sakib84@gmail.com', 'city' => 'Boerne', 'state' => 'TX', 'password' => 'pass123', 'username' => 'sshaikh210'],
	['first_name' => 'Pascal', 'last_name' => 'Allen', 'email' => 'Pascal@gmail.com', 'city' => 'Cibolo', 'state' => 'TX', 'password' => 'word123', 'username' => 'pascal456'],
	['first_name' => 'Kinza', 'last_name' => 'Shaikh', 'email' => 'kinza.shaikh@gmail.com', 'city' => 'Boerne', 'state' => 'TX', 'password' => 'secret123', 'username' => 'kshaikh210'],
	['first_name' => 'Saamir', 'last_name' => 'Shaikh', 'email' => 'saamir@gmail.com', 'city' => 'Boerne', 'state' => 'TX', 'password' => 'abc123', 'username' => 'saamir91'],
	['first_name' => 'Haniyah', 'last_name' => 'Shaikh', 'email' => 'Hanu@gmail.com', 'city' => 'Boerne', 'state' => 'TX', 'password' => 'hanu123', 'username' => 'hshaikh210']
];

$query = 'INSERT INTO users(first_name, last_name, email, city, state, password, username) VALUES(:first_name, :last_name, :email, :city, :state, :password, :username)';
$stmt = $dbc->prepare($query);
foreach ($users as $user) {
    $stmt->bindValue(':first_name', $user['first_name'], PDO::PARAM_STR);
    $stmt->bindValue(':last_name', $user['last_name'], PDO::PARAM_STR);
    $stmt->bindValue(':email', $user['email'], PDO::PARAM_STR);
    $stmt->bindValue(':city', $user['city'], PDO::PARAM_STR);
    $stmt->bindValue(':state', $user['state'], PDO::PARAM_STR);
    $stmt->bindValue(':password', password_hash($user['password'], PASSWORD_DEFAULT), PDO::PARAM_STR);
    $stmt->bindValue(':username', $user['username'], PDO::PARAM_STR);
    $stmt->execute();
}

?>
