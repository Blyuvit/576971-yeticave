<?php

require_once 'functions.php';
require_once 'mysql_helper.php';
require_once 'init.php';
require_once 'categories.php';

$input = $_POST;
$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $input['email'] && $input['name'] && $input['password'] && $input['contacts'] ) {

		if (!empty($_FILES['avatar']['name'])) {
				$tmp_name = $_FILES['avatar']['tmp_name'];
				$path = 'img/'.$_FILES['avatar']['name'];
				$file_type = mime_content_type($tmp_name);
				if (($file_type == 'image/jpeg' || $file_type == 'image/png') && !$errors) {
						move_uploaded_file($tmp_name, $path);
						$input['avatar'] = $path;
				}
				else {
						$errors['avatar'] = 'Загрузите файл в формате jpeg/png';
				}
		}

		if (filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
				$email = $input['email'];
				$sql1 = "SELECT * FROM users WHERE email ='$email'";
				$result1 = mysqli_query($link, $sql1);
				if (!$result1){
						showError(mysqli_error($link));
				}
				if ($result1 && mysqli_num_rows($result1)) {
						$errors['email'] = 'Пользователь с данным e-mail существует';
				}  
		}
		else {
				$errors['email'] = 'Введите корректный e-mail адрес';
		}

		if (count($errors)) {
				$page_content = renderTemplate('templates/sign-up.php', ['categories' => $categories, 'errors' => $errors, 'input' => $input]);
		}
		else {		
				$sql2 = 'INSERT INTO users (created_at, email, name, password, avatar, contacts) VALUES (UNIX_TIMESTAMP(NOW()), ?, ?, ?, ?, ?)';
			    $stmt = mysqli_prepare($link, $sql2);
			    $passhash = password_hash($input['password'], PASSWORD_DEFAULT);
			       		mysqli_stmt_bind_param($stmt, 'sssss', $input['email'], $input['name'], $passhash, $input['avatar'], $input['contacts']);
			    $res = mysqli_stmt_execute($stmt);
				if ($res) {
					        header("Location: login.php");
					        exit();
				}
				else {
				            showError(mysqli_error($link));
				}
		}
}
else {
		$required = ['email', 'name', 'password', 'contacts'];
		foreach ($input as $key => $value) {
				if (in_array($key, $required) && !$value) {
						$errors [$key] = 'Это поле необходимо заполнить';			
				}
		}
		if (count($errors)) {
				$page_content = renderTemplate('templates/sign-up.php', ['categories' => $categories, 'errors' => $errors, 'input' => $input]);
		}
		else {
				$page_content = renderTemplate('templates/sign-up.php', ['categories' => $categories]);
		}
}

$page_layout = renderTemplate('templates/layout.php', ['content' => $page_content, 'title' => 'Yeticave - Регистрация аккаунта', 'categories' => $categories]);

echo $page_layout;






?>