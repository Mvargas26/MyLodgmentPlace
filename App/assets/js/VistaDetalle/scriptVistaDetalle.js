document.addEventListener('DOMContentLoaded', function () {
    window.addEventListener('load', function(){
        const btnAgregarFavoritos = document.getElementById("btnAgregarFavoritos");

        if (btnAgregarFavoritos) {
            console.log("estoy en el JS de la vista detalle ");


            // btnAgregarFavoritos.addEventListener('click', function () {
            //     // Realiza la petición AJAX
            //     fetch('../../App/Modules/Inmueble/listaFavoritos_Negocios.php')
            //       .then(response => {
            //         if (!response.ok) {
            //           throw new Error('Error en la petición AJAX');
            //         }
            //         return response.json();
            //       })
            //       .then(data => {
            //         // Procesa los datos obtenidos
            //         const optionsHTML = data.map(option => {
            //           return `<label><input type="radio" name="favorito" value="${option.value}">${option.label}</label>`;
            //         }).join('');
          
            //         // Abre el modal de SweetAlert2 con el contenido dinámico
            //         Swal.fire({
            //           title: 'Agregar a Favoritos',
            //           html: optionsHTML,
            //           showCancelButton: true,
            //           confirmButtonText: 'Agregar',
            //           cancelButtonText: 'Cerrar',
            //           preConfirm: () => {
            //             // Obtiene el valor del radio seleccionado
            //             const favorito = document.querySelector('input[name="favorito"]:checked');
            //             if (!favorito) {
            //               Swal.showValidationMessage('Debes seleccionar una opción');
            //             }
            //             return favorito.value;
            //           }
            //         }).then((result) => {
            //           // Maneja la lógica después de hacer clic en "Agregar" o "Cerrar"
            //           if (result.isConfirmed) {
            //             // Lógica para agregar a la lista seleccionada
            //             const listaSeleccionada = result.value;
            //             Swal.fire(`Añadido a la lista: ${listaSeleccionada}`);
            //           } else {
            //             // Lógica para cerrar el modal sin hacer nada
            //             Swal.fire('Operación cancelada');
            //           }
            //         });
            //       })
            //       .catch(error => {
            //         console.error('Error:', error);
            //         // Manejar errores, por ejemplo, mostrar un mensaje de error en el modal
            //         Swal.fire('Error', 'Ocurrió un error al cargar los datos', 'error');
            //       });
            //   });
            















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
                         ' <input type="radio" name="pregunta" value="pregunta1" id="pregunta1">'+
                        '  <label for="pregunta1">pregunta1</label>'+
                        '  <input type="radio" name="pregunta" value="pregunta2" id="pregunta2">'+
                         ' <label for="pregunta2">pregunta2</label>'+
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
                      Swal.fire('Operación cancelada');
                    }
                  }); //fin del Swal.fire
              }); //fin del  btnAgregarFavoritos.addEventListener
        }//fin del if boton existe
    });//FIN LOAD 
});