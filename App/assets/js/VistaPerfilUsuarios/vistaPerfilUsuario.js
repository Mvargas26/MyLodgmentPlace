document.addEventListener('DOMContentLoaded', function () {
    // Obtener el ID de usuario desde la URL
    var idUser = obtenerParametroUrl('idUser');
    console.log('ID de usuario:', idUser);

    // Obtener los detalles del usuario desde el servidor mediante una solicitud AJAX
    $.ajax({

        type: 'GET', // Cambiado a POST para que coincida con el lado del servidor
        url: '../../App/Modules/obtenerPerfilUsuarios/vistaPerfilUsuarios_Negocios.php',
        data: { idUser: idUser },
        dataType: 'json',
        success: function (userDetails) {
            // Verificar si userDetails es null o undefined
            if (userDetails && userDetails.fotoperfil) {
                // Llenar los detalles del usuario en la página
                $('#userProfileImage').attr('src', userDetails.fotoperfil);
                $('#userDetails').html(`
                    <h3>${userDetails.nombre} ${userDetails.apellido1} ${userDetails.apellido2}</h3>
                    <p><strong>Correo Electrónico:</strong> ${userDetails.correo || 'N/A'}</p>
                    <p><strong>Teléfono:</strong> ${userDetails.telefono || 'N/A'}</p>
                    <p><strong>Dirección:</strong> ${userDetails.direccion || 'N/A'}</p>
                    <!-- Agrega más detalles según sea necesario -->
                `);

                // Botones de activar/desactivar usuario
                var userOptions = $('.user-options');
                userOptions.html(`
                    <button id="activateUser">Activar Usuario</button>
                    <button id="deactivateUser">Desactivar Usuario</button>
                `);

                // Opciones de administrador
                var adminOptions = $('.admin-options');
                adminOptions.html(`
                    <h4>Opciones de Administrador:</h4>
                    <button id="validateIdentity">Validar Identidad</button>
                    <button id="validateSpace">Validar Espacio</button>
                    <button id="checkReports">Revisar Denuncias</button>
                    <button id="checkReviews">Revisar Reseñas</button>
                `);
            } else {
                console.error('Los detalles del usuario son nulos o indefinidos.');
                alert('Error al obtener los detalles del usuario. Por favor, inténtelo de nuevo más tarde.');
            }
        },
        error: function (xhr, status, error) {
            console.error('Error al obtener los detalles del usuario:', error);
            console.log(xhr.responseText); // Imprime la respuesta del servidor
            alert('Error al obtener los detalles del usuario. Por favor, inténtelo de nuevo más tarde.');
        }
    });

    // Función para obtener parámetros de la URL
    function obtenerParametroUrl(parametro) {
        var url = new URL(window.location.href);
        return url.searchParams.get(parametro);
    }
});

