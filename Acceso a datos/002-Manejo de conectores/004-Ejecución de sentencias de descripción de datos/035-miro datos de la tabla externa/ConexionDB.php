<?php

	class conexionDB{																													// Creo una nueva clase
		
			private $servidor;																										// creo una serie de propiedades privadas
			private $usuario;																											// Nombre de usuario para la base de datos
			private $contrasena;																									// Contraseña para la base de datos
			private $basededatos;																									// Nombre de la base de datos
			private $conexion;																										// Variable para almacenar la conexión a la base de datos
			
			public function __construct() {																				// Creo un constructor
        $this->servidor = "localhost";																			// Le doy los datos de acceso a la base de datos
        $this->usuario = "crimson";																		// Usuario de la base de datos
        $this->contrasena = "crimson";																	// Contraseña del usuario
        $this->basededatos = "crimson";																// Base de datos a utilizar
        
        $this->conexion = mysqli_connect(												// Establezco una conexión con la base de datos
					$this->servidor, 
					$this->usuario, 
					$this->contrasena, 
					$this->basededatos
				);																															// 
    }
			public function seleccionaTabla($tabla){													// Creo un metodo de seleccion
				$query = "SELECT 
											*
									FROM 
											information_schema.key_column_usage
									WHERE 
											table_name = '".$tabla."'
											AND
											REFERENCED_TABLE_NAME IS NOT NULL
											;";											// Formateo una consulta SQL para ver qué campos tienen restricciones
				
				$result = mysqli_query($this->conexion , $query);								// Ejecuto la consulta contra la base de datos	
				$restricciones = [];																						// Creo un array vacio para guardar las restricciones
				while ($row = mysqli_fetch_assoc($result)) {										// Recupero los datos del servidor
					$restricciones[] = $row;																			// Hago un push encubierto a las restricciones
				}
				
				//var_dump($restricciones);																				// Las debugeo en pantalla
				
				$query = "SELECT * FROM ".$tabla.";";														// Creo la petición dinámica
				$result = mysqli_query($this->conexion , $query);								// Ejecuto la peticion
				$resultado = [];																								// Creo un array vacio
				while ($row = mysqli_fetch_assoc($result)) {										// Para cada uno de los registros
						//$resultado[] = $row;																			// Los añado al array
						$fila = [];																									// Creo el conjunto de datos para cada fila
						foreach($row as $clave=>$valor){														// Para cada una de las columnas
							$pasas = true;																						// En principio asumimos que no hay restricción
							foreach($restricciones as $restriccion){									// Para cada una de las restricciones
								if($clave == $restriccion["COLUMN_NAME"]){							// En el caso de que se detecte que esta columna forma parte de las restricciones
									
									$query2 = "
										SELECT * 
										FROM ".$restriccion["REFERENCED_TABLE_NAME"]."
									;";		// Formulo una consulta para obtener datos de la tabla referenciada
									$result2 = mysqli_query($this->conexion , $query2);	// Ejecuto la consulta de referencia
									$cadena = "";					// Inicializo una cadena para almacenar los datos concatenados
									while ($row2 = mysqli_fetch_assoc($result2)) {	// Recorro los resultados de la consulta de referencia
										foreach($row2 as $campo){					// Para cada campo de la fila
											$cadena .= $campo."-";			// Concateno el valor a la cadena
										}
									}
									
									$fila[$clave] = $cadena;															// En la celda devolvemos la cadena concatenada
									$pasas = false;																				// Cambiamos el estado de la variable a falso
								}
							}
						if($pasas == true){																					// En el caso de que la variable siga siendo verdadera
							$fila[$clave] = $valor;																		// En ese caso el valor de la variable es el valor real de la tabla
						}
						}
						$resultado[] = $fila;		// Agrego la fila procesada al resultado
				}
				$json = json_encode($resultado, JSON_PRETTY_PRINT);							// Lo codifico como json
				return $json;																										// Devuelvo el json
			}
			
			public function listadoTablas(){						// Método para listar todas las tablas en la base de datos
				$query = "SHOW TABLES;";																				// Creo la petición dinámica
				$result = mysqli_query($this->conexion , $query);								// Ejecuto la peticion
				$resultado = [];																								// Creo un array vacio
				while ($row = mysqli_fetch_assoc($result)) {										// Para cada uno de los registros
						//$resultado[] = $row;																			// Los añado al array
						$fila = [];	// Inicializo un array para almacenar los datos de la fila
						foreach($row as $clave=>$valor){			// Recorro los campos de la fila
							$fila[$clave] = $valor;	// Almaceno cada campo en el array
						}
						$resultado[] = $fila;	// Agrego la fila procesada al resultado
				}
				$json = json_encode($resultado, JSON_PRETTY_PRINT);							// Lo codifico como json
				return $json;																										// Devuelvo el json
			}
			
			public function insertaTabla($tabla,$valores){										// Método de inserción de nuevos registros
					$campos = "";																									// Creo un string para guardar los campos
					$datos = ""; 																									// Creo un string para guardar los datos
					foreach($valores as $clave=>$valor){													// Para cada uno de los datos
						$campos .= $clave.",";																			// Añado el nombre del campo al string
						$datos .= "'".$valor."',";																	// Añado del dato al string
					}
					$campos = substr($campos, 0, -1);															// Le quito la ultima coma al string
					$datos = substr($datos, 0, -1);																// Le quito la ultima coma al string
					$query = "
						INSERT INTO ".$tabla." 
						(".$campos.") 
						VALUES (".$datos.");
						";																													// preparo la petición de inserción
					$result = mysqli_query($this->conexion , $query);							// Ejecuto la peticion
					return 0;																											// Retorno 0 para indicar que la operación se completó
			}
			
			public function actualizaTabla($tabla,$valores,$id){	// Método para actualizar registros existentes
					$query = "
						UPDATE ".$tabla." 
						SET
						";																													// Empiezo a formatear la query de actualización
					foreach($valores as $clave=>$valor){													// Para cada uno de los datos
						$query .= $clave."='".$valor."', ";													// Encadeno con la query
					}
					$query = substr($query, 0, -2);																// Le quito los dos ultimos caracteres
						$query .= "
						WHERE Identificador = ".$id."
						";																													// Especifico el identificador del registro a actualizar
					echo $query;	// Muestro la consulta generada para depuración
					$result = mysqli_query($this->conexion , $query);							// Ejecuto la peticion
					return "";							
			}
			public function eliminaTabla($tabla,$id){	// Método para eliminar un registro de una tabla
				$query = "
						DELETE FROM ".$tabla." 
						WHERE Identificador = ".$id.";
						";	// Formulo la consulta para eliminar el registro
				$result = mysqli_query($this->conexion , $query);							// Ejecuto la peticion
			}
			
			private function codifica($entrada){	// Método privado para codificar datos
				return base64_encode($entrada);	// Codifica la entrada en base64
			}
			
			private function decodifica($entrada){	// Método privado para decodificar datos
				return base64_decode($entrada);	// Decodifica la entrada de base64
			}
	}

?>

