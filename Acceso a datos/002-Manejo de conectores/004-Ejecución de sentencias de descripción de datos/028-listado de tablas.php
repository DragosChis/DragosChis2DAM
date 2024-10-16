<?php	
	ini_set('display_errors', 1);												// Activa la visualización de todos los errores
	ini_set('display_startup_errors', 1);								// Activa la visualización de errores ocurridos durante el arranque
	error_reporting(E_ALL);															// Configura el reporte de errores para mostrar todos los tipos de errores
	
	class conexionDB{																		// Declaración de la clase para manejar conexiones a la base de datos
		
			private $servidor;															// Variable que almacena el nombre o dirección del servidor
			private $usuario;																// Variable que almacena el nombre del usuario de la base de datos
			private $contrasena;														// Variable que almacena la contraseña del usuario
			private $basededatos;														// Variable que almacena el nombre de la base de datos a utilizar
			private $conexion;															// Variable que guarda el recurso de conexión con la base de datos
			
			public function __construct() {									// Método constructor que inicializa la conexión a la base de datos
        $this->servidor = "localhost";								// Asigna el servidor donde se encuentra la base de datos (local)
        $this->usuario = "accesoadatos";							// Asigna el nombre de usuario para acceder a la base de datos
        $this->contrasena = "accesoadatos";						// Asigna la contraseña para el usuario especificado
        $this->basededatos = "accesoadatos";					// Asigna el nombre de la base de datos que se va a utilizar
        
        $this->conexion = mysqli_connect(						// Realiza la conexión a la base de datos utilizando las credenciales anteriores
					$this->servidor, 
					$this->usuario, 
					$this->contrasena, 
					$this->basededatos
				);																						// Finaliza la llamada a la función de conexión
    }
			public function seleccionaTabla($tabla){				// Método que permite seleccionar todos los registros de una tabla
				$query = "SELECT * FROM ".$tabla.";";					// Crea una consulta SQL para seleccionar todos los datos de la tabla
				$result = mysqli_query($this->conexion , $query);		// Ejecuta la consulta en la base de datos
				$resultado = [];															// Array que almacenará el resultado de la consulta
				while ($row = mysqli_fetch_assoc($result)) {	// Recorre cada fila obtenida de la consulta
						$fila = [];													// Array para almacenar cada fila de datos
						foreach($row as $clave=>$valor){			// Recorre cada columna de la fila
							$fila[$clave] = $valor;						// Asigna cada valor de la columna a su respectiva clave
						}
						$resultado[] = $fila;									// Agrega la fila completa al array de resultados
				}
				$json = json_encode($resultado, JSON_PRETTY_PRINT);		// Convierte el array resultante a formato JSON con formato legible
				return $json;																	// Devuelve el JSON resultante
			}
			
			public function insertaTabla($tabla, $valores){		// Método que inserta nuevos registros en una tabla específica
				// Implementación no realizada
			}
			
			public function actualizaTabla($tabla, $valores){		// Método que actualiza registros existentes en una tabla
				// Implementación no realizada
			}
			
			public function eliminaTabla($tabla, $id){				// Método que elimina registros de una tabla por un identificador
				// Implementación no realizada
			}
			
			private function codifica($entrada){						// Método que codifica una cadena de texto en base64
				return base64_encode($entrada);						// Devuelve la cadena codificada en base64
			}
			
			private function decodifica($entrada){					// Método que decodifica una cadena de texto desde base64
				return base64_decode($entrada);						// Devuelve la cadena decodificada a su formato original
			}
	}
	
	$conexion = new conexionDB();												// Crea una nueva instancia de la clase de conexión a la base de datos
	
	echo $conexion->seleccionaTabla("empleados");								// Llama al método para seleccionar todos los registros de la tabla 'empleados' y muestra el resultado
	echo "<br><br>";
	echo $conexion->listadoTablas();											// Llama al método para listar las tablas de la base de datos y muestra el resultado
	
?>
