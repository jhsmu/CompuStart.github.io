<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Css -->
    <link rel="stylesheet" href="../css/styles.css">
    <script type="text/javascript">
    function confirmar() {
        return confirm('¿Estas seguro?, se eliminarán los datos');
    }
    </script>
    <link rel="stylesheet" href="../css/all.css">
    <!-- iconos en fontawesome -->
    <script src="https://kit.fontawesome.com/4b93f520b2.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,600,600i,700,700i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,600,600i,700,700i" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Lista de usuarios </title>
</head>

<body>
    <?php
    session_start();
    include("./editar/conexion.php");

    if (isset($_POST['rol'])) {
        $rol = $_POST['rol'];
        switch ($rol) {
            case 'administrador':
                $sql = "select * from administrador";
                $resultado = mysqli_query($conexion, $sql);
                break;
            case 'cliente':
                $sql = "select * from cliente";
                $resultado = mysqli_query($conexion, $sql);
                break;

            case 'cliente habilitado':
                $sql = "select * from cliente where estado = 1";
                $resultado = mysqli_query($conexion, $sql);
                break;
            case 'cliente inhabilitado':
                $sql = "select * from cliente where estado = 0";
                $resultado = mysqli_query($conexion, $sql);
                break;
        }
    } else {
        $sql = "select * from cliente";
        $resultado = mysqli_query($conexion, $sql);
    }

    ?>

    <!--Container -->
    <div class="mx-auto bg-grey-lightest">
        <!--Screen-->
        <div class="min-h-screen flex flex-col">
            <!--Header Section Starts Here-->
            
            <header class="bg-nav">
                <?php
                include("./editar/conexion.php");
                $id = "SELECT * FROM administrador WHERE id_administrador= $_SESSION[id_administrador]";
                $admin = "SELECT * FROM administrador";
                ?>
                <div class="flex justify-between">
                    <div class="p-1 mx-3 inline-flex items-center">
                        <i class="fas fa-bars pr-2 text-white" onclick="sidebarToggle()"></i>
                        <h1 class="text-white p-2">Compu Start</h1>
                    </div>
                    <div class="p-1 flex flex-row items-center">
                        <a href="#" onclick="profileToggle()"
                            class="text-white p-2 no-underline hidden md:block lg:block"><?php echo $_SESSION["admin"] ?></a>
                        <img onclick="profileToggle()" class="inline-block h-8 w-8 rounded-full"
                            src="../img/logo/avatar.png" alt="">
                        <div id="ProfileDropDown"
                            class="rounded hidden shadow-md bg-white absolute pin-t mt-12 mr-1 pin-r">
                            <ul class="list-reset">
                                <li>
                                    <a href="./micuenta.php?id_administrador=<?php echo $_SESSION["id_administrador"]; ?>"
                                        class="no-underline px-4 py-2 block text-black hover:bg-grey-light">Mi
                                        cuenta</a>
                                </li>
                                <li><a href="#"
                                        class="no-underline px-4 py-2 block text-black hover:bg-grey-light">Notifications</a>
                                </li>
                                <li>
                                    <hr class="border-t mx-2 border-grey-light">
                                </li>
                                <li><a href="../validaciones/cerrarSesion.php"
                                        class="no-underline px-4 py-2 block text-black hover:bg-grey-light">Cerrar
                                        Sesión</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </header>
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
                <!--Main-->
                <main class="bg-white-500 flex-1 p-3 overflow-hidden">
                    <!--Grid Form-->

                    <div class="flex flex-1  flex-col md:flex-row lg:flex-row mx-2">
                        <div class="mb-2 border-solid border-gray-300 rounded border shadow-sm w-full">
                            <div class="bg-gray-200 px-2 py-3 border-solid border-gray-200 border-b">
                                <div class="w-full md:w-1/1 px-3 mb-6 md:mb-0">
                                    <form action="" method="post">
                                        <div class="relative md:w-1/5 ">
                                            <select
                                                class="block appearance-none w-full bg-grey-200 border border-grey-200 text-grey-darker py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-grey"
                                                id="grid-state" name="rol">
                                                <option value="" selected type="hidden">Selecciona un rol</option>
                                                <option value="administrador">Administradores</option>
                                                <option value="cliente">Todos los clientes</option>
                                                <option value="cliente habilitado">Clientes habilitados</option>
                                                <option value="cliente inhabilitado">Clientes inhabilitados</option>
                                            </select>
                                            <div
                                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-grey-darker ">
                                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20">
                                                    <path
                                                        d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                                </svg>
                                            </div>
                                            
                                           
                                        </div>
                                        <br>
                                        <div class="mr-16 ">
                                            <button type="submit" class="rounded-full bg-blue-800 hover:bg-blue-500 w-32 h-8 text-white ">Traer</button>
                                        </div>
                                    </form>

                                    
                                </div>
                            </div>
                            <div class="p-3">
                                <?php
                                if (!isset($rol) || $rol == 'cliente') {
                                    echo "Está visualizando el rol de clientes";
                                ?>
                                <table class="table-responsive w-full rounded">
                                    <thead>
                                        <tr>
                                            <th class="border w-1/7 px-4 py-2">Id</th>
                                            <th class="border w-1/6 px-4 py-2">Nombres</th>
                                            <th class="border w-1/6 px-4 py-2">Apellidos</th>
                                            <th class="border w-1/6 px-4 py-2">Dirección</th>
                                            <th class="border w-1/7 px-4 py-2">Email</th>
                                            <th class="border w-1/5 px-4 py-2">Teléfono</th>
                                            <th class="border w-1/5 px-4 py-2">Estado</th>
                                            <th class="border w-1/5 px-4 py-2">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            while ($filas = mysqli_fetch_assoc($resultado)) {
                                            ?>
                                        <tr>
                                            <td class="border px-4 py-2"><?php echo $filas['id'] ?></td>
                                            <td class="border px-4 py-2"><?php echo $filas['nombre'] ?></td>
                                            <td class="border px-4 py-2"><?php echo $filas['apellido'] ?></td>
                                            <td class="border px-4 py-2"><?php echo $filas['direccion'] ?></td>
                                            <td class="border px-4 py-2"><?php echo $filas['email'] ?></td>
                                            <td class="border px-4 py-2"><?php echo $filas['telefono'] ?></td>
                                            <td class="border px-4 py-2"><?php echo $filas['estado']?></td>
                                            <td class="border px-4 py-2">
                                                <a class="bg-blue-800 cursor-pointer rounded p-1 mx-1 text-white"
                                                    href="./actualizarUsuario.php?id=<?php echo $filas['id']; ?>">
                                                    <i class="fas fa-edit"></i></a>
                                                <a class="bg-red-500 cursor-pointer rounded p-1 mx-1 text-white"
                                                    href="./editar/eliminar.php?id=<?php echo $filas['id']; ?>"
                                                    onclick='return confirmar()'>
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                <?php
                                }        
                                ?>
                                    </tbody>
                                </table>
                                <?php
                                } elseif ($rol == 'cliente habilitado') {
                                    echo "Está visualizando el rol de clientes habilitados"
                                ?>
                                <table class="table-responsive w-full rounded">
                                    <thead>
                                        <tr>
                                            <th class="border w-1/7 px-4 py-2">Id</th>
                                            <th class="border w-1/6 px-4 py-2">Nombres</th>
                                            <th class="border w-1/6 px-4 py-2">Apellidos</th>
                                            <th class="border w-1/6 px-4 py-2">Dirección</th>
                                            <th class="border w-1/7 px-4 py-2">Email</th>
                                            <th class="border w-1/5 px-4 py-2">Teléfono</th>
                                            <th class="border w-1/5 px-4 py-2">Estado</th>
                                            <th class="border w-1/5 px-4 py-2">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            while ($filas = mysqli_fetch_assoc($resultado)) {
                                            ?>
                                        <tr>
                                            <td class="border px-4 py-2"><?php echo $filas['id'] ?></td>
                                            <td class="border px-4 py-2"><?php echo $filas['nombre'] ?></td>
                                            <td class="border px-4 py-2"><?php echo $filas['apellido'] ?></td>
                                            <td class="border px-4 py-2"><?php echo $filas['direccion'] ?></td>
                                            <td class="border px-4 py-2"><?php echo $filas['email'] ?></td>
                                            <td class="border px-4 py-2"><?php echo $filas['telefono'] ?></td>
                                            <td class="border px-4 py-2"><?php echo $filas['estado']?></td>
                                            <td class="border px-4 py-2">
                                                <a class="bg-blue-800 cursor-pointer rounded p-1 mx-1 text-white"
                                                    href="./actualizarUsuario.php?id=<?php echo $filas['id']; ?>">
                                                    <i class="fas fa-edit"></i></a>
                                                <a class="bg-red-500 cursor-pointer rounded p-1 mx-1 text-white"
                                                    href="./editar/eliminar.php?id=<?php echo $filas['id']; ?>"
                                                    onclick='return confirmar()'>
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                <?php
                                }        
                                ?>
                                <?php
                                } elseif ($rol == 'cliente inhabilitado') {
                                    echo "Está visualizando el rol de clientes inhabilitados"
                                ?>
                                <table class="table-responsive w-full rounded">
                                    <thead>
                                        <tr>
                                            <th class="border w-1/7 px-4 py-2">Id</th>
                                            <th class="border w-1/6 px-4 py-2">Nombres</th>
                                            <th class="border w-1/6 px-4 py-2">Apellidos</th>
                                            <th class="border w-1/6 px-4 py-2">Dirección</th>
                                            <th class="border w-1/7 px-4 py-2">Email</th>
                                            <th class="border w-1/5 px-4 py-2">Teléfono</th>
                                            <th class="border w-1/5 px-4 py-2">Estado</th>
                                            <th class="border w-1/5 px-4 py-2">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            while ($filas = mysqli_fetch_assoc($resultado)) {
                                            ?>
                                        <tr>
                                            <td class="border px-4 py-2"><?php echo $filas['id'] ?></td>
                                            <td class="border px-4 py-2"><?php echo $filas['nombre'] ?></td>
                                            <td class="border px-4 py-2"><?php echo $filas['apellido'] ?></td>
                                            <td class="border px-4 py-2"><?php echo $filas['direccion'] ?></td>
                                            <td class="border px-4 py-2"><?php echo $filas['email'] ?></td>
                                            <td class="border px-4 py-2"><?php echo $filas['telefono'] ?></td>
                                            <td class="border px-4 py-2"><?php echo $filas['estado']?></td>
                                            <td class="border px-4 py-2">
                                                <a class="bg-blue-800 cursor-pointer rounded p-1 mx-1 text-white"
                                                    href="./actualizarUsuario.php?id=<?php echo $filas['id']; ?>">
                                                    <i class="fas fa-edit"></i></a>
                                                <a class="bg-red-500 cursor-pointer rounded p-1 mx-1 text-white"
                                                    href="./editar/eliminar.php?id=<?php echo $filas['id']; ?>"
                                                    onclick='return confirmar()'>
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                <?php
                                }        
                                ?>
                                <?php
                                } elseif ($rol == 'administrador') {
                                    echo "Está visualizando los administradores";
                                ?>
                                <label class="flex justify-end">
                                    <button data-modal='centeredFormModal'
                                                    class="modal-trigger bg-blue-800 cursor-pointer rounded p-1 mx-1 text-white"
                                                    href="">
                                                    <i class="fa fa-user-plus"></i>
                                                    </button>
                                        Agregar Administrador
                                </label>
                                <script src="../js/main.js"></script>
                                <table class="table-responsive w-full rounded">
                                    <thead>
                                        <tr>
                                            <th class="border w-1/7 px-4 py-2">Id</th>
                                            <th class="border w-1/6 px-4 py-2">Nombre</th>
                                            <th class="border w-1/6 px-4 py-2">Apellido</th>
                                            <th class="border w-1/7 px-4 py-2">Email</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            while ($filas = mysqli_fetch_assoc($resultado)) {
                                            ?>
                                        <tr>
                                            <td class="border px-4 py-2"><?php echo $filas['id_administrador'] ?></td>
                                            <td class="border px-4 py-2"><?php echo $filas['nombre'] ?></td>
                                            <td class="border px-4 py-2"><?php echo $filas['apellido'] ?></td>
                                            <td class="border px-4 py-2"><?php echo $filas['email'] ?></td>
                                            <td class="border px-4 py-2">
                                                <a class="bg-red-500 cursor-pointer rounded p-1 mx-1 text-white"
                                                    href="./editar/eliminar.php?id=<?php echo $filas['id_administrador']; ?>"
                                                    onclick='return confirmar()'>
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
                                            }
                                            ?>
                                    </tbody>
                                </table>
                                <?php
                                }
                                ?>
                        <div id='centeredFormModal' class="modal-wrapper w-full md:w1/1">
                        <div class="overlay close-modal"></div>
                            <div class="modal modal-centered">
                                <div class="modal-content shadow-lg p-5">
                                    <div class="border-b p-2 pb-3 pt-0 mb-4">
                                        <div class="flex justify-between items-center">
                                            Agregar Administrador
                                            <span class='close-modal cursor-pointer px-3 py-1 rounded-full bg-gray-100 hover:bg-gray-200'>
                                                <i class="fas fa-times text-gray-700"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <form class="w-full" action="../admin/agregarAdministrador.php" method="post">
                                        <div class="flex flex-wrap -mx-3 mb-6">
                                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1">
                                                    Nombre Administrador
                                                </label>
                                                <input class="appearance-none block w-full bg-grey-200 text-grey-darker border border-grey-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white-500 focus:border-gray-600" name="nombre" id="nombre" type="text" placeholder="Ingrese el nombre administrador" required>
                                            </div>
                                            <div class="w-full md:w-1/2 px-3">
                                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1" for="grid-last-name">
                                                    Apellido Administrador
                                                </label>
                                                <input class="appearance-none block w-full bg-grey-200 text-grey-darker border border-grey-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white-500 focus:border-gray-600" name="apellido" id="apellido" type="text" placeholder="Ingrese el apellido administrador" required>
                                            </div>
                                        </div>
                                        <div class="flex flex-wrap -mx-3 mb-6">
                                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1">
                                                    Email Administrador
                                                </label>
                                                <input class="appearance-none block w-full bg-grey-200 text-grey-darker border border-grey-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white-500 focus:border-gray-600" name="email" id="email" type="text" placeholder="Ingrese el email administrador" required>
                                            </div>
                                            <div class="w-full md:w-1/2 px-3">
                                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1" for="grid-last-name">
                                                Contraseña
                                                </label>
                                                <input class="appearance-none block w-full bg-grey-200 text-grey-darker border border-grey-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white-500 focus:border-gray-600" name="contrasena" id="contrasena" type="password" placeholder="Ingrese la contraseña administrador" required>
                                            </div>
                                        </div>
                                        <div class="mt-8 ml-32">
                                            <button class='bg-blue-500 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded'> 
                                                Agregar</button>
                                            <span class='close-modal cursor-pointer bg-red-200 hover:bg-red-500 text-red-900 font-bold py-2 px-4 rounded'>
                                                Cerrar
                                            </span>
                                        </div>
                                        
                                       
                                    </form>
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

</body>

</html>
<?php
if (isset($_SESSION['actualizar_usuario'])) {
    echo "<script>
    Swal.fire({
        icon: 'success',
        title: 'Éxito',
        text: 'Usuario Actualizado'
        });
    </script>";
    unset($_SESSION['actualizar_usuario']);
}

if (isset($_SESSION['error'])) {
    echo "<script>
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'Usuario no Actualizado'
        });
    </script>";
    unset($_SESSION['error']);
}

?>
