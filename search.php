<?php
require_once 'vendor/autoload.php';
require_once 'functions.php';
require_once 'mysql_helper.php';
require_once 'init.php';
require_once 'categories.php';

$search = trim($_GET['search'] ?? '');
$lots = [];
$page = $_GET['page'] ?? 1;
$pagelots = 9;
$pages = [];
$pagesqty = NULL;
$error = NULL;

if ($_SERVER['REQUEST_METHOD'] == 'GET' && $search) {
		$sql1 = 'SELECT lot_id, lotname, image, initprice, catname, completed_at, created_at FROM lots JOIN categories on lots.category_id = categories.category_id WHERE MATCH(lotname, description) AGAINST(?) ORDER BY created_at DESC';
		$stmt = db_get_prepare_stmt($link, $sql1, [$search]);
		mysqli_stmt_execute($stmt);
		$result1 = mysqli_stmt_get_result($stmt);
		if (!$result1) {
				showError(mysqli_error($link));
		}
		else {
				$lotsqty = mysqli_num_rows($result1);	
				$pagesqty = ceil($lotsqty / $pagelots);
				$pages = range(1, $pagesqty);
				$offset = ($page - 1) * $pagelots;

				$sql2 = $sql1.' LIMIT '. $pagelots.' OFFSET '. $offset;
				$stmt = db_get_prepare_stmt($link, $sql2, [$search]);
				mysqli_stmt_execute($stmt);
				$result2 = mysqli_stmt_get_result($stmt);
				if (mysqli_num_rows($result2)) {
						$lots = mysqli_fetch_all($result2, MYSQLI_ASSOC);
				}
				else {
						$error = "По вашему запросу ничего не найдено";
				}			
		}
}

$page_content = renderTemplate('templates/search.php', ['categories' => $categories, 'search' => $search, 'lots' => $lots, 'pages' => $pages, 'pagesqty' => $pagesqty, 'page' => $page, 'error' => $error]);

$layout_content = renderTemplate('templates/layout.php', ['content' => $page_content, 'title' => 'Yeticave - Главная', 'categories' => $categories, 'search' => $search]);
echo $layout_content;


?>