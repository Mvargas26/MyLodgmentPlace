<?php
require_once('../Master_Class.php');
$ObjMaster = new Master_Class();


try {
    
    //AQUI ENTRA PARA CONSULTAR
    if (isset($_POST['cedUsuario'])) {

        $idUser = $_POST['cedUsuario'];

       // echo json_encode(array('ced' => $idUser));

        $resultadoConsulta = $ObjMaster->ConsultarListafavoritosPorUser($idUser);

        if ($resultadoConsulta) {

            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($resultadoConsulta, JSON_UNESCAPED_UNICODE);

        } else {
            echo json_encode(array('error' => 'No hay datos disponibles'));
        }

    } else {
        echo json_encode(array('Vacio' => 'No entro al If'));

    };








} catch (Exception $e) {
    echo json_encode(array('error' => $e->getMessage()));
}


?>