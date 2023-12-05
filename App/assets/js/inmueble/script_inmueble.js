let currentSection = 1;
const sections = document.querySelectorAll('.form-section');
const nextButton = document.getElementById('nextButton');

document.addEventListener('DOMContentLoaded', function () {
    // Oculta la página al principio
    // document.body.style.display = 'none';
    window.addEventListener('load', function () {
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
    var ArrayServicios = document.getElementById('ArrayServicios').value;
    var Cancelacion = document.getElementById('cancelacionSeleccionada').value;
    var reembolso = document.getElementById('reembolsosSeleccionados').value;
    var horario = document.getElementById('horarioSeleccionado').value;
    var cargos = document.getElementById('cargosAdicionalesSeleccionados').value;
    var inputImagen = document.getElementById('fotoInmueble');
    
    // Construir el formulario en el cuadro de diálogo
    var formContent = `
        <style>
            #summaryForm {
                max-width: 400px;
                margin: auto;
                padding: 20px;
                border: 1px solid #ccc;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                font-family: Arial, sans-serif;
            }

            #summaryForm label {
                display: block;
                margin-bottom: 5px;
                font-weight: bold;
            }

            #summaryForm input {
                width: 100%;
                padding: 8px;
                margin-bottom: 15px;
                box-sizing: border-box;
                border: 1px solid #ccc;
                border-radius: 4px;
            }

            #summaryForm button {
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
        </style>
        <form id="summaryForm">
            <label for="nombreEspacioU">Nombre del espacio:</label>
            <input type="text" id="nombreEspacioU" value="${nombreEspacio}" required>
            <br>
            <label for="valorDiarioU">Valor diario:</label>
            <input type="text" id="valorDiarioU" value="${valorDiario}" required>
            <br>
            <label for="estrellasU">Estrellas:</label>
            <input type="text" id="estrellasU" value="${estrellas}" required>
            <br>
            <label for="direccionU">Direccion:</label>
            <input type="text" id="direccionU" value="${direccion}" required>
            <br>
            <label for="capaPersonasU">Capacidad Personas:</label>
            <input type="text" id="capaPersonasU" value="${capacidadPersonas}" required>
            <br>
            <label for="costoPersonaEU">Costo Persona Extra:</label>
            <input type="text" id="costoPersonaEU" value="${costoPersonaExtra}" required>
            <br>
            <label for="fechaDisponibleU">Fecha Disponibilidad:</label>
            <input type="text" id="fechaDisponibleU" value="${fechaLimiteDisponible}" required>
            <br> 
            <label for="horarioU">Horario:</label>
            <input type="text" id="horarioU" value="${horario}" required>
            <br>
            <label for="cargosU">Cargos:</label>
            <input type="text" id="cargosU" value="${cargos}" required>
        </form>
    `;

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
            horarioU = document.getElementById('horarioU').value;
            cargosU = document.getElementById('cargosU').value;
            
            sendDataToServer(nombreEspacioU,disponibilidad, valorDiarioU, estadoLugar, Propietario, estrellasU, direccionU, capacidadPersonasU, costoPersonaExtraU, fechaLimiteDisponibleU,
                categoria, ArrayServicios, Cancelacion, reembolso, horarioU, cargosU, inputImagen);
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
    categoria, ArrayServicios, Cancelacion, reembolso, horarioU, cargosU, inputImagenU) {
    var NuevoEspacio = new FormData();
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
                    } else {
                        console.log(x.mensaje);
                        Swal.fire("Error", "Lo sentimos, ocurrió un error. " + x.mensaje, "error");
                    }
                } catch (error) {
                    Swal.fire("Error", "Lo sentimos, ocurrió un error. " + error, "error");
                }
            },
            error: function (xhr, status, error) {
                console.log("Error en la solicitud AJAX servicios:", error);
                Swal.fire("Error", "Ocurrió un error en la comunicación con el servidor.", "error");
            }
        });
    } else {
        Swal.fire("Error", "Por favor, completa todos los campos antes de continuar.", "error");//mensaje bonito
    }


    if (Cancelacion !== "" && reembolso !== "" &&
        horario !== "" && cargos !== "") {
        $.ajax({
            url: "../../App/Modules/inmueble/insertarpoliticas_Negocios.php",
            type: "POST",
            data: {
                Cancelacion: Cancelacion,
                reembolso: reembolso,
                horario: horarioU,
                cargos: cargosU
            },
            success: function (response) {
                try {
                    console.log(response);
                    console.log("Si entra en el succes politicas")
                    var x = JSON.parse(response);
                    if (x.exito == true) {
                        Swal.fire("Éxito", x.mensaje, "success");
                    } else {
                        console.log(x.mensaje);
                        Swal.fire("Error", "Lo sentimos, ocurrió un error. " + x.mensaje, "error");
                    }
                } catch (error) {
                    Swal.fire("Error", "Lo sentimos, ocurrió un error. " + error, "error");
                }
            },
            error: function (xhr, status, error) {
                console.log("Error en la solicitud AJAX politicas:", error);
                Swal.fire("Error", "Ocurrió un error en la comunicación con el servidor.", "error");
            }
        });
    } else {
        Swal.fire("Error", "Vuelve a seleccionar tus politicas", "error");//mensaje bonito
    }
}