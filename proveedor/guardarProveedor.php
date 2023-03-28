<?php
    //Para poder usar la clase Database y su función connect
    require('../database/basededatos.php');

    //Creamos un objeto del tipo Database
    $db = new Database();
    $connection = $db->connect(); //Creamos la conexión a la BD

    $proveedor = $_POST['proveedor'];
    $correo = $_POST['correo'];
    $web = $_POST['direccion_web'];
    $direccion = $_POST['direccion'];

    $query = $connection->prepare("INSERT INTO proveedor(proveedor, correo, direccion_web, direccion) VALUES(?, ?, ?, ?)");// Traduzco mi petición
    $guardar = $query->execute([$proveedor, $correo, $web, $direccion]); //Ejecuto mi petición

    if ($guardar) {
        session_start();
        $_SESSION['proveedor'] = 'registro';
        header("location: ../admin/proveedor.php");
        
    } else {
        session_start();
        $_SESSION['proveedor_error'] = 'guardad';
        header("location: ../admin/proveedor.php");
    }
