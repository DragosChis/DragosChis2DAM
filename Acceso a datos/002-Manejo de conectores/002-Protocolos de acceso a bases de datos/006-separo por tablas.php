<?php
  // Establecemos la conexión con la base de datos
  $enlace = mysqli_connect(
    "localhost",  // Servidor
    "accesoadatos",  // Usuario
    "accesoadatos",  // Contraseña
    "accesoadatos"  // Base de datos
  ) OR die("error");  // Si no se puede establecer la conexión, se muestra un mensaje de error

  // Leemos el contenido del archivo "004-modelodedatos.json" en una variable
  $json = file_get_contents("004-modelodedatos.json");
  // Decodificamos el contenido JSON en un array asociativo
  $datos = json_decode($json, true);
  // Mostramos el contenido del array asociativo utilizando var_dump
  var_dump($datos);
  echo "<br><br>";  // Salto de línea
  
  // Iteramos sobre el array asociativo
  foreach ($datos as $dato) {
    // Mostramos el contenido de cada elemento del array
    var_dump($dato);
    // Obtenemos el valor de la clave 'nombre' de cada elemento
    $nombredetabla = $dato['nombre'];
    // Creamos una cadena con la sentencia SQL para crear una tabla
    $cadena = "CREATE TABLE ".$nombredetabla;
    echo "<br><br>";  // Salto de línea
  }
?>


