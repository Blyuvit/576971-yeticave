<?php 
require_once 'vendor/autoload.php';
require_once 'functions.php';
require_once 'mysql_helper.php';


$db = require_once 'config/db.php';

$link = mysqli_connect($db['host'], $db['user'], $db['password'], $db['database']); 
if (!$link) { 
        showError(mysqli_connect_error());
}   
   
mysqli_set_charset($link, 'utf8');


?>