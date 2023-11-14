document.addEventListener("DOMContentLoaded", function() {

    var valorColonesElement = document.getElementById("valorColones");
    var valorTotalElement = document.getElementById("valorTotal");

    var cantidadDiasInput = document.getElementById("cantidadDias");
    var cantidadDiasInput2 = document.getElementById("cantidadDias");

    cantidadDiasInput.addEventListener("input", function() {

        var cantidadDias = parseInt(cantidadDiasInput.value);

        if (cantidadDias < 1) {
            alert("La cantidad de días no puede ser menor a 1.");

            cantidadDiasInput.value = 1;
        } else {
            var valorDiario = 20000;
            var valorTotal = valorDiario * cantidadDias;

            valorColonesElement.textContent = valorDiario.toLocaleString();
            valorTotalElement.textContent = valorTotal.toLocaleString();
        }
    });

    cantidadDiasInput.addEventListener("change", function() {
        var cantidadDias = parseInt(cantidadDiasInput.value);

        if (cantidadDias < 1) {

            alert("La cantidad de días no puede ser menor a 1.");
            cantidadDiasInput.value = 1;
            var valorTotal = 20000;
            valorTotalElement.textContent = valorTotal.toLocaleString();
        }
    });

    cantidadDiasInput2.addEventListener("input", function() {
        var cantidadDias = parseInt(cantidadDiasInput.value);

        $.ajax({
            type: 'POST',
            url: '../../App/Modules/CalculoPrevioReserva/CalculoPrevioReserva_Negocios.php',
            data: {
                cantidadDias: cantidadDias
            },
            dataType: 'json',
            success: function(response) {

                if(response.cantidadDias == 0){
                    valorTotalElement.textContent = 0;
                }
                else if(response.cantidadDias == 1){
                    var valorTotal = 20000;
                    valorTotalElement.textContent = valorTotal.toLocaleString();
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr);
                console.log(status);
                console.log(error);
                alert('Error al calcular el valor total.');
            }
        });
    });
});