<?php
  // Configuramos PHP para mostrar errores y warnings
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  // Establecemos la conexión con la base de datos
  $enlace = mysqli_connect(
    "localhost",  // Servidor
    "accesoadatos",  // Usuario
    "accesoadatos",  // Contraseña
    "accesoadatos"  // Base de datos
  ) OR die("error");  // Si no se puede establecer la conexión, se muestra un mensaje de error

//En el supuesto caso de que ya se haya creado la tabla dara fatal error

  // Leemos el contenido del archivo "004-modelodedatos.json" en una variable
  $json = file_get_contents("004-modelodedatos.json");
  // Decodificamos el contenido JSON en un array asociativo
  $datos = json_decode($json, true);

  // Iteramos sobre el array asociativo
  foreach ($datos as $dato) {
    // Obtenemos el valor de la clave 'nombre' de cada elemento
    $nombredetabla = $dato['nombre'];
    // Creamos una cadena con la sentencia SQL para crear una tabla
    $cadena = "CREATE TABLE ".$nombredetabla." ( ";
    
    // Iteramos sobre las columnas de cada tabla
    foreach($dato['columnas'] as $columna){
      // Agregamos la columna a la sentencia SQL
      $cadena .= $columna['nombre']." ".$columna['tipo']." (".$columna['longitud']."),";
    }
    
    // Eliminamos la coma y el espacio al final de la cadena
    $cadena = substr($cadena, 0, -1);
    // Agregamos el cierre de la sentencia SQL
    $cadena .= " ) ";
    
    // Ejecutamos la sentencia SQL para crear la tabla
    mysqli_query($enlace, $cadena);
  }
?>


