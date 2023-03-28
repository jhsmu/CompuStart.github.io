<?php
    //Para poder usar la clase Database y su función connect
    require('../database/basededatos.php');

    //Creamos un objeto del tipo Database
    $db = new Database();
    $connection = $db->connect(); //Creamos la conexión a la BD

    if (isset($_POST['id'])) {
        $correo = $_POST['id'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];
        $contraseña = $_POST['contraseña'];

        $query = $connection->prepare("UPDATE cliente SET nombre=?, apellido=?, direccion=?, telefono=?, contrasenia=? WHERE email=?");// Traduzco mi petición
        $actualizar = $query->execute([ $nombre, $apellido, $direccion, $telefono, $contraseña, $correo]); //Ejecuto mi petición

        if ($actualizar) {
            echo "<h2> Datos del cliente actualizados <h2>";
        } else {
            echo "<h2> Error al Actualizar <h2>";
        }
        echo "<a href='consultaCliente.php'>Regresar</a>";
    }
?>