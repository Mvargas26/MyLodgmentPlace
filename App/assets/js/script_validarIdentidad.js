$(document).ready(function () {
    $('#cedulaFromDatabase').text(identificacion);
    $('#nameFromDatabase').text(nombreUsu);
    var imageUrl = '../../App/assets/img/usuarios/' + identificacion + '.png';

    // Crea un elemento de imagen y establece la fuente
    var img = document.createElement('img');
    img.src = imageUrl; 
    // Agrega la imagen al contenedor
    $('#imageColumn').html(img);

    $.ajax({
        url: '../../App/Modules/Login/obtener_datosValidacionP_Negocios.php',
        type: 'POST',
        data: { Identificacion: identificacion },
        success: function (response) { 
            // Parsea la respuesta JSON 
            var data = JSON.parse(response);
            $('#estadoFromDatabase').text(data.estadoValidacion);
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
    $('#imageColumn').html(img);
    
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