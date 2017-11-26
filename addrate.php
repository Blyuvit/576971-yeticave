<?php

if($_SERVER['REQUEST_METHOD'] == 'POST') {
	$inputrate = $_POST;
	if (!isset($_COOKIE['myrates'])) {
		$name = 'myrates';
		$savedrate [] = $inputrate;
		$value = json_encode($savedrate);
		$expire = strtotime('time()+3600');
		$path = '/';		
	}
	else {
		$name = 'myrates';
		$savedrates = json_decode($_COOKIE['myrates'], true);
		$savedrates [] = $inputrate;
		$value = json_encode($savedrates);
		$expire = strtotime('time()+3600');
		$path = '/';	
	}
	setcookie($name, $value, $expire, $path);
  	header('Location: /mylots.php');
    exit();
}


?>