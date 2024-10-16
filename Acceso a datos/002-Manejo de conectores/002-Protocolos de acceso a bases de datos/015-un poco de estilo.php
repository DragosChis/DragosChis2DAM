<?php
	if(isset($_POST['usuario'])){ // Verificamos si se ha enviado el formulario
		ini_set('display_errors', 1); // Activamos la visualización de errores de PHP
		ini_set('display_startup_errors', 1); // Activamos la visualización de errores de inicio de PHP
		error_reporting(E_ALL); // Establecemos el nivel de reporte de errores en todos los tipos

		// Establecemos la conexión a la base de datos utilizando los datos proporcionados por el usuario
		$enlace = mysqli_connect(
			$_POST['servidor'], // Servidor de la base de datos
			$_POST['usuario'], // Usuario de la base de datos
			$_POST['contrasena'], // Contraseña de la base de datos
			$_POST['basededatos'] // Nombre de la base de datos
		) OR die("error"); // Establecemos la conexión a la base de datos

		// Leemos el contenido del archivo JSON que contiene la estructura de las tablas
		$json = file_get_contents("004-modelodedatos.json"); 
		$datos = json_decode($json, true); // Decodificamos el contenido del archivo JSON en un array asociativo

		// Iteramos sobre el array asociativo para crear las tablas en la base de datos
		foreach ($datos as $dato) { 
			$nombredetabla = $dato['nombre']; // Obtenemos el nombre de la tabla
			$cadena = "CREATE TABLE ".$nombredetabla." (
			Identificador INT NOT NULL AUTO_INCREMENT , "; // Agregamos la columna Identificador
			foreach($dato['columnas'] as $columna){ // Iteramos sobre las columnas de la tabla
				$cadena .= $columna['nombre']." ".$columna['tipo']." "; // Agregamos un campo por cada columna
				if($columna['tipo'] != "TEXT"){ // Verificamos si el tipo de la columna no es TEXT
					$cadena .= " (".$columna['longitud'].") "; // Agregamos la longitud de la columna si es necesario
				}
				$cadena .= ","; // Agregamos una coma al final de cada campo
			}
			$cadena .= "PRIMARY KEY (Identificador) "; // Agregamos la clave primaria
			$cadena .= " )  ENGINE = InnoDB"; // Agregamos el tipo de motor de la base de datos
			mysqli_query($enlace, $cadena); // Ejecutamos la sentencia SQL para crear la tabla
		}
	}else{
		// Si no se ha enviado el formulario, mostramos el formulario HTML
?>
<!doctype html>
<html>
	<head>
		<title>Instalador de bases de datos</title> 
		<style>
			/* Estilos para el formulario */
			body,html{
				height:100%;padding:0px;margin:0px;
				background:url(fondo.jpg);background-size:cover;
			}
			form{
				width:300px;height:400px;background:rgba(255,255,255,0.5);
				box-sizing:border-box;padding:20px;border-radius:20px;
				position:absolute;top:50%;left:50%;margin-left:-150px;margin-top:-200px;
				text-align:center;color:white;
				backdrop-filter:blur(20px);
			}
			form input{
				width:100%;padding:10px 0px;margin:5px 0px;
				outline:none;border:none;border-bottom:1px solid white;background:none;
			}
			form input::placeholder{
				color:white;
			}
			form input[type=submit]{
				background:white;
				border-radius:20px;
				color:black;
			}
		</style>
	</head>
	<body>
		<form method="POST" action="?"> 
			<h1>Instalador</h1>
			<input type="text" name="usuario" placeholder="Usuario de la base de datos"> 
			<input type="text" name="contrasena" placeholder="Contraseña de la base de datos"> 
			<input type="text" name="servidor" placeholder="Servidor de la base de datos"> 
			<input type="text" name="basededatos" placeholder="Nombre de la base de datos"> 
			<input type="submit"> 
		</form>
	</body>
</html>

<?php } ?>


