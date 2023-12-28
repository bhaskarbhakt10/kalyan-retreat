<?php

require_once dirname(__DIR__, 2) . '/database/divine.database.php';
require_once dirname(__DIR__, 3) . '/__config.php';

class Register
{

    private $db;
    private $regId;
    private $phoneno;
    private $email;
    private $aadharNo;
    private $lang;
    private $detailsJson;
    private $moreParticipants;
    private $retreat;

    function __construct(&$regId = null, &$phoneno = null, &$email = null, &$aadharNo = null, &$detailsJson = null, &$lang = null, &$moreParticipants = null, &$retreat = null)
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
        $this->aadharNo = $aadharNo;
        $this->lang = $lang;
        $this->detailsJson = $detailsJson;
        $this->moreParticipants = $moreParticipants;
        $this->retreat = $retreat;

        /**
         * 
         * Insert Into DB
         * 
         */
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

    function GetDataByCol($columnName, $value)
    {
        $sql = "SELECT * FROM " . TABLE_REGISTER . " WHERE $columnName = '$value' ";
        $result = $this->db->connect()->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                return $row[$columnName];
            }
        } else {
            return false;
        }
    }

    private function InsertDetails($registrationId)
    {
        $check_phoneNmber = $this->GetDataByCol('Register_PhoneNo', $this->phoneno);
        $check_email = $this->GetDataByCol('Register_Email', $this->email);
        $check_aadhar = $this->GetDataByCol('Register_AadharNumber', $this->aadharNo);
        $check_regId = $this->GetDataByCol('Register_ID', $registrationId);

        if (($check_phoneNmber === false) && ($check_email === false) && ($check_aadhar === false) && ($check_regId === false)) {
             
            $finalJson = $this->generateMoreParRegistrationID($registrationId, $this->moreParticipants);

            $sql = "INSERT INTO " . TABLE_REGISTER . " (Register_ID, Register_Retreat, Register_PhoneNo, Register_Email, Register_AadharNumber, Register_MorePar, Register_Json) VALUES ('" . $registrationId . "','".$this->retreat."','" . $this->phoneno . "','" . $this->email . "','" . $this->aadharNo . "','".mysqli_real_escape_string($this->db->connect(), $finalJson)."','" . mysqli_real_escape_string($this->db->connect(), $this->detailsJson) . "') ";
            $results = $this->db->connect()->query($sql);
            if ($results) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    private function generateRegistrationID()
    {
        $reg = "TAB/" . $this->lang . "/#";
        if ($this->GetAllDbRows() === false) {
            $idCount = 1;
        } else {
            $idCount = $this->GetAllDbRows()->num_rows + 1;
        }

        return $reg .= str_pad((string)$idCount, 3, '0', STR_PAD_LEFT);
    }

    private function generateMoreParRegistrationID($registrationId, $moreinfoJson)
    {
        $moreinfo = json_decode($moreinfoJson, true);
        $idCount = 0;
        foreach ($moreinfo as $key => $moreinfoPar) {
            $idCount += 1;
            $moreinfo[$key]['ID'] = $registrationId ."-#PAR".str_pad((string)$idCount, 3, '0', STR_PAD_LEFT);;
        }
        
        return json_encode($moreinfo);
        
    }

    function DecryptData($datatodecrypt, $iv)
    {
        $encryptedData = $datatodecrypt;
        $decryptionMethod = CIPHER;
        $secretKey = KEY;
        $iv = base64_decode($iv);
        $decryptedData = openssl_decrypt($encryptedData, $decryptionMethod, $secretKey, 0, $iv);

        if ($decryptedData === false) {
            return openssl_error_string();
        } else {
            return $decryptedData;
        }
    }

    function Insertdatabse()
    {
        $registrationId = $this->generateRegistrationID();
        return $this->InsertDetails($registrationId);
    }

    function ShowData()
    {

         $sql = "SELECT * FROM " . TABLE_REGISTER . " WHERE Register_Status=1";
        $result = $this->db->connect()->query($sql);
        if ($result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }
}
