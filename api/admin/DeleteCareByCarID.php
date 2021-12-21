<?php
require_once '../../operation/AdminOperation.php';

$respnse = array();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['car_id'])) {
        $db = new DBAdminOperations();
        if ($db->deleteCareByCarID($_GET['car_id'])) {
            $respnse['error'] = false;
            $respnse['message'] = "car Deleted successfully";
        } else {
            $respnse['error'] = true;
            $respnse['message'] = "Some error occurred";
        }
    } else {
        $respnse['error'] = true;
        $respnse['message'] = "Require fields are missing";
    }
    echo json_encode($respnse);
}
