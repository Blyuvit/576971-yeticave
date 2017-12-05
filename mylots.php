<?php

require_once 'functions.php';
require_once 'mysql_helper.php';
require_once 'init.php';
require_once 'userdata.php';

if (isset($_COOKIE['myrates'])) {
    $rates = json_decode($_COOKIE['myrates'], true);
}

$page_content = renderTemplate('templates/mylots.php', ['cats' => $cats, 'lots' => $lots, 'rates' => $rates]);
$page_layout = renderTemplate('templates/layout.php', ['content' => $page_content, 'cats' => $cats, 'title' => 'Yeticave - Мои ставки']);
echo $page_layout;

?>