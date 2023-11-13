//###############################################################################################################################
//Inmueble Solo
//###############################################################################################################################

document.addEventListener('DOMContentLoaded', function () {
    var detailsLinks = document.querySelectorAll('.details-link');

    detailsLinks.forEach(function (link) {
        link.addEventListener('click', function (event) {
            event.preventDefault();

            // Obtener el ID del inmueble desde el atributo data-id
            var inmuebleId = link.getAttribute('data-id');
            console.log("El id es:  " + inmuebleId);

            // Llamar al script PHP utilizando AJAX
            $.ajax({
                url: "../../App/Modules/Inmueble/inmuebleSolo_Negocios.php",
                type: "POST",
                data: {
                    inmuebleSolo: inmuebleId
                },
                success: function (response) {
                    var respuestaJSON = JSON.parse(response);
                    console.log(respuestaJSON);  // Aquí puedes hacer algo con la respuesta del servidor
                },
                error: function (textStatus, errorThrown) {
                    console.error('Error en la solicitud AJAX:', textStatus, errorThrown);
                }
            });
        });
    });
}); 