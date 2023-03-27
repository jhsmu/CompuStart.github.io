<?php
    $id=$_GET['id'];
    include("conexion.php");

    $sql="delete from administrador where id_administrador='".$id."'";
    $resultado=mysqli_query($conexion,$sql);

    if($resultado){
        session_start();
        $_SESSION['eliminar_admi'] = 'registro';
        header("location: ../usuario.php");
    } else{
        echo "<script languaje='JavaScript'>
            alert('Los datos fueron NO se eliminaron');
            location.assign('./usuario.php');</script>";
    }


    
?>