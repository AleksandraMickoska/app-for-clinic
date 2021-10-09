<?php
interface IDatabase 
{
    //will return all doctors from database
    public function GetDoctors();
    
    //will check if the doctor exists in database
    public function CheckDoctor($email,$password);

    //will get all patients for specified doctor
    public function GetPatients($doctorsId);
}
?>