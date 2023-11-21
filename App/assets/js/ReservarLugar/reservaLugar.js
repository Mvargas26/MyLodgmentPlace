$(document).ready(function() {
    $('#formReservarLugar').submit(function(e) {
        e.preventDefault();

        var idUsuario = $('#idUsuario').val();
        var idInmueble = $('#idInmueble').val();
        var cantidadPersonas = $('#cantidadPersonas').val();
        var cantidadPersonasExtra = $('#cantidadPersonasExtra').val();
        var fechaInicio = $('#fechaInicio').val();
        var fechaFin = $('#fechaFin').val();
        var Cupon = $('#Cupon').val();
        var valorTotal = $('#valorTotal').text(); // Cambiado de .val() a .text()
        var valorTotalImpuestos = $('#valorTotalImpuestos').text(); // Cambiado de .val() a .text()

        if (cantidadPersonas === '0') { // Corregida la validación
            alert("Debe ingresar la cantidad de personas.");
            return;
        }

        $.ajax({
            type: 'POST',
            url: '../../App/Modules/ReservaLugar/ReservaLugar_Negocios.php',
            data: {
                crearReserva: true,
                idUsuario: idUsuario,
                idInmueble: idInmueble,
                cantidadPersonas: cantidadPersonas,
                cantidadPersonasExtra: cantidadPersonasExtra,
                fechaInicio: fechaInicio,
                fechaFin: fechaFin,
                Cupon: Cupon,
                valorTotal: valorTotal,
                valorTotalImpuestos: valorTotalImpuestos
            },
            dataType: 'json',
            success: function(response) {
                if (response.exito) {
                    alert('¡Reserva creada exitosamente!');
                    $('#formEvento')[0].reset();
                    window.history.replaceState({}, document.title, window.location.href.split('?')[0]);
                } else {
                    alert('Hubo un error al reservar el lugar. Inténtelo de nuevo.');
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr);
                console.log(status);
                console.log(error);
                alert('Error en la solicitud. Por favor, inténtelo más tarde.');
            }
        });
    });
});