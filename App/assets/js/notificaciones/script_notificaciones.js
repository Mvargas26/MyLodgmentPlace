//###############################################################################################################################
    //Notificaciones
    //###############################################################################################################################
    window.addEventListener("load", function() 
    {
        // Realiza una solicitud GET al cargar la página
        console.log("FUNCION Notificaciones")
        // const ObtenerNotificaciones = {
        //     ObtenerNotificaciones : "ObtenerNotificaciones"
        // };
        const GridNotificacionesAnfitrion = document.getElementById("GridNotificacionesAnfitrion");

        if (GridNotificacionesAnfitrion) {

            console.log("Entra al if")
            console.log(identificacion)
            $.ajax({
                url: "../../App/Modules/Notificaciones/notificaciones_Negocios.php",
                type: "POST",
                data: {
                    identificacion: identificacion
                }, 
                success: function(response) {
                    var respuestaJSON = JSON.parse(response);
                
                    respuestaJSON.forEach(function(notificacion, index) {
                        // Crear un nuevo div para cada notificación
                        var nuevoGrid = document.createElement("div");
                        nuevoGrid.classList.add("GridNotificacionesAnfitrion");
                        nuevoGrid.id = "GridNotificacionesAnfitrion" ;
                
                        // Crear el icono
                        var nuevoIcono = document.createElement("i");
                        nuevoIcono.classList.add("bi", "bi-exclamation");
                        nuevoIcono.id = "iconAlert";
                
                        // Crear el párrafo y agregar el texto de la descripción
                        var nuevoParrafo = document.createElement("p");
                        nuevoParrafo.textContent = notificacion.descripcion;
                
                        // Crear el span y agregar la fecha
                        var nuevoSpan = document.createElement("span");
                        nuevoSpan.textContent = notificacion.fecha;
                
                        // Agregar los elementos al nuevo div
                        nuevoGrid.appendChild(nuevoIcono);
                        nuevoGrid.appendChild(nuevoParrafo);
                        nuevoGrid.appendChild(nuevoSpan);
                
                        // Agregar el nuevo div al contenedor existente
                        var contenedor = document.getElementById("divGridNotificacionesAnfitrion");
                        contenedor.appendChild(nuevoGrid);

                        
                        // Agregar un <hr/> entre cada elemento, excepto después del último
                        if (index < respuestaJSON.length - 1) {
                            var hr = document.createElement("hr");
                            contenedor.appendChild(hr);
                        }
                    });
                },
                error: function(textStatus, errorThrown) {
                    console.error('Error en la solicitud AJAX:', textStatus, errorThrown);
                }
            }); //end ajax
        }
    });




    
