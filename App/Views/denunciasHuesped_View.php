<?php
include './templates/Header.php';
require_once('../Modules/Master_Class.php');
session_start();
// if (!isset($_SESSION['Identificacion']) || !isset($_SESSION['Rol']) || empty($_SESSION['Identificacion']) || empty($_SESSION['Rol'])|| $_SESSION['Rol']!=3) {
//     header('Location: ../../');
//     exit();
// }
?>
<!-- ==============================================Fin header ======= -->
<main id="mainDenuncia">
    <script src="../assets/js/Denuncias/script_denuncias.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
    <link href="../assets/css/tablaDenuncias_styles.css" rel="stylesheet">
    <style>
        .btn-emoji {
            font-size: 2rem;
            /* Tamaño del emoji */
            color: orange;
            background-color: #464A52;
            /* Color inicial del emoji */
            transition: color 0.3s ease-in-out;
            /* Transición suave del color */
            padding: 0;
            /* Ajustar el relleno del botón */
        }

        .btn-emoji:hover {
            color: red;
            /* Color al pasar el mouse sobre el botón */
        }

        .btn-emoji i {
            display: block;
            padding: 0.400rem;
            /* Ajustar el relleno del ícono dentro del botón */
        }

        /* Estilo personalizado para ajustar la posición de la tabla y el modal */
        .custom-container {
            display: flex;
            justify-content: space-between;
        }

        .custom-modal {
            width: 30%;
            /* Ancho del modal */
        }
    </style>
    <?php
    try {
        $ObjMaster = new Master_Class(); // Debes crear una instancia de la clase antes de usarla
        $identificacion = $_SESSION['Identificacion'];
        $resultadoConsulta = $ObjMaster->ConsultarReservasPorUsuario($identificacion);

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
    <div class="container">
        <h2>Reservas del Usuario</h2>
        <table class="container">
            <thead>
                <tr>
                    <th>ID Reserva</th>
                    <th>Nombre Completo</th>
                    <th>Fechas</th>
                    <th>Nombre Inmueble</th>
                    <th>Denunciar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($datos) {
                    $contadorFila = 0;
                    foreach ($datos as $dato) {
                        echo "<tr data-fila='$contadorFila'>" .
                            "<td style='display:none;'>" . $dato['idUsuario'] . "</td>" .
                            "<td style='display:none;'>" . $dato['id_propietarioI'] . "</td>" .
                            "<td>" . $dato['idReserva'] . "</td>" .
                            "<td>" . $dato['nombreC'] . "</td>" .
                            "<td>" . $dato['fecha'] . "</td>" .
                            "<td style='display:none;'> " . $dato['idInmueble'] . "</td>" .
                            "<td>" . $dato['nombre_inmueble'] . "</td>" .
                            "<td><button type='button' class='btn btn-outline-secondary btn-emoji' data-toggle='modal' data-target='#myModal' data-fila='$contadorFila'><i class='bi bi-emoji-smile-fill'></i></button></td>" .
                            "</tr>";
                        $contadorFila++;
                    }
                } else {
                    echo "<tr><td colspan='6'>No hay reservas por el momento.</td></tr>";
                }
                ?>

            </tbody>
        </table>
    </div>
    <?php
    try {
        $ObjMaster = new Master_Class();
        $tiposD = $ObjMaster->ConsultarTipoDenuncias();

        // Verificar si $tiposD es un array antes de decodificarlo
        if (is_array($tiposD)) {
            $denuncias = $tiposD;
        } else {
            // Decodificar el string JSON a un array de PHP
            $denuncias = json_decode($tiposD, true);
        }
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
    ?>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Llenar Campos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="tipoDenuncia">Tipo de Denuncia:</label>
                    <select id="tipoDenuncia" name="tipoDenuncia" class="form-control">
                        <?php
                        // Verificar si hay tipos de denuncias
                        if (!empty($denuncias)) {
                            foreach ($denuncias as $denuncia) {
                                echo "<option value='{$denuncia['id']}'>{$denuncia['tipoDenuncia']}</option>";
                            }
                        } else {
                            echo "<option value='' disabled>No hay tipos de denuncias disponibles</option>";
                        }
                        ?>
                    </select>
                    <br><br>
                    <label for="campo1">Detalles de la Denuncia:</label>
                    <textarea id="campo1" name="campo1" class="form-control"></textarea>
                    <br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary">Enviar Denuncia</button>
                </div>
            </div>
        </div>
    </div>
    <script>var identificacion = <?php echo json_encode($_SESSION["Identificacion"]); ?>;</script>
    <script>var correo = <?php echo json_encode($_SESSION["Correo"]); ?>;</script>
    <script>
        $(document).ready(function () {
            var hizoClic = false;

            $('.btn-emoji').hover(
                function () {
                    if (!hizoClic) {
                        $(this).html("<i class='bi bi-emoji-frown-fill'></i>");
                    }
                },
                function () {
                    if (!hizoClic) {
                        // Al quitar el mouse, vuelve al ícono de smile-fill
                        $(this).html("<i class='bi bi-emoji-smile-fill'></i>");
                    }
                }
            );
        }); 
    </script>
</main>

<!-- ==============================================Inicio Footer ======= -->
<?php
include './templates/Footer.php';
?>
<!-- ==============================================Fin Footer ======= -->