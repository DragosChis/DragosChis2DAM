variable1 = "hola" #Creamos una variable y asignamos un string
variable2 = "que tal" #Creamos variable 2 y asignamos un string

archivo = open("archivo.txt",'w') #Creamos un achivo txt
archivo.write(variable1+"|"+variable2) #Escribimos las dos variables dentro del archivo
archivo.close() #Cerramos el archivo

