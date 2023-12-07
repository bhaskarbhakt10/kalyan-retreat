<?php
require_once dirname(__DIR__) . '/classes/register/class.register.php';
require_once dirname(__DIR__, 2) . '/__config.php';

if (isset($_POST) && !empty($_POST)) {
    print_r($_POST);

    if (
        array_key_exists('tdra_fullname', $_POST) && array_key_exists('tdra_age', $_POST) && array_key_exists('tdra_phone_number', $_POST) && array_key_exists('tdra_email', $_POST) && array_key_exists('tdra_aadhar_number', $_POST) && array_key_exists('tdra_address', $_POST) &&
        array_key_exists('tdra_language', $_POST) && array_key_exists('tdra_accommodation', $_POST)
    ) {
        $_POST['register_date'] = TODAYS_DATE;
        $_POST['register_time'] = TODAYS_TIME;

        $phoneNo = $_POST['tdra_phone_number'];
        $email = $_POST['tdra_email'];
        $aadharNo = $_POST['tdra_aadhar_number'];

        $lang = $_POST['tdra_language'];
        $details = json_encode($_POST);

        if (!empty($phoneNo) && !empty($email) && !empty($aadharNo)) {


            $cipher = CIPHER;
            $ivlen = openssl_cipher_iv_length($cipher);
            $iv = openssl_random_pseudo_bytes($ivlen);
            $aadharno = openssl_encrypt($aadharNo, $cipher, $key, $options = 0, $iv, $tag);
            // echo $original_plaintext = openssl_decrypt($aadharno, $cipher, $key, $options=0, $iv, $tag);

            $register = new Register($regID, $phoneNo, $email, $aadharno, $details, $lang);
        }
    }
}
