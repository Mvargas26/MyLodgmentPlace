$(document).ready(function () {
    // Obtener el ID del usuario desde la URL
    var idUser = obtenerParametroUrl('idUser');
    console.log('ID de usuario:', idUser);
    
    $.ajax({
        type: 'POST',
        url: '../../App/Modules/obtenerInmuebles/inmueblesPorPropietario_Negocios.php',
        data: { idUser: idUser },
        dataType: 'json',
        success: function (inmuebleList) {
            var inmuebleContainer = $('.inmueble-list');
            inmuebleContainer.empty(); // Limpiar contenido existente

            if (inmuebleList.length > 0) {
                // Crear la lista <ul>
                var inmuebleContainer = $('<ul class="cards"></ul>');
            
                inmuebleList.forEach(function (inmueble) {
                    var inmuebleDiv = $('<li class="cards__item"><div class="card"><div class="card__image card__image--fence"></div><div class="card__content"></div></div></li>');
                    
                    // Nombre del inmueble
                    var inmuebleName = $('<div class="card__title"></div>').text(inmueble.nombre);
                    inmuebleDiv.find('.card__content').append(inmuebleName);
            
                    // Otros detalles del inmueble
                    var inmuebleDisponibilidad = $('<p></p>').text('Disponibilidad: ' + inmueble.disponibilidad);
                    inmuebleDiv.find('.card__content').append(inmuebleDisponibilidad);
            
                    var inmuebleValorDiario = $('<p></p>').text('Valor Diario: ' + inmueble.valorDiario);
                    inmuebleDiv.find('.card__content').append(inmuebleValorDiario);
            
                    var inmuebleEstrellas = $('<p></p>').text('Estrellas: ' + inmueble.estrellas);
                    inmuebleDiv.find('.card__content').append(inmuebleEstrellas);
            
                    var inmuebleDireccion = $('<p></p>').text('Dirección: ' + inmueble.direccion);
                    inmuebleDiv.find('.card__content').append(inmuebleDireccion);
            
                    var inmuebleCapacidadPersonas = $('<p></p>').text('Capacidad de Personas: ' + inmueble.capacidadPersonas);
                    inmuebleDiv.find('.card__content').append(inmuebleCapacidadPersonas);
            
                    var inmuebleCostoPersonaExtra = $('<p></p>').text('Costo por Persona Extra: ' + inmueble.costoPersonaExtra);
                    inmuebleDiv.find('.card__content').append(inmuebleCostoPersonaExtra);
            
                    var inmuebleFechaLimiteDisponibilidad = $('<p></p>').text('Fecha Límite de Disponibilidad: ' + inmueble.fechaLimiteDisponibilidad);
                    inmuebleDiv.find('.card__content').append(inmuebleFechaLimiteDisponibilidad);
            
                    // Botón para validar inmueble
                    var validarInmuebleButton = $('<button class="btn btn--block card__btn">Validar Inmueble</button>');
                    validarInmuebleButton.on('click', function () {
                        console.log('Validar inmueble con ID:', inmueble.id);
                    });
                    inmuebleDiv.find('.card__content').append(validarInmuebleButton);
            
                    // Agregar la tarjeta del inmueble al contenedor
                    inmuebleContainer.append(inmuebleDiv);
                });
            
                // Agregar la lista al contenedor principal
                $('.inmueble-list').append(inmuebleContainer);
            } else {
                // Mostrar mensaje si el propietario no tiene inmuebles
                $('.inmueble-list').append('<p>No tienes inmuebles registrados.</p>');
            }
        },
        error: function (xhr, status, error) {
            console.error('Error al obtener la lista de inmuebles:', error);
            alert('Error al obtener la lista de inmuebles. Por favor, inténtelo de nuevo más tarde.');
        }
    });

    // Función para obtener parámetros de la URL
    function obtenerParametroUrl(parametro) {
        var url = new URL(window.location.href);
        return url.searchParams.get(parametro);
    }
});
