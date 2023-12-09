document.addEventListener('DOMContentLoaded', function () {
    window.addEventListener('load', function () {

        //OBJETOS EN HTML
        var fechaInicioBC = document.getElementById("fechaInicioBC");
        var fechaFinBC = document.getElementById("fechaFinBC");

        //VARIABLES CON TEXTO
        var valorDiarioElement = document.getElementById("valorColones");
        var cantidadPersonasInput = document.getElementById("cantidadPersonas");
        var cantidadPersonasExtraInput = document.getElementById("cantidadPersonasExtra");
        var valorTotalElement = document.getElementById("valorTotal");
        var valorTotalImpuestosElement = document.getElementById("valorTotalImpuestos");
        var btnCalcularReserva = document.getElementById("calcularReserva");

        //EVENTOS
         //aqui capturamos la fecha inicio y fecha fin
        //  fechaInicioBC.addEventListener('change', function () {
        //     var fechaMenor = fechaEsMenorAHoy(fechaInicioBC.value);
        //     if (!fechaMenor) {
        //         calcularValorTotal();
        //     };
        // });

        // fechaFinBC.addEventListener('change', function () {
        //     // console.log('La fecha ha cambiado fin:', fechaFinBC.value);
        //     calcularValorTotal();
        // });

        btnCalcularReserva.addEventListener('click', function () {
            calcularValorTotal();

        });

        crearReserva2.addEventListener('click', function () {

            const idUsuario = document.getElementById("idUsuario").value;
            const idPropietario = document.getElementById("cedulaDuenno").value;
            const idInmueble = document.getElementById("idInmueble").value;
            const cantidadPersonas = document.getElementById("cantidadPersonas").value;
            const cantidadPersonasExtra = document.getElementById("cantidadPersonasExtra").value;
            const fechaInicio = document.getElementById("fechaInicioBC").value;
            const fechaFin = document.getElementById("fechaFinBC").value;
            const Cupon = document.getElementById("Cupon").value;
            const valorTotal =  parseInt(valorTotalElement.textContent)*1000;
            const valorTotalImpuestos = parseInt(valorTotalImpuestosElement.textContent)*1000;


            const data = {
                idUsuario,
                idPropietario,
                idInmueble,
                cantidadPersonas,
                cantidadPersonasExtra,
                fechaInicio,
                fechaFin,
                Cupon,
                valorTotal,
                valorTotalImpuestos
            };

            $.ajax({
                url: "../../App/Modules/ReservaLugar/ReservaLugar_Negocios.php",
                type: "POST",
                data: data,              
                success: function(response) 
                {

                    var x = JSON.parse(response);
                    if (x.exito ) {
                        Swal.fire("Éxito", "Se guardó la calificación correctamente. ", "success");//mensaje bonito
                        setTimeout(function() {
                            location.reload(true);
                            },
                         2000);
                    } else {
                        console.log(x.response);
                        Swal.fire("Error", "Lo sentimos, ocurrió un error.", "error");
                    }
    
                },
                error: function(textStatus, errorThrown) {
                    console.error('Error en la solicitud AJAX:', textStatus, errorThrown);
                 }
            });



           
        });























        function calcularValorTotal() {
            var valorDiario = parseFloat(valorDiarioElement.textContent.replace(/\D/g, ''));
            var cantidadDias = calcularDiferenciaDias(fechaInicioBC.value,fechaFinBC.value);
            var cantidadPersonasExtra = parseInt(cantidadPersonasExtraInput.value);
    
            if (cantidadPersonasExtra == 0 || cantidadPersonasInput.value == 0) {
                var valorTotal = ((valorDiario+(valorDiario*0.05))/100) * cantidadDias;
                var totalImpuestos = (valorTotal + (valorTotal * 0.13));
    
                valorTotalElement.textContent = valorTotal.toLocaleString();
                valorTotalImpuestosElement.textContent = totalImpuestos.toLocaleString();
            }
            else {
                var valorTotal = (((costoPersonaExtra * cantidadPersonasExtra) + ((valorDiario+(valorDiario*0.05)) / 100)) * cantidadDias);
                var totalImpuestos = valorTotal + (valorTotal * 0.13)
                // if (cantidadDias > 0) {
                valorTotalElement.textContent = valorTotal.toLocaleString();
                valorTotalImpuestosElement.textContent = totalImpuestos.toLocaleString();
            }
        }//fin calcularValorTotal

    });
});//fin dom
//******************************************** */
//FUNCIONES INDEPENDIENTES DEL DOM
//******************************************** */

//calcula en numero la diferencia de dias
function calcularDiferenciaDias(fechaInicioStr, fechaFinStr) {
    // Convertir las cadenas de fecha a objetos de fecha
    const fechaInicio = new Date(fechaInicioStr);
    const fechaFin = new Date(fechaFinStr);

    // Calcular la diferencia en milisegundos
    const diferenciaMilisegundos = fechaFin - fechaInicio;

    // Calcular la diferencia en días (1 día = 24 * 60 * 60 * 1000 milisegundos)
    const diferenciaDias = Math.floor(diferenciaMilisegundos / (24 * 60 * 60 * 1000));

    return diferenciaDias;
};//fn calcularDiferenciaDias
//----------------------------------------
//valida si la fecha ingresada es menor a la de hoy
function fechaEsMenorAHoy(fechaStr){

    const fechaIngresada = new Date(fechaStr);
    const fechaActual = new Date();

    if (fechaIngresada <= fechaActual) {
        
        Swal.fire("Error", "La fecha Inicial no puede ser menor a la fecha actual", "error");//mensaje bonito
        return true;
    }

    return false;
};




