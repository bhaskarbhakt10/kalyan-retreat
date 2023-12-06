<?php
require_once dirname(__DIR__) . '/classes/register/class.register.php';
require_once dirname(__DIR__, 2) . '/__config.php';

if (isset($_POST) && !empty($_POST)) {
    print_r($_POST);

    if (
        array_key_exists('tdra_fullname', $_POST) && array_key_exists('tdra_age', $_POST) && array_key_exists('tdra_phone_number', $_POST) && array_key_exists('tdra_email', $_POST) && array_key_exists('tdra_aadhar_number', $_POST) && array_key_exists('tdra_address', $_POST) &&
        array_key_exists('tdra_language', $_POST) && array_key_exists('tdra_accommodation', $_POST)
    ) {

        $phoneNo = $_POST['tdra_phone_number'];
        $email = $_POST['tdra_email'];
        $details = json_encode($_POST);
        
        if (!empty($phoneNo) && !empty($email)) {
            $regID = "TABOR/".$_POST['tdra_language']."/".$_POST['tdra_accommodation']."/static";
            $register = new Register($regID, $phoneNo, $email, $details);
            // $register->GetAllDbRows();
        }
    }
}
