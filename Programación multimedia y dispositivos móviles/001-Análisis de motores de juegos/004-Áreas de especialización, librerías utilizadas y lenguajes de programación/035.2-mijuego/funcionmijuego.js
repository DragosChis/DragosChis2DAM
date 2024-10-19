const canvas = document.getElementById('gameCanvas'); // Obtiene el elemento canvas por su ID
const ctx = canvas.getContext('2d'); // Obtiene el contexto 2D del canvas

// Ajustar el tamaño del canvas al tamaño de la ventana
canvas.width = window.innerWidth; // Establece el ancho del canvas
canvas.height = window.innerHeight; // Establece la altura del canvas

// Cargar imágenes
const imagenCocheJugador = new Image(); // Crea un nuevo objeto de imagen para el coche del jugador
const imagenCocheEnemigo = new Image(); // Crea un nuevo objeto de imagen para el coche enemigo
const imagenFondo = new Image(); // Crea un nuevo objeto de imagen para el fondo
let imagenesCargadas = 0; // Contador de imágenes cargadas

// Función para verificar si todas las imágenes se han cargado
function verificarCargaImagen() {
    imagenesCargadas++; // Incrementa el contador de imágenes cargadas
    if (imagenesCargadas === 3) { // Si se han cargado todas las imágenes
        iniciarJuego(); // Inicia el juego
    }
}

// Asignar las rutas de las imágenes
imagenCocheJugador.src = 'coche_bueno.png'; // Imagen del coche del jugador
imagenCocheEnemigo.src = 'coche_malo.png';  // Imagen del coche enemigo
imagenFondo.src = 'fondojuego.png';         // Fondo de la carretera

// Asignar funciones de carga
imagenCocheJugador.onload = verificarCargaImagen; // Verifica carga del coche del jugador
imagenCocheEnemigo.onload = verificarCargaImagen; // Verifica carga del coche enemigo
imagenFondo.onload = verificarCargaImagen; // Verifica carga del fondo

// Variables del juego
const carreteraAncho = 200; // Asumiendo que la carretera tiene un ancho fijo
let cocheJugador = { 
    x: (canvas.width - 50) / 6, // Centrado horizontalmente en la carretera
    y: (canvas.height - 100) / 2, // Centrado verticalmente en el canvas
    ancho: 150, // Ancho del coche
    alto: 50, // Alto del coche
    velocidad: 5 // Velocidad de movimiento del coche
}; 
let cochesEnemigos = []; // Lista para almacenar los coches enemigos
let balas = []; // Lista para las balas disparadas
let juegoTerminado = false; // Estado del juego
let puntuacion = 0; // Variable para la puntuación
let posicionFondoX = 0; // Para el desplazamiento del fondo
let espacioPresionado = false; // Nuevo estado para evitar disparos continuos al mantener la tecla

// Función para iniciar el juego una vez que todas las imágenes se han cargado
function iniciarJuego() {
    actualizarJuego(); // Llama a la función principal para actualizar el juego
}

// Función para generar coches enemigos
function generarCochesEnemigos() {
    // Definir un rango de aparición en Y alrededor del coche del jugador
    const rango = 50; // Rango de aparición vertical en píxeles

    const cocheEnemigo = {
        x: canvas.width, // Comienza desde el lado derecho de la pantalla
        // Generar posición Y del coche enemigo en función de la posición Y del jugador
        y: cocheJugador.y + (Math.random() * rango) - (rango / 2), // Aleatoriza la posición vertical
        ancho: 150, // Ancho del coche enemigo
        alto: 50, // Alto del coche enemigo
        velocidad: 3 + Math.random() * 5 // Velocidad aleatoria
    };

    // Asegurarse de que el coche enemigo no salga del canvas
    if (cocheEnemigo.y < 0) { // Si el coche enemigo está por encima del canvas
        cocheEnemigo.y = 0; // Ajusta la posición Y al borde superior
    } else if (cocheEnemigo.y > canvas.height - cocheEnemigo.alto) { // Si el coche enemigo está por debajo del canvas
        cocheEnemigo.y = canvas.height - cocheEnemigo.alto; // Ajusta la posición Y al borde inferior
    }

    cochesEnemigos.push(cocheEnemigo); // Agrega el coche enemigo a la lista
}

