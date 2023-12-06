<?php

require_once dirname(__DIR__, 2) . '/database/divine.database.php';
require_once dirname(__DIR__, 3) . '/__config.php';

class Register
{

    private $db;
    private $regId;
    private $phoneno;
    private $email;
    private $detailsJson;

    function __construct(&$regId = null, &$phoneno = null,&$email = null, &$detailsJson = null)
    {
        /**
         * 
         * Calling database class
         */
        $this->db = new Database();

        /**
         * 
         * Assigning values for registartion
         * 
         */

         $this->regId = $regId;
         $this->phoneno = $phoneno;
         $this->email = $email;
         $this->detailsJson = $detailsJson;

        /**
         * 
         * Insert Into DB
         * 
         */

         $this->InsertDetails();

    }

    function GetAllDbRows()
    {
        $sql = "SELECT * FROM " . TABLE_REGISTER;
        $result = $this->db->connect()->query($sql);
        if ($result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }



    function InsertDetails()
    {
        $sql = "INSERT INTO " .TABLE_REGISTER ." (Register_ID,Register_PhoneNo,Register_Email,Register_Json) VALUES ('".$this->regId."','".$this->phoneno."','".$this->email."','".$this->detailsJson."') ";
        $results = $this->db->connect()->query($sql);
        if($results){
            return true;
        }
    }

    function generateRegistrationID(&$lang, &$acc)
    {   
        $idCount = 0;
        if($this->GetAllDbRows() === false){

        }
        else{

        }
    }
}
