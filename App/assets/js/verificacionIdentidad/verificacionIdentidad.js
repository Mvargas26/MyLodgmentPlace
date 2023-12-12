document.addEventListener("DOMContentLoaded", function () {
    var btnValidate = document.getElementById("btn-validate");

    btnValidate.addEventListener("click", function () {
        
        var idValidacionPerfil = obtenerIdValidacionPerfil(); 
        var nuevoEstado = "Activado"; 

        enviarSolicitudAlServidor(idValidacionPerfil, nuevoEstado);
    });
});

function obtenerIdValidacionPerfil() {
   
}


function enviarSolicitudAlServidor(idValidacionPerfil, nuevoEstado) {
   
    var xhr = new XMLHttpRequest();

    xhr.open("POST", "../ValidarIdentidad/validarIdentidad_Negocios.php", true);

    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onload = function () {
        if (xhr.status >= 200 && xhr.status < 300) {
         
            console.log(xhr.responseText);
        } else {
            
            console.error("Error en la solicitud al servidor");
        }
    };

    var datos = "idValidacionPerfil=" + encodeURIComponent(idValidacionPerfil) + "&nuevoEstado=" + encodeURIComponent(nuevoEstado);

    xhr.send(datos);
}