// Función para disparar balas
function dispararBala() {
    const bala = {
        x: cocheJugador.x + cocheJugador.ancho, // Aparece al frente del coche del jugador
        y: cocheJugador.y + cocheJugador.alto / 2 - 5, // Alineada verticalmente al centro del coche
        ancho: 10, // Ancho de la bala
        alto: 10, // Alto de la bala
        velocidad: 8 // Velocidad de la bala
    };
    balas.push(bala); // Agrega la bala a la lista
}

// Función para mover las balas
function moverBalas() {
    for (let i = 0; i < balas.length; i++) { // Itera sobre las balas
        balas[i].x += balas[i].velocidad; // Las balas se mueven hacia la derecha

        // Eliminar balas que salgan del canvas
        if (balas[i].x > canvas.width) { // Si la bala se sale del canvas
            balas.splice(i, 1); // Elimina la bala
            i--; // Decrementa el índice para evitar saltar el siguiente elemento
        }
    }
}

// Función para detectar colisiones entre balas y coches enemigos
function detectarColisiones() {
    for (let i = 0; i < balas.length; i++) { // Itera sobre las balas
        for (let j = 0; j < cochesEnemigos.length; j++) { // Itera sobre los coches enemigos
            if (
                balas[i].x < cochesEnemigos[j].x + cochesEnemigos[j].ancho && // Verifica colisión en X
                balas[i].x + balas[i].ancho > cochesEnemigos[j].x && // Verifica colisión en X
                balas[i].y < cochesEnemigos[j].y + cochesEnemigos[j].alto && // Verifica colisión en Y
                balas[i].y + balas[i].alto > cochesEnemigos[j].y // Verifica colisión en Y
            ) {
                // Colisión detectada
                balas.splice(i, 1); // Eliminar la bala
                cochesEnemigos.splice(j, 1); // Eliminar el coche enemigo
                puntuacion += 10; // Incrementar la puntuación
                i--; // Ajustar el índice de las balas
                break; // Salir del bucle de colisión para esta bala
            }
        }
    }
}

// Función para mover el coche del jugador
function moverJugador() {
    // Definir los límites en el eje Y
    const limiteSuperior = 250; // Espacio desde el borde superior
    const limiteInferior = canvas.height - 210 - cocheJugador.alto; // Espacio desde el borde inferior

    if (teclas["ArrowLeft"] && cocheJugador.x > 0) { // Si se presiona la tecla izquierda
        cocheJugador.x -= cocheJugador.velocidad; // Mover a la izquierda
    }
    if (teclas['ArrowRight'] && cocheJugador.x < (canvas.width + carreteraAncho) / 2 - cocheJugador.ancho) { // Si se presiona la tecla derecha
        cocheJugador.x += cocheJugador.velocidad; // Mover a la derecha
    }
    // Mover hacia arriba y abajo, con límites
    if (teclas['ArrowUp'] && cocheJugador.y > limiteSuperior) { // Limitar el movimiento hacia arriba
        cocheJugador.y -= cocheJugador.velocidad; // Mover hacia arriba
    }
    if (teclas['ArrowDown'] && cocheJugador.y < limiteInferior) { // Limitar el movimiento hacia abajo
        cocheJugador.y += cocheJugador.velocidad; // Mover hacia abajo
    }
}

// Función para mover los coches enemigos
function moverCochesEnemigos() {
    for (let i = 0; i < cochesEnemigos.length; i++) { // Itera sobre los coches enemigos
        cochesEnemigos[i].x -= cochesEnemigos[i].velocidad; // Los coches enemigos se mueven hacia la izquierda

        // Verificar colisiones con el coche del jugador
        if (
            cocheJugador.x < cochesEnemigos[i].x + cochesEnemigos[i].ancho && // Verifica colisión en X
            cocheJugador.x + cocheJugador.ancho > cochesEnemigos[i].x && // Verifica colisión en X
            cocheJugador.y < cochesEnemigos[i].y + cochesEnemigos[i].alto && // Verifica colisión en Y
            cocheJugador.y + cocheJugador.alto > cochesEnemigos[i].y // Verifica colisión en Y
        ) {
            juegoTerminado = true; // Marca el juego como terminado si hay colisión
        }

        // Eliminar coches enemigos que salen de la pantalla
        if (cochesEnemigos[i].x < -50) { // Cuando el coche enemigo sale completamente por la izquierda
            cochesEnemigos.splice(i, 1); // Quita el coche enemigo si sale de la pantalla
        }
    }
}

