PONERLE ESTILO A ESTO

<?php

if(!empty($_SESSION['administrador']) or !empty($_SESSION['usuario'])){
}else{
die("<center><br>
 <h1 style='color: limegreen;'>Error: No has iniciado sesión todavía...! </h1>
 <br>
 <h2 style='color: lime;'>Vamos a la pagina de inicio de sesión.</h2>
 <br>
 <a href='./login-registro.php'>
  <button style='background-color: lime;border-radius: 20px; width: 80px; height: 30px'>Login</button>
 </a>
</center>");
}

?>