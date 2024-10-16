<?php
	ini_set('display_errors', 1);												// Activa la visualización de errores
	ini_set('display_startup_errors', 1);								// Activa la visualización de errores durante la carga inicial
	error_reporting(E_ALL);															// Establece que se muestren todos los tipos de errores
	
	class conexionDB{																		// Definición de la clase para gestionar la conexión con la base de datos
		
			private $servidor;															// Propiedad para el servidor de la base de datos
			private $usuario;																// Propiedad para el usuario de la base de datos
			private $contrasena;														// Propiedad para la contraseña de la base de datos
			private $basededatos;														// Propiedad para el nombre de la base de datos
			private $conexion;															// Propiedad para la conexión activa a la base de datos
			
			public function __construct() {									// Constructor que inicializa la conexión con la base de datos
        $this->servidor = "localhost";								// Establece el servidor como localhost (servidor local)
        $this->usuario = "accesoadatos";							// Asigna el nombre de usuario para la base de datos
        $this->contrasena = "accesoadatos";						// Asigna la contraseña del usuario
        $this->basededatos = "accesoadatos";					// Asigna el nombre de la base de datos
        
        $this->conexion = mysqli_connect(							// Realiza la conexión a la base de datos con los parámetros configurados
					$this->servidor, 
					$this->usuario, 
					$this->contrasena, 
					$this->basededatos
				);																															// Conecta con la base de datos
    }
			public function seleccionaTabla($tabla){													// Método para seleccionar registros de una tabla
				$query = "SELECT * FROM ".$tabla.";";														// Construye la consulta SQL para seleccionar todos los registros
				$result = mysqli_query($this->conexion , $query);								// Ejecuta la consulta en la base de datos
				$resultado = [];																								// Inicializa un array para almacenar los resultados
				while ($row = mysqli_fetch_assoc($result)) {										// Itera sobre cada fila de los resultados
						//$resultado[] = $row;																			// Comentado: añade cada fila al array
						$fila = [];																							// Inicializa un array vacío para la fila actual
						foreach($row as $clave=>$valor){																// Itera sobre cada columna de la fila
							$fila[$clave] = $valor;																				// Almacena el valor de cada columna en la clave correspondiente
						}
						$resultado[] = $fila;																					// Añade la fila completa al array de resultados
				}
				$json = json_encode($resultado, JSON_PRETTY_PRINT);							// Convierte el array de resultados a formato JSON legible
				return $json;																										// Devuelve el JSON generado
			}
			
			public function listadoTablas(){																// Método para listar todas las tablas de la base de datos
				$query = "SHOW TABLES;";																				// Construye la consulta SQL para mostrar las tablas
				$result = mysqli_query($this->conexion , $query);								// Ejecuta la consulta en la base de datos
				$resultado = [];																								// Inicializa un array vacío para almacenar los resultados
				while ($row = mysqli_fetch_assoc($result)) {										// Itera sobre cada fila de los resultados obtenidos
						//$resultado[] = $row;																			// Comentado: añade cada fila al array
						$fila = [];																							// Inicializa un array vacío para la fila actual
						foreach($row as $clave=>$valor){																// Recorre cada columna de la fila actual
							$fila[$clave] = $valor;																				// Almacena el valor de cada columna en su clave correspondiente
						}
						$resultado[] = $fila;																					// Añade la fila completa al array de resultados
				}
				$json = json_encode($resultado, JSON_PRETTY_PRINT);							// Convierte el array de resultados a formato JSON legible
				return $json;																										// Devuelve el JSON generado
			}
			
			public function insertaTabla($tabla,$valores){										// Método para insertar nuevos registros en una tabla
					$campos = "";																									// Inicializa una cadena para los nombres de los campos
					$datos = ""; 																									// Inicializa una cadena para los valores a insertar
					foreach($valores as $clave=>$valor){													// Itera sobre cada par clave-valor del array de valores
						$campos .= $clave.",";																			// Añade el nombre del campo a la cadena de campos
						$datos .= "'".$valor."',";																	// Añade el valor a la cadena de datos, con comillas simples
					}
					$campos = substr($campos, 0, -1);															// Elimina la última coma de la cadena de campos
					$datos = substr($datos, 0, -1);																// Elimina la última coma de la cadena de datos
					$query = "																												
						INSERT INTO ".$tabla." 
						(".$campos.") 
						VALUES (".$datos.");
						";																													// Completa la consulta de inserción
					$result = mysqli_query($this->conexion , $query);							// Ejecuta la consulta de inserción
					return 0;																											// Devuelve 0 como resultado del método
			}
			
			public function actualizaTabla($tabla,$valores,$id){								// Método para actualizar un registro en una tabla específica
					$query = "																												
						UPDATE ".$tabla." 
						SET
						";																													// Prepara la cláusula SET para actualizar los valores
					foreach($valores as $clave=>$valor){													// Itera sobre cada par clave-valor del array de valores
						$query .= $clave."='".$valor."', ";													// Añade cada clave y valor a la consulta, separadas por comas
					}
					$query = substr($query, 0, -2);																// Elimina los últimos dos caracteres de la cadena (coma y espacio)
						$query .= "
						WHERE Identificador = ".$id."
						";																													// Añade la cláusula WHERE para identificar el registro a actualizar
					echo $query;																									// Muestra la consulta generada para propósitos de depuración
					$result = mysqli_query($this->conexion , $query);							// Ejecuta la consulta de actualización
					return "";																											// Devuelve una cadena vacía
			}
			
			public function eliminaTabla($tabla,$id){												// Método para eliminar un registro de una tabla (pendiente de implementación)
			
			}
			
			private function codifica($entrada){													// Método privado para codificar una cadena en base64
				return base64_encode($entrada);															// Devuelve la cadena codificada en base64
			}
			
			private function decodifica($entrada){												// Método privado para decodificar una cadena desde base64
				return base64_decode($entrada);															// Devuelve la cadena decodificada
			}
	}
	
	$conexion = new conexionDB();												// Crea una nueva instancia de la clase de conexión a la base de datos
	
	/*echo $conexion->seleccionaTabla("empleados");	
	echo "<br><br>";
	echo $conexion->listadoTablas();		//*/   // Comentado para pruebas
	
	echo $conexion->actualizaTabla(																// Llama al método para actualizar un registro en la tabla 'clientes'
		"clientes",
		["nombre"=>'Juanito',"apellidos"=>'Menganito'],								// Proporciona los valores a actualizar: nombre y apellidos
		'4'																													// El identificador del registro a actualizar
		);
	
?>

