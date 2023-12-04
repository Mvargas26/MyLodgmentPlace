<?php
include './templates/Header.php';
require_once('../Modules/Master_Class.php');
session_start();

// Realizar la consulta para obtener los datos antes de verificar el formulario POST
try {
    $ObjMaster = new Master_Class();
    $resultadoConsulta = $ObjMaster->gestionarMensajes('consultar', null);

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
<main id="main">
    <link href="../assets/css/gestionarMensajes.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="../assets/js/gestionarCorreo/script_gestionarMensajes.js"></script>
    <script src="../assets/js/gestionarCorreo/script_gestionarMensajesVista.js"></script>

    <div id="CajaCorreo" class="contenedor-principal">
        <div class="contenedor" data-form="mensaje">
            <div class="titulo-contenedor">Insertar Mensajes
                <button id="cerrarFormularioBtn" class="bi bi-x-circle"
                    style="background-color: #ff7f5d; float: right;"></button>
            </div>
            <div class="formulario">
                <label for="mensaje">Mensaje:</label>
                <textarea id="mensaje" name="mensaje" class="input-formulario"
                    placeholder="Ingrese el mensaje"></textarea>

                <label for="tipoMensaje">Tipo de Mensaje:</label>
                <input type="text" id="tipoMensaje" name="tipoMensaje" class="input-formulario"
                    placeholder="Ingrese el tipo de mensaje">

                <button id="nuevoMensajeBtn" class="boton-formulario">Nuevo Mensaje</button>
            </div>
        </div>

        <div class="contenedor" data-form="modificar"> 
            <div class="titulo-contenedor">Modificar Mensajes
                <button id="cerrarFormularioBtn" class="bi bi-x-circle"
                    style="background-color: #ff7f5d; float: right;"></button>
            </div>
            <div class="formulario">
                <label for="tipoMensaje">Tipos de Mensajes:</label>
                <select id="tipoMensaje" name="tipoMensaje" class="input-formulario">
                    <option value="">Seleccionar</option>
                    <?php
                     foreach ($datos as $dato) {
                        echo '<option value="' . $dato['TipoM'] . '" 
                               data-id="' . $dato['Id'] . '" 
                               data-mensaje="' . $dato['Mensaje'] . '" 
                               data-tipo-mensaje="' . $dato['TipoM'] . '">' . $dato['TipoM'] . '</option>';
                    }
                    ?>
                </select>
                <label for="mensaje">ID:</label>
                <input type="number" id="idM" name="idM" class="input-formulario" placeholder="Ingrese el tipo de mensaje"
                    readonly>

                <label for="mensajeM">Mensaje:</label>
                <textarea id="mensajeM" name="mensajeM" class="input-formulario" placeholder="Mensaje"></textarea>
                <label for="tipomensaje">Tipo Mensaje:</label>

                <input type="text" id="tipoMensajeM" name="tipoMensajeM" class="input-formulario"
                    placeholder="Ingrese el tipo de mensaje">
                <button id="modificarMensajeBtn" class="boton-formulario">Modificar Mensaje</button>
            </div>
        </div>

        <div class="contenedor" data-form="eliminar">
            <div class="titulo-contenedor">Eliminar Mensaje
                <button id="cerrarFormularioBtn" class="bi bi-x-circle"
                    style="background-color: #ff7f5d; float: right;"></button>
            </div>
            <div class="formulario">
            <label for="tipoMensajeE">Tipos de Mensajes:</label>
                <select id="tipoMensajeEl" name="tipoMensajeEl" class="input-formulario">
                    <option value="">Seleccionar</option>
                    <?php
                     foreach ($datos as $dato) {
                        echo '<option value="' . $dato['TipoM'] . '" 
                               data-id="' . $dato['Id'] . '" 
                               data-mensaje="' . $dato['Mensaje'] . '" 
                               data-tipo-mensaje="' . $dato['TipoM'] . '">' . $dato['TipoM'] . '</option>';
                    }
                    ?>
                </select>
                <label for="mensaje">ID:</label>
                <input type="number" id="idE" name="idE" class="input-formulario" placeholder="Ingrese el tipo de mensaje"
                    readonly>
                <label for="mensajeM">Mensaje:</label>
                <textarea id="mensajeE" name="mensajeE" class="input-formulario" placeholder="Mensaje" readonly></textarea>
                <label for="tipomensaje">Tipo Mensaje:</label>
                <input type="text" id="tipoMensajeE" name="tipoMensajeE" class="input-formulario"
                    placeholder="Ingrese el tipo de mensaje" readonly>

                <button id="eliminarMensajeBtn" class="boton-formulario">Eliminar Mensaje</button>
            </div>
        </div>
    </div>
</main>
<!-- ==============================================Inicio Footer ======= -->
<?php
include './templates/Footer.php';
?>
<!-- ==============================================Fin Footer ======= -->