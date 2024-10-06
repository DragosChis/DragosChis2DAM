import random  # Importamos librería random para crear números aleatorios o posiciones
import math  # Importamos librería math para utilizar funciones matemáticas

# Declaro una clase Npc y le pongo dos sencillas propiedades x, e y
class Npc:
    def __init__(self):  # Constructor de la clase Npc
        self.x = random.randint(0, 512)  # Inicializa la propiedad x con un valor aleatorio entre 0 y 512
        self.y = random.randint(0, 512)  # Inicializa la propiedad y con un valor aleatorio entre 0 y 512
        self.angulo = random.random() * math.pi * 2  # Inicializa el ángulo con un valor aleatorio entre 0 y 2 * pi

# Creo una lista de 35 npcs
npcs = []  # Inicializa una lista vacía para almacenar las instancias de Npc
numero = 35  # Definimos cuántos NPCs queremos crear

# Recorro la lista y a cada elemento le meto una instancia de la clase Npc
for i in range(0, numero):  # Bucle que itera desde 0 hasta 34
    npcs.append(Npc())  # Añade una nueva instancia de Npc a la lista npcs

cadena = []  # Inicializa una lista vacía para almacenar las propiedades de los NPCs

for i in range(0, numero):  # Bucle que recorre cada NPC en la lista
    # Añade un diccionario con las propiedades del NPC a la lista 'cadena'
    cadena.append({"x": npcs[i].x, "y": npcs[i].y, "angulo": npcs[i].angulo})  

print(cadena)  # Imprime la lista de diccionarios que representan las propiedades de los NPCs

##mibasededatos = open("basededatos.txt", 'w')  
##mibasededatos.write(cadena)  
##mibasededatos.close()  



