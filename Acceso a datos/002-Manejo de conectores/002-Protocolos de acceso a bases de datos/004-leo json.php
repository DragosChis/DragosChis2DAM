<?php

	$enlace = mysqli_connect(
	"localhost", 
	"accesoadatos", 
	"accesoadatos", 
	"accesoadatos"
	) OR die("error");

	/*mysqli_query($enlace, "
		CREATE TABLE clientes (
		Identificador INT NOT NULL AUTO_INCREMENT ,
		nombre VARCHAR(255) NOT NULL ,
		apellidos VARCHAR(255) NOT NULL ,
		PRIMARY KEY (Identificador)
		) ENGINE = InnoDB;
		");*/
	
  $json = file_get_contents("004-modelodedatos.json");  // Leemos el contenido del archivo "004-modelodedatos.json" en una variable
  $datos = json_decode($json, true);  // Decodificamos el contenido JSON en un array asociativo
  var_dump($datos);  // Mostramos el contenido del array asociativo utilizando var_dump
?>


