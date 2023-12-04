<?php
include './templates/Header.php';
session_start();
// if (!isset($_SESSION['Identificacion']) || !isset($_SESSION['Rol']) || empty($_SESSION['Identificacion']) || empty($_SESSION['Rol'])|| $_SESSION['Rol']!=3) {
//     header('Location: ../../');
//     exit();
// }
?>
<!-- ==============================================Fin header ======= -->
<main id="main">
    <link rel="stylesheet" href="../assets/css/mensajes.css">
    <input id="identificacion" type="hidden" value="<?php echo $_SESSION["Identificacion"] ?>" ></input>

<body id="body">
<section class="body-chat">
    <div class="seccion-titulo">
        <h3>
            <i class="fas fa-comments"></i>
            My Lodgment Place Mensajeria
        </h3>
    </div>
    <div class="seccion-usuarios">
        <!-- <div class="seccion-buscar">
            <div class="input-buscar">
                <input type="search" placeholder="Buscar usuario">
                <i class="fas fa-search"></i>
            </div>
        </div> -->

        <!-- INPUT HIDDEN PARA GUARDAR EL ID DE LA PERSONA SELECCIONADA -->




        <!-- DEBERA SER CREADO DINAMICAMENTE -->
        <div class="seccion-lista-usuarios">
            <hr>
            <div class="usuario">
                <div class="avatar">
                    <img src="" alt="">
                    <!-- <span class="estado-usuario enlinea"></span> -->
                </div>
                <div class="cuerpo">
                    <span id=""> Nombre apellido</span>
                    <span>detalles de mensaje</span>
                </div>
            </div>

            <!-- <div class="usuario">
                <div class="avatar">
                    <img src="ruta_img" alt="img">
                    <span class="estado-usuario enlinea"></span> 
                </div>
                <div class="cuerpo">
                    <span id=""> Nombre apellido</span>
                    <span>detalles de mensaje</span>
                </div>
            </div> -->
        </div>

    </div>
    <div class="seccion-chat">

        <div class="usuario-seleccionado">
            <div class="avatar">
                <img id="idFotoPerfil_chatseleccionado" src="ruta_img" alt="img">
            </div>
            <div class="cuerpo">
                <span id="NombrHuespedSeleccionado"></span>
                <input type="hidden" id="idHuesped_Elegido">
            </div>
        </div>


        <div class="panel-chat">

            <div >
            <div class="text">Elige un contacto para enviar mensajes</div>
            </div> 
        
        </div><!-- end panel chat -->


        <div class="panel-escritura">
            <form class="textarea">
                <textarea id="mensaje" placeholder="Escribir mensaje"></textarea>
                <button type="button" class="enviar">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </form>
        </div>
    </div>
</section>
<!--====  End of html  ====-->

</body>


</main>

<!-- <script>
    document.addEventListener("DOMContentLoaded", function() {
        var idPropietario_INPUT = document.getElementById("idPropietario");

        idPropietario_INPUT.addEventListener("change", function() {
            console.log("Valor cambiado:", idPropietario_INPUT.value);
            // Agrega aquí la lógica que deseas ejecutar cuando cambie el valor
        });
    });
</script> -->


  
<script src="../assets/js/Mensajes/script_mensajesAnfitrion.js"></script>
<script src="../assets/js/Mensajes/chat.js"></script>

<!-- ==============================================Inicio Footer ======= -->
<?php
include './templates/Footer.php';
?>
<!-- ==============================================Fin Footer ======= -->