import random  # Importamos librería random para crear números aleatorios o posiciones
import math  # Importamos librería math para utilizar funciones matemáticas

# Declaro una clase Npc y le pongo dos sencillas propiedades x, e y
class Npc:
    def __init__(self, nuevax, nuevay, nuevoangulo):  # Constructor que recibe las propiedades del NPC
        self.x = nuevax  # Asigna el valor de nuevax a la propiedad x
        self.y = nuevay  # Asigna el valor de nuevay a la propiedad y
        self.angulo = nuevoangulo  # Asigna el valor de nuevoangulo a la propiedad angulo

# Creo una lista de 35 npcs
npcs = []  # Inicializa una lista vacía para almacenar las instancias de Npc

# Leo el contenido de la base de datos
archivo = open("basededatos.txt", 'r')  # Abre el archivo en modo lectura
contenido = archivo.read()  # Lee todo el contenido del archivo
print(contenido)  # Imprime el contenido del archivo en la consola

objetos = contenido.split("|")  # Divide el contenido del archivo en objetos usando el carácter '|'
for objeto in objetos:  # Recorre cada objeto en la lista de objetos
    try:
        propiedades = objeto.split(",")  # Divide cada objeto en propiedades usando la coma como separador
        print(propiedades)  # Imprime las propiedades obtenidas
        npcs.append(Npc(propiedades[0], propiedades[1], propiedades[2]))  # Crea una nueva instancia de Npc con las propiedades y la añade a la lista npcs
    except:
        print("Ha ocurrido algún error pero que vamos que no te preocupes")  # Captura cualquier excepción y muestra un mensaje de error

# Ahora por último vamos a ver si todo ha ido bien
for npc in npcs:  # Recorre la lista de npcs
    print(npc.x, npc.y, npc.angulo)  # Imprime las propiedades x, y y ángulo de cada NPC

