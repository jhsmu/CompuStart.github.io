<?php

    if (isset($_POST['botonAdd'])) {
        switch ($_POST['botonAdd']) {

            //Esto es si la persona oprime el botón agregar al carrito
            case 'agregar':
                if (is_numeric($_POST['id'])) {
                    $id_producto=$_POST['id'];
                }else {
                    $mensaje="El id esta mal";
                }

                if (is_string($_POST['producto'])) {
                    $nombre_producto=$_POST['producto'];
                }else {
                    $mensaje="El producto esta mal";
                }

                if (is_numeric($_POST['precio'])) {
                    $precio_producto=$_POST['precio'];
                }else {
                    $mensaje="El precio esta mal";
                }

                if(is_numeric($_POST['cantidad'])){
                    $cantidad=$_POST['cantidad'];
                } else{
                    $mensaje="La cantidad esta mal";
                }

                if (!isset($CarroCompra)) {
                    $carro_pro=array(
                        'id'=>$id_producto,
                        'producto'=>$nombre_producto,
                        'precio'=>$precio_producto,
                        'cantidad'=>$cantidad
                    );
                    $CarroCompra=array();
                    $CarroCompra[0]=$carro_pro;
                    $mensaje="Producto agregado al carrito";
                } else {
                    $carro_pro=array(
                        'id'=>$id_producto,
                        'producto'=>$nombre_producto,
                        'precio'=>$precio_producto,
                        'cantidad'=>$cantidad
                    );
                    $idsProductos=array_column($CarroCompra, 'id');
                    if (in_array($id_producto, $idsProductos)) {
                        $carro_pro = array_replace($carro_pro, $carro_pro);
                        $CarroCompra[0]=$carro_pro;
                        $mensaje="Producto actualizado al carrito";
                    }
                    else{

                        $numero_productos=count($CarroCompra);
                        $carro_pro=array(
                            'id'=>$id_producto,
                            'producto'=>$nombre_producto,
                            'precio'=>$precio_producto,
                            'cantidad'=>$cantidad
                        );
                        $CarroCompra[$numero_productos]=$carro_pro;
                        $mensaje="Producto agregado al carrito";
                    }
                }
            break;

            case 'eliminar':
                if (is_numeric($_POST['id'])) {
                    $id_producto=$_POST['id'];
                    foreach ($CarroCompra as $indice => $producto) {
                        if ($producto['id']==$id_producto) {
                            unset($CarroCompra[$indice]);
                            echo '<script> alert("Producto borrado.."); </script>';
                        }
                    }
                }else {
                    $mensaje="El id esta mal";
                }
            break;

            case 'aumentar':
                if (is_numeric($_POST['id'])) {
                    $id_producto=$_POST['id'];
                    foreach ($CarroCompra as $indice => $producto) {
                        if ($producto['id']==$id_producto) {
                            $CarroCompra[$indice]['cantidad']++;
                            break;
                        }
                    }
                }else {
                    $mensaje="El aumento esta mal";
                }
            break;

            case 'disminuir':
                if (is_numeric($_POST['id'])) {
                    $id_producto=$_POST['id'];
                    foreach ($CarroCompra as $indice => $producto) {
                        if ($producto['id']==$id_producto) {
                            if ($CarroCompra[$indice]['cantidad']==1) {
                                $CarroCompra[$indice]['cantidad']=1;
                            }else {
                                $CarroCompra[$indice]['cantidad']--; 
                            }
                            break;  
                        }
                    }
                }else {
                    $mensaje="El aumento esta mal";
                }
            break;

            case 'proceder':
                unset($CarroCompra);
                header('location:../login-registro.php');
        }
    }