import random #Importamos libreria random para poder generar numeros aleatorios o posiciones
# Declaro una clase Npc y le pongo dos sencillas propiedades x e y
class Npc:
    def __init__(self):
        self.x = random.randint(0,512) # Inicializa la propiedad x con un valor aleatorio entre 0 y 512
        self.y = random.randint(0,512) # Inicializa la propiedad y con un valor aleatorio entre 0 y 512
# Creo una lista de 35 npcs
npcs = []
numero = 35
# Recorro la lista y a cada elemento le meto una instancia de la clase Npc
for i in range(0,numero):
    npcs.append(Npc())

for i in range(0,numero):
    print(npcs[i].x,npcs[i].y) #Mostramos las propiedades del npc tanto en x como y


