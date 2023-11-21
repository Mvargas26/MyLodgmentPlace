<?php
include './templates/Header.php';
session_start();
// if (!isset($_SESSION['Identificacion']) || !isset($_SESSION['Rol']) || empty($_SESSION['Identificacion']) || empty($_SESSION['Rol'])|| $_SESSION['Rol']!=2) {
//     header('Location: ../../');
//     exit();
// }
?>
<!-- ==============================================Fin header ======= -->

<main>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <h1> Aqui va el punto V. anuncios Multiples</h1>
    




    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    
    <h3>&nbsp;&nbsp;Selecciona los Servicios que tiene tu Inmueble: </h3>
    <hr/>


    <!-- <div class="grid"> -->
        <!-- ========================================================= -->
        <!-- SE LLENA CON LOS SERVICIOS DE LA BASE DE DATOS -->
        <!-- ========================================================= -->
    <!-- </div> -->

    <hr/>

</main>



<!-- ==============================================Inicio Footer ======= -->
<?php
echo '<script>window.isAnunciosMultiplesPage = true;</script>';
include './templates/Footer.php';
?>
<!-- ==============================================Fin Footer ======= -->











