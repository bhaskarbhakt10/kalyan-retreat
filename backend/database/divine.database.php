<?php
require_once dirname(__DIR__, 2) . '/__config.php';
class Database
{

    private $hostname = "localhost";
    private $username;
    private $password;
    private $database;
    private $connection;

    function __construct()
    {
        if (SERVER_IS_LIVE) {

            $this->username = "u595440997_tabor";
            $this->password = "pr/JIA9!^!R9";
            $this->database = "u595440997_tabor";
        } else {
            $this->username = "root";
            $this->password = "";
            $this->database = "tabor-divine";
        }
        $this->connection = new mysqli($this->hostname, $this->username, $this->password, $this->database);
        $this->CreateTableRegister();
        $this->AlterColumnInRegister(TABLE_REGISTER,'Register_Email', 'VARCHAR(255) NOT NULL ','Register_PhoneNo');
        $this->AlterColumnInRegister(TABLE_REGISTER,'Register_AadharNumber', 'VARCHAR(255) NOT NULL','Register_Email');
        $this->AlterColumnInRegister(TABLE_REGISTER,'Register_Retreat', 'VARCHAR(255) NOT NULL','Register_ID');
        $this->AlterColumnInRegister(TABLE_REGISTER,'Register_Status', 'BIT(1) DEFAULT 1','Register_Json');
        $this->CreateTableRetreat();
    }

    function connect()
    {
        return $this->connection;
    }

    function CreateTableRegister()
    {
        $sql = "CREATE TABLE IF NOT EXISTS " . TABLE_REGISTER . " (
            Register_SrNo INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            Register_ID VARCHAR(255) NOT NULL UNIQUE,
            Register_Retreat VARCHAR(255) NOT NULL,
            Register_PhoneNo VARCHAR(10) NOT NULL ,
            Register_Email VARCHAR(255) NOT NULL ,
            Register_AadharNumber LONGTEXT NOT NULL,
            Register_MorePar JSON NOT NULL,
            Register_Json JSON NOT NULL,
            Register_Timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )";
        $result = $this->connect()->query($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    function CreateTableRetreat()
    {
        $sql = "CREATE TABLE IF NOT EXISTS " . TABLE_RETREAT . " (
            Retreat_SrNo INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            Retreat_ID VARCHAR(255) NOT NULL UNIQUE,
            Retreat_Name VARCHAR(255) NOT NULL,
            Retreat_StartDate DATE NOT NULL,
            Retreat_EndDate DATE NOT NULL,
            Retreat_Limit INT(10) NOT NULL,
            Retreat_Venue VARCHAR(100) NOT NULL,
            Retreat_Language VARCHAR(100) NOT NULL,
            Retreat_IsActive BIT(1) NOT NULL DEFAULT 1,
            Retreat_Timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )";
        $result = $this->connect()->query($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    function AlterColumnInRegister($tablename,$column_to_add , $dataType_and_contraints, $afterColumn)
    {
        $sql = "SHOW COLUMNS FROM " . $tablename . " LIKE '$column_to_add'";
        $result = $this->connect()->query($sql);
        if ($result->num_rows === 0) {
            /**
             * 
             * if query results in false create a column
             * 
             */
            $sqlCreateColumn = "ALTER TABLE " . $tablename . " ADD COLUMN $column_to_add $dataType_and_contraints AFTER $afterColumn";
            if ($this->connect()->query($sqlCreateColumn) === TRUE) {
            } else {
                return false;
            }
        } else {
            return false;
        }
    }


    function __destruct()
    {
        return $this->connection->close();
    }
}
