document.addEventListener('DOMContentLoaded', function () {
    window.addEventListener('load', function(){

        //id huesped
        var identificacion = document.getElementById("identificacion").value;

        console.log(identificacion);
        // document.getElementById("CalificacionRecibida").innerText = 0;

        $.ajax({
            url: "../../App/Modules/Mensajes/mensajesHuesped_Negocios.php",
            type: 'POST',
            data: {
                identificacion_cargalistaContactos: identificacion
            },
            success: function(response) {
                var respuestaJSON = JSON.parse(response, true);
            
                console.log("encontro tus chats (huesped)")
                console.log(respuestaJSON);
            
                var listaUsuarios = document.querySelector('.seccion-lista-usuarios');
                listaUsuarios.innerHTML = ''; // Limpia el contenido actual
            
                console.log(listaUsuarios);

                if (respuestaJSON && respuestaJSON.length > 0) {
                    respuestaJSON.forEach(function(item) {
                        console.log("Entro al bucle de los usuarios");
                        var nuevoUsuario = document.createElement('div');
                        nuevoUsuario.classList.add('usuario');
            
                        var avatar = document.createElement('div');
                        avatar.classList.add('avatar');
            
                        var imagen = document.createElement('img');
                        imagen.src = item.fotoPerfilAnfitrion;
                        imagen.alt = 'img';
            
                        var cuerpo = document.createElement('div');
                        cuerpo.classList.add('cuerpo');
            
                        var nombreApellido = document.createElement('span');
                        nombreApellido.textContent = item.nombreAnfitrion;

                        var nombreInmueble = document.createElement('span');
                        nombreInmueble.textContent = item.nombreInmueble;

                        var inputHidden = document.createElement('input');
                        inputHidden.type = 'hidden';
                        inputHidden.value = item.idPropietario;
            
                        avatar.appendChild(imagen);
                        cuerpo.appendChild(nombreApellido);
                        cuerpo.appendChild(nombreInmueble);
                        cuerpo.appendChild(inputHidden);
            
                        nuevoUsuario.appendChild(avatar);
                        nuevoUsuario.appendChild(cuerpo);
            
                        console.log(item.idPropietario);

                        nuevoUsuario.onclick = function() {
                            // Llama a una función y pasa los parámetros necesarios
                            ElegirChat(item.idPropietario, item.fotoPerfilAnfitrion, item.nombreAnfitrion);
                        };

                        listaUsuarios.appendChild(nuevoUsuario);




                    }); //end foreach
            
                    var nuevoUsuarioVacio = document.createElement('div');
                    nuevoUsuarioVacio.classList.add('usuario');
                    listaUsuarios.appendChild(nuevoUsuarioVacio);
                } else {
                    // No hay usuarios, crear un párrafo indicando esto
                    var noUsuariosParrafo = document.createElement('p');
                    noUsuariosParrafo.textContent = 'No tienes usuarios aún';
                    listaUsuarios.appendChild(noUsuariosParrafo);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error en la solicitud AJAX:', textStatus, errorThrown);
            }
        }); // fin ajax 1
        
    });
}); //END EVENTO LOAD Y LISTENER


// <img id="idFotoPerfil_chatseleccionado" src="ruta_img" alt="img">
// </div>
// <div class="cuerpo">
//     <span id="NombreAnfitrionSeleccionado"></span>
//     <span id="NombreInmuebleSeleccionado"></span>

function ElegirChat(idPropietario, fotoPerfilAnfitrion, nombreAnfitrion){
    try {
        // Asignar valores a elementos HTML
        document.getElementById("idFotoPerfil_chatseleccionado").src = fotoPerfilAnfitrion;
        document.getElementById("NombreAnfitrionSeleccionado").textContent = nombreAnfitrion;

        document.getElementById("idPropietario_Elegido").value = idPropietario;
        

        var idUsuarioLogueado  = document.getElementById("identificacion").value;
        // Puedes agregar más asignaciones según sea necesario

        if (idPropietario) {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "../../App/Modules/Mensajes/mensajes_negocios.php", true);
            xhr.onload = () => {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        let data = xhr.response;
                        chatBox.innerHTML = data;
                        if (!chatBox.classList.contains("active")) {
                            scrollToBottom();
                        }
                    }
                }
            };
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("incoming_id=" +  encodeURIComponent(idPropietario) + "&idUsuarioLogueado=" + encodeURIComponent(idUsuarioLogueado));
        } else {
            chatBox.innerHTML = '<div class="text">11111No hay mensajes disponibles. Una vez que envíe el mensaje, aparecerán aquí.</div>';
        }
        

        // Realizar cualquier otra lógica que necesites
    } catch (error) {
        // Manejar errores
        console.error("Error al asignar valores:", error.message);
    }

}