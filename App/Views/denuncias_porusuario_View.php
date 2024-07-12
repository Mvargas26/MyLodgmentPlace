<?php
include './templates/Header.php';
require_once('../Modules/Master_Class.php');

$idUser = isset($_GET['idUser']) ? $_GET['idUser'] : null;
//tengo duda
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
    <script src="../assets/js/Denuncias/script_recepcionDenuncias.js"></script>
    <link href="../assets/css/DenunciaPorUsuario/denunciaporusuario.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
    <style>
        .btn-emoji {
            font-size: 2rem;
            color: orange;
            transition: color 0.3s ease-in-out;
            padding: 0;
        }

        .btn-emoji:hover {
            color: red;
        }

        .btn-emoji i {
            display: block;
            padding: 0.400rem;
        }
    </style>
    <div class="container">
        <br>
        <a href="gestionPerfilUsuarios_View.php" style="margin-left: 10px;">
            <i class="fa-solid fa-caret-left fa-beat-fade fa-2xl" style="color: #443745;"></i>
        </a>
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
                    <th class="col-tipodenuncia">Veredicto</th>
                    <th class="col-tipodenuncia">Administrar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($datos) {
                    $contadorFila = 0;
                    foreach ($datos as $dato) {
                        $veredicto = !empty($dato['AFavorDe']) ? $dato['AFavorDe'] : "--";

                        echo "<tr data-fila='$contadorFila'>" .
                            "<td style='display:none;'>" . $dato['idDenuncia'] . "</td>" .
                            "<td>" . $dato['nombreC_Usu'] . "</td>" .
                            "<td>" . $dato['nombreC_Denunciado'] . "</td>" .
                            "<td>" . $dato['tipoDenuncia'] . "</td>" .
                            "<td style='display:none;'>" . $dato['detalleDenuncia'] . "</td>" .
                            "<td style='display:none;'>" . $dato['RespuestaUsuarioDenunciado'] . "</td>" .
                            "<td>" . $veredicto . "</td>" .
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
                    <label for="tipoDenuncia">Detalles de la Denuncia:</label><br>
                    <label for="detallesLabel" id="detallesDLabel"></label>
                    <br><br>
                    <label for="veredicto">Veredicto:</label>
                    <select id="veredicto" name="veredicto" class="form-control">
                        <option value="--">--</option>
                        <option value="A favor">A favor</option>
                        <option value="En contra">En contra</option>
                        <option value="Ninguno">Ninguno</option>
                    </select>
                    <br>
                    <label for="campo1">Respuesta a la Denuncia:</label>
                    <textarea id="campo1" name="campo1" class="form-control"></textarea>
                    <br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" id="btnEnviarDenuncia" class="btn btn-primary">Enviar Denuncia</button>
                </div>
            </div>
        </div>
    </div>
    <br>
</main>

<!-- ==============================================Inicio Footer ======= -->
<?php
include './templates/Footer.php';
?>
<!-- ==============================================Fin Footer ======= -->