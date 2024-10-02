import tkinter as tk  # Importamos la biblioteca tkinter para crear interfaces
from tkinter import filedialog  #Importamos el módulo filedialog para seleccionar archivos

ventana = tk.Tk()  #Creamos una ventana principal

marco = tk.Frame(ventana)  #Creamos un marco dentro de la ventana principal
marco.pack(padx=10, pady=10)  #Añadimos un padding al marco

def seleccionaEntrada():  #Definimos una función para seleccionar un archivo de video de entrada
    ruta = filedialog.askopenfilename()  #Seleccionamos un archivo utilizando askopenfilename
    print("La ruta de tu video es:", ruta)  #Imprimimos un texto con la ruta del archivo

selector_video_entrada = tk.Button(  #Creamos un botón para seleccionar un archivo de video de entrada
    marco,  #El botón se crea dentro del marco
    text="Selecciona el video de entrada",  #Añadimos un texto al boton
    command=seleccionaEntrada  #La función que se llama cuando se presiona el botón
)
selector_video_entrada.pack(padx=50, pady=20)  #Configuramos el boton añadiendo un padding

tk.Label(  #Creamos un label para pedir la anchura de salida deseada
    marco,  #El label se crea dentro del marco
    text="Indica la anchura de salida que quieres"  # Texto del label
).pack(padx=50, pady=20)  #Configuramos el label con un padding de 50 píxeles

ventana.mainloop()  #Iniciamos el bucle principal de la aplicación
