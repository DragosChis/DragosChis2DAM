<?php

	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);			// Establezco el nivel de retorno de errores de PHP

	$mysqli = mysqli_connect("localhost", "crimson", "crimson", "crimson");		// Me conecto a la base de datos

	$query = "
		SELECT 
			nombre,
			descripcion,
			icono
		FROM aplicaciones 
		WHERE activa = 1
	";										// Selecciono los campos nombre, descripción e icono de la tabla aplicaciones donde la columna activa sea igual a 1

	$result = mysqli_query($mysqli, $query);					// Ejecuto la consulta SQL contra la base de datos

	$aplicaciones = [];								// Creo un array vacío para almacenar los resultados

	while ($row = mysqli_fetch_assoc($result)) {					// Recorro los resultados fila por fila
		$aplicaciones[] = $row;						// Añado cada fila al array de aplicaciones
	}

	echo json_encode($aplicaciones);						// Devuelvo el array de aplicaciones en formato JSON
	
?>

