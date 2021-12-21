<?php
require_once '../../operation/AdminOperation.php';

$respnse = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (
        isset($_POST['car_id']) and
        isset($_POST['category_id']) and
        isset($_POST['car_name']) and
        isset($_POST['model_year']) and
        isset($_POST['motor_capacity']) and
        isset($_POST['mechanical_horse']) and
        isset($_POST['model']) and
        isset($_POST['number_of_set']) and
        isset($_POST['tank_size']) and
        isset($_POST['price']) and
        isset($_POST['admin_id']) and
        isset($_POST['count']) and
        isset($_POST['turbo']) and
        isset($_POST['cover']) and
        isset($_POST['images'])

    ) {
        $db = new DBAdminOperations;

        if ($db->insertNewCar(
            $_POST['car_id'],
            $_POST['category_id'],
            $_POST['car_name'],
            $_POST['model_year'],
            $_POST['motor_capacity'],
            $_POST['mechanical_horse'],
            $_POST['model'],
            $_POST['number_of_set'],
            $_POST['tank_size'],
            $_POST['price'],
            $_POST['admin_id'],
            $_POST['count'],
            $_POST['turbo'],
            $_POST['cover'],
            $_POST['images']
        )) {
            $respnse['error'] = false;
            $respnse['message'] = "car inserted successfully";
        } else {
            $respnse['error'] = true;
            $respnse['message'] = "Some error occurred";
        }
    }
} else {
    $respnse['error'] = true;
    $respnse['message'] = "Require fields are missing";
}
echo json_encode($respnse);
