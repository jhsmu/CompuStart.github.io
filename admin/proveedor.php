<?php
session_start();
require('../database/basededatos.php');

//Creamos un objeto del tipo Database
$db = new Database();
$connection = $db->connect(); //Creamos la conexión a la BD

// Cuando la conexión está establecida...
$query = $connection->prepare("SELECT * FROM proveedor"); // Traduzco mi petición
$query->execute(); //Ejecuto mi petición

$proveedores = $query->fetchAll(PDO::FETCH_ASSOC); //Me traigo los datos que necesito

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
    <!-- iconos en fontawesome -->
    <script src="https://kit.fontawesome.com/4b93f520b2.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,600,600i,700,700i" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Productos</title>
</head>

<body>
    <!--Container -->
    <div class="mx-auto bg-grey-lightest">
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
                    <div class="flex">

                    </div>
                    <ul class="list-reset flex flex-col">
                        <?php include("../componentes/barralateralAdmin.php") ?>
                    </ul>

                </aside>
                <!--/Sidebar-->
                <!--Main-->
                <!--Main-->
                <main class="bg-white-500 flex-1 p-3 overflow-hidden">
                    <!--Grid Form-->

                    <div class="flex flex-1  flex-col md:flex-row lg:flex-row mx-2">
                        <div class="mb-2 border-solid border-gray-300 rounded border shadow-sm w-full">
                            <div class="bg-gray-200 px-2 py-3 border-solid border-gray-200 border-b">
                                Lista de proveedores
                            </div>
                            <div class="p-3">
                                <table class="table-responsive w-full rounded">
                                    <thead>
                                        <tr>
                                            <th class="border w-1/7 px-4 py-2">Id_proveedor</th>
                                            <th class="border w-1/6 px-4 py-2">Proveedor</th>
                                            <th class="border w-1/6 px-4 py-2">Correo</th>
                                            <th class="border w-1/6 px-4 py-2">Web</th>
                                            <th class="border w-1/7 px-4 py-2">Dirección</th>
                                            <th class="border w-1/7 px-4 py-2">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($proveedores as $key => $proveedor) {
                                        ?>
                                            <tr>
                                                <td class="border px-4 py-2"><?php echo $proveedor["id_proveedor"] . "<br>"; ?></td>
                                                <td class="border px-4 py-2"><?php echo $proveedor["proveedor"] . "<br>"; ?></td>
                                                <td class="border px-4 py-2"><?php echo $proveedor["correo"] . "<br>"; ?></td>
                                                <td class="border px-4 py-2"><?php echo $proveedor["direccion_web"] . "<br>"; ?></td>
                                                <td class="border px-4 py-2"><?php echo $proveedor["direccion"] . "<br>"; ?></td>
                                                <td class="border px-4 py-2">

                                                    <a class="bg-teal-300 cursor-pointer rounded p-1 mx-1 text-white" href="./actualizarProveedor.php?id=<?php echo $proveedor["id_proveedor"]; ?>">
                                                        <i class="fas fa-edit"></i></a>
                                                    <a class="bg-teal-300 cursor-pointer rounded p-1 mx-1 text-red-500" href="./editar/eliminarProveedor.php?id=<?php echo $proveedor["id_proveedor"]; ?>" onclick='return confirmar()'>
                                                        <i class="fas fa-trash"></i>
                                                    </a>
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
                    <!--/Grid Form-->
            </div>
            </main>
        </div>

    </div>

    </div>


    <script src="../js/main.js"></script>
    <script type="text/javascript">
        function confirmar() {
            return confirm('¿Estas seguro?, se eliminarán los datos');
        }
    </script>

</body>

</html>
<?php
if (isset($_SESSION['actualizar'])) {
    echo "<script>
    Swal.fire({
        icon: 'success',
        title: 'Éxito',
        text: 'Proveedor Actualizado'
        });
    </script>";
    unset($_SESSION['actualizar']);
}
?>
