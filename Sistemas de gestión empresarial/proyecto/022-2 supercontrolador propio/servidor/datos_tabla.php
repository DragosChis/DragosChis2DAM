<?php
	if(!isset($_GET['tabla'])){  // Si no se ha enviado el parámetro 'tabla' en la URL
		$tabla = "clientes";  // Si no se especifica, se usa la tabla 'clientes' por defecto
	}else{
		$tabla = $_GET['tabla'];  // Si el parámetro 'tabla' se ha enviado, lo asigno a la variable $tabla
	}

	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);  // Establezco que MySQLi reporte errores de forma estricta

	$mysqli = mysqli_connect("localhost", "crimson", "crimson", "crimson");  // Me conecto a la base de datos MySQL con las credenciales

	$query = "
		SELECT * FROM ".$tabla .";
	";  // Consulta SQL para seleccionar todos los registros de la tabla especificada

	$result = mysqli_query($mysqli, $query);  // Ejecuto la consulta en la base de datos

	$aplicaciones = [];  // Inicializo un array vacío para almacenar los resultados

	while ($row = mysqli_fetch_assoc($result)) {  // Recorro cada fila del resultado de la consulta
		$aplicaciones[] = $row;  // Añado cada fila del resultado al array 'aplicaciones'
	}

	echo json_encode($aplicaciones);  // Devuelvo el array 'aplicaciones' en formato JSON
	
?>

