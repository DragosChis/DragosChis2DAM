<?php
	ini_set('display_errors', 1);												// Activamos la visualización de errores
	ini_set('display_startup_errors', 1);								// Activamos la visualización de errores de inicio
	error_reporting(E_ALL);															// Establecemos el nivel de reporte de errores
	
	class conexionDB{																		// Definimos la clase 'conexionDB'
		
			private $servidor;															// Propiedad privada para el servidor
			private $usuario;																// Propiedad privada para el usuario
			private $contrasena;														// Propiedad privada para la contraseña
			private $basededatos;														// Propiedad privada para la base de datos
			private $conexion;															// Propiedad privada para la conexión
			
			public function __construct() {									// Constructor de la clase
        $this->servidor = "localhost";								// Inicializamos el servidor con la dirección local
        $this->usuario = "accesoadatos";							// Inicializamos el usuario para la conexión
        $this->contrasena = "accesoadatos";						// Inicializamos la contraseña para la conexión
        $this->basededatos = "accesoadatos";					// Inicializamos el nombre de la base de datos
        
        $this->conexion = mysqli_connect(						// Establecemos la conexión a la base de datos
					$this->servidor, 
					$this->usuario, 
					$this->contrasena, 
					$this->basededatos
				);																						// 
    }
			public function seleccionaTabla($tabla){				// Método para seleccionar registros de una tabla
				$query = "SELECT * FROM ".$tabla.";";					// Creamos la consulta SQL de forma dinámica
				$result = mysqli_query($this->conexion , $query);		// Ejecutamos la consulta SQL
				$resultado = [];															// Inicializamos un array vacío para almacenar los resultados
				while ($row = mysqli_fetch_assoc($result)) {	// Iteramos sobre cada fila del resultado
						$resultado[] = $row;											// Agregamos cada fila al array de resultados
						
				}
				$json = json_encode($resultado, JSON_PRETTY_PRINT);		// Convertimos el array de resultados a formato JSON con indentación
				return $json;																	// Devolvemos el JSON generado
			}
			
			private function codifica($entrada){						// Método privado para codificar datos
				return base64_encode($entrada);						// Codificamos la entrada en base64
			}
			
			private function decodifica($entrada){					// Método privado para decodificar datos
				return base64_decode($entrada);						// Decodificamos la entrada de base64
			}
	}
	
	$conexion = new conexionDB();												// Creamos una instancia de la clase
	
	echo $conexion->seleccionaTabla("empleados");												// Llamamos al método 'seleccionaTabla' y mostramos el resultado
	
?>
