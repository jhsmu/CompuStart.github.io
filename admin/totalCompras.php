<?php
    session_start();
    require('../database/basededatos.php');

    //Creamos un objeto del tipo Database
    $db = new Database();
    $connection = $db->connect(); //Creamos la conexión a la BD

    // Cuando la conexión está establecida...
    $consulta = $connection->prepare("SELECT * FROM compra"); // Traduzco mi petición
    $consulta->execute(); //Ejecuto mi petición

    $compras = $consulta->fetchAll(PDO::FETCH_ASSOC); //Me traigo los datos que necesito
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
    <link rel="icon" type="image/x-icon" href="../img/logo/icono.png">
    <title>Compu_Start: Total Compras</title>
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
                                <div class="font-bold text-xl">Total compras</div>
                            </div>
                            <div class="rounded overflow-hidden shadow bg-white mx-2 w-full">
                                <div class="px-6 py-2 border-b border-light-grey">
                                    <div class="font-bold text-xl">Compras</div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table text-grey-darkest" id="dataTable">
                                        <thead class="bg-grey-dark text-white text-normal">
                                            <tr>
                                                <th scope="col">Id compra</th>
                                                <th scope="col">Id proveedor</th>
                                                <th scope="col">Producto</th>
                                                <th scope="col">Cantidad</th>
                                                <th scope="col">Precio</th>
                                                <th scope="col">Total</th>
                                                <th scope="col">Fecha</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($compras as $key => $compras) {
                                            ?>
                                                <tr>
                                                    <td scope="row">
                                                        <?php echo $compras["id_compra"] . "<br>"; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $compras["id_proveedor"] . "<br>"; ?>
                                                    </td>
                                                    <td>
                                                        poner un inner join para llamar el nombre del producto a partir de la id
                                                        <?php echo $compras["id_producto"] . "<br>"; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $compras["cantidad"] . "<br>"; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $compras["precio"] . "<br>"; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $compras["total"] . "<br>"; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $compras["fecha"] . "<br>"; ?>
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
