
import json  # Importamos la librería json para trabajar con archivos JSON
# import xml  # Esta línea no se utiliza en el código, se puede eliminar

# Abrimos el archivo 'cliente.json' en modo de lectura ('r')
with open('cliente.json', 'r') as archivo:
    # Cargamos los datos del archivo JSON en la variable 'datos'
    datos = json.load(archivo)

# Imprimimos los datos cargados
print(datos)


