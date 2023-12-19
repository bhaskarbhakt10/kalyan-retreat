<?php
require_once dirname(__DIR__, 2) . '/__config.php';
require_once ROOT_PATH . 'backend/classes/retreat/class.retreat.php';

if (isset($_POST) && !empty($_POST)) {

    $response_Array = array();
    $response_Array['status'] = false;
    $response_Array['msg'] =  "Seems Like Input Fields Are Missing";

    // print_r($_POST);

    if (
        array_key_exists('tdra_retreatname', $_POST) && array_key_exists('tdra_retreatsdate', $_POST) && array_key_exists('tdra_retreatedate', $_POST) && array_key_exists('tdra_retreatlimit', $_POST) && array_key_exists('tdra_retreatvenue', $_POST) && array_key_exists('tdra_retreatlang', $_POST) && array_key_exists('tdra_retreattype', $_POST)
    ) {

        $rName = $_POST['tdra_retreatname'];
        $rSdate = $_POST['tdra_retreatsdate'];
        $rEdate = $_POST['tdra_retreatedate'];
        $rLimit = $_POST['tdra_retreatlimit'];
        $rVenue = $_POST['tdra_retreatvenue'];
        $rLang = $_POST['tdra_retreatlang'];
        $rType = $_POST['tdra_retreattype'];


        if (!empty($rName) && !empty($rSdate) && !empty($rEdate)) {

            $retreat = new Retreat($rName, $rSdate, $rEdate, $rLimit, $rVenue, $rLang, $rType);
            if ($retreat->InsertDatabase() === true) {
                $response_Array['status'] = true;
                $response_Array['msg'] =  "Retreat Added Successfully";
            } else {
                $response_Array['status'] = false;
                $response_Array['msg'] =  "Retreat Already Exists!";
            }
        }
    }
    // print_r($response_Array);
    echo json_encode($response_Array);
}
