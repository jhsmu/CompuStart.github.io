<?php
    //Para poder usar la clase Database y su función connect
    require('../database/basededatos.php');

    //Creamos un objeto del tipo Database
    $db = new Database();
    $connection = $db->connect(); //Creamos la conexión a la BD

    $marca = $_POST['marca'];

    $query = $connection->prepare("INSERT INTO marca(marca) VALUES(?)");// Traduzco mi petición
    $guardar = $query->execute([$marca]); //Ejecuto mi petición

    if ($guardar) {
        session_start();
        $_SESSION['marca'] = 'registro';
        header("location: ../admin/marca.php");
    } else {
        echo "<script> alert 'Error al crear el proveedor' </script>";
    }