import tkinter as tk #Importamos la libreria tkinter para crear interfaces

ventana = tk.Tk() #Creamos una ventana principal

def diHola(): #Creamos una funcion que cuando la llamamos dice Hola
    print("Hola")

tk.Button(ventana,text="Pulsame",padx=15,pady=15,command=diHola).pack(padx=40,pady=40) #Creamos un boton

ventana.mainloop() #Ejecutamos el bucle de la aplicacion
