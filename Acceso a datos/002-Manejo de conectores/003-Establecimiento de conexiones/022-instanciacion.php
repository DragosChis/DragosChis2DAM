<?php
	ini_set('display_errors', 1); // Activamos la visualización de errores
	ini_set('display_startup_errors', 1); // Activamos la visualización de errores de inicio
	error_reporting(E_ALL); // Establecemos el nivel de reporte de errores
	
	class conexionDB{ // Definimos la clase 'conexionDB'
		
			public $servidor; // Propiedad para el servidor
			public $usuario; // Propiedad para el usuario
			public $contrasena; // Propiedad para la contraseña
			public $basededatos; // Propiedad para la base de datos
			public $conexion; // Propiedad para la conexión
			
			public function __construct() { // Constructor de la clase
        $this->servidor = "localhost"; // Inicializamos el servidor
        $this->usuario = "accesoadatos"; // Inicializamos el usuario
        $this->contrasena = "accesoadatos"; // Inicializamos la contraseña
        $this->basededatos = "accesoadatos"; // Inicializamos la base de datos
        
        $this->conexion = mysqli_connect( // Establecemos la conexión a la base de datos
					$this->servidor, 
					$this->usuario, 
					$this->contrasena, 
					$this->basededatos
				);
    }
			public function seleccionaTabla($tabla){ // Método para seleccionar registros de una tabla
				$query = "SELECT * FROM ".$tabla.";"; // Creamos la consulta SQL
				$result = mysqli_query($this->conexion , $query); // Ejecutamos la consulta SQL
				$resultado = []; // Inicializamos un array vacío para almacenar los resultados
				
				while ($row = mysqli_fetch_assoc($result)) { // Iteramos sobre cada fila del resultado
						$resultado[] = $row; // Agregamos cada fila al array de resultados
				}
				
				$json = json_encode($resultado, JSON_PRETTY_PRINT); // Convertimos el array de resultados a formato JSON con indentación
				return $json; // Devolvemos el JSON generado
			}
	}
	
	$conexion = new conexionDB(); // Creamos una instancia de la clase
	
	echo $conexion->seleccionaTabla("empleados"); // Llamamos al método 'seleccionaTabla' con la tabla 'empleados' y mostramos el resultado
	echo $conexion->contrasena; // Mostramos la contraseña (no recomendado en producción)
	
?>
