<?php
session_start();

error_reporting(~E_NOTICE); // avoid notice

require('../database/basededatos.php');

$db = new Database();
$connection = $db->connect(); //Creamos la conexión a la BD

// Cuando la conexión está establecida...
$query = $connection->prepare("SELECT * FROM producto"); // Traduzco mi petición
$query->execute(); //Ejecuto mi petición

$productos = $query->fetchAll(PDO::FETCH_ASSOC); //Me traigo los datos que necesito


require_once '../database/conexion.php';

//Consultamos para obtener las categorias
$consulta1 = $DB_con->prepare('SELECT * FROM categoria');
$consulta1->execute();
$categorias = $consulta1->fetchAll(PDO::FETCH_ASSOC);

//consultamos para obtener las marcas
$consulta2 = $DB_con->prepare('SELECT * FROM marca');
$consulta2->execute();
$marcas = $consulta2->fetchAll(PDO::FETCH_ASSOC);

//consultamos para obtener los proveedores
$consulta3 = $DB_con->prepare('SELECT * FROM proveedor');
$consulta3->execute();
$proveedores = $consulta3->fetchAll(PDO::FETCH_ASSOC);
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
    <title>Productos</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js">
    </script>
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
                <aside id="sidebar"
                    class="bg-side-nav w-1/2 md:w-1/6 lg:w-1/6 border-r border-side-nav hidden md:block lg:block">
                    <div class="flex">

                    </div>
                    <ul class="list-reset flex flex-col">
                        <?php include("../componentes/barralateralAdmin.php") ?>
                    </ul>

                </aside>
                <!--/Sidebar-->
                <!--Main-->
                <main class="bg-white-500 flex-1 p-3 overflow-hidden">

                    <div class="flex flex-col">
                        <!--Grid Form-->

                        <div class="flex flex-1  flex-col md:flex-row lg:flex-row mx-2">
                            <div class="mb-2 border-solid border-gray-300 rounded border shadow-sm w-full">
                                <div class="bg-gray-200 px-2 py-3 border-solid border-gray-200 border-b">
                                    Lista de Productos
                                    <label class="flex justify-end">
                                        <button data-modal='centeredFormModal'
                                            class="modal-trigger bg-blue-800 cursor-pointer rounded p-1 mx-1 text-white"
                                            href="">
                                            <i class="fa fa-user-plus"></i>
                                        </button>
                                        Agregar Producto
                                    </label>
                                </div>
                                <div class="p-3">
                                    <table class="table-responsive w-full rounded" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th class="border w-1/1 px-4 py-2 " hidden>Id</th>
                                                <th class="border w-1/1 px-4 py-2">Serial</th>
                                                <th class="border w-1/1 px-4 py-1 ">Producto</th>
                                                <th class="border w-1/1 px-4 py-2">Cantidad</th>
                                                <th class="border w-1/1 px-4 py-2">Precio</th>
                                                <th class="border w-1/1 px-4 py-2">ID_categoria</th>
                                                <th class="border w-1/1 px-4 py-2">ID_marca</th>
                                                <th class="border w-1/1 px-4 py-2">Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($productos as $key => $producto) {
                                            ?>
                                            <tr>
                                                <td class="border px-4 py-2" hidden>
                                                    <?php echo $producto["id_producto"] . "<br>"; ?></td>
                                                <td class="border px-4 py-2"><?php echo $producto["serial"] . "<br>"; ?>
                                                </td>
                                                <td class="border px-4 py-2">
                                                    <?php echo $producto["producto"] . "<br>"; ?></td>
                                                <td class="border  px-4 py-2">
                                                    <?php echo $producto["cantidad"] . "<br>"; ?></td>
                                                <td class="border w-1/6 px-4 py-2">
                                                    <?php echo $producto["precio"] . "<br>"; ?></td>
                                                <td class="border w-1/6 px-4 py-2">
                                                    <?php echo $producto["id_categoria"] . "<br>"; ?></td>
                                                <td class="border w-1/6 px-4 py-2">
                                                    <?php echo $producto["id_marca"] . "<br>"; ?></td>
                                                <td class="border px-4 py-2">
                                                    <a class="bg-red-500 cursor-pointer rounded p-1 mx-1 text-white"
                                                        href="./actualizarProducto.php?id=<?php echo $producto["id_producto"]; ?>">
                                                        <i class="fas fa-edit"></i>
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
                        <!-- Centered With a Form Modal -->
                        <div id='centeredFormModal' class="modal-wrapper w-full md:w1/1">
                            <div class="overlay close-modal"></div>
                            <div class="modal modal-centered">
                                <div class="modal-content shadow-lg p-5">
                                    <div class="border-b p-2 pb-3 pt-0 mb-4">
                                        <div class="flex justify-between items-center">
                                            Agregar Producto
                                            <span
                                                class='close-modal cursor-pointer px-3 py-1 rounded-full bg-gray-100 hover:bg-gray-200'>
                                                <i class="fas fa-times text-gray-700"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <!-- Modal content -->
                                    <form class="w-full" action="../productos/agregarProducto.php" method="post">
                                        <div class="flex flex-wrap -mx-3 mb-6">
                                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                                <label
                                                    class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1">
                                                    Serial
                                                </label>
                                                <input
                                                    class="appearance-none block w-full bg-grey-200 text-grey-darker border border-grey-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white-500 focus:border-gray-600"
                                                    name="serial" id="serial" type="text"
                                                    placeholder="Ingrese el serial" required>
                                            </div>
                                            <div class="w-full md:w-1/2 px-3">
                                                <label
                                                    class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1"
                                                    for="grid-last-name">
                                                    Nombre del Producto
                                                </label>
                                                <input
                                                    class="appearance-none block w-full bg-grey-200 text-grey-darker border border-grey-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white-500 focus:border-gray-600"
                                                    name="producto" id="producto" type="text"
                                                    placeholder="Ingrese el nombre del producto" required>
                                            </div>
                                        </div>
                                        <div class="flex flex-wrap -mx-3 mb-6">
                                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                                <label
                                                    class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1">
                                                    Descripción Breve
                                                </label>
                                                <input
                                                    class="appearance-none block w-full bg-grey-200 text-grey-darker border border-grey-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white-500 focus:border-gray-600"
                                                    name="descripcion_breve" id="descripcion_breve" type="text"
                                                    placeholder="Ingrese una descripción breve" required>
                                            </div>
                                            <div class="w-full md:w-1/2 px-3">
                                                <label
                                                    class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1"
                                                    for="grid-last-name">
                                                    Descripción
                                                </label>
                                                <input
                                                    class="appearance-none block w-full bg-grey-200 text-grey-darker border border-grey-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white-500 focus:border-gray-600"
                                                    name="descripcion" id="descripcion" type="text"
                                                    placeholder="Ingrese una descripción" required>
                                            </div>
                                        </div>
                                        <div class="flex flex-wrap -mx-3 mb-6">
                                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                                <label
                                                    class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1">
                                                    Cantidad
                                                </label>
                                                <input
                                                    class="appearance-none block w-full bg-grey-200 text-grey-darker border border-grey-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white-500 focus:border-gray-600"
                                                    name="cantidad" id="cantidad" type="text"
                                                    placeholder="Ingrese la cantidad" required>
                                            </div>
                                            <div class="w-full md:w-1/2 px-3">
                                                <label
                                                    class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1"
                                                    for="grid-last-name">
                                                    Precio
                                                </label>
                                                <input
                                                    class="appearance-none block w-full bg-grey-200 text-grey-darker border border-grey-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white-500 focus:border-gray-600"
                                                    name="precio" id="precio" type="text"
                                                    placeholder="Ingrese un precio" required>
                                            </div>
                                        </div>
                                        <div class="flex flex-wrap -mx-3 mb-6">
                                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                                <label
                                                    class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1">
                                                    Categoría
                                                </label>
                                                <div class="relative">
                                                    <select
                                                        class="block appearance-none w-full bg-grey-200 border border-grey-200 text-grey-darker py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-grey"
                                                        id="grid-state" name="categoria">
                                                        <option value="">Seleccione una opción</option>
                                                        <?php
                                                        foreach ($categorias as $key => $categoria) { //Agregamos las categorias a la lista desplegable
                                                        ?>
                                                        <option value="<?php echo $categoria["id_categoria"] ?>">
                                                            <?php echo $categoria["categoria"] ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                    <div
                                                        class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-grey-darker">
                                                        <svg class="fill-current h-4 w-4"
                                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                            <path
                                                                d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="w-full md:w-1/2 px-3">
                                                <label
                                                    class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1"
                                                    for="grid-last-name">
                                                    Marca
                                                </label>
                                                <div class="relative">
                                                    <select
                                                        class="block appearance-none w-full bg-grey-200 border border-grey-200 text-grey-darker py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-grey"
                                                        id="grid-state" name="marca">
                                                        <option value="">Seleccione una opción</option>
                                                        <?php
                                                        foreach ($marcas as $key => $marca) {
                                                        ?>
                                                        <option value="<?php echo $marca["id_marca"] ?>">
                                                            <?php echo $marca["marca"] ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                    <div
                                                        class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-grey-darker">
                                                        <svg class="fill-current h-4 w-4"
                                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                            <path
                                                                d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                                        </svg>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="w-full md:w-1/2 px-3 mt-5">
                                                <label
                                                    class="block uppercase tracking-wide text-grey-darker text-xs font-light mb-1"
                                                    for="grid-city">
                                                    Elige un Proveedor
                                                </label>
                                                <div class="relative">
                                                    <select
                                                        class="block appearance-none w-full bg-grey-200 border border-grey-200 text-grey-darker py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-grey"
                                                        id="grid-state" name="proveedor">
                                                        <option value="">Seleccione una opción</option>
                                                        <?php
                                                        foreach ($proveedores as $key => $proveedor) {
                                                        ?>
                                                        <option value="<?php echo $proveedor["id_proveedor"] ?>">
                                                            <?php echo $proveedor["proveedor"] ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                    <div
                                                        class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-grey-darker">
                                                        <svg class="fill-current h-4 w-4"
                                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                            <path
                                                                d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="w-full md:w-1/2 px-3 mt-5">
                                                <div class="relative">
                                                    <button data-modal='centeredFormModal1'
                                                        class='modal-trigger bg-blue-500 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded w-full mt-5 h-12'>
                                                        Agregar imagen</button>
                                                </div>
                                            </div>
                                            <div class="mt-8 ml-32">
                                                <button
                                                    class='bg-blue-500 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded'>
                                                    Agregar</button>
                                                <span
                                                    class='close-modal cursor-pointer bg-red-200 hover:bg-red-500 text-red-900 font-bold py-2 px-4 rounded'>
                                                    Close
                                                </span>
                                            </div>


                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
    </div>
    <!-- modal agregar imagen -->
    <!-- Centered With a Form Modal -->
    <div id='centeredFormModal1' class="modal-wrapper w-full md:w1/1">
        <div class="overlay close-modal"></div>
        <div class="modal modal-centered">
            <div class="modal-content shadow-lg p-5">
                <div class="border-b p-2 pb-3 pt-0 mb-4">
                    <div class="flex justify-between items-center">
                        Agregar imagen
                        <span class='close-modal cursor-pointer px-3 py-1 rounded-full bg-gray-100 hover:bg-gray-200'>
                            <i class="fas fa-times text-gray-700"></i>
                        </span>
                    </div>
                    <form class="w-full" action="../productos/agregarProducto.php" method="post">
                        <div class="flex flex-wrap -mx-3 mb-6">

                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1">
                                    Seleccione su imagen
                                </label>
                                <input
                                    class="appearance-none block w-full bg-grey-200 text-grey-darker border border-grey-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white-500 focus:border-gray-600"
                                    name="serial" id="serial" type="file" placeholder="Ingrese el serial" required>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
            < <script>
                $(document).ready(function() {
                $('#dataTable').DataTable();

                });
                </script>
                <script src="../js/main.js"></script>

</body>

</html>
<?php
if (isset($_SESSION['producto'])) {
    echo "<script>
    Swal.fire({
        icon: 'success',
        title: 'Éxito',
        text: 'Producto agregado'
        });
    </script>";
    unset($_SESSION['producto']);
}

if (isset($_SESSION['actualizar_producto'])) {
    echo "<script>
    Swal.fire({
        icon: 'success',
        title: 'Éxito',
        text: 'Producto Actualizado'
        });
    </script>";
    unset($_SESSION['actualizar_producto']);
}
?>