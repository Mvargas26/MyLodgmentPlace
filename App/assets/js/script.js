    //###############################################################################################################################
    //###############################################################################################################################
       //FUNCIONAMIENTO DEL EMTODO ENVIAR IMAGENES
    //###############################################################################################################################
    //###############################################################################################################################
    document.addEventListener("DOMContentLoaded", function () {
        
        const form = document.getElementById("formRegistro");

        form.addEventListener("submit", function (event) {
            event.preventDefault(); // Evita que el formulario se envíe de forma predeterminada

            // Captura los valores del formulario
            const identificacion = document.getElementById("identificacion").value;
            const Clave = document.getElementById("Clave").value;
            const nombre = document.getElementById("nombre").value;
            const primerApellido = document.getElementById("primerApellido").value;
            const segundoApellido = document.getElementById("segundoApellido").value;
            const email = document.getElementById("email").value;
            const telefono = document.getElementById("telefono").value;
            const inputImagen = document.getElementById("fotoPerfil");
            const idRol = document.getElementById("idRol").value;
            const edad = document.getElementById("edad").value;
            const direccion = document.getElementById("direccion").value;
            var fotoPerfil = null;

            const formData = {
                identificacion,
                Clave,
                nombre,
                primerApellido,
                segundoApellido,
                email,
                telefono,
                edad,
                direccion,
                idRol
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
                            imagenData: imagenData,// se envia la imagen y lo que captura con data 
                            formData:formData
                        },
                        success: function(response) { // catura respuesta 
                            var x = JSON.parse(response);
                            if (x.exito == true) {
                                Swal.fire("Éxito", "Se guardaron los datos correctamente. " + x.nombre, "success");//mensaje bonito
                           
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
//###############################################################################################################################
    //###############################################################################################################################
       //FUNCIONAMIENTO DEL LOGIN interactivo
    //###############################################################################################################################
    //###############################################################################################################################
    
    $(document).ready(function(){
        $('.login-info-box').fadeOut();
        $('.login-show').addClass('show-log-panel');
    });
    $('.login-reg-panel input[type="radio"]').on('change', function() {
        if($('#log-login-show').is(':checked')) {
            $('.register-info-box').fadeOut(); 
            $('.login-info-box').fadeIn();
            
            $('.white-panel').addClass('right-log');
            $('.register-show').addClass('show-log-panel');
            $('.login-show').removeClass('show-log-panel');
            
        }
        else if($('#log-reg-show').is(':checked')) {
            $('.register-info-box').fadeIn();
            $('.login-info-box').fadeOut();
            
            $('.white-panel').removeClass('right-log');
            
            $('.login-show').addClass('show-log-panel');
            $('.register-show').removeClass('show-log-panel');
        }
    });