$(document).ready(function () {
    // Realiza una petición AJAX para obtener la ruta de la imagen

    $('#cedulaFromDatabase').text(identificacion);
    $('#nameFromDatabase').text(nombreUsu);
    $.ajax({
        url: '../../App/Modules/Login/obtener_ImagenesUsu_Negocios.php', // Ruta a tu script PHP para obtener la ruta de la imagen
        type: 'GET',
        success: function (response) {
            var data = JSON.parse(response);

            // Verifica si se obtuvo la ruta de la imagen
            if (data.rutaImagen) {
                // Muestra la imagen en la página
                var imageUrl = data.rutaImagen;
                var img = document.createElement('img');
                img.src = imageUrl;

                // Agrega la imagen al contenedor
                $('#imageContainer').html(img);
            } else {
                // Muestra un mensaje si no se encuentra la imagen
                console.error('Error: ' + data.error);
            }
        },
        error: function (textStatus, errorThrown) {
            console.error('Error en la solicitud AJAX:', textStatus, errorThrown);
        }
    });
});


$('#fileInput').on('change', function () {
    var fileName = $(this).val().split('\\').pop();
    $('#uploadLabel').text('Archivo Seleccionado: ' + fileName);
});

function guardarDatos() {
    var imageUrl = URL.createObjectURL($("#fileInput")[0].files[0]);
    // Crear un elemento de imagen y establecer la fuente
    var img = document.createElement('img');
    img.src = imageUrl;

    // Agregar la imagen al contenedor
    $('#imageContainer').html(img);

    // Mostrar la alerta
    alert("Se subió la foto correctamente. En proceso de validación.");

    // Cierra el modal después de guardar datos
    $('#uploadModal').modal('hide');

    // Agregar AJAX para cerrar el modal sin mostrar transición
    $.ajax({
        url: '../../App/Modules/Login/validarPerfil_Negocios.php',
        type: 'POST',
        data: { imagen: identificacion },
        success: function (response) {
            console.log(response);
        }
    });
}