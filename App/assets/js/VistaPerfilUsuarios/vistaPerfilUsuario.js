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

                $('#userProfileImage').css({
                    'width': '100%',  // Ajusta el ancho según tus preferencias
                    'height': '250px'  // Ajusta la altura según tus preferencias
                });

                $('#userDetails').html(`
                    <h3>${userDetails.nombre} ${userDetails.apellido1} ${userDetails.apellido2}</h3>
                    <p><strong>Correo Electrónico:</strong> ${userDetails.correo || 'N/A'}</p>
                    <p><strong>Teléfono:</strong> ${userDetails.telefono || 'N/A'}</p>
                    <p><strong>Dirección:</strong> ${userDetails.direccion || 'N/A'}</p>
                    <!-- Agrega más detalles según sea necesario -->
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

     // Asocia eventos de clic a cada botón
     $('#validarIdentidadBtn').on('click', function () {
        redirigirAotraPagina('vista_validarIdentidad_adm_View.php', idUser);
    });

    $('#validarEspacioBtn').on('click', function () {
        redirigirAotraPagina('vista_validarEspacio_adm_View.php', idUser);
    });

    $('#denunciasBtn').on('click', function () {
        redirigirAotraPagina('denuncias_porusuario_View.php', idUser);
    });

    $('#activarUsuarioBtn').on('click', function () {
        redirigirAotraPagina('ruta_activar_usuario.php', idUser);
    });

    $('#inactivarUsuarioBtn').on('click', function () {
        redirigirAotraPagina('ruta_inactivar_usuario.php', idUser);
    });

    
    function redirigirAotraPagina(ruta, idUser) {
    
        window.location.href = `${ruta}?idUser=${idUser}`;
    }

    // Función para obtener parámetros de la URL
    function obtenerParametroUrl(parametro) {
        var url = new URL(window.location.href);
        return url.searchParams.get(parametro);
    }
});

