document.addEventListener('DOMContentLoaded', function () {
    window.addEventListener('load', function(){

        var cedula = 304710908;
        const btnAgregarFavoritos = document.getElementById("btnAgregarFavoritos");

        if (btnAgregarFavoritos) {
            console.log("estoy en el JS de la vista detalle ");

            // // **************************************************************************** */
            // // **************************No Borrrar ******************************** */
            btnAgregarFavoritos.addEventListener('click',function () {
                Swal.fire({

                title: 'Agregar a Favoritos',
                    html:
                      '<body id="bodyDelModalAgregarFav">'+
                      '<div id="examenModalAgregarFav">'+
                      '  <h1 id="nombrePregunta"> </h1>'+
                       ' <div id="preguntaModalAgregarFav">'+
                       traerFavoritos()+
                       ' </div>'+
                     ' </div>'+
                   ' </body>',
                    showCancelButton: true,
                    confirmButtonText: 'Agregar',
                    cancelButtonText: 'Cerrar',
                    preConfirm: () => {
                      // Obtiene el valor del radio seleccionado
                      const favorito = document.querySelector('input[name="favorito"]:checked');
                      if (!favorito) {
                        Swal.showValidationMessage('Debes seleccionar una opción');
                      }
                      return favorito.value;
                    }
                  }).then((result) => {
                    // Maneja la lógica después de hacer clic en "Agregar" o "Cerrar"
                    if (result.isConfirmed) {
                      // Lógica para agregar a la lista seleccionada
                      const listaSeleccionada = result.value;
                      Swal.fire(`Añadido a la lista: ${listaSeleccionada}`);
                    } else {
                      // Lógica para cerrar el modal sin hacer nada
                      Swal.fire('Cancelar');
                    }
                  }); //fin del Swal.fire
              }); //fin del  btnAgregarFavoritos.addEventListener
        }//fin del if boton existe



        function traerFavoritos (){
          var cedUsuario = cedula;
          $.ajax({
            url: "../../App/Modules/Inmueble/listaFavoritos_Negocios.php",
            type: "POST",
            data:{
              cedUsuario: cedUsuario
            },
            success: function(response) 
            {
                var respuestaJSON = JSON.parse(response);
                let html = '';
                respuestaJSON.forEach((favorito, index) => {
                  const item = 'pregunta' + (index + 1);
                  html +=
                    `<input type="radio" name="pregunta" value="${item}" id="${item}">` +
                    `<label for="${item}">${favorito.nombreLista}</label>`;
                });
            },
            error: function(textStatus, errorThrown) {
                console.error('Error en la solicitud AJAX:', textStatus, errorThrown);
            }
        });
        
        }
    });//FIN LOAD 
});

