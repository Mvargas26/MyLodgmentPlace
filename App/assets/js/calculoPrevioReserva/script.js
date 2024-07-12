document.addEventListener("DOMContentLoaded", function () {

    var valorDiarioElement = document.getElementById("valorColones");
    var valorTotalElement = document.getElementById("valorTotal");
    var valorTotalImpuestosElement = document.getElementById("valorTotalImpuestos");

    var cantidadPersonasInput = document.getElementById("cantidadPersonas");
    var cantidadPersonasExtraInput = document.getElementById("cantidadPersonasExtra");
    var costoPersonaExtra = parseFloat(document.getElementById("costoPersonaExtra").value);
    var fechaInicioInput = document.getElementById("fechaInicio");
    var fechaInicioBC = document.getElementById("fechaInicioBC");
    var fechaFinBC = document.getElementById("fechaFinBC");

    var fechaVencimiento = $('#fechaInicio').val();


    // var fechaActual = new Date();
    // var fechaManana = new Date(); 
    
    // fechaManana.setDate(fechaActual.getDate() + 1);

    // var fechaMananaMas4Dias = new Date(); 
    
    // fechaMananaMas4Dias.setDate(fechaManana.getDate() + 4);

    // fechaInicioInput.value = fechaManana;
    // fechaFinInput.value = fechaMananaMas4Dias;
    // var fechaEntrada = fechaInicio1;

    // console.log(fechaInicio1 + " fecha inicio");

    var cantidadDiasTotal;

    // cantidadPersonasInput.addEventListener("change", function () {
    //     var capacidadMaxima = parseInt(document.getElementById("capacidadMaxima").value);
    //     var cantidadPersonas = parseInt(cantidadPersonasInput.value);

    //     if (cantidadPersonas < 1 || cantidadPersonas > capacidadMaxima) {
    //         // alert("La cantidad de personas no es válida para este lugar.");
    //         cantidadPersonasInput.value = 1;
    //     }

    //     // calcularValorTotal();
    // });

    // cantidadPersonasExtraInput.addEventListener("change", function () {
    //     var cantidadPersonasExtra = parseInt(cantidadPersonasExtraInput.value);

    //     if (cantidadPersonasExtra < 0 || cantidadPersonasExtra > 5) {
    //         Swal.fire("Error", "La cantidad de personas extra excede la capacidad máxima permitida del inmueble (4)", "error");
    //         cantidadPersonasExtraInput.value = 0;
    //         return true;
    //     }

    //     // calcularValorTotal();
    // });

    // fechaInicioInput.addEventListener("click", function () {
    //     console.log("Fecha de inicio cambiada");
    //     console.log("Valor de fechaInicioInput:", fechaInicioInput.value);

    //     fechaInicioInput = $('#fechaInicio').val();
    //     fechaFinInput = $('#fechaFin').val();
    //     // calcularCantidadDias();
    //     // calcularValorTotal();
    // });

    // fechaFinInput.addEventListener("click", function () {
    //     console.log("Fecha de fin cambiada");
    //     console.log("Valor de fechaInicioInput:", fechaInicioInput.value);

    //     fechaInicioInput = $('#fechaInicio').val();
    //     fechaFinInput = $('#fechaFin').val();
    //     calcularCantidadDias();
    //     calcularValorTotal();
    // });

    // function calcularCantidadDias() {
    //     var fechaInicioString = fechaInicioInput.value;
    //     var fechaFinString = fechaFinInput.value;

    //     var partesFechaInicio = fechaInicioString.split("/");
    //     var partesFechaFin = fechaFinString.split("/");

    //     var fechaInicioFormato = partesFechaInicio[2] + "-" + partesFechaInicio[0] + "-" + partesFechaInicio[1];
    //     var fechaFinFormato = partesFechaFin[2] + "-" + partesFechaFin[0] + "-" + partesFechaFin[1];

    //     var fechaInicio = new Date(fechaInicioFormato);
    //     var fechaFin = new Date(fechaFinFormato);

    //     if (fechaInicio && fechaFin && fechaFin.getTime() > fechaInicio.getTime()) {
    //         var unDia = 24 * 60 * 60 * 1000;
    //         var diferenciaEnMilisegundos = fechaFin.getTime() - fechaInicio.getTime();
    //         var cantidadDias = Math.round(diferenciaEnMilisegundos / unDia);

    //         cantidadDiasTotal = cantidadDias;
    //     } else {
    //         cantidadDiasTotal = 0;
    //     }
    // }

    // function calcularValorTotal() {
    //     var valorDiario = parseFloat(valorDiarioElement.textContent.replace(/\D/g, ''));
    //     var cantidadDias = parseInt(cantidadDiasTotal);
    //     var cantidadPersonasExtra = parseInt(cantidadPersonasExtraInput.value);

    //     if (cantidadPersonasExtra == 0 || cantidadPersonasInput.value == 0) {
    //         var valorTotal = valorDiario/100;
    //         var totalImpuestos = (valorTotal + (valorTotal * 0.13))*4;

    //         valorTotalElement.textContent = valorTotal.toLocaleString();
    //         valorTotalImpuestosElement.textContent = totalImpuestos.toLocaleString();
    //     }
    //     else {
    //         var valorTotal = (((costoPersonaExtra * cantidadPersonasExtra) + (valorDiario / 100)) * 4);
    //         var totalImpuestos = valorTotal + (valorTotal * 0.13)
    //         // if (cantidadDias > 0) {
    //         valorTotalElement.textContent = valorTotal.toLocaleString();
    //         valorTotalImpuestosElement.textContent = totalImpuestos.toLocaleString();
    //         // } else {
    //         //     valorTotalElement.textContent = 0;
    //         // }
    //     }


    // }

    // // Calcular el valor total inicial al cargar la página
    // calcularValorTotal();

});