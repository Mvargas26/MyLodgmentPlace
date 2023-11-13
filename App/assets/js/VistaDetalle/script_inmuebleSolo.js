//###############################################################################################################################
//Inmueble Solo
//###############################################################################################################################
$(document).ready(function () {
    // Obtener el nombre del inmueble de la URL
    var nombreInmueble = "<?php echo $nombreInmueble; ?>";
    console.log(nombreInmueble);
    // Realizar la solicitud AJAX
    $.ajax({
        url: '../../App/Modules/Inmueble/inmuebleSolo_Negocios.php',
        type: 'POST',
        data: { nombreInmueble: nombreInmueble },
        success: function (response) {
            var data = JSON.parse(response);
            console.log(data);
            // Mostrar los datos en la página
            // $('#nombreInmueble').text(data.Nombre_Inmueble);
            // $('#capacidadPersonas').text(data.capacidadPersonas);
            // $('#direccion').text(data.direccion);
            // $('#disponibilidad').text(data.disponibilidad);
            // $('#estrellas').text(data.estrellas);
            // $('#fechaLimiteDisponibilidad').text(data.fechaLimiteDisponibilidad);
            // $('#nombrePropietario').text(data.nombre_propietario);
            // $('#caracteristica1').text(data.caracteristica1);
            // $('#caracteristica2').text(data.caracteristica2);
            // $('#caracteristica3').text(data.caracteristica3);
        },
        error: function (textStatus, errorThrown) {
            console.error('Error en la solicitud AJAX:', textStatus, errorThrown);
        }
    });
});
