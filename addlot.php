<?php

require_once 'functions.php';
require_once 'mysql_helper.php';
require_once 'init.php';
require_once 'userdata.php';

if(!isset($_SESSION)) {
    session_start();
}
if(!isset($_SESSION['user'])) {
	http_response_code(403);
    exit ();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$required = ['lot-name', 'category', 'message', 'lot-rate', 'lot-step', 'lot-date', 'url'];
	$requiredint = ['lot-rate', 'lot-step'];
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

	if (!empty($_FILES['url']['name'])) {
		$tmp_name = $_FILES['url']['tmp_name'];
		$path = 'img/'.$_FILES['url']['name'];
		$file_type = mime_content_type($tmp_name);
		if (($file_type == 'image/jpeg' || $file_type == 'image/png') && !$errors) {
			move_uploaded_file($tmp_name, $path);
			$inputlot['url'] = $path;
		}
		else {
			$errors['url'] = 'Загрузите файл в формате jpeg/png';
		}
	}
	else {
		$errors['url'] = 'Загрузите файл';
	}

	if ($inputlot['lot-date'] && strtotime($inputlot['lot-date']) <= $now = time()) {
		$errors['lot-date'] = 'Введите любую дату после '.date('d.m.Y',$now);
	}

	if($inputlot['lot-date'] && date('d.m.Y', strtotime($inputlot['lot-date'])) != $inputlot['lot-date']) {
		$errors['lot-date'] = 'Введите дату в формате дд.мм.гггг';
	}

	if (count($errors)) {
		$page_content = renderTemplate('templates/addlot.php', ['cats' => $cats, 'errors' => $errors, 'inputlot' => $inputlot]);
	}
	else {
			$page_content = renderTemplate('templates/lot.php', ['cats' => $cats, 'bets' => $bets, 'lot' => $inputlot]);
	}
}
else {
	$page_content = renderTemplate('templates/addlot.php', ['cats' => $cats]);
}

$page_layout = renderTemplate('templates/layout.php', ['content' => $page_content, 'title' => 'Добавление нового лота', 'cats' => $cats]);

echo $page_layout;


?>