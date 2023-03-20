<?php
session_start();

error_reporting(~E_NOTICE); // avoid notice

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
                                    Agregar Producto
                                </div>
                                <div class="p-3">
                                    <form class="w-full" method="post" action="../productos/agregarProducto.php">
                                        <div class="flex flex-wrap -mx-3 mb-6">

                                            <!--Campo de serial-->
                                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                                <label
                                                    class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1"
                                                    for="serial">
                                                    Serial
                                                </label>
                                                <input
                                                    class="appearance-none block w-full bg-grey-200 text-grey-darker border border-grey-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white-500 focus:border-gray-600"
                                                    id="serial" type="text" placeholder="Ingrese el serial"
                                                    name="serial">
                                            </div>

                                            <!--Campo de producto-->
                                            <div class="w-full md:w-1/2 px-3">
                                                <label
                                                    class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1"
                                                    for="nombre">
                                                    Nombre del producto
                                                </label>
                                                <input
                                                    class="appearance-none block w-full bg-grey-200 text-grey-darker border border-grey-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white-500 focus:border-gray-600"
                                                    id="nombre" type="text" name="producto"
                                                    placeholder="Ingrese el nombre del producto">
                                            </div>
                                        </div>
                                        <div class="flex flex-wrap -mx-3 mb-6">

                                            <!--Campo de descripción-->
                                            <div class="w-full px-3">
                                                <label
                                                    class="block uppercase tracking-wide text-grey-darker text-xs font-light mb-1"
                                                    for="descripcion">
                                                    Descripción
                                                </label>
                                                <textarea
                                                    class="appearance-none block w-full bg-grey-200 text-grey-darker border border-grey-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-grey"
                                                    id="descripcion" rows="4" name="descripcion"></textarea>
                                            </div>
                                        </div>
                                        <div class="flex flex-wrap -mx-3 mb-2">

                                            <!--Campo de cantidad-->
                                            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                                <label
                                                    class="block uppercase tracking-wide text-grey-darker text-xs font-light mb-1"
                                                    for="cantidad">
                                                    Cantidad
                                                </label>
                                                <input
                                                    class="appearance-none block w-full bg-grey-200 text-grey-darker border border-grey-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-grey"
                                                    id="cantidad" type="number" name="cantidad"
                                                    placeholder="Cantidad del producto">
                                            </div>

                                            <!--Campo de precio-->
                                            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                                <label
                                                    class="block uppercase tracking-wide text-grey-darker text-xs font-light mb-1"
                                                    for="precio">
                                                    Precio
                                                </label>
                                                <input
                                                    class="appearance-none block w-full bg-grey-200 text-grey-darker border border-grey-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-grey"
                                                    id="precio" type="text" name="precio"
                                                    placeholder="Precio del producto">
                                            </div>

                                            <!--Campo de categoria-->
                                            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                                <label
                                                    class="block uppercase tracking-wide text-grey-darker text-xs font-light mb-1"
                                                    for="grid-state">
                                                    Elegir Una Categoría
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
                                        </div>
                                        <div class="flex flex-wrap -mx-3 mb-2">

                                            <!--Campo de marca-->
                                            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                                <label
                                                    class="block uppercase tracking-wide text-grey-darker text-xs font-light mb-1"
                                                    for="grid-state">
                                                    Elegir Una Marca
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

                                            <!--Campo de proveedor-->
                                            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                                <label
                                                    class="block uppercase tracking-wide text-grey-darker text-xs font-light mb-1"
                                                    for="grid-state">
                                                    Elegir Un proveedor
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
                                        </div>
                                        <div class="flex flex-1  flex-col md:flex-row lg:flex-row mx-2">
                                            <div class="mb-2  rounded shadow-sm w-full md:w-1/1 lg:w-1/3"></div>
                                            <button
                                                class="bg-transparent hover:bg-green-500 text-blue-dark font-semibold hover:text-white py-2 px-4 border border-blue hover:border-transparent  rounded-full">
                                                Agregar
                                            </button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--/Grid Form-->
                    </div>
                    <div class="flex flex-1  flex-col md:flex-row lg:flex-row mx-2">
                        <div class="mb-2 border-solid border-gray-300 rounded border shadow-sm w-full">
                            <div class="bg-gray-200 px-2 py-3 border-solid border-gray-200 border-b">
                                Agregar imagen
                            </div>
                            <div class="p-3">
                                <form class="w-full" action="">
                                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1"
                                            for="grid-first-name">
                                            Imagen
                                        </label>
                                        <input
                                            class="appearance-none block w-full bg-grey-200 text-grey-darker border border-grey-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white-500 focus:border-gray-600"
                                            id="grid-first-name" type="file" name="imagen[]" accept="image/*" multiple="multiple" placeholder="Ingrese el serial">
                                            <button type="button" id="agregar_mas">+</button>
                                    </div>
                            </div>
                            </form>
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
?>