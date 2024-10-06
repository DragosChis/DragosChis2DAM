import random #Importamos libreria random para crear numero aleatorios o posiciones
import math #Importamos libreria math para utilizar funciones matematicas

# Declaro una clase Npc y le pongo dos sencillas propiedades x e y + un ángulo
class Npc:
    def __init__(self):
        self.x = random.randint(0, 512)          # Inicializa la propiedad x con un valor aleatorio entre 0 y 512
        self.y = random.randint(0, 512)          # Inicializa la propiedad y con un valor aleatorio entre 0 y 512
        self.angulo = random.random() * math.pi * 2  # Inicializa el ángulo con un valor aleatorio entre 0 y pi*2

# Creo una lista de 35 npcs
npcs = []
numero = 35

# Recorro la lista y a cada elemento le meto una instancia de la clase Npc
for i in range(0, numero):
    npcs.append(Npc())  # Añade una nueva instancia de Npc a la lista npcs

# Imprimimos las propiedades de cada NPC
for i in range(0, numero):
    print(npcs[i].x, npcs[i].y, npcs[i].angulo)  # Mostramos las propiedades del npc tanto en x, como y y el ángulo



