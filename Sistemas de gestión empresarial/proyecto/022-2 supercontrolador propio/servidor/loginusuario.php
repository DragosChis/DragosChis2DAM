<?php

	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);			// Establezco el nivel de retorno de errores de PHP

	$mysqli = mysqli_connect("localhost", "crimson", "crimson", "crimson");		// Me conecto a la base de datos

	$query = "
		SELECT 
		usuario
		FROM usuarios 
		WHERE usuario = '".$_GET['usuario']."' 
		AND contrasena = '".$_GET['contrasena']."'
	";										// Consulta SQL para verificar si el usuario y contraseña coinciden

	$result = mysqli_query($mysqli, $query);					// Ejecuto la consulta contra la base de datos

	if ($row = mysqli_fetch_assoc($result)) {					// Si se encuentra una coincidencia en la base de datos
		$row['resultado'] = 'ok';						// Añado una nueva clave 'resultado' con valor 'ok' al array
	    echo json_encode($row);							// Devuelvo el array como JSON, incluyendo el usuario y el resultado
	}else{										// Si no se encuentra coincidencia
		echo '{"resultado:":"ko"}'; 						// Devuelvo un JSON indicando que el resultado es 'ko'
	}
	
?>

