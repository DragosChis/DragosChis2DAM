import xml.etree.ElementTree as ET  # Importamos ElementTree para trabajar con archivos XML
import tkinter as tk  # Importamos tkinter para crear la interfaz gráfica

ventana = tk.Tk()  # Creamos una ventana principal

arbol = ET.parse('013-interfaz.xml')  # Analizamos el archivo XML y obtenemos el árbol de elementos
raiz = arbol.getroot()  # Obtenemos la raíz del árbol de elementos

for elemento in raiz:  # Iteramos sobre los elementos hijos de la raíz
    if elemento.tag == "boton":  # Verificamos si el elemento es un botón
        tk.Button(ventana, text=elemento.text).pack(padx=20, pady=20)  # Creamos un botón con el texto del elemento
    elif elemento.tag == "texto":  # Verificamos si el elemento es un texto
        tk.Label(ventana, text=elemento.text).pack(padx=20, pady=20)  # Creamos una etiqueta con el texto del elemento
    elif elemento.tag == "entrada":  # Verificamos si el elemento es una entrada
        tk.Entry(ventana).pack(padx=20, pady=20)  # Creamos un campo de entrada

ventana.mainloop()  # Iniciamos el bucle principal de la ventana
