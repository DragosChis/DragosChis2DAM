import xml.etree.ElementTree as ET  # Importamos ElementTree para trabajar con archivos XML

arbol = ET.parse('013-interfaz.xml')  # Analizamos el archivo XML y obtenemos el árbol de elementos
raiz = arbol.getroot()  # Obtenemos la raíz del árbol de elementos

for elemento in raiz:  # Iteramos sobre los elementos hijos de la raíz
    if elemento.tag == "boton":  # Verificamos si el elemento es un botón
        print("tienes un boton")  # Imprimimos un mensaje si es un botón
    elif elemento.tag == "texto":  # Verificamos si el elemento es un texto
        print("tienes un texto")  # Imprimimos un mensaje si es un texto
    elif elemento.tag == "entrada":  # Verificamos si el elemento es una entrada
        print("tienes una entrada")  # Imprimimos un mensaje si es una entrada
