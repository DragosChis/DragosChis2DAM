import shutil #Importamos libreria shutil para copiar y remover archivos
 
origen = 'origen/documento.txt' #El origen del archivo
destino = 'destino/documento.txt' #El destino donde queremos mover dicho archivo
 
shutil.copy(origen, destino) #Hacemos una copia del archivo de origen y lo pegamos en la carpeta de destino

