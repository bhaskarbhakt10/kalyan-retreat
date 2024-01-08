<?php
require_once dirname(__DIR__, 2) . '/__config.php';
require_once ROOT_PATH . 'backend/classes/retreat/class.retreat.php';
require_once ROOT_PATH . 'backend/classes/register/class.register.php';
require_once ROOT_PATH . 'backend/functions/function.php';

if (isset($_POST) && !empty($_POST)) {


    $response_Array = array();

    $retreat = new Retreat();
    $register = new Register();


    if (
        (array_key_exists('lang', $_POST) && !empty($_POST['lang']))
        &&
        (array_key_exists('email', $_POST) && empty($_POST['email']))
        &&
        (array_key_exists('phone', $_POST) && empty($_POST['phone']))
    ) {


        $lang = $_POST['lang'];

        $retreats = $retreat->GetRetreatsByLang($lang);
        if ($retreats === false) {
            $response_Array['msg'] = 'No Retreat Found';
        } else {
            if ($retreats->num_rows > 0) {
                $response_Array['status'] = true;
                $response_Array['msg'] =  "Data Found";
                $response_Array['data'] = array();
                $response_Array['data']['total_retreat_found'] = $retreats->num_rows;

                while ($row = $retreats->fetch_assoc()) {

                    $response_Array['data']['retreat'][$row['Retreat_ID']]['id'] = $row['Retreat_ID'];
                    $response_Array['data']['retreat'][$row['Retreat_ID']]['name'] = $row['Retreat_Name'];
                    $response_Array['data']['retreat'][$row['Retreat_ID']]['start_date'] = CONVERTDATEFORMAT_READ('Y-m-d', 'd/m/Y', $row['Retreat_StartDate']);
                    $response_Array['data']['retreat'][$row['Retreat_ID']]['end_date'] = CONVERTDATEFORMAT_READ('Y-m-d', 'd/m/Y', $row['Retreat_EndDate']);
                    $response_Array['data']['retreat'][$row['Retreat_ID']]['venue'] = $row['Retreat_Venue'];
                }
            }
        }
    } else if (
        (array_key_exists('lang', $_POST) && !empty($_POST['lang']))
        &&
        (array_key_exists('email', $_POST) && !empty($_POST['email']))
        &&
        (array_key_exists('phone', $_POST) && !empty($_POST['phone']))
    ) {

        // print_r($_POST);

        $lang = $_POST['lang'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        $alredayreserved = $register->getRetreatBookedbyemail($email, $phone);
        if (!empty($alredayreserved)) {
            $retreats = $retreat->GetRetreatsByLang($lang);

            // print_r($alredayreserved);

            if ($retreats === false) {
                $response_Array['msg'] = 'No Retreat Found from reserved retreat';
            } else {
                if ($retreats->num_rows > 0) {
                    $response_Array['status'] = true;
                    $response_Array['msg'] =  "Data Found";
                    $response_Array['data'] = array();
                    $response_Array['data']['total_retreats'] = $retreats->num_rows;
                    $response_Array['data']['total_reserved_retreat'] = count($alredayreserved);
                    $response_Array['data']['total_retreat_found'] = $response_Array['data']['total_retreats'] - $response_Array['data']['total_reserved_retreat'];

                    foreach ($alredayreserved as $key => $alreday_participated) {
                        while ($row = $retreats->fetch_assoc()) {

                            if ($alreday_participated === $row['Retreat_ID']) {
                            } else {
                                $response_Array['data']['retreat'][$row['Retreat_ID']]['id'] = $row['Retreat_ID'];
                                $response_Array['data']['retreat'][$row['Retreat_ID']]['name'] = $row['Retreat_Name'];
                                $response_Array['data']['retreat'][$row['Retreat_ID']]['start_date'] = CONVERTDATEFORMAT_READ('Y-m-d', 'd/m/Y', $row['Retreat_StartDate']);
                                $response_Array['data']['retreat'][$row['Retreat_ID']]['end_date'] = CONVERTDATEFORMAT_READ('Y-m-d', 'd/m/Y', $row['Retreat_EndDate']);
                                $response_Array['data']['retreat'][$row['Retreat_ID']]['venue'] = $row['Retreat_Venue'];
                            }
                        }
                    }
                }
            }
        } else {

            $retreats = $retreat->GetRetreatsByLang($lang);
            if ($retreats === false) {
                $response_Array['msg'] = 'No Retreat Found';
            } else {
                if ($retreats->num_rows > 0) {
                    $response_Array['status'] = true;
                    $response_Array['msg'] =  "Data Found";
                    $response_Array['data'] = array();
                    $response_Array['data']['total_retreat_found'] = $retreats->num_rows;

                    while ($row = $retreats->fetch_assoc()) {

                        $response_Array['data']['retreat'][$row['Retreat_ID']]['id'] = $row['Retreat_ID'];
                        $response_Array['data']['retreat'][$row['Retreat_ID']]['name'] = $row['Retreat_Name'];
                        $response_Array['data']['retreat'][$row['Retreat_ID']]['start_date'] = CONVERTDATEFORMAT_READ('Y-m-d', 'd/m/Y', $row['Retreat_StartDate']);
                        $response_Array['data']['retreat'][$row['Retreat_ID']]['end_date'] = CONVERTDATEFORMAT_READ('Y-m-d', 'd/m/Y', $row['Retreat_EndDate']);
                        $response_Array['data']['retreat'][$row['Retreat_ID']]['venue'] = $row['Retreat_Venue'];
                    }
                }
            }
        }
    } else {
        $response_Array['status'] = false;
        $response_Array['msg'] =  "Seems Like Input Fields Are Missing";
    }


    // print_r($response_Array);

    echo json_encode($response_Array);
}
