//###############################################################################################################################
//SERVICIOS
//###############################################################################################################################

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

                            // console.log(nuevoInputID.value);

                            // Crea un nuevo input tipo checkbox
                            var nuevoInputCheckbox = document.createElement('input');
                            nuevoInputCheckbox.type = 'checkbox';
                            nuevoInputCheckbox.checked = false;

                            var nuevoIcono = document.createElement('i');
                            nuevoIcono.className = response[i].icono;

                            // Crea un nuevo span
                            var nuevoSpan = document.createElement('span');
                            nuevoSpan.className = 'checkmark';

                            // Asigna el texto del label con el nombre del servicio
                            nuevoLabel.innerText = response[i].nombre;

                            // Agrega los elementos al label
                            nuevoLabel.appendChild(nuevoIcono);
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
        
            //POLITICAS
            // =========================================================================
            var valorCancelacion = $("input[name='cancelacion']:checked").val();
            var valorReembolso = $("input[name='reembolso']:checked").val();
            var valorhorario = $("input[name='horario']:checked").val();
            var valorCargos = $("input[name='cargosAdicionales']:checked").val();
            // Actualiza los input hidden con los valores preseleccionados
            $("#cancelacionSeleccionada").val(valorCancelacion);
            $("#reembolsosSeleccionados").val(valorReembolso);
            $("#horarioSeleccionado").val(valorhorario);
            $("#cargosAdicionalesSeleccionados").val(valorCargos);
            // =========================================================================
            
            
            // var hiddenInputs = document.querySelectorAll('.hiddenInput');
        
            // console.log(hiddenInputs);
            // console.log("SE ACTIVA EL SCRIPT DE LOS INPUT HIDDEN");
            // var valoresSeleccionados = [];
            
            // // Función para manejar el cambio en los checkboxes
            // function handleCheckboxChange(event) {
                
            //     // Encuentra el input hidden asociado al checkbox
            //     var hiddenInput = event.target.parentElement.querySelector('.hiddenInput');
                
            //     console.log("SE HIZO CLICK EN EL CHECKBOX");
                
            //     // Verifica si el checkbox está marcado o desmarcado
            //     if (event.target.checked) {
            //         // Si está marcado, agrega el valor al array
            //         valoresSeleccionados.push(hiddenInput.value);
            //     } else {
            //         // Si está desmarcado, elimina el valor del array
            //         var index = valoresSeleccionados.indexOf(hiddenInput.value);
            //         if (index !== -1) {
            //             valoresSeleccionados.splice(index, 1);
            //         }
            //     }
                
            //     var ArrayServicios = document.getElementById("ArrayServicios");
                
            //     ArrayServicios.value = JSON.stringify(valoresSeleccionados);
            //     console.log(valoresSeleccionados);
            // }
                    
                    
            // hiddenInputs.forEach(function (hiddenInput) {
            //     var checkbox = hiddenInput.parentElement.querySelector('input[type="checkbox"]');
            //     checkbox.addEventListener('change', handleCheckboxChange);
            // });
        });
    });
    
    // var hiddenInputs = document.querySelectorAll('.hiddenInput');
    
    // console.log(hiddenInputs);
    // var valoresSeleccionados = [];
    
    // // Función para manejar el cambio en los checkboxes
    // function handleCheckboxChange(event) {
        
    //     // Encuentra el input hidden asociado al checkbox
    //     var hiddenInput = event.target.parentElement.querySelector('.hiddenInput');
        
        
    //     // Verifica si el checkbox está marcado o desmarcado
    //     if (event.target.checked) {
    //                 // Si está marcado, agrega el valor al array
    //                 valoresSeleccionados.push(hiddenInput.value);
    //             } else {
    //                 // Si está desmarcado, elimina el valor del array
    //                 var index = valoresSeleccionados.indexOf(hiddenInput.value);
    //                 if (index !== -1) {
    //                 valoresSeleccionados.splice(index, 1);
    //                 }
    //             }
                
    //             var ArrayServicios = document.getElementById("ArrayServicios");
                
    //             // ArrayServicios.value = JSON.stringify(valoresSeleccionados);
    //             console.log(valoresSeleccionados);
    //         }
            
            
    //         hiddenInputs.forEach(function (hiddenInput) {
    //             var checkbox = hiddenInput.parentElement.querySelector('input[type="checkbox"]');
    //             checkbox.addEventListener('change', handleCheckboxChange);
    //         });
        // const InsertarServiciosPorInmueble = {
        //     init: function () {
        //         // Realiza una solicitud GET al cargar la página
        //         console.log("FUNCION Servicios")
        //         const InsertarServicios = {
        //             listaServicios : valoresSeleccionados,
        //             idInmueble : "ID INMUEBLE"
        //         };
                
        //         $.ajax({
        //             url: "../../App/Modules/Servicios/servicios_Negocios.php",
        //             type: "POST",
        //             data:{
        //                 InsertarServicios: InsertarServicios
        //             },
        //             success: function(response) 
        //             {
        //                 console.log("Si esta entrando")
                        
        //                 if (Array.isArray(response)) {
                            
        //                     for (var i = 0; i < response.length; i++) 
        //                     {
        //                         // Crea un nuevo label
        //                         var nuevoLabel = document.createElement('label');
        //                         nuevoLabel.className = 'containerServicios';
        //                         // nuevoLabel.id = 'containerServicios';
                                
        //                         // Crea un nuevo input tipo hidden
        //                         var nuevoInputID = document.createElement('input');
        //                         nuevoInputID.type = 'hidden';
        //                         nuevoInputID.id = 'IDServicio';
        //                         nuevoInputID.value = response[i].id;
        //                         nuevoInputID.className = 'hiddenInput'
    
        //                         // Crea un nuevo input tipo checkbox
        //                         var nuevoInputCheckbox = document.createElement('input');
        //                         nuevoInputCheckbox.type = 'checkbox';
        //                         nuevoInputCheckbox.checked = false;
    
        //                         // Crea un nuevo span
        //                         var nuevoSpan = document.createElement('span');
        //                         nuevoSpan.className = 'checkmark';
    
        //                         // Asigna el texto del label con el nombre del servicio
        //                         nuevoLabel.innerText = response[i].nombre;
    
        //                         // Agrega los elementos al label
        //                         nuevoLabel.appendChild(nuevoInputID);
        //                         nuevoLabel.appendChild(nuevoInputCheckbox);
        //                         nuevoLabel.appendChild(nuevoSpan);
    
        //                         // Agrega el label al contenedor grid
        //                         document.querySelector('.grid').appendChild(nuevoLabel);
    
        //                     }
        //                 } else {
        //                     console.error('La respuesta no es un array:', response);
        //                 }
    
    
        //             },
        //             error: function(jqXHR, textStatus, errorThrown) {
        //                 console.error('Error en la solicitud AJAX:', textStatus, errorThrown);
        //             }
        //         });
        //     }
        // };



CargarTodosLosServicios.init()



// //###############################################################################################################################
//END SERVICIOS
//###############################################################################################################################