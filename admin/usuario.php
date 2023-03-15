<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Css -->
    <link rel="stylesheet" href="../css/styles.css">
    <script type="text/javascript">
        function confirmar(){
            return confirm('¿Estas seguro?, se eliminarán los datos');
        }
    </script>
    <link rel="stylesheet" href="../css/all.css">
            <!-- iconos en fontawesome -->
            <script src="https://kit.fontawesome.com/4b93f520b2.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,600,600i,700,700i" rel="stylesheet">
    <title>Lista de usuarios registrados</title>
</head>

<body>
<?php
    session_start();
    include("./editar/conexion.php");

    $sql = "select * from cliente";
    $resultado=mysqli_query($conexion,$sql);
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
                    <a href="#" onclick="profileToggle()" class="text-white p-2 no-underline hidden md:block lg:block"><?php echo $_SESSION["admin"] ?></a>
                    <img onclick="profileToggle()" class="inline-block h-8 w-8 rounded-full" src="../img/logo/avatar.png" alt="">
                    <div id="ProfileDropDown" class="rounded hidden shadow-md bg-white absolute pin-t mt-12 mr-1 pin-r">
                        <ul class="list-reset">
                          <li>
                            <a href="./micuenta.php?id_administrador=<?php echo $_SESSION["id_administrador"];?>" class="no-underline px-4 py-2 block text-black hover:bg-grey-light">Mi cuenta</a></li>
                          <li><a href="#" class="no-underline px-4 py-2 block text-black hover:bg-grey-light">Notifications</a></li>
                          <li><hr class="border-t mx-2 border-grey-light"></li>
                          <li><a href="../validaciones/cerrarSesion.php" class="no-underline px-4 py-2 block text-black hover:bg-grey-light">Cerrar Sesión</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
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
                               Lista de clientes
                            </div>
                            <div class="p-3">
                                <table class="table-responsive w-full rounded">
                                    <thead>
                                      <tr>
                                        <th class="border w-1/7 px-4 py-2">Id</th>
                                        <th class="border w-1/6 px-4 py-2">Nombres</th>
                                        <th class="border w-1/6 px-4 py-2">Apellidos</th>
                                        <th class="border w-1/6 px-4 py-2">Dirección</th>
                                        <th class="border w-1/7 px-4 py-2">Email</th>
                                        <th class="border w-1/5 px-4 py-2">Teléfono</th>
                                        <th class="border w-1/5 px-4 py-2">Acción</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        while($filas=mysqli_fetch_assoc($resultado)){
                                            ?>
                                        <tr>
                                            <td class="border px-4 py-2"><?php echo $filas['id']?></td>
                                            <td class="border px-4 py-2"><?php echo $filas['nombre']?></td>
                                            <td class="border px-4 py-2"><?php echo $filas['apellido']?></td>
                                            <td class="border px-4 py-2"><?php echo $filas['direccion']?></td>
                                            <td class="border px-4 py-2"><?php echo $filas['email']?></td>
                                            <td class="border px-4 py-2"><?php echo $filas['telefono']?></td>
                                            <td class="border px-4 py-2">
                                                <a class="bg-teal-300 cursor-pointer rounded p-1 mx-1 text-white" href="./actualizarUsuario.php?id=<?php echo $filas['id'];?>">
                                                        <i class="fas fa-edit"></i></a>
                                                <a class="bg-teal-300 cursor-pointer rounded p-1 mx-1 text-red-500" href="./editar/eliminar.php?id=<?php echo $filas['id'];?>" onclick= 'return confirmar()' >
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

</body>

</html>