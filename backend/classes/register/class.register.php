<?php

require_once dirname(__DIR__, 2) . '/database/divine.database.php';
require_once dirname(__DIR__, 3) . '/__config.php';

class Register
{

    private $db;
    function __construct()
    {
        $this->db = new Database();
       
    }

    
}
