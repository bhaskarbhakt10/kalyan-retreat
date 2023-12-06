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
    }

    function connect()
    {
        return $this->connection;
    }

    function CreateTableRegister()
    {
        $sql = "CREATE TABLE IF NOT EXISTS " . TABLE_REGISTER . " (
            Register_SrNo INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            Register_ID VARCHAR(255) NOT NULL,
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

    function __destruct()
    {
        return $this->connection->close();
    }
}
