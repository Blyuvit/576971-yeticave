<?php
require_once 'functions.php';
require_once 'mysql_helper.php';
require_once 'init.php';
require_once 'userdata.php';

if (!$link) { 
            $error = mysqli_connect_error();
            $page_content = renderTemplate('templates/error.php', ['error' => $error]);
            echo $page_content;
            exit();
        }    

$page_content = renderTemplate('templates/index.php', ['cats' => $cats, 'lots' => $lots]);
$layout_content = renderTemplate('templates/layout.php', ['content' => $page_content, 'title' => 'Yeticave - Главная', 'cats' => $cats]);
echo $layout_content;

?>