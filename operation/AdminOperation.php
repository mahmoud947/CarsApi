<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type:application/json");
header("Access-Control-Allow-Headers: *");

class DBAdminOperations
{
    private $con;

    function __construct()
    {
        include_once dirname(__FILE__) . '../../includes/DB_Con.php';
        $db = new DBconnect();
        $this->con = $db->connect();
    }

    public function adminLogin($userName, $password)
    {
        $stm = $this->con->query("Select * from admin where user_name=? and password=?");
        
    }
}
