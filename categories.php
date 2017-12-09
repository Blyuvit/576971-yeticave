<?php
require_once 'vendor/autoload.php';
require_once 'functions.php';
require_once 'mysql_helper.php';
require_once 'init.php';

$categories = [];
$sql = 'SELECT * FROM categories';
$result = mysqli_query($link, $sql);
if ($result) {
        $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
} 
else {
        showError(mysqli_error($link));
}

?>