<?php

    require_once('../Master_Class.php');
    $ObjMaster = new Master_Class();


    try{

        if (isset($_POST['Caracteristicas'])) {

            try {
                $cantCuartosU = $_POST['cantCuartosU'];
                $cantCamasU = $_POST['cantCamasU'];
                $cantBaniosU = $_POST['cantBaniosU'];
                $cantPatiosU = $_POST['cantPatiosU'];
                $cantCocherasU = $_POST['cantCocherasU'];
                $cantPlantasU = $_POST['cantPlantasU'];
                // $idInmueble = $_POST['idInmueble'];


                // Llamar a la función Insertar_Inmueble con los valores recuperados
                $resultadoConsulta = $ObjMaster->Insertar_Caracteristicas(
                    $cantCuartosU, 
                    $cantCamasU ,
                    $cantBaniosU ,
                    $cantPatiosU ,
                    $cantCocherasU,
                    $cantPlantasU,
                );


                if ($resultadoConsulta) {
                    echo json_encode(array('exito' => true, 'mensaje' => 'Caracteristicas ingresadas correctamente'));
                } else {
                    echo json_encode(array('exito' => false, 'mensaje' => 'Error al ingresar caracteristicas'));
                }

            } catch (Exception $e) {
                echo json_encode(array('error' => $e->getMessage()));
            }

        }//end if caracteristicas 

    } catch (Exception $e) {
        echo json_encode(array('error' => $e->getMessage()));
    }

?>