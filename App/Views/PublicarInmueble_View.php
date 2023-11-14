<?php
include './templates/Header.php';
?>
<!-- ==============================================Fin header ======= -->

<div id="tituloPublicarInmueble">
    <br/>
    <h1>Información de tu Espacio</h1>
    <i class="bi bi-info-square-fill" id="iconoInfo"></i>
</div>
<hr/>

<br/>
<br/>

<div id="contenedorInputs">
    <div class="col-lg-8 mt-5 mt-lg-0">
        <form action="forms/contact.php" method="post" role="form" class="php-email-form">
            <div class="row">
                <div class="col-md-6 form-group">
                    <i class="bi bi-pen-fill" style="color:#f4572c; font-size: 2em;"></i>
                    <input type="text" name="name" class="form-control" id="nombreEspacio" placeholder="Nombre de tu espacio" required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                    <i class="bi bi-cash-coin" style="color:#f4572c; font-size: 2em;"></i>
                    <input type="number" class="form-control" name="ValorDiario" id="ValorDiario" placeholder="Valor por Noche" required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                    <input type="hidden" class="form-control" name="disponibilidad" id="disponibilidad" placeholder="disponibilidad" required>
                </div>
            </div>
            <br/>
            
            <br/>
            <div class="row">
                <div class="col-md-6 form-group">
                    <i class="bi bi-people-fill" style="color:#f4572c; font-size: 2em;"></i>
                    <input type="number" name="capacidadpersonas" class="form-control" id="capacidadpersonas" placeholder="Capacidad maxima de personas" required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                    <i class="bi bi-cash-coin" style="color:#f4572c; font-size: 2em;"></i>
                    <input type="number" class="form-control" name="costopersonaextra" id="costopersonaextra" placeholder="Costo por persona extra" required>
                </div>
            </div>
            
            <br/>
            <br/>
            <div class="row">           
                    <div class="col-md-6 form-group">
                        <i class="bi bi-geo-alt-fill" style="color:#f4572c; font-size: 2em;"></i>
                        <textarea class="form-control" name="Direccion" id="Direccion" style="resize:none;" rows="3" placeholder="Direccion" required></textarea>
                    </div>

                    <div class="col-md-6 form-group">
                        <i class="far fa-calendar-alt" style="color:#f4572c; font-size: 2em;"></i>
                        <h5>Fecha limite para estar disponible</h5>
                        <input type="date" class="form-control"  style="margin: top 17px;" name="fechalimiteDisponible" id="fechalimiteDisponible" required>
                    </div>
            </div>
                
                <br/>
                <hr/>
                
                <!-- ================================================================================== -->
                <!-- CARACTERISTICAS -->
                <!-- ================================================================================== -->
                <div class="section-title">
                    <h1 style="display:flex; justify-content: center;">Caracteristicas</h1>
                </div>    
                    

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

                
            </div>
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
            </div>
                <br/>
                <br/>
        </form>
    </div>
</div> <!--end contendorInputs -->

<hr>

<!-- ========================================================================== -->
<!-- POLITICAS -->
<!-- ========================================================================== -->

<section id="services" class="services">
    <div class="container">
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
        <!-- <br/> -->

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
        <!-- <br/> -->

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
        </div>
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
<hr/>



<section id="services" class="services">
    <div class="section-title">
        <h2>Escoge los servicios con los que cuenta tu espacio</h2>
        <p>¡Los servicios mejorarán la calidad de tu espacio!</p>
    </div>
    
    <!-- <hr/> -->
    
    <div class="grid">
        
        <!-- ========================================================= -->
        <!-- SE LLENA CON LOS SERVICIOS DE LA BASE DE DATOS -->
        <!-- ========================================================= -->
        
    </div>
    
    <hr/>
    
</section><!-- End Services Section -->



















<!-- <h3>&nbsp;&nbsp;Selecciona los Servicios que tiene tu Inmueble: </h3> -->

<!-- ==============================================Inicio Footer ======= -->
<script src="../assets/js/Servicios/script_servicios.js"></script>
<?php
include './templates/Footer.php';
?>
<!-- ==============================================Fin Footer ======= -->