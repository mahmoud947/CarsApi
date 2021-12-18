<?php
require_once '../../operation/AdminOperation.php';

$respnse = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (
        isset($_POST['req_id'])
    ) {
        $db = new DBAdminOperations;

        if ($db->deleteRequestByReqID(
            $_POST['req_id']
        )) {
            $respnse['error'] = false;
            $respnse['message'] = "request Deleted successfully";
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
