$(document).ready(function () {
    var hizoClic = false;

    $('.btn-emoji').hover(
        function () {
            if (!hizoClic) {
                $(this).html("<i class='bi bi-pen'></i>");
            }
        },
        function () {
            if (!hizoClic) {
                $(this).html("<i class='bi bi-shield-fill-exclamation'></i>");
            }
        }
    );

    // Capturar clic en el botón que abre el modal
    $('.btn-emoji').on('click', function () {
        hizoClic = true;
        var filaSeleccionada = $(this).closest('tr').data('fila');
        var idDenuncia = $('tr[data-fila=' + filaSeleccionada + '] td:nth-child(1)').text();
        var detallesDenuncia = $('tr[data-fila=' + filaSeleccionada + '] td:nth-child(5)').text();
         // Actualizar el contenido del label dentro del modal
        $('#detallesDLabel').text(detallesDenuncia);
        $('#idDenuncia').prop('value', idDenuncia);
    });

    // Restablecer hizoClic cuando se cierra el modal
    $('#myModal').on('hidden.bs.modal', function () {
        hizoClic = false;
    });
});

// Agrega un nuevo evento click para el botón "Enviar Denuncia"
$(document).on('click', '#btnEnviarDenuncia', function () {
    var idDenuncia = $('#idDenuncia').val();
    var respuestaDenunciaAnfi = $('#campo1').val();
    console.log(idDenuncia);
    $.ajax({
        type: 'POST',
        url: '../../App/Modules/Denuncias/modificarDenuncia_Denunciado_Negocios.php',
        data: { 
            respuesta: respuestaDenunciaAnfi,
            idDenuncia: idDenuncia,
        },
        success: function (response) {
            console.log(response);
            if (response.exito) {
                Swal.fire("Éxito", "Respuesta a Denuncia enviada correctamente", "success");
            }
        },
        error: function (error) {
            console.error(error);
        }
    });
});
