<?php
require_once __DIR__ . "../../consts.php";
require_once __DIR__ . '../../IDatabase.php';

class Database implements IDatabase
{
    private $pdo;

    private $_getDoctors="SELECT * FROM doctors";

    private $_checkDoctor="SELECT * FROM doctor WHERE Email_address=:email AND Password=:password";

    private $_getPatients="SELECT * FROM patients WHERE doctor_id=:id";

    function __construct()
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
        $stmt=$this->pdo->prepare($this->_getDoctors);
        $stmt->execute([]);    
        return $stmt->fetchAll();
    }

    public function CheckDoctor($email, $password)
    {
        $stmt=$this->pdo->prepare($this->_checkDoctor);
        $stmt->bindValue('email', $email, PDO::PARAM_STR);
        $stmt->bindValue('password', $password, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function GetPatients($doctorsId)
    {
        $stmt=$this->pdo->prepare($this->_getPatients);
        $stmt->bindValue('id',$doctorsId, PDO::PARAM_STR);
        $stmt->execute([]);
        return $stmt->fetchAll();
    }
}

?>