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

  // Leemos el contenido del archivo "004-modelodedatos.json" en una variable
  $json = file_get_contents("004-modelodedatos.json");
  // Decodificamos el contenido JSON en un array asociativo
  $datos = json_decode($json, true);

  // Iteramos sobre el array asociativo
  foreach ($datos as $dato) {
    // Obtenemos el valor de la clave 'nombre' de cada elemento
    $nombredetabla = $dato['nombre'];
    // Creamos una cadena con la sentencia SQL para crear una tabla
    $cadena = "CREATE TABLE ".$nombredetabla." ( Identificador INT NOT NULL AUTO_INCREMENT , ";
    
    // Iteramos sobre las columnas de cada tabla
    foreach($dato['columnas'] as $columna){
      // Agregamos la columna a la sentencia SQL
      $cadena .= $columna['nombre']." ".$columna['tipo']." ";
      
      // Si el tipo de columna no es TEXT, agregamos la longitud
      if($columna['tipo'] != "TEXT"){
        $cadena .= " (".$columna['longitud'].") ";
      }
      
      // Agregamos una coma al final de la cadena
      $cadena .= ",";
    }
    
    // Agregamos la clave primaria y el motor de almacenamiento
    $cadena .= "PRIMARY KEY (Identificador) ";
    $cadena .= " )  ENGINE = InnoDB";
    
    // Mostramos la sentencia SQL
    echo $cadena;
    
    // Ejecutamos la sentencia SQL para crear la tabla
    mysqli_query($enlace, $cadena);
  }
?>


