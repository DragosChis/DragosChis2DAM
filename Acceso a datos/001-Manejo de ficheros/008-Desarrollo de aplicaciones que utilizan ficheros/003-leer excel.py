# Importamos la librería pandas para trabajar con datos
import pandas as pd  # Importamos pandas como pd


df = pd.read_excel('clientes.ods', engine='odf')  # Leemos el archivo en un DataFrame


print(df.head())  # Imprimimos las primeras filas del DataFrame


ruta = 'clientesdesdeexcel.json'  # Establecemos la ruta para guardar el archivo JSON


df.to_json(ruta, orient='records', lines=True)  # Guardamos el DataFrame en un archivo JSON
