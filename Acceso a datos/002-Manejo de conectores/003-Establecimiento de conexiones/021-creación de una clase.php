<?php
class conexionDB{ // Definimos la clase 'conexionDB'
    
    public $servidor; // Propiedad para el servidor
    public $usuario; // Propiedad para el usuario
    public $contrasena; // Propiedad para la contraseña
    public $basededatos; // Propiedad para la base de datos
    
    public function __construct() { // Constructor de la clase
        $this->servidor = "localhost"; // Inicializamos el servidor
        $this->usuario = "accesoadatos"; // Inicializamos el usuario
        $this->contrasena = "accesoadatos"; // Inicializamos la contraseña
        $this->basededatos = "accesoadatos"; // Inicializamos la base de datos
        
        $mysqli = mysqli_connect( // Establecemos la conexión a la base de datos
            $this->servidor, 
            $this->usuario, 
            $this->contrasena, 
            $this->basededatos
        );
    }
    
    public function seleccionaTabla($tabla){ // Método para seleccionar registros de una tabla
        $query = "SELECT * FROM ".$tabla.";"; // Creamos la consulta SQL
        $result = mysqli_query($mysqli, $query); // Ejecutamos la consulta SQL
        $resultado = []; // Inicializamos un array vacío para almacenar los resultados
        
        while ($row = mysqli_fetch_assoc($result)) { // Iteramos sobre cada fila del resultado
            $resultado[] = $row; // Agregamos cada fila al array de resultados
        }
        
        $json = json_encode($resultado, JSON_PRETTY_PRINT); // Convertimos el array de resultados a formato JSON con indentación
        return $json; // Devolvemos el JSON generado
    }
}
?>
