<?php
// Establecemos la conexión a la base de datos utilizando mysqli
($enlace = mysqli_connect(
	"localhost", // Servidor de la base de datos
	"accesoadatos", // Usuario de la base de datos
	"accesoadatos", // Contraseña del usuario
	"accesoadatos" // Nombre de la base de datos
)) or die("error"); // Si no se puede establecer la conexión, se muestra un mensaje de error

// Creamos una consulta SQL para crear una tabla llamada "clientes"
mysqli_query(
	$enlace,
	"
    CREATE TABLE clientes (
      Identificador INT NOT NULL AUTO_INCREMENT ,  
      nombre VARCHAR(255) NOT NULL ,  
      apellidos VARCHAR(255) NOT NULL ,  
      PRIMARY KEY (Identificador)  
    ) ENGINE = InnoDB;  
  "
);
?>


