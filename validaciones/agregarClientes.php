FALTA ELIMINAR ESTAS VALIDACIONES
<?php
error_reporting(~E_NOTICE); // avoid notice

require_once '../database/conexion.php';

function is_valid_email($email)
{
    $result = (false !== filter_var($email, FILTER_VALIDATE_EMAIL));

    if ($result) {
        $domain = explode("@", $email)[1];
        $result = checkdnsrr($domain, 'MX');
    }

    return $result;
}

$consulta=$DB_con->prepare('SELECT email FROM cliente');
$consulta->execute();
$emails=$consulta->fetchAll(PDO::FETCH_ASSOC);


if (isset($_POST["crear"])) {
    if (preg_match("/^[a-zñÑ A-ZáéíóúÁÉÍÓÚüÜ']+$/", $_POST["nombre"]) == 1) {
        $nombre = $_POST["nombre"];
    } else {
        echo '<script>confirm("Por favor ingrese un nombre valido")</script>';
        echo '<a href="../login-registro.php">Regresar al registro</a> <br>';

    }

    if (preg_match("/^[a-zñÑ A-ZáéíóúÁÉÍÓÚüÜ']+$/", $_POST["apellido"]) == 1) {
        $apellido = $_POST["apellido"];
    } else {
        echo '<script>confirm("Por favor ingrese un apellido valido")</script>';
        echo '<a href="../login-registro.php">Regresar al registro</a> <br>';

    }

    $direccion = htmlentities($_POST["direccion"]);

    if (preg_match('/^[0-9]+$/', $_POST["telefono"]) == 1) {
        $telefono = $_POST["telefono"];
    } else {
        echo '<script>confirm("Por favor ingrese un número de telefono valido")</script>';
        echo '<a href="../login-registro.php">Regresar al registro</a> <br>';

    }


    if (filter_var($_POST["email_registro"],FILTER_VALIDATE_EMAIL)){
        foreach ($emails as $key => $correo) {
            if($_POST['email_registro']==$correo['email']){
                break;
                header('location:../login-registro.php');
            }
        }
        $email= $_POST["email_registro"];
    } else {
        echo '<script>confirm("Por favor ingrese un email valido")</script>';
        echo '<a href="../login-registro.php">Regresar al registro</a> <br>';

    }

    if ($_POST["clave"] == $_POST["clave_c"]) {
        if (strlen($_POST["clave"]) > 8) {
            if (preg_match('`[a-z]`', $_POST["clave"])) {
                if (preg_match('`[A-Z]`', $_POST["clave"])) {
                    if (preg_match('`[0-9]`', $_POST["clave"])) {
                        $contrasena = (htmlentities($_POST["clave"]));
                    } else {
                        echo '<script>confirm("la clave debe tener al menos un número")</script>';
                        echo '<a href="../login-registro.php">Regresar al registro</a> <br>';

                    }
                } else {
                    echo '<script>confirm("La contraseña debe tener al menos una mayuscula")</script>';
                    echo '<a href="../login-registro.php">Regresar al registro</a> <br>';

                }
            } else {
                echo '<script>confirm("La contraseña debe tener una minuscula")</script> <br>';
            }
        } else {
            echo '<script>alert("La contraseña debe tener minimo 8 digitos")</script>';
            echo '<a href="../login-registro.php">Regresar al registro</a> <br>';

        }
    } else {
        echo '<script>alert("Las contraseñas deben ser iguales")</script>';
        echo '<a href="../login-registro.php">Regresar al registro</a> <br>';

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
}
