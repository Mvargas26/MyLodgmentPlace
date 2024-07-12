$(document).ready(function() {
    $('#correoForm').submit(function(e) {
        e.preventDefault(); // Evita que el formulario se envíe de forma tradicional

        // Captura de datos del formulario
        var id = $('input[name="idCorreo"]').val();
        var host = $('input[name="host"]').val();
        var usuario = $('input[name="usuario"]').val();
        var password = $('input[name="password"]').val();
        var puerto = $('input[name="puerto"]').val();

        // Envío de datos mediante Ajax
        $.ajax({
            type: 'POST',
            url: '../../App/Modules/GestionarCorreo/gestionCorreos_Negocios.php',  
            data: {
                Accion: 'modificar',  
                datos: JSON.stringify({
                    Id: id,
                    Host: host,
                    Usuario: usuario,
                    Contra: password,
                    Puerto: puerto
                })
            },
            success: function(response) {
                console.log(response);

                if (response) {
                    Swal.fire("Éxito", "Datos enviados correctamente", "success");
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
