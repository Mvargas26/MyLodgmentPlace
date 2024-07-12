let currentSection = 1;
const sections = document.querySelectorAll('.form-section');
const nextButton = document.getElementById('nextButton');

document.addEventListener('DOMContentLoaded', function () {
    window.addEventListener('load', function () {
     
    });
});



function InsertarInmueble() {
    // Validar que los campos no estén vacíos
    var nombreEspacio = document.getElementById('nombreEspacio').value;
    var disponibilidad = 1; //DISPONIBLE  
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

        // $.ajax({
        //     url: "../../App/Modules/inmueble/publicarInmueble_Negocios.php",
        //     type: "POST",
        //     data: NuevoEspacio ,
        //     contentType: false, // No establecer contentType
        //     processData: false, // No procesar datos
        //     success: function (response) {

        //         console.log(response);
        //         console.log("Si entra en el succes")


        //         var x = JSON.parse(response);
        //         if (x.exito == true) {
        //             Swal.fire("Éxito", x.mensaje, "success");
        showNextSection();

        //         } else {
        //             console.log(x.mensaje);
        //             Swal.fire("Error", "Lo sentimos, ocurrió un error. " + x.mensaje, "error");
        //         }
        //     },
        //     error: function (xhr, status, error) {
        //         console.log("Error en la solicitud AJAX:", error);
        //         Swal.fire("Error", "Ocurrió un error en la comunicación con el servidor.", "error");
        //     }
        // });

    } else {
        // showNextSection();
        // Muestra un mensaje de error o realiza alguna acción cuando los campos estén vacíos
        Swal.fire("Error", "Por favor, completa todos los campos antes de continuar.", "error");//mensaje bonito
    }
}

function Insertar_ServicioInmueble() {

    // TENDRA LOS SERVICIOS SELECCIONADOS
    var ArrayServicios = document.getElementById('ArrayServicios').value;


    if (ArrayServicios && ArrayServicios.length > 0) {

        // $.ajax({
        //     url: "../../App/Modules/inmueble/insertarservicios_Negocios.php",
        //     type: "POST",
        //     data: {
        //         ArrayServicios: ArrayServicios
        //     },
        //     success: function (response) {

        //         try {

        //             console.log(response);
        //             console.log("Si entra en el succes")


        //             var x = JSON.parse(response);

        //             if (x.exito == true) {
        //                 Swal.fire("Éxito", x.mensaje, "success");
        showNextSection();

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

    } else {
        // Muestra un mensaje de error cuando los campos estén vacíos
        // showNextSection();
        Swal.fire("Error", "Por favor, completa todos los campos antes de continuar.", "error");//mensaje bonito
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
        showNextSection();

        //         } else {
        //             console.log(x.mensaje);
        //             Swal.fire("Error", "Lo sentimos, ocurrió un error. " + x.mensaje, "error");
        //         }
        //     } catch (error) {
        //         Swal.fire("Error", "Lo sentimos, ocurrió un error. " + error , "error");
        //     }
        // },
        //     error: function (xhr, status, error) {
        //         console.log("Error en la solicitud AJAX:", error);
        //         Swal.fire("Error", "Ocurrió un error en la comunicación con el servidor.", "error");
        //     }
        // });
        // showNextSection()

    } else {
        // showNextSection()
        // Muestra un mensaje de error cuando los campos estén vacíos
        Swal.fire("Error", "Vuelve a seleccionar tus politicas", "error");//mensaje bonito
    }
}













function showNextSection() {
    if (currentSection < sections.length) {
        console.log('Cambiando a la siguiente sección:', currentSection);
        sections[currentSection - 1].classList.remove('active');
        sections[currentSection].classList.add('active');
        currentSection++;
        // Ocultar el botón al llegar a la última sección
        if (currentSection === sections.length) {
            console.log('Mostrando el cuadro de diálogo de resumen.');
            nextButton.style.display = 'none';
            showSummaryDialog();
        }
    }
}


// Mostrar el botón solo si hay más de una sección
if (sections.length > 1) {
    nextButton.style.display = 'block';
}




