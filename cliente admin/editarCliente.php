<?php
    //Para poder usar la clase Database y su función connect
    require('../database/basededatos.php');

    //Creamos un objeto del tipo Database
    $db = new Database();
    $connection = $db->connect(); //Creamos la conexión a la BD

    $id = $_GET["id"];

    // Cuando la conexión está establecida...
    $consulta = $connection->prepare("SELECT * FROM cliente WHERE email=:id");// Traduzco mi petición
    $consulta->execute(['id' => $id]); //Ejecuto mi petición

    $cliente = $consulta->fetch(PDO::FETCH_ASSOC); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cliente</title>
</head>
<body>
    <form action="actualizarCliente.php" method="post">
        <label for="" hidden>Email</label>
        <input type="text" name="id" id="id" value="<?php echo $cliente['email']; ?>" hidden> <br>
        <label for="">nombre</label>
        <input type="text"  name="nombre" id="nombre" value="<?php echo $cliente['nombre']; ?>"><br>
        <label for="">apellido</label>
        <input type="text" name="apellido" id="apellido" value="<?php echo $cliente['apellido']; ?>"><br>
        <label for="">direccion</label>
        <input type="text"  name="direccion" id="direccion" value="<?php echo $cliente['direccion']; ?>"><br>
        <label for="">telefono</label>
        <input type="text" class="number" name="telefono" id="telefono" value="<?php echo $cliente['telefono']; ?>"><br><br>
        <label for="">contraseña</label>
        <input type="text" class="password" name="contraseña" id="contraseña" value="<?php echo $cliente['contrasenia']; ?>"><br><br>
        <button type="submit">Enviar</button> <br> <br>
        <a href="consultaCliente.php">Regresar</a>
    </form>
</body>