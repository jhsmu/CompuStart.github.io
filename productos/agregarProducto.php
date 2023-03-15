<?php
    error_reporting( ~E_NOTICE ); // avoid notice
	
	require_once '../database/conexion.php';

    //Definimos las variables
    $serial=$_POST["serial"];
    $producto=$_POST["producto"];
    $descripcion=$_POST["descripcion"];
    $cantidad=$_POST["cantidad"];
    $precio=$_POST["precio"];
    $id_categoria=$_POST["categoria"];
    $id_marca=$_POST["marca"];

    //Primero agregamos el producto en la tabla producto
    $agregar=$DB_con->prepare('INSERT INTO producto(serial, producto, descripcion, cantidad, precio, id_categoria, id_marca) VALUES(:serial, :producto, :descripcion, :cantidad, :precio, :categoria, :marca)');
    $agregar->bindParam(':serial', $serial);
    $agregar->bindParam(':producto', $producto);
    $agregar->bindParam(':descripcion', $descripcion);
    $agregar->bindParam(':cantidad', $cantidad);
    $agregar->bindParam(':precio', $precio);
    $agregar->bindParam(':categoria', $id_categoria);
    $agregar->bindParam(':marca', $id_marca);

    if ($agregar->execute()) {
        echo '<h2> Registro Correcto </h2>';
    } else {
        echo '<h2> Registro incorrecto </h2>';
    }

    //Consultamos el serial para obtener el id del producto nuevo
    $consulta=$DB_con->prepare('SELECT id_producto FROM producto WHERE serial=:serial');
    $consulta->bindParam('serial', $serial);
    $consulta->execute();
    $id=$consulta->fetch(PDO::FETCH_ASSOC);

    foreach ($_FILES['imagen']['tmp_name'] as $key => $value) { //Iteramos por el número de archivos a cargar
	
        $imgFile = $_FILES['imagen']['name'][$key];
        $tmp_dir = $_FILES['imagen']['tmp_name'][$key];
        $imgSize = $_FILES['imagen']['size'][$key];

        if(empty($imgFile)){
            $errMSG = "Seleccione el archivo de imagen.";
        }
        else
        {
            $upload_dir = '../imagenes/'; // carpeta en la cual se pondrá el archivo
    
            $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // obtenemos la extensión de la imagen
        
            // validamos las extensiones de los archivos
            $valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'webp'); // valid extensions
        
            // nombre de la imagen a cargar
            $userpic=$imgFile;
                
            // Validamos el formato de la imagen
            if(in_array($imgExt, $valid_extensions)){			
                // Revisamos el tamaño del archivo '1MB'
                if($imgSize < 1000000)				{
                    move_uploaded_file($tmp_dir,$upload_dir.$userpic);
                }
                else{
                    $errMSG = "Su archivo es muy grande.";
                }
            }
            else{
                $errMSG = "Solo archivos JPG, JPEG, PNG, GIF & WEBP son permitidos.";		
            }
        }
        
        
        // Si no hay error, continua ....
        if(!isset($errMSG))
        {
            $agregar=$DB_con->prepare('INSERT INTO imagenes(id_producto, url) VALUES(:producto, :ruta)');
            $agregar->bindParam(':producto', $id['id_producto']);
            $agregar->bindParam(':ruta', $userpic);
            $agregar->execute();
        }
    }

    echo "<a href='./producto.php'>Regresar</a>";
    
