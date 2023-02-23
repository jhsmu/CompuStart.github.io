<?php
    session_start();
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <link rel="stylesheet" href="./css/footer-header.css">
    <title>Document</title>
</head>

<body>
<header>
    <?php
        include(("./componentes/header.php"))
    ?>
</header>

<div class="container">
    <div class="row">
        <div class="col">
            
        </div>
    </div>
</div>


<footer class="pie-pagina">
<?php
        include(("./componentes/footer.php"))
?>
</footer>
</body>

</html>