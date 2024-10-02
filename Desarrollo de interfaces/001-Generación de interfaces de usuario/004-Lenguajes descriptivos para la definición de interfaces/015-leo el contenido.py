import xml.etree.ElementTree as ET #Importamos elemntree para trabajar con achivos xml


arbol = ET.parse('013-interfaz.xml') #Analizamos el achivo xml y obtenemos el arbol de elementos
raiz = arbol.getroot() #Obtenemos la raiz del arbol de elementos

print(raiz) #Imprimimos la raiz del arbol de elementos
