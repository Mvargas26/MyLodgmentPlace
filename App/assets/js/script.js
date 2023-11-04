    document.addEventListener("DOMContentLoaded", function () {
        
        const form = document.getElementById("formRegistro");

        form.addEventListener("submit", function (event) {
            event.preventDefault(); // Evita que el formulario se envíe de forma predeterminada

            // Captura los valores del formulario
            const identificacion = document.getElementById("identificacion").value;
            const nombre = document.getElementById("nombre").value;
            const primerApellido = document.getElementById("primerApellido").value;
            const segundoApellido = document.getElementById("segundoApellido").value;
            const email = document.getElementById("email").value;
            const telefono = document.getElementById("telefono").value;
            const inputImagen = document.getElementById("fotoPerfil");
            var fotoPerfil = null;
            
            //Tratamiento imagen
           if (inputImagen.files && inputImagen.files[0]) {
            var file = inputImagen.files[0];

            var reader = new FileReader();
            reader.onload = function (e) {
                fotoPerfil = e.target.result; 
            };
            reader.readAsDataURL(file);
            };
            // Crea un objeto con los valores capturados
            const formData = {
                identificacion,
                nombre,
                primerApellido,
                segundoApellido,
                email,
                telefono,
                fotoPerfil
            };
            // Envía los datos al backend mediante una solicitud AJAX
            const xhr = new XMLHttpRequest();
            xhr.open("POST",
             "../../App/Modules/Registro/registro_Negocios.php",
              true);
            xhr.setRequestHeader("Content-Type", "application/json");
            xhr.send(JSON.stringify(formData));

            xhr.onload = function () {
                if (xhr.status === 200) {
                    try {
                        const response = JSON.parse(xhr.responseText);
                        console.log(response.message); 
                        console.log("Nombre recibido: " + response.nombre);
                    } catch (error) {
                        console.error("Error al analizar la respuesta JSON del servidor");
                    }
                } else {
                    // La solicitud falló, maneja el error aquí
                    console.error("Error al enviar los datos al backend");
                }
            };
        });
    });

