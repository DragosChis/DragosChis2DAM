<?php

$mysqli = mysqli_connect("localhost", "crimson", "crimson", "crimson"); // Conecta a la base de datos MySQL utilizando las credenciales proporcionadas

$query = "CALL SeleccionaClientesMalo();"; // Define una consulta SQL que llama al procedimiento almacenado 'SeleccionaClientesMalo'

$result = mysqli_query($mysqli, $query); // Ejecuta la consulta SQL y almacena el resultado en la variable $result

while ($row = mysqli_fetch_row($result)) { // Itera sobre cada fila del resultado de la consulta
    var_dump($row); // Muestra el contenido de cada fila con var_dump (imprime detalles del array)
}

?>