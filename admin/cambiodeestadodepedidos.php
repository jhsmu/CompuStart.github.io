<?php
    session_start();
    require('../database/basededatos.php');
    include '../database/conexion.php';

    //Creamos un objeto del tipo Database
    $db = new Database();
    $connection = $db->connect(); //Creamos la conexión a la BD

    $estado = $_POST['estado'];

    if ($estado == 0){
        if (isset($_POST['id_orden'])) {
            $id_orden = $_POST['id_orden'];
            $total = 0;
            $cliente = $_POST['cliente'];
    
            if (is_numeric($_POST['id_producto'])) {
                $id_producto=$_POST['id_producto'];
            }else {
                $mensaje="El id esta mal";
            }
    
            if (is_string($_POST['nombreProducto'])) {
                $nombre_producto=$_POST['nombreProducto'];
            }else {
                $mensaje="El producto esta mal";
            }
    
            if (is_numeric($_POST['precio_producto'])) {
                $precio_producto=$_POST['precio_producto'];
            }else {
                $mensaje="El precio esta mal";
            }
    
            if(is_numeric($_POST['cantidad_venta'])){
                $cantidad=$_POST['cantidad_venta'];
            } else{
                $mensaje="La cantidad esta mal";
            }

            if (!isset($_SESSION['orden'])) {
                $carro_pro=array(
                    'id'=>$id_producto,
                    'producto'=>$nombre_producto,
                    'precio'=>$precio_producto,
                    'cantidad'=>$cantidad
                );
                $_SESSION['orden'][0]=$carro_pro;
            } else {
                $idsProductos=array_column($_SESSION['orden'], 'id');
                if (in_array($id_producto, $idsProductos)) {
                } else{
                    $numero_productos=count($_SESSION['orden']);
                    $carro_pro=array(
                        'id'=>$id_producto,
                        'producto'=>$nombre_producto,
                        'precio'=>$precio_producto,
                        'cantidad'=>$cantidad
                    );
                    $_SESSION['orden'][$numero_productos]=$carro_pro;
                }

            foreach ($_SESSION['orden'] as $indice => $producto) {
                $total+=$producto['precio']*$producto['cantidad'];
            } 

            $insertar=$DB_con->prepare('INSERT INTO orden(cliente,total,estado) VALUES(:cliente, :total, :estado) ');
            $insertar->bindParam(':cliente', $cliente);
            $insertar->bindParam(':total', $total);
            $insertar->execute();
    
            $idOrden=$DB_con->lastInsertId();

            foreach ($_SESSION['orden'] as $indice => $producto) {
                $total_producto=$producto['precio']*$producto['cantidad'];
                $insertar=$DB_con->prepare('INSERT INTO detalle_venta(id_orden,id_producto,cantidad_venta,precio_producto,monto_total)
                                            VALUES(:id_orden, :id_producto, :cantidad, :precio, :total)');
                $insertar->bindParam(':id_orden', $idOrden);
                $insertar->bindParam(':id_producto', $producto['id']);
                $insertar->bindParam(':cantidad', $producto['cantidad']);
                $insertar->bindParam(':precio', $producto['precio']);
                $insertar->bindParam(':total', $total_producto);
                $insertar->execute();

                $consulta=$DB_con->prepare('SELECT * FROM producto WHERE id_producto=:id');
                $consulta->bindParam(':id', $producto['id']);
                $consulta->execute();
    
                $cantidad=$consulta->fetch(PDO::FETCH_ASSOC);
    
                $sustraccion=$cantidad['cantidad']-$producto['cantidad'];
    
                $resto=$DB_con->prepare('UPDATE producto SET cantidad=:cantidad WHERE id_producto=:id');
                $resto->bindParam(':cantidad', $sustraccion);
                $resto->bindParam(':id', $producto['id']);
                $resto->execute();
            }

            $orden = $connection->prepare("UPDATE orden SET estado=? WHERE id_orden=?");// Traduzco mi petición
            $actualizar1 = $orden->execute([$estado, $id_orden]); //Ejecuto mi petición

            $orden2 = $connection->prepare("UPDATE detalle_orden SET estado=? WHERE id_orden=?");// Traduzco mi petición
            $actualizar2 = $orden2->execute([$estado, $id_orden]); //Ejecuto mi petición

            }
            unset($_SESSION['orden']);
            session_start();
            $_SESSION['Aprobado'] = 'registro';
            header("location: ./otros.php");
        }
    } else{
        session_start();
        $_SESSION['errorDeAprobar'] = 'registro';
        header("location: ./detalleOrden.php");
    }
