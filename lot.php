<?php

require_once ('functions.php');
require_once ('userdata.php');

$lot = null;

if (isset($_GET['lot_id'])) {
    $lot_id = $_GET['lot_id'];

    foreach ($lots as $key => $item) {
        if ($key == $lot_id) {
            $lot = $item;
            break;
        }       
    }
}

if (!$lot) {
    http_response_code(404);
}

$page_content = renderTemplate('templates/lot.php', ['lot' => $lot, 'bets' => $bets, 'cats' => $cats]);

$layout_content = renderTemplate('templates/layout.php', ['content' => $page_content, 'title' => $lot['title'], 'cats' => $cats]);

echo $layout_content;

?>