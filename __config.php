<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/**
 * 
 * Database setting
 * 
 */
if (!defined("SERVER_IS_LIVE")) {
    $serverName = $_SERVER['SERVER_NAME'];
    if ($serverName === 'localhost') {
        $serverLive = false;
    } else {
        $serverLive = true;
    }
    define("SERVER_IS_LIVE", $serverLive);
}

if (!defined('BASE_FOLDER')) {
    if(SERVER_IS_LIVE){
        $base = "/tabor/";
    }
    else{
        $base = "/kalyan-retreat/";
    }
    define('BASE_FOLDER', $base);
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
 * Admin url
 * 
 */
if (!defined("ADMIN_NAV")) {
    $admin_nav = ROOT_URL . 'admin/index?q=';
    define("ADMIN_NAV", $admin_nav);
}

/**
 * 
 * PDF
 * 
 */
if (!defined("PDF_IMAGES")) {
    $pdf_image = ROOT_URL . 'assets/images/PDF/';
    define("PDF_IMAGES", $pdf_image);
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
if (!defined('TODAYS_TIME')) {
    $date = new DateTime('now');
    $todays_date = $date->format('h:i:s a');
    define('TODAYS_TIME', $todays_date);
}



/**
 * 
 * cipher
 * 
 */
if (!defined('CIPHER')) {
    $cipher = "AES-256-CBC";
    define('CIPHER', $cipher);
}

if (!defined('KEY')) {
    $key = 'ThisIsASecretKey123';
    define('KEY', $key);
}

/***
 * 
 * Tables
 * 
 */

if (!defined('TABLE_REGISTER')) {
    $registerTable = 'tdra_register';
    define('TABLE_REGISTER', $registerTable);
}
if (!defined('TABLE_RETREAT')) {
    $retreatTable = 'tdra_retreat';
    define('TABLE_RETREAT', $retreatTable);
}
