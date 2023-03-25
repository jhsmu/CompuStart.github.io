<?php
    session_start();
    require('./database/basededatos.php');
    error_reporting(0);

    $db = new Database();
    $connection = $db->connect(); //Creamos la conexión a la BD

    $id = $_SESSION["id_usuario"];

    // Cuando la conexión está establecida...
    $consulta = $connection->prepare("SELECT id_orden, cliente, total, estado FROM orden WHERE cliente=:id_usuario"); // Traduzco mi petición
    $consulta->execute(['id_usuario' => $id]); //Ejecuto mi petición

    $ordenes = $consulta->fetchAll(PDO::FETCH_ASSOC); //Me traigo los datos que necesito
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <!-- css bootstrap -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<!-- iconos en fontawesome -->
    <script src="https://kit.fontawesome.com/4b93f520b2.js" crossorigin="anonymous"></script>
<!-- css footer y el header -->
    <link rel="stylesheet" href="./css/footer-header.css">
<!-- css cuerpo -->
    <link rel="stylesheet" href="./css/style_cuerpo.css">
    <link rel="stylesheet" href="./css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <title>Document</title>
</head>
<body>
    <header>
<?php
    include("./componentes/headerinicio.php");
?>
    </header>
<div class="container">
    <br><br>
    <h2>Lista de Ordenes</h2>
    <br>
    <table class="table table-light table-bordered">
        <thead>
        <tr>
            <th width="40%">Número de Orden</th>
            <th width="15%" class="text-center">Total</th>
            <th width="20%" class="text-center">estado</th>
        </tr>
        </thead>
        <tbody >
            <?php
            if(!empty($ordenes)){ 
                foreach ($ordenes as $key => $orden) {
            ?>
            <tr>
                <td width="15%"><?php echo $orden['id_orden'] ?></td>
                <td width="15%" class="text-center"><?php echo number_format($orden['total'],2) ?></td>
                <td width="20%" class="text-center">
                    <?php 
                    if ($orden['estado'] == 1){
                        echo "En Proceso de aprobación";
                    } else{
                        echo "Comprado";
                    }
                    ?>
                </td>
            <?php
                }
            } else{
            ?>
            <tr>
                <td colspan="5">
                    <div class="alert alert-success">No hay pedidos pendientes</div> 
                </td>
            </tr>
            <?php
                }
            ?>
        </tbody>
    </table>
    </div>
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>