<?php
include './templates/Header.php';
require_once('../Modules/Master_Class.php');
session_start();
?>
<!-- ==============================================Fin header ======= -->
<main id="main">
    <link href="../assets/css/gestionCorreo.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="../assets/js/gestionarCorreo/script_gestionCorreo.js"></script>

    <div id="CajaCorreo">
        <h2>Gestion de Correos</h2>
        <div>
            <form id="correoForm">
                <?php
                try {
                    $ObjMaster = new Master_Class();
                    $accion = 'consultar';
                    $datos = array(); 
                    $resultadoConsulta = $ObjMaster->gestionarCorreo($accion, $datos);

                    if (is_array($resultadoConsulta) && count($resultadoConsulta) > 0) {
                        $datos = $resultadoConsulta[0];  
                    } else {
                         $datos = json_decode($resultadoConsulta, true);
                    }
                } catch (Exception $e) {
                    echo 'Error: ' . $e->getMessage();
                }
                ?>
                <p>Este es el correo electrónico oficial por el momento.</p>
                <label for="idCorreo">IDCorreo:</label>
                <input type="number" name="idCorreo" value="<?php echo isset($datos[0]['idCorreo']) ? $datos[0]['idCorreo'] : ''; ?>" readonly>

                <label for="host">Host:</label>
                <input type="text" name="host" required
                    value="<?php echo isset($datos[0]['Host']) ? $datos[0]['Host'] : ''; ?>">

                <label for="usuario">Usuario:</label>
                <input type="text" name="usuario" required
                    value="<?php echo isset($datos[0]['Usuario']) ? $datos[0]['Usuario'] : ''; ?>">

                <label for="password">Contraseña:</label>
                <input type="password" name="password" required
                    value="<?php echo isset($datos[0]['Contra']) ? $datos[0]['Contra'] : ''; ?>">

                <label for="puerto">Puerto:</label>
                <input type="text" name="puerto" required
                    value="<?php echo isset($datos[0]['Puerto']) ? $datos[0]['Puerto'] : ''; ?>">

                <input type="submit" id="enviarBtn" name="boton" value="Enviar">
            </form>
        </div>
        
    </div>
</main>
<!-- ==============================================Inicio Footer ======= -->
<?php
include './templates/Footer.php';
?>
<!-- ==============================================Fin Footer ======= -->