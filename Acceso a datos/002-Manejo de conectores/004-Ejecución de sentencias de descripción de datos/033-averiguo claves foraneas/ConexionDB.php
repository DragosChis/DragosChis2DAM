<?php

	class conexionDB{																													// Creo una nueva clase
		
			private $servidor;																										// Propiedad privada para el servidor
			private $usuario;																											// Propiedad privada para el usuario
			private $contrasena;																									// Propiedad privada para la contraseña
			private $basededatos;																									// Propiedad privada para la base de datos
			private $conexion;																										// Propiedad privada para la conexión
			
			public function __construct() {																				// Creo un constructor
        $this->servidor = "localhost";																			// Le doy los datos de acceso a la base de datos
        $this->usuario = "crimson";																		// Asigno el usuario
        $this->contrasena = "crimson";																	// Asigno la contraseña
        $this->basededatos = "crimson";																// Asigno la base de datos
        
        $this->conexion = mysqli_connect(																	// Establezco una conexión con la base de datos
					$this->servidor, 
					$this->usuario, 
					$this->contrasena, 
					$this->basededatos
				);																															// 
    }
			public function seleccionaTabla($tabla){													// Creo un método de selección
				$query = "SELECT 
											*
									FROM 
											information_schema.key_column_usage
									WHERE 
											table_name = '".$tabla."';";											// Formateo una consulta SQL para ver qué campos tienen restricciones
				$result = mysqli_query($this->conexion , $query);								// Ejecuto la consulta contra la base de datos	
				$restricciones = [];																						// Creo un array vacío para guardar las restricciones
				while ($row = mysqli_fetch_assoc($result)) {										// Recupero los datos del servidor
					$restricciones[] = $row;																			// Hago un push encubierto a las restricciones
				}
				
				var_dump($restricciones);																				// Las debugeo en pantalla
				
				$query = "SELECT * FROM ".$tabla.";";														// Creo la petición dinámica para seleccionar todos los registros de la tabla
				$result = mysqli_query($this->conexion , $query);								// Ejecuto la petición
				$resultado = [];																								// Creo un array vacío para almacenar los resultados
				while ($row = mysqli_fetch_assoc($result)) {										// Para cada uno de los registros
						//$resultado[] = $row;																			// Los añadiría al array (comentado)
						$fila = [];																								// Array para almacenar los valores de la fila
						foreach($row as $clave=>$valor){															// Itero sobre cada clave y valor del registro
							$fila[$clave] = $valor;																		// Asigno el valor a la clave en el array de la fila
							echo "La clave ".$clave." tiene el valor ".$valor;	// Muestra la clave y su valor
						}
						$resultado[] = $fila;																				// Agrego la fila al array de resultados
				}
				$json = json_encode($resultado, JSON_PRETTY_PRINT);							// Lo codifico como JSON con formato legible
				return $json;																										// Devuelvo el JSON generado
			}
			
			public function listadoTablas(){																			// Método para listar todas las tablas en la base de datos
				$query = "SHOW TABLES;";																				// Creo la petición dinámica para mostrar todas las tablas
				$result = mysqli_query($this->conexion , $query);								// Ejecuto la petición
				$resultado = [];																								// Creo un array vacío para almacenar los resultados
				while ($row = mysqli_fetch_assoc($result)) {										// Para cada uno de los registros
						//$resultado[] = $row;																			// Los añadiría al array (comentado)
						$fila = [];																								// Array para almacenar los valores de la fila
						foreach($row as $clave=>$valor){															// Itero sobre cada clave y valor del registro
							$fila[$clave] = $valor;																		// Asigno el valor a la clave en el array de la fila
						}
						$resultado[] = $fila;																				// Agrego la fila al array de resultados
				}
				$json = json_encode($resultado, JSON_PRETTY_PRINT);							// Lo codifico como JSON con formato legible
				return $json;																										// Devuelvo el JSON generado
			}
			
			public function insertaTabla($tabla,$valores){										// Método de inserción de nuevos registros en una tabla
					$campos = "";																									// Creo un string para guardar los nombres de los campos
					$datos = ""; 																									// Creo un string para guardar los datos a insertar
					foreach($valores as $clave=>$valor){													// Para cada uno de los datos
						$campos .= $clave.",";																			// Añado el nombre del campo al string
						$datos .= "'".$valor."',";																	// Añado el dato al string, rodeado de comillas
					}
					$campos = substr($campos, 0, -1);															// Le quito la última coma al string de campos
					$datos = substr($datos, 0, -1);																// Le quito la última coma al string de datos
					$query = "																											
						INSERT INTO ".$tabla." 
						(".$campos.") 
						VALUES (".$datos.");
						";																													// 
					$result = mysqli_query($this->conexion , $query);							// Ejecuto la petición
					return 0;																											// Retorno 0 para indicar éxito
			}
			
			public function actualizaTabla($tabla,$valores,$id){								// Método para actualizar registros de una tabla
					$query = "																											
						UPDATE ".$tabla." 
						SET
						";																													// 
					foreach($valores as $clave=>$valor){													// Para cada uno de los datos a actualizar
						$query .= $clave."='".$valor."', ";													// Encadeno clave-valor con una coma
					}
					$query = substr($query, 0, -2);																// Le quito los dos últimos caracteres (coma y espacio)
						$query .= "																										
						WHERE Identificador = ".$id."
						";																													// 
					echo $query;																										// Muestro la consulta generada
					$result = mysqli_query($this->conexion , $query);							// Ejecuto la petición
					return "";																											// Retorno un string vacío
			}
			public function eliminaTabla($tabla,$id){															// Método para eliminar un registro de una tabla
				$query = "																												
						DELETE FROM ".$tabla." 
						WHERE Identificador = ".$id.";
						";	
				$result = mysqli_query($this->conexion , $query);							// Ejecuto la petición de eliminación
			}
			
			private function codifica($entrada){																// Método privado para codificar una cadena en base64
				return base64_encode($entrada);																// Retorno la cadena codificada
			}
			
			private function decodifica($entrada){															// Método privado para decodificar una cadena en base64
				return base64_decode($entrada);																// Retorno la cadena decodificada
			}
	}

?>

