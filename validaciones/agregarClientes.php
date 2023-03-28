<?php
require_once '../database/conexion.php';
require('../database/basededatos.php');

    $db = new Database();
    $connection = $db->connect(); //Creamos la conexión a la BD

    $consulta=$DB_con->prepare('SELECT email FROM cliente');
    $consulta->execute();
    $emails=$consulta->fetchAll(PDO::FETCH_ASSOC);


if (isset($_POST["crear"])) {
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $tipo = $_POST["tipo_documento"];
    $documento = $_POST["numero_documento"];
    $direccion = htmlentities($_POST["direccion"]);
    $telefono = $_POST["telefono"];
    $estado=1;
    $contrasena = (htmlentities($_POST["clave"]));

    foreach ($emails as $key => $correo) {
        $email = "";
        if ($_POST['email_registro'] === $correo['email']) {
            session_start();
            $_SESSION["emailRepetido"] = "email repetido";
            header('location:../login-registro.php');
            break;
        }else{
            $email = $_POST["email_registro"];
        }
    }


    if (isset($contrasena) and isset($email)) {
        $query = $connection->prepare("INSERT INTO cliente(nombre, apellido, tipo_documento, numero_documento, direccion, telefono, email, contrasenia, estado) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)");// Traduzco mi petición
        $guardar = $query->execute([$nombre, $apellido, $tipo, $documento, $direccion, $telefono, $email, $contrasena, $estado]); //Ejecuto mi petición
    
        if ($guardar) {
            session_start();
            $_SESSION['agregar'] = 'registro';
            header("location: ../login-registro.php");
        } else {
            session_start();
            $_SESSION['error'] = 'registro';
            header("location: ../login-registro.php");
        }
    }
}

    //     try {
    //         if ($guardar) {
    //         session_start();
    //         $_SESSION["registro"]="registro creado con exito";
    //         header("location:../login-registro.php");
    //     } else {
    //         session_start();
    //         $_SESSION["error"]=" error registro";
    //         header("location:../login-registro.php");
    //     }

    //     } catch (\Throwable $th) {
    //         session_start();
    //         $_SESSION["Error al registrar"] = "Error 1";
    //         header('location:../login-registro.php');
    //     }
    // }
/* else{
    session_start();
    $_SESSION["Error al registrar"] = "Error 1";
    header('location:../login-registro.php');

} */