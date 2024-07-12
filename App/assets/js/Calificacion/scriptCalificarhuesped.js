document.addEventListener('DOMContentLoaded', function () {
    window.addEventListener('load', function(){

        const formCalificarHuesped = document.getElementById("formCalificarHuesped");
        var btnEnviarCalificacion = document.getElementById("btnEnviarCalificacion");

        if (typeof identificacion === "undefined" || identificacion === null) {
            btnEnviarCalificacion.disabled = true;
        }else{
            btnEnviarCalificacion.disabled = false;
        }
        
        if (formCalificarHuesped) {
            formCalificarHuesped.addEventListener('submit',function () {
                event.preventDefault();

            const ReservaCalificar = document.getElementById("ReservaCalificar").value;
            const comentarioCalificacion = document.getElementById("resenaTextarea").value;
            const estrellasSeleccionadas = document.getElementById("estrellasSeleccionadas").value;
            const cedAnfitrionCalifica = identificacion;
            const Rol = rol;

            console.log(ReservaCalificar);
            console.log(cedAnfitrionCalifica);

            const formData = {
                ReservaCalificar,
                comentarioCalificacion,
                estrellasSeleccionadas,
                cedAnfitrionCalifica,
                Rol
            };


            $.ajax({
                url: "../../App/Modules/Calificar/calificarhuesped_Negocios.php",
                type: "POST",
                data: {formData: formData},              
                success: function(response) 
                {

                    var x = JSON.parse(response);
                    if (x.exito ) {
                        Swal.fire("Éxito", "Se guardó la calificación correctamente. ", "success");//mensaje bonito
                        setTimeout(function() {
                            location.reload(true);
                            },
                         2000);
                    } else {
                        console.log(x.response);
                        Swal.fire("Error", "Lo sentimos, ocurrió un error.", "error");
                    }
    
                },
                error: function(textStatus, errorThrown) {
                    console.error('Error en la solicitud AJAX:', textStatus, errorThrown);
                 }
            });


            
        
        
        
        
        
        
        
        
        });//fin evento listener del boton
        }
    });//FIN LOAD 
});