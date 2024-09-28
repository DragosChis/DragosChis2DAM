import os  #Creamos una lista a la que asignamos el directorio fotos
from PIL import Image, ImageOps  

lista = os.listdir("fotos")  #Creamos una lista a la que asignamos el directorio fotos

for archivo in lista: #Mediante bucle for recorremos la lista por cada archivo del directorio fotos
    print("ok") #Escribimos ok a cada foto
    imagen = Image.open(r"fotos/"+archivo) #Abrimos las fotos
    imagen2 = ImageOps.grayscale(imagen) #Aplicamos un filtro de color gris a la fotos
    imagen.close() #Cerramos el proceso de PIL
    imagen2.save('fotos/'+archivo) #Guardamos los cambios
    imagen2.close() #Cerramos el proceso de PIL correspondiente
