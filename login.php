<?php
require_once 'functions.php';
require_once 'mysql_helper.php';
require_once 'init.php';

$input = $_POST;
$errors = [];

$sql1 = 'SELECT * FROM categories';
if ($result1 = mysqli_query($link, $sql1)) {
        $categories = mysqli_fetch_all($result1, MYSQLI_ASSOC);
}
else {
	showError(mysqli_error($link));
}  

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $input['email'] && $input['password']) {
	$email = mysqli_real_escape_string($link, $input['email']);
	$password = mysqli_real_escape_string($link, $input['password']);
	$sql2 = "SELECT * FROM users WHERE email = '$email'";
	if ($result2 = mysqli_query($link, $sql2)) {
			if (!mysqli_num_rows($result2)) {
				$errors['email'] = "Пользователь с данным e-mail не найден";
				$page_content = renderTemplate('templates/login.php', ['categories' => $categories, 'errors' => $errors, 'input' => $input]);
				$page_layout = renderTemplate('templates/layout.php', ['content' => $page_content, 'categories' => $categories, 'title' => 'Yeticave - Вход на сайт']);
				echo $page_layout;
				exit();
			}
			$user = mysqli_fetch_array($result2, MYSQLI_ASSOC);
			if (password_verify($password, $user['password'])) {
					session_start();
				 	$_SESSION['user'] = $user;
				 	header("Location: /");
				 	exit();
			}
			else {
					$errors['password'] = "Вы ввели неверный пароль";
					$page_content = renderTemplate('templates/login.php', ['categories' => $categories, 'errors' => $errors, 'input' => $input]);
			}
	}
	else {
		showError(mysqli_error($link));
	}
}
else {
	$required = ['email', 'password'];
	foreach ($input as $key => $value) {
		if (in_array($key, $required) && !$value) {
			$errors[$key] = "Это поле необходимо заполнить";
		}
	}
	if (count($errors)) {
		$page_content = renderTemplate('templates/login.php', ['categories' => $categories, 'errors' => $errors, 'input' => $input]);
	}
	else {
		$page_content = renderTemplate('templates/login.php', ['categories' => $categories]);
	}
}

$page_layout = renderTemplate('templates/layout.php', ['content' => $page_content, 'categories' => $categories, 'title' => 'Yeticave - Вход на сайт']);

echo $page_layout;


?>