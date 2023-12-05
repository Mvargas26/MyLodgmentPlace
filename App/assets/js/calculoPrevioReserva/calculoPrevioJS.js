document.addEventListener('DOMContentLoaded', function () {
    window.addEventListener('load', function () {

        var valorDiarioElement = document.getElementById("valorColones");
        var valorTotalElement = document.getElementById("valorTotal");
        var valorTotalImpuestosElement = document.getElementById("valorTotalImpuestos");
        var cantidadPersonasInput = document.getElementById("cantidadPersonas");
        var cantidadPersonasExtraInput = document.getElementById("cantidadPersonasExtra");
        var costoPersonaExtra = parseFloat(document.getElementById("costoPersonaExtra").value);
        var fechaInicioBC = document.getElementById("fechaInicioBC");
        var fechaFinBC = document.getElementById("fechaFinBC");

        var cantidadDiasTotal=0;

        //aqui capturamos la fecha inicio y fecha fin
        fechaInicioBC.addEventListener('change', function () {
            //calcularValorTotal();
            var fechaMenor = fechaEsMenorAHoy(fechaInicioBC.value);
            if (!fechaMenor) {
                calcularValorTotal();
            };
        });

        fechaFinBC.addEventListener('change', function () {
            // console.log('La fecha ha cambiado fin:', fechaFinBC.value);
            calcularValorTotal();
        });

    //    *******************************************************************************************
        //metodos internos
    //    *******************************************************************************************
        function calcularValorTotal() {
            var valorDiario = parseFloat(valorDiarioElement.textContent.replace(/\D/g, ''));
            var cantidadDias = calcularDiferenciaDias(fechaInicioBC.value,fechaFinBC.value);
            var cantidadPersonasExtra = parseInt(cantidadPersonasExtraInput.value);
    
            if (cantidadPersonasExtra == 0 || cantidadPersonasInput.value == 0) {
                var valorTotal = (valorDiario/100) * cantidadDias;
                var totalImpuestos = (valorTotal + (valorTotal * 0.13));
    
                valorTotalElement.textContent = valorTotal.toLocaleString();
                valorTotalImpuestosElement.textContent = totalImpuestos.toLocaleString();
            }
            else {
                var valorTotal = (((costoPersonaExtra * cantidadPersonasExtra) + (valorDiario / 100)) * cantidadDias);
                var totalImpuestos = valorTotal + (valorTotal * 0.13)
                // if (cantidadDias > 0) {
                valorTotalElement.textContent = valorTotal.toLocaleString();
                valorTotalImpuestosElement.textContent = totalImpuestos.toLocaleString();
                // } else {
                //     valorTotalElement.textContent = 0;
                // }
            }
        }//fin calcularValorTotal

        //retorna la cantidad de diferencia de dias en entero
        function calcularDiferenciaDias(fechaInicioStr, fechaFinStr) {
            // Convertir las cadenas de fecha a objetos de fecha
            const fechaInicio = new Date(fechaInicioStr);
            const fechaFin = new Date(fechaFinStr);
        
            // Calcular la diferencia en milisegundos
            const diferenciaMilisegundos = fechaFin - fechaInicio;
        
            // Calcular la diferencia en días (1 día = 24 * 60 * 60 * 1000 milisegundos)
            const diferenciaDias = Math.floor(diferenciaMilisegundos / (24 * 60 * 60 * 1000));
        
            return diferenciaDias;
        };

        function fechaEsMenorAHoy(fechaStr){

            const fechaIngresada = new Date(fechaStr);
            const fechaActual = new Date();

            if (fechaIngresada <= fechaActual) {
                
                Swal.fire("Error", "La fecha Inicial no puede ser menor a la fecha actual", "error");//mensaje bonito
                return true;
            }
        
            return false;
        };
        

    });//fin load
});//fin loaded

