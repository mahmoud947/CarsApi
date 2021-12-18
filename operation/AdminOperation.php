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
        $stm = $this->con->prepare("select * from admin where user_name=? and password=?");
        $stm->bind_param('ss', $userName, $password);
        $stm->execute();
        $stm->store_result();
        return $stm->num_rows() > 0;
    }
    public function getAllRequest()
    {
        $stm = $this->con->query("SELECT clint_request.req_id,clint_request.f_name,clint_request.l_name,clint_request.birth_date,clint_request.email,
        clint_request.address,clint_request.phone,clint_request.car_id  
        ,car.model , car.price from clint_request 
        INNER JOIN car on
         clint_request.car_id=car.car_id;");

        $requestArray = array();
        while ($row = $stm->fetch_assoc()) {
            extract($row);
            $e = array(
                "req_id" => $req_id,
                "f_name" => $f_name,
                "l_name" => $l_name,
                "birth_date" => $birth_date,
                "address" => $address,
                "phone" => $phone,
                "car_id" => $car_id,
                "model" => $model,
                "price" => $price,
                "email" => $email,
                "cover" => $this->getCoverImagebyCarID($car_id)
            );
            array_push($requestArray, $e);
        }
        return $requestArray;
    }














    public function getCoverImagebyCarID($car_id)
    {
        $stm = $this->con->query("SELECT * FROM car_image WHERE car_id=$car_id");
        $cover = '';
        while ($raw = $stm->fetch_assoc()) {
            extract($raw);
            if ($image_type == 'Cover')
                $cover = $url;
        }
        return $cover;
    }
}
