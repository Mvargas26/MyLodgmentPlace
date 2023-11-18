<?php
include './templates/Header.php';
session_start();

require_once '../Modules/Master_Class.php';
$ObjMaster = new Master_Class();

// Obtener el ID del propietario desde la sesión
$idPropietario = $_SESSION['Identificacion'];

// Obtener los nombres de los lugares del propietario
$nombresInmuebles = $ObjMaster->obtenerNombresInmuebles($idPropietario);

?>
<!-- ==============================================Fin header ======= -->

<main id="main">
    <div class="crear-cupon">
        <h2>Crear Cupón de Descuento</h2>
        <form id="formCrearCupon">
            <div class="form-group">
                <label for="montoDescuento">Monto del Descuento (%)</label>
                <input type="number" id="montoDescuento" name="montoDescuento" min="1" max="100" required>
            </div>
            <div class="form-group">
                <label for="cantidadCupones">Cantidad de Cupones</label>
                <input type="number" id="cantidadCupones" name="cantidadCupones" min="1" required>
            </div>
            <div class="form-group">
                <label for="fechaVencimiento">Fecha de Vencimiento</label>
                <input type="date" id="fechaVencimiento" name="fechaVencimiento" required>
            </div>
            <div class="form-group">
                <label for="tipoDescuento">Tipo de Descuento</label>
                <select id="tipoDescuento" name="tipoDescuento">
                    <option value="procentual">Porcentual</option>
                    <!-- Opciones adicionales si hay otros tipos de descuento -->
                </select>
            </div>
            <div class="form-group">
                <label for="nombreInmueble">Nombre del Inmueble</label>
                <select id="nombreInmueble" name="nombreInmueble" required>
                    <?php foreach ($nombresInmuebles as $nombre) : ?>
                        <option value="<?php echo $nombre['id']; ?>"><?php echo $nombre['nombre']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit">Crear Cupón</button>
        </form>
    </div>
</main>

<!-- ==============================================Inicio Footer ======= -->
<?php
include './templates/Footer.php';
?>
<!-- ==============================================Fin Footer ======= -->