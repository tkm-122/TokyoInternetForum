<?php

$mysqli = new mysqli('192.168.56.101','testuser', 'test', 'test' ) ;
if($mysqli->connect_error){
  $sql_error = $mysqli->connect_error ;
  error_log($sql_error);
  die($sql_error) ;
}

 ?>
