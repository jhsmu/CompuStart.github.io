<?php
    //Para poder usar la clase Database y su función connect
    require('../database/basededatos.php');

    //Creamos un objeto del tipo Database
    $db = new Database();
    $connection = $db->connect(); //Creamos la conexión a la BD

    $consulta = $connection->prepare("SELECT marca FROM marca"); // Traduzco mi petición
    $consulta->execute(); //Ejecuto mi petición

    $marcas = $consulta->fetchAll(PDO::FETCH_ASSOC); //Me traigo los datos que necesito

    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        $estado = $_POST["estado_marca"];

        foreach ($marcas as $key => $nombre) {
            $marca = "";
            if ($_POST['marca'] === $nombre['marca']) {
            session_start();
            $_SESSION["marcarepetidaActualizar"] = "marcarepetida";
            header('location:../admin/marca.php');
            break;
            } else {
                $marca = $_POST['marca'];
                if (isset($marca)){
                    $query = $connection->prepare("UPDATE marca SET marca=?, estado_marca=? WHERE id_marca=?");// Traduzco mi petición
                    $actualizar = $query->execute([$marca, $estado, $id]); //Ejecuto mi petición

                    try {
                        if ($actualizar) {
                            session_start();
                            $_SESSION['actualizar_marca'] = 'registro';
                            header("location: ../admin/marca.php");
                            break;
                        } else {
                            session_start();
                            $_SESSION['error'] = 'registro';
                            header("location: ../admin/marca.php");
                            break;  
                        }
                    } catch (\Throwable $th) {
                        session_start();
                        $_SESSION['actualizar_error'] = 'registro';
                        header("location: ../admin/marca.php");
                        break;
                    }
                    break;
                    }
            }
        }
    }