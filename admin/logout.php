<?php session_start();
require_once 'classess/config.php';
require_once 'classess/function.php';

$admin = new ADMIN();
$admin->adminLogout();
header('Location:login.php');
exit(0);