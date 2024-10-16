<?php
$mysqli = mysqli_connect("localhost", "accesoadatos", "accesoadatos", "accesoadatos"); // Establecemos la conexión a la base de datos
$query = "SELECT * FROM empleados"; // Definimos la consulta SQL para seleccionar todos los empleados
$result = mysqli_query($mysqli, $query); // Ejecutamos la consulta SQL y obtenemos el resultado
while ($row = mysqli_fetch_assoc($result)) { // Iteramos sobre cada fila del resultado
    var_dump($row); // Mostramos el contenido de cada fila
}
?>
