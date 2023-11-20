let currentSection = 1;
const sections = document.querySelectorAll('.form-section');
const nextButton = document.getElementById('nextButton');

document.addEventListener('DOMContentLoaded', function() {
    // Oculta la página al principio
    // document.body.style.display = 'none';
    window.addEventListener('load', function () 
    {
        // document.body.style.display = 'block';
        
            // Espera a que la ventana se cargue completamente
            // Muestra la página después de que todo se haya cargado
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
            //                     valoresSeleccionados.splice(index, 1);
            //                 }
            //             }
                        
            //             var ArrayServicios = document.getElementById("ArrayServicios");
                        
            //             // ArrayServicios.value = JSON.stringify(valoresSeleccionados);
            //             console.log(valoresSeleccionados);
            // }
                    
                    
            // hiddenInputs.forEach(function (hiddenInput) {
            //     var checkbox = hiddenInput.parentElement.querySelector('input[type="checkbox"]');
            //     checkbox.addEventListener('change', handleCheckboxChange);
            // });


            
            
    });
});




function InsertarInmueble() {
    // Validar que los campos no estén vacíos
    var nombreEspacio = document.getElementById('nombreEspacio').value;
    var disponibilidad = 1 ; //DISPONIBLE  
    var valorDiario = document.getElementById('ValorDiario').value;
    var estadoLugar = 2; // PENDIENTE
    var Propietario = document.getElementById('PropietarioID').value;
    var estrellas = 5; 
    var direccion = document.getElementById('Direccion').value;
    var capacidadPersonas = document.getElementById('capacidadpersonas').value;
    var costoPersonaExtra = document.getElementById('costopersonaextra').value;
    var fechaLimiteDisponible = document.getElementById('fechalimiteDisponible').value;

    // var partesFecha = fecha_malFormato.split('/');
    // var fechaLimiteDisponible = partesFecha[2] + '-' + partesFecha[1] + '-' + partesFecha[0];

    
    var inputImagen = document.getElementById('fotoInmueble');
    var dropdown = document.getElementById("categoriaInmueble");
    var categoria = dropdown.selectedIndex;




    console.log(nombreEspacio); 
    console.log(capacidadPersonas); 
    console.log(valorDiario); 

    // Puedes agregar más campos según sea necesario

    if (
        nombreEspacio !== '' &&
        capacidadPersonas !== '' &&
        fechaLimiteDisponible !== '' &&
        valorDiario !== '' &&
        costoPersonaExtra !== '' &&
        direccion !== '' &&
        inputImagen.files.length > 0 && 
        categoria !== 0
    ) {
        // SI NO ESTAN VACIOS ENTONCES REALIZA EL ENVIO DE LA INFOMRACION a Negocios
        console.log(inputImagen);
        var NuevoEspacio = new FormData();

        // Agregar datos al NuevoEspacio
        NuevoEspacio.append('nombreEspacio', nombreEspacio);
        NuevoEspacio.append('disponibilidad', disponibilidad);
        NuevoEspacio.append('valorDiario', valorDiario);
        NuevoEspacio.append('estadoLugar', estadoLugar);
        NuevoEspacio.append('Propietario', Propietario);
        NuevoEspacio.append('estrellas', estrellas);
        NuevoEspacio.append('direccion', direccion);
        NuevoEspacio.append('capacidadPersonas', capacidadPersonas);
        NuevoEspacio.append('costoPersonaExtra', costoPersonaExtra);
        NuevoEspacio.append('fechaLimiteDisponible', fechaLimiteDisponible);

        // Agregar imágenes al NuevoEspacio
        for (var i = 0; i < inputImagen.files.length; i++) {
            console.log('Archivo ' + (i + 1) + ':', inputImagen.files[i]);
            NuevoEspacio.append('inputImagen[]', inputImagen.files[i]);
        }
        NuevoEspacio.append('categoria', categoria);
        
        $.ajax({
            url: "../../App/Modules/inmueble/publicarInmueble_Negocios.php",
            type: "POST",
            data: NuevoEspacio ,
            contentType: false, // No establecer contentType
            processData: false, // No procesar datos
            success: function (response) {

                console.log(response);
                console.log("Si entra en el succes")


                var x = JSON.parse(response);
                if (x.exito == true) {
                    Swal.fire("Éxito", x.mensaje, "success");
                    showNextSection();
                    
                } else {
                    console.log(x.mensaje);
                    Swal.fire("Error", "Lo sentimos, ocurrió un error. " + x.mensaje, "error");
                }
            },
            error: function (xhr, status, error) {
                console.log("Error en la solicitud AJAX:", error);
                Swal.fire("Error", "Ocurrió un error en la comunicación con el servidor.", "error");
            }
        });
        








        
    } else {
        showNextSection();
        // Muestra un mensaje de error o realiza alguna acción cuando los campos estén vacíos
        Swal.fire("Error", "Por favor, completa todos los campos antes de continuar." , "error");//mensaje bonito
    }
}

