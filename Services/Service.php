<?php
require_once __DIR__ . '../../Interfaces/IDatabase.php';


class Service 
{
    // singalton inplementation static variable    
    private static $_instance = null;
    
    // database service connection
    private  IDatabase $_database;


    private bool $_isDbConnect = false;
    private $_doctorID = null;
    /**
     * The Singleton's constructor should always be private to prevent direct
     * construction calls with the `new` operator.
     */
    private function __construct() {}

    /**
     * Singletons should not be cloneable.
     */
    protected function __clone() { }

    /**
     * Singletons should not be restorable from strings.
     */
    public function __wakeup()
    {
        throw new Exception("Cannot unserialize a singleton.");
    }

    // return the instance of the class
    public static function getInstance()
    {
        if (self::$_instance == null) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    //check if database is conncted
    public function IsDbConnect()
    {
        return $this->_isDbConnect;
    }

    //connect to database interface
    public function ConnectDb(IDatabase $database)
    {
        $this->_database = $database;
        $this->_isDbConnect = true;
    }

    //disconect to from database
    public function DisconnectDb()
    {
        $this->_isDbConnect = false;
    }

    public function LogIn($email,$pass)
    {
        $doctor = $this->_database->CheckDoctor($email,$pass);            
        if(!$doctor)
        {
            $return = new stdClass();
            $return->success = false;
            $return->errorMessage = "Invalid user name or pass";
            return $return;
        }
        $this->_doctorID = $doctor['Id'] ;

        $patients = $this->_database->GetPatients($doctor['Id']);
        if(!$patients)
        {
            $return = new stdClass();
            $return->success = true;
            $return->errorMessage = "This doctor does not have any patients";
            return $return;
        }
        
        $return = new stdClass();
        $return->success = true;
        $return->errorMessage = "";
        $return->data = $patients; 
        return $return;
    }

    public function LogOut()
    {
        $this->_doctorID = null;
    }



}

?>