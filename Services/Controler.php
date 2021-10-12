<?php

require_once __DIR__ . '/Service.php';
require_once __DIR__ . '/Database.php';

if(!Service::getInstance()->IsDbConnect())
{
    Service::getInstance()->ConnectDb(new Database());
}

$method = $_POST['method'];

switch($method)
{
    case "LogIn":
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $output =  Service::getInstance()->LogIn($email,$pass);
        $json = json_encode($output);
        return $json;
        break;
    case "LogOut":
        $output = Service::getInstance()->LogOut();   
        break;    
    default:
        break;
}


?>