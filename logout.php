<?php
require_once 'vendor/autoload.php';
require_once 'functions.php';
require_once 'mysql_helper.php';
require_once 'init.php';

session_start();

unset($_SESSION['user']);
header("Location: /");

exit();

?>