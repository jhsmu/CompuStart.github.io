<?php
    include '../database/conexion.php';

    if (isset($_POST['enviar'])) {
        $email=$_POST['email'];
        $consulta=$DB_con->prepare('SELECT * FROM cliente');
        $consulta->execute();

        $clientes=$consulta->fetchAll(PDO::FETCH_ASSOC);

        foreach ($clientes as $key => $cliente) {
            if ($cliente['email']==$email) {
                $token=uniqid();

                $agregar=$DB_con->prepare('UPDATE cliente SET token=:token WHERE email=:email');
                $agregar->bindParam(':token', $token);
                $agregar->bindParam(':email', $email);
                $agregar->execute();

                $asunto="Recuperación de contraseña";
                $url="http://".$_SERVER["SERVER_NAME"]."/recuperacion/cambio.php?id=".$cliente["id"]."&token=".$token;

                $mensaje='
                <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
                    <title>Document</title>
                </head>
                <body>
                    <p>Use este link para recuperar su contraseña: <a class="nav-link" href="'.$url.'">Recuperar contraseña</a></p>
                </body>
                </html>';

                mail($email, $asunto, $mensaje);
                echo '<script>alert("Se le envio un correo a su email para recuperar su contraseña")</script>';
                break;
            } else {
                continue;
            }
        }

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <br>
    <h1>Ingrese su email</h1>
    <br>
    <form action="" method="post">
        <input type="email" name="email" id="">
        <button type="submit" name="enviar">Enviar</button>
    </form>
</body>
</html>

