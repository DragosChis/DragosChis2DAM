<?php

	$enlace = mysqli_connect(
	"localhost", 
	"accesoadatos", 
	"accesoadatos", 
	"accesoadatos"
	) OR die("error");
//En el supuesto caso de que ya se haya creado la tabla dara fatal error
	mysqli_query($enlace, "
		CREATE TABLE clientes (
		Identificador INT NOT NULL AUTO_INCREMENT ,
		nombre VARCHAR(255) NOT NULL ,
		apellidos VARCHAR(255) NOT NULL ,
		PRIMARY KEY (Identificador)
		) ENGINE = InnoDB;
		");
?>


