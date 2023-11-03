    document.addEventListener("DOMContentLoaded", function () {
        console.log('entro');
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

            // Crea un objeto con los valores capturados
            const formData = {
                identificacion,
                nombre,
                primerApellido,
                segundoApellido,
                email,
                telefono
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
                    // La solicitud fue exitosa, puedes manejar la respuesta aquí
                    console.log(xhr.responseText);
                } else {
                    // La solicitud falló, maneja el error aquí
                    console.error("Error al enviar los datos al backend");
                }
            };
        });
    });

