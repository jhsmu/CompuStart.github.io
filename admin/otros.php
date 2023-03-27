<?php
    session_start();
    require('../database/basededatos.php');

    //Creamos un objeto del tipo Database
    $db = new Database();
    $connection = $db->connect(); //Creamos la conexión a la BD

    // Cuando la conexión está establecida...
    $consulta = $connection->prepare("SELECT CONCAT(cliente.nombre, ' ', cliente.apellido) AS cliente , id_orden, producto.producto AS producto, cantidad_venta, precio_producto, monto_total, detalle_orden.estado FROM detalle_orden INNER JOIN producto ON detalle_orden.id_producto = producto.id_producto INNER JOIN cliente ON detalle_orden.cliente = cliente.id"); // Traduzco mi petición
    $consulta->execute(); //Ejecuto mi petición

    $ordenes = $consulta->fetchAll(PDO::FETCH_ASSOC); //Me traigo los datos que necesito
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
    <title>Pedidos</title>
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
                                            <th scope="col" class="text-align: center"># de Orden</th>
                                            <th scope="col" class="text-align: center">Nombre del Cliente</th>
                                            <th scope="col" class="text-center">Producto</th>
                                            <th scope="col" class="ttext-center">Cantidad</th>
                                            <th scope="col" class="text-align: center">Valor Unitario</th>
                                            <th scope="col" class="text-align: center">Valor Total</th>
                                            <th scope="col" class="text-align: center">Estado</th>
                                            <th scope="col" class="text-align: center">Acción</th>
                                        </tr>
                                    </thead>
                                    <?php
                                        foreach ($ordenes as $key => $orden) {
                                            if ($orden['estado'] == 1){
                                    ?>
                                    <tbody>
                                        <tr>
                                            <th scope="row" class="text-center">
                                                <?php echo $orden["id_orden"] . "<br>"; ?>
                                            </th>
                                            <td class="text-align: center">
                                                <?php echo $orden["cliente"] . "<br>"; ?>
                                            </td>
                                            <td class="text-align: center">
                                                <?php echo $orden["producto"] . "<br>"; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php echo $orden["cantidad_venta"] . "<br>"; ?>
                                            </td>
                                            <td class="text-align: center">
                                                $ <?php echo $orden["precio_producto"] . "<br>"; ?>
                                            </td>
                                            <td class="text-align: center">
                                                $ <?php echo $orden["monto_total"] . "<br>"; ?>
                                            </td>
                                            <td class="text-align: center">
                                                <?php 
                                                    if ($orden['estado'] == 1){
                                                        echo "En proceso <br>"; 
                                                    }
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <a class="bg-blue-800 cursor-pointer rounded p-1 mx-1 text-white" href="./actualizarProveedor.php?id=<?php echo $proveedor["id_proveedor"]; ?>">
                                                        <i class="fas fa-edit"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <?php
                                        } else{
                                        }
                                    }
                                ?>
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