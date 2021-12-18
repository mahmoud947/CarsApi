<?php
require_once '../../operation/AdminOperation.php';
$respnse = array();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['req_id'])) {

        $db = new DBAdminOperations();
        if ($db->getRequestByReqID($_GET['req_id'])) {
            $response = $db->getRequestByReqID($_GET['req_id']);
            echo json_encode($response, JSON_PRETTY_PRINT);
        } else {
            $response['error'] = true;
            $response['message'] = "Some error occurred";
            echo json_encode($response, JSON_PRETTY_PRINT);
        }
    } else {
        $response['error'] = true;
        $response['message'] = "Require fields are missing";
        echo json_encode($response, JSON_PRETTY_PRINT);
    }
}
