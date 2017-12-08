<?php

require_once 'functions.php';
require_once 'mysql_helper.php';
require_once 'init.php';
require_once 'categories.php';

$user_id = null;
if(!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['user'])) {
	$user_id = $_SESSION['user']['user_id'];
}

$sql1 = 'SELECT rates.rate_id, rate, rates.created_at, lots.lot_id, lotname, image, completed_at, catname FROM rates JOIN lots ON rates.lot_id = lots.lot_id JOIN categories ON lots.category_id = categories.category_id WHERE rates.user_id='.$user_id;
$result1 = mysqli_query($link, $sql1);
if ($result1) {
        $rates = mysqli_fetch_all($result1, MYSQLI_ASSOC);
} 
else {
        showError(mysqli_error($link));
}

$page_content = renderTemplate('templates/mylots.php', ['categories' => $categories, 'rates' => $rates]);
$page_layout = renderTemplate('templates/layout.php', ['content' => $page_content, 'categories' => $categories, 'title' => 'Yeticave - Мои ставки']);

echo $page_layout;

?>