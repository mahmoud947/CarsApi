<?php
class DBconnect
{
    private $con;

    function __construct()
    {
    }

    function connect()
    {
        include_once dirname(__FILE__) . '/Config.php';
        $this->con = new mysqli(DB_HOST, DB_UserName, DB_PASSWORD, DB_NAME);

        if (mysqli_connect_errno()) {
            echo "Failded to connect with to Database" . mysqli_connect_errno();
        }
        return $this->con;
    }
}
