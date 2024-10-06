import random #Importamos libreria random para crear numero aleatorios o posiciones
import math #Importamos libreria math para utilizar funciones matematicas
# Declaro una clase Npc y le pongo dos sencillas propiedades x e y + un angulo
class Npc:
    def __init__(self):
        self.x = random.randint(0,512) # Inicializa la propiedad x con un valor aleatorio entre 0 y 512
        self.y = random.randint(0,512) # Inicializa la propiedad y con un valor aleatorio entre 0 y 512
        self.angulo = random.random()*math.pi*2 # Inicializa el ángulo con un valor aleatorio entre 0 y pi*2
# Creo una lista de 35 npcs
npcs = []
numero = 35
# Recorro la lista y a cada elemento le meto una instancia de la clase Npc
for i in range(0,numero):
    npcs.append(Npc())

cadena = "" #Creamos una cadena vacía para guardar la información de los NPCs

for i in range(0,numero): #Creamos un bucle for para recorrer los NPC de la lista
    cadena += str(npcs[i].x)+","+str(npcs[i].y)+","+str(npcs[i].angulo)+"|" #Separamos los valores x,y y angulo por comas y terminamos con un caracter |

print(cadena)
mibasededatos = open("basededatos.txt",'w') #Abrimos el archivo
mibasededatos.write(cadena) #Escribimos la cadena dentro del archivo
mibasededatos.close() #Cerramos el archivo


