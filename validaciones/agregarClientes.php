<?php
require_once '../database/conexion.php';


$consulta=$DB_con->prepare('SELECT email FROM cliente');
$consulta->execute();
$emails=$consulta->fetchAll(PDO::FETCH_ASSOC);

// rowCount()
if (isset($_POST["crear"])) {
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $direccion = htmlentities($_POST["direccion"]);
    $telefono = $_POST["telefono"];
    $estado=1;
    $documento = $_POST["numero_documento"];
    $tipo = $_POST["tipo_documento"];
    $contrasena = (htmlentities($_POST["clave"]));
    $email = $_POST["email_registro"];
    $upload_dir = 'avatar.png';

    $validar = "SELECT * FROM cliente WHERE email = '$email' ";
    $validando = $DB_con->prepare($validar);
    $validando->execute();

    $validar1 = "SELECT * FROM cliente WHERE numero_documento = '$documento' ";
    $validando1 = $DB_con->prepare($validar1);
    $validando1->execute();

    $validar2 = "SELECT * FROM cliente WHERE telefono = '$telefono' ";
    $validando2 = $DB_con->prepare($validar2);
    $validando2->execute();

          if($validando->rowCount() > 0){
            session_start();
            $_SESSION["emailRepetido"] = "registro creado con exito";
            header("location:../login-registro.php");
          } else if($validando1->rowCount() > 0){
            session_start();
            $_SESSION["cedulaRepetida"] = "registro creado con exito";
            header("location:../login-registro.php");
          } else if($validando2->rowCount() > 0){
            session_start();
            $_SESSION["telefonoRepetido"] = "registro creado con exito";
            header("location:../login-registro.php");
          }else{

            if (isset($contrasena) and isset($email)) {
                $documento = $_POST["numero_documento"];
                $email = $_POST["email_registro"];
                $telefono = $_POST["telefono"];

                $agregar = $DB_con->prepare('INSERT INTO cliente(imagen, apellido, nombre, tipo_documento, numero_documento, email, direccion, telefono, contrasenia, estado) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
                $ver = $agregar->execute([$upload_dir,$nombre,$apellido,$tipo,$documento,$email,$direccion,$telefono,$contrasena,$estado]);

                try{
                    if($ver){
                        session_start();
                        $_SESSION["registro"]= "registro creado con exito";
                        header("location:../login-registro.php");
                    }else{
                        session_start();
                        $_SESSION["registro"]= "registro creado con exito";
                        header("location:../login-registro.php");
                    }
                }catch(\Throwable $th){
                    echo '<script>alert("correo duplicado")</script>';
                     echo '<a href="../login-registro.php">Regresar al registro</a>';
                    }
            }

        }
}  
