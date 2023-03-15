<?php
require_once '../database/conexion.php';


$consulta=$DB_con->prepare('SELECT email FROM cliente');
$consulta->execute();
$emails=$consulta->fetchAll(PDO::FETCH_ASSOC);


if (isset($_POST["crear"])) {
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $direccion = htmlentities($_POST["direccion"]);
    $telefono = $_POST["telefono"];
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
        $agregar = $DB_con->prepare('INSERT INTO cliente(apellido, nombre, email, direccion, telefono, contrasenia) VALUES(:apellido, :nombre, :email, :direccion, :telefono, :contrasenia)');
        $agregar->bindParam(':apellido', $apellido);
        $agregar->bindParam(':nombre', $nombre);
        $agregar->bindParam(':email', $email);
        $agregar->bindParam(':direccion', $direccion);
        $agregar->bindParam(':telefono', $telefono);
        $agregar->bindParam(':contrasenia', $contrasena);

        try {
            if ($agregar->execute()) {
            session_start();
            $_SESSION["registro"]="registro creado con exito";
            header("location:../login-registro.php");
        } else {
            echo '<script> alert("registro incorrecto")</script>';
            echo '<a href="../login-registro.php">Regresar al registro</a>';
        }

        } catch (\Throwable $th) {
            echo '<script>alert("correo duplicado")</script>';
            echo '<a href="../login-registro.php">Regresar al registro</a>';
        }
    }
}/* else{
    session_start();
    $_SESSION["Error al registrar"] = "Error 1";
    header('location:../login-registro.php');

} */
