<?php
require_once('../Master_Class.php');
$ObjMaster = new Master_Class();


try {
    //AQUI ENTRA PARA INSERTAR

    if (isset($_POST['cedUsuario'])) {

        $idusuario = $_POST['cedUsuario'];
        $nombreLista = $_POST['nombreLista'];

        $resultadoConsulta = $ObjMaster->addNuevaLista($idusuario,$nombreLista);

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