import tkinter as tk #Importamos la libreria tkinter para crear interfaces

ventana = tk.Tk() #Creamos una ventana principal

tk.Button(ventana,text="Pulsame",padx=15,pady=15).pack(padx=40,pady=40) #Creamos un boton

ventana.mainloop() #Ejecutamos el bucle de la aplicacion
