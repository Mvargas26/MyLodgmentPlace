document.addEventListener('DOMContentLoaded', function () {
    window.addEventListener('load', function(){
        
        document.getElementById("CalifficacionPorInmueble").innerText = 0;
        document.getElementById("CantidadResenasPorInmueble").innerText = 0;
        const identificacion = document.getElementById("identificacion").value;

        $.ajax({
            url: "../../App/Modules/resenas/resenasAnfitrion_Negocios.php",
            type: "POST",
            data:{
                identificacion: identificacion
            },
            success: function(response) {
                // Verifica si response ya es un objeto
                var respuestaJSON = JSON.parse(response);
            
                console.log(respuestaJSON);
                console.log("Si esta entrando");

                var selectLugares = document.getElementById('LUGARES');

                selectLugares.innerHTML = '';
                var opcion = document.createElement('option');
                opcion.value = ""  // Suponiendo que "id" es el valor deseado para cada opción
                opcion.text = "Selecciona un lugar"  // Texto a mostrar en la opción
                selectLugares.add(opcion);

                respuestaJSON.forEach(function(anuncio) {
                    console.log("bucle for");
                    var opcion = document.createElement('option');
                    opcion.value = anuncio.id;  // Suponiendo que "id" es el valor deseado para cada opción
                    opcion.text = anuncio.Nombre_Inmueble + ' - ' + anuncio.Disponibilidad;  // Texto a mostrar en la opción
                    selectLugares.add(opcion);
                });
            
                // // Asegúrate de que 'data' sea un array antes de intentar iterar sobre él
                // if (Array.isArray(respuestaJSON.data)) {
                //     var selectLugares = document.getElementById('LUGARES');

                //     console.log("Es un Array");
                    
                //     // Elimina las opciones existentes
                //     selectLugares.innerHTML = '';
                    
                //     // Llena el select con las opciones obtenidas de la consulta
                //     respuestaJSON.data.forEach(function(anuncio) {
                //         console.log("bucle for");
                //         var opcion = document.createElement('option');
                //         opcion.value = anuncio.id;  // Suponiendo que "id" es el valor deseado para cada opción
                //         opcion.text = anuncio.Nombre_Inmueble + ' - ' + anuncio.Disponibilidad;  // Texto a mostrar en la opción
                //         selectLugares.add(opcion);
                //     });
                // } else if (typeof respuestaJSON === 'object') {
                //     // Si 'data' no es un array, trata la respuesta como un solo objeto
                //     var selectLugares = document.getElementById('LUGARES');
                //     selectLugares.innerHTML = '';
            
                //     var opcion = document.createElement('option');
                //     opcion.value = respuestaJSON.id;  // Suponiendo que "id" es el valor deseado para la opción única
                //     opcion.text = respuestaJSON.Nombre_Inmueble + ' - ' + respuestaJSON.Disponibilidad;  // Texto a mostrar en la opción
                //     selectLugares.add(opcion);
                // } else {
                //     console.error('La propiedad "data" no es un array o un objeto:', respuestaJSON.data);
                // }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error en la solicitud AJAX:', textStatus, errorThrown);
            }
        });
    });
}); 


document.addEventListener('DOMContentLoaded', function() {
    $('#LUGARES').on('change', function() {
        var lugarSeleccionado = $(this).val();
    
        console.log("evento change!")
        console.log(lugarSeleccionado);
        $('#idInmueble').val(lugarSeleccionado);

        var idInmueble = document.getElementById("idInmueble").value;

    
        $.ajax({
            url: "../../App/Modules/resenas/resenasAnfitrion_Negocios.php",
            type: 'POST',
            data: {
                lugarSeleccionado: lugarSeleccionado
            },
            success: function(response) {
                var respuestaJSON = JSON.parse(response , true);
    
                console.log("Entra")
                console.log(respuestaJSON);
    
                var swiperWrapper = document.querySelector('#testimonials-slider .swiper-wrapper');
                swiperWrapper.innerHTML = ''; // Limpia el contenido actual

                console.log(swiperWrapper);
    
                if (respuestaJSON && respuestaJSON.length > 0) {
                    respuestaJSON.forEach(function(item) {
                        console.log("Entro al bucle de las reseñas");

                        var nuevoSlide = document.createElement('div');
                        // nuevoSlide.classList.add('swiper-slide');
                
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

        $.ajax({
            url: "../../App/Modules/resenas/resenasAnfitrion_Negocios.php",
            type: 'POST',
            data: {
                idInmueble: idInmueble
            },
            success: function(response) {
    
                console.log("Entra")
                console.log(response);
    
                var promedioESTRELLAS = response.PromedioEstrellas;
                var counttotales = response.CantidadResenasTotales;

                promedioESTRELLAS = parseFloat(promedioESTRELLAS).toFixed(1);

                console.log(promedioESTRELLAS);
                console.log(counttotales);

                promedioESTRELLAS = (isNaN(parseFloat(promedioESTRELLAS)) ? 0 : parseFloat(promedioESTRELLAS)).toFixed(1);
                counttotales = (isNaN(counttotales) ? 0 : counttotales);

                
                // Actualizar el elemento con id="CalifficacionPorInmueble" con el valor de 'promedio'
                // document.getElementById("CalifficacionPorInmueble").setAttribute("data-purecounter-end", promedio);
                document.getElementById("CalifficacionPorInmueble").innerText = promedioESTRELLAS;

                // Actualizar el elemento con id="CantidadResenasPorInmueble" con el valor de 'count'
                document.getElementById("CantidadResenasPorInmueble").innerText = counttotales;
               
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error en la solicitud AJAX:', textStatus, errorThrown);
            }
        }); //fin ajax 2

    }); // fin evento on  change
    
});

 
