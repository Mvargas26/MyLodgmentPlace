document.addEventListener("DOMContentLoaded", function () {

    var valorDiarioElement = document.getElementById("valorColones");
    var valorTotalElement = document.getElementById("valorTotal");
    var valorTotalImpuestosElement = document.getElementById("valorTotalImpuestos");

    var cantidadPersonasInput = document.getElementById("cantidadPersonas");
    var cantidadPersonasExtraInput = document.getElementById("cantidadPersonasExtra");
    var costoPersonaExtra = parseFloat(document.getElementById("costoPersonaExtra").value);
    var fechaInicioInput = document.getElementById("fechaInicio");
    var fechaFinInput = document.getElementById("fechaFin");

    var cantidadDiasTotal;

    cantidadPersonasInput.addEventListener("change", function () {
        var capacidadMaxima = parseInt(document.getElementById("capacidadMaxima").value);
        var cantidadPersonas = parseInt(cantidadPersonasInput.value);

        if (cantidadPersonas < 1 || cantidadPersonas > capacidadMaxima) {
            alert("La cantidad de personas no es válida para este lugar.");
            cantidadPersonasInput.value = 1;
        }

        calcularValorTotal();
    });

    cantidadPersonasExtraInput.addEventListener("change", function () {
        var cantidadPersonasExtra = parseInt(cantidadPersonasExtraInput.value);

        if (cantidadPersonasExtra < 0 || cantidadPersonasExtra > 5) {
            alert("La cantidad de personas extra debe estar entre 0 y 5.");
            cantidadPersonasExtraInput.value = 0;
        }

        calcularValorTotal();
    });

    fechaInicioInput.addEventListener("change", function () {
        console.log("Fecha de inicio cambiada");
        calcularCantidadDias();
        calcularValorTotal();
    });
    
    fechaFinInput.addEventListener("change", function () {
        console.log("Fecha de fin cambiada");
        calcularCantidadDias();
        calcularValorTotal();
    });

    function calcularCantidadDias() {
        var fechaInicio = new Date(fechaInicioInput.value);
        var fechaFin = new Date(fechaFinInput.value);

        if (!isNaN(fechaInicio.getTime()) && !isNaN(fechaFin.getTime()) && fechaFin.getTime() > fechaInicio.getTime()) {
            var unDia = 24 * 60 * 60 * 1000;
            var diferenciaEnMilisegundos = fechaFin.getTime() - fechaInicio.getTime();
            cantidadDiasTotal = Math.round(diferenciaEnMilisegundos / unDia);
        } else {
            cantidadDiasTotal = 0;
        }
    }
    function calcularValorTotal() {
        var valorDiario = parseFloat(valorDiarioElement.textContent.replace(/\D/g, ''));
        var cantidadDias = parseInt(cantidadDiasTotal);
        var cantidadPersonasExtra = parseInt(cantidadPersonasExtraInput.value);

        var valorTotal = (((costoPersonaExtra * cantidadPersonasExtra) + (valorDiario/100)) * 4);
        var totalImpuestos = valorTotal + (valorTotal*0.13)
        // if (cantidadDias > 0) {
            valorTotalElement.textContent = valorTotal.toLocaleString();
            valorTotalImpuestosElement.textContent = totalImpuestos.toLocaleString();
        // } else {
        //     valorTotalElement.textContent = 0;
        // }

        
    }

    // Calcular el valor total inicial al cargar la página
    calcularValorTotal();

});