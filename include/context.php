<?php
    error_reporting(-1);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);

    date_default_timezone_set('Europe/Bucharest');

	$password = 'md5 of your password as string';

    if (isset($_COOKIE['user']) and $_COOKIE['user'] === $password) {
        $auth = True;
    } else {
	    $auth = False;
    }

    $storage = getcwd() . "/uploads/";

    function ago($past) {
        $time = time() - $past;
        $time = ($time < 1) ? 1 : $time;
        $tokens = array (
            31536000 => 'year',
            2592000 => 'month',
            604800 => 'week',
            86400 => 'day',
            3600 => 'hour',
            60 => 'minute',
            1 => 'second'
        );
        foreach ($tokens as $unit => $text) {
            if ($time < $unit) continue;
            $numberOfUnits = round($time / $unit);
            return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
        }
    }

    function redirect() {
        $url = empty($_SERVER['HTTP_REFERER']) ? '/' : $_SERVER['HTTP_REFERER'];
        header('Location: ' . $url);
        exit;
    }
?>
