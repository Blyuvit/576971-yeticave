<?php
require_once ('functions.php');
require_once ('userdata.php');

$page_content = renderTemplate('templates/index.php', ['cats' => $cats, 'lots' => $lots]);

$layout_content = renderTemplate('templates/layout.php', ['content' => $page_content, 'title' => 'Главная', 'cats' => $cats]);

echo $layout_content;

?>