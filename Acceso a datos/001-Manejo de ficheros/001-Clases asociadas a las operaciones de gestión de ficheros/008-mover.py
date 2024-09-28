import shutil #Importamos libreria shutil para copiar y remover archivos
 
origen = 'origen/documento.txt' #El origen del archivo
destino = 'destino/documento.txt' #El destino donde queremos mover dicho archivo
 
shutil.move(origen, destino) #Movemos el archivo de origen al de destino

