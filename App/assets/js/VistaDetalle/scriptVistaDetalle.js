document.addEventListener('DOMContentLoaded', function () {
  window.addEventListener('load', function(){

      var cedula = identificacion;
      var idInmueble = 2 ;
      const btnAgregarFavoritos = document.getElementById("btnAgregarFavoritos");
      const btnAgregarLista = document.getElementById("btnAgregarLista");

     
    //   ----------------------------------------------------------------------------------------

      if (btnAgregarFavoritos) {

        function traerFavoritos() {
          return new Promise((resolve, reject) => {
              var cedUsuario = cedula;
              $.ajax({
                  url: "../../App/Modules/Inmueble/listaFavoritos_Negocios.php",
                  type: "POST",
                  data: {
                      cedUsuario: cedUsuario
                  },
                  success: function(response) {
                      var respuestaJSON = JSON.parse(response);
                      let html = '';
                      respuestaJSON.forEach((favorito, index) => {
                          const item = 'favorito' + (index + 1);
                          html += `<input type="radio" name="favorito" value="${favorito.idLista}" id="${item}">` +
                              `<label for="${item}">${favorito.nombreLista}</label>`;
                      });
                      resolve(html); // Resuelve la promesa con el HTML generado
                  },
                  error: function(textStatus, errorThrown) {
                      reject('Error en la solicitud AJAX:', textStatus, errorThrown);
                  }
              });
          });
      };//fin traer

         function InsertarFavoritos(IdLista) {
          return new Promise((resolve, reject) => {
              var cedUsuario = cedula;
              $.ajax({
                  url: "../../App/Modules/Inmueble/insertarInmueblesFavoritos_Negocios.php",
                  type: "POST",
                  data: {
                      cedUsuario: cedula,
                      IdLista:IdLista,
                      idInmueble:idInmueble
                  },
                  success: function(response) {
                      var respuestaJSON = JSON.parse(response);

                      if (respuestaJSON === true) {
                        resolve('exito');
                    } else {
                        reject('Error al insertar en la lista');
                    }
                  },
                  error: function(textStatus, errorThrown) {
                      reject('Error en la solicitud AJAX:', textStatus, errorThrown);
                  }
              });
          });
      }//FIN FUNTION InsertarFavoritos

      
      btnAgregarFavoritos.addEventListener('click', function() {
          traerFavoritos().then((html) => {
              Swal.fire({
                  title: 'Agregar a Favoritos',
                  html: `<body id="bodyDelModalAgregarFav">
                            <div id="examenModalAgregarFav">
                              <h1 id="nombrePregunta"> </h1>
                              <div id="preguntaModalAgregarFav"><br>${html}</div>
                            </div>
                          </body>`,
                  showCancelButton: true,
                  confirmButtonText: 'Agregar',
                  cancelButtonText: 'Cerrar',
                  preConfirm: () => {
                      const favorito = document.querySelector('input[name="favorito"]:checked');
                      if (!favorito) {
                          Swal.showValidationMessage('Debes seleccionar una opción');
                      }
                      return favorito.value;
                  }
              }).then((result) => {
                  if (result.isConfirmed) {
                      const listaSeleccionada = result.value;

                        // Llama a InsertarFavoritos y pasa el result.value como parámetro
                    InsertarFavoritos(listaSeleccionada).then((exito) => {
                      if (exito) {
                        Swal.fire(`Añadido a la lista: ${listaSeleccionada}`);
                    } else {
                        Swal.fire('Error al añadir a la lista');
                    }
                    }).catch((error) => {
                        console.error(error);
                    });

                  } else {
                      Swal.fire('Cancelar');
                  }
              });
          }).catch((error) => {
              console.error(error);
          });
      });
      }//fin del if boton existe
    //   ----------------------------------------------------------------------------------------
    if (btnAgregarLista) {

      function InsertarNuevaLista(nombreLista) {
          return new Promise((resolve, reject) => {
              var cedUsuario = cedula;
              $.ajax({
                  url: "../../App/Modules/Inmueble/addListaFavoritos_Negocios.php",
                  type: "POST",
                  data:{
                      cedUsuario: cedUsuario,
                      nombreLista:nombreLista
                  },
                  success: function(response) {
                      var respuestaJSON = JSON.parse(response);

                      if (respuestaJSON === true) {
                        resolve('exito');
                    } else {
                        reject('Error al insertar en la lista');
                    }
                  },
                  error: function(textStatus, errorThrown) {
                      reject('Error en la solicitud AJAX:', textStatus, errorThrown);
                  }
              });
          });
      }//FIN FUNTION InsertarFavoritos

      
      btnAgregarLista.addEventListener('click', function() {
        Swal.fire({
            title: 'Nombre de la nueva lista:',
            html: `<input type="text" id="addLista" value="">`,
            showCancelButton: true,
            confirmButtonText: 'Nueva',
            cancelButtonText: 'Cerrar',
            preConfirm: () => {
                const listaNombre = document.getElementById('addLista').value;
                if (!listaNombre) {
                    Swal.showValidationMessage('Debes ingresar un nombre para la lista');
                }
                return listaNombre;
            }
        }).then((result) => {
            if (result.isConfirmed) {
                const listaSeleccionada = result.value;
    
                // Llama a InsertarNuevaLista y pasa el result.value como parámetro
                InsertarNuevaLista(listaSeleccionada)
                    .then(() => {
                        Swal.fire(`Lista "${listaSeleccionada}" creada con éxito`);
                    })
                    .catch((error) => {
                        Swal.fire(`Error al crear la lista: ${error}`);
                    });
            } else {
                Swal.fire('Cancelar');
            }
        });
        
      });//fin del clic
      }//fin del if boton existe


      
  });//FIN LOAD 
});


