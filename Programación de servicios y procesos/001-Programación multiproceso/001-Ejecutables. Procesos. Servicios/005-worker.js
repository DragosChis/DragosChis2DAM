onmessage = function(){                                 // El worker escucha
    console.log("Vale empezamos");                             // Hace algo
    postMessage("Soy el worker y funciono correctamente")       // Devuelve un mensaje al hilo principal
}
