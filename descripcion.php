
<?php
    error_reporting( ~E_NOTICE ); // avoid notice
	
    require_once './database/conexion.php';

    if (isset($_GET['id'])) {
        $consulta=$DB_con->prepare('SELECT * FROM producto WHERE id_producto=:producto');
        $consulta->bindParam(':producto', $_GET['id']);
        $consulta->execute();

        $producto=$consulta->fetch(PDO::FETCH_ASSOC);

        $consulta2=$DB_con->prepare('SELECT * FROM marca WHERE id_marca=:marca');
        $consulta2->bindParam(':marca', $producto['id_marca']);
        $consulta2->execute();

        $marca=$consulta2->fetch(PDO::FETCH_ASSOC);

        $consulta3=$DB_con->prepare('SELECT * FROM imagenes WHERE producto_id=:producto');
        $consulta3->bindParam('producto', $_GET['id']);
        $consulta3->execute();

        $imagenes=$consulta3->fetchAll(PDO::FETCH_ASSOC);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <!-- css bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
 <!-- iconos en fontawesome -->
    <script src="https://kit.fontawesome.com/4b93f520b2.js" crossorigin="anonymous"></script>
<!-- css cuerpo -->
    <link rel="stylesheet" href="./css/style_cuerpo.css">
    <link rel="stylesheet" href="./css/style.css">
<!-- css footer y el header -->
     <link rel="stylesheet" href="./css/footer-header.css">
    <title>Compu_start</title>
</head>
<body>

<header>
  <?php include(("./componentes/headerindex.php")); ?>
</header>

    <div class="container">

    <div class=" mb-3" style="width: 100%; height: 600px;">
        <div class="row g-0">
        <div class="col-md-4">
          <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              <br> <br> <br> <br> <br>
              <?php
                $contador=1;
                foreach ($imagenes as $key => $imagen) {
                  if ($contador==1) {
              ?>
                <div class="carousel-item active">
                    <img src="./imagenes/<?php echo $imagen['url'] ?>" class="d-block w-100" alt="" width="600" height="350">
                </div>
              <?php
                  }else{
              ?>
                <div class="carousel-item">
                     <img src="./imagenes/<?php echo $imagen['url'] ?>" class="d-block w-100" alt="" width="600" height="350">
                </div>
              <?php
                  }
                $contador++;
                }
              ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
            </div>
        </div>
        <div class="col-md-7" style="margin: 70px 20px ;">
            <div class="card-body">
              <h2 class="card-title" style="margin: 70px 10px ;" name="monitorAOC24" id="nombre"><?php echo $producto['producto'] ?></h2>
              <h3 class="card-text"><?php echo 'Marca: '.$marca['marca'] ?></h3>
              <h3>Características</h3>
              <p class="card-text"><?php echo $producto['descripcion'] ?></p>
              <h3 name="precio" id="precio"><?php echo '$'.$producto['precio'] ?></h3>
              <div class="row">
                    <div class="col-2">
                        <input type="number" class="form-control" style="height:100%" name="cantidad" id="cantidadUsu" value="1" min="1" max="<?php echo $producto['cantidad'] ?>" onchange="cantidad123()">
                      </div>
                    <div class="col-2">
                      <a type="button" class="btn btn-success btn-lg" href="./login-registro.php">Agregar</a>
                    </div>
                    <div class="col-2">
                    <a type="button" class="btn btn-lg" style="background: #144272; color:#fff" href="./paginaCategoria.php?id=<?php echo $producto['id_categoria'] ?>";>Atrás</a>
                    </div>
                    <div class="col-auto">
                          <input type="number" name="cantidad" id="cantidadRef" value="<?php echo $producto['cantidad'] ?>" hidden>
                    <p  name="" id="" style="color:gray;"><?php echo $producto['cantidad'] ?> Unidades disponibles</p>
                          </div>
            </div>
          </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="./js/amunetar.js"></script>
</body>
</html>