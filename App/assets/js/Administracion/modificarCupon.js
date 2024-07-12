function mostrarTab(tab) {
    $('#cupones, #caracteristicas').hide();
    $('#' + tab).show();
}

function mostrarModificarCupon() {
    $('#modificarForm').show();
    $('#eliminarForm').hide();
    // Lógica para mostrar formulario de modificación
}

function mostrarEliminarCupon() {
    $('#modificarForm').hide();
    $('#eliminarForm').show();
    // Lógica para mostrar formulario de eliminación
}

function mostrarCaracteristicas() {
    $('#cupones, #modificarForm, #eliminarForm').hide();
    $('#caracteristicas').show();
    // Lógica adicional para mostrar características del inmueble seleccionado
}

$(document).ready(function () {
    $('#cuponesBtn').click(function () {
        $.ajax({
            url: 'cupones.php',
            type: 'GET',
            success: function (response) {
                $('#cupones').html(response);
            }
        });
    });
    // Agrega lógica similar para otras pestañas si es necesario

    $('#modificarCuponBtn').click(function () {
        $('#eliminarForm').hide();
        $('#modificarForm').show();
        // Aquí puedes agregar lógica adicional para cargar y completar los campos del formulario
        // Al hacer clic en "Aplicar Modificación", debes enviar los datos mediante AJAX
        $('#aplicarModificacionBtn').click(function () {
            // Implementa la lógica para enviar los datos al servidor para modificar el cupón
        });
    });

    $('#eliminarCuponBtn').click(function () {
        $('#modificarForm').hide();
        $('#eliminarForm').show();
        // Lógica para mostrar información del cupón a eliminar
        // Implementa la lógica para confirmar y eliminar el cupón de la base de datos
    });
});

