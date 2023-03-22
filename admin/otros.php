<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Css -->
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/all.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,600,600i,700,700i" rel="stylesheet">
    <!-- iconos en fontawesome -->
    <script src="https://kit.fontawesome.com/4b93f520b2.js" crossorigin="anonymous"></script>
    <!-- Sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>Otros</title>
</head>

<body>
    <?php
    require('../database/basededatos.php');

    //Creamos un objeto del tipo Database
    $db = new Database();
    $connection = $db->connect(); //Creamos la conexión a la BD
    ?>

    <!--Container -->
    <div class="mx-auto bg-gray-300est">
        <!--Screen-->
        <div class="min-h-screen flex flex-col">
            <!--Header Section Starts Here-->
            <header class="bg-nav">
                <?php include("../componentes/headerAdmin.php") ?>
            </header>

            <div class="flex flex-1">
                <!--Sidebar-->
                <aside id="sidebar" class="bg- side-nav w-1/2 md:w-1/6 lg:w-1/6 border-r border-side-nav hidden md:block lg:block">
                    <div class="flex">

                    </div>
                    <ul class="list-reset flex flex-col">
                        <?php include("../componentes/barralateralAdmin.php") ?>
                    </ul>

                </aside>
                <!--/Sidebar-->
                <!--Main-->
                <main class="bg-white-medium flex-1 p-3 overflow-hidden">
                    <div class='flex flex-col'>
                        <div class='flex flex-1  flex-col md:flex-row lg:flex-row mx-2'>

                            <div class='flex flex-1  flex-col md:flex-row lg:flex-row mx-2'>
                                </div>
                                <div class="mb-2 mx-2 border-solid border-gray-300  rounded border shadow-sm w-full md:w-1/2 lg:w-1/2">
                                    <div class="bg-gray-200 px-2 py-3 border-solid border-gray-300 border-b">
                                        Agregar Imagen
                                    </div>
                                    <div class="p-3">
                                        <input class="modal-trigger bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="file">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <!--/Main-->
            </div>
        </div>

    </div>

    <script src="../js/validaciones.js"></script>
    <script src="../js/main.js"></script>

</body>

</html>
<?php
if (isset($_SESSION['proveedor'])) {
    echo "<script>
    Swal.fire({
        icon: 'success',
        title: 'Éxito',
        text: 'Proveedor agregado'
        });
    </script>";
    unset($_SESSION['proveedor']);
}
?>
