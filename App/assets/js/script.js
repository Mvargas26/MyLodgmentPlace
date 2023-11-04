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

            const formData = {
                identificacion,
                nombre,
                primerApellido,
                segundoApellido,
                email,
                telefono
            };

            if (inputImagen.files && inputImagen.files[0]) {

                var file = inputImagen.files[0];
        
                var reader = new FileReader();
                reader.onload = function(e) {
                    var imagenData = e.target.result;
                    $.ajax({
                        url: "../../App/Modules/Registro/registro_Negocios.php",
                        type: "POST",
                        data: {
                            imagenData: imagenData,
                            formData:formData
                        },
                        success: function(response) {
                            var x = JSON.parse(response);
                            if (x.exito == true) {
                                Swal.fire("Éxito", "Se guardaron los datos correctamente. " + x.nombre, "success");
                           
                            } else {
                                console.log(x.response);
                                Swal.fire("Error", "Lo sentimos, ocurrió un error.", "error");
                            }
                        }
                    });
                };
                reader.readAsDataURL(file);
            }
        });
    });

