$(document).ready(function () {
    function ajustarMargenInferior() {
        var alturaFooter = $('footer').outerHeight(true);
        $('.contenedor-principal > .contenedor:last-child').css('margin-bottom', alturaFooter + 'px');
    }

    $('.contenedor').click(function () {
        var formulario = $(this).find('.formulario');
        var alturaFormulario = formulario.outerHeight(true);
        var contenedor = $(this);

        // Muestra u oculta el formulario con una animación suave
        formulario.stop().slideToggle({
            duration: 500,
            progress: function () {
                // Durante la animación, ajusta el margen inferior
                ajustarMargenInferior();
            },
            complete: function () {
                // Después de completar la animación, ajusta el margen inferior nuevamente
                ajustarMargenInferior();

                // Ajusta la altura del contenedor al hacer clic
                contenedor.animate({ height: formulario.is(':visible') ? alturaFormulario + 60 : 50 }, 500); // 60 es un valor ajustable

                // Cambia el enfoque al textarea al hacer clic en el contenedor
                formulario.find('textarea').focus();
            }
        });
    });

    // Controlador de eventos para evitar la propagación del clic dentro del formulario
    $('.formulario').click(function (event) {
        event.stopPropagation();
    });

    // Botón para cerrar el formulario
    $('#cerrarFormularioBtn').click(function () {
        // Oculta el formulario y ajusta el margen inferior
        $('.formulario').slideUp(500, function () {
            ajustarMargenInferior();
        });
    });

    // Ajustar el margen inferior en la carga de la página
    ajustarMargenInferior();

    // Ajustar el margen inferior cuando cambia el tamaño de la ventana
    $(window).resize(function () {
        ajustarMargenInferior();
    });
}); 

$(document).ready(function() {
    // Delegación de eventos para el cambio en el select de tipo de mensaje
    $(document).on('change', '#tipoMensaje', function() {
        // Obtener los datos del elemento seleccionado
        var selectedOption = $(this).find('option:selected');
        var idM = selectedOption.data('id');
        var mensajeM = selectedOption.data('mensaje');
        var tipoMensajeM = selectedOption.data('tipo-mensaje');

        // Asignar valores a los campos correspondientes
        $('#idM').val(idM);
        $('#mensajeM').val(mensajeM);
        $('#tipoMensajeM').val(tipoMensajeM);
    });
});

$(document).ready(function() {
    // Delegación de eventos para el cambio en el select de tipo de mensaje
    $(document).on('change', '#tipoMensajeEl', function() {
        // Obtener los datos del elemento seleccionado
        var selectedOption = $(this).find('option:selected');
        var idM = selectedOption.data('id');
        var mensajeM = selectedOption.data('mensaje');
        var tipoMensajeM = selectedOption.data('tipo-mensaje');

        // Asignar valores a los campos correspondientes
        $('#idE').val(idM);
        $('#mensajeE').val(mensajeM);
        $('#tipoMensajeE').val(tipoMensajeM);
    });
});