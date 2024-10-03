const canvas = document.getElementById('gameCanvas');
const ctx = canvas.getContext('2d');

// Ajustar el tamaño del canvas al tamaño de la ventana
canvas.width = window.innerWidth;
canvas.height = window.innerHeight;

// Cargar imágenes
const imagenCocheJugador = new Image();
const imagenCocheEnemigo = new Image();
const imagenFondo = new Image();
let imagenesCargadas = 0; // Contador de imágenes cargadas

// Función para verificar si todas las imágenes se han cargado
function verificarCargaImagen() {
    imagenesCargadas++;
    if (imagenesCargadas === 3) {
        iniciarJuego();
    }
}

// Asignar las rutas de las imágenes
imagenCocheJugador.src = 'coche_bueno.png'; // Imagen del coche del jugador
imagenCocheEnemigo.src = 'coche_malo.png';  // Imagen del coche enemigo
imagenFondo.src = 'fondojuego.png';         // Fondo de la carretera

// Asignar funciones de carga
imagenCocheJugador.onload = verificarCargaImagen;
imagenCocheEnemigo.onload = verificarCargaImagen;
imagenFondo.onload = verificarCargaImagen;

// Variables del juego
const carreteraAncho = 200; // Asumiendo que la carretera tiene un ancho fijo
let cocheJugador = { 
    x: (canvas.width - 50) / 6, // Centrado horizontalmente en la carretera
    y: (canvas.height - 100) / 2, // Centrado verticalmente en el canvas
    ancho: 150, 
    alto: 50, 
    velocidad: 5 
}; 
let cochesEnemigos = [];
let juegoTerminado = false;
let puntuacion = 0;
let posicionFondoX = 0; // Para el desplazamiento del fondo

// Función para iniciar el juego una vez que todas las imágenes se han cargado
function iniciarJuego() {
    actualizarJuego();
}

// Función para generar coches enemigos
function generarCochesEnemigos() {
    // Definir un rango de aparición en Y alrededor del coche del jugador
    const rango = 50; // Rango de aparición vertical en píxeles

    const cocheEnemigo = {
        x: canvas.width, // Comienza desde el lado derecho de la pantalla
        // Generar posición Y del coche enemigo en función de la posición Y del jugador
        y: cocheJugador.y + (Math.random() * rango) - (rango / 2), 
        ancho: 150,
        alto: 50,
        velocidad: 3 + Math.random() * 5 // Velocidad aleatoria
    };

    // Asegurarse de que el coche enemigo no salga del canvas
    if (cocheEnemigo.y < 0) {
        cocheEnemigo.y = 0;
    } else if (cocheEnemigo.y > canvas.height - cocheEnemigo.alto) {
        cocheEnemigo.y = canvas.height - cocheEnemigo.alto;
    }

    cochesEnemigos.push(cocheEnemigo);
}

// Función para mover el coche del jugador
function moverJugador() {
    // Definir los límites en el eje Y
    const limiteizquierda = 50;  
    const limiteSuperior = 250; // Espacio desde el borde superior
    const limiteInferior = canvas.height - 210 - cocheJugador.alto; // Espacio desde el borde inferior

    // Mover hacia la izquierda
    if (teclas['ArrowLeft'] && cocheJugador.x > limiteizquierda) { // Limitar el movimiento hacia arriba
        cocheJugador.x -= cocheJugador.velocidad; // Mover hacia arriba
    }

    // Mover hacia la derecha
    if (teclas['ArrowRight'] && cocheJugador.x < (canvas.width + carreteraAncho) / 2 - cocheJugador.ancho) {
        cocheJugador.x += cocheJugador.velocidad; // Mover a la derecha
        console.log("Moviendo a la derecha, nueva posición x:", cocheJugador.x); // Depuración
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
    for (let i = 0; i < cochesEnemigos.length; i++) {
        cochesEnemigos[i].x -= cochesEnemigos[i].velocidad; // Los coches enemigos se mueven hacia la izquierda

        // Verificar colisiones
        if (
            cocheJugador.x < cochesEnemigos[i].x + cochesEnemigos[i].ancho &&
            cocheJugador.x + cocheJugador.ancho > cochesEnemigos[i].x &&
            cocheJugador.y < cochesEnemigos[i].y + cochesEnemigos[i].alto &&
            cocheJugador.y + cocheJugador.alto > cochesEnemigos[i].y
        ) {
            juegoTerminado = true;
        }

        // Eliminar coches enemigos que salen de la pantalla
        if (cochesEnemigos[i].x < -50) { // Cuando el coche enemigo sale completamente por la izquierda
            cochesEnemigos.splice(i, 1); // Quita el coche enemigo si sale de la pantalla
            puntuacion++; // Incrementar la puntuación cuando un coche enemigo sale de la pantalla
        }
    }
}

// Función para dibujar el coche del jugador
function dibujarCocheJugador() {
    ctx.drawImage(imagenCocheJugador, cocheJugador.x, cocheJugador.y, cocheJugador.ancho, cocheJugador.alto);
}

// Función para dibujar los coches enemigos
function dibujarCochesEnemigos() {
    for (let i = 0; i < cochesEnemigos.length; i++) {
        ctx.drawImage(imagenCocheEnemigo, cochesEnemigos[i].x, cochesEnemigos[i].y, cochesEnemigos[i].ancho, cochesEnemigos[i].alto);
    }
}

// Control del teclado
const teclas = {};
window.addEventListener('keydown', function (e) {
    teclas[e.key] = true;
});
window.addEventListener('keyup', function (e) {
    teclas[e.key] = false;
});

// Función para dibujar y desplazar el fondo
function dibujarFondo() {
    posicionFondoX -= 2; // Desplazamiento horizontal del fondo

    // Reiniciar la posición del fondo para crear un bucle
    if (posicionFondoX <= -canvas.width) {
        posicionFondoX = 0;
    }

    // Dibujar el fondo
    ctx.drawImage(imagenFondo, posicionFondoX, 0, canvas.width, canvas.height);
    ctx.drawImage(imagenFondo, posicionFondoX + canvas.width, 0, canvas.width, canvas.height);
}

// Función principal de actualización
function actualizarJuego() {
    if (juegoTerminado) {
        alert('¡Juego terminado! Puntuación: ' + puntuacion);
        document.location.reload(); // Recargar la página para reiniciar el juego
        return;
    }

    ctx.clearRect(0, 0, canvas.width, canvas.height); // Limpiar el canvas
    dibujarFondo(); // Dibujar el fondo
    moverJugador(); // Mover el coche del jugador
    moverCochesEnemigos(); // Mover coches enemigos

    // Generar coches enemigos aleatoriamente
    if (Math.random() < 0.02) { // Ajusta la probabilidad para la aparición de enemigos
        generarCochesEnemigos();
    }

    dibujarCocheJugador(); // Dibujar el coche del jugador
    dibujarCochesEnemigos(); // Dibujar coches enemigos

    requestAnimationFrame(actualizarJuego); // Continuar la actualización
}
