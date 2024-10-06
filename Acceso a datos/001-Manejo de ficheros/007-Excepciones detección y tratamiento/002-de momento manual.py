class Cliente:
    def __init__(self):  # Constructor de la clase Cliente
        self.nombre = None  # Inicializa la propiedad nombre como None
        self.apellidos = None  # Inicializa la propiedad apellidos como None
        self.emails = {"personal": [], "profesional": []}  # Inicializa un diccionario para almacenar listas de emails

class Producto:
    def __init__(self):  # Constructor de la clase Producto
        self.nombre = None  # Inicializa la propiedad nombre como None
        self.precio = None  # Inicializa la propiedad precio como None
        self.peso = None  # Inicializa la propiedad peso como None
        self.dimensiones = {"x": None, "y": None, "z": None}  # Inicializa un diccionario para almacenar dimensiones

clientes = []  # Inicializa una lista vacía para almacenar instancias de la clase Cliente
clientes.append(Cliente())  # Crea una nueva instancia de Cliente y la añade a la lista

# Asigna valores a las propiedades del último cliente en la lista
clientes[-1].nombre = "Dragos"  # Establece el nombre del cliente
clientes[-1].apellidos = "Chis"  # Establece los apellidos del cliente
clientes[-1].emails['profesional'].append("dragos@gmail.com")  # Añade un email profesional a la lista
clientes[-1].emails['profesional'].append("info@dragos@email.com")  # Añade otro email profesional a la lista
clientes[-1].emails['personal'].append("dragoschis@gmail.com")  # Añade un email personal a la lista

# Imprime la lista de emails del último cliente en la lista
print(clientes[-1].emails)  # Muestra por pantalla los emails del cliente

        


