$(document).ready(function() {
    $('#nuevoMensajeBtn').click(function(e) {
        e.preventDefault(); // Evita que el formulario se envíe de forma tradicional

        // Captura de datos del formulario
        var mensaje = $('#mensaje').val();
        var tipoM = $('#tipoMensaje').val();

        // Envío de datos mediante Ajax
        $.ajax({
            type: 'POST',
            url: '../../App/Modules/GestionarCorreo/gestionMensajes_Negocios.php',
            data: {
                Accion: 'insertar',
                datos: JSON.stringify({
                    Mensaje: mensaje,
                    TipoM: tipoM,
                })
            },
            success: function(response) {
                console.log(response);

                if (response) {
                    Swal.fire("Éxito", "Mensaje insertado correctamente", "success");
                } else {
                    Swal.fire("Error", "No se pudo insertar la información", "error");
                }
            },
            error: function(error) {
                console.log(error);
                Swal.fire("Error", "Algo pasó al enviar los datos", "error");
            }
        });
    });
});

$(document).ready(function() {
    $('#modificarMensajeBtn').click(function(e) {
        e.preventDefault(); // Evita que el formulario se envíe de forma tradicional

        // Captura de datos del formulario
        var id = $('#idM').val();
        var mensaje = $('#mensajeM').val();
        var tipoM = $('#tipoMensajeM').val(); 
        // Envío de datos mediante Ajax
        $.ajax({
            type: 'POST',
            url: '../../App/Modules/GestionarCorreo/gestionMensajes_Negocios.php',
            data: {
                Accion: 'modificar',
                datos: JSON.stringify({
                    ID: id,
                    Mensaje: mensaje,
                    TipoM: tipoM,
                })
            },
            success: function(response) {
                console.log(response);
        
                // Verificar si la respuesta contiene algún elemento (indicando éxito)
                if (response) {
                    Swal.fire("Éxito", "Mensaje actualizado correctamente", "success");
                } else {
                    Swal.fire("Error", "No se pudo actualizar la información", "error");
                }
            },
            error: function(error) {
                console.log(error);
                Swal.fire("Error", "Algo pasó al enviar los datos", "error");
            }
        });
    });
});

$(document).ready(function() {
    $('#eliminarMensajeBtn').click(function(e) {
        e.preventDefault(); // Evita que el formulario se envíe de forma tradicional

        // Captura de datos del formulario
        var id = $('#idE').val(); 
        // Envío de datos mediante Ajax
        $.ajax({
            type: 'POST',
            url: '../../App/Modules/GestionarCorreo/gestionMensajes_Negocios.php',
            data: {
                Accion: 'eliminar',
                datos: JSON.stringify({
                    ID: id,  
                })
            },
            success: function(response) {
                console.log(response);
        
                // Verificar si la respuesta contiene algún elemento (indicando éxito)
                if (response) {
                    Swal.fire("Éxito", "Mensaje eliminado correctamente", "success");
                } else {
                    Swal.fire("Error", "No se pudo eliminar la información", "error");
                }
            },
            error: function(error) {
                console.log(error);
                Swal.fire("Error", "Algo pasó al enviar los datos", "error");
            }
        });
    });
});