<?php
require_once 'vendor/autoload.php';
require_once 'functions.php';
require_once 'mysql_helper.php';
require_once 'init.php';

$lotinfo = [];

$sql1 = 'SELECT * FROM lots WHERE completed_at <= UNIX_TIMESTAMP(NOW()) AND winner_id IS NULL';
$result1 = mysqli_query($link, $sql1);
if (!$result1) {
        showError(mysqli_error($link));
}  

$lotsclosed = mysqli_fetch_all($result1, MYSQLI_ASSOC);
foreach ($lotsclosed as $key => $value) {
		$sql2 = 'SELECT rates.lot_id, lotname, rates.user_id, name, email 
				FROM rates 
				JOIN (SELECT rates.lot_id, 
				MAX(rates.created_at) AS maxdate FROM rates 
				GROUP BY rates.lot_id) AS maxdates 
				ON rates.lot_id = maxdates.lot_id AND rates.created_at = maxdate JOIN lots ON rates.lot_id = lots.lot_id 
				JOIN users ON rates.user_id = users.user_id WHERE rates.lot_id ='.$value['lot_id'];
		$result2 = mysqli_query($link, $sql2);
		if (!$result2) {
        		showError(mysqli_error($link));
		} 

		$lotinfo = mysqli_fetch_array($result2, MYSQLI_ASSOC);
		$sql3 = 'UPDATE lots SET winner_id ='.$lotinfo['user_id'].' WHERE lot_id='.$lotinfo['lot_id'];
		$result3 = mysqli_query($link, $sql3);
		if (!$result3) {
        		showError(mysqli_error($link));
		} 

		$page = renderTemplate('templates/email.php', ['name' => $lotinfo['name'], 'lot_id' => $lotinfo['lot_id'], 'lotname' => $lotinfo['lotname']]);

		$transport = new Swift_SmtpTransport('smtp.mail.ru', 465, 'ssl');
		$transport->setUsername('doingsdone@mail.ru');
		$transport->setPassword('rds7BgcL');


		$message = new Swift_Message("Ваша ставка победила");
		$message->setTo([$lotinfo['email'] => $lotinfo['name']]);
		$message->setBody($page, 'text/html');
		$message->setFrom("doingsdone@mail.ru", "Yeticave");
						
		$mailer = new Swift_Mailer($transport);
		$mailer->send($message);
}

		



?>