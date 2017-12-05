<?php

/**
 * Подключает переданный файл, захватывает его содержимое
 *
 * @param $template_path string Путь к файлу-шаблону
 * @param $template_data array Массив с данными шаблона
 *
 * @return $template_content string Сгенерированный HTML код страницы
 */

function renderTemplate($template_path, $template_data) 
{
	if (file_exists($template_path))
	{
		extract($template_data);
		ob_start();
		require_once ($template_path);
		$template_content = ob_get_clean();
	}
	else 
	{
		$template_content = "";
	}
	return $template_content;
}

/**
 * Возвращает время в относительном формате: сколько минут или часов назад была сделана ставка
 *
 * @param $bettime int Время в формате временной метки
 *
 * @return $timepassed string Время в относительном формате
 */

function bettimeformat ($bettime)
{
    $now = strtotime('now');
    $timediff=($now-$bettime)/3600;
    
    if ($timediff<24)
    {
        if ($timediff<1)
        {
            $timediff = $timediff*60;
            $timepassed = floor($timediff)." минут назад";
        }
        else 
        {
            $timepassed = floor($timediff)." часов назад";
        }
    }
    else 
    {
        $timepassed=date("d.m.y", $bettime)." в ".date("H:i", $bettime);
    }
    return $timepassed;
}

/**
 * Осуществляет поиск пользователя по его e-mail
 *
 * @param $email string E-mail пользователя
 * @param $users array Массив существующих пользователей
 *
 * @return $result array Найденный пользователь или null
 */

function searchUserByEmail($email, $users) {
    $result = null;
    foreach ($users as $user) {
        if ($email == $user['email']) {
            $result = $user;
            break;
        }
    }
    return $result;
}

function searchLotRate($lotid, $rates) {
    $result = null;
    if ($rates) {
        foreach ($rates as $rate) {
            if ($lotid == $rate['lotid']) {
                $result = $rate['lotid'];
                break;
            }
        }
    }
    return $result;
}

/*function connectDB($host, $user, $password, $database) {
    try {
        $link = mysqli_connect($host, $user, $password, $database);
        if (!$link) { 
            $error = mysqli_connect_error();
            throw new Exception($error);  
        }    
    }
    catch (Exception $e) {
        echo $e->getMessage();
        die;
    }
    return $link;
}*/

?>