$(document).ready(function() {
    // Lógica para obtener y rellenar el dropdown de lugares
    $.ajax({
        url: '../../App/Modules/administracion/obtenerinmueblesconcupon_Negocios.php',
        type: 'GET',
        success: function(response) {
            var lugares = JSON.parse(response);
            var lugaresDropdown = $('#lugaresList');
            var eliminarLugaresDropdown = $('#eliminarLugaresList');
            lugaresDropdown.empty(); // Limpiar el dropdown antes de rellenarlo
            eliminarLugaresDropdown.empty();
            
            lugaresDropdown.append($('<option>', {
                value: '',
                text: 'Selecciona un lugar',
                disabled: true,
                selected: true
            }));

            eliminarLugaresDropdown.append($('<option>', {
                value: '',
                text: 'Selecciona un lugar',
                disabled: true,
                selected: true
            }));

            $.each(lugares, function(index, lugar) {
                lugaresDropdown.append($('<option>', {
                    value: lugar.id, // Usar el ID como valor
                    text: lugar.nombre // Usar el nombre como texto visible
                }));
                eliminarLugaresDropdown.append($('<option>', {
                    value: lugar.id, // Usar el ID como valor
                    text: lugar.nombre // Usar el nombre como texto visible
                }));
            });

            
        }
    });

    // Lógica para obtener y rellenar el dropdown de nombres de cupones al seleccionar un lugar
    $('#lugaresList').change(function() {
        var lugarSeleccionado = $(this).val();

        $.ajax({
            url: '../../App/Modules/administracion/obtenercuponesinmueble_Negocios.php',
            type: 'GET',
            data: {
                lugar: lugarSeleccionado
            },
            success: function(response) {
                var cupones = JSON.parse(response);
                var cuponesDropdown = $('#cuponesList');
                cuponesDropdown.empty(); // Limpiar el dropdown antes de rellenarlo

                cuponesDropdown.append($('<option>', {
                    value: '',
                    text: 'Selecciona un cupón',
                    disabled: true,
                    selected: true
                }));

                $.each(cupones, function(index, cupon) {
                    cuponesDropdown.append($('<option>', {
                        value: cupon,
                        text: cupon
                    }));
                });
            }
        });
    });

    $('#eliminarLugaresList').change(function() {
        var lugarSeleccionado = $(this).val();

        $.ajax({
            url: '../../App/Modules/administracion/obtenercuponesinmueble_Negocios.php',
            type: 'GET',
            data: {
                lugar: lugarSeleccionado
            },
            success: function(response) {
                var cupones = JSON.parse(response);
                var eliminarCuponesDropdown = $('#eliminarCuponesList');
                eliminarCuponesDropdown.empty(); // Limpiar el dropdown antes de rellenarlo

                eliminarCuponesDropdown.append($('<option>', {
                    value: '',
                    text: 'Selecciona un cupón',
                    disabled: true,
                    selected: true
                }));

                $.each(cupones, function(index, cupon) {
                    eliminarCuponesDropdown.append($('<option>', {
                        value: cupon,
                        text: cupon
                    }));
                });
            }
        });
    });

    $('#cuponesList').change(function() {
        var cuponSeleccionado = $(this).val();
        console.log(cuponSeleccionado);
        $.ajax({
            url: '../../App/Modules/administracion/obtenerDatosCupon_Negocios.php', // Reemplaza con la URL correcta
            type: 'GET',
            data: {
                cupon: cuponSeleccionado
                
            },
            success: function(response) {
                var datosCupon = JSON.parse(response);
                $('#nuevoNombreCupon').val(datosCupon.nombre); // Completa el campo nombre del cupón
                $('#montoDescuento').val(datosCupon.monto); // Completa el campo monto de descuento
                $('#cantidadCupones').val(datosCupon.cantidad); // Completa el campo cantidad de cupones
                $('#fechaVencimiento').val(datosCupon.fecha); // Completa el campo fecha de vencimiento
            }
        });
    });

    $('#inmueblesList').change(function() {
        var lugarSeleccionado = $(this).val();

        $.ajax({
            url: '../../App/Modules/administracion/obtenercuponesinmueble_Negocios.php',
            type: 'GET',
            data: {
                lugar: lugarSeleccionado
            },
            success: function(response) {
                var cupones = JSON.parse(response);
                var cuponesDropdown = $('#cuponesList');
                cuponesDropdown.empty(); // Limpiar el dropdown antes de rellenarlo

                cuponesDropdown.append($('<option>', {
                    value: '',
                    text: 'Selecciona un cupón',
                    disabled: true,
                    selected: true
                }));

                $.each(cupones, function(index, cupon) {
                    cuponesDropdown.append($('<option>', {
                        value: cupon,
                        text: cupon
                    }));
                });
            }
        });
    });


    // Resto de tu código...
});

$(document).ready(function() {
    // Lógica para obtener y rellenar el dropdown de lugares
    $.ajax({
        url: '../../App/Modules/administracion/obetenerInmueblesporIdDuenno.php',
        type: 'GET',
        success: function(response) {
            var lugares = JSON.parse(response);
            var inmueblesDropdown = $('#inmueblesList');
            inmueblesDropdown.empty(); // Limpiar el dropdown antes de rellenarlo
            
            inmueblesDropdown.append($('<option>', {
                value: '',
                text: 'Selecciona un lugar',
                disabled: true,
                selected: true
            }));

            $.each(lugares, function(index, lugar) {
                inmueblesDropdown.append($('<option>', {
                    value: lugar.id, // Usar el ID como valor
                    text: lugar.nombre // Usar el nombre como texto visible
                }));
            });
        }
    });

    $('#inmueblesList').change(function() {
        var inmuebleSeleccionado = $(this).val();
        console.log(inmuebleSeleccionado);
        $.ajax({
            url: '../../App/Modules/administracion/obtenerCaracteristicasInmueble.php', 
            type: 'GET',
            data: {
                inmueble: inmuebleSeleccionado
                
            },
            success: function(response) {
                var datos = JSON.parse(response);
                $('#cantidadCuartos').val(datos.cantidadCuartos); 
                $('#cantidadCamas').val(datos.cantidadCamas); 
                $('#cantidadBanos').val(datos.cantidadBanos); 
                $('#cantidadPatios').val(datos.cantidadPatios); 
                $('#cantidadVehiculos').val(datos.cantidadVehiculos); 
                $('#cantidadPlantas').val(datos.cantidadPlantas); 
            }
        });
    });

});

