<?php

require_once dirname(__DIR__, 3) . '/__config.php';
require_once ROOT_PATH . 'backend/database/divine.database.php';

class Register
{
    private $db;
    function __construct($name = null, $startdate = null, $enddate = null, $limit = null, $venue = null, $lang = null, $type = null)
    {
        $this->db = new Database();
    }
}
