<?php
    include '../database/conexion.php';

    if (isset($_GET['id']) and isset($_GET['token'])) {
        $id = $_GET['id'];
        $token = $_GET['token'];

        $consulta = $DB_con->prepare('SELECT * FROM cliente WHERE id=:id');
        $consulta->bindParam(':id', $id);
        $consulta->execute();

        $cliente=$consulta->fetch(PDO::FETCH_ASSOC);
    } else {
        header("location:./email.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <?php
        if ($cliente['token']==$token) {
    ?>
    <br>
    <h1>Cambie su contraseña</h1>
    <br>
    <form action="./condicion.php" method="post">
        <label for="pass">Contraseña</label>
        <input type="password" name="contrasena" id="pass" class="form-control">
        <br>
        <br>
        <input type="number" name="id" id="con-pass" class="form-control" value=<?php echo $id ?> hidden>
        <label for="con-pass">Confirme Contraseña</label>
        <input type="password" name="confirma_contrasena" id="con-pass" class="form-control">
        <br>
        <button class="btn btn-primary" type="submit" name="cambio">Cambiar contraseña</button>
    </form>
    <?php
        } else {
    ?>
    <br>
    <h1>Error</h1>
    <a href="./email.php">Regresar</a>
    <br>
    <?php
        }
    ?>
</body>
</html>