$(document).ready(function() {
    $('#aplicarModificacionBtn').click(function() {
        var idInmueble = $('#lugaresList').val();
        var nombreCupon = $('#cuponesList').val(); 
        var nuevoNombreCupon = $('#nuevoNombreCupon').val(); 
        var montoDescuento = $('#montoDescuento').val();
        var cantidadCupones = $('#cantidadCupones').val();
        var fechaVencimiento = $('#fechaVencimiento').val();

        // Validar que los campos no estén vacíos
        if (idInmueble === "" || nombreCupon === "" || nuevoNombreCupon === "" || montoDescuento === "" || cantidadCupones === "" || fechaVencimiento === "") {
            Swal.fire("Error", "Por favor, complete todos los campos antes de aplicar la modificación.", "error");
            return; // Detener el proceso si algún campo está vacío
        }

        if (montoDescuento > 30) {
            Swal.fire("Error", "El porcentaje de descuento no puede ser mayor a 30.", "error");
            return;
        }

        // Validar que la cantidad de cupones no sea mayor a 200
        if (cantidadCupones > 200) {
            Swal.fire("Error", "La cantidad de cupones no puede ser mayor a 200.", "error");
            return;
        }

        // Realizar la solicitud AJAX
        $.ajax({
            url: '../../App/Modules/administracion/aplicarModificacionCupon_Negocios.php',
            type: 'POST',
            data: {
                idInmueble: idInmueble,
                nombreCupon: nombreCupon,
                nuevoNombreCupon: nuevoNombreCupon,
                montoDescuento: montoDescuento,
                cantidadCupones: cantidadCupones,
                fechaVencimiento: fechaVencimiento
            },
            success: function(response) {
                var resultado = JSON.parse(response);
                if (resultado.modificado) {
                    Swal.fire({
                        title: "Éxito",
                        text: "Cupón modificado correctamente",
                        icon: "success",
                        showCancelButton: false,
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "Aceptar"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Acciones adicionales después de aceptar
                        }
                    });
                } else {
                    Swal.fire("Error", "Hubo un problema al modificar el cupón.", "error");
                }
            },
            error: function() {
                Swal.fire("Error", "Hubo un problema al modificar el cupón.", "error");
            }
        });
    });
});

$(document).ready(function() {
    $('#confirmarEliminarBtn').click(function() {
        var idInmueble = $('#eliminarLugaresList').val();
        var idCupon = $('#eliminarCuponesList').val(); // Obtener el ID del cupón seleccionado

        // Aquí puedes realizar validaciones adicionales si es necesario antes de enviar la solicitud

        $.ajax({
            url: '../../App/Modules/administracion/eliminarCupon_Negocios.php', // Reemplaza con la URL correcta
            type: 'POST',
            data: {
                idInmueble: idInmueble,
                idCupon: idCupon
            },
            success: function(response) {
                var resultado = JSON.parse(response);
                if (resultado.eliminado) {
                    Swal.fire({
                        title: "Éxito",
                        text: "Cupón eliminado correctamente",
                        icon: "success",
                        showCancelButton: false,
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "Aceptar"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Acciones adicionales después de aceptar
                        }
                    });
                } else {
                    Swal.fire("Error", "Hubo un problema al eliminar el cupón.", "error");
                }
            },
            error: function() {
                Swal.fire("Error", "Hubo un problema al eliminar el cupón.", "error");
            }
        });
    });
});