<?php
define('SITEURL', 'http://localhost/Watchshop/');
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'watch-shop');
$con = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($con)); //database connection
$db_select = mysqli_select_db($con, DB_NAME) or die(mysqli_error($con));