archivo = open("archivo.txt",'r') #Abrimos el archivo
contenido = archivo.read() #Leemos el archivo
print(contenido) #Mostramos por pantalla el contenido del archivo
lista = contenido.split("|") #Utilizamos el metodo split para dividir el contenido
print(lista)

variable1 = lista[0] #Asignamos el primer elemento de la lista a la variable1
variable2 = lista[1] #Asignamos el primer elemento de la lista a la variable1

print(variable1) #Mostramos por pantalla el contenido de variable1
print(variable2) #Mostramos por pantalla el contenido de variable2
