<?php

require_once ('functions.php');
require_once ('userdata.php');

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
		if (in_array($key, $requiredint) && !ctype_digit($value)) {
			$errors [$key] = 'Это поле должно быть числовое';
		}
	}

	if (!empty($_FILES['url']['name'])) {
		$tmp_name = $_FILES['url']['tmp_name'];
		$path = 'img/'.$_FILES['url']['name'];

		$finfo = finfo_open(FILEINFO_MIME_TYPE);
		$file_type = finfo_file($finfo, $tmp_name);
		if ($file_type == "image/jpeg" && !$errors) {
			move_uploaded_file($tmp_name, $path);
			$inputlot['url'] = $path;
		}
		else {
			$errors['url'] = 'Загрузите картинку';
		}
	}
	else {
		$errors['url'] = 'Вы не загрузили файл';
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