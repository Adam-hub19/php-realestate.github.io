<?php
ini_set('display_errors', 1);
//error_reporting(0);
ini_set('max_execution_time', '100000');
//session_start();
define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');

define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'property');

define('SITE_PATH', dirname(__FILE__));
//
define('SITE_URL', 'http://localhost/real_estate/');
define('TEST_SITE_URL', SITE_URL);

date_default_timezone_set('Asia/Calcutta');
require_once(SITE_PATH . '/dbconnect.php');