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
                        // Redireccionar al index.php después del mensaje de éxito
                    window.location.href = "../../../index.php";


                        
                    } else {
                        console.log(x.response);
                        Swal.fire("Error", "Lo sentimos, ocurrió un error.", "error");
                    }
                }
            });
        }
    };
  
    //###############################################################################################################################
    //SERVICIOS
    //###############################################################################################################################

    const CargarServicios = {
        init: function () {
            // Realiza una solicitud GET al cargar la página
            console.log("FUNCION Servicios")
            const ObtenerServicios = {
                ObtenerServicios : "ObtenerServicios"
            };

            $.ajax({
                url: "../../App/Modules/Servicios/servicios_Negocios.php",
                type: "POST",
                data:{
                    ObtenerServicios: ObtenerServicios
                },
                success: function(response) 
                {
                    console.log("Si esta entrando")

                    if (Array.isArray(response)) {
                    
                        for (var i = 0; i < response.length; i++) 
                        {
                            // Crea un nuevo label
                            var nuevoLabel = document.createElement('label');
                            nuevoLabel.className = 'containerServicios';
                            // nuevoLabel.id = 'containerServicios';

                            // Crea un nuevo input tipo hidden
                            var nuevoInputID = document.createElement('input');
                            nuevoInputID.type = 'hidden';
                            nuevoInputID.id = 'IDServicio';
                            nuevoInputID.value = response[i].id;
                            nuevoInputID.className = 'hiddenInput'

                            // Crea un nuevo input tipo checkbox
                            var nuevoInputCheckbox = document.createElement('input');
                            nuevoInputCheckbox.type = 'checkbox';
                            nuevoInputCheckbox.checked = false;

                            // Crea un nuevo span
                            var nuevoSpan = document.createElement('span');
                            nuevoSpan.className = 'checkmark';

                            // Asigna el texto del label con el nombre del servicio
                            nuevoLabel.innerText = response[i].nombre;

                            // Agrega los elementos al label
                            nuevoLabel.appendChild(nuevoInputID);
                            nuevoLabel.appendChild(nuevoInputCheckbox);
                            nuevoLabel.appendChild(nuevoSpan);

                            // Agrega el label al contenedor grid
                            document.querySelector('.grid').appendChild(nuevoLabel);

                        }
                    } else {
                        console.error('La respuesta no es un array:', response);
                    }


                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Error en la solicitud AJAX:', textStatus, errorThrown);
                }
            });
        }
    };

        document.addEventListener('DOMContentLoaded', function () {
            window.addEventListener('load', function(){
                // Obtén todos los elementos con la clase 'hiddenInput'
                var hiddenInputs = document.querySelectorAll('.hiddenInput');
                
                console.log(hiddenInputs);
                // Array para almacenar los valores seleccionados
                var valoresSeleccionados = [];

                // Función para manejar el cambio en los checkboxes
                function handleCheckboxChange(event) {
                // Encuentra el input hidden asociado al checkbox
                var hiddenInput = event.target.parentElement.querySelector('.hiddenInput');
                
                // Verifica si el checkbox está marcado o desmarcado
                if (event.target.checked) {
                    // Si está marcado, agrega el valor al array
                    valoresSeleccionados.push(hiddenInput.value);
                } else {
                    // Si está desmarcado, elimina el valor del array
                    var index = valoresSeleccionados.indexOf(hiddenInput.value);
                    if (index !== -1) {
                    valoresSeleccionados.splice(index, 1);
                    }
                }

                // Muestra el array en la consola (puedes quitar esto en tu versión final)
                console.log(valoresSeleccionados);
                }

                // Asigna el manejador de eventos a cada checkbox
                hiddenInputs.forEach(function (hiddenInput) {
                var checkbox = hiddenInput.parentElement.querySelector('input[type="checkbox"]');
                checkbox.addEventListener('change', handleCheckboxChange);
                });
            });
        });
    

    const vistaActual = document.body.dataset.vista;

    // Verifica si la vista actual es anunciosMultiples_View.php
    // Carga los Servicios de la base
    if (vistaActual === 'anunciosMultiples_View.php') {
        window.addEventListener('load', function() {
            CargarServicios.init();
        });
    }
    //###############################################################################################################################
    //otro
    //###############################################################################################################################

    $(document).ready(function () {
        $('#loginForm').submit(function (e) {
            e.preventDefault();
    
            // Obtener los datos del formulario
            var identificacion = $('input[name=identificacion]').val();
            var password = $('input[name=password]').val();
    
            // Realizar la verificación de credenciales mediante AJAX
            $.ajax({
                
                type: 'POST',
                url: '../../App/Modules/Servicios/Login_Negocios.php',
                data: {
                    verificarCredenciales: true,
                    identificacion: identificacion,
                    password: password
                },
                dataType: 'json', // Indicar que esperamos un JSON como respuesta
                success: function (response) {
                    if (response.exito) {
                        // Mostrar el mensaje Swal
                        Swal.fire({
                            title: "Éxito",
                            text: "Se ha iniciado sesión correctamente.",
                            icon: "success",
                            showCancelButton: false,
                            confirmButtonColor: "#3085d6",
                            confirmButtonText: "Aceptar"
                        }).then((result) => {
                            // Si el usuario hace clic en "Aceptar", redirige
                            if (result.isConfirmed) {
                                window.location.href = 'codigoAutenticacion_view.php';
                            }
                        });
                    } else {
                        // Mostrar el mensaje de error Swal
                        Swal.fire("Error", "Lo sentimos, sus credenciales son inválidas. Inténtelo de nuevo.", "error");
                    }
                },
                error: function () {
                    alert('Error en la verificación de credenciales.');
                }
            });
        });
    });

    //###############################################################################################################################
    //inicio pruebas de login
    //###############################################################################################################################



    //###############################################################################################################################
    //fin pruebas de login
    //###############################################################################################################################



    //###############################################################################################################################
    //dejar siempre de ultimo
    // AQUI SE INICIALIZA CADA METODO
     RegistroUsuarios.init();
     Login.init();
     CargarServicios.init();