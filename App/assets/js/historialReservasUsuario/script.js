// Verificar si estamos en la página de historial de reservas
//if (window.location.pathname === 'http://localhost/proyectos_php/MyLodgmentPlace/App/Views/reservasHuesped_View.php') {
    $(document).ready(function () {
        $.ajax({
            type: 'POST',
            url: '../../App/Modules/historialReservasUsuario/historialReservasUsuario_Negocios.php',
            data: {
                obtenerHistorial: true
            },
            dataType: 'json',
            success: function (response) {
                // Llenar la tabla con los datos de las reservas
                var tablaReservas = $('#tablaReservas');
                response.forEach(function (reserva) {
                    tablaReservas.append(`<tr>
                    <td>${reserva.nombreInmueble}</td>
                    <td>${reserva.fechaInicio}</td>
                    <td>${reserva.fechaFin}</td>
                    <td>${reserva.montoTotal}</td>
                    <td>${reserva.montoTotalImpuesto}</td>                                        
                                        </tr>`);
                });
            },
            error: function (xhr, status, error) {
                alert('Error al obtener el historial de reservas.');
            }
        });
    });
//}