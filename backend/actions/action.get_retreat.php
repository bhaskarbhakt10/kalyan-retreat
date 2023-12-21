<?php
require_once dirname(__DIR__, 2) . '/__config.php';
require_once ROOT_PATH . 'backend/classes/retreat/class.retreat.php';
require_once ROOT_PATH . 'backend/functions/function.php';

if (isset($_POST) && !empty($_POST)) {


    $response_Array = array();
    $response_Array['status'] = false;
    $response_Array['msg'] =  "Seems Like Input Fields Are Missing";


    if (array_key_exists('lang', $_POST)) {

        $lang = $_POST['lang'];
        $retreat = new Retreat();

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

    echo json_encode($response_Array);
}
