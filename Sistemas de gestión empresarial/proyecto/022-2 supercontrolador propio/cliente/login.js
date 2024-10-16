window.onload = function(){ 
    console.log("Javascript cargado");  // Mensaje en la consola para indicar que el archivo Javascript ha sido cargado

    document.querySelector("#login").onclick = function(){ 
        console.log("Has pulsado el boton");  // Mensaje en consola al hacer clic en el botón de login

        let usuario = document.querySelector("#usuario").value;  // Obtiene el valor del campo "usuario"
        let contrasena = document.querySelector("#contrasena").value;  // Obtiene el valor del campo "contraseña"
        console.log(usuario, contrasena);  // Imprime el usuario y la contraseña en la consola

        let envio = {"usuario":usuario, "contrasena":contrasena};  // Crea un objeto con los datos de usuario y contraseña
        console.log(envio);  // Imprime el objeto "envio" en la consola

        // Me conecto a un microservicio y le envío la información json en POST
        fetch("../servidor/loginusuario.php?usuario="+usuario+"&contrasena="+contrasena)  // Realiza una petición a un servicio PHP enviando los datos del usuario y contraseña
        .then(response => {
            return response.json();  // Convierte la respuesta a formato JSON
        })
        .then(data => {
            console.log('Success:', data);  // Imprime en consola el JSON recibido para verificar que la comunicación es correcta

            if(data.resultado == 'ok'){  // Si el servidor devuelve "ok", el login fue satisfactorio
                console.log("Entras correctamente");  // Muestra mensaje de login exitoso en consola
                localStorage.setItem('crimson_usuario', data.usuario);  // Guarda el usuario en localStorage para recordarlo

                document.querySelector("#feedback").style.color = "green";  // Cambia el color del mensaje a verde
                document.querySelector("#feedback").innerHTML = "Acceso correcto. Redirigiendo en 5 segundos...";  // Muestra mensaje de éxito

                setTimeout(function(){ 
                    window.location = "escritorio/index.html";  // Redirige al escritorio tras 5 segundos
                }, 5000);
            } else {
                console.log("Error al entrar");  // Muestra mensaje de error en consola si el login falla
                document.querySelector("#feedback").style.color = "red";  // Cambia el color del mensaje a rojo
                document.querySelector("#feedback").innerHTML = "Usuario incorrecto. Redirigiendo en 5 segundos...";  // Muestra mensaje de error

                setTimeout(function(){ 
                    window.location = window.location;  // Recarga la página después de 5 segundos
                }, 5000);
            }
        });
    }
}

