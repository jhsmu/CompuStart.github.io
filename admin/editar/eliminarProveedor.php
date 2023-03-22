<?php
    require("..\..\database\basededatos.php");

    $db = new Database();
    $connection = $db->connect();
    $codigo = $_GET["id"];

    $consulta = $connection->prepare("DELETE FROM proveedor WHERE id_proveedor=?");
    $resultado = $consulta->execute([$codigo]);

    if ($resultado) {
        session_start();
        $_SESSION['eliminar_proveedor'] = 'registro';
        header("location: ../proveedor.php");
    } else {
        echo "<script languaje='JavaScript'>
            alert('Los datos fueron NO se eliminaron');
            location.assign('../proveedor.php');</script>";
    }
