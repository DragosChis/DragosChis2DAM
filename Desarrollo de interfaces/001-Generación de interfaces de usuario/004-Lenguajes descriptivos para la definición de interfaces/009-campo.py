import tkinter as tk  #Importamos la biblioteca tkinter para crear interfaces
from tkinter import filedialog  #Importamos el módulo filedialog para seleccionar archivos

ventana = tk.Tk()  #Creamos una ventana principal

marco = tk.Frame(ventana)  #Creamos un marco dentro de la ventana principal
marco.pack(padx=10, pady=10)  #Configuramos el marco añadiendo padding

anchura = tk.IntVar()  #Creamos una variable de tipo entero para almacenar la anchura de salida

def seleccionaEntrada():  #Definimos una función para seleccionar un archivo de video de entrada
    ruta = filedialog.askopenfilename()  #Seleccionamos un archivo utilizando el diálogo askopenfilename()
    print("La ruta de tu video es:", ruta)  #Imprimimos la ruta del archivo seleccionado

selector_video_entrada = tk.Button(  #Creamos un botón para seleccionar un archivo de video de entrada
    marco,  #El botón se crea dentro del marco
    text="Selecciona el video de entrada",  #Texto del botón
    command=seleccionaEntrada  #La función que se llama cuando se presiona el botón
)
selector_video_entrada.pack(padx=50, pady=20)  #Configuramos el botón añadiendo padding

tk.Label(  #Creamos un label para pedir la anchura de salida deseada
    marco,  #El label se crea dentro del marco
    text="Indica la anchura de salida que quieres"  # Texto del label
).pack(padx=50, pady=20)  #Configuramos el label con un padding de 50 píxeles

tk.Entry(  #Creamos un campo de texto para la anchura de salida
    marco,  #El campo de texto se crea dentro del marco
    textvariable=anchura  #Asignamos la variable de tipo entero a la anchura de salida
).pack(padx=50, pady=20)  #Configuramos el campo de texto añadiendo padding

ventana.mainloop()  #Iniciamos el bucle principal de la aplicación
