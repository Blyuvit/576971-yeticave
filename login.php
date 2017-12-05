<?php
require_once 'functions.php';
require_once 'mysql_helper.php';
require_once 'init.php';
require_once 'userdata.php';

$input = $_POST;
$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $input['email'] && $input['password']) {
	
	$user = searchUserByEmail($input['email'], $users);
	if (!$user) {
		$errors['email'] = "Пользователь с данным e-mail не найден";
		$page_content = renderTemplate('templates/login.php', ['cats' => $cats, 'errors' => $errors, 'input' => $input]);
	}
	else {
		 if (password_verify($input['password'], $user['password'])) {
		 	session_start();
		 	$_SESSION['user'] = $user;
		 	header("Location: /");
		 	exit();
		}
		else {
			$errors['password'] = "Вы ввели неверный пароль";
			$page_content = renderTemplate('templates/login.php', ['cats' => $cats, 'errors' => $errors, 'input' => $input]);
		}
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
		$page_content = renderTemplate('templates/login.php', ['cats' => $cats, 'errors' => $errors, 'input' => $input]);
	}
	else {
		$page_content = renderTemplate('templates/login.php', ['cats' => $cats]);
	}
}

$page_layout = renderTemplate('templates/layout.php', ['content' => $page_content, 'cats' => $cats, 'title' => 'Yeticave - Вход на сайт']);

echo $page_layout;


?>