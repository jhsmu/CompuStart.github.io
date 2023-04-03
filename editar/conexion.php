<?php

$dbname="compu_start";
$dbuser="root";
$dbhost="localhost";
$dbpass="";

$conexion=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

try{
    $DB_con = new PDO("mysql:host={$dbhost};dbname={$dbname};charset=UTF8",$dbuser,$dbpass);
    $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
  catch(PDOException $e){
    echo $e->getMessage();
  }

?>
