<?php

$user_id = null;

if(!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['user'])) {
	$user_id = $_SESSION['user']['user_id'];
}

?>