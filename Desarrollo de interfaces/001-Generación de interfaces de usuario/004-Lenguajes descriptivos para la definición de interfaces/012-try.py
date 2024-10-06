import tkinter as tk  # Importar la biblioteca tkinter para crear la interfaz gráfica
from tkinter import filedialog  # Importar el módulo filedialog para abrir diálogos de archivo
import subprocess  # Importar subprocess para ejecutar comandos del sistema
import os  # Importar os para manipulación de rutas del sistema operativo

ventana = tk.Tk()  # Crear la ventana principal

marco = tk.Frame(ventana)  # Marco para contener los widgets
marco.pack(padx=10, pady=10)  # Empaquetar el marco con márgenes

anchura = tk.StringVar()  # Variable que almacena la anchura
altura = tk.StringVar()  # Variable que almacena la altura

# Variables para las rutas de los archivos de entrada y salida
salida = None  # Inicializar la variable de salida como None
entrada = None  # Inicializar la variable de entrada como None

def procesar():  # Función que se ejecuta al procesar el video
    global entrada, salida  # Usar las variables globales entrada y salida
    # Verificar si las rutas de entrada y salida no están vacías
    if not entrada or not salida:
        print("Por favor, selecciona los archivos de entrada y salida.")  # Mensaje de error si faltan archivos
        return  # Salir de la función

    # Normalizar las rutas de archivo para evitar problemas
    entrada = os.path.normpath(entrada)  # Normalizar la ruta de entrada
    salida = os.path.normpath(salida)  # Normalizar la ruta de salida

    # Asegurarse de que las rutas están entre comillas dobles
    command = ['ffmpeg', '-i', entrada, '-vf', f'scale={anchura.get()}:{altura.get()}', salida]  # Crear el comando para FFmpeg

    try:
        # Ejecutar el comando FFmpeg con argumentos separados
        result = subprocess.run(command, capture_output=True, text=True)  # Ejecutar el comando y capturar la salida
        
        # Mostrar la salida y posibles errores en la consola
        print("FFmpeg output:", result.stdout)  # Mostrar la salida estándar de FFmpeg
        print("FFmpeg error (if any):", result.stderr)  # Mostrar errores de FFmpeg, si los hay
        
        if result.returncode == 0:  # Comprobar si el comando se ejecutó correctamente
            print("Video procesado con éxito")  # Mensaje de éxito
        else:
            print("Error en el procesamiento del video")  # Mensaje de error si falla

    except Exception as e:  # Capturar cualquier excepción que ocurra
        print("Error ejecutando el comando:", e)  # Mostrar el error

def seleccionaEntrada():  # Función para seleccionar el archivo de entrada
    global entrada  # Usar la variable global entrada
    entrada = filedialog.askopenfilename()  # Abrir un diálogo para seleccionar el archivo

def seleccionaSalida():  # Función para seleccionar el archivo de salida
    global salida  # Usar la variable global salida
    salida = filedialog.asksaveasfilename()  # Abrir un diálogo para guardar el archivo

# Botón para seleccionar el video de entrada
selector_video_entrada = tk.Button(
    marco,
    text="Selecciona el video de entrada",  # Texto del botón
    command=seleccionaEntrada  # Llama a seleccionaEntrada al hacer clic
)
selector_video_entrada.pack(padx=50, pady=20)  # Empaquetar con márgenes

# Etiqueta para la anchura
tk.Label(
    marco,
    text="Indica la anchura de salida que quieres"  # Texto de la etiqueta
).pack(padx=50, pady=20)  # Empaquetar con márgenes

# Campo de entrada para la anchura
tk.Entry(
    marco,
    textvariable=anchura  # Vincula la entrada a la variable 'anchura'
).pack(padx=50, pady=20)  # Empaquetar con márgenes

# Etiqueta para la altura
tk.Label(
    marco,
    text="Indica la altura de salida que quieres"  # Texto de la etiqueta
).pack(padx=50, pady=20)  # Empaquetar con márgenes

# Campo de entrada para la altura
tk.Entry(
    marco,
    textvariable=altura  # Vincula la entrada a la variable 'altura'
).pack(padx=50, pady=20)  # Empaquetar con márgenes

# Botón para seleccionar el archivo de salida
selector_video_salida = tk.Button(
    marco,
    text="Selecciona el video de salida",  # Texto del botón
    command=seleccionaSalida  # Llama a seleccionaSalida al hacer clic
)
selector_video_salida.pack(padx=50, pady=20)  # Empaquetar con márgenes

# Botón para iniciar el proceso
tk.Button(
    marco,
    text="Comenzamos",  # Texto del botón
    command=procesar  # Llama a procesar al hacer clic
).pack(padx=50, pady=20)  # Empaquetar con márgenes

ventana.mainloop()  # Inicia el bucle principal de la ventana

