<?php
function selecciona($tabla) { // Definimos la función 'selecciona' que toma un parámetro '$tabla'
    $mysqli = mysqli_connect( // Establecemos la conexión a la base de datos
        "localhost", 
        "accesoadatos", 
        "accesoadatos", 
        "accesoadatos"
    );
    
    $query = "SELECT * FROM " . $tabla . ";"; // Creamos la consulta SQL para seleccionar todos los registros de la tabla especificada
    $result = mysqli_query($mysqli, $query); // Ejecutamos la consulta SQL y obtenemos el resultado
    $resultado = []; // Inicializamos un array vacío para almacenar los resultados
    
    while ($row = mysqli_fetch_assoc($result)) { // Iteramos sobre cada fila del resultado
        $resultado[] = $row; // Agregamos cada fila al array de resultados
    }
    
    $json = json_encode($resultado, JSON_PRETTY_PRINT); // Convertimos el array de resultados a formato JSON con indentación
    return $json; // Devolvemos el JSON generado
}

echo selecciona("clientes"); // Llamamos a la función 'selecciona' con la tabla 'clientes' y mostramos el resultado
?>
