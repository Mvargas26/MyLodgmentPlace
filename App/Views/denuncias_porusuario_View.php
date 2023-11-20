<?php
include './templates/Header.php';
require_once('../Modules/Master_Class.php');

$idUser = isset($_GET['idUser']) ? $_GET['idUser'] : null;

try {
    $ObjMaster = new Master_Class();

    $resultadoConsulta = $ObjMaster->ConsultarDenunciasPorCedula($idUser);

    // Verificar si $resultadoConsulta es un array antes de decodificarlo
    if (is_array($resultadoConsulta)) {
        $datos = $resultadoConsulta;
    } else {
        // Decodificar el string JSON a un array de PHP
        $datos = json_decode($resultadoConsulta, true);
    }
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}

?>
<!-- ==============================================Fin header ======= -->
<main id="mainDenuncia">
    
    <link href="../assets/css/DenunciaPorUsuario/denunciaporusuario.css" rel="stylesheet">
    <div class="container">
        <br>
        <br>
        <h2>Denuncias al Usuario</h2>
        <br>
        <table class="container">
            <thead>
                <tr>
                    <th class="col-usuario">Nombre Usuario</th>
                    <th class="col-denunciado">Nombre Denunciado</th>
                    <th class="col-tipodenuncia">Tipo Denuncia</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($datos) {
                    $contadorFila = 0;
                    foreach ($datos as $dato) {
                        echo "<tr data-fila='$contadorFila'>" .
                            "<td style='display:none;'>" . $dato['idDenuncia'] . "</td>" .
                            "<td>" . $dato['nombreC_Usu'] . "</td>" .
                            "<td>" . $dato['nombreC_Denunciado'] . "</td>" .
                            "<td>" . $dato['tipoDenuncia'] . "</td>" .
                            "<td style='display:none;'>" . $dato['detalleDenuncia'] . "</td>" .
                            "<td style='display:none;'>" . $dato['RespuestaUsuarioDenunciado'] . "</td>" .
                            "</tr>";
                        $contadorFila++;
                    }
                } else {
                    echo "<tr><td colspan='6'>No hay denuncias por el momento.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <br>
</main>

<!-- ==============================================Inicio Footer ======= -->
<?php
include './templates/Footer.php';
?>
<!-- ==============================================Fin Footer ======= -->
