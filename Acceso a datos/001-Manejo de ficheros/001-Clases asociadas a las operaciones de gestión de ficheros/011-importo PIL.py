import os #Creamos una lista a la que asignamos el directorio fotos
import PIL.Image #Importamos libreria PIL para poder trabajar con imagenes/fotos

lista = os.listdir("fotosJV") #Creamos una lista a la que asignamos el directorio fotos

for archivo in lista: #Mediante bucle for recorremos la lista por cada archivo del directorio fotos
    print(archivo)
    imagen = PIL.Image.open('fotosJV/'+archivo) #Abrimos las fotos
    datosexif = imagen._getexif() #Recogemos los datos de las foto
    print(datosexif) #Mostramos la informacion de la imagen por pantalla
