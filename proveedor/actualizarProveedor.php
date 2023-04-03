<?php
    //Para poder usar la clase Database y su función connect
    require('../database/basededatos.php');

    //Creamos un objeto del tipo Database
    $db = new Database();
    $connection = $db->connect(); //Creamos la conexión a la BD

    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $telefono = $_POST['telefono'];
        $direccion = $_POST['direccion'];
        $estado=$_POST['estado_proveedor'];

        try {
            $query = $connection->prepare("UPDATE proveedor SET nombre=?, apellido=?, telefono=?, direccion=?, estado_proveedor=? WHERE id_proveedor=?");// Traduzco mi petición
            $actualizar = $query->execute([$nombre, $apellido, $telefono, $direccion, $estado, $id]); //Ejecuto mi petición

            if ($actualizar) {
                session_start();
                $_SESSION['actualizar'] = 'registro';
                header("location: ../admin/proveedor.php");
            } else {
                session_start();
                $_SESSION['error_actualizar'] = 'actualizar';
                header("location: ../admin/proveedor.php");
            }
        } catch (\Throwable $th) {
            session_start();
            $_SESSION["tel"]="Telefono repetido.";
            header("location: ../admin/actualizarProveedor.php?id=".$id);
        }
    }
?>