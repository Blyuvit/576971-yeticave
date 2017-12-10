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

function rateTimeFormat ($bettime)
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
 * Осуществляет поиск ставок, сделанных пользователем
 *
 * @param $user_id int Идентификатор пользователя
 * @param $rates array Массив ставок по выбранному лоту
 *
 * @return $result boolean Ставка или есть, или нет
 */

function searchLotRated($user_id, $rates) {
    $lotrated = false;
    foreach ($rates as $key => $value) {
            if ($value['user_id'] == $user_id) {
                    $lotrated = true;
                    break;
            }
    }
    return $lotrated;
}

/**
 * Определяет наличие ставки пользователя по выбранному лоту
 *
 * @param $user_id int Идентификатор пользователя
 * @param $lot array Массив с данными лота
 *
 * @return $lotcreated boolean Ставка уже сделана пользователем или нет
 */

function searchLotCreated($user_id, $lot) {
    $lotcreated = false;
    if ($lot['user_id'] == $user_id) {
            $lotcreated = true;
    }
    return $lotcreated;
}

/**
 * Определяет завершены ли торги по данному лоту
 *
 * @param $lot array Массив с данными лота
 *
 * @return $lotclosed boolean Торги завершены или нет
 */

function searchLotClosed($lot) {
    $lotclosed = true;
    if ($lot['completed_at'] <= strtotime('now')) {
            $lotclosed = false;
    }
    return $lotclosed;
}

/**
 * Определяет оставшееся время до окончания торгов
 *
 * @param $completed_at int Дата завершения торгов в формате временной метки
 *
 * @return $lot_time_remaining string/date Оставшееся время в количестве дней, часов и минут
 */

function lotTimeRemaining($completed_at) {

    date_default_timezone_set('Europe/Moscow');
    $lot_time_remaining = "00:00";
    $now = strtotime('now');
    $timediff = $completed_at - $now;
    $diff = $timediff/86400;
    if ($diff > 1) {
        $daydiff = floor($diff);
        $lot_time_remaining = $daydiff.' дн. '.gmdate("H:i",$timediff);
    }
    else {
        if ($diff > 0) {
            $lot_time_remaining = gmdate("H:i", $timediff);
        }
    }
    return $lot_time_remaining;
}

/**
 * Выводит ошибку функции MySQLi в отдельный шаблон
 *
 * @param $mysqli_error string Cообщение об ошибке последнего вызова функции MySQLi
 *
 */

function showError($mysqli_error) {
    $categories = [];
    $error = $mysqli_error;
    $page_content = renderTemplate('templates/error.php', ['error' => $error]);
    $layout_content = renderTemplate('templates/layout.php', ['content' => $page_content, 'title' => 'Ошибка', 'categories' => $categories]);
    echo $layout_content;
    exit();
}  

?>