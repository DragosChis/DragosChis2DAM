
import json  # Importamos la librería json para trabajar con archivos JSON
import xml.etree.ElementTree as ET  # Importamos la librería xml.etree.ElementTree para trabajar con archivos XML

# Definimos una función para convertir un diccionario a un elemento XML
def dict_to_xml(tag, d):  # tag es la etiqueta del elemento XML, d es el diccionario
    elem = ET.Element(tag)  # Creamos un nuevo elemento XML con la etiqueta especificada
    for key, val in d.items():  # Recorremos el diccionario
        child = ET.SubElement(elem, key)  # Creamos un nuevo subelemento con la clave del diccionario
        child.text = str(val)  # Asignamos el valor del diccionario al subelemento
    return elem  # Devolvemos el elemento XML

# Definimos una función para guardar un diccionario en un archivo XML
def save_dict_to_xml(filename, root_tag, dictionary):  # filename es el nombre del archivo, root_tag es la etiqueta del elemento raíz, dictionary es el diccionario
    root = dict_to_xml(root_tag, dictionary)  # Convertimos el diccionario a un elemento XML
    tree = ET.ElementTree(root)  # Creamos un nuevo árbol XML con el elemento raíz
    tree.write(filename, encoding='utf-8', xml_declaration=True)  # Guardamos el árbol XML en el archivo especificado

# Abrimos el archivo 'cliente.json' en modo de lectura ('r')
with open('cliente.json', 'r') as archivo:  
    # Cargamos los datos del archivo JSON en la variable 'datos'
    datos = json.load(archivo)  

# Imprimimos los datos cargados
print(datos)  

# Guardamos los datos en un archivo XML
save_dict_to_xml('cliente.xml', 'cliente', datos)  # Guardamos los datos en un archivo XML llamado 'cliente.xml'