function Insertar_ServicioInmueble() {

    // TENDRA LOS SERVICIOS SELECCIONADOS

    
    var ArrayServicios = document.getElementById('ArrayServicios').value;

    if (ArrayServicios && ArrayServicios.length > 0) {
        
        $.ajax({
            url: "../../App/Modules/inmueble/insertarservicios_Negocios.php",
            type: "POST",
            data: {
                ArrayServicios: ArrayServicios
            },
            success: function (response) {

                try {
                    
                    console.log(response);
                    console.log("Si entra en el succes")
                    
                    
                    var x = JSON.parse(response);
                    
                    if (x.exito == true) {
                        Swal.fire("Éxito", x.mensaje, "success");
                        showNextSection();
                        
                    } else {
                        console.log(x.mensaje);
                        Swal.fire("Error", "Lo sentimos, ocurrió un error. " + x.mensaje, "error");
                    }
                } catch (error) {
                    Swal.fire("Error", "Lo sentimos, ocurrió un error. " + error , "error");
                }
            },
            error: function (xhr, status, error) {
                console.log("Error en la solicitud AJAX:", error);
                Swal.fire("Error", "Ocurrió un error en la comunicación con el servidor.", "error");
            }
        });
 
    } else {
        // Muestra un mensaje de error cuando los campos estén vacíos
        showNextSection();
        Swal.fire("Error", "Por favor, completa todos los campos antes de continuar." , "error");//mensaje bonito
    }
}

function Insertar_PoliticaInmueble() {

    // TENDRA LOS SERVICIOS SELECCIONADOS

    var Cancelacion = document.getElementById('cancelacionSeleccionada').value;
    var reembolso = document.getElementById('reembolsosSeleccionados').value;
    var horario = document.getElementById('horarioSeleccionado').value;
    var cargos = document.getElementById('cargosAdicionalesSeleccionados').value;

    if (Cancelacion !== "" && reembolso !== "" &&
    horario !== "" && cargos !== "") {
        
        // $.ajax({
        //     url: "../../App/Modules/inmueble/insertarpoliticas_Negocios.php",
        //     type: "POST",
        //     data: {
        //         Cancelacion: Cancelacion ,
        //         reembolso: reembolso , 
        //         horario: horario,
        //         cargos: cargos
        //     },
        //     success: function (response) {

        //         try {
                    
        //             console.log(response);
        //             console.log("Si entra en el succes politicas")
                    
                    
        //             var x = JSON.parse(response);
                    
        //             if (x.exito == true) {
        //                 Swal.fire("Éxito", x.mensaje, "success");
        //                 showNextSection();
                        
        //             } else {
        //                 console.log(x.mensaje);
        //                 Swal.fire("Error", "Lo sentimos, ocurrió un error. " + x.mensaje, "error");
        //             }
        //         } catch (error) {
        //             Swal.fire("Error", "Lo sentimos, ocurrió un error. " + error , "error");
        //         }
        //     },
        //     error: function (xhr, status, error) {
        //         console.log("Error en la solicitud AJAX:", error);
        //         Swal.fire("Error", "Ocurrió un error en la comunicación con el servidor.", "error");
        //     }
        // });
        showNextSection()
        
    } else {
        showNextSection()
        // Muestra un mensaje de error cuando los campos estén vacíos
        Swal.fire("Error", "Vuelve a seleccionar tus politicas" , "error");//mensaje bonito
    }
}













function showNextSection() {
    if (currentSection < sections.length) {
        sections[currentSection - 1].classList.remove('active');
        sections[currentSection].classList.add('active');
        currentSection++;

        // Ocultar el botón al llegar a la última sección
        if (currentSection === sections.length) {
        nextButton.style.display = 'none';
        }
    }

}


// Mostrar el botón solo si hay más de una sección
if (sections.length > 1) {
    nextButton.style.display = 'block';
}
























