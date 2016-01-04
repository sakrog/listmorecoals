<?php
require_once 'config.php';
require_once 'dbconnect.php';

echo $dbc->getAttribute(PDO::ATTR_CONNECTION_STATUS) . "\n";

$query = 'DROP TABLE IF EXISTS users';
$dbc->exec($query);
$query = 'CREATE TABLE users (
	userid INT UNSIGNED NOT NULL AUTO_INCREMENT,
	first_name VARCHAR(240) NOT NULL,
	last_name VARCHAR(240) NOT NULL,
	email VARCHAR(240) NOT NULL UNIQUE,
	city VARCHAR(240) NOT NULL,
	state VARCHAR(2) NOT NULL,
	password VARCHAR(240) NOT NULL,
	username VARCHAR(100) NOT NULL,
	image LONGBLOB NOT NULL,
	PRIMARY KEY (userid)
	)';
$dbc->exec($query);

$query = 'DROP TABLE IF EXISTS posts';
$dbc->exec($query);
$query = 'CREATE TABLE posts (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	userid INT UNSIGNED NOT NULL,
	post_date DATE NOT NULL,
	title VARCHAR(240) NOT NULL,
	price VARCHAR(240) NOT NULL,
	description VARCHAR(240) NOT NULL,
	email VARCHAR(240) NOT NULL,
	location VARCHAR(240) NOT NULL,
	image LONGBLOB NOT NULL,
	PRIMARY KEY (id)
	)';
$dbc->exec($query);

?>