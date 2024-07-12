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

                //var profileImage = $('<img>').attr('src', user.fotoperfil);
                var icono = document.createElement("i");
                icono.className = "bi bi-person-fill";
                icono.style.fontSize = "50px";
                icono.style.color = "#ff7f5d";
                // <i id="perfil" class="bi bi-person-fill"></i>

                userDiv.append(icono);

                var userDetails = $('<div class="user-details"></div>');

                userDetails.append('<br>');

                var userName = $('<div></div>').text(user.nombre + ' ' + user.apellido1 + ' ' + user.apellido2);
                userDetails.append(userName);

                var userCedula = $('<div class="user-cedula"></div>').text(user.idUser).hide();
                userDetails.append(userCedula);

                userDetails.append('<br>');

                var viewProfileButton = $('<button class="button-view-profile">Ver Perfil</button>');
                // Corrige la asignación del evento al botón actual, no al id fijo
                viewProfileButton.on('click', function () {
                    // Obtén el ID del usuario para redirigir a la página correspondiente
                    var idUser = user.idUser;
                    window.location.href = 'vistaPerfilUsuarios_View.php?idUser=' + idUser;
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
