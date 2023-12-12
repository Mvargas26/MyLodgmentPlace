document.addEventListener("DOMContentLoaded", function () {
    var formValidarInmueble = document.getElementById("formValidarInmueble");

    formValidarInmueble.addEventListener("submit", function (event) {
        event.preventDefault(); 

        var idValidacionimueble = formValidarInmueble.querySelector('input[name="idValidacionimueble"]').value;
        var nuevoEstadoSelect = formValidarInmueble.querySelector('#nuevoEstado');
        var nuevoEstado = nuevoEstadoSelect.options[nuevoEstadoSelect.selectedIndex].value;

        console.log("ID de Validación de Inmueble:", idValidacionimueble);
        console.log("Nuevo Estado:", nuevoEstado);

        // Enviar la solicitud al servidor
        enviarSolicitudAlServidorI(idValidacionimueble, nuevoEstado);
    });
});

function enviarSolicitudAlServidorI(idValidacionimueble, nuevoEstado) {
    var xhr = new XMLHttpRequest();

    xhr.open("POST", "../actualizarestado/actualizar_estado_Negocios.php", true);

    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onload = function () {
        if (xhr.status >= 200 && xhr.status < 300) {
            console.log(xhr.responseText);
        } else {
            console.error("Error en la solicitud al servidor");
        }
    };

    var datos = "idValidacionimueble=" + encodeURIComponent(idValidacionimueble) + "&nuevoEstado=" + encodeURIComponent(nuevoEstado);

    xhr.send(datos);
}
