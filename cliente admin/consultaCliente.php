<?php
		require('../database/basededatos.php');

		//Creamos un objeto del tipo Database
		$db = new Database();
		$connection = $db->connect(); //Creamos la conexión a la BD
	
		// Cuando la conexión está establecida...
		$query = $connection->prepare("SELECT * FROM cliente");// Traduzco mi petición
		$query->execute(); //Ejecuto mi petición
	
		$clientes = $query->fetchAll(PDO::FETCH_ASSOC); //Me traigo los datos que necesito
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cliente</title>
</head>
<body>
	<h1>Cliente</h1>
	<br><br>
	<table>
		<th>
			<tr>
				<td>Email</td>
				<td>Nombre</td>
				<td>Apellido</td>
				<td>Direccion</td>
				<td>Telefono</td>
				<td type="password">Contraseña</td>
			</tr>
			<tbody>
				<?php foreach($clientes as $key => $cliente){ ?>
					<tr>
						<td><?php echo $cliente["email"]."<br>"; ?>		</td>
                        <td><?php echo $cliente["nombre"]."<br>"; ?></td>
                        <td><?php echo $cliente["apellido"]."<br>"; ?></td>
                        <td><?php echo $cliente["direccion"]."<br>"; ?></td>
						<td><?php echo $cliente["telefono"]."<br>"; ?></td>
						<td><?php echo $cliente["contrasenia"]."<br>"; ?></td>
                        <td> <a href="editarCliente.php?id=<?php echo $cliente["email"]; ?>">Editar</a> </td>
						<td><a href="eliminarCliente.php?id=<?php echo $cliente["email"]; ?>">Eliminar</a></td>
					</tr>
				<?php } ?>
			</tbody>
		</th>
	</table>
</body>
</html>