<?php
require_once '../../operation/AdminOperation.php';
$respnse = array();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $db = new DBAdminOperations();
    if ($db->getAllRequest()) {
        $respnsee = $db->getAllRequest();
        echo json_encode($respnsee, JSON_PRETTY_PRINT);
    } else {
        $respnse['error'] = true;
        $respnse['message'] = "Some error occurred";
        echo json_encode($respnse);
    }
}
