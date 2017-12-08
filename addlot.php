<?php

require_once 'functions.php';
require_once 'mysql_helper.php';
require_once 'init.php';
require_once 'categories.php';

$user_id = null;

if(!isset($_SESSION)) {
    	session_start();
}
if(!isset($_SESSION['user'])) {
		http_response_code(403);
	    exit ();
}
else {
		$user_id = $_SESSION['user']['user_id'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		$required = ['lotname', 'category_id', 'description', 'initprice', 'steprate', 'completed_at', 'image'];
		$requiredint = ['rate', 'steprate'];
		$inputlot = $_POST;
		$errors = [];

		foreach ($inputlot as $key => $value) {
				if (in_array($key, $required) && !$value) {
						$errors [$key] = 'Это поле необходимо заполнить';			
				}
				if (in_array($key, $requiredint) && $value && !ctype_digit($value)) {
						$errors [$key] = 'Введите целое число больше 0';
				}
		}

		if (!empty($_FILES['image']['name'])) {
				$tmp_name = $_FILES['image']['tmp_name'];
				$path = 'img/'.$_FILES['image']['name'];
				$file_type = mime_content_type($tmp_name);
				if (($file_type == 'image/jpeg' || $file_type == 'image/png') && !$errors) {
						move_uploaded_file($tmp_name, $path);
						$inputlot['image'] = $path;
				}
				else {
						$errors['image'] = 'Загрузите файл в формате jpeg/png';
				}
		}
		else {
				$errors['image'] = 'Загрузите файл';
		}

		if ($inputlot['completed_at'] && strtotime($inputlot['completed_at']) <= $now = time()) {
				$errors['completed_at'] = 'Введите любую дату после '.date('d.m.Y',$now);
		}

		if($inputlot['completed_at'] && date('d.m.Y', strtotime($inputlot['completed_at'])) != $inputlot['completed_at']) {
				$errors['completed_at'] = 'Введите дату в формате дд.мм.гггг';
		}

		if (count($errors)) {
				$page_content = renderTemplate('templates/addlot.php', ['categories' => $categories, 'errors' => $errors, 'inputlot' => $inputlot]);
		}
		else {
				$sql1 = 'INSERT INTO lots (created_at, lotname, description, image, initprice, completed_at, steprate, user_id, category_id) VALUES (UNIX_TIMESTAMP(NOW()), ?, ?, ?, ?, ?, ?, ?, ?)';
	        	$stmt = mysqli_prepare($link, $sql1);
	        	$completed_at = strtotime($inputlot['completed_at']);
	       		mysqli_stmt_bind_param($stmt, 'sssiiiii', $inputlot['lotname'], $inputlot['description'], $inputlot['image'], $inputlot['initprice'], $completed_at, $inputlot['steprate'], $user_id, $inputlot['category_id']);
	        	$res = mysqli_stmt_execute($stmt);
		        if ($res) {
			            $lot_id = mysqli_insert_id($link);
			            header("Location: lot.php?lot_id=". $lot_id);
			            exit();
		        }
		        else {
		            	showError(mysqli_error($link));
		        }
		}
}
else {
		$page_content = renderTemplate('templates/addlot.php', ['categories' => $categories]);
}

$page_layout = renderTemplate('templates/layout.php', ['content' => $page_content, 'title' => 'Yeticave - Добавление нового лота', 'categories' => $categories]);

echo $page_layout;


?>