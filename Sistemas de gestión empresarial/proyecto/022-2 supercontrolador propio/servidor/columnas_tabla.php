<?php
	if(!isset($_GET['tabla'])){  // Si no se ha enviado el parámetro 'tabla' en la URL
		$tabla = "clientes";  // Establezco 'clientes' como valor por defecto para la tabla
	}else{
		$tabla = $_GET['tabla'];  // Si se envía el parámetro 'tabla', lo asigno a la variable $tabla
	}

	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);  // Configuro para que se reporten errores de MySQLi en caso de fallo

	$mysqli = mysqli_connect("localhost", "crimson", "crimson", "crimson");  // Conecto a la base de datos MySQL con los credenciales

	$query = "
		SHOW COLUMNS in ".$tabla .";
	";  // Creo la consulta SQL para obtener las columnas de la tabla especificada

	$result = mysqli_query($mysqli, $query);  // Ejecuto la consulta en la base de datos

	$aplicaciones = [];  // Inicializo un array vacío para almacenar los resultados

	while ($row = mysqli_fetch_assoc($result)) {  // Recorro los resultados obtenidos de la consulta
		$aplicaciones[] = $row;  // Añado cada fila del resultado al array 'aplicaciones'
	}

	echo json_encode($aplicaciones);  // Devuelvo los datos en formato JSON
	
?>

