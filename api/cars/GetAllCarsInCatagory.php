<?php
require_once '../../operation/CarOperation.php';
$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['car_category'])) {

        $db = new DBCarsOperations();
        if ($db->getAllCarsInfoByCategory($_GET['car_category'])) {
            $response = $db->getAllCarsInfoByCategory($_GET['car_category']);
            echo json_encode($response, JSON_PRETTY_PRINT);
        } else {
            $response['error'] = true;
            $response['message'] = "empity category";
            echo json_encode($response);
        }
    } else {
        $response['error'] = true;
        $response['message'] = "Require fields are missing";
        echo json_encode($response, JSON_PRETTY_PRINT);
    }
}
 