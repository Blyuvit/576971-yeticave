<?php
require_once 'vendor/autoload.php';
require_once 'functions.php';
require_once 'mysql_helper.php';
require_once 'init.php';
require_once 'categories.php';
require_once 'user.php';

$sql1 = 'SELECT rates.rate_id, rate, rates.created_at, lots.lot_id, lotname, winner_id, image, completed_at, contacts FROM rates JOIN lots ON rates.lot_id = lots.lot_id JOIN users ON rates.user_id = users.user_id WHERE rates.user_id='.$user_id;
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