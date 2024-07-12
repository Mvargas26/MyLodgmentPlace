<?php
require_once('../Master_Class.php');
$ObjMaster = new Master_Class();


try {
    //AQUI ENTRA PARA INSERTAR

    if (isset($_POST['IdLista'])) {

        $idInmueble = $_POST['idInmueble'];
        $idLista = $_POST['IdLista'];
        $idusuario = $_POST['cedUsuario'];

       // echo json_encode(array('ced' => $idUser));

        $resultadoConsulta = $ObjMaster->insertarFavoritoEnListadeUsuario( $idInmueble, $idLista, $idusuario);

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