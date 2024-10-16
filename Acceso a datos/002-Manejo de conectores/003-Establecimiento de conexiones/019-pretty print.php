<?php
$mysqli = mysqli_connect("localhost", "accesoadatos", "accesoadatos", "accesoadatos"); // Establecemos la conexión a la base de datos
$query = "SELECT * FROM empleados"; // Definimos la consulta SQL para seleccionar todos los empleados
$result = mysqli_query($mysqli, $query); // Ejecutamos la consulta SQL y obtenemos el resultado
$resultado = []; // Inicializamos un array vacío para almacenar los resultados
while ($row = mysqli_fetch_assoc($result)) { // Iteramos sobre cada fila del resultado
    $resultado[] = $row; // Agregamos cada fila al array de resultados
}
$json = json_encode($resultado, JSON_PRETTY_PRINT); // Convertimos el array de resultados a formato JSON con indentación
echo $json; // Mostramos el contenido del JSON
?>
