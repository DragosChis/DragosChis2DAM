import tkinter as tk #Importamos la libreria tkinter para crear interfaces
from tkinter import filedialog #Importamos filedialog para poder trabajar con dialogos

ventana = tk.Tk() #Creamos una ventana principal

marco = tk.Frame(ventana) #Creamos un marco dentro de la ventana principal
marco.pack(padx=10,pady=10) #Añadimos al marco un padding

def seleccionaEntrada(): #Definimos una funcion que se encargara de seleccionar un archivo de video de entrada
    ruta = filedialog.askopenfilename() #Utilizamos el dialogo para seleccionar un archivo dentro de la ruta

selector_video_entrada = tk.Button( #Creamos un boton para seleccionar un archivo del video de entrada
    marco,                          #Creamos el boton dentro de un marco
    text="Selecciona el video de entrada", #Ponemos un texto la boton
    command=seleccionaEntrada #Llamamos a la funcion cuando pulsamos el boton
    )

selector_video_entrada.pack(padx=50,pady=50); #Configuramos el boton añadiendole padding

ventana.mainloop() #Ejecutamos el bucle de la aplicacion
