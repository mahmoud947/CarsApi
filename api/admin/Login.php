<?php
require_once '../../operation/AdminOperation.php';

$respnse = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (
        isset($_POST['user_name']) and
        isset($_POST['password'])
    ) {
        $db = new DBAdminOperations;

        if ($db->adminLogin(
            $_POST['user_name'],
            $_POST['password']
        )) {
            $respnse['error'] = false;
            $respnse['message'] = "user login successfully";
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