// Función para dibujar el coche del jugador
function dibujarCocheJugador() {
    ctx.drawImage(imagenCocheJugador, cocheJugador.x, cocheJugador.y, cocheJugador.ancho, cocheJugador.alto); // Dibuja el coche del jugador
}

// Función para dibujar los coches enemigos
function dibujarCochesEnemigos() {
    for (let i = 0; i < cochesEnemigos.length; i++) { // Itera sobre los coches enemigos
        ctx.drawImage(imagenCocheEnemigo, cochesEnemigos[i].x, cochesEnemigos[i].y, cochesEnemigos[i].ancho, cochesEnemigos[i].alto); // Dibuja cada coche enemigo
    }
}

// Función para dibujar las balas
function dibujarBalas() {
    ctx.fillStyle = 'black'; // Color de las balas
    for (let i = 0; i < balas.length; i++) { // Itera sobre las balas
        ctx.fillRect(balas[i].x, balas[i].y, balas[i].ancho, balas[i].alto); // Dibuja cada bala
    }
}

// Función para dibujar el contador de puntuación
function dibujarPuntuacion() {
    const padding = 10; // Espacio alrededor del texto
    const textHeight = 24; // Altura del texto

    // Dibuja el fondo negro
    ctx.fillStyle = 'black'; // Color del fondo
    ctx.fillRect(10, 10, 200, textHeight + padding); // Rectángulo negro para la puntuación

    // Dibuja el texto de la puntuación
    ctx.fillStyle = 'white'; // Color del texto
    ctx.font = '24px Arial'; // Estilo de la fuente
    ctx.fillText('Puntuación: ' + puntuacion, 20, 30); // Dibuja la puntuación en el canvas
}

// Control del teclado
const teclas = {}; // Objeto para almacenar las teclas presionadas
window.addEventListener('keydown', function (e) {
    teclas[e.key] = true; // Marca la tecla como presionada

    // Disparar con la tecla espacio si no está presionada actualmente
    if (e.key === ' ' && !espacioPresionado) { // Si se presiona la tecla espacio
        dispararBala(); // Llama a la función para disparar
        espacioPresionado = true; // Evita disparar continuamente mientras la tecla espacio está presionada
    }
});
window.addEventListener('keyup', function (e) {
    teclas[e.key] = false; // Marca la tecla como no presionada

    // Restablecer la capacidad de disparar cuando se suelta la tecla espacio
    if (e.key === ' ') { // Si se suelta la tecla espacio
        espacioPresionado = false; // Permite disparar nuevamente
    }
});

// Función para dibujar y desplazar el fondo
function dibujarFondo() {
    posicionFondoX -= 2; // Desplazamiento horizontal del fondo

    // Reiniciar la posición del fondo para crear un bucle
    if (posicionFondoX <= -canvas.width) { // Si el fondo se ha desplazado completamente
        posicionFondoX = 0; // Reinicia la posición del fondo
    }

    // Dibujar el fondo
    ctx.drawImage(imagenFondo, posicionFondoX, 0, canvas.width, canvas.height); // Dibuja el fondo en la posición actual
    ctx.drawImage(imagenFondo, posicionFondoX + canvas.width, 0, canvas.width, canvas.height); // Dibuja una segunda imagen del fondo para el bucle
}

// Función principal de actualización
function actualizarJuego() {
    if (juegoTerminado) { // Si el juego ha terminado
        alert('¡Juego terminado! Puntuación: ' + puntuacion); // Muestra la puntuación final
        document.location.reload(); // Recargar la página para reiniciar el juego
        return; // Sale de la función
    }

    ctx.clearRect(0, 0, canvas.width, canvas.height); // Limpiar el canvas
    dibujarFondo(); // Dibujar el fondo
    moverJugador(); // Mover el coche del jugador
    moverCochesEnemigos(); // Mover coches enemigos
    moverBalas(); // Mover las balas
    detectarColisiones(); // Detectar colisiones entre balas y enemigos

    // Generar coches enemigos aleatoriamente
    if (Math.random() < 0.02) { // Ajusta la probabilidad para la aparición de enemigos
        generarCochesEnemigos(); // Llama a la función para generar coches enemigos
    }

    dibujarCocheJugador(); // Dibujar el coche del jugador
    dibujarCochesEnemigos(); // Dibujar coches enemigos
    dibujarBalas(); // Dibujar las balas
    dibujarPuntuacion(); // Llamar a la función para dibujar la puntuación

    requestAnimationFrame(actualizarJuego); // Continuar la actualización del juego
}



