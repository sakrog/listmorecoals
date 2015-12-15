<?PHP
// migration file for adlister
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'adlister');
define('DB_USER', 'adlister_user');
define('DB_PASS', 'password');

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
	price INT(240) NOT NULL,
	description VARCHAR(240) NOT NULL,
	PRIMARY KEY (id)
	)';
$dbc->exec($query);

?>