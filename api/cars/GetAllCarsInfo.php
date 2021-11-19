<?php
require_once '../../operation/CarOperation.php';
$respnse = array();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $db = new DBCarsOperations();
    if ($db->getAllCarsInfo()) {
        $respnsee = $db->getAllCarsInfo();
        echo json_encode($respnsee, JSON_PRETTY_PRINT);
    } else {
        $respnse['error'] = true;
        $respnse['message'] = "Some error occurred";
        echo json_encode($respnse);
    }
}
