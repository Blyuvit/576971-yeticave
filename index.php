<?php
require_once 'functions.php';
require_once 'mysql_helper.php';
require_once 'init.php';
require_once 'categories.php';

$lots = [];
$sql1 = 'SELECT lot_id, lotname, image, initprice, catname, completed_at FROM lots JOIN categories on lots.category_id = categories.category_id WHERE completed_at > UNIX_TIMESTAMP(NOW())';
$result1 = mysqli_query($link, $sql1);
if ($result1) {
        $lots = mysqli_fetch_all($result1, MYSQLI_ASSOC);
    }  
else {
		showError(mysqli_error($link));
}

$page_content = renderTemplate('templates/index.php', ['categories' => $categories, 'lots' => $lots]);
$layout_content = renderTemplate('templates/layout.php', ['content' => $page_content, 'title' => 'Yeticave - Главная', 'categories' => $categories]);
echo $layout_content;

?>