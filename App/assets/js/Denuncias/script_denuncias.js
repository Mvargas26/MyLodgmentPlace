$(document).ready(function () {
    var filaSeleccionada;

    // Manejar clic en el botón de emoji
    $('.btn-emoji').on('click', function () {
        filaSeleccionada = $(this).closest('tr').data('fila');
    });

    // Manejar clic en el botón "Enviar Denuncia"
    $('.btn-primary').on('click', function () {
        // Obtener datos de la fila seleccionada
        var idUsuario = $('tr[data-fila=' + filaSeleccionada + '] td:nth-child(1)').text();
        var idPropietario = $('tr[data-fila=' + filaSeleccionada + '] td:nth-child(2)').text();

        // Obtener datos del modal
        var tipoDenuncia = $('#tipoDenuncia').val();
        var detallesDenuncia = $('#campo1').val();

        $.ajax({
            type: 'POST',
            url: '../../App/Modules/Denuncias/insertarDenuncias_Negocios.php',
            data: {
                denuncia: true,
                idUsuario: idUsuario,
                idPropietario: idPropietario,
                tipoDenuncia: tipoDenuncia,
                detallesDenuncia: detallesDenuncia,
                Correo: correo,
            },
            success: function (response) {
                console.log(response);
                if (response) {
                    Swal.fire("Éxito", "Denuncia enviada correctamente", "success");
                }
             },
            error: function (error) {
                Swal.fire("Error", "Algo paso al momento de insertar la denuncia", error);
            }
        });
    });
});