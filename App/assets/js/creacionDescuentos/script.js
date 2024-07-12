$(document).ready(function() {
    $('#formCrearCupon').submit(function(e) {
        e.preventDefault();

        // Obtener datos del formulario
        var nombreCupon = $('#nombreCupon').val();
        var montoDescuento = $('#montoDescuento').val();
        var cantidadCupones = $('#cantidadCupones').val();
        var fechaVencimiento = $('#fechaVencimiento').val();
        var tipoDescuento = $('#tipoDescuento').val();
        var idInmueble = $('#nombreInmueble').val();

        // Validar que los campos no estén vacíos
        if (montoDescuento === '' || cantidadCupones === '' || fechaVencimiento === '' || tipoDescuento === '') {
            alert("Por favor, complete todos los campos.");
            return;
        }

        // Validación de montos numéricos
        if (!(/^\d+$/.test(montoDescuento)) || !(/^\d+$/.test(cantidadCupones))) {
            alert("Por favor, ingrese valores numéricos válidos en los campos de monto y cantidad de cupones.");
            return;
        }

        // Validación de fechas
        var hoy = new Date().toISOString().split('T')[0];
        if (fechaVencimiento <= hoy) {
            alert("La fecha de vencimiento debe ser posterior a la fecha actual.");
            return;
        }

        // Validación de porcentaje máximo
        if (tipoDescuento === '1' && montoDescuento > 30) {
            alert("El descuento máximo permitido es del 30%.");
            return;
        }

        // Validación de cantidad máxima de cupones
        if (cantidadCupones > 200) {
            alert("La cantidad máxima de cupones permitida es 200.");
            return;
        }

        // Enviar datos al servidor para crear el cupón
        $.ajax({
            type: 'POST',
            url: '../../App/Modules/creacionDescuentos/creacion_Descuentos_Negocios.php',
            data: {
                crearCupon: true,
                nombreCupon: nombreCupon,
                montoDescuento: montoDescuento,
                cantidadCupones: cantidadCupones,
                fechaVencimiento: fechaVencimiento,
                tipoDescuento: tipoDescuento,
                idInmueble: idInmueble // Incluir el ID del inmueble
            },
            dataType: 'json',
            success: function(response) {
                if (response) {
                    alert('¡Cupón creado exitosamente!');
                    //reinicia los campos del formulario
                    $('#formCrearCupon')[0].reset();
                    // sirve para reiniciar el url sin los ultimos valores
                    window.history.replaceState({}, document.title, window.location.href.split('?')[0]);
                    // Otras acciones después de crear el cupón si es necesario
                } else {
                    alert('Hubo un error al crear el cupón. Inténtelo de nuevo.');
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