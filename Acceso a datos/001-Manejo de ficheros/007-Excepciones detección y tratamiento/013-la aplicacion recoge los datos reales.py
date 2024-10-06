# Importamos las librerías necesarias
import json  # Importamos json como librería para automatizar cosas como el guardado
import os  # Me permite realizar operaciones con el sistema de archivos del OS
import errno  # Gestiona y captura los diferentes tipos de error para poder operar sobre cada uno de ellos
import tkinter as tk  # Importamos la librería tkinter para crear la interfaz gráfica

# Definimos una clase Cliente con atributos idcliente, nombre, apellidos y emails
class Cliente:
    def __init__(self,
                 idcliente,
                 nuevonombre,
                 nuevosapellidos,
                 listapersonal,
                 listaprofesional
                 ):
        # Inicializamos los atributos del cliente
        self.idcliente = idcliente
        self.nombre = nuevonombre
        self.apellidos = nuevosapellidos
        self.emails = {
            "personal": listapersonal,
            "profesional": listaprofesional
        }

    # Método para convertir el objeto Cliente a un diccionario
    def to_dict(self):
        return {
            "nombre": self.nombre,
            "apellidos": self.apellidos,
            "emails": self.emails
        }

# Establecemos la carpeta para guardar la base de datos
carpeta = "basededatos"

# Variable para controlar si se puede continuar con la ejecución
continuas = True

# Lista para almacenar los clientes
clientes = []

# Intentamos crear la carpeta para la base de datos
try:
    os.makedirs(carpeta)
except OSError as e:
    # Si la carpeta ya existe, no hacemos nada
    if e.errno == errno.EEXIST:
        print(f"La carpeta ya existe.")
    # Si no tenemos permisos para crear la carpeta, no continuamos
    elif e.errno == errno.EACCES:
        continuas = False
        print("Error de permisos en la carpeta - no puedo guardar")
    # Si ocurre otro error, lo mostramos
    else:
        print(f"Unexpected error: {e}")

# Definimos la función para guardar un cliente
def guardaCliente():
    global clientes
    # Creamos un nuevo cliente con los datos ingresados en la interfaz gráfica
    clientes.append(
        Cliente(
            idcliente.get(),
            nombre.get(),
            apellidos.get(),
            personal.get(),
            profesional.get()
        )
    )

# Definimos la función para guardar la base de datos
def guardaDB():
    # Recorremos la lista de clientes y guardamos cada uno en un archivo JSON
    for cliente in clientes:
        archivo = open(carpeta + "/" + cliente.idcliente + ".json", 'w')
        json.dump(cliente.to_dict(), archivo, indent=4)
        archivo.close()

# Creamos la ventana principal de la aplicación
ventana = tk.Tk()

# Creamos un marco dentro de la ventana
marco = tk.Frame(ventana, padx=20, pady=20)
marco.pack(padx=20, pady=20)

# Creamos variables para almacenar los valores ingresados en la interfaz gráfica
nombre = tk.StringVar()
apellidos = tk.StringVar()
idcliente = tk.StringVar()
personal = tk.StringVar()
profesional = tk.StringVar()

# Creamos los campos para ingresar la información del cliente
tk.Label(marco, text="Id de cliente").pack(padx=10, pady=10)
tk.Entry(marco, textvariable=idcliente).pack(padx=10, pady=10)
tk.Label(marco, text="Nombre").pack(padx=10, pady=10)
tk.Entry(marco, textvariable=nombre).pack(padx=10, pady=10)
tk.Label(marco, text="Apellidos").pack(padx=10, pady=10)
tk.Entry(marco, textvariable=apellidos).pack(padx=10, pady=10)
tk.Label(marco, text="Email personal").pack(padx=10, pady=10)
tk.Entry(marco, textvariable=personal).pack(padx=10, pady=10)
tk.Label(marco, text="Email profesional").pack(padx=10, pady=10)
tk.Entry(marco, textvariable=profesional).pack(padx=10, pady=10)

# Creamos los botones para guardar el cliente y la base de datos
tk.Button(marco, text="Guardamos este cliente", command=guardaCliente).pack(padx=10, pady=10)
tk.Button(marco, text="Guardamos todos los clientes a base de datos", command=guarda)


        


