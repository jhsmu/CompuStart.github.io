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

    $validar = "SELECT * FROM proveedor WHERE correo = '$correo' ";
    $validando = $connection->prepare($validar);
    $validando->execute();

    $validar2 = "SELECT * FROM proveedor WHERE proveedor = '$proveedor' ";
    $validando2 = $connection->prepare($validar2);
    $validando2->execute();

    $validar3 = "SELECT * FROM proveedor WHERE nit = '$nit' ";
    $validando3 = $connection->prepare($validar3);
    $validando3->execute();

    $validar4 = "SELECT * FROM proveedor WHERE telefono = '$telefono' ";
    $validando4 = $connection->prepare($validar4);
    $validando4->execute();

    $validar5 = "SELECT * FROM proveedor WHERE direccion_web = '$web' ";
    $validando5 = $connection->prepare($validar5);
    $validando5->execute();

    if($validando2->rowCount() > 0){
        session_start();
        $_SESSION["proveedorRepetido"] = "registro creado con exito";
        header('location:../admin/proveedor.php?nombre='.$nombre.'&apellido='.$apellido.'&proveedor='.$proveedor.'&nit='.$nit.'&correo='.$correo.'&tel='.$telefono.'&web='.$web.'&direccion='.$direccion);
      } else if($validando3->rowCount() > 0){
        session_start();
        $_SESSION["nitRepetido"] = "registro creado con exito";
        header('location:../admin/proveedor.php?nombre='.$nombre.'&apellido='.$apellido.'&proveedor='.$proveedor.'&nit='.$nit.'&correo='.$correo.'&tel='.$telefono.'&web='.$web.'&direccion='.$direccion);
      } else if($validando->rowCount() > 0){
        session_start();
        $_SESSION["correotRepetido"] = "registro creado con exito";
        header('location:../admin/proveedor.php?nombre='.$nombre.'&apellido='.$apellido.'&proveedor='.$proveedor.'&nit='.$nit.'&correo='.$correo.'&tel='.$telefono.'&web='.$web.'&direccion='.$direccion);
      } else if($validando4->rowCount() > 0){
        session_start();
        $_SESSION["telefonotRepetido"] = "registro creado con exito";
        header('location:../admin/proveedor.php?nombre='.$nombre.'&apellido='.$apellido.'&proveedor='.$proveedor.'&nit='.$nit.'&correo='.$correo.'&tel='.$telefono.'&web='.$web.'&direccion='.$direccion);
      } else if($validando5->rowCount() > 0){
        session_start();
        $_SESSION["webRepetido"] = "registro creado con exito";
        header('location:../admin/proveedor.php?nombre='.$nombre.'&apellido='.$apellido.'&proveedor='.$proveedor.'&nit='.$nit.'&correo='.$correo.'&tel='.$telefono.'&web='.$web.'&direccion='.$direccion);
      } else {
    

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
    }
    
         