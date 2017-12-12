<?php
require_once 'vendor/autoload.php';
require_once 'functions.php';
require_once 'mysql_helper.php';
require_once 'init.php';
require_once 'categories.php';
require_once 'user.php';

$lot = [];
$lot_id = null;
$lotrated = false;
$lotcreated = false;
$lotclosed = false;
$rates = [];
$ratesqty = 0;
$error = null;
$maxrate = null;

if (isset($_GET['lot_id'])) {
	    $lot_id = intval($_GET['lot_id']);
	    $sql1 = 'SELECT lot_id, lotname, description, image, completed_at, initprice, steprate, catname, user_id FROM lots JOIN categories on lots.category_id = categories.category_id WHERE lot_id ='.$lot_id;
	    if ($result1 = mysqli_query($link, $sql1)) {
		    	if (!mysqli_num_rows($result1)) {
			    		http_response_code(404);
			    		showError('Лот не найден');    		
		    	}
		    	else {
		    			$lot = mysqli_fetch_array($result1, MYSQLI_ASSOC);
		    			$lotcreated = searchLotCreated($user_id, $lot);
		    			$lotclosed = searchLotClosed($lot);
		    	}
	    }
	    else {
	    		showError(mysqli_error($link));	
	    }
}

$sql2 = 'SELECT rates.user_id, rate, rates.created_at, name FROM rates JOIN users ON rates.user_id = users.user_id WHERE rates.lot_id ='.$lot_id.' ORDER BY rate DESC';
if ($result2 = mysqli_query($link, $sql2)) {
		if (mysqli_num_rows($result2)) {
		    	$rates = mysqli_fetch_all($result2, MYSQLI_ASSOC);
		    	$ratesqty = mysqli_num_rows($result2);
		    	$maxrate = $rates[0]['rate'];
		    	$lotrated = searchLotRated($user_id, $rates);
    	}
}  
else {
        showError(mysqli_error($link));
}

if (isset($_GET['err'])) {
		$err = intval($_GET['err']);
				switch ($err) {
				 	case '1':
				 		$error = 'Введите целое число больше 0';
				 		break;
				 	case '2':
				 		$error = 'Введите ставку выше текущей цены с учетом размера мин.ставки';
				 		break;
				 	case '3':
				 		$error = 'Введите ставку';
				 		break;
				 } 
}

$page_content = renderTemplate('templates/lot.php', ['lot' => $lot, 'categories' => $categories, 'rates' => $rates, 'user_id' => $user_id, 'ratesqty' => $ratesqty, 'lotrated' => $lotrated, 'lotcreated' => $lotcreated, 'lotclosed' => $lotclosed, 'error' => $error, 'maxrate' => $maxrate]);

$layout_content = renderTemplate('templates/layout.php', ['content' => $page_content, 'title' => $lot['lotname'], 'categories' => $categories]);

echo $layout_content;

?>