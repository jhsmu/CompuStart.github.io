<?php
    //Para poder usar la clase Database y su función connect
    require('../database/basededatos.php');

    //Creamos un objeto del tipo Database
    $db = new Database();
    $connection = $db->connect(); //Creamos la conexión a la BD

// Cuando la conexión está establecida...
    $consulta = $connection->prepare("SELECT email FROM administrador"); // Traduzco mi petición
    $consulta->execute(); //Ejecuto mi petición

    $administradores = $consulta->fetchAll(PDO::FETCH_ASSOC); //Me traigo los datos que necesito

    if (isset($_POST["crear"])) {
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $contrasena = $_POST['contrasena'];

            $email = $_POST["email"];
    
                    try {
                        session_start();
                        $_SESSION['agregado']="hola";
                        $query = $connection->prepare("INSERT INTO administrador(nombre, apellido, email, contrasenia) VALUES(?, ?, ?, ?)");// Traduzco mi petición
                    $guardar = $query->execute([$nombre, $apellido, $email, $contrasena]); //Ejecuto mi petición
                    header("location: ../admin/usuario.php");

                    } catch (\Throwable $th) {
                        session_start();
                        $_SESSION['AdmiRepetido'] = 'id';
                        header("location: ../admin/usuario.php");
                    }

    }