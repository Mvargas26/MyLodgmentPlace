$(document).ready(function () {
    // Obtener la lista de usuarios desde el servidor mediante una solicitud AJAX
    $.ajax({
        type: 'POST',
        url: '../../App/Modules/obtenerPerfilUsuarios/get_usersPerfil_Negocios.php',
        dataType: 'json',
        success: function (userList) {
            var userContainer = $('.user-list');
            userContainer.empty(); // Limpiar contenido existente

            userList.forEach(function (user) {
                var userDiv = $('<div class="user"></div>');

                var profileImage = $('<img>').attr('src', user.fotoperfil);
                userDiv.append(profileImage);

                var userDetails = $('<div class="user-details"></div>');

                var userName = $('<div></div>').text(user.nombre + ' ' + user.apellido1 + ' ' + user.apellido2);
                userDetails.append(userName);

                var viewProfileButton = $('<button class="button-view-profile">Ver Perfil</button>');
                viewProfileButton.on('click', function () {
                    alert('Ver perfil de ' + user.nombre);
                });

                userDetails.append(viewProfileButton);

                userDiv.append(userDetails);
                userContainer.append(userDiv);
            });
        },
        error: function (xhr, status, error) {
            console.error('Error al obtener la lista de usuarios:', error);
            console.log(xhr);
            console.log(status);
            console.log(error);

            alert('Error al obtener la lista de usuarios. Por favor, inténtelo de nuevo más tarde.');
        }
    });
});
