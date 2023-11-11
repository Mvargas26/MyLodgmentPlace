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
                console.log(response);

            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error en la solicitud AJAX:', textStatus, errorThrown);
            }
        });
    



    });//FIN LOAD 
});