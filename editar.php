<?php
session_start();
    include("./editar/conexion.php");
    $id = $_GET["id_cliente"];
    error_reporting(0);
    
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
    <link rel="stylesheet" href="./css/edit.css">
    <title>Actualizar</title>
    <script type="text/javascript">
        function confirmar(){
            return confirm('¿Estas seguro?, se eliminarán los datos');
        }
    </script>
</head>

<body>
    <header>
<?php
   include ("./componentes/headerinicio.php") 
?>
</header>
    <?php
        if(isset($_POST['enviar'])){
            //entra si le da el botón enviar
            $id=$_POST['id'];
            $nombre=$_POST['nombre'];
            $apellido=$_POST['apellido'];
            $direccion=$_POST['direccion'];
            $telefono=$_POST['telefono'];
            $email=$_POST['email'];
            $contrasena=$_POST['contrasena'];
            $imagen=$_FILES['imagen'];

            //update
            $sql="update cliente set nombre='".$nombre."',
            apellido='".$apellido."',
            direccion='".$direccion."',
            telefono='".$telefono."',
            email='".$email."',
            contrasenia='".$contrasena."',
            imagen='".$imagen."'
            where id='".$id."'";

            $resultado=mysqli_query($conexion,$sql);

            if($resultado){
                echo "<script language='JavaScript'>
                alert('Los datos se actualizaron correctamente');
                location.assign('./inicio.php');</script>";
                error_reporting(0);

            }else{
                echo "<script language='JavaScript'>
                alert('Los datos NO se actualizaron :(');
                location.assign('./editar.php');</script>";
                error_reporting(0);
            }
            mysqli_close($conexion);


        } else{
            //no le ha dado al botón enviar
            $id=$_GET['id_cliente'];
            $sql="select *from cliente where id='".$id."'";
            $resultado=mysqli_query($conexion,$sql);

            $fila=mysqli_fetch_assoc($resultado);
            $id=$fila["id"];
            $nombre=$fila["nombre"];
            $apellido=$fila["apellido"];
            $direccion=$fila["direccion"];
            $email=$fila["email"]; 
            $telefono=$fila["telefono"];
            $contrasena=$fila["contrasenia"];
            $imagen=$fila["imagen"];
            
            mysqli_close($conexion);
            error_reporting(0);
    ?>

<div class="container">
        <div class="form">
            <form action="<?=$_SERVER["PHP_SELF"]?>" method="post">
                <div class="form-header">
                    <div class="title">
                        <h1>Editar Perfil</h1>
                    </div>
                </div>
                <div class="input-group">
                    <div class="input-box">
                        <label for="">Nombres</label>
                        <input type="text" name="nombre" value="<?php echo $nombre;?>">
                    </div>
                    <div class="input-box">
                        <label for="">Apellidos</label>
                        <input  type="text" name="apellido" value="<?php echo $apellido;?>">
                    </div>
                    <div class="input-box">
                        <label for="direccion">Dirección</label>
                        <input id="direccion" type="text" name="direccion" value="<?php echo $direccion;?>">
                    </div>                   
                    <div class="input-box">
                        <label for="telefono">Teléfono</label>
                        <input id="telefono" type="text" name="telefono" value="<?php echo $telefono;?>">
                    </div>
                    <div class="input-box">
                        <label for="email">Email</label>
                        <input id="email" type="email" name="email" value="<?php echo $email;?>"">
                    </div>
                    <div class="input-box">
                        <label for="password">Contraseña</label>
                        <input id="password" type="password" name="contrasena"value="<?php echo $contrasena;?>">
                    </div>
                    <div class="input-box">
                        <label for="">Cambiar Avatar</label>
                        <input type="file" name="imagen">
                    </div>
                    <input type="hidden" name="id" 
                    value="<?php echo $id;?>">
                </div>

                <div class="continue-button">
                    <button type="submit" name="enviar" value="ACTUALIZAR"><a href="#">Actualizar</a></button>
                    <?php echo "<button class='elimina'><a href='./editar/eliminar_cliente.php?id=".$fila['id']."' onclick='return confirmar()'>Eliminar cuenta</a></button>";?>
                </div>
            </form>
        </div>
    </div>  

<?php
    }
?>

<footer>
    <?php include("./componentes/footer.php")?>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>