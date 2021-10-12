<?php
require_once __DIR__ . "../../consts.php";
require_once __DIR__ . '../../Interfaces/IDatabase.php';

class Database implements IDatabase
{
    private $pdo;

    private $_getDoctors="SELECT * FROM doctors";

    private $_checkDoctor="SELECT * FROM doctors WHERE Email=:email AND Password=:password";

    private $_getPatients="SELECT * FROM patients WHERE DoctorsId=:id";

    public function __construct()
    {
        $this->initializeDatabase();
    }

    private function initializeDatabase()
    {
        try {
            $this->pdo= new PDO(
                "mysql:host=localhost;dbname=" . DB_NAME,DB_USER,DB_PASS,
                [
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );
        } catch (PDOException $e) {
            echo "Database connection failed";
            die();
        }
    }

    public function GetDoctors()
    {
        try{
            $stmt=$this->pdo->prepare($this->_getDoctors);
            $stmt->execute();    
            return $stmt->fetchAll();
        }catch(exception $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function CheckDoctor($email, $password)
    {
        try {
            $stmt = $this->pdo->prepare($this->_checkDoctor);
            $stmt->bindValue('email', $email, PDO::PARAM_STR);
            $stmt->bindValue('password', $password, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        } catch (exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function GetPatients($doctorsId)
    {
        try {
            $stmt = $this->pdo->prepare($this->_getPatients);
            $stmt->bindValue('id', $doctorsId, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (exception $e) {
            echo $e->getMessage();
            return false;
        }
    }
}

?>