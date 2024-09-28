import json
import os
import errno

class Cliente:
    def __init__(self):
        self.idcliente = None
        self.nombre = None
        self.apellidos = None
        self.emails = {"personal":[],"profesional":[]}
    def to_dict(self):
        return {
            "nombre": self.nombre,
            "apellidos": self.apellidos,
            "emails": self.emails
        }

class Producto:
    def __init__(self):
        self.nombre = None
        self.precio = None
        self.peso = None
        self.dimensiones = {"x":None,"y":None,"z":None}

carpeta = "basededatos"
continuas = True
try:
    os.makedirs(carpeta)
except OSError as e:
    if e.errno == errno.EEXIST:
        print(f"La carpeta ya existe.")
    elif e.errno == errno.EACCES:
        continuas = False
        print("Error de permisos en la carpeta - no puedo guardar")
    else:
        print(f"Unexpected error: {e}")

if continuas:
    clientes = []
    clientes.append(Cliente())
    clientes[-1].idcliente = "00001"
    clientes[-1].nombre = "Dragos"
    clientes[-1].apellidos = "Chis"
    clientes[-1].emails['profesional'].append("dragos@gmail.com")
    clientes[-1].emails['profesional'].append("info@dragos@email.com")
    clientes[-1].emails['personal'].append("dragoschis@gmail.com")

    clientes.append(Cliente())
    clientes[-1].idcliente = "00002"
    clientes[-1].nombre = "Paco"
    clientes[-1].apellidos = "Lopez"
    clientes[-1].emails['profesional'].append("paco@correo.com")
    clientes[-1].emails['profesional'].append("paco@email.com")
    clientes[-1].emails['personal'].append("paco@gmail.com")

    for cliente in clientes:
        archivo = open(carpeta+"/"+cliente.idcliente+".json",'w')
        json.dump(cliente.to_dict(),archivo,indent=4)
        archivo.close()


        


