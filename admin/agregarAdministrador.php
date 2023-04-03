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

        foreach ($administradores as $key => $administrador) {
            $email = "";
            if ($_POST['email'] === $administrador['email']) {
                session_start();
                $_SESSION["emailRepetido"] = "email repetido";
                header('location: ../admin/usuario.php');
                break;
            }else{
                $email = $_POST["email"];
                if (isset($contrasena) and isset($email)) {
                    $query = $connection->prepare("INSERT INTO administrador(nombre, apellido, email, contrasenia) VALUES(?, ?, ?, ?)");// Traduzco mi petición
                    $guardar = $query->execute([$nombre, $apellido, $email, $contrasena]); //Ejecuto mi petición

                    try {
                        if ($guaradar->execute()) {
                            session_start();
                            $_SESSION['agregado'] = 'id';
                            header("location: ../admin/usuario.php");
                            break;
                        } else {
                            session_start();
                            $_SESSION['ERROR'] = 'id';
                            header("location: ../admin/usuario.php");
                            break;  
                        }
                    } catch (\Throwable $th) {
                        session_start();
                        $_SESSION['AdmiRepetido'] = 'id';
                        header("location: ../admin/usuario.php");
                        break;
                    }
                    break;
                }
            }
        }
    }

    if ($guardar) {

    } else {
        echo "<script> alert 'Error al crear nuevo administrador' </script>";
    }