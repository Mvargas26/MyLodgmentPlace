<?php
include './templates/Header.php';
session_start();
// if (!isset($_SESSION['Identificacion']) || !isset($_SESSION['Rol']) || empty($_SESSION['Identificacion']) || empty($_SESSION['Rol'])|| $_SESSION['Rol']!=2) {
//     header('Location: ../../');
//     exit();
// }
?>
<!-- ==============================================Fin header ======= -->

<?php

if (isset($_SESSION["Identificacion"])) {
    // $ID = $_SESSION["Identificacion"];
    ?>
    <input type="hidden" id="PropietarioID" value="<?php echo $_SESSION["Identificacion"] ?>"/>

<?php
 }
 else{
    $ID = "NO HAY ID";
    ?>
        <input type="hidden" id="PropietarioID" value="N0 HAY ID"/>

    <?php
 }
 

?>

<body>


<br>
<br>
<br>
<div class="form-container">
    <section id="Info_inmueble" class="form-section active">
        <img src="../assets/img/publicarinmueble/PASOS.png" alt="">

        <div id="tituloPublicarInmueble">
            <br/>
            <h1>Información de tu Espacio</h1>

            <!-- <button id="nextButton" onclick="showNextSection()">➡️</button> -->
            <a class="bar-anchor" id="nextButton" onclick="InsertarInmueble()">
                <span>Siguiente</span>
                <div class="transition-bar"></div>
            </a>

        </div>

        <hr/>

        <div id="contenedorInputs">
            <form action="" method="post" role="form" enctype="multipart/form-data" class="php-email-form">

                <div class="row">
                    <div class="col-md-4 form-group">
                        <i class="bi bi-pen-fill" style="color:#f4572c; font-size: 2em;"></i>
                        <input type="text" name="name" class="form-control" id="nombreEspacio" placeholder="Nombre de tu espacio" required>
                    </div>
                    <div class="col-md-4 form-group mt-3 mt-md-0">
                        <i class="bi bi-people-fill" style="color:#f4572c; font-size: 2em;"></i>
                        <input type="number" name="capacidadpersonas" class="form-control" id="capacidadpersonas" placeholder="Capacidad máxima de personas" required>
                    </div>
                    <div class="col-md-4 form-group mt-3 mt-md-0">
                            <i class="far fa-calendar-alt" style="color:#f4572c; font-size: 2em;"></i>
                            <h5>Fecha límite para estar disponible</h5>
                            <input type="date" class="form-control" name="fechalimiteDisponible" id="fechalimiteDisponible" required>
                    </div>
                </div> <!--end row -->
                <br>

                <div class="row">
                    <div class="col-md-4 form-group">
                        <i class="bi bi-cash-coin" style="color:#f4572c; font-size: 2em;"></i>
                        <input type="number" class="form-control" name="ValorDiario" id="ValorDiario" placeholder="Valor por Noche" required>
                    </div>
                    <div class="col-md-4 form-group mt-3 mt-md-0">
                        <i class="bi bi-cash-coin" style="color:#f4572c; font-size: 2em;"></i>
                        <input type="number" class="form-control" name="costopersonaextra" id="costopersonaextra" placeholder="Costo por persona extra" required>
                    </div>
                    <div class="col-md-4 form-group mt-3 mt-md-0">
                        <i class="bi bi-geo-alt-fill" style="color:#f4572c; font-size: 2em;"></i>
                        <textarea class="form-control" name="Direccion" id="Direccion" style="resize:none;" rows="3" placeholder="Dirección" required></textarea>
                    </div>
                </div> <!--end row -->
                <br>
                <div class="row">
                    <div class="col-md-4 form-group">
                        <div id="img-area">
                            <label for="fotoInmueble">Subir fotos de tu Espacio:</label>
                            <br>
                            <input type="file" class="form-control" name="fotoInmueble" id="fotoInmueble" multiple accept="image/*">
                        </div>
                    </div>

                </div> <!--end row -->
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label for="categoriaInmueble">Categoria:</label>
                        <select id="categoriaInmueble" onchange="obtenerValor()">
                            <option value="Sin Categoría">Sin Categoría</option>
                            <option value="Cabañas">Cabañas</option>
                            <option value="Playa">Playa</option>
                            <option value="Rural">Rural</option>
                            <option value="Lujo">Lujo</option>
                            <option value="Fincas">Fincas</option>
                        </select>
                    </div>

                </div> <!--end row -->
                
                
                <!-- <div class="row">
                        <div class="col-md-12 form-group">
                            <i class="bi bi-pen-fill" style="color:#f4572c; font-size: 2em;"></i>
                            <input type="text" name="name" class="form-control" id="nombreEspacio" placeholder="Nombre de tu espacio" required>
                        </div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-md-12 form-group mt-3">
                            <i class="bi bi-cash-coin" style="color:#f4572c; font-size: 2em;"></i>
                            <input type="number" class="form-control" name="ValorDiario" id="ValorDiario" placeholder="Valor por Noche" required>
                        </div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-md-12 form-group mt-3">
                            <input type="hidden" class="form-control" name="disponibilidad" id="disponibilidad" placeholder="disponibilidad" required>
                        </div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <i class="bi bi-people-fill" style="color:#f4572c; font-size: 2em;"></i>
                            <input type="number" name="capacidadpersonas" class="form-control" id="capacidadpersonas" placeholder="Capacidad máxima de personas" required>
                        </div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-md-12 form-group mt-3">
                            <i class="bi bi-cash-coin" style="color:#f4572c; font-size: 2em;"></i>
                            <input type="number" class="form-control" name="costopersonaextra" id="costopersonaextra" placeholder="Costo por persona extra" required>
                        </div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <i class="bi bi-geo-alt-fill" style="color:#f4572c; font-size: 2em;"></i>
                            <textarea class="form-control" name="Direccion" id="Direccion" style="resize:none;" rows="3" placeholder="Dirección" required></textarea>
                        </div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <i class="far fa-calendar-alt" style="color:#f4572c; font-size: 2em;"></i>
                            <h5>Fecha límite para estar disponible</h5>
                            <input type="date" class="form-control" name="fechalimiteDisponible" id="fechalimiteDisponible" required>
                        </div>
                    </div>-->
                    <br/>
            </form>
        </div> <!--end contendorInputs -->
    </div> <!--end contendorInputs -->
        
    </section> 

    <!-- ================================================================================== -->
    <!-- CARACTERISTICAS -->
    <!-- ================================================================================== -->
    <section id="Caracteristicas" class="form-section">

        <img src="../assets/img/publicarinmueble/PASOS1.png" alt="">
        <div id="contenedorInputs">
            <form action="forms/contact.php" method="post" role="form">
            
                <div class="section-title" style="display:flex; justify-content: space-around;">
                    <h1>Caracteristicas</h1>
                    <a class="bar-anchor" onclick="showNextSection()">
                <span>Siguiente</span>
                <div class="transition-bar"></div>
            </a>
                </div>    
                <hr>
                
                <br/>
                <br/>
                <div class="row">
                    <div class="col-md-4 form-group">
                        <i class="bi bi-door-open" style="color:#f4572c; font-size: 2em;"></i>
                        <input type="number" name="cantCuartos" class="form-control" id="cantCuartos" placeholder="Cantidad de Cuartos" required>
                    </div>
                    <div class="col-md-4 form-group mt-3 mt-md-0">
                        <i class="fas fa-bed" style="color:#f4572c; font-size: 2em; margin:7px;"></i>
                        <input type="number" class="form-control" name="cantCamas" id="cantCamas" placeholder="Cantidad de Camas" required>
                    </div>
                    <div class="col-md-4 form-group mt-3 mt-md-0">
                        <i class="fas fa-restroom" style="color:#f4572c; font-size: 2em;  margin:7px;"></i>
                        <input type="number" class="form-control" name="cantBanios" id="cantBanios" placeholder="Cantidad de Baños" required>
                    </div>
                </div> <!--end row -->
                
                <br/>
                <br/>
                <div class="row">
                    <div class="col-md-4 form-group">
                        <i class="fas fa-tree" style="color:#f4572c; font-size: 2em;"></i>
                        <input type="number" name="cantidadPatios" class="form-control" style="margin-top:10px;" id="cantidadPatios" placeholder="Cantidad de Patios" required>
                    </div>
                    <div class="col-md-4 form-group mt-3 mt-md-0">
                        <i class="fas fa-car" style="color:#f4572c; font-size: 2em;"></i>
                        <input type="number" class="form-control" name="cantidadCocheras" style="margin-top:10px;" id="cantidadCocheras" placeholder="Espacios para Carros" required>
                    </div>
                    <div class="col-md-4 form-group mt-3 mt-md-0">
                        <i class="bi bi-buildings-fill" style="color:#f4572c; font-size: 2em;"></i>
                        <input type="number" class="form-control" name="cantidadPlantas" id="cantidadPlantas" placeholder="Cantidad de Plantas" required>
                    </div>
                </div><!--end row -->
                <br/>
                <br/>
            </form>
    </section>

    <section id="Calendario" class="form-section">
        <img src="../assets/img/publicarinmueble/PASOS2.png" alt="">
    
        <div class="section-title">
            <a class="bar-anchor" onclick="showNextSection()">
                <span>Siguiente</span>
                <div class="transition-bar"></div>
            </a>
        </div>

        <div style="display: flex; justify-content: center; align-content: center;">

            <h1></h1>
        </div>
    

    </section>
        
    
    <!-- ========================================================================== -->
    <!-- POLITICAS -->
    <!-- ========================================================================== -->
    
    <section id="politicas" class="form-section">
        <img src="../assets/img/publicarinmueble/PASOS3.png" alt="">
        
        
        <div class="politicasgrid">
            <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                
                
                <div class="section-title">
                    <h2>Políticas</h2>
                    <p>Cuales van a ser tus políticas en cuanto a... </p>
                    <a class="bar-anchor" onclick="Insertar_PoliticaInmueble()">
                            <span>Siguiente</span>
                            <div class="transition-bar"></div>
                    </a>
                    
                </div>
                <hr>
                
                <div class="politicas">
                           
                    <div class="icon-box">
                        <div class="icon"><i class="i bi-house-slash-fill" style="color: #ff689b;"></i></div>
                        <h2 class="title">Cancelacion</h2>                          
                        <div class="info">
                            <h5>cancelacion</h5>
                            <hr>

                            <p class="description">
                                <input type="hidden" id="cancelacionSeleccionada" name="cancelacionSeleccionada" value="">
                                <label>
                                    <input type="radio" name="cancelacion" class="opciones-cancelacion" value="2" checked onchange="actualizarInputHidden('cancelacionSeleccionada', this)">
                                    2 dias antes de la fecha programada
                                </label>
                                <label>
                                    <input type="radio" name="cancelacion" class="opciones-cancelacion" value="4" onchange="actualizarInputHidden('cancelacionSeleccionada', this)">
                                    4 dias antes de la fecha programada
                                </label>
                                <label>
                                    <input type="radio" name="cancelacion" class="opciones-cancelacion" value="7" onchange="actualizarInputHidden('cancelacionSeleccionada', this)">
                                    7 dias antes de la fecha programada
                                </label>
                            </p>
                            <br>                      
                        </div>
                    </div>
                    

                    <div class="icon-box">
                        <div class="icon"><i class="bi bi-wallet" style="color: #e9bf06;"></i></div>
                        <h4 class="title">Reembolsos</h4>
                        <div class="info">
                            <h5>Reembolsos</h5>
                            <hr>

                            <p class="description">
                                <input type="hidden" id="reembolsosSeleccionados" name="reembolsosSeleccionados" value="">
                                <label>
                                    <input type="radio" name="reembolso" class="opciones-reembolso" value="0" checked onchange="actualizarInputHidden('reembolsosSeleccionados', this)">
                                    Sin Reembolso
                                </label>
                                <label>
                                    <input type="radio" name="reembolso" class="opciones-reembolso" value="50%" onchange="actualizarInputHidden('reembolsosSeleccionados', this)">
                                    Reembolso del 50%
                                </label>
                                <label>
                                    <input type="radio" name="reembolso" class="opciones-reembolso" value="100%" onchange="actualizarInputHidden('reembolsosSeleccionados', this)">
                                    Reembolso del 100%
                                </label>
                            </p>
                            <br>                      
                        </div>
                        <br>    
                    
                    </div>
                    <!-- <i class="bi bi-alarm-fill"></i> -->
                    <div class="icon-box">
                        <div class="icon"><i class="bi bi-alarm-fill" style="color: #3fcdc7;"></i></div>
                        <h4 class="title">Horario</h4>
                        
                        <div class="info">
                            <h5>Hora de Entrada y Salida </h5>
                            <hr>
                            <p class="description">
                                <input type="hidden" id="horarioSeleccionado" name="horarioSeleccionado" value="">
                                <label>
                                    <input type="radio" name="horario" class="opciones-horario" value="2:00 pm - 11:00 am" checked onchange="actualizarInputHidden('horarioSeleccionado', this)">
                                    2:00 pm - 11:00 am
                                </label>
                                <label>
                                    <input type="radio" name="horario" class="opciones-horario" value="3:00 pm  - 12:00 pm" onchange="actualizarInputHidden('horarioSeleccionado', this)">
                                    3:00 pm  - 12:00 pm
                                </label>
                                <label>
                                    <input type="radio" name="horario" class="opciones-horario" value="4:00 pm  - 1:00 pm" onchange="actualizarInputHidden('horarioSeleccionado', this)">
                                    4:00 pm  - 1:00 pm
                                </label>
                            </p>

                        </div>
                    </div>
                    <div class="icon-box">
                        <div class="icon"><i class="bi bi-coin" style="color: #8bc34a;"></i></div>
                        <h4 class="title">Cargos Adicionales</h4>
                        
                        <div class="info">
                            <h5>Daños</h5>
                            <hr>
                        
                            <p class="description">
                                <input type="hidden" id="cargosAdicionalesSeleccionados" name="cargosAdicionalesSeleccionados" value="">
                                <label>
                                    <input type="radio" name="cargosAdicionales" class="opciones-cargos" value="10" checked onchange="actualizarInputHidden('cargosAdicionalesSeleccionados', this)">
                                    Del 10%
                                </label>
                                <label>
                                    <input type="radio" name="cargosAdicionales" class="opciones-cargos" value="20" onchange="actualizarInputHidden('cargosAdicionalesSeleccionados', this)">
                                    Del 20%
                                </label>
                                <label>
                                    <input type="radio" name="cargosAdicionales" class="opciones-cargos" value="30" onchange="actualizarInputHidden('cargosAdicionalesSeleccionados', this)">
                                    Del 30%
                                </label>
                            </p>
                        </div>
                    </div>

                <br/>
              
                    <!-- <div class="icon-box">
                        <div class="icon"><i class="bi bi-three-dots" style="color: #3fcdc7;"></i></div>
                        <h4 class="title">Otras</h4>
                        
                        <div class="info">
                            <p class="description">Otras políticas como privacidad y protección de los datos está diseñada
                                para garantizar que tu información se maneje de manera 
                                <strong>segura</strong> y <strong>ética</strong></p>
                            </div>
                    </div> -->
        </div>
        <script>
            // Función para actualizar el valor del input hidden
            function actualizarInputHidden(inputHiddenId, radioButton) {
                if (radioButton.checked) {
                    // Si el radio button está seleccionado, actualiza el valor del input hidden correspondiente
                    $("#" + inputHiddenId).val(radioButton.value);
                }
            }
            
        </script>














