<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type:application/json");
header("Access-Control-Allow-Headers: *");
// header('WWW-Authenticate: Negotiate');


class DBUsersOperations
{
    private $con;

    function __construct()
    {
        include_once dirname(__FILE__) . '../../includes/DB_Con.php';
        $db = new DBconnect();
        $this->con = $db->connect();
    }

    public function AddNewReq($f_name, $l_name, $birth_date, $address, $phone, $email, $car_id, $front_id, $rear_id, $license)
    {
        $stm = $this->con->prepare(
            "INSERT INTO `clint_request` (`req_id`, `f_name`, `l_name`, `birth_date`, `address`, `phone`,`email`, `car_id`) VALUES (NULL, ?, ?, ?, ?, ?, ?,?);"
        );
        $stm->bind_param("ssssssi", $f_name, $l_name, $birth_date, $address, $phone, $email, $car_id);
        if ($stm->execute())
            if ($this->AddNewReqDoc($front_id, $rear_id, $license))
                return true;
            else
                return false;
        else
            return false;
    }


    public function AddNewReqDoc($front_id, $rear_id, $license)
    {
        $stm = $this->con->prepare(
            "INSERT INTO `request_doc` (`doc_id`, `req_id`, `front_id`, `rear_id`, `license`) VALUES (NULL,(SELECT MAX(req_id) FROM clint_request),?,?,?);"
        );
        $date = date('YmdHis');
        $front_id_path = "../../api/image/front_id$date.jpg";
        $front_id_actulpath = "http://localhost/carsApi/api/image/front_id$date.jpg";

        $rear_id_path = "../../api/image/rear_id$date.jpg";
        $rear_id_actulpath = "http://localhost/carsApi/api/image/rear_id$date.jpg";

        $license_id_path = "../../api/image/license$date.jpg";
        $license_id_actulpath = "http://localhost/carsApi/api/image/license$date.jpg";

        $stm->bind_param("sss", $front_id_actulpath, $rear_id_actulpath, $license_id_actulpath);
        if ($stm->execute()) {
            file_put_contents($front_id_path, base64_decode($front_id));
            file_put_contents($rear_id_path, base64_decode($rear_id));
            file_put_contents($license_id_path, base64_decode($license));
            return true;
        } else
            return false;
    }












    ///////////test image array
    public function AddImageArray($image)
    {
        foreach ($image as $value) {
            $date = date('YmdHis');
            $index = array_search($value, array_merge($image));
            $front_id_path = "../../api/image/free$date.$index.jpg";
            file_put_contents($front_id_path, base64_decode($value));
        }
        return true;
    }
}
