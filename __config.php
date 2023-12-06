<?php
error_reporting(1);

if (!defined('BASE_FOLDER')) {
    define('BASE_FOLDER', "/kalyan-retreat/");
}
/**
 * Root paths and folder
 * 
 */
if (!defined("ROOT_PATH")) {
    define("ROOT_PATH", $_SERVER['DOCUMENT_ROOT'] . BASE_FOLDER);
}
if (!defined("ROOT_URL")) {
    $root_url = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . BASE_FOLDER;
    define("ROOT_URL", $root_url);
}
if (!defined("FORM_ACTION")) {
    $root_url = ROOT_URL . 'backend/actions/';
    define("FORM_ACTION", $root_url);
}


/**
 * 
 * Date Time Setting;
 * 
 */

if (!defined('TIMEZONE')) {
    $timezone = date_default_timezone_set('Asia/Kolkata');
    define('TIMEZONE', $timezone);
}

if (!defined('TODAYS_DATE')) {
    $date = new DateTime('now');
    $todays_date = $date->format('Y-m-d');
    define('TODAYS_DATE', $todays_date);
}

/**
 * 
 * Database setting
 * 
 */
if (!defined("SERVER_IS_LIVE")) {
    $serverName = $_SERVER['SERVER_NAME'];
    if ($serverName === 'localhost' || str_contains($serverName, 'ngrok-free.app')) {
        $serverLive = false;
    } else {
        $serverLive = true;
    }
    define("SERVER_IS_LIVE", $serverLive);
}



/***
 * 
 * Tables
 * 
 */

if (!defined('TABLE_REGISTER')) {
    $registerTabe = 'tdra_register';
    define('TABLE_REGISTER', $registerTabe);
}
