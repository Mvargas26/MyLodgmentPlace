    //###############################################################################################################################
    //Registro de usuarios
    //###############################################################################################################################
    const RegistroUsuarios = {
        init: function () {
            const form = document.getElementById("formRegistro");
    
            if (form) {
                form.addEventListener("submit", RegistroUsuarios.onSubmit);
            }
        },
        onSubmit: function (event) {
            event.preventDefault();
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
        }
    };
    //###############################################################################################################################
       //FUNCIONAMIENTO DEL LOGIN interactivo
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
    //###############################################################################################################################
    //Login
    //###############################################################################################################################
    const Login = {
        init: function () {
            var btnLogin = document.getElementById('btnLogin');
    
            if (btnLogin) {
                btnLogin.addEventListener('click', Login.onSubmit);
            }
        },
    
        onSubmit: function () {
            var identificacion = document.getElementById('identificacion').value;
            var password = document.getElementById('password').value;
    
            const formData = {
                identificacion,
                password
            };

            $.ajax({
                url: "../../App/Modules/Login/login_Negocios.php",
                type: "POST",
                data: {
                    formData:formData
                },
                success: function(response) { // catura respuesta 
                    var x = JSON.parse(response);
                    if (x.exito == true) {
                        Swal.fire("Éxito", "Bienvenido " + x.nombre, "success");//mensaje bonito


                        
                    } else {
                        console.log(x.response);
                        Swal.fire("Error", "Lo sentimos, ocurrió un error.", "error");
                    }
                }
            });
        }
    };
  
    const Servicios = {
        init: function () {
            // Realiza una solicitud GET al cargar la página
            console.log("FUNCION Servicios")
            const formData = {
                a : "a"
            };

            $.ajax({
                url: "../../App/Modules/Servicios/servicios_Negocios.php",
                type: "POST",
                success: function(response) 
                {a 

                    console.log("Si esta entrando")

                    if (Array.isArray(response)) {
                    
                        for (var i = 0; i < response.length; i++) 
                        {
                            // Crea un nuevo label
                            var nuevoLabel = document.createElement('label');
                            nuevoLabel.className = 'container';

                            // Crea un nuevo input tipo hidden
                            var nuevoInputID = document.createElement('input');
                            nuevoInputID.type = 'hidden';
                            nuevoInputID.id = 'IDServicio';
                            nuevoInputID.value = response[i].id;

                            // Crea un nuevo input tipo checkbox
                            var nuevoInputCheckbox = document.createElement('input');
                            nuevoInputCheckbox.type = 'checkbox';
                            nuevoInputCheckbox.checked = false;

                            // Crea un nuevo span
                            var nuevoSpan = document.createElement('span');
                            nuevoSpan.className = 'checkmark';

                            // Asigna el texto del label con el nombre del servicio
                            nuevoLabel.innerText = "                   " + response[i].nombre;

                            // Agrega los elementos al label
                            nuevoLabel.appendChild(nuevoInputID);
                            nuevoLabel.appendChild(nuevoInputCheckbox);
                            nuevoLabel.appendChild(nuevoSpan);

                            // Agrega el label al contenedor grid
                            document.querySelector('.grid').appendChild(nuevoLabel);

                        }                     
                    } else {
                        console.error('La respuesta no es un array:', x);
                    }


                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Error en la solicitud AJAX:', textStatus, errorThrown);
                }
            });
        }
    };

    const vistaActual = document.body.dataset.vista;

    // Verifica si la vista actual es anunciosMultiples_View.php
    // Carga los Servicios de la base
    if (vistaActual === 'anunciosMultiples_View.php') {
        window.addEventListener('load', function() {
            Servicios.init();
        });
    }
    
    // AQUI SE INICIALIZA CADA METODO
     RegistroUsuarios.init();
     Login.init();
     Servicios.init();