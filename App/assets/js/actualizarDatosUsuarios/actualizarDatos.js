$(document).ready(function() {
    $('#btnGuardarDatos').on('click', function() {
        var nombre = $('#nameFromDatabase').val();
        var apellido1 = $('#apellido1').val();
        var apellido2 = $('#apellido2').val();
        var direccion = $('#updatedAddress').val();
        var telefono = $('#updatedPhoneNumber').val();
        var correo = $('#updatedEmail').val();

        
        $.ajax({
            type: 'POST',
            url: '../../App/Modules/actualizardatosusuarios/actualizarDatosUsuarios_Negocios.php',
            data: {

                actualizardatos: true,
                nombre: nombre,
                apellido1: apellido1,
                apellido2: apellido2,
                direccion: direccion,
                telefono: telefono,
                correo: correo

            },
            success: function(response) {
                alert(response);
                window.history.replaceState({}, document.title, window.location.href.split('?')[0]);
                location.reload();
                

            },
            error: function(xhr, status, error) {
                console.error('Error al actualizar datos:', error);
                alert('Error al actualizar datos. Por favor, inténtelo de nuevo más tarde.');
            }
        });
    });
});
