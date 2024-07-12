document.addEventListener('DOMContentLoaded', function () {
    window.addEventListener('load', function(){

        //id huesped
        var identificacion = document.getElementById("identificacion").value;

        console.log(identificacion);
        // document.getElementById("CalificacionRecibida").innerText = 0;
        const panelchat = this.document.querySelector(".panel-chat");
        const sendBtn = document.getElementById("SendBtn");
        const RecargarMensajesBTN = document.getElementById("RecargarMensajes");



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
                        nuevoUsuario.id="Especial2";
            
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
                        nombreInmueble.textContent = "Dueño de: " + item.nombreInmueble;

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

        // EVENTO ON CLICK

        RecargarMensajesBTN.addEventListener("click", () =>{
            const idReceptor = document.getElementById("idReceptor").value;

            if(idReceptor.trim() === ''){

            }
            else{

                
                var contenedorSpinner = document.createElement('div');
                contenedorSpinner.className = 'contenedorSpinner';
                
                var spinner = document.createElement('div');
                spinner.className = 'spinner';
                contenedorSpinner.appendChild(spinner);

                panelchat.innerHTML = '';
                panelchat.appendChild(contenedorSpinner);
                
                RecargarMensajes(idReceptor);
            }   
        });

        sendBtn.addEventListener("click", () => {
            event.preventDefault();
            
            const mensaje = document.getElementById("mensaje").value;
            console.log("RECONOCE EL EVENTO ONCLICK")
            

            if(mensaje.trim() === ''){
                //SI ESTA VACIO NO HACE NADA
            }
            else{

             // Captura los valores del formulario
                const idEmisor = document.getElementById("idEmisor").value;
                const idReceptor = document.getElementById("idReceptor").value;
                console.log(idEmisor);
                console.log(idReceptor);
                console.log(mensaje);
                
                const formData = {
                    idEmisor: idEmisor,
                    idReceptor: idReceptor,
                    mensaje: mensaje,
                };
        
                $.ajax({
                    url: "../../App/Modules/Mensajes/mensajes_Negocios.php",
                    type: "POST",
                    data: formData ,
                    success: function (response) {
                        var x = JSON.parse(response);
                        if (x.exito) {
                            document.getElementById("mensaje").value = "";
                            // aqui enviara otro post para recargar inmediatamete los mensajes 

                            RecargarMensajes(idReceptor);

                            Swal.fire({
                                title: 'Enviando tu Mensaje',
                                html: '<div class="loader"></div>',
                                showConfirmButton: false,
                                onBeforeOpen: () => {
                                    Swal.getContent().querySelector('.loader').innerHTML = '<i class="fas fa-circle-notch fa-spin"></i>';
                                },
                                timer: 3000, 
                                timerProgressBar: true, 
                            }).then((result) => {
                                if (result.dismiss === Swal.DismissReason.timer) {
                                    console.log('Cerrado automáticamente después de 3 segundos');
                                }
                            });

                        } else {
                            console.log(x.error); // Puedes mostrar o registrar el mensaje de error
                            Swal.fire("Error", "Lo sentimos, ocurrió un error.", "error");
                        }
                    }
                }); //end ajax 2
            }//end else

        });//end evento on click

        
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
        var idUsuarioLogueado  = document.getElementById("identificacion").value;

        const chatBox = document.querySelector(".panel-chat");

        document.getElementById("idFotoPerfil_chatseleccionado").src = fotoPerfilAnfitrion;
        document.getElementById("NombreAnfitrionSeleccionado").textContent = nombreAnfitrion;

        document.getElementById("idPropietario_Elegido").value = idPropietario;
        
        var panelEscritura = document.querySelector('.panel-escritura');

        panelEscritura.style.display = 'block';
        document.getElementById("idEmisor").value = idUsuarioLogueado;
        document.getElementById("idReceptor").value = idPropietario;


        // Puedes agregar más asignaciones según sea necesario

        if (idPropietario) {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "../../App/Modules/Mensajes/mensajes_negocios.php", true);
            xhr.onload = () => {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        let data = xhr.response;
                        chatBox.innerHTML = data;
                        chatBox.scrollTop = chatBox.scrollHeight;
                        // if (!chatBox.classList.contains("active")) {
                        //     scrollToBottom();
                        // }
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

function RecargarMensajes(idAnfitrion){

    try {
        const chatBox = document.querySelector(".panel-chat");

        var idUsuarioLogueado  = document.getElementById("identificacion").value;

        document.getElementById("idEmisor").value = idUsuarioLogueado;
        document.getElementById("idReceptor").value = idAnfitrion;


        if (idAnfitrion) {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "../../App/Modules/Mensajes/mensajes_negocios.php", true);
            xhr.onload = () => {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        let data = xhr.response;
                        chatBox.innerHTML = data;
                        chatBox.scrollTop = chatBox.scrollHeight;
                        // if (!chatBox.classList.contains("active")) {
                        //     // scrollToBottom();
                        // }
                    }
                }
            };
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("incoming_id=" +  encodeURIComponent(idAnfitrion) + "&idUsuarioLogueado=" + encodeURIComponent(idUsuarioLogueado));
        } else {
            chatBox.innerHTML = '<div class="text">No hay mensajes disponibles. Una vez que envíe el mensaje, aparecerán aquí.</div>';
        }
        

    } catch (error) {
        console.error("Error al asignar valores:", error.message);
    }


}