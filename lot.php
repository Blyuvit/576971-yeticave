<?php

require_once ('functions.php');
require_once ('userdata.php');

$lot = null;
$rates = null;

if (isset($_GET['lot_id'])) {
    $lot_id = $_GET['lot_id'];

    if (array_key_exists($lot_id, $lots)) {
    	$lot = $lots[$lot_id];
    }   
}

if(isset($_COOKIE['myrates'])) {
    $rates = json_decode($_COOKIE['myrates'], true);
}

if (!$lot) {
    http_response_code(404);
}


$page_content = renderTemplate('templates/lot.php', ['lot' => $lot, 'bets' => $bets, 'cats' => $cats, 'lot_id' => $lot_id, 'rates' => $rates]);

$layout_content = renderTemplate('templates/layout.php', ['content' => $page_content, 'title' => $lot['lot-name'], 'cats' => $cats]);

echo $layout_content;

?>