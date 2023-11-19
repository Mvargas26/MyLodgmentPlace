<?php
include './templates/Header.php';
require_once('../Modules/Master_Class.php');

// Iniciar la sesión
session_start();

// Obtener la identificación del usuario de la sesión
$identificacion = isset($_SESSION['Identificacion']) ? $_SESSION['Identificacion'] : null;

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
        <h2>Denuncias al Usuario</h2>
        <table class="container">
            <thead>
                <tr>
                    <th>Nombre Usuario</th>
                    <th>Nombre Denunciado</th>
                    <th>Tipo Denuncia</th>
                    <th>Estado</th>
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
                            "<td><button type='button' class='btn btn-outline-secondary btn-emoji' data-toggle='modal' data-target='#myModal' data-fila='$contadorFila'><i class='bi bi-ui-checks'></i></button></td>" .
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
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Responda A Denuncias</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label id="idDenuncia" name="idDenuncia" style="display: none;"></label>
                    <label for="tipoDenuncia">Detalles de la Denuncia Usuario:</label><br>
                    <label for="detalles1Label" id="detalles1DLabel"></label>
                    <br><br>
                    <label for="tipoDenuncia">Detalles de la Denuncia Anfitrion:</label><br>
                    <label for="detalles2Label" id="detalles2DLabel"></label>
                    <br><br>
                    <label for="campo1">Resultado a la Denuncia:</label>
                    <select id="estadoDenuncia" class="form-control">
                        <option value="Proceso">Proceso</option>
                        <option value="Finalizado">Finalizado</option>
                    </select> <br>
                    <label for="campo1">Estado de la Denuncia:</label>
                    <textarea id="campo1" name="campo1" class="form-control"></textarea>
                </div>
            </div>
        </div>
    </div>

</main>

<!-- ==============================================Inicio Footer ======= -->
<?php
include './templates/Footer.php';
?>
<!-- ==============================================Fin Footer ======= -->
