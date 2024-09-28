import os #importamos la libreria del sistema

lista = os.listdir("fotos") #Creamos una lista a la que asignamos el directorio fotos

for archivo in lista: #Mediante bucle for recorremos la lista por cada archivo del directorio fotos
    print(archivo)
