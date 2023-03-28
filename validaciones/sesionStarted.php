<?php
 if(empty($_SESSION['administrador']) or empty($_SESSION['usuario'])){
  session_start();
  $_SESSION['IngresoForsozo'] = 'ingreso';
  header("location: ../Compu_start/login-registro.php");
 }
?>