<!-- 

                <div class="section-title">
                    <h2>Políticas</h2>
                    <p>Cada uno de nuestros espacios ofrece una experiencia única, 
                        respaldada por políticas cuidadosamente diseñadas para hacer de tu elección un momento inolvidable.</p>
                    </div>
                    
                    <br/>
                    <div id="subtituloPoliticas">

                        <br/>
                        <h3>Cancelación</h5>
                        <i class="i bi-house-slash-fill" style="color: #ff689b; margin-left:-100px; margin-top:-20px;" id="iconoInfo"></i>
                    </div>
                </div>
                
                
                <div class="row" style="display:flex; justify-content: center; align-content: center; margin:55px;">
                    <div class="col-md-5 form-group">
                        <p><strong>Los clientes podrán cancelar sus reservas sin cargo adicional hasta</strong>
                    </p>
                </div>
                    <div class="col-md-3 form-group mt-2 mt-md-0">
                        <select class="form-control" name="horas" id="horasCancelacion" required>
                            <option value="24">24 horas</option>
                            <option value="48">48 horas</option>
                            <option value="72">72 horas</option>
                        </select>
                    </div>
                    
                    <div class="col-md-4 form-group mt-3 mt-md-0">
                        <p>
                            <strong>
                                antes de la fecha programada.
                            </strong>
                        </p>              
                    </div>
                </div>

                <br/>
                <div id="subtituloPoliticas">
                    <br/>
                    <h3>Reembolso</h5>
                    <i class="bi bi-wallet" style="color: #e9bf06; margin-left:-100px; margin-top:-20px;" id="iconoInfo"></i>
                </div>
                <
                
                <div class="row" style="display:flex; justify-content: center; align-content: center; margin:55px;">
                    <div class="col-md-5 form-group">
                        <p><strong>Al cancelar fuera del plazo establecido se devolverá el</strong>
                    </p>
                    </div>
                    <div class="col-md-3 form-group mt-2 mt-md-0">
                        <select class="form-control" name="horas" id="horasCancelacion" required>
                            <option value="25">  25%</option>
                            <option value="50">  50%</option>
                            <option value="70">  70%</option>
                        </select>
                    </div>
                    
                    <div class="col-md-4 form-group mt-3 mt-md-0">
                        <p>
                            <strong>
                                del costo de la reserva
                            </strong>
                        </p>              
                    </div>
                </div> -->
            </form>
        </div>

            
            
    </section>

        
        <!-- POLITICAS QUE SE VAN A MOSTRAR EN EL VIEW DE CADA INMUEBLE -->
        <!-- <section id="services" class="services">
            <hr/>
        <div class="container">
            
            <div class="section-title">
                <h2>Políticas</h2>
                <p>Cada uno de nuestros espacios ofrece una experiencia única, 
                    respaldada por políticas cuidadosamente diseñadas para hacer de tu elección un momento inolvidable.</p>
                </div>
                
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        
                        <div class="icon-box">
                            <div class="icon"><i class="i bi-house-slash-fill" style="color: #ff689b;"></i></div>
                            <h2 class="title">Cancelacion</h2>
                            
                            <div class="info">
                                <p class="description">Nuestra política de cancelación de reservas establece que los clientes 
                                    pueden cancelar sus reservas sin cargo adicional hasta <strong>48 horas</strong> antes de la fecha programada.
                                </p>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-lg-4 col-md-6 mt-4 mt-md-0">
                        <div class="icon-box">
                        <div class="icon"><i class="bi bi-wallet" style="color: #e9bf06;"></i></div>
                        <h4 class="title">Reembolsos</h4>
                        <div class="info">
                            <p class="description">Al cancelar <strong>dentro</strong> del plazo establecido recibirá un 
                            reembolso completo sin cargos adicionales.</p>
                        </div>
                        <div class="info">
                            <p class="description">Al cancelar <strong>fuera</strong> del plazo establecido aplicará 
                            cargos al costo total de la reserva.</p>
                        </div>
                        <br>    
                        
                </div>
                </div>

                <div class="col-lg-4 col-md-6 mt-4 mt-lg-0">
                    <div class="icon-box">
                        <div class="icon"><i class="bi bi-three-dots" style="color: #3fcdc7;"></i></div>
                        <h4 class="title">Otras</h4>
                        
                        <div class="info">
                            <p class="description">Otras políticas como privacidad y protección de los datos está diseñada
                                para garantizar que tu información se maneje de manera 
                                <strong>segura</strong> y <strong>ética</strong></p>
                            </div>
                    </div>
                </div>
                <br/>
                
                <div class="col-lg-4 col-md-6 mt-4 mt-lg-0">
                    <div class="icon-box">
                        <div class="icon"><i class="bi bi-three-dots" style="color: #3fcdc7;"></i></div>
                        <h4 class="title">Otras</h4>
                        
                        <div class="info">
                            <p class="description">Otras políticas como privacidad y protección de los datos está diseñada
                                para garantizar que tu información se maneje de manera 
                                <strong>segura</strong> y <strong>ética</strong></p>
                            </div>
                    </div>
                </div>
            </div>
            
    </section>End Services Section -->
    <!-- <hr/> -->

    <section id="services" class="form-section">
        <img src="../assets/img/publicarinmueble/PASOS4.png" alt="">
        <form action="" method="post" role="form" enctype="multipart/form-data">

            <div class="section-title">
                <input type="hidden" id="ArrayServicios">
                <h2>Servicios</h2>
                <p>¡Los servicios mejorarán la calidad de tu espacio!</p>

                <a class="bar-anchor" onclick="Insertar_ServicioInmueble()">
                    <span>Siguiente</span>
                    <div class="transition-bar"></div>
                </a>
            </div>
            
            <!-- <hr/> -->
            <div class="grid">
                
                <!-- ========================================================= -->
                <!-- SE LLENA CON LOS SERVICIOS DE LA BASE DE DATOS -->
                <!-- ========================================================= -->
                
            </div>
        </form>
        
            <hr/>
            <script>          
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
        </script>
    </section><!-- End Services Section -->
            
    <section id="Amenidades" class="form-section">
    <img src="../assets/img/publicarinmueble/PASOS5.png" alt="">
    <div style="display: flex; justify-content: center; align-content: center;">
    <h1></h1>
    </div>

    <br>
    <br>
    <a class="bar-anchor" href="../../" >
        <span>Finalizar</span>
        <div class="transition-bar"></div>
    </a>
    
    
    </section>

    
</div>  <!-- End DIV PRINCIPAL -->


<!-- <button id="nextButton" onclick="showNextSection()">➡️</button> -->




</body>
<!-- <h3>&nbsp;&nbsp;Selecciona los Servicios que tiene tu Inmueble: </h3> -->

<!-- ==============================================Inicio Footer ======= -->
<script src="../assets/js/inmueble/script_inmueble.js"></script>
<script async src="../assets/js/Servicios/script_servicios.js"></script>


<?php
include './templates/Footer.php';
?>
<!-- ==============================================Fin Footer ======= -->

