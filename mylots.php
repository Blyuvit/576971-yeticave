<?php

require_once ('userdata.php');
require_once ('functions.php');

if (isset($_COOKIE['myrates'])) {
    $rates = json_decode($_COOKIE['myrates'], true);
}

$page_content = renderTemplate('templates/mylots.php', ['cats' => $cats, 'lots' => $lots, 'rates' => $rates]);
$page_layout = renderTemplate('templates/layout.php', ['content' => $page_content, 'cats' => $cats, 'title' => 'Yeticave - Мои ставки']);
echo $page_layout;

?>