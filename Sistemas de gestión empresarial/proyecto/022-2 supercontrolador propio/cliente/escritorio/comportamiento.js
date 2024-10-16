window.onload = function(){
    fetch("../../servidor/lista_aplicaciones.php")         // Llamo a un microservicio que me da la lista de aplicaciones
        .then(response => {
          return response.json();                         // Solicito que el servidor me devuelva la respuesta en formato JSON
        })
        .then(data => {
            const plantilla = document.getElementById('plantilla_aplicacion');              // Cargo el template HTML (plantilla) en memoria
            console.log(data);                                                               // Imprimo el JSON recibido en la consola para comprobar los datos
            data.forEach(function(elemento) {                                                // Itero sobre cada elemento del JSON recibido
                console.log(elemento);                                                      // Imprimo cada elemento del JSON en la consola para depuración
                const instancia = plantilla.content.cloneNode(true);                        // Clono la plantilla para crear una nueva instancia
                const nombre = instancia.querySelector('p');                                // Selecciono el elemento <p> dentro de la plantilla
                nombre.innerHTML = elemento.nombre;                                         // Asigno el nombre de la aplicación desde el JSON al <p>
                const imagen = instancia.querySelector("img");                              // Selecciono el elemento <img> dentro de la plantilla
                imagen.setAttribute("src","img/"+elemento.icono);                           // Asigno la ruta del icono usando el valor del JSON
                document.querySelector('main').appendChild(instancia);                      // Inserto la instancia clonada en el DOM, dentro de la etiqueta <main>
            });
            
            let aplicaciones = document.querySelectorAll(".aplicacion");                    // Selecciono todas las aplicaciones generadas (con clase "aplicacion")
            aplicaciones.forEach(function(aplicacion){                                      // Para cada aplicación generada
                aplicacion.onclick = function(){                                            // Asigno una función de clic a cada aplicación
                    window.location = "../supercontrolador/";                               // Redirijo a otra página al hacer clic en la aplicación
                }
            })
        })
}

