document.addEventListener('DOMContentLoaded', function () {
    window.addEventListener('load', function(){

        //id huesped
        var identificacion = document.getElementById("identificacion").value;

        document.getElementById("CalificacionRecibida").innerText = 0;

        //EN ESTE LOAD OCUPO CARGAR TODAS LAS RESEÑAS

        // CARGA TODAS LAS RESEÑAS QUE HAS REALIZADO
        $.ajax({
            url: "../../App/Modules/resenas/resenasHuesped_Negocios.php",
            type: 'POST',
            data: {
                identificacion: identificacion
            },
            success: function(response) {
                var respuestaJSON = JSON.parse(response , true);
    
                console.log("encontro tus reseñas (huesped)")
                console.log(respuestaJSON);
    
                var swiperWrapper = document.querySelector('#testimonials-slider .swiper-wrapper');
                swiperWrapper.innerHTML = ''; // Limpia el contenido actual

                console.log(swiperWrapper);
    
                if (respuestaJSON && respuestaJSON.length > 0) {
                    respuestaJSON.forEach(function(item) {
                        console.log("Entro al bucle de las reseñas");
                        var nuevoSlide = document.createElement('div');
                        nuevoSlide.classList.add('swiper-slide' , 'slidetamanio');
                
                        var testimonialItem = document.createElement('div');
                        testimonialItem.classList.add('testimonial-item');

                        var parrafo = document.createElement('p');
                        parrafo.id = "p";
                
                        // Agregar el ícono de comillas izquierdas
                        var iconoIzquierdo = document.createElement('i');
                        iconoIzquierdo.classList.add('bx', 'bxs-quote-alt-left', 'quote-icon-left');
                        parrafo.appendChild(iconoIzquierdo);
                
                        // Agregar el contenido de la descripción
                        var contenidoDescripcion = document.createTextNode(item.Descripcion);
                        parrafo.appendChild(contenidoDescripcion);
                
                        // Agregar el ícono de comillas derechas
                        var iconoDerecho = document.createElement('i');
                        iconoDerecho.classList.add('bx', 'bxs-quote-alt-right', 'quote-icon-right');
                        parrafo.appendChild(iconoDerecho);

                        parrafo.appendChild(iconoDerecho);
                        
                        var imagen = document.createElement('img');
                        imagen.src = item.fotoperfil;
                        imagen.classList.add('testimonial-img');
                        imagen.alt = '';
                        
                        var h3Nombre = document.createElement('h3');
                        h3Nombre.textContent = item.NombreUsuarioResena;
                        h3Nombre.id = "h3";                
                        var h3Fecha = document.createElement('h3');
                        h3Fecha.textContent = item.fechaResena;
                        h3Fecha.id = "h3";   
                        
                        var iconoEstrella = document.createElement('i');
                        iconoEstrella.classList.add('bi', 'bi-star-fill', 'estrella-icono');


                        var h3estrellas = document.createElement('h3');
                        h3estrellas.classList.add('naranja');
                        h3estrellas.appendChild(iconoEstrella);  
                        h3estrellas.innerHTML += " " + item.estrellas; 
                        h3estrellas.id = "h3";
  
                
                        testimonialItem.appendChild(parrafo);
                        testimonialItem.appendChild(imagen);
                        testimonialItem.appendChild(h3Nombre);
                        testimonialItem.appendChild(h3Fecha);
                        testimonialItem.appendChild(h3estrellas);
                
                        // swiperWrapper.classList.add('disable-transition');
                        nuevoSlide.appendChild(testimonialItem);
                        swiperWrapper.appendChild(nuevoSlide);
                    }); //end foreach
                    
                    var nuevoSlideVacio = document.createElement('div');
                    nuevoSlideVacio.classList.add('swiper-slide', 'slidetamanio');
                    swiperWrapper.appendChild(nuevoSlideVacio);
                    // Swiper.prependSlide(nuevoSlideVacio);
                    
                } else {
                    // No hay reseñas, crear un párrafo indicando esto
                    var noResenasParrafo = document.createElement('p');
                    noResenasParrafo.textContent = 'No tienes reseñas aún';
                    swiperWrapper.appendChild(noResenasParrafo);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error en la solicitud AJAX:', textStatus, errorThrown);
            }
        }); // fin ajax 1


         // CARGA TODAS LAS RESEÑAS QUE TE HAN HECHO 
         $.ajax({
            url: "../../App/Modules/resenas/resenasHuesped_Negocios.php",
            type: 'POST',
            data: {
                identificacion_ResenasRecibidas: identificacion
            },
            success: function(response) {
                var respuestaJSON = JSON.parse(response , true);
    
                console.log("encontro tus reseñas recibidas (huesped)")
                console.log(respuestaJSON);
    
                var swiperWrapper = document.querySelector('#testimonials-slider2 .swiper-wrapper');
                swiperWrapper.innerHTML = ''; // Limpia el contenido actual

                console.log(swiperWrapper);
    
                if (respuestaJSON && respuestaJSON.length > 0) {
                    respuestaJSON.forEach(function(item) {
                        console.log("Entro al bucle de las reseñas 2");
                        var nuevoSlide = document.createElement('div');
                        nuevoSlide.classList.add('swiper-slide' , 'slidetamanio');
                
                        var testimonialItem = document.createElement('div');
                        testimonialItem.classList.add('testimonial-item');

                        var parrafo = document.createElement('p');
                        parrafo.id = "p";
                
                        // Agregar el ícono de comillas izquierdas
                        var iconoIzquierdo = document.createElement('i');
                        iconoIzquierdo.classList.add('bx', 'bxs-quote-alt-left', 'quote-icon-left');
                        parrafo.appendChild(iconoIzquierdo);
                
                        // Agregar el contenido de la descripción
                        var contenidoDescripcion = document.createTextNode(item.comentario);
                        parrafo.appendChild(contenidoDescripcion);
                
                        // Agregar el ícono de comillas derechas
                        var iconoDerecho = document.createElement('i');
                        iconoDerecho.classList.add('bx', 'bxs-quote-alt-right', 'quote-icon-right');
                        parrafo.appendChild(iconoDerecho);

                        parrafo.appendChild(iconoDerecho);
                        
                        var imagen = document.createElement('img');
                        imagen.src = item.fotoPerfilCalificador;
                        imagen.classList.add('testimonial-img');
                        imagen.alt = '';
                        
                        var h3Nombre = document.createElement('h3');
                        h3Nombre.textContent = item.nombreAnfitrion;
                        h3Nombre.id = "h3";                
                        
                        var iconoEstrella = document.createElement('i');
                        iconoEstrella.classList.add('bi', 'bi-star-fill', 'estrella-icono');
                        
                        
                        var h3estrellas = document.createElement('h3');
                        h3estrellas.classList.add('naranja');
                        h3estrellas.appendChild(iconoEstrella);  
                        h3estrellas.innerHTML += " " + item.estrellas; 
                        h3estrellas.id = "h3";
                        
                        var h3nombreInmueble = document.createElement('h3');
                        h3nombreInmueble.textContent = "Sobre tu estadia en: " + item.nombreInmueble;
                        h3nombreInmueble.id = "h3";   
                
                        testimonialItem.appendChild(parrafo);
                        testimonialItem.appendChild(imagen);
                        testimonialItem.appendChild(h3Nombre);
                        testimonialItem.appendChild(h3nombreInmueble);
                        testimonialItem.appendChild(h3estrellas);
                
                        // swiperWrapper.classList.add('disable-transition');
                        nuevoSlide.appendChild(testimonialItem);
                        swiperWrapper.appendChild(nuevoSlide);
                    }); //end foreach
                    
                    var nuevoSlideVacio = document.createElement('div');
                    nuevoSlideVacio.classList.add('swiper-slide', 'slidetamanio');
                    swiperWrapper.appendChild(nuevoSlideVacio);
                    // Swiper.prependSlide(nuevoSlideVacio);
                    
                } else {
                    // No hay reseñas, crear un párrafo indicando esto
                    var noResenasParrafo = document.createElement('p');
                    noResenasParrafo.textContent = 'No tienes reseñas aún';
                    swiperWrapper.appendChild(noResenasParrafo);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error en la solicitud AJAX:', textStatus, errorThrown);
            }
        }); // fin ajax 1.1


        // CARGA LOS LUGARES QUE FILTRARAN TUS RESENAS HUESPED
        $.ajax({
            url: "../../App/Modules/resenas/resenasHuesped_Negocios.php",
            type: "POST",
            data:{
                identificacion_Filtro: identificacion
            },
            success: function(response) {
                // Verifica si response ya es un objeto
                var respuestaJSON = JSON.parse(response);
            
                console.log(respuestaJSON);
                console.log("Si esta entrando");

                var selectLugares = document.getElementById('LUGARES_RESERVADOS');

                selectLugares.innerHTML = '';
                var opcion = document.createElement('option');
                opcion.value = "0"  // Suponiendo que "id" es el valor deseado para cada opción
                opcion.text = "VER TODAS"  // Texto a mostrar en la opción
                selectLugares.add(opcion);

                respuestaJSON.forEach(function(anuncio) {
                    console.log("bucle for");
                    var opcion = document.createElement('option');
                    opcion.value = anuncio.id;  // Suponiendo que "id" es el valor deseado para cada opción
                    opcion.text = anuncio.Nombre_Inmueble + ' - ' + anuncio.Disponibilidad;  // Texto a mostrar en la opción
                    selectLugares.add(opcion);
                });
            
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error en la solicitud AJAX:', textStatus, errorThrown);
            }
        });//fin del ajax 2


        var promedioCalificacionRecibida = 1;

        //CARGA EL PROMEDIO DE LA CALIFICACION RECIBIDA
        $.ajax({
            url: "../../App/Modules/resenas/resenasHuesped_Negocios.php",
            type: 'POST',
            data: {
                promedioCalificacionRecibida: promedioCalificacionRecibida,
                idHuesped: identificacion
            },
            success: function(response) {
                console.log("Entra");
                console.log(response);
            
                var promedioCalificacionRecibida_Resultado = parseFloat(response).toFixed(1);
            
                console.log(promedioCalificacionRecibida_Resultado);            
                document.getElementById("CalificacionRecibida").innerText = promedioCalificacionRecibida_Resultado;
            },
            
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error en la solicitud AJAX:', textStatus, errorThrown);
            }
        }); //fin ajax 3

    });
}); 



// FILTA LAS RESENAS POR LUGAR DE RESERVA
// EVENTO CHANGE PARA FILTRAR TUS RESENAS POR LUGAR
document.addEventListener('DOMContentLoaded', function() {
    $('#LUGARES_RESERVADOS').on('change', function() {
        var lugarSeleccionado = $(this).val();
    
        console.log("evento change!")
        console.log(lugarSeleccionado);
        
        if(lugarSeleccionado == 0){
            var identificacion = document.getElementById("identificacion").value;

            //EN ESTE LOAD OCUPO CARGAR TODAS LAS RESEÑAS
            // CARGA TODAS LAS RESEÑAS QUE HAS REALIZADO
            $.ajax({
                url: "../../App/Modules/resenas/resenasHuesped_Negocios.php",
                type: 'POST',
                data: {
                    identificacion: identificacion
                },
                success: function(response) {
                    var respuestaJSON = JSON.parse(response , true);
        
                    console.log("encontro tus reseñas (huesped)")
                    console.log(respuestaJSON);
        
                    var swiperWrapper = document.querySelector('#testimonials-slider .swiper-wrapper');
                    swiperWrapper.innerHTML = ''; // Limpia el contenido actual
    
                    console.log(swiperWrapper);
        
                    if (respuestaJSON && respuestaJSON.length > 0) {
                        respuestaJSON.forEach(function(item) {
                            console.log("Entro al bucle de las reseñas");
                            var nuevoSlide = document.createElement('div');
                            nuevoSlide.classList.add('swiper-slide');
                    
                            var testimonialItem = document.createElement('div');
                            testimonialItem.classList.add('testimonial-item');
    
                            var parrafo = document.createElement('p');
                            parrafo.id = "p";
                    
                            // Agregar el ícono de comillas izquierdas
                            var iconoIzquierdo = document.createElement('i');
                            iconoIzquierdo.classList.add('bx', 'bxs-quote-alt-left', 'quote-icon-left');
                            parrafo.appendChild(iconoIzquierdo);
                    
                            // Agregar el contenido de la descripción
                            var contenidoDescripcion = document.createTextNode(item.Descripcion);
                            parrafo.appendChild(contenidoDescripcion);
                    
                            // Agregar el ícono de comillas derechas
                            var iconoDerecho = document.createElement('i');
                            iconoDerecho.classList.add('bx', 'bxs-quote-alt-right', 'quote-icon-right');
                            parrafo.appendChild(iconoDerecho);
    
                            parrafo.appendChild(iconoDerecho);
                            
                            var imagen = document.createElement('img');
                            imagen.src = item.fotoperfil;
                            imagen.classList.add('testimonial-img');
                            imagen.alt = '';
                            
                            var h3Nombre = document.createElement('h3');
                            h3Nombre.textContent = item.NombreUsuarioResena;
                            h3Nombre.id = "h3";                
                            var h3Fecha = document.createElement('h3');
                            h3Fecha.textContent = item.fechaResena;
                            h3Fecha.id = "h3";   
                            
                            var iconoEstrella = document.createElement('i');
                            iconoEstrella.classList.add('bi', 'bi-star-fill', 'estrella-icono');
    
    
                            var h3estrellas = document.createElement('h3');
                            h3estrellas.classList.add('naranja');
                            h3estrellas.appendChild(iconoEstrella);  
                            h3estrellas.innerHTML += " " + item.estrellas; 
                            h3estrellas.id = "h3";
      
                    
                            testimonialItem.appendChild(parrafo);
                            testimonialItem.appendChild(imagen);
                            testimonialItem.appendChild(h3Nombre);
                            testimonialItem.appendChild(h3Fecha);
                            testimonialItem.appendChild(h3estrellas);
                    
                            swiperWrapper.classList.add('disable-transition');
                            nuevoSlide.appendChild(testimonialItem);
                            swiperWrapper.appendChild(nuevoSlide);
                        }); //end foreach
    
                    } else {
                        // No hay reseñas, crear un párrafo indicando esto
                        var noResenasParrafo = document.createElement('p');
                        noResenasParrafo.textContent = 'No tienes reseñas aún';
                        swiperWrapper.appendChild(noResenasParrafo);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Error en la solicitud AJAX:', textStatus, errorThrown);
                }
            }); // fin ajax 1
    
        }
        else{


            $('#idInmueble').val(lugarSeleccionado);
            
            var idInmueble = document.getElementById("idInmueble").value;
            var identificacion = document.getElementById("identificacion").value;
            var idHuesped = identificacion;
            
            console.log(identificacion);
            $.ajax({
                url: "../../App/Modules/resenas/resenasHuesped_Negocios.php",
                type: 'POST',
                data: {
                    lugarSeleccionado_FiltrarInmueble: lugarSeleccionado,
                    idHuesped: idHuesped
                },
                success: function(response) {

                    console.log(response);
                    // var respuestaJSON = JSON.parse(response);
        
                    console.log("Entra")
                    // console.log(respuestaJSON);
        
                    var swiperWrapper = document.querySelector('#testimonials-slider .swiper-wrapper');
                    swiperWrapper.innerHTML = ''; // Limpia el contenido actual
                    
                    console.log(swiperWrapper);
                    
                    if (response && typeof response === 'object') {
                        response.forEach(function(item) {
                            console.log("Entro al bucle de las reseñas");
                            var nuevoSlide = document.createElement('div');
                            nuevoSlide.classList.add('swiper-slide');
                    
                            var testimonialItem = document.createElement('div');
                            testimonialItem.classList.add('testimonial-item');
                            
                            var parrafo = document.createElement('p');
                            parrafo.id = "p";
                            
                            // Agregar el ícono de comillas izquierdas
                            var iconoIzquierdo = document.createElement('i');
                            iconoIzquierdo.classList.add('bx', 'bxs-quote-alt-left', 'quote-icon-left');
                            parrafo.appendChild(iconoIzquierdo);
                            
                            // Agregar el contenido de la descripción
                            var contenidoDescripcion = document.createTextNode(item.Descripcion);
                            parrafo.appendChild(contenidoDescripcion);
                            
                            // Agregar el ícono de comillas derechas
                            var iconoDerecho = document.createElement('i');
                            iconoDerecho.classList.add('bx', 'bxs-quote-alt-right', 'quote-icon-right');
                            parrafo.appendChild(iconoDerecho);
                            
                            parrafo.appendChild(iconoDerecho);
                            
                            var imagen = document.createElement('img');
                            imagen.src = item.fotoperfil;
                            imagen.classList.add('testimonial-img');
                            imagen.alt = '';
                            
                            var h3Nombre = document.createElement('h3');
                            h3Nombre.textContent = item.NombreUsuarioResena;
                            h3Nombre.id = "h3";                
                            var h3Fecha = document.createElement('h3');
                            h3Fecha.textContent = item.fechaResena;
                            h3Fecha.id = "h3";   
                            
                            var iconoEstrella = document.createElement('i');
                            iconoEstrella.classList.add('bi', 'bi-star-fill', 'estrella-icono');
                            

                            var h3estrellas = document.createElement('h3');
                            h3estrellas.classList.add('naranja');
                            h3estrellas.appendChild(iconoEstrella);  
                            h3estrellas.innerHTML += " " + item.estrellas; 
                            h3estrellas.id = "h3";
                            
                            
                            testimonialItem.appendChild(parrafo);
                            testimonialItem.appendChild(imagen);
                            testimonialItem.appendChild(h3Nombre);
                            testimonialItem.appendChild(h3Fecha);
                            testimonialItem.appendChild(h3estrellas);
                            
                            nuevoSlide.appendChild(testimonialItem);
                            swiperWrapper.appendChild(nuevoSlide);
                            
                            swiperWrapper.classList.add('disable-transition');
                        }); //end foreach

                    } else {
                        // No hay reseñas, crear un párrafo indicando esto
                        var noResenasParrafo = document.createElement('p');
                        noResenasParrafo.textContent = 'No tiene reseñas aún';
                        swiperWrapper.appendChild(noResenasParrafo);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Error en la solicitud AJAX:', textStatus, errorThrown);
                }
            }); // fin ajax 1
        }
            

            
            // PENDIENTE
            // INDICADORES
            // ----------------------------------------------
            
            
            // $.ajax({
                //     url: "../../App/Modules/resenas/resenasAnfitrion_Negocios.php",
        //     type: 'POST',
        //     data: {
        //         idInmueble: idInmueble
        //     },
        //     success: function(response) {
    
        //         console.log("Entra")
        //         console.log(response);
    
        //         var promedio = response.PromedioEstrellas;
        //         var count = response.CantidadResenasTotales;

        //         promedio = parseFloat(promedio).toFixed(1);

        //         console.log(promedio);
        //         console.log(count);

        //         // Actualizar el elemento con id="CalifficacionPorInmueble" con el valor de 'promedio'
        //         // document.getElementById("CalifficacionPorInmueble").setAttribute("data-purecounter-end", promedio);
        //         document.getElementById("CalifficacionPorInmueble").innerText = promedio;

        //         // Actualizar el elemento con id="CantidadResenasPorInmueble" con el valor de 'count'
        //         document.getElementById("CantidadResenasPorInmueble").innerText = count;
               
        //     },
        //     error: function(jqXHR, textStatus, errorThrown) {
        //         console.error('Error en la solicitud AJAX:', textStatus, errorThrown);
        //     }
        // }); //fin ajax 2

    }); // fin evento on  change
    
});

 
