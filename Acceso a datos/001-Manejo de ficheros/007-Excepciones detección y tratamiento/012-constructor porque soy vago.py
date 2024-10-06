import json  # Importamos la librería json para manejar datos en formato JSON
import os  # Importamos la librería os para manejar archivos y directorios
import errno  # Importamos errno para manejar códigos de error del sistema operativo
import tkinter as tk  # Importamos la librería tkinter para crear la interfaz gráfica

class Cliente:  # Definimos la clase Cliente
    def __init__(self, idcliente, nuevonombre, nuevosapellidos, listapersonal, listaprofesional):
        self.idcliente = idcliente  # Asignamos el ID del cliente
        self.nombre = nuevonombre  # Asignamos el nombre del cliente
        self.apellidos = nuevosapellidos  # Asignamos los apellidos del cliente
        self.emails = {"personal": listapersonal, "profesional": listaprofesional}  # Inicializamos el diccionario de emails

    def to_dict(self):  # Método que convierte la instancia de Cliente en un diccionario
        return {
            "nombre": self.nombre,  # Agrega el nombre al diccionario
            "apellidos": self.apellidos,  # Agrega los apellidos al diccionario
            "emails": self.emails  # Agrega los emails al diccionario
        }

class Producto:  # Definimos la clase Producto
    def __init__(self):
        self.nombre = None  # Inicializa el nombre del producto como None
        self.precio = None  # Inicializa el precio del producto como None
        self.peso = None  # Inicializa el peso del producto como None
        self.dimensiones = {"x": None, "y": None, "z": None}  # Inicializa un diccionario para las dimensiones del producto

carpeta = "basededatos"  # Nombre de la carpeta donde se guardarán los archivos JSON
continuas = True  # Variable para controlar la creación de la carpeta
clientes = []  # Lista para almacenar instancias de Cliente

# Intentamos crear la carpeta
try:
    os.makedirs(carpeta)  # Crea la carpeta si no existe
except OSError as e:  # Captura errores
    if e.errno == errno.EEXIST:  # Si la carpeta ya existe
        print(f"La carpeta ya existe.")  # Informa que la carpeta ya existe
    elif e.errno == errno.EACCES:  # Si hay un error de permisos
        continuas = False  # Cambia la variable a False para indicar que no se puede continuar
        print("Error de permisos en la carpeta - no puedo guardar")  # Informa sobre el error de permisos
    else:  # Maneja cualquier otro error
        print(f"Unexpected error: {e}")  # Informa de un error inesperado

# Función para guardar un nuevo cliente
def guardaCliente():
    global clientes  # Usamos la lista de clientes global
    clientes.append(Cliente("00003", "Francisco", "Perez", "info@francisco.com", "fran@gmail.com"))  # Agregamos un nuevo cliente a la lista

# Función para guardar todos los clientes en la base de datos
def guardaDB():
    for cliente in clientes:  # Recorremos la lista de clientes
        archivo = open(carpeta + "/" + cliente.idcliente + ".json", 'w')  # Abrimos un archivo JSON para cada cliente
        json.dump(cliente.to_dict(), archivo, indent=4)  # Guardamos el diccionario del cliente en formato JSON
        archivo.close()  # Cerramos el archivo para asegurarnos de que se guarde correctamente

# Crear la ventana principal de la aplicación
ventana = tk.Tk()  # Inicializa la ventana principal
marco = tk.Frame(ventana, padx=20, pady=20)  # Crea un marco para contener los elementos
marco.pack(padx=20, pady=20)  # Empaqueta el marco en la ventana

# Creando las etiquetas y entradas para obtener los datos del cliente
tk.Label(marco, text="Id de cliente").pack(padx=10, pady=10)  # Etiqueta para ID de cliente
entry_id = tk.Entry(marco)  # Entrada para ID de cliente
entry_id.pack(padx=10, pady=10)  # Empaqueta la entrada

tk.Label(marco, text="Nombre").pack(padx=10, pady=10)  # Etiqueta para Nombre
entry_nombre = tk.Entry(marco)  # Entrada para Nombre
entry_nombre.pack(padx=10, pady=10)  # Empaqueta la entrada

tk.Label(marco, text="Apellidos").pack(padx=10, pady=10)  # Etiqueta para Apellidos
entry_apellidos = tk.Entry(marco)  # Entrada para Apellidos
entry_apellidos.pack(padx=10, pady=10)  # Empaqueta la entrada

tk.Label(marco, text="Email personal").pack(padx=10, pady=10)  # Etiqueta para Email personal
entry_email_personal = tk.Entry(marco)  # Entrada para Email personal
entry_email_personal.pack(padx=10, pady=10)  # Empaqueta la entrada

tk.Label(marco, text="Email profesional").pack(padx=10, pady=10)  # Etiqueta para Email profesional
entry_email_profesional = tk.Entry(marco)  # Entrada para Email profesional
entry_email_profesional.pack(padx=10, pady=10)  # Empaqueta la entrada

# Botones para guardar cliente y guardar base de datos
tk.Button(marco, text="Guardamos este cliente", command=guardaCliente).pack(padx=10, pady=10)  # Botón para guardar un cliente
tk.Button(marco, text="Guardamos todos los clientes a base de datos", command=guardaDB).pack(padx=10, pady=10)  # Botón para guardar todos los clientes

ventana.mainloop()  # Inicia el bucle principal de la interfaz gráfica




        