function showSummaryDialog() {
    // Obtener datos de las secciones anteriores
    var nombreEspacio = document.getElementById('nombreEspacio').value;
    var valorDiario = document.getElementById('ValorDiario').value;
    var disponibilidad = 1; //DISPONIBLE  
    var estadoLugar = 2; // PENDIENTE
    var estrellas = 5;
    var direccion = document.getElementById('Direccion').value;
    var Propietario = document.getElementById('PropietarioID').value;
    var capacidadPersonas = document.getElementById('capacidadpersonas').value;
    var costoPersonaExtra = document.getElementById('costopersonaextra').value;
    var fechaLimiteDisponible = document.getElementById('fechalimiteDisponible').value;
    var dropdown = document.getElementById("categoriaInmueble");
    var categoria = dropdown.selectedIndex;
    
    var inputImagen = document.getElementById('fotoInmueble');

    // caracteristicas
    var cantidad_Cuartos = document.getElementById('cantCuartos').value;
    var cantidad_Camas = document.getElementById('cantCamas').value;
    var cantidad_Banios = document.getElementById('cantBanios').value;
    var cantidad_Patios = document.getElementById('cantidadPatios').value;
    var cantidad_Cocheras = document.getElementById('cantidadCocheras').value;
    var cantidad_Plantas = document.getElementById('cantidadPlantas').value;


    // Servicios
    var ArrayServicios = document.getElementById('ArrayServicios').value;

    // Politicas
    var Cancelacion = document.getElementById('cancelacionSeleccionada').value;
    var reembolso = document.getElementById('reembolsosSeleccionados').value;
    var horario = document.getElementById('horarioSeleccionado').value;
    var cargos = document.getElementById('cargosAdicionalesSeleccionados').value;

    
    // Construir el formulario en el cuadro de diálogo
    var formContent = `
    <style>
    #summaryForm {
        max-width: 1000px;
        margin: auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        font-family: Arial, sans-serif;
        display: grid;
        gap: 10px;
        grid-template-columns: repeat(2, 1fr);
    }

    #summaryForm label {
        font-weight: bold;
    }

    #summaryForm input {
        width: 100%;
        padding: 8px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    #summaryForm button {
        grid-column: span 2;
        background-color: #4CAF50;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    #summaryForm button:hover {
        background-color: #45a049;
    }

    .flexo{
        display: flex;
      }

</style>

<form id="summaryForm">

        <label for="nombreEspacioU">Nombre del espacio:</label>
        <input type="text" id="nombreEspacioU" value="${nombreEspacio}" required>

        <label for="valorDiarioU">Valor diario:</label>
        <input type="text" id="valorDiarioU" value="${valorDiario}" required>

        <label for="estrellasU">Estrellas:</label>
        <input type="text" id="estrellasU" value="${estrellas}" required>

        <label for="direccionU">Direccion:</label>
        <input type="text" id="direccionU" value="${direccion}" required>

        <label for="capaPersonasU">Capacidad Personas:</label>
        <input type="text" id="capaPersonasU" value="${capacidadPersonas}" required>

        <label for="costoPersonaEU">Costo Persona Extra:</label>
        <input type="text" id="costoPersonaEU" value="${costoPersonaExtra}" required>

        <label for="fechaDisponibleU">Fecha Disponibilidad:</label>
        <input type="text" id="fechaDisponibleU" value="${fechaLimiteDisponible}" required>

        <label for="cancelacionU">Cancelación:</label>
        <input type="text" id="cancelacionU" value="${Cancelacion}" required>

        <label for="reembolsoU">Reembolso:</label>
        <input type="text" id="reembolsoU" value="${reembolso}" required>

        <label for="horarioU">Horario:</label>
        <input type="text" id="horarioU" value="${horario}" required>

        <label for="cargosU">Cargos:</label>
        <input type="text" id="cargosU" value="${cargos}" required>

        <label for="cantCuartosU">Cantidad de Cuartos:</label>
        <input type="text" id="cantCuartosU" value="${cantidad_Cuartos}" required>

        <label for="cantCamasU">Cantidad de Camas:</label>
        <input type="text" id="cantCamasU" value="${cantidad_Camas}" required>

        <label for="cantBaniosU">Cantidad de Baños:</label>
        <input type="text" id="cantBaniosU" value="${cantidad_Banios}" required>

        <label for="cantPatiosU">Cantidad de Patios:</label>
        <input type="text" id="cantPatiosU" value="${cantidad_Patios}" required>

        <label for="cantCocherasU">Cantidad de Vehiculos:</label>
        <input type="text" id="cantCocherasU" value="${cantidad_Cocheras}" required>     

        <label for="cantPlantasU">Cantidad de Plantas:</label>
        <input type="text" id="cantPlantasU" value="${cantidad_Plantas}" required>    
    

</form>
    `;

    // var cantidad_Cuartos = document.getElementById('cantCuartos').value;
    // var cantidad_Camas = document.getElementById('cantCamas').value;
    // var cantidad_Banios = document.getElementById('cantBanios').value;
    // var cantidad_Patios = document.getElementById('cantidadPatios').value;
    // var cantidad_Cocheras = document.getElementById('cantidadCocheras').value;
    // var cantidad_Plantas = document.getElementById('cantidadPlantas').value;



    // Mostrar el cuadro de diálogo de SweetAlert con el formulario
    Swal.fire({
        title: 'Resumen de la Información',
        html: formContent,
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        showConfirmButton: true,
        confirmButtonText: 'Confirmar y Enviar',
    }).then((result) => {
        if (result.isConfirmed) {
            // Realizar acciones con los valores, como enviarlos por AJAX
            nombreEspacioU = document.getElementById('nombreEspacioU').value;
            valorDiarioU = document.getElementById('valorDiarioU').value;
            estrellasU = document.getElementById('estrellasU').value;
            direccionU = document.getElementById('direccionU').value;
            capacidadPersonasU = document.getElementById('capaPersonasU').value;
            costoPersonaExtraU = document.getElementById('costoPersonaEU').value;
            fechaLimiteDisponibleU = document.getElementById('fechaDisponibleU').value;
            cancelacionU = document.getElementById('cancelacionU').value;
            reembolsoU = document.getElementById('reembolsoU').value;
            horarioU = document.getElementById('horarioU').value;
            cargosU = document.getElementById('cargosU').value;

            // caracteristicas
            
            cantCuartosU = document.getElementById('cantCuartosU').value;
            cantCamasU = document.getElementById('cantCamasU').value;
            cantBaniosU = document.getElementById('cantBaniosU').value;
            cantPatiosU = document.getElementById('cantPatiosU').value;
            cantCocherasU = document.getElementById('cantCocherasU').value;
            cantPlantasU = document.getElementById('cantPlantasU').value;

            
            

            sendDataToServer(nombreEspacioU,disponibilidad, valorDiarioU, estadoLugar, Propietario, estrellasU, direccionU, capacidadPersonasU, costoPersonaExtraU, fechaLimiteDisponibleU,
                categoria, ArrayServicios, Cancelacion, reembolso, horarioU, cargosU, inputImagen,
                cantCuartosU, cantCamasU, cantBaniosU, cantPatiosU ,cantCocherasU,cantPlantasU 
            );



            Swal.fire('Enviado', 'La información del inmueble ha sido enviada con éxito.', 'success')
            .then(() => {
                // Redirigir a la página deseada en caso de éxito
                window.location.href = '../../index.php';
            });
        } else {
            // El usuario canceló, puedes realizar alguna acción si es necesario
            Swal.fire('Cancelado', 'El inmueble no fue insertado.')
            .then(() => {
                // Redirigir a otra página en caso de cancelación
                window.location.href = '../../index.php';
            });
        }
    });
}

