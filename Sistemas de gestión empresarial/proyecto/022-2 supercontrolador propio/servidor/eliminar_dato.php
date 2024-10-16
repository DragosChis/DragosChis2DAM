<?php

	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);  // Establezco que MySQLi reporte errores de forma estricta

	$mysqli = mysqli_connect("localhost", "crimson", "crimson", "crimson");  // Me conecto a la base de datos MySQL

	$query = "
		DELETE FROM ".$_GET['tabla']." WHERE Identificador = ".$_GET['id'].";
	";  // Genero una consulta SQL para eliminar una fila de la tabla indicada, donde 'Identificador' coincida con el ID recibido

	echo $query;  // Imprimo la consulta para verificar qué se está ejecutando (útil para depuración)

	$result = mysqli_query($mysqli, $query);  // Ejecuto la consulta DELETE en la base de datos

	$aplicaciones = [];  // Inicializo un array vacío

	while ($row = mysqli_fetch_assoc($result)) {  // Recorro el resultado, aunque no devolverá filas en un DELETE
		$aplicaciones[] = $row;  // Añado cada fila al array (este bloque es innecesario en un DELETE, pero lo dejo)
	}

	echo json_encode($aplicaciones);  // Devuelvo el array vacío en formato JSON (en DELETE no hay datos que devolver)

?>

