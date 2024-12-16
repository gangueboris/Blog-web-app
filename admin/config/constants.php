<?php
session_start();
define('ROOT_URL', 'http://localhost/blogWebApp/');
define('DB_HOST', 'localhost');
define('DB_USER', 'Boris');
define('DB_PWD', 'admin1234');
define('DB_NAME', 'myblog');

$_SESSION['admin-required'] = true;
