<?php

	$mysqli = mysqli_connect("localhost", "crimson", "crimson", "crimson"); // Conecta a la base de datos MySQL con los datos de conexión

	$query = "CALL SeleccionaClientesBueno('car');"; // Define una consulta que llama al procedimiento almacenado 'SeleccionaClientesBueno' con el parámetro 'car'

	$result = mysqli_query($mysqli, $query); // Ejecuta la consulta SQL y almacena el resultado en $result

	while ($row = mysqli_fetch_row($result)) { // Itera sobre cada fila del resultado de la consulta
		  var_dump($row); // Muestra el contenido de la fila con var_dump
	}

?>

