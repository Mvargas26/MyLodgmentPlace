<?php
date_default_timezone_set("America/Bogota");
setlocale(LC_ALL,"es_ES");

include('./config.php');
                        
$idEvento         = $_POST['idEvento'];

$f_inicio          = $_REQUEST['fechaInicio'];
$fecha_inicio      = date('Y-m-d', strtotime($f_inicio)); 

$f_fin             = $_REQUEST['fechaFin']; 
$seteando_f_final  = date('Y-m-d', strtotime($f_fin));  
$fecha_fin1        = strtotime($seteando_f_final."+ 1 days");
$fecha_fin         = date('Y-m-d', ($fecha_fin1));  
$color_evento      = $_REQUEST['colorEvento'];

$UpdateProd = ("UPDATE tbreserva 
    SET fechaInicio ='$fecha_inicio',
        fechaFin ='$fecha_fin',
        colorEvento ='$color_evento'
    WHERE id='".$idEvento."' ");
$result = mysqli_query($con, $UpdateProd);

header("Location:InmuebleDetalle_View.php?ea=1");

?>