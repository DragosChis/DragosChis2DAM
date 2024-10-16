<?php

	class conexionDB{																													// Creo una nueva clase
		
			private $servidor;																										// propiedad privada para el servidor
			private $usuario;																											// propiedad privada para el usuario
			private $contrasena;																									// propiedad privada para la contraseña
			private $basededatos;																									// propiedad privada para la base de datos
			private $conexion;																										// propiedad privada para la conexión
			
			public function __construct() {																				// Creo un constructor
        $this->servidor = "localhost";																			// Le doy los datos de acceso a la base de datos
        $this->usuario = "crimson";																		// Asigno el nombre de usuario
        $this->contrasena = "crimson";																	// Asigno la contraseña
        $this->basededatos = "crimson";																// Asigno la base de datos
        
        $this->conexion = mysqli_connect(																	// Establezco una conexión a la base de datos
					$this->servidor, 
					$this->usuario, 
					$this->contrasena, 
					$this->basededatos
				);																															// 
    }
			public function seleccionaTabla($tabla){													// Creo un método para seleccionar datos de una tabla
				$query = "SELECT 
											*
									FROM 
											information_schema.key_column_usage
									WHERE 
											table_name = '".$tabla."'
											AND
											REFERENCED_TABLE_NAME IS NOT NULL
											;";											// Consulta SQL para ver qué campos tienen restricciones
				
				$result = mysqli_query($this->conexion , $query);								// Ejecuto la consulta contra la base de datos	
				$restricciones = [];																						// Creo un array vacío para guardar las restricciones
				while ($row = mysqli_fetch_assoc($result)) {										// Recupero los datos del servidor
					$restricciones[] = $row;																			// Agrego cada restricción al array
				}
				
				//var_dump($restricciones);																				// Las debugeo en pantalla (comentado)
				
				$query = "SELECT * FROM ".$tabla.";";														// Creo la petición dinámica para seleccionar todos los registros
				$result = mysqli_query($this->conexion , $query);								// Ejecuto la petición
				$resultado = [];																								// Creo un array vacío para almacenar los resultados
				while ($row = mysqli_fetch_assoc($result)) {										// Para cada uno de los registros
						//$resultado[] = $row;																			// Los añadiría al array (comentado)
						$fila = [];																									// Creo un array para cada fila de datos
						foreach($row as $clave=>$valor){														// Para cada una de las columnas del registro
							$pasas = true;																						// Inicializo la variable para el control de restricciones
							foreach($restricciones as $restriccion){									// Itero sobre cada restricción
								if($clave == $restriccion["COLUMN_NAME"]){							// Verifico si la columna tiene restricciones
									$fila[$clave] = "datos externos";											// Reemplazo el valor por un string indicativo
									$pasas = false;																				// Cambio el estado a falso
								}
							}
						if($pasas == true){																					// Si no hay restricciones
							$fila[$clave] = $valor;																		// Guardamos el valor real de la tabla
						}
						}
						$resultado[] = $fila;																			// Agrego la fila procesada al resultado
				}
				$json = json_encode($resultado, JSON_PRETTY_PRINT);							// Lo codifico como JSON con formato legible
				return $json;																										// Devuelvo el JSON generado
			}
			
			public function listadoTablas(){																			// Método para listar todas las tablas de la base de datos
				$query = "SHOW TABLES;";																				// Creo la petición para mostrar todas las tablas
				$result = mysqli_query($this->conexion , $query);								// Ejecuto la petición
				$resultado = [];																								// Creo un array vacío para almacenar los resultados
				while ($row = mysqli_fetch_assoc($result)) {										// Para cada uno de los registros
						//$resultado[] = $row;																			// Los añadiría al array (comentado)
						$fila = [];																								// Array para almacenar los valores de la fila
						foreach($row as $clave=>$valor){															// Itero sobre cada clave y valor del registro
							$fila[$clave] = $valor;																		// Asigno el valor al array de la fila
						}
						$resultado[] = $fila;																				// Agrego la fila procesada al resultado
				}
				$json = json_encode($resultado, JSON_PRETTY_PRINT);							// Lo codifico como JSON con formato legible
				return $json;																										// Devuelvo el JSON generado
			}
			
			public function insertaTabla($tabla,$valores){										// Método para insertar nuevos registros en una tabla
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
						";																													// Preparo la consulta de inserción
					$result = mysqli_query($this->conexion , $query);							// Ejecuto la petición
					return 0;																											// Retorno 0 para indicar éxito
			}
			
			public function actualizaTabla($tabla,$valores,$id){								// Método para actualizar registros de una tabla
					$query = "
						UPDATE ".$tabla." 
						SET
						";																													// Inicio la consulta de actualización
					foreach($valores as $clave=>$valor){													// Para cada uno de los datos a actualizar
						$query .= $clave."='".$valor."', ";													// Encadeno clave-valor con una coma
					}
					$query = substr($query, 0, -2);																// Le quito los dos últimos caracteres (coma y espacio)
						$query .= "
						WHERE Identificador = ".$id."
						";																													// Agrego la cláusula WHERE para identificar el registro
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

