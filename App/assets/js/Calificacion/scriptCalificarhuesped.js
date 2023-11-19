document.addEventListener('DOMContentLoaded', function () {
    window.addEventListener('load', function(){

        const formCalificarHuesped = document.getElementById("formCalificarHuesped");
        
        if (formCalificarHuesped) {
            formCalificarHuesped.addEventListener('submit',function () {
                event.preventDefault();

            const ReservaCalificar = document.getElementById("ReservaCalificar").value;
            const comentarioCalificacion = document.getElementById("resenaTextarea").value;
            const estrellasSeleccionadas = document.getElementById("estrellasSeleccionadas").value;
            const cedAnfitrionCalifica = identificacion;


            const formData = {
                ReservaCalificar,
                comentarioCalificacion,
                estrellasSeleccionadas,
                cedAnfitrionCalifica
            };


            $.ajax({
                url: "../../App/Modules/Calificar/calificarhuesped.php",
                type: "POST",
                data: {formData: formData},              
                success: function(response) 
                {
                    var respuestaJSON = JSON.parse(response);
                    console.log(respuestaJSON);

                   
    
                },
                error: function(textStatus, errorThrown) {
                    console.error('Error en la solicitud AJAX:', textStatus, errorThrown);
                 }
            });


            
        
        
        
        
        
        
        
        
        });//fin evento listener del boton
        }
    });//FIN LOAD 
});