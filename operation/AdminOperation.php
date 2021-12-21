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


    public function getRequestByReqID($req_id)
    {
        $stm = $this->con->query("SELECT clint_request.req_id,clint_request.f_name,clint_request.l_name,clint_request.birth_date,clint_request.email,
        clint_request.address,clint_request.phone,clint_request.car_id  
        ,car.model , car.price from clint_request 
        INNER JOIN car on
         clint_request.car_id=car.car_id and clint_request.req_id=$req_id");

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

    public function deleteRequestByReqID($req_id)
    {
        $stm = $this->con->prepare("DELETE FROM request_doc WHERE request_doc.req_id=?");
        $stm->bind_param('i', $req_id);
        if ($stm->execute()) {
            $stm1 = $this->con->prepare("DELETE FROM clint_request WHERE clint_request.req_id=?");
            $stm1->bind_param('i', $req_id);
            if ($stm1->execute())
                return true;
        } else
            return false;
    }




    public function insertNewCar(
        $car_id,
        $category_id,
        $car_name,
        $model_year,
        $motor_capacity,
        $mechanical_horse,
        $model,
        $number_of_set,
        $tank_size,
        $price,
        $admin_id,
        $count,
        $turbo,
        $cover,
        $images
    ) {
        $stm = $this->con->prepare("INSERT INTO `car` (`car_id`, `category_id`, `car_name`, `model_year`,
         `motor_capacity`, `mechanical_horse`, `model`, `number_of_set`,
          `tank_size`, `price`, `admin_id`, `count`, `turbo`) 
          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $stm->bind_param(
            "iisiiisiddiii",
            $car_id,
            $category_id,
            $car_name,
            $model_year,
            $motor_capacity,
            $mechanical_horse,
            $model,
            $number_of_set,
            $tank_size,
            $price,
            $admin_id,
            $count,
            $turbo
        );

        if ($stm->execute()) {
            if ($this->AddCareImages($images, $car_id, $cover))
                return true;
        } else
            return false;
    }































    ////////////////////////////////////////////////////////

    public function AddCareImages($images, $car_id, $cover)
    {
        $stm = $this->con->prepare(
            " INSERT INTO `car_image` (`image_id`, `url`, `car_id`, `image_type`) 
            VALUES (NULL,?,?,'Cover');"
        );
        $Cover_path = "../../api/image/$car_id.jpg";
        $Cover_actulpath = "http://localhost/carsApi/api/image/$car_id.jpg";
        $stm->bind_param("si", $Cover_actulpath, $car_id);
        if ($stm->execute()) {
            file_put_contents($Cover_path, base64_decode($cover));

            foreach ($images as $value) {

                $stm = $this->con->prepare(
                    " INSERT INTO `car_image` (`image_id`, `url`, `car_id`, `image_type`) 
            VALUES (NULL,?,?,NULL);"
                );
                $index = array_search($value, array_merge($images));
                $image_path = "../../api/image/$car_id.$index.jpg";
                $image_actulpath = "http://localhost/carsApi/api/image/$car_id.$index.jpg";
                $stm->bind_param("si", $image_actulpath, $car_id);
                if ($stm->execute())
                    file_put_contents($image_path, base64_decode($value));
            }
            return true;
        }
        return true;
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
