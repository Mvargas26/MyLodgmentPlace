document.addEventListener("DOMContentLoaded", function () {
    var btnValidate = document.getElementById("btn-validate");

    btnValidate.addEventListener("click", function () {
        
        var idValidacionPerfil = obtenerIdValidacionPerfil(); 
        var nuevoEstado = "Activado"; 

        enviarSolicitudAlServidor(idValidacionPerfil, nuevoEstado);
    });
});

// Función para obtener el ID de la validación de perfil (debe implementarse según tu lógica)
function obtenerIdValidacionPerfil() {
    // Implementa la lógica para obtener el ID de la validación de perfil
    // Puede ser a través de algún elemento en la página o mediante AJAX
    // Retorna el ID obtenido
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
