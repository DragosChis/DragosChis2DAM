<?php

	class conexionDB{																													// Creo una nueva clase
		
			private $servidor;																										// Creo una serie de propiedades privadas
			private $usuario;																											// Propiedad para el usuario de la base de datos
			private $contrasena;																									// Propiedad para la contraseña de la base de datos
			private $basededatos;																									// Propiedad para el nombre de la base de datos
			private $conexion;																										// Propiedad para la conexión a la base de datos
			
			public function __construct() {																				// Constructor de la clase
        $this->servidor = "localhost";																			// Asigno el servidor
        $this->usuario = "crimson";																		// Asigno el usuario
        $this->contrasena = "crimson";																	// Asigno la contraseña
        $this->basededatos = "crimson";																// Asigno la base de datos
        
        $this->conexion = mysqli_connect(																	// Establezco la conexión a la base de datos
					$this->servidor, 
					$this->usuario, 
					$this->contrasena, 
					$this->basededatos
				);	
    }
			public function seleccionaTabla($tabla){													// Método para seleccionar registros de una tabla
				$query = "SELECT * FROM ".$tabla.";";														// Query para seleccionar todos los registros de la tabla
				$result = mysqli_query($this->conexion , $query);								// Ejecuto la consulta
				$resultado = [];																								// Array vacío para almacenar resultados
				while ($row = mysqli_fetch_assoc($result)) {										// Itero sobre los registros obtenidos
						//$resultado[] = $row;																			// Comentado: agrega la fila al array de resultados
						$fila = [];																								// Array para almacenar los valores de cada fila
						foreach($row as $clave=>$valor){															// Itero sobre cada columna del registro
							$fila[$clave] = $valor;																		// Almaceno clave-valor en el array de la fila
						}
						$resultado[] = $fila;																						// Agrego la fila al array de resultados
				}
				$json = json_encode($resultado, JSON_PRETTY_PRINT);							// Convierto el resultado a formato JSON
				return $json;																										// Retorno el JSON generado
			}
			
			public function listadoTablas(){																			// Método para listar todas las tablas
				$query = "SHOW TABLES;";																				// Query para mostrar todas las tablas en la base de datos
				$result = mysqli_query($this->conexion , $query);								// Ejecuto la consulta
				$resultado = [];																								// Array vacío para almacenar resultados
				while ($row = mysqli_fetch_assoc($result)) {										// Itero sobre los resultados
						//$resultado[] = $row;																			// Comentado: agrega la fila al array de resultados
						$fila = [];																								// Array para almacenar los valores de cada fila
						foreach($row as $clave=>$valor){															// Itero sobre cada columna del registro
							$fila[$clave] = $valor;																		// Almaceno clave-valor en el array de la fila
						}
						$resultado[] = $fila;																						// Agrego la fila al array de resultados
				}
				$json = json_encode($resultado, JSON_PRETTY_PRINT);							// Convierto el resultado a formato JSON
				return $json;																										// Retorno el JSON generado
			}
			
			public function insertaTabla($tabla,$valores){										// Método para insertar registros en una tabla
					$campos = "";																									// String para los nombres de los campos
					$datos = ""; 																									// String para los valores de los campos
					foreach($valores as $clave=>$valor){													// Itero sobre los valores recibidos
						$campos .= $clave.",";																			// Concateno el nombre del campo con una coma
						$datos .= "'".$valor."',";																	// Concateno el valor del campo entre comillas con una coma
					}
					$campos = substr($campos, 0, -1);															// Elimino la última coma del string de campos
					$datos = substr($datos, 0, -1);																// Elimino la última coma del string de valores
					$query = "																											
						INSERT INTO ".$tabla." 
						(".$campos.") 
						VALUES (".$datos.");
						";
					$result = mysqli_query($this->conexion , $query);							// Ejecuto la consulta de inserción
					return 0;																											// Retorno 0
			}
			
			public function actualizaTabla($tabla,$valores,$id){								// Método para actualizar registros de una tabla
					$query = "																											
						UPDATE ".$tabla." 
						SET
						";
					foreach($valores as $clave=>$valor){													// Itero sobre los valores recibidos
						$query .= $clave."='".$valor."', ";													// Concateno clave-valor con coma y espacio
					}
					$query = substr($query, 0, -2);																// Elimino los últimos dos caracteres (coma y espacio)
						$query .= "																										
						WHERE Identificador = ".$id."
						";
					echo $query;																										// Muestro la query generada
					$result = mysqli_query($this->conexion , $query);							// Ejecuto la consulta de actualización
					return "";																											// Retorno un string vacío
			}
			public function eliminaTabla($tabla,$id){															// Método para eliminar un registro de una tabla
				$query = "																												
						DELETE FROM ".$tabla." 
						WHERE Identificador = ".$id.";
						";
				$result = mysqli_query($this->conexion , $query);							// Ejecuto la consulta de eliminación
			}
			
			private function codifica($entrada){																// Método privado para codificar una cadena en base64
				return base64_encode($entrada);																// Retorno la cadena codificada en base64
			}
			
			private function decodifica($entrada){															// Método privado para decodificar una cadena en base64
				return base64_decode($entrada);																// Retorno la cadena decodificada en base64
			}
	}

?>

