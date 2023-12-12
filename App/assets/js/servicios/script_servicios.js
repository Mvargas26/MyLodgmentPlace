//###############################################################################################################################
//SERVICIOS
//###############################################################################################################################

document.addEventListener('DOMContentLoaded', function () {
    window.addEventListener('load', function(){
        var valoresSeleccionados = [];
        CargarTodosLosServicios();     
        
    });
}); //fin 

function CargarTodosLosServicios(){

    // Realiza una solicitud GET al cargar la página
    const ObtenerServicios = {
        ObtenerServicios : "ObtenerServicios"
    };

    var hiddenInputs ;
    
    $.ajax({
        url: "../../App/Modules/Servicios/servicios_Negocios.php",
        type: "POST",
        data:{
            ObtenerServicios: ObtenerServicios
        },
        success: function(response) 
        {
            console.log("Cargando los Servicios....")
            
            if (Array.isArray(response)) {

                var nuevoLabel;
            
                for (var i = 0; i < response.length; i++) 
                {
                    // Crea un nuevo label
                    nuevoLabel = document.createElement('label');
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
                var grid = document.querySelector('.grid');
                
                console.log(grid);
                // return grid;

            } else {
                console.error('La respuesta no es un array:', response);
            }
            
            hiddenInputs = document.querySelectorAll('.hiddenInput');

            var valoresSeleccionados = [];

            // console.log(hiddenInputs);
            hiddenInputs.forEach(function (hiddenInput) {
                var checkbox = hiddenInput.parentElement.querySelector('input[type="checkbox"]');
                checkbox.addEventListener('change', function(event){
                    handleCheckboxChange(event , valoresSeleccionados);
                });
            });
            
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Error en la solicitud AJAX:', textStatus, errorThrown);
        }
    }); //end ajax 
    
}//end funcion 

function handleCheckboxChange(event , valoresSeleccionados) {
    
    // Encuentra el input hidden asociado al checkbox
    var hiddenInput = event.target.parentElement.querySelector('.hiddenInput');
    
    console.log("SE HIZO CLICK EN EL CHECKBOX");
    
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
    
    var ArrayServicios = document.getElementById("ArrayServicios");
    
    ArrayServicios.value = JSON.stringify(valoresSeleccionados);
    console.log(valoresSeleccionados);
}


// //###############################################################################################################################
//END SERVICIOS
//###############################################################################################################################