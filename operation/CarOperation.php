<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type:application/json");
header("Access-Control-Allow-Headers: *");
// header('WWW-Authenticate: Negotiate');


class DBCarsOperations
{
    private $con;

    function __construct()
    {
        include_once dirname(__FILE__) . '../../includes/DB_Con.php';
        $db = new DBconnect();
        $this->con = $db->connect();
    }

    public function getAllCarsInfo()
    {
        $stm = $this->con->query(
            "SELECT car.car_id,  car.car_name, car.motor_capacity,
            car.mechanical_horse,car.model, car.number_of_set,car.tank_size,car.price,car.count,car.turbo,car.model_year
            ,car_category.category_name as category,admin.user_name as admin_name
            FROM car
            INNER JOIN admin
           ON car.admin_id=admin.admin_id
			 INNER JOIN car_category
           ON car.category_id=car_category.category_id"
        );

        $carsArray = array();

        while ($row = $stm->fetch_assoc()) {
            extract($row);
            $e = array(
                "Id" => $car_id,
                "category" => $category,
                "name" => $car_name,
                "motor_capacity" => $motor_capacity,
                "mechanical_horse" => $mechanical_horse,
                "model" => $model,
                "model_year" => $model_year,
                "number_of_set" => $number_of_set,
                "tank_size" => $tank_size,
                "price" => $price,
                "admin" => $admin_name,
                "count" => $count,
                "turbo" => $turbo,
                "cover" => $this->getCoverImagebyCarID($car_id),
                "image" => $this->getOtherImagebyCarID($car_id)
            );
           
            array_push($carsArray, $e);
        }
        return $carsArray;
    }


    public function getCarsInfoByCarID($car_id)
    {
        $stm = $this->con->query(
            "SELECT car.car_id,  car.car_name, car.motor_capacity,
            car.mechanical_horse,car.model, car.number_of_set,car.tank_size,car.price,car.count,car.turbo,car.model_year
            ,car_category.category_name as category,admin.user_name as admin_name
            FROM car
            INNER JOIN admin
           ON car.admin_id=admin.admin_id
			 INNER JOIN car_category
           ON car.category_id=car_category.category_id AND car.car_id=$car_id"
        );
        $carsArray = array();

        while ($row = $stm->fetch_assoc()) {
            extract($row);
            $e = array(
                "Id" => $car_id,
                "category" => $category,
                "name" => $car_name,
                "motor_capacity" => $motor_capacity,
                "mechanical_horse" => $mechanical_horse,
                "model" => $model,
                "model_year" => $model_year,
                "number_of_set" => $number_of_set,
                "tank_size" => $tank_size,
                "price" => $price,
                "admin" => $admin_name,
                "count" => $count,
                "turbo" => $turbo,
                "cover" => $this->getCoverImagebyCarID($car_id),
                "image" => $this->getOtherImagebyCarID($car_id)
            );

            array_push($carsArray, $e);
        }
        return $carsArray;
    }




    public function getAllCarsInfoByCategory($category_name)
    {
        $stm = $this->con->query(
            "SELECT car.car_id,  car.car_name, car.motor_capacity,
            car.mechanical_horse,car.model, car.number_of_set,car.tank_size,car.price,car.count,car.turbo,car.model_year
            ,car_category.category_name as category,admin.user_name as admin_name
            FROM car
            INNER JOIN admin
           ON car.admin_id=admin.admin_id
			 INNER JOIN car_category
           ON car.category_id=car_category.category_id AND car.category_id=(SELECT category_id FROM car_category WHERE car_category.category_name='$category_name')"
        );
        $carsArray = array();

        while ($row = $stm->fetch_assoc()) {
            extract($row);
            $e = array(
                "Id" => $car_id,
                "category" => $category,
                "name" => $car_name,
                "motor_capacity" => $motor_capacity,
                "mechanical_horse" => $mechanical_horse,
                "model" => $model,
                "model_year" => $model_year,
                "number_of_set" => $number_of_set,
                "tank_size" => $tank_size,
                "price" => $price,
                "admin" => $admin_name,
                "count" => $count,
                "turbo" => $turbo,
                "cover" => $this->getCoverImagebyCarID($car_id),
                "image" => $this->getOtherImagebyCarID($car_id)
            );

            array_push($carsArray, $e);
        }
        return $carsArray;
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
    public function getOtherImagebyCarID($car_id)
    {
        $stm = $this->con->query("SELECT * FROM car_image WHERE  car_id=$car_id");
        $imageArray = array();
        while ($raw = $stm->fetch_assoc()) {
            extract($raw);
            if ($image_type != 'Cover')
                array_push($imageArray, $url);
        }
        return $imageArray;
    }
}
