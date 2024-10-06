import json  # Importamos la librería json para trabajar con archivos JSON
import os  # Importamos la librería os para trabajar con el sistema operativo (por ejemplo, manejar directorios)

class Cliente:  # Definimos la clase Cliente
    def __init__(self):  # Método constructor para inicializar las propiedades del cliente
        self.idcliente = None  # Inicializa el ID del cliente como None
        self.nombre = None  # Inicializa el nombre del cliente como None
        self.apellidos = None  # Inicializa los apellidos del cliente como None
        self.emails = {"personal": [], "profesional": []}  # Inicializa un diccionario para almacenar listas de emails

    def to_dict(self):  # Método que convierte la instancia de Cliente en un diccionario
        return {
            "nombre": self.nombre,  # Agrega el nombre al diccionario
            "apellidos": self.apellidos,  # Agrega los apellidos al diccionario
            "emails": self.emails  # Agrega los emails al diccionario
        }

class Producto:  # Definimos la clase Producto
    def __init__(self):  # Método constructor para inicializar las propiedades del producto
        self.nombre = None  # Inicializa el nombre del producto como None
        self.precio = None  # Inicializa el precio del producto como None
        self.peso = None  # Inicializa el peso del producto como None
        self.dimensiones = {"x": None, "y": None, "z": None}  # Inicializa un diccionario para las dimensiones del producto

carpeta = "basededatos"  # Define el nombre de la carpeta donde se guardarán los archivos JSON

os.makedirs(carpeta, exist_ok=True)  # Crea la carpeta si no existe, evitando un error si ya existe

clientes = []  # Inicializa una lista vacía para almacenar instancias de Cliente
clientes.append(Cliente())  # Crea una nueva instancia de Cliente y la añade a la lista
clientes[-1].idcliente = "00001"  
clientes[-1].nombre = "Dragos"  
clientes[-1].apellidos = "Chis"  
clientes[-1].emails['profesional'].append("dragos@gmail.com")  
clientes[-1].emails['profesional'].append("info@dragos@email.com")  
clientes[-1].emails['personal'].append("dragoschis@gmail.com")  

clientes.append(Cliente())  
clientes[-1].idcliente = "00002"  
clientes[-1].nombre = "Paco"  
clientes[-1].apellidos = "Lopez"  
clientes[-1].emails['profesional'].append("paco@correo.com")  
clientes[-1].emails['profesional'].append("paco@email.com")  
clientes[-1].emails['personal'].append("paco@gmail.com")  

for cliente in clientes:  # Recorre la lista de clientes
    archivo = open(os.path.join(carpeta, cliente.idcliente + ".json"), 'w')  # Abre un archivo JSON en la carpeta con el ID del cliente como nombre
    json.dump(cliente.to_dict(), archivo, indent=4)  # Escribe el diccionario del cliente en el archivo en formato JSON con sangrías
    archivo.close()  # Cierra el archivo para asegurarse de que se guarde correctamente



        


