$(document).ready(function () {
    // Obtener el ID del usuario desde la URL
    var idUser = obtenerParametroUrl('idUser');
    console.log('ID de usuario:', idUser);

    // Obtener la lista de inmuebles del propietario desde el servidor mediante una solicitud AJAX
    $.ajax({
        type: 'POST',
        url: '../../App/Modules/obtenerInmuebles/inmueblesPorPropietario_Negocios.php',
        data: { idUser: idUser },
        dataType: 'json',
        success: function (inmuebleList) {
            var inmuebleContainer = $('.inmueble-list');
            inmuebleContainer.empty(); // Limpiar contenido existente

            if (inmuebleList.length > 0) {
                inmuebleList.forEach(function (inmueble) {
                    var inmuebleDiv = $('<div class="inmueble"></div>');
            
                    var inmuebleName = $('<div></div>').text(inmueble.nombre);
                    inmuebleDiv.append(inmuebleName);
            
                    var inmuebleDisponibilidad = $('<div></div>').text('Disponibilidad: ' + inmueble.disponibilidad);
                    inmuebleDiv.append(inmuebleDisponibilidad);
            
                    var inmuebleValorDiario = $('<div></div>').text('Valor Diario: ' + inmueble.valorDiario);
                    inmuebleDiv.append(inmuebleValorDiario);
            
                    var inmuebleEstrellas = $('<div></div>').text('Estrellas: ' + inmueble.estrellas);
                    inmuebleDiv.append(inmuebleEstrellas);
            
                    var inmuebleDireccion = $('<div></div>').text('Dirección: ' + inmueble.direccion);
                    inmuebleDiv.append(inmuebleDireccion);

                    var inmuebleCapacidadPersonas = $('<div></div>').text('Capacidad de Personas: ' + inmueble.capacidadPersonas);
                    inmuebleDiv.append(inmuebleCapacidadPersonas);
            
                    var inmuebleCostoPersonaExtra = $('<div></div>').text('Costo por Persona Extra: ' + inmueble.costoPersonaExtra);
                    inmuebleDiv.append(inmuebleCostoPersonaExtra);
            
                    var inmuebleFechaLimiteDisponibilidad = $('<div></div>').text('Fecha Límite de Disponibilidad: ' + inmueble.fechaLimiteDisponibilidad);
                    inmuebleDiv.append(inmuebleFechaLimiteDisponibilidad);
            
                    var inmuebleIdValidacionInmueble = $('<div></div>').text('ID Validación de Inmueble: ' + inmueble.idValidacionInmueble);
                    inmuebleDiv.append(inmuebleIdValidacionInmueble);
            

                    var validarInmuebleButton = $('<button class="button-validar-inmueble">Validar Inmueble</button>');
                    validarInmuebleButton.on('click', function () {
                        
                        console.log('Validar inmueble con ID:', inmueble.id);
                    });
                    inmuebleDiv.append(validarInmuebleButton);

                    inmuebleContainer.append(inmuebleDiv);
                });
            } else {
                // Mostrar mensaje si el propietario no tiene inmuebles
                inmuebleContainer.append('<p>No tienes inmuebles registrados.</p>');
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
