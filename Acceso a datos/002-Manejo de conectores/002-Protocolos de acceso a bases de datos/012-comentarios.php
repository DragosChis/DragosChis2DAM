<?php
  ini_set('display_errors', 1); // Muestro los errores de PHP
  ini_set('display_startup_errors', 1); // Muestro los errores de inicio
  error_reporting(E_ALL); // Quiero mostrar todos los tipos de error

  $enlace = mysqli_connect(
    "localhost", // Servidor de la base de datos
    "accesoadatos", // Usuario de la base de datos
    "accesoadatos", // Contraseña de la base de datos
    "accesoadatos" // Nombre de la base de datos
  ) OR die("error"); // Me conecto a la base de datos

  $json = file_get_contents("004-modelodedatos.json"); // Leo el contenido del schema
  $datos = json_decode($json, true); // Lo proceso como objeto de php

  foreach ($datos as $dato) { // Para cada una de las tablas
    $nombredetabla = $dato['nombre']; // Tomo el nombre de la tabla
    $cadena = "CREATE TABLE ".$nombredetabla." ( 
    Identificador INT NOT NULL AUTO_INCREMENT , "; // Agrego la columna Identificador
    foreach($dato['columnas'] as $columna){ // Para cada una de las columnas
      $cadena .= $columna['nombre']." ".$columna['tipo']." "; // Agrego la columna
      if($columna['tipo'] != "TEXT"){ // En el caso de que el campo no sea un text
        $cadena .= " (".$columna['longitud'].") "; // Le añado la longitud
      }
      $cadena .= ","; // Añado una coma al final de cada campo
    }
    $cadena .= "PRIMARY KEY (Identificador) "; // Le añado una clave primaria
    $cadena .= " )  ENGINE = InnoDB"; // Le añado el tipo de motor de la base de datos
    echo $cadena; // Lanzo la cadena para debug
    mysqli_query($enlace, $cadena); // Ejecuto la peticioń contra la base de datos
  }
?>


