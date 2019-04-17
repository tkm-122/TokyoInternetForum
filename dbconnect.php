<?php

$host = "192.168.56.101";
$username = "testuser";
$pass = "test";
$dbname = "test";


$mysqli = new mysqli($host, $username, $pass, $dbname);
if($mysqli->connect_error){
  $sql_error = $mysqli->connect_error ;
  error_log($sql_error);
  die($sql_error) ;
}

 ?>
