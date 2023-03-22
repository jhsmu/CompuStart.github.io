
<?php
    error_reporting( ~E_NOTICE ); // avoid notice
	
	require_once '../database/conexion.php';

    //Definimos las variables
    $serial=$_POST["serial"];
    $producto=$_POST["producto"];
    $descripcion_breve=$_POST["descripcion_breve"];
    $descripcion=$_POST["descripcion"];
    $cantidad=$_POST["cantidad"];
    $precio=$_POST["precio"]*0.6;
    $id_categoria=$_POST["categoria"];
    $id_marca=$_POST["marca"];
    $id_proveedor=$_POST["proveedor"];
    $total=$cantidad*$precio;

    //Primero agregamos el producto en la tabla producto
    $agregar=$DB_con->prepare('INSERT INTO producto(serial, producto, descripcion_breve, descripcion, cantidad, precio, id_categoria, id_marca) VALUES(:serial, :producto, :descripcion_breve, :descripcion, :cantidad, :precio, :categoria, :marca)');
    $agregar->bindParam(':serial', $serial);
    $agregar->bindParam(':producto', $producto);
    $agregar->bindParam(':descripcion_breve', $descripcion_breve);
    $agregar->bindParam(':descripcion', $descripcion);
    $agregar->bindParam(':cantidad', $cantidad);
    $agregar->bindParam(':precio', $precio);
    $agregar->bindParam(':categoria', $id_categoria);
    $agregar->bindParam(':marca', $id_marca);
    $agregar->execute();

    $idProducto=$DB_con->lastInsertId();

    $compra=$DB_con->prepare('INSERT INTO compra(id_proveedor, id_producto, cantidad, precio, total) VALUES(:proveedor, :producto, :cantidad, :precio, :total)');
    $compra->bindParam(':proveedor', $id_proveedor);
    $compra->bindParam(':producto', $idProducto);
    $compra->bindParam(':cantidad', $cantidad);
    $compra->bindParam(':precio', $precio);
    $compra->bindParam(':total', $total);

    if ($compra->execute()) {
        echo '<h2> Registro Correcto </h2>';
        session_start();
        $_SESSION["producto"]="Registro correcto";
        header("location:../admin/productos.php");
    } else {
        echo '<h2> Registro incorrecto </h2>';
    }