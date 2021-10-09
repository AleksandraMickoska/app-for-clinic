<?php
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/functions.php';

$email = $_POST['email'];
$password= password_hash($_POST['password'], PASSWORD_DEFAULT);

$result = $mysqli->query("SELECT username FROM doctors WHERE Email_address = '$email' AND Password='$password'");
$row_count = $result->num_rows;
if($row_count == 1)
{
    header("Location: patients.php");
}



// header("Location: index.php?status=error");
// die();
?>