<?php
require_once '../../operation/CarOperation.php';
$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['car_id'])) {

        $db = new DBCarsOperations();
        if ($db->getCarsInfoByCarID($_GET['car_id'])) {
            $response = $db->getCarsInfoByCarID($_GET['car_id']);
            echo json_encode($response, JSON_PRETTY_PRINT);
        } else {
            $response['error'] = true;
            $response['message'] = "car not found";
            echo json_encode($response);
        }
    } else {
        $response['error'] = true;
        $response['message'] = "Require fields are missing";
        echo json_encode($response, JSON_PRETTY_PRINT);
    }
}
