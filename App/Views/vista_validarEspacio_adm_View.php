<?php
include './templates/Header.php'; 
session_start();

$idUser = isset($_GET['idUser']) ? $_GET['idUser'] : null;

$server = "localhost";
$username = "u538860919_sitios";
$password = "Sitios2023*";
$db = "u538860919_mylodgmentplac";

try {
    $pdo = new PDO("mysql:host=$server;dbname=$db", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Error de conexión a la base de datos: ' . $e->getMessage();
    exit();
}

$sql = "SELECT tbinmueble.*, tbfotoinmueble.nombreImagen, tbestadolugar.Estado as nombreEstado
        FROM tbinmueble
        LEFT JOIN tbfotoinmueble ON tbinmueble.id = tbfotoinmueble.idFotoInmueble
        LEFT JOIN tbestadolugar ON tbinmueble.estadoLugar = tbestadolugar.idEstado
        WHERE tbinmueble.Propietario = :idUser and tbinmueble.estadoLugar = 2" ;

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
$stmt->execute();

// Obtener los resultados como un array asociativo
$inmuebles = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<main id="main">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/ImueblesPorUsuario/imueblesporusuario.css">
    <div>
        <br>
        <a href="gestionPerfilUsuarios_View.php" style="margin-left: 10px;">
            <i class="fa-solid fa-caret-left fa-beat-fade fa-2xl" style="color: #443745;"></i>
        </a>
        <br>
        <h2>Inmuebles del usuario</h2>
        <br>
        <hr>

        <?php if (empty($inmuebles)) : ?>
            <p>Tu usuario no tiene inmuebles disponibles ya que no eres anfitrión.</p>
        <?php else : ?>
            
                <div class="inmueble-list">
                    <?php foreach ($inmuebles as $inmueble) : ?>
                        <div class="contiene">
                            <div class="contiene2">
                                <img src="../assets/img/ImagenesInmuebles/<?php echo $inmueble['nombreImagen']; ?>" alt="Imagen del inmueble" style="max-width: 100%; height: auto;" style="border-radius: 15px;">
                            </div>
                            <div class="contiene">
                                <h3 class="card__title"><?php echo $inmueble['nombre']; ?></h3>
                                <p>Valor Diario: <?php echo $inmueble['valorDiario']; ?></p>
                                <p>Estrellas: <?php echo $inmueble['estrellas']; ?></p>
                                <p>Dirección: <?php echo $inmueble['direccion']; ?></p>
                                <p>Capacidad de Personas: <?php echo $inmueble['capacidadPersonas']; ?></p>
                                <p>Costo por Persona Extra: <?php echo $inmueble['costoPersonaExtra']; ?></p>
                                <p>Fecha Límite de Disponibilidad: <?php echo $inmueble['fechaLimiteDisponibilidad']; ?></p>
                                <p>Estado del Inmueble:</p> <?php echo $inmueble['nombreEstado']; ?></p>
                                <form id="formValidarInmueble<?php echo $inmueble['id']; ?>" method="post" action="">
                                    <input type="hidden" name="idValidacionimueble" value="<?php echo $inmueble['id']; ?>">
                                    <label for="nuevoEstado">Nuevo Estado:</label>
                                    <br>
                                    <div class="box">
                                        <select id="nuevoEstado" name="nuevoEstado">
                                            <option value="1">Aprobado</option>
                                            <option value="2">Pendiente</option>
                                        </select>
                                    </div>
                                    <button type="submit">Validar Inmueble</button>
                                </form>


                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
           
        <?php endif; ?>
    </div>
</main>

<script src="../assets/js/GestionImuebles/gestionInmuebles.js"></script>
 
<?php include './templates/Footer.php'; ?>
