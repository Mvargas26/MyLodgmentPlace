<?php

// aca va la logica de la reserva 

date_default_timezone_set("America/Bogota");
setlocale(LC_ALL,"es_ES");
//$hora = date("g:i:A");

require("./config.php");
$f_inicio          = $_REQUEST['fechaInicio'];
$fecha_inicio      = date('Y-m-d', strtotime($f_inicio)); 

$f_fin             = $_REQUEST['fechaFin']; 
$seteando_f_final  = date('Y-m-d', strtotime($f_fin));  
$fecha_fin1        = strtotime($seteando_f_final."+ 1 days");
$fecha_fin         = date('Y-m-d', ($fecha_fin1));  
$color_evento      = $_REQUEST['colorEvento'];


$InsertNuevoEvento = "INSERT INTO tbreserva(
      fechaInicio,
      fechaFin,
      colorEvento
      )
    VALUES (
      '". $fecha_inicio."',
      '" .$fecha_fin. "',
      '" .$color_evento. "'
  )";
$resultadoNuevoEvento = mysqli_query($con, $InsertNuevoEvento);

header("Location:InmuebleDetalle_View.php?ea=1");

?>