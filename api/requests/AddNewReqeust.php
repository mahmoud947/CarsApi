<?php
require_once '../../operation/UserOperation.php';

$respnse = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (
        isset($_POST['f_name']) and
        isset($_POST['l_name']) and
        isset($_POST['birth_date']) and
        isset($_POST['address']) and
        isset($_POST['phone']) and
        isset($_POST['email']) and
        isset($_POST['car_id']) and
        isset($_POST['front_id']) and
        isset($_POST['rear_id']) and
        isset($_POST['license'])
    ) {
        $db = new DBUsersOperations;

        if ($db->AddNewReq(
            $_POST['f_name'],
            $_POST['l_name'],
            $_POST['birth_date'],
            $_POST['address'],
            $_POST['phone'],
            $_POST['email'],
            $_POST['car_id'],
            $_POST['front_id'],
            $_POST['rear_id'],
            $_POST['license']
        )) {
            $respnse['error'] = false;
            $respnse['message'] = "reqeust Inserted successfully";
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
