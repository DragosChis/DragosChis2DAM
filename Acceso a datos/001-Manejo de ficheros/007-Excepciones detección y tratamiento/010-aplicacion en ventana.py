# Importamos las librerías necesarias
import json
import os
import errno
import tkinter as tk

# Definimos una clase Cliente con atributos idcliente, nombre, apellidos y emails
class Cliente:
    def __init__(self):
        self.idcliente = None
        self.nombre = None
        self.apellidos = None
        self.emails = {"personal":[],"profesional":[]}  # Emails personal y profesional

    # Método para convertir el objeto Cliente a un diccionario
    def to_dict(self):
        return {
            "nombre": self.nombre,
            "apellidos": self.apellidos,
            "emails": self.emails
        }

# Definimos una clase Producto con atributos nombre, precio, peso y dimensiones
class Producto:
    def __init__(self):
        self.nombre = None
        self.precio = None
        self.peso = None
        self.dimensiones = {"x":None,"y":None,"z":None}  # Dimensiones x, y, z

# Establecemos la carpeta para guardar la base de datos
carpeta = "basededatos"

# Variable para controlar si se puede continuar con la ejecución
continuas = True

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

# Creamos la ventana principal de la aplicación
ventana = tk.Tk()

# Creamos un marco dentro de la ventana
marco = tk.Frame(ventana,padx=20,pady=20)
marco.pack(padx=20,pady=20)

# Creamos los campos para ingresar la información del cliente
tk.Label(marco,text="Id de cliente").pack(padx=10,pady=10)  # Etiqueta para el id de cliente
tk.Entry(marco).pack(padx=10,pady=10)  # Campo para ingresar el id de cliente
tk.Label(marco,text="Nombre").pack(padx=10,pady=10)  # Etiqueta para el nombre
tk.Entry(marco).pack(padx=10,pady=10)  # Campo para ingresar el nombre
tk.Label(marco,text="Apellidos").pack(padx=10,pady=10)  # Etiqueta para los apellidos
tk.Entry(marco).pack(padx=10,pady=10)  # Campo para ingresar los apellidos
tk.Label(marco,text="Email personal").pack(padx=10,pady=10)  # Etiqueta para el email personal
tk.Entry(marco).pack(padx=10,pady=10)  # Campo para ingresar el email personal
tk.Label(marco,text="Email profesional").pack(padx=10,pady=10)  # Etiqueta para el email profesional
tk.Entry(marco).pack(padx=10,pady=10)  # Campo para ingresar el email profesional

# Creamos los botones para guardar el cliente y la base de datos
tk.Button(marco,text="Guardamos este cliente",command=guardaCliente).pack(padx=10,pady=10)  # Botón para guardar el cliente
tk.Button(marco,text="Guardamos todos los clientes a base de datos",command=guardaDB).pack(padx=10,pady=10)  # Botón para guardar la base de datos

# Iniciamos la ventana principal
ventana.mainloop()

##for cliente in clientes:
##    archivo = open(carpeta+"/"+cliente.idcliente+".json",'w')
##    json.dump(cliente.to_dict(),archivo,indent=4)
##    archivo.close()


        


