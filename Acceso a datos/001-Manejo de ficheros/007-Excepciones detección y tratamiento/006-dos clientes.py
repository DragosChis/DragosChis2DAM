import json  # Importamos la librería json para trabajar con archivos JSON

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

clientes = []  # Inicializa una lista vacía para almacenar instancias de Cliente
clientes.append(Cliente())  # Crea una nueva instancia de Cliente y la añade a la lista
clientes[-1].idcliente = "00001"  # Asigna un ID al primer cliente
clientes[-1].nombre = "Dragos"  # Establece el nombre del primer cliente
clientes[-1].apellidos = "Chis"  # Establece los apellidos del primer cliente
clientes[-1].emails['profesional'].append("dragos@gmail.com")  # Añade un email profesional al primer cliente
clientes[-1].emails['profesional'].append("info@dragos@email.com")  # Añade otro email profesional al primer cliente
clientes[-1].emails['personal'].append("dragoschis@gmail.com")  # Añade un email personal al primer cliente

clientes.append(Cliente())  # Crea otra instancia de Cliente y la añade a la lista
clientes[-1].idcliente = "00002"  # Asigna un ID al segundo cliente
clientes[-1].nombre = "Paco"  # Establece el nombre del segundo cliente
clientes[-1].apellidos = "Lopez"  # Establece los apellidos del segundo cliente
clientes[-1].emails['profesional'].append("paco@correo.com")  # Añade un email profesional al segundo cliente
clientes[-1].emails['profesional'].append("paco@email.com")  # Añade otro email profesional al segundo cliente
clientes[-1].emails['personal'].append("paco@gmail.com")  # Añade un email personal al segundo cliente

for cliente in clientes:  # Recorre la lista de clientes
    archivo = open(cliente.idcliente + ".json", 'w')  # Abre un archivo JSON con el ID del cliente como nombre
    json.dump(cliente.to_dict(), archivo, indent=4)  # Escribe el diccionario del cliente en el archivo en formato JSON con sangrías
    archivo.close()  # Cierra el archivo para asegurarse de que se guarde correctamente



        


