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
        const verificarClave = document.getElementById("verificarClave").value;
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
            verificarClave,
            nombre,
            primerApellido,
            segundoApellido,
            email,
            telefono,
            edad,
            direccion,
            idRol
        };

        var verificoContrasena = verificarContrasena(Clave,verificarClave);

        if (inputImagen.files && inputImagen.files[0] && verificoContrasena) {

            var file = inputImagen.files[0];

            var reader = new FileReader();
            reader.onload = function (e) {
                var imagenData = e.target.result;
                $.ajax({
                    url: "../../App/Modules/Registro/registro_Negocios.php",
                    type: "POST",
                    data: {
                        imagenData: imagenData,// se envia la imagen y lo que captura con data 
                        formData: formData
                    },
                    success: function (response) { // catura respuesta 
                        var x = JSON.parse(response);
                        if (x.exito == true) {
                            Swal.fire("Éxito", "Se guardaron los datos correctamente. " + x.nombre, "success");//mensaje bonito
                            setTimeout(function () {
                                location.href = "../../index.php";
                            },
                                2000);
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
$(document).ready(function () {
    $('.login-info-box').fadeOut();
    $('.login-show').addClass('show-log-panel');
});
$('.login-reg-panel input[type="radio"]').on('change', function () {
    if ($('#log-login-show').is(':checked')) {
        $('.register-info-box').fadeOut();
        $('.login-info-box').fadeIn();

        $('.white-panel').addClass('right-log');
        $('.register-show').addClass('show-log-panel');
        $('.login-show').removeClass('show-log-panel');

    }
    else if ($('#log-reg-show').is(':checked')) {
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
                formData: formData
            },
            success: function (response) { // catura respuesta 
                var x = JSON.parse(response);
                if (x.exito == true) {
                    Swal.fire("Éxito", "Bienvenido " + x.nombre, "success");//mensaje bonito
                    setTimeout(function () {
                        location.href = "../../index.php";
                    },
                        2000);
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

// const CargarServicios = {
//     init: function () {
//         // Realiza una solicitud GET al cargar la página
//         console.log("FUNCION Servicios")
//         const ObtenerServicios = {
//             ObtenerServicios: "ObtenerServicios"
//         };

//         $.ajax({
//             url: "../../App/Modules/Servicios/servicios_Negocios.php",
//             type: "POST",
//             data: {
//                 ObtenerServicios: ObtenerServicios
//             },
//             success: function (response) {
//                 console.log("Si esta entrando")

//                 if (Array.isArray(response)) {

//                     for (var i = 0; i < response.length; i++) {
//                         // Crea un nuevo label
//                         var nuevoLabel = document.createElement('label');
//                         nuevoLabel.className = 'containerServicios';
//                         // nuevoLabel.id = 'containerServicios';

//                         // Crea un nuevo input tipo hidden
//                         var nuevoInputID = document.createElement('input');
//                         nuevoInputID.type = 'hidden';
//                         nuevoInputID.id = 'IDServicio';
//                         nuevoInputID.value = response[i].id;
//                         nuevoInputID.className = 'hiddenInput'

//                         // Crea un nuevo input tipo checkbox
//                         var nuevoInputCheckbox = document.createElement('input');
//                         nuevoInputCheckbox.type = 'checkbox';
//                         nuevoInputCheckbox.checked = false;

//                         // Crea un nuevo span
//                         var nuevoSpan = document.createElement('span');
//                         nuevoSpan.className = 'checkmark';

//                         // Asigna el texto del label con el nombre del servicio
//                         nuevoLabel.innerText = response[i].nombre;

//                         // Agrega los elementos al label
//                         nuevoLabel.appendChild(nuevoInputID);
//                         nuevoLabel.appendChild(nuevoInputCheckbox);
//                         nuevoLabel.appendChild(nuevoSpan);

//                         // Agrega el label al contenedor grid
//                         document.querySelector('.grid').appendChild(nuevoLabel);

//                     }
//                 } else {
//                     console.error('La respuesta no es un array:', response);
//                 }


//             },
//             error: function (jqXHR, textStatus, errorThrown) {
//                 console.error('Error en la solicitud AJAX:', textStatus, errorThrown);
//             }
//         });
//     }
// };

document.addEventListener('DOMContentLoaded', function () {
    window.addEventListener('load', function () {


        // var hiddenInputs = document.querySelectorAll('.hiddenInput');

        // console.log(hiddenInputs);
        // console.log("SE ACTIVA EL SCRIPT DE LOS INPUT HIDDEN");
        // var valoresSeleccionados = [];

        // // Función para manejar el cambio en los checkboxes
        // function handleCheckboxChange(event) {

        //     // Encuentra el input hidden asociado al checkbox
        //     var hiddenInput = event.target.parentElement.querySelector('.hiddenInput');

        //     console.log("SE HIZO CLICK EN EL CHECKBOX");

        //     // Verifica si el checkbox está marcado o desmarcado
        //     if (event.target.checked) {
        //         // Si está marcado, agrega el valor al array
        //         valoresSeleccionados.push(hiddenInput.value);
        //     } else {
        //         // Si está desmarcado, elimina el valor del array
        //         var index = valoresSeleccionados.indexOf(hiddenInput.value);
        //         if (index !== -1) {
        //             valoresSeleccionados.splice(index, 1);
        //         }
        //     }

        //     var ArrayServicios = document.getElementById("ArrayServicios");

        //     ArrayServicios.value = JSON.stringify(valoresSeleccionados);
        //     console.log(valoresSeleccionados);
        // }


        // hiddenInputs.forEach(function (hiddenInput) {
        //     var checkbox = hiddenInput.parentElement.querySelector('input[type="checkbox"]');
        //     checkbox.addEventListener('change', handleCheckboxChange);
        // });
    });
});

// const vistaActual = document.body.dataset.vista;

// // Verifica si la vista actual es PublicarInmueble_View.php
// // Carga los Servicios de la base
// if (vistaActual === 'PublicarInmueble_View.php') {
//     window.addEventListener('load', function () {
//         CargarServicios.init();
//     });
// }
//###############################################################################################################################
//END SERVICIOS
//###############################################################################################################################

//###############################################################################################################################
//Notificaciones
//###############################################################################################################################
const CargarNotificaciones = {
    init: function () {
        // Realiza una solicitud GET al cargar la página
        console.log("FUNCION Notificaciones")
        const ObtenerNotificaciones = {
            ObtenerNotificaciones: "ObtenerNotificaciones"
        };


        $.ajax({
            url: "../../App/Modules/Notificaciones/notificaciones_Negocios.php",
            type: "POST",
            data: {
                ObtenerNotificaciones: ObtenerNotificaciones
            },
            success: function (response) {
                var respuestaJSON = JSON.parse(response);

                //esto llena el grid
                var tbody = document.querySelector('#GridAnunciosMultiples tbody');
                tbody.innerHTML = '';

                // Llena la tabla con los datos obtenidos de la consulta
                respuestaJSON.forEach(function (notificacion) {
                    var fila = '<tr>';
                    fila += '<td>' + notificacion.descripcion + '</td>';
                    fila += '<td>' + notificacion.fecha + '</td>';

                    fila += '</tr>';
                    tbody.innerHTML += fila;
                });

            },
            error: function (textStatus, errorThrown) {
                console.error('Error en la solicitud AJAX:', textStatus, errorThrown);
            }
        });
    }
};




//###############################################################################################################################
//inicio login
//###############################################################################################################################

$(document).ready(function () {
    $('#loginForm').submit(function (e) {
        e.preventDefault();

        // Obtener los datos del formulario
        var identificacion = $('input[name=identificacion]').val();
        var password = $('input[name=password]').val();

        $('#loginForm input[type=submit]').prop('disabled', true);


        // Validar campos
        if (!identificacion || !password) {
            Swal.fire("Error", "Por favor, complete todos los campos.", "error");
            return; // Detener la ejecución si hay campos vacíos
        }
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
                        text: "Credenciales válidas.",
                        icon: "success",
                        showCancelButton: false,
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "Aceptar"
                    }).then((result) => {
                        // Si el usuario hace clic en "Aceptar", redirige
                        if (result.isConfirmed) {
                            window.location.href = 'codigoAutenticacion_view.php';
                            // Enviar los datos de forma segura por POST
                            var form = $('<form action="codigoAutenticacion_view.php" method="post">' +
                                '<input type="hidden" name="identificacion" value="' + identificacion + '">' +
                                '<input type="hidden" name="password" value="' + password + '">' +
                                '</form>');
                            $('body').append(form);
                            form.submit();
                            window.history.replaceState({}, document.title, window.location.href.split('?')[0]);

                        }
                    });
                } else {
                    // Mostrar el mensaje de error Swal
                    $('#loginForm input[type=submit]').prop('disabled', false);
                    Swal.fire("Error", "Hubo un problema al verificar las credenciales. Por favor, inténtelo de nuevo más tarde.", "error");
                }
            },
            error: function () {
                alert('Error en la verificación de credenciales.');
                $('#loginForm input[type=submit]').prop('disabled', false);
            }
        });
    });
});

//###############################################################################################################################
//fin login
//###############################################################################################################################


//###############################################################################################################################
//inicio Codigo autenticacion de login
//###############################################################################################################################

$(document).ready(function () {
    $('#codigoAutenticacionForm').submit(function (e) {
        e.preventDefault();

        // Obtener el código ingresado
        var codigo = $('input[name=codigo]').val();
        var cedula = $('input[name=cedula]').val();
        var password = $('input[name=password]').val();


        // Realizar la verificación del código mediante AJAX
        $.ajax({
            type: 'POST',
            url: '../../App/Modules/CodigoAutenticacionLogin/codigoAutenticacion_Negocios.php',
            data: {
                verificarCodigo: true,
                codigo: codigo,
                cedula: cedula,
                password: password
            },
            dataType: 'json',
            success: function (response) {
                if (response.exito) {
                    Swal.fire("Éxito", "Bienvenido ", "success");//mensaje bonito
                    setTimeout(function () {
                        location.href = "../../index.php";
                    },
                        2000);
                } else {
                    // Mostrar el mensaje de error
                    Swal.fire("Error", "Código de autenticación inválido. Inténtelo de nuevo.", "error");
                }
            },
            error: function (xhr, status, error) {
                console.log(xhr);
                console.log(status);
                console.log(error);
                alert('Error en la verificación del código de autenticación.');
            }
        });
    });
});

//###############################################################################################################################
//fin Codigo autenticacion de login
//###############################################################################################################################

$(document).ready(function () {
    $('#ActualizarDatos').submit(function (e) {

        console.log("Entro");

        const nombre = document.getElementById("nameFromDatabase").value;
        const apellido1 = document.getElementById("apellido1").value;
        const apellido2 = document.getElementById("apellido2").value;
        const direccion = document.getElementById("updatedAddress").value;
        const telefono = document.getElementById("updatedPhoneNumber").value;
        const cedula = document.getElementById("updatedCedula").value;
        const email = document.getElementById("updatedEmail").value;


        console.log(nombre);
        console.log(apellido1);
        console.log(apellido2);
        console.log(direccion);
        console.log(telefono);
        console.log(cedula);
        console.log(email);

        // Realizar la solicitud AJAX
        $.ajax({
            type: 'POST',
            url: '../Modules/Master_Class.php',
            data: {
                nombre: nombre,
                apellido1: apellido1,
                apellido2: apellido2,
                direccion: direccion,
                telefono: telefono,
                cedula: cedula,
                email: email
            },
            success: function (response) {
                alert(response);
                $('#updateModal').modal('hide');
            },
            error: function (error) {
                console.error('Error al enviar la solicitud AJAX', error);
            }
        });

    });
});



//###############################################################################################################################
//dejar siempre de ultimo
// AQUI SE INICIALIZA CADA METODO
RegistroUsuarios.init();
Login.init();
//  CargarServicios.init();
//  CargarNotificaciones.init();



function verificarContrasena(contrasena,verificarContrasena){

    if (contrasena !=verificarContrasena) {
        
        Swal.fire("Error", "La contraseña y la confirmación no son iguales", "error");//mensaje bonito
        return false;
    }

    return true;

}