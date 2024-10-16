<?php
	ini_set('display_errors', 1);												// Activa la visualización de errores
	ini_set('display_startup_errors', 1);								// Activa la visualización de errores durante el arranque
	error_reporting(E_ALL);															// Establece que se muestren todos los tipos de errores
	
	class conexionDB{																		// Declaración de la clase para manejar conexiones a la base de datos
		
			private $servidor;															// Propiedad privada para almacenar el servidor de la base de datos
			private $usuario;																// Propiedad privada para el nombre de usuario
			private $contrasena;														// Propiedad privada para la contraseña
			private $basededatos;														// Propiedad privada para el nombre de la base de datos
			private $conexion;															// Propiedad privada para almacenar la conexión activa
			
			public function __construct() {									// Método constructor que inicializa la conexión a la base de datos
        $this->servidor = "localhost";								// Establece el servidor como localhost (servidor local)
        $this->usuario = "accesoadatos";							// Establece el usuario de la base de datos
        $this->contrasena = "accesoadatos";						// Establece la contraseña del usuario
        $this->basededatos = "accesoadatos";					// Establece el nombre de la base de datos a utilizar
        
        $this->conexion = mysqli_connect(							// Realiza la conexión a la base de datos con los parámetros proporcionados
					$this->servidor, 
					$this->usuario, 
					$this->contrasena, 
					$this->basededatos
				);																															// Completa la conexión a la base de datos
    }
			public function seleccionaTabla($tabla){													// Método para seleccionar registros de una tabla específica
				$query = "SELECT * FROM ".$tabla.";";														// Construye la consulta SQL para seleccionar todos los registros de la tabla
				$result = mysqli_query($this->conexion , $query);								// Ejecuta la consulta en la base de datos
				$resultado = [];																								// Inicializa un array vacío para almacenar los resultados
				while ($row = mysqli_fetch_assoc($result)) {										// Itera sobre cada fila del resultado obtenido
						//$resultado[] = $row;																			// Añade cada fila al array de resultados (comentado)
						$fila = [];																							// Inicializa un array para almacenar la fila actual
						foreach($row as $clave=>$valor){																// Recorre cada columna de la fila actual
							$fila[$clave] = $valor;																				// Almacena el valor de cada columna en su respectiva clave
						}
						$resultado[] = $fila;																					// Añade la fila completa al array de resultados
				}
				$json = json_encode($resultado, JSON_PRETTY_PRINT);							// Codifica el array de resultados en formato JSON con formato legible
				return $json;																										// Devuelve el JSON resultante
			}
			
			public function listadoTablas(){																// Método para listar todas las tablas de la base de datos
				$query = "SHOW TABLES;";																				// Construye la consulta SQL para mostrar todas las tablas
				$result = mysqli_query($this->conexion , $query);								// Ejecuta la consulta en la base de datos
				$resultado = [];																								// Inicializa un array vacío para almacenar los resultados
				while ($row = mysqli_fetch_assoc($result)) {										// Itera sobre cada fila del resultado obtenido
						//$resultado[] = $row;																			// Añade cada fila al array de resultados (comentado)
						$fila = [];																							// Inicializa un array para almacenar la fila actual
						foreach($row as $clave=>$valor){																// Recorre cada columna de la fila actual
							$fila[$clave] = $valor;																				// Almacena el valor de cada columna en su respectiva clave
						}
						$resultado[] = $fila;																					// Añade la fila completa al array de resultados
				}
				$json = json_encode($resultado, JSON_PRETTY_PRINT);							// Codifica el array de resultados en formato JSON con formato legible
				return $json;																										// Devuelve el JSON resultante
			}
			
			public function insertaTabla($tabla,$valores){										// Método para insertar nuevos registros en una tabla específica
					$campos = "";																									// Inicializa una cadena para almacenar los nombres de los campos
					$datos = ""; 																									// Inicializa una cadena para almacenar los valores de los datos
					foreach($valores as $clave=>$valor){													// Itera sobre cada par clave-valor del array de valores
						$campos .= $clave.",";																			// Añade el nombre del campo a la cadena de campos
						$datos .= "'".$valor."',";																	// Añade el valor correspondiente a la cadena de datos, entre comillas simples
					}
					$campos = substr($campos, 0, -1);															// Elimina la última coma de la cadena de campos
					$datos = substr($datos, 0, -1);																// Elimina la última coma de la cadena de datos
					$query = "																												
						INSERT INTO ".$tabla." 
						(".$campos.") 
						VALUES (".$datos.");
						";																													// Completa la consulta SQL
					$result = mysqli_query($this->conexion , $query);							// Ejecuta la consulta de inserción en la base de datos
					return 0;																											// Retorna 0 como resultado del método
			}
			
			public function actualizaTabla($tabla,$valores){								// Método para actualizar registros en una tabla (pendiente de implementación)
			
			}
			public function eliminaTabla($tabla,$id){											// Método para eliminar registros de una tabla (pendiente de implementación)
			
			}
			
			private function codifica($entrada){													// Método privado para codificar una cadena en base64
				return base64_encode($entrada);															// Devuelve la cadena codificada en base64
			}
			
			private function decodifica($entrada){												// Método privado para decodificar una cadena desde base64
				return base64_decode($entrada);															// Devuelve la cadena decodificada en su forma original
			}
	}
	
	$conexion = new conexionDB();												// Crea una nueva instancia de la clase de conexión a la base de datos
	
	echo $conexion->insertaTabla("clientes",["nombre"=>'Nombre de prueba',"apellidos"=>'Apellidos de prueba']);	// Inserta un registro de ejemplo en la tabla 'clientes'
	
?>

