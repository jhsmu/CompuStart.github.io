<?php
session_start();
require('../database/basededatos.php');

//Creamos un objeto del tipo Database
$db = new Database();
$connection = $db->connect(); //Creamos la conexión a la BD

$id = $_GET["id"];

 // Cuando la conexión está establecida...
 $consulta = $connection->prepare("SELECT * FROM proveedor WHERE id_proveedor=:id");// Traduzco mi petición
 $consulta->execute(['id' => $id]); //Ejecuto mi petición

$prove = $consulta->fetch(PDO::FETCH_ASSOC);
?>