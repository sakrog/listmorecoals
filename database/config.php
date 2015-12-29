<?php
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'adlister');
define('DB_USER', 'vagrant');
define('DB_PASS', 'vagrant');

require_once '../models/Input.php';
require_once '../database/dbconnect.php';
require_once "../public/functions.php";
require_once "../models/Auth.php";
require_once "../models/User.php";
