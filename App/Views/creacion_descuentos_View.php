<?php
include './templates/Header.php';
session_start();

// FUNCIONA CORRECTAMENTE Y HAY QUE CAMBIAR EL ID DEL ROL
if (!isset($_SESSION['Identificacion']) || !isset($_SESSION['Rol']) || empty($_SESSION['Identificacion']) || empty($_SESSION['Rol'])|| $_SESSION['Rol']!=2) {
    header('Location: ../../');
    exit();
}

require_once '../Modules/Master_Class.php';
$ObjMaster = new Master_Class();

// Obtener el ID del propietario desde la sesión
$idPropietario = $_SESSION['Identificacion'];

// Obtener los nombres de los lugares del propietario
$nombresInmuebles = $ObjMaster->obtenerNombresInmuebles($idPropietario);

?>
<!-- ==============================================Fin header ======= -->

<main id="main">
    <div id="crear-cupon">
        <h2>Crear Cupón de Descuento</h2>
        <form id="formCrearCupon">
        <div id="form-nombre" class="form-group">
                <label for="nombreCupon">Nombre del cupón, máximo 20 caracteres</label>
                <input type="text" id="nombreCupon" name="nombreCupon" min="5" max="20" required>
            </div>
            <div id="form-monto" class="form-group">
                <label for="montoDescuento">Monto del descuento, máximo 30%</label>
                <input type="number" id="montoDescuento" name="montoDescuento" min="1" max="100" required>
            </div>
            <div id="form-cantidad" class="form-group">
                <label for="cantidadCupones">Cantidad de cupones, máximo 200</label>
                <input type="number" id="cantidadCupones" name="cantidadCupones" min="1" required>
            </div>
            <div id="form-fecha" class="form-group">
                <label for="fechaVencimiento">Fecha de vencimiento</label>
                <input type="date" id="fechaVencimiento" name="fechaVencimiento" required>
            </div>
            <div id="form-tipo" class="form-group">
                <label for="tipoDescuento">Tipo de Descuento</label>
                <select id="tipoDescuento" name="tipoDescuento">
                    <option value="1">Porcentual</option>
                </select>
            </div>
            <div id="form-nombre" class="form-group">
                <label for="nombreInmueble">Nombre del Inmueble</label>
                <select id="nombreInmueble" name="nombreInmueble" required>
                    <?php foreach ($nombresInmuebles as $nombre) : ?>
                        <option value="<?php echo $nombre['id']; ?>"><?php echo $nombre['nombre']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button id="crearCuponBtn" type="submit">Crear Cupón</button>
        </form>
    </div>
</main>
<script src="../assets/js/creacionDescuentos/script.js"></script>
<!-- ==============================================Inicio Footer ======= -->
<?php
include './templates/Footer.php';
?>
<!-- ==============================================Fin Footer ======= -->