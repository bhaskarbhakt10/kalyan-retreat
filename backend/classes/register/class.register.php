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

    function __construct(&$regId = null, &$phoneno = null, &$email = null, &$aadharNo = null, &$detailsJson = null, &$lang = null)
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
            $sql = "INSERT INTO " . TABLE_REGISTER . " (Register_ID, Register_PhoneNo, Register_Email, Register_AadharNumber, Register_Json) VALUES ('" . $registrationId . "','" . $this->phoneno . "','" . $this->email . "','" . $this->aadharNo . "','" . mysqli_real_escape_string($this->db->connect(), $this->detailsJson) . "') ";
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

    function generateRegistrationID()
    {
        $reg = "TAB/" . $this->lang . "/#";
        if ($this->GetAllDbRows() === false) {
            $idCount = 1;
        } else {
            $idCount = $this->GetAllDbRows()->num_rows + 1;
        }

        return $reg .= str_pad((string)$idCount, 3, '0', STR_PAD_LEFT);
    }

    function Insertdatabse()
    {
        $registrationId = $this->generateRegistrationID();
        return $this->InsertDetails($registrationId);
    }

    function ShowData()
    {

        $sql = "SELECT * " . TABLE_REGISTER . " WHERE Register_Status=1";
        $result = $this->db->connect()->query($sql);
        if ($result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }
}
