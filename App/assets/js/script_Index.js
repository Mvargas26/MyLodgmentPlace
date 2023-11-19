document.addEventListener('DOMContentLoaded', function () {
    window.addEventListener('load', function(){
        //##################################################################################################
        //PETICION PARA TRAER LOS INMUEBLES
        //##################################################################################################
        $.ajax({
            url: "App/Modules/Inmueble/inmueble_Negocios.php",
            type: "POST",
           
            success: function(response) 
            {

                const portfolioContainer = document.getElementById('portfolioContainer');

                var respuestaJSON = JSON.parse(response);


                respuestaJSON.forEach(function(item) {

                });


            },
            error: function(textStatus, errorThrown) {
                console.error('Error en la solicitud AJAX:', textStatus, errorThrown);
            }
        });


        function obtenerImagenesInmuebles(idInmueble) { 
            $.ajax({
                url: "App/Modules/Inmueble/imagenesInmueble_Negocios.php",
                type: "POST",
                data: {
                    idInmueble: idInmueble,
                },
                success: function(response) {
                    var x = JSON.parse(response);

                }
            });


         }

    });//FIN LOAD 
});