<?php
require_once 'vendor/autoload.php';
require_once 'functions.php';
require_once 'mysql_helper.php';
require_once 'init.php';
require_once 'categories.php';

$inputrate = $_POST;
$error = '';
$lot_id = $inputrate['lot_id'];

if($_SERVER['REQUEST_METHOD'] == 'POST' && $inputrate['rate']) {
		if (!ctype_digit($inputrate['rate'])) {
				header('Location: /lot.php?lot_id='.$lot_id.'&err=1');
				exit();
		}
		if ($inputrate['rate'] < $inputrate['price'] + $inputrate['steprate']) {
				header('Location: /lot.php?lot_id='.$lot_id.'&err=2');
				exit();
		}
		else {
				$sql = 'INSERT INTO rates (created_at, rate, user_id, lot_id) VALUES (UNIX_TIMESTAMP(NOW()), ?, ?, ?)';
        		$stmt = mysqli_prepare($link, $sql);
		        mysqli_stmt_bind_param($stmt, 'iii', $inputrate['rate'], $inputrate['user_id'], $lot_id);
        		$res = mysqli_stmt_execute($stmt);
        		if ($res) {
	            		header('Location: /lot.php?lot_id='.$lot_id);
						exit();
       			 }
        		else {
            			showError(mysqli_error($link));	
       			 }
				
		}
}
else {
		header('Location: /lot.php?lot_id='.$lot_id.'&err=3');
		exit();
}


?>