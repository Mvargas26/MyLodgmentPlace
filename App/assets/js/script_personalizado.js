document.addEventListener('DOMContentLoaded', function () {
    window.addEventListener('load', function(){
        //##################################################################################################
        //PETICION PARA TRAER LOS Anuncios Multiples
        //##################################################################################################
        const GridAnunciosMultiples = document.getElementById("GridAnunciosMultiples");

        if (GridAnunciosMultiples) {
            console.log("La cedula es:  "+identificacion);


            //HAcemos la peticion
            $.ajax({
                url: "../../App/Modules/Inmueble/anuncios_Negocios.php",
                type: "POST",
                data: {
                    identificacion: identificacion
                },              

                success: function(response) 
                {
                    var respuestaJSON = JSON.parse(response);

                    // respuestaJSON.forEach(function(objeto) {
                    //     console.log("ID:", objeto.id);
                    //     console.log("Nombre Inmueble:", objeto.Nombre_Inmueble);
                    //     console.log("Estado:", objeto.Estado);
                    //     console.log("Disponibilidad:", objeto.Disponibilidad);
                    // });

                    //esto llena el grid
                    var tbody = document.querySelector('#GridAnunciosMultiples tbody');
                    tbody.innerHTML = '';
            
                    // Llena la tabla con los datos obtenidos de la consulta
                    respuestaJSON.forEach(function(anuncio) {
                        var fila = '<tr>';
                        fila += '<td>' + anuncio.id + '</td>';
                        fila += '<td>' + anuncio.Nombre_Inmueble + '</td>';
                        fila += '<td>' + anuncio.Estado + '</td>';
                        fila += '<td>' + anuncio.Disponibilidad + '</td>';

                        fila += '</tr>';
                        tbody.innerHTML += fila;
                    });
    
                },
                error: function(textStatus, errorThrown) {
                    console.error('Error en la solicitud AJAX:', textStatus, errorThrown);
                }
            });



            

        }
    



    });//FIN LOAD 
});