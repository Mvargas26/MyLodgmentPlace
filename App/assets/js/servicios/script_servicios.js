//###############################################################################################################################
//SERVICIOS
//###############################################################################################################################

    const vistaActual = document.body.dataset.vista;

    // Verifica si la vista actual es PublicarInmueble_View.php
    // Carga los Servicios de la base
    if (vistaActual === 'PublicarInmueble_View.php') {
        window.addEventListener('load', function() {
            CargarTodosLosServicios.init();
        });

    }
    else{
        console.log("ES OTRA VISTA")

    }


    const CargarTodosLosServicios = {
        init: function () {
            // Realiza una solicitud GET al cargar la página
            console.log("FUNCION Servicios")
            const ObtenerServicios = {
                ObtenerServicios : "ObtenerServicios"
            };

            $.ajax({
                url: "../../App/Modules/Servicios/servicios_Negocios.php",
                type: "POST",
                data:{
                    ObtenerServicios: ObtenerServicios
                },
                success: function(response) 
                {
                    console.log("Si esta entrando")

                    if (Array.isArray(response)) {
                    
                        for (var i = 0; i < response.length; i++) 
                        {
                            // Crea un nuevo label
                            var nuevoLabel = document.createElement('label');
                            nuevoLabel.className = 'containerServicios';
                            // nuevoLabel.id = 'containerServicios';

                            // Crea un nuevo input tipo hidden
                            var nuevoInputID = document.createElement('input');
                            nuevoInputID.type = 'hidden';
                            nuevoInputID.id = 'IDServicio';
                            nuevoInputID.value = response[i].id;
                            nuevoInputID.className = 'hiddenInput'

                            // Crea un nuevo input tipo checkbox
                            var nuevoInputCheckbox = document.createElement('input');
                            nuevoInputCheckbox.type = 'checkbox';
                            nuevoInputCheckbox.checked = false;

                            // Crea un nuevo span
                            var nuevoSpan = document.createElement('span');
                            nuevoSpan.className = 'checkmark';

                            // Asigna el texto del label con el nombre del servicio
                            nuevoLabel.innerText = response[i].nombre;

                            // Agrega los elementos al label
                            nuevoLabel.appendChild(nuevoInputID);
                            nuevoLabel.appendChild(nuevoInputCheckbox);
                            nuevoLabel.appendChild(nuevoSpan);

                            // Agrega el label al contenedor grid
                            document.querySelector('.grid').appendChild(nuevoLabel);

                        }
                    } else {
                        console.error('La respuesta no es un array:', response);
                    }


                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Error en la solicitud AJAX:', textStatus, errorThrown);
                }
            });
        }
    };

        document.addEventListener('DOMContentLoaded', function () {
            window.addEventListener('load', function(){
                

                var hiddenInputs = document.querySelectorAll('.hiddenInput');
                
                console.log(hiddenInputs);
                var valoresSeleccionados = [];

                // Función para manejar el cambio en los checkboxes
                function handleCheckboxChange(event) {

                // Encuentra el input hidden asociado al checkbox
                var hiddenInput = event.target.parentElement.querySelector('.hiddenInput');
                

                // Verifica si el checkbox está marcado o desmarcado
                if (event.target.checked) {
                    // Si está marcado, agrega el valor al array
                    valoresSeleccionados.push(hiddenInput.value);
                } else {
                    // Si está desmarcado, elimina el valor del array
                    var index = valoresSeleccionados.indexOf(hiddenInput.value);
                    if (index !== -1) {
                    valoresSeleccionados.splice(index, 1);
                    }
                }

                
                console.log(valoresSeleccionados);
                }

                
                hiddenInputs.forEach(function (hiddenInput) {
                var checkbox = hiddenInput.parentElement.querySelector('input[type="checkbox"]');
                checkbox.addEventListener('change', handleCheckboxChange);
                });
            });
        });   

CargarTodosLosServicios.init()



// //###############################################################################################################################
//END SERVICIOS
//###############################################################################################################################