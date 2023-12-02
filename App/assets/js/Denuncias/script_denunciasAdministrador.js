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
                $(this).html("<i class='bi bi-ui-checks'></i>");
            }
        }
    );

    // Capturar clic en el botón que abre el modal
    $('.btn-emoji').on('click', function () {
        hizoClic = true;
        var filaSeleccionada = $(this).closest('tr').data('fila');
        var idDenuncia = $('tr[data-fila=' + filaSeleccionada + '] td:nth-child(1)').text();
        var detallesDenunciaUsu = $('tr[data-fila=' + filaSeleccionada + '] td:nth-child(5)').text();
        var detallesDenunciaDenunciado = $('tr[data-fila=' + filaSeleccionada + '] td:nth-child(6)').text();
        // Actualizar el contenido del label dentro del modal
        $('#detalles1DLabel').text(detallesDenunciaUsu);
        $('#detalles2DLabel').text(detallesDenunciaDenunciado);
        $('#idDenuncia').prop('value', idDenuncia);
    });

    // Restablecer hizoClic cuando se cierra el modal
    $('#myModal').on('hidden.bs.modal', function () {
        hizoClic = false;
    });

    // Agrega un nuevo evento click para el botón "Enviar Denuncia"
    $('#btnEnviarDenuncia').on('click', function () {
        if (!hizoClic) {
            return; // Evitar ejecutar la lógica si no se hizo clic en el botón que abre el modal
        }

        var estadoDenuncia = $('#estadoDenuncia').val();
        var respuestaDenunciaAdm = $('#campo1').val();
        var idDenuncia = $('#idDenuncia').val();
        var veredicto = $('#veredicto').val();

        $.ajax({
            type: 'POST',
            url: '../../App/Modules/Denuncias/insertarAdministradorDenuncia_Negocios.php',
            data: {
                idDenuncia: idDenuncia,
                identificacionAdm: identificacion,
                RespuestaDenunciaAdmin: respuestaDenunciaAdm,
                estadoNuevo: estadoDenuncia,
                veredicto: veredicto,
            },
            success: function (response) {
                console.log(response);
                if (response) {
                    Swal.fire("Éxito", "Respuesta a Denuncia enviada correctamente", "success");
                }
            },
            error: function (error) {
                Swal.fire("Error", "Algo paso al momento de aceptar la denuncia", error);
            }
        });
    });
});
