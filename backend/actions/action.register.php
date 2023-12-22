<?php
require_once dirname(__DIR__, 2) . '/__config.php';
require_once ROOT_PATH . 'backend/classes/register/class.register.php';

if (isset($_POST) && !empty($_POST)) {

    $response_Array = array();
    $response_Array['status'] = false;
    $response_Array['msg'] =  "Seems Like Input Fields Are Missing";
    // print_r($_POST);

    if (
        array_key_exists('tdra_fullname', $_POST) && array_key_exists('tdra_dob', $_POST) && array_key_exists('tdra_phone_number', $_POST) && array_key_exists('tdra_email', $_POST) && array_key_exists('tdra_aadhar_number', $_POST) && array_key_exists('tdra_address', $_POST) &&
        array_key_exists('tdra_language', $_POST) && array_key_exists('tdra_accommodation', $_POST)
    ) {
        $_POST['register_date'] = TODAYS_DATE;
        $_POST['register_time'] = TODAYS_TIME;

        $phoneNo = $_POST['tdra_phone_number'];
        $email = $_POST['tdra_email'];
        $aadharNo = $_POST['tdra_aadhar_number'];
        $lang = $_POST['tdra_language'];
        $retreat = $_POST['tdra_retreat'];

        $response_Array['msg'] =  "Some Fields Fields Are Empty";

        if (!empty($phoneNo) && !empty($email) && !empty($aadharNo) && !empty($retreat)) {


            $cipher = CIPHER;
            $key = KEY;
            $iv = random_bytes(openssl_cipher_iv_length($cipher));
            $tag = null;


            $aadharenc = openssl_encrypt($aadharNo, $cipher, $key, $options = 0, $iv, $tag);
            $aadharno = $aadharenc;
            $_POST['enc_iv'] = base64_encode($iv);
            $_POST['enc_aadhar'] = $aadharenc;


            if (array_key_exists('tdra_moreparticipants', $_POST) && (int)$_POST['tdra_moreparticipants'] === 1) {
                $moreParticipants = array();
                $participantCount = 0;
                foreach ($_POST as $post_key => $post_value) {
                    // $explodedkey = explode('-',$post_key);
                    if(
                        ( 
                            (strcasecmp("tdra_morepfullname",$post_key) === 0) || 
                            (strcasecmp("tdra_morepdob",$post_key) === 0)  || 
                            (strcasecmp("tdra_morepaadhar",$post_key) === 0) 
                        ) || 
                        (
                            
                            (strpos($post_key,"tdra_morepfullname") !== false) || 
                            (strpos($post_key,"tdra_morepdob") !== false)  || 
                            (strpos($post_key,"tdra_morepaadhar") !== false) 
                        )
                        ){
                            // $participantCount = ($participantCount + 1)/2;
                            // print_r($post_key. "========" .$participantCount);
                    }
                }
            }


            $details = json_encode($_POST);

            /*
            $register = new Register($regID, $phoneNo, $email, $aadharno, $details, $lang);

            if ($register->Insertdatabse()) {
                $response_Array['status'] = true;
                $response_Array['msg'] =  "Registration Successfull";
            } else {

                $response_Array['status'] = false;
                $response_Array['msg'] =  "User Already Exists! Make Sure You Use An Unregisterd Email,Phone Number And Aadhar Card Number";
            }
            */
        }
    }

    echo json_encode($response_Array);
}
