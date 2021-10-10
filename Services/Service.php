<?php
require_once __DIR__ . '../../Interfaces/IDatabase.php';
require_once __DIR__ . '../../Interfaces/IService.php';
require_once __DIR__ . '/Database.php';

echo'pred service';



class Service implements IService
{
    
    private  $_database;

    public function __construct($database)
    {
        $this->_database = $database;
    }

    public function Login()
    {
        $email=$_POST['email'];
        $password=$_POST['passsword'];
        $this->_database->CheckDoctor();
        
    }
    
}

$MyService  = new Service(new Database);

$method = $_POST['method'];

$MyService->$method(); 


?>