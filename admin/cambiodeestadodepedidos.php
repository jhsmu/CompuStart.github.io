<?php
    session_start();
    require('../database/basededatos.php');
    include '../database/conexion.php';

    //Creamos un objeto del tipo Database
    $db = new Database();
    $connection = $db->connect(); //Creamos la conexión a la BD

    $estado = $_POST['estado'];
    $idOrden = $_POST['id_orden'];

    if ($estado == 0){
        /*if (isset($_POST['id_orden'])) {
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
                }*/

        $consultar = $DB_con->prepare('SELECT * FROM orden WHERE id_orden=:orden');
        $consultar->bindParam(':orden', $idOrden);
        $consultar->execute();

        $orden = $consultar->fetch(PDO::FETCH_ASSOC);

        $insertar = $DB_con->prepare('INSERT INTO venta(cliente, total) VALUES(:cliente, :total)');
        $insertar->bindParam(':cliente', $orden['cliente']);
        $insertar->bindParam(':total', $orden['total']);
        $insertar->execute();

        $idVenta = $DB_con->lastInsertId();

        $consultar2 = $DB_con->prepare('SELECT * FROM detalle_orden WHERE id_orden=:orden');
        $consultar2->bindParam(':orden', $idOrden);
        $consultar2->execute();

        $detalles = $consultar2->fetchAll(PDO::FETCH_ASSOC);

        foreach ($detalles as $key => $detalle) {
            $insertar2 = $DB_con->prepare('INSERT INTO detalle_venta(id_venta, id_producto, cantidad_venta, precio_producto, monto_total) VALUES(:venta, :producto, :cantidad, :precio, :total)');
            $insertar2->bindParam(':venta', $idVenta);
            $insertar2->bindParam(':producto', $detalle['id_producto']);
            $insertar2->bindParam(':cantidad', $detalle['cantidad_venta']);
            $insertar2->bindParam(':precio', $detalle['precio_producto']);
            $insertar2->bindParam(':total', $detalle['monto_total']);
            $insertar2->execute();
            
            $cambio=$DB_con->prepare('UPDATE detalle_orden SET estado=:estado WHERE id_detalle_orden=:detalle');
            $cambio->bindParam(':estado', $estado);
            $cambio->bindParam(':detalle', $detalle['id_detalle_orden']);
            $cambio->execute();
        }
        
        $cambiar = $DB_con->prepare('UPDATE orden SET estado=:estado WHERE id_orden=:orden');
        $cambiar->bindParam(':estado', $estado);
        $cambiar->bindParam(':orden', $idOrden);
        
        if ($cambiar->execute()) {
        session_start();
        $_SESSION['Aprobado'] = 'registro';
        header("location: ./otros.php");
        }
        
    }