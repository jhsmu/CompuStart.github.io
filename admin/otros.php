<?php
    session_start();
    require('../database/basededatos.php');

//Creamos un objeto del tipo Database
$db = new Database();
$connection = $db->connect(); //Creamos la conexión a la BD

// Cuando la conexión está establecida...
$consulta = $connection->prepare("SELECT SUM(total) FROM venta"); // Traduzco mi petición
$consulta->execute(); //Ejecuto mi petición

$ventas = $consulta->fetch(PDO::FETCH_NUM); //Me traigo los datos que necesito

$consulta2 = $connection->prepare("SELECT COUNT(*) FROM cliente"); // Traduzco mi petición
$consulta2->execute(); //Ejecuto mi petición

$usuarios = $consulta2->fetch(PDO::FETCH_NUM); //Me traigo los datos que necesito

$consulta3 = $connection->prepare("SELECT COUNT(*) FROM producto"); // Traduzco mi petición
$consulta3->execute(); //Ejecuto mi petición

$productos = $consulta3->fetch(PDO::FETCH_NUM); //Me traigo los datos que necesito

$consulta4 = $connection->prepare("SELECT SUM(total) FROM compra"); // Traduzco mi petición
$consulta4 ->execute(); //Ejecuto mi petición

$compras = $consulta4->fetch(PDO::FETCH_NUM); //Me traigo los datos que necesito

$query = $connection->prepare("SELECT * FROM detalle_venta"); // Traduzco mi petición
$query->execute(); //Ejecuto mi petición

$detalle_venta = $query->fetchAll(PDO::FETCH_ASSOC); //Me traigo los datos que necesito
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="keywords" content="tailwind,tailwindcss,tailwind css,css,starter template,free template,admin templates, admin template, admin dashboard, free tailwind templates, tailwind example">
    <!-- Css -->
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/all.css">
            <!-- iconos en fontawesome -->
            <script src="https://kit.fontawesome.com/4b93f520b2.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,600,600i,700,700i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,600,600i,700,700i" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Ventas</title>
</head>

<body>
    
<!--Container -->
<div class="mx-auto bg-grey-400">
    <!--Screen-->
    <div class="min-h-screen flex flex-col">
        <!--Header Section Starts Here-->
        <header class="bg-nav">
            <?php include("../componentes/headerAdmin.php") ?>
        </header>
        <!--/Header-->

        <div class="flex flex-1">
            <!--Sidebar-->
            <aside id="sidebar" class="bg-side-nav w-1/2 md:w-1/6 lg:w-1/6 border-r border-side-nav hidden md:block lg:block">
<!--Barra lateral-->
                <ul class="list-reset flex flex-col">
                    <?php include("../componentes/barralateralAdmin.php") ?>
                </ul>
            </aside>

            <!--/Sidebar-->
            <!--Main-->
            <main class="bg-white-300 flex-1 p-3 overflow-hidden">



                    <!-- /Stats Row Ends Here -->

                    <!-- Card Section Starts Here -->
                    <div class="flex flex-1 flex-col md:flex-row lg:flex-row mx-2">

                        <!-- card -->

                        <div class="rounded overflow-hidden shadow bg-white mx-2 w-full">
                            <div class="px-6 py-2 border-b border-light-grey">
                                <div class="font-bold text-xl">Pedidos</div>
                            </div>
                            <div class="table-responsive">
                                <table class="table text-grey-darkest">
                                    <thead class="bg-grey-dark text-white text-normal">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">ID_Venta</th>
                                            <th scope="col">ID_Producto</th>
                                            <th scope="col">Cantidad</th>
                                            <th scope="col">Valor Unitario</th>
                                            <th scope="col">Valor Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach ($detalle_venta as $key => $detalle) {
                                        ?>
                                        <tr>
                                            <th scope="row">                                                    
                                                <button class="bg-blue-500 hover:bg-blue-800 text-white font-light py-1 px-2 rounded-full">
                                                    <?php echo $detalle["id_detalle_venta"] . "<br>"; ?>
                                                </button></th>
                                            <td>
                                                <button class="bg-blue-500 hover:bg-blue-800 text-white font-light py-1 px-2 rounded-full">
                                                    <?php echo $detalle["id_venta"] . "<br>"; ?></td>
                                                </button>
                                            <td>
                                                <button class="bg-blue-500 hover:bg-blue-800 text-white font-light py-1 px-2 rounded-full">
                                                    <?php echo $detalle["id_producto"] . "<br>"; ?></td>
                                                </button>
                                            <td>
                                                <button class="bg-blue-500 hover:bg-blue-800 text-white font-light py-1 px-2 rounded-full">
                                                    <?php echo $detalle["cantidad_venta"] . "<br>"; ?>
                                                </button>
                                            </td>
                                            <td>
                                                <button class="bg-blue-500 hover:bg-blue-800 text-white font-light py-1 px-2 rounded-full">
                                                    $ <?php echo $detalle["precio_producto"] . "<br>"; ?>
                                                </button>
                                            </td>
                                            <td>
                                                <button class="bg-blue-500 hover:bg-blue-800 text-white font-light py-1 px-2 rounded-full">
                                                    $ <?php echo $detalle["monto_total"] . "<br>"; ?>
                                                </button>
                                            </td>
                                        </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <!--/Main-->
        </div>
    </div>

</div>
<script src="../js/main.js"></script>
</body>

</html>

<?php
if (isset($_SESSION['actualizar_datos'])) {
    echo "<script>
    Swal.fire({
        icon: 'success',
        title: 'Éxito',
        text: 'Datos Actualizados'
        });
    </script>";
    unset($_SESSION['actualizar_datos']);
}
?>