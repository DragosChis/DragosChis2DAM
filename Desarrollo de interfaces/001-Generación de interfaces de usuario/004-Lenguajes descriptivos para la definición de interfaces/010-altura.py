import tkinter as tk  #Importamos la biblioteca tkinter para crear interfaces
from tkinter import filedialog  #Importamos el módulo filedialog para seleccionar archivos

ventana = tk.Tk()  #Creamos una ventana principal

marco = tk.Frame(ventana)  #Creamos un marco dentro de la ventana principal
marco.pack(padx=10, pady=10)  #Configuramos el marco con un padding 

anchura = tk.IntVar()  #Creamos una variable de tipo entero para almacenar la anchura de salida
altura = tk.IntVar()  #Creamos una variable de tipo entero para almacenar la altura de salida

salida = None  #Variable para almacenar la ruta de salida
entrada = None  #Variable para almacenar la ruta de entrada

def procesar():  #Definimos una función para procesar la información
    print("Vamos a por ello")  #Imprimimos un mensaje de inicio
    #Aquí puedes agregar el código para procesar la información

def seleccionaEntrada():  #Definimos una función para seleccionar un archivo de video de entrada
    global entrada  #Accedemos a la variable global entrada
    entrada = filedialog.askopenfilename()  #Seleccionamos un archivo utilizando el diálogo askopenfilename()

def seleccionaSalida():  #Definimos una función para seleccionar un archivo de video de salida
    global salida  #Accedemos a la variable global salida
    salida = filedialog.asksaveasfilename()  #Seleccionamos un archivo utilizando el diálogo asksaveasfilename()

selector_video_entrada = tk.Button(  #Creamos un botón para seleccionar un archivo de video de entrada
    marco,  #El botón se crea dentro del marco
    text="Selecciona el video de entrada",  #Texto del botón
    command=seleccionaEntrada  #La función que se llama cuando se presiona el botón
)
selector_video_entrada.pack(padx=50, pady=20)  #Configuramos el botón con un padding

tk.Label(  #Creamos un label para pedir la anchura de salida deseada
    marco,  #El label se crea dentro del marco
    text="Indica la anchura de salida que quieres"  #Texto del label
).pack(padx=50, pady=20)  #Configuramos el label con un padding 

tk.Entry(  #Creamos un campo de texto para la anchura de salida
    marco,  #El campo de texto se crea dentro del marco
    textvariable=anchura  #Asignamos la variable de tipo entero a la anchura de salida
).pack(padx=50, pady=20)  #Configuramos el campo de texto con un padding 

tk.Label(  #Creamos un label para pedir la altura de salida deseada
    marco,  #El label se crea dentro del marco
    text="Indica la altura de salida que quieres"  #Texto del label
).pack(padx=50, pady=20)  #Configuramos el label con un padding 

tk.Entry(  #Creamos un campo de texto para la altura de salida
    marco,  #El campo de texto se crea dentro del marco
    textvariable=altura  #Asignamos la variable de tipo entero a la altura de salida
).pack(padx=50, pady=20)  #Configuramos el campo de texto con un padding

selector_video_salida = tk.Button(  #Creamos un botón para seleccionar un archivo de video de salida
    marco,  #El botón se crea dentro del marco
    text="Selecciona el video de salida",  #Texto del botón
    command=seleccionaSalida  #La función que se llama cuando se presiona el botón
)
selector_video_salida.pack(padx=50, pady=20)  #Configuramos el botón con un padding

tk.Button(marco, text="Comenzamos", command=procesar).pack(padx=50, pady=20)  #Creamos un botón para comenzar el proceso

ventana.mainloop()  #Iniciamos el bucle principal de la aplicación
