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
        var crearReserva2 = document.getElementById("crearReserva2");

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

        crearReserva2.addEventListener('click', function () {
            // console.log('La fecha ha cambiado fin:', fechaFinBC.value);
            ReservaLugar();
        });


    //    *******************************************************************************************
        //metodos internos
    //    *******************************************************************************************
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
        

        function ReservaLugar() {

            // var cedulaDuenno = parseInt($('#cedulaDuenno').val()).value;
            var cedulaDuenno = 305420603;
            var idUsuario = $('#idUsuario').val();
            var idInmueble = $('#idInmueble').val();
            var cantidadPersonas = $('#cantidadPersonas').val();
            var cantidadPersonasExtra = $('#cantidadPersonasExtra').val();
            var fechaInicio = fechaInicioBC.value;
            var fechaFin = fechaFinBC.value;
            var Cupon = $('#Cupon').val();
            var valorTotal =  parseInt(valorTotalElement.textContent)*1000; // Cambiado de .val() a .text()
            var valorTotalImpuestos = parseInt(valorTotalImpuestosElement.textContent)*1000; // Cambiado de .val() a .text()
            var Saldo = $('#saldo').val();

            if (cantidadPersonas === '0') { // Corregida la validación
                alert("Debe ingresar la cantidad de personas.");
                return;
            }

            if (Saldo < valorTotal) { // Corregida la validación
                alert("No tienes suficiente saldo");
                return;
            }

            AJAXModficiarSaldos(idUsuario,idInmueble, valorTotal, Cupon, fechaInicio, fechaFin, valorTotalImpuestos, cantidadPersonasExtra, cantidadPersonas, cedulaDuenno);
        }

        
        function AJAXModficiarSaldos(idUsuario,idInmueble, valorTotal, Cupon, fechaInicio, fechaFin, valorTotalImpuestos, cantidadPersonasExtra, cantidadPersonas, cedulaDuenno) {

            $.ajax({
                type: 'POST',
                url: '../../App/Modules/ModificarSaldos/modificarSaldos_Negocios.php',
                data: {
                    crearReserva: true,
                    idUsuario: idUsuario,
                    idInmueble: idInmueble,
                    cantidadPersonas: cantidadPersonas,
                    cantidadPersonasExtra: cantidadPersonasExtra,
                    fechaInicio: fechaInicio,
                    fechaFin: fechaFin,
                    Cupon: Cupon,
                    valorTotal: valorTotal,
                    valorTotalImpuestos: valorTotalImpuestos,
                    cedulaDuenno: cedulaDuenno
                },
                dataType: 'json',
                success: function(response) {
                    if (response.error) {
                        alert(response.error); // Muestra el mensaje de error del cupón no válido
                    } else {
                        alert('¡Reserva creada exitosamente!');
                    }
                },
                // console.log(),
                error: function(xhr, status, error) {
                    console.log(xhr);
                    console.log(status);
                    console.log(error);
                    alert('Error en la solicitud. Por favor, inténtelo más tarde.');
                }
            });
        }


    });//fin load
});//fin loaded

