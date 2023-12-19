<?php

require_once dirname(__DIR__, 3) . '/__config.php';
require_once ROOT_PATH . 'backend/database/divine.database.php';

class Retreat
{
    private $db;

    private $name;
    private $startdate;
    private $enddate;
    private $limit;
    private $venue;
    private $lang;
    private $type;

    function __construct($name = null, $startdate = null, $enddate = null, $limit = null, $venue = null, $lang = null, $type = null)
    {
        $this->db = new Database();

        /**
         * 
         * Assigning to var 
         *
         */

        $this->name = mysqli_real_escape_string($this->db->connect(), $name);
        $this->startdate = $startdate;
        $this->enddate = $enddate;
        $this->limit = $limit;
        $this->venue =  $venue;
        $this->lang =  $lang;
        $this->type =  $type;
    }

    function GetAllDbRows()
    {
        $sql = "SELECT * FROM " . TABLE_RETREAT;
        $result = $this->db->connect()->query($sql);
        if ($result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }

    private function generateRetreatID()
    {
        $reg = "TAB/RETREAT/#";
        if ($this->GetAllDbRows() === false) {
            $idCount = 1;
        } else {
            $idCount = $this->GetAllDbRows()->num_rows + 1;
        }

        return $reg .= str_pad((string)$idCount, 3, '0', STR_PAD_LEFT);
    }

    private function CheckRetreatExists($retreatName, $retreatStartDate, $retreatEndDate, $retreatvenue, $retreatlang)
    {

        $fStartDate = $this->UpdateDateFormat($retreatStartDate);
        $fEndDate = $this->UpdateDateFormat($retreatEndDate);
        $sql = "SELECT * FROM " . TABLE_RETREAT . " WHERE Retreat_Name='$retreatName' AND Retreat_StartDate ='$fStartDate' AND Retreat_EndDate='$fEndDate' AND Retreat_Venue='$retreatvenue' AND Retreat_Language='$retreatlang' AND Retreat_IsActive=1";
        $results = $this->db->connect()->query($sql);
        if ($results->num_rows === 0) {
            return false;
        } else {
            return true;
        }
    }
    private function UpdateDateFormat($date)
    {
        $formattedDate = DateTime::createFromFormat('d/m/Y', $date);
        if ($formattedDate !== false) {
            return $formattedDate->format('Y-m-d');
        }
    }

    private function InsertRetreat($retreatId)
    {
        if ($this->CheckRetreatExists($this->name, $this->startdate, $this->enddate, $this->venue, $this->lang) === false) {

            $fStartDate = $this->UpdateDateFormat($this->startdate);
            $fEndDate = $this->UpdateDateFormat($this->enddate);
            $sql = "INSERT INTO " . TABLE_RETREAT . " (Retreat_ID , Retreat_Name, Retreat_StartDate, Retreat_EndDate, Retreat_Limit, Retreat_Venue, Retreat_Language) VALUES ('" . $retreatId . "','" . $this->name . "','" . $fStartDate . "','" . $fEndDate . "'," . $this->limit . ",'" . $this->venue . "','" . $this->lang . "') ";
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

    function readActiveRetreats()
    {
        $sql = "SELECT * FROM " . TABLE_RETREAT . " WHERE Retreat_IsActive=1";
        $results = $this->db->connect()->query($sql);
        if ($results->num_rows > 0) {
            return $results;
        } else {
            return false;
        }
    }

    function InsertDatabase()
    {
        $retreatId = $this->generateRetreatID();
        return $this->InsertRetreat($retreatId);
    }
}
