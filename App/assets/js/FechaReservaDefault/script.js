document.addEventListener("DOMContentLoaded", function() {
    var fechaFormateada = '12-01-2023'; // Formato aaaa-mm-dd

    var fechaInicioInput = document.getElementById('fechaInicio');
    fechaInicioInput.value = fechaFormateada;

    var fechaFinInput = document.getElementById("fechaFin");

    if (fechaInicioInput && fechaFinInput) {
        var fechaActual = new Date();
        fechaActual.setDate(fechaActual.getDate() + 1);

        var fechaFin = new Date(fechaActual);
        fechaFin.setDate(fechaFin.getDate() + 4);

        // Formatear las fechas en el formato mm/dd/aaaa
        var fechaInicioFormatted = ('0' + (fechaActual.getMonth() + 1)).slice(-2) + '/' + ('0' + fechaActual.getDate()).slice(-2) + '/' + fechaActual.getFullYear();
        var fechaFinFormatted = ('0' + (fechaFin.getMonth() + 1)).slice(-2) + '/' + ('0' + fechaFin.getDate()).slice(-2) + '/' + fechaFin.getFullYear();

        //fechaInicioInput.value = fechaInicioFormatted;
        fechaFinInput.value = fechaFinFormatted;
    } else {
        console.error("Elementos de fechaInicio y/o fechaFin no encontrados");
    }
});