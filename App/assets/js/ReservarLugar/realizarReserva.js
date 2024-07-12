document.addEventListener('DOMContentLoaded', function () {
    window.addEventListener('load', function () {

        var fechaInicioBC = document.getElementById("fechaInicioBC");
        var fechaFinBC = document.getElementById("fechaFinBC");
        var valorDiarioElement = document.getElementById("valorColones");
        var cantidadPersonasInput = document.getElementById("cantidadPersonas");
        var cantidadPersonasExtraInput = document.getElementById("cantidadPersonasExtra");
        var valorTotalElement = document.getElementById("valorTotal");
        var valorTotalImpuestosElement = document.getElementById("valorTotalImpuestos");
        var btnCalcularReserva = document.getElementById("calcularReserva");
        var crearReserva2 = document.getElementById("crearReserva2");
        var costoPersonaExtra = parseFloat(document.getElementById("costoPersonaExtra").value);
        var CuponIngresado = document.getElementById("Cupon");
        var nombreCuponInmueble = document.getElementById("nombreCupon");
        var descuentoCupon = document.getElementById("descuentoCupon");

        //VALIDACIONES
        //----oculta el boton reservar
        crearReserva2.style.display = 'none';  // Ocultar el botón

        //escuchar si cambian los datos de entrada
        cantidadPersonasInput.addEventListener('input', ejecutarValidaciones);
        cantidadPersonasExtraInput.addEventListener('input', ejecutarValidaciones);
        CuponIngresado.addEventListener('input', ocultarBotonReserva);
        cantidadPersonasInput.addEventListener('change', ejecutarValidaciones);
        cantidadPersonasExtraInput.addEventListener('change', ejecutarValidaciones);
        CuponIngresado.addEventListener('change', ocultarBotonReserva);

        fechaInicioBC.addEventListener('change', ejecutarValidaciones);
        fechaFinBC.addEventListener('change', ejecutarValidaciones);



        //EVENTOS
        ////aqui capturamos la fecha inicio y fecha fin
        //  fechaInicioBC.addEventListener('change', function () {
        //     var fechaMenor = fechaEsMenorAHoy(fechaInicioBC.value);
        //     if (fechaMenor) {
        //         Swal.fire("Error", "la fecha no puede ser menor a la fecha actual.", "error");
        //         return; // Utiliza el mensaje decodificado
        //     };
        // });

        // fechaFinBC.addEventListener('change', function () {
        //     var fechaMenor = fechaEsMenorAHoy(fechaFinBC.value);
        //     if (fechaMenor) {
        //         Swal.fire("Error", "la fecha no puede ser menor a la fecha actual.", "error");
        //         return; // Utiliza el mensaje decodificado
        //     };
        // });

        btnCalcularReserva.addEventListener('click', function () {
            var bol_fechaInicioEsMenor = fechaEsMenorAHoy(fechaInicioBC.value);
            var bol_fechaFinEsMenor = fechaEsMenorAHoy(fechaFinBC.value);
            var bol_fechafinEsMayor = fechaFinEsMenor(fechaInicioBC.value, fechaFinBC.value);
            var descuentoCero = 0;

            //validar cupon

            if (bol_fechafinEsMayor) {
                Swal.fire("Error", "La fecha de fin no puede ser menor o igual que la fecha de inicio", "error");
                return;
            }

            if (bol_fechaInicioEsMenor || bol_fechaFinEsMenor) {
                Swal.fire("Error", "la fecha no puede ser menor a la fecha actual.", "error");
                return; // Utiliza el mensaje decodificado
            } else {
                if (parseInt(cantidadPersonasInput.value) < 1) {
                    Swal.fire("Error", "Debe de ingresar la cantidad de personas primero.", "error");
                    return;
                } else if (CuponIngresado.value != "") {
                    if ((CuponIngresado.value).trim() != (nombreCuponInmueble.value).trim()) {
                        Swal.fire("Aviso", "El cupon ingresado no es valido.", "error");
                        
                        calcularValorTotal(valorDiarioElement, cantidadPersonasInput, cantidadPersonasExtraInput,
                            valorTotalElement, valorTotalImpuestosElement, costoPersonaExtra, fechaInicioBC, fechaFinBC, descuentoCero);
                    } else {
                        calcularValorTotal(valorDiarioElement, cantidadPersonasInput, cantidadPersonasExtraInput,
                            valorTotalElement, valorTotalImpuestosElement, costoPersonaExtra, fechaInicioBC, fechaFinBC, descuentoCupon.value);
    
                        muestraOcultaBtnReservar2(valorTotalElement, valorTotalImpuestosElement);
                    }
                } else {
                    calcularValorTotal(valorDiarioElement, cantidadPersonasInput, cantidadPersonasExtraInput,
                        valorTotalElement, valorTotalImpuestosElement, costoPersonaExtra, fechaInicioBC, fechaFinBC, descuentoCero);

                    muestraOcultaBtnReservar2(valorTotalElement, valorTotalImpuestosElement);
                }
            };
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
            // se cambia el valor a texto remplazando los signos que dan conflicto
            const valorTotalTexto = valorTotalElement.textContent.replace(/\./g, '');
            //se parsea a tipo float
            const valorTotal = parseFloat(valorTotalTexto);
            // se cambia el valor a texto remplazando los signos que dan conflicto
            const valorTotalImpuestostexto = valorTotalImpuestosElement.textContent.replace(/\./g, '');
            //se parsea a tipo float
            const valorTotalImpuestos = parseFloat(valorTotalImpuestostexto);


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
                success: function (response) {
                    if (response != "") {

                        //si la cadena trae esta palabra, no tiene cuenta o el saldo era menor al total
                        if (buscadorPalabra(response, "saldoEsMenor")) {
                            Swal.fire("Error", "Lo sentimos, no cuenta con saldo suficiente en su cuenta.", "error");
                            setTimeout(function () {
                                location.reload(true);
                            }, 2000);
                        } else {

                            Swal.fire("Éxito", "Reserva creada exitosamente", "success"); // Utiliza el mensaje decodificado
                            setTimeout(function () {
                                location.reload(true);
                            }, 2000);

                        }


                    } else {
                        console.log(x.response);
                        Swal.fire("Error", "Lo sentimos, ocurrió un error.", "error");
                    }

                },
                error: function (textStatus, errorThrown) {
                    console.error('Error en la solicitud AJAX:', textStatus, errorThrown);
                }
            });

        });


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
function fechaEsMenorAHoy(fechaStr) {

    const fechaIngresada = new Date(fechaStr);
    const fechaActual = new Date();

    if (fechaIngresada <= fechaActual) {

        Swal.fire("Error", "La fecha Inicial no puede ser menor a la fecha actual", "error");//mensaje bonito
        return true;
    }

    return false;
};

//verifica que la fecha fin no sea menor que la de inicio
function fechaFinEsMenor(fechaInicioStr, fechaFinStr) {
    const fechaInicio = new Date(fechaInicioStr);
    const fechaFin = new Date(fechaFinStr);

    if (fechaFin <= fechaInicio) {
        return true;
    }
    return false;
}

//realiza los calculos por cada botonazo a calcular
function calcularValorTotal(valorDiarioElement, cantidadPersonasInput, cantidadPersonasExtraInput, valorTotalElement,
    valorTotalImpuestosElement, costoPersonaExtra, fechaInicioBC, fechaFinBC, descuentoCupon) {
    var valorDiario = parseFloat(valorDiarioElement.textContent.replace(/\D/g, ''));
    var cantidadDias = calcularDiferenciaDias(fechaInicioBC.value, fechaFinBC.value);
    var cantidadPersonasExtra = parseInt(cantidadPersonasExtraInput.value);

    if (cantidadPersonasExtra == 0 || cantidadPersonasInput.value == 0) {
        var valorTotal = ((valorDiario - (valorDiario * (0.05 + (descuentoCupon / 100)))) / 100) * cantidadDias;
        var totalImpuestos = (valorTotal + (valorTotal * 0.13));

        valorTotalElement.textContent = valorTotal.toLocaleString();
        valorTotalImpuestosElement.textContent = totalImpuestos.toLocaleString();
    }
    else {

        var CostoExtraTotal = costoPersonaExtra * cantidadPersonasExtra;
        var CostoSinDescuentos = CostoExtraTotal + (valorDiario/100);

        var valorTotal = ((CostoSinDescuentos - (CostoSinDescuentos * (0.05 + (descuentoCupon / 100))))) * cantidadDias;
        var totalImpuestos = valorTotal + (valorTotal * 0.13)
        // if (cantidadDias > 0) {
        valorTotalElement.textContent = valorTotal.toLocaleString();
        valorTotalImpuestosElement.textContent = totalImpuestos.toLocaleString();
    }
}//fin calcularValorTotal

function muestraOcultaBtnReservar2(valorTotalElement, valorTotalImpuestosElement) {
    // Verificar si ambos valores son 0 y ocultar o mostrar el botón
    if (valorTotalElement.innerText === '0' && valorTotalImpuestosElement.innerText === '0') {
        crearReserva2.style.display = 'none';  // Ocultar el botón
    } else {
        crearReserva2.style.display = 'block'; // Mostrar el botón
    }
}

//buscara si hay una palabra x en el response
function buscadorPalabra(cadena, palabra) {
    const cadenaEnMinusculas = cadena.toLowerCase();
    const palabraEnMinusculas = palabra.toLowerCase();

    // Busca la palabra en la cadena
    const estaPresente = cadenaEnMinusculas.includes(palabraEnMinusculas);

    return estaPresente;
}//fin buscadorPalabra

//Ejecuta todas las validaciones
function ejecutarValidaciones() {
    ocultarBotonReserva();
    validarCapacidadMaxima();
    validarPersonasExtra();
}//fin ocultarBotonReserva


//esconde el boton de reservar al cambiarse algun dato de entrada
function ocultarBotonReserva() {
    crearReserva2.style.display = 'none';
}//fin ocultarBotonReserva

function validarCapacidadMaxima() {
    var capacidadMaxima = parseInt(document.getElementById("capacidadPersonas").value);
    var cantidadPersonas = document.getElementById("cantidadPersonas");

    if (cantidadPersonas.value == "") {
        cantidadPersonas = 0;
    }
    else {
        cantidadPersonas = parseInt(document.getElementById("cantidadPersonas").value);
    }

    // Verificar si la cantidad total de personas supera la capacidad máxima permitida menos 4
    if (cantidadPersonas > capacidadMaxima) {

        // Aquí puedes mostrar un mensaje de error o realizar alguna acción específica
        Swal.fire("Error", "La cantidad de personas excede la capacidad máxima permitida del inmueble (" + capacidadMaxima + ")", "error");
        cantidadPersonasInput.value = 1;
        return true;
    }
}

function validarPersonasExtra() {
    var cantidadPersonasExtra = parseInt(document.getElementById("cantidadPersonasExtra").value);

    if (cantidadPersonasExtra.value == "") {
        cantidadPersonasExtra = 0;
    }

    // Verificar si la cantidad total de personas supera la capacidad máxima permitida menos 4
    if (cantidadPersonasExtra > 4) {
        // Aquí puedes mostrar un mensaje de error o realizar alguna acción específica
        Swal.fire("Error", "La cantidad de personas extra excede la capacidad máxima permitida del inmueble (4)", "error");
        cantidadPersonasExtraInput.value = 0;
        return true;
    }
}