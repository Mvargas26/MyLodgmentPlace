<?php
require_once('./config.php');
$id    		= $_REQUEST['id']; 

$sqlDeleteEvento = ("DELETE FROM tbreserva WHERE  id='" .$id. "'");
$resultProd = mysqli_query($con, $sqlDeleteEvento);

?>
  