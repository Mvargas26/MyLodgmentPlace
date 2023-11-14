<?php
include './templates/Header.php';
require_once('../Modules/Master_Class.php');
session_start();
?>
<!-- ==============================================Fin header ======= -->
<main id="mainDenuncia">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
    <style>
        .btn-emoji {
            font-size: 2rem;
            /* Tamaño del emoji */
            color: orange;
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

        .custom-table {
            width: 60%;
            /* Ancho de la tabla */
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
        <table class="table">
            <thead>
                <tr>
                    <th>ID Reserva</th>
                    <th>Nombre C</th>
                    <th>Fechas</th>
                    <th>Nombre Inmueble</th>
                    <th>Denunciar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($datos) {
                    foreach ($datos as $dato) {
                        echo "<tr>" .
                            "<td style='display:none;'>" . $dato['idUsuario'] . "</td>" .
                            "<td style='display:none;'>" . $dato['id_propietarioI'] . "</td>" .
                            "<td>" . $dato['idReserva'] . "</td>" .
                            "<td>" . $dato['nombreC'] . "</td>" .
                            "<td>" . $dato['fecha'] . "</td>" .
                            "<td style='display:none;'> " . $dato['idInmueble'] . "</td>" .
                            "<td>" . $dato['nombre_inmueble'] . "</td>" .
                            "<td><button type='button' class='btn btn-outline-secondary btn-emoji' data-toggle='modal' data-target='#myModal'><i class='bi bi-emoji-smile-fill'></i></button></td>" .
                            "</tr>";
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
                                echo "<option value='{$denuncia['idTipoDenuncia']}'>{$denuncia['nombre']}</option>";
                            }
                        } else {
                            echo "<option value='' disabled>No hay tipos de denuncias disponibles</option>";
                        }
                        ?>
                    </select>
                    <br><br>
                    <label for="campo1">Detalles de la Denuncia:</label>
                    <input type="text" id="campo1" name="campo1">
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