function sendDataToServer(nombreEspacioU, disponibilidad, valorDiarioU, estadoLugar, Propietario, estrellasU, direccionU, capacidadPersonasU, costoPersonaExtraU, fechaLimiteDisponibleU,
    categoria, ArrayServicios, Cancelacion, reembolso, horarioU, cargosU, inputImagenU, 
    cantCuartosU, cantCamasU, cantBaniosU, cantPatiosU ,cantCocherasU,cantPlantasU) {


    var NuevoEspacio = new FormData();
    var Caracteristicas = new FormData();


    NuevoEspacio.append('nombreEspacio', nombreEspacioU);
    NuevoEspacio.append('disponibilidad', disponibilidad);
    NuevoEspacio.append('valorDiario', valorDiarioU);
    NuevoEspacio.append('estadoLugar', estadoLugar);
    NuevoEspacio.append('Propietario', Propietario);
    NuevoEspacio.append('estrellas', estrellasU);
    NuevoEspacio.append('direccion', direccionU);
    NuevoEspacio.append('capacidadPersonas', capacidadPersonasU);
    NuevoEspacio.append('costoPersonaExtra', costoPersonaExtraU);
    NuevoEspacio.append('fechaLimiteDisponible', fechaLimiteDisponibleU);
    
    // Agregar imágenes al NuevoEspacio
    for (var i = 0; i < inputImagenU.files.length; i++) {
        console.log('Archivo ' + (i + 1) + ':', inputImagenU.files[i]);
        NuevoEspacio.append('inputImagen[]', inputImagenU.files[i]);
    }
    NuevoEspacio.append('categoria', categoria);


    // caracteristicas

    // SE DEBE LLAMAR DE OTRA FORMA 
    // SCRIPT DIFERENTE

    Caracteristicas.append('cantCuartosU', cantCuartosU);
    Caracteristicas.append('cantCamasU', cantCamasU);
    Caracteristicas.append('cantBaniosU', cantBaniosU);
    Caracteristicas.append('cantPatiosU', cantPatiosU);
    Caracteristicas.append('cantCocherasU', cantCocherasU);
    Caracteristicas.append('cantPlantasU', cantPlantasU);


    $.ajax({
        url: "../../App/Modules/inmueble/publicarInmueble_Negocios.php",
        type: "POST",
        data: NuevoEspacio,
        contentType: false, // No establecer contentType
        processData: false, // No procesar datos
        success: function (response) {
            console.log(response);
            console.log("Si entra en el succes")
            var x = JSON.parse(response);
            if (x.exito == true) {
                Swal.fire("Éxito", x.mensaje, "success");
            } else {
                console.log(x.mensaje);
                Swal.fire("Error", "Lo sentimos, ocurrió un error. " + x.mensaje, "error");
            }
        },
        error: function (xhr, status, error) {
            console.log("Error en la solicitud AJAX inmueble:", error);
            Swal.fire("Error", "Ocurrió un error en la comunicación con el servidor.", "error");
        }
    });

    // $.ajax({
    //     url: "../../App/Modules/inmueble/insertarCaracteristicas_Negocios.php",
    //     type: "POST",
    //     data: Caracteristicas,
    //     contentType: false, // No establecer contentType
    //     processData: false, // No procesar datos
    //     success: function (response) {
    //         console.log(response);
    //         console.log("Si entra en el succes")
    //         var x = JSON.parse(response);
    //         if (x.exito == true) {
                
    //             // Swal.fire("Éxito", x.mensaje, "success");


    //         } else {
    //             console.log(x.mensaje);
    //             // Swal.fire("Error", "Lo sentimos, ocurrió un error. " + x.mensaje, "error");
    //         }
    //     },
    //     error: function (xhr, status, error) {
    //         // console.log("Error en la solicitud AJAX inmueble:", error);
    //         // Swal.fire("Error", "Ocurrió un error en la comunicación con el servidor.", "error");
    //     }
    // });


    // if (ArrayServicios && ArrayServicios.length > 0) {
    //     $.ajax({
    //         url: "../../App/Modules/inmueble/insertarservicios_Negocios.php",
    //         type: "POST",
    //         data: {
    //             ArrayServicios: ArrayServicios
    //         },
    //         success: function (response) {
    //             try {
    //                 console.log(response);
    //                 console.log("Si entra en el succes")
    //                 var x = JSON.parse(response);
    //                 if (x.exito == true) {
    //                     Swal.fire("Éxito", x.mensaje, "success");
    //                 } else {
    //                     console.log(x.mensaje);
    //                     Swal.fire("Error", "Lo sentimos, ocurrió un error. " + x.mensaje, "error");
    //                 }
    //             } catch (error) {
    //                 Swal.fire("Error", "Lo sentimos, ocurrió un error. " + error, "error");
    //             }
    //         },
    //         error: function (xhr, status, error) {
    //             console.log("Error en la solicitud AJAX servicios:", error);
    //             Swal.fire("Error", "Ocurrió un error en la comunicación con el servidor.", "error");
    //         }
    //     });
    // } else {
    //     Swal.fire("Error", "Por favor, completa todos los campos antes de continuar.", "error");//mensaje bonito
    // }


    // if (Cancelacion !== "" && reembolso !== "" &&
    //     horario !== "" && cargos !== "") {
    //     $.ajax({
    //         url: "../../App/Modules/inmueble/insertarpoliticas_Negocios.php",
    //         type: "POST",
    //         data: {
    //             Cancelacion: Cancelacion,
    //             reembolso: reembolso,
    //             horario: horarioU,
    //             cargos: cargosU
    //         },
    //         success: function (response) {
    //             try {
    //                 console.log(response);
    //                 console.log("Si entra en el succes politicas")
    //                 var x = JSON.parse(response);
    //                 if (x.exito == true) {
    //                     Swal.fire("Éxito", x.mensaje, "success");
    //                 } else {
    //                     console.log(x.mensaje);
    //                     Swal.fire("Error", "Lo sentimos, ocurrió un error. " + x.mensaje, "error");
    //                 }
    //             } catch (error) {
    //                 Swal.fire("Error", "Lo sentimos, ocurrió un error. " + error, "error");
    //             }
    //         },
    //         error: function (xhr, status, error) {
    //             console.log("Error en la solicitud AJAX politicas:", error);
    //             Swal.fire("Error", "Ocurrió un error en la comunicación con el servidor.", "error");
    //         }
    //     });
    // } else {
    //     Swal.fire("Error", "Vuelve a seleccionar tus politicas", "error");//mensaje bonito
    // }
}