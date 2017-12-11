<?php
require_once 'vendor/autoload.php';
require_once 'functions.php';
require_once 'mysql_helper.php';
require_once 'init.php';
require_once 'categories.php';
require_once 'getwinner.php';

$lots = [];
$page = $_GET['page'] ?? 1;
$pagelots = 3;
$pages = [];
$pagesqty = NULL;

$sql1 = 'SELECT COUNT(*) as qty FROM lots WHERE completed_at > UNIX_TIMESTAMP(NOW())';
$result1 = mysqli_query($link, $sql1);
if (!$result1) {
        showError(mysqli_error($link));
}  
else {
		$lotsqty = mysqli_fetch_assoc($result1)['qty'];
		$pagesqty = ceil($lotsqty / $pagelots);
		$offset = ($page - 1) * $pagelots;
		$pages = range(1, $pagesqty);
		$sql2 = 'SELECT lot_id, lotname, image, initprice, catname, completed_at, created_at FROM lots JOIN categories on lots.category_id = categories.category_id WHERE completed_at > UNIX_TIMESTAMP(NOW()) ORDER BY created_at DESC LIMIT '. $pagelots .' OFFSET '. $offset;
	    $result2 = mysqli_query($link, $sql2);
	    if (!$result2) {
	    		showError(mysqli_error($link));
	    }
	    else {
	    		$lots = mysqli_fetch_all($result2, MYSQLI_ASSOC);
	    		$page_content = renderTemplate('templates/index.php', ['categories' => $categories, 'lots' => $lots, 'pages' => $pages, 'pagesqty' => $pagesqty, 'page' => $page]);
	    }
}

$layout_content = renderTemplate('templates/layout.php', ['content' => $page_content, 'title' => 'Yeticave - Главная', 'categories' => $categories]);
echo $layout_content;

?>