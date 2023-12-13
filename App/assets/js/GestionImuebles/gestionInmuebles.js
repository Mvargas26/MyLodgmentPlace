$(document).ready(function () {
    var formsValidarInmueble = $("[id^='formValidarInmueble']");

    formsValidarInmueble.each(function () {
        $(this).submit(function (event) {
            event.preventDefault();

            var idValidacionimueble = $(this).find('input[name="idValidacionimueble"]').val();
            var nuevoEstadoSelect = $(this).find('#nuevoEstado');
            var nuevoEstado = nuevoEstadoSelect.val();

            console.log("ID de Validación de Inmueble:", idValidacionimueble);
            console.log("Nuevo Estado:", nuevoEstado);

            enviarSolicitudAlServidorI(idValidacionimueble, nuevoEstado);
        });
    });
});

function enviarSolicitudAlServidorI(idValidacionimueble, nuevoEstado) {
    
    var datos = {
        idValidacionimueble: idValidacionimueble,
        nuevoEstado: nuevoEstado

    };

    $.ajax({
        type: "POST",
        url: "../../App/Modules/actualizarestado/actualizar_estado_Negocios.php",
        data:{

            estados: true,
            idValidacionimueble: idValidacionimueble,
            nuevoEstado: nuevoEstado
           
        },

        success: function (response) {
            
            location.reload();
            
        },

        error: function (xhr, status, error) {
            console.error("Error en la solicitud al servidor:", error);
            console.log(xhr);
            console.log(status);
            
        }
    });
}
