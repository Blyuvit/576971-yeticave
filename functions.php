<?php

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

?>