<?php

require_once __DIR__ . "/db.php";

function showPatientsInfo()
{
  $takeInfo = $mysqli->query("SELECT *  FROM patients");

}

?>