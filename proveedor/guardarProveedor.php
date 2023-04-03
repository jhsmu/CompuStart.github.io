<?php
    //Para poder usar la clase Database y su función connect
    require('../database/basededatos.php');

    //Creamos un objeto del tipo Database
    $db = new Database();
    $connection = $db->connect(); //Creamos la conexión a la BD

    // Cuando la conexión está establecida...
    $consulta = $connection->prepare("SELECT * FROM proveedor"); // Traduzco mi petición
    $consulta->execute(); //Ejecuto mi petición

    $datos = $consulta->fetchAll(PDO::FETCH_ASSOC); //Me traigo los datos que necesito

    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $direccion = $_POST['direccion'];
    $estado=1;
    $proveedor = $_POST["proveedor"];      
    $nit = $_POST["nit"];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $web = $_POST['direccion_web'];
    

    try {
        $query = $connection->prepare("INSERT INTO proveedor(proveedor, nombre, apellido, nit, correo, telefono,  direccion_web, direccion, estado_proveedor) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)");// Traduzco mi petición
        $guardar = $query->execute([$proveedor, $nombre, $apellido, $nit, $correo, $telefono, $web, $direccion, $estado]); //Ejecuto mi petición
    
        if ($guardar) {
            session_start();
            $_SESSION['proveedorExitoso'] = 'registro';
            header("location: ../admin/proveedor.php");
        } else {
            session_start();
            $_SESSION['proveedor_error'] = 'guardad';
            header("location: ../admin/proveedor.php");
        }  
    } catch (\Throwable $th) {
        session_start();
        $_SESSION["proveedorRepetido"] = "proveedor repetida";
        header('location:../admin/proveedor.php?nombre='.$nombre.'&apellido='.$apellido.'&proveedor='.$proveedor.'&nit='.$nit.'&correo='.$correo.'&tel='.$telefono.'&web='.$web.'&direccion='.$direccion); 
    }
    
         