<?php
require_once '../../operation/UserOperation.php';

$respnse = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (
        isset($_POST['images'])
    ) {
        $db = new DBUsersOperations;

        if ($db->AddImageArray($_POST['images'])) {
            $respnse['error'] = false;
            $respnse['message'] = "reqeust Inserted successfully";
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
