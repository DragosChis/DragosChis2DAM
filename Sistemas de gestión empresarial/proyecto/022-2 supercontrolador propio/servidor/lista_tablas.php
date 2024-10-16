<?php

	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);			// Establezco el nivel de retorno de errores de PHP

	$mysqli = mysqli_connect("localhost", "crimson", "crimson", "crimson");		// Me conecto a la base de datos

	$query = "
		SHOW TABLES;
	";										// Consulta SQL para mostrar todas las tablas de la base de datos

	$result = mysqli_query($mysqli, $query);					// Ejecuto la consulta contra la base de datos

	$aplicaciones = [];								// Creo un array vacío para almacenar los resultados

	while ($row = mysqli_fetch_assoc($result)) {					// Recorro los resultados obtenidos de la consulta
		$aplicaciones[] = $row;							// Añado cada fila obtenida al array 'aplicaciones'
	}

	echo json_encode($aplicaciones);							// Devuelvo el array 'aplicaciones' en formato JSON
	